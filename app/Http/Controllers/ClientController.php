<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class ClientController extends Controller
{
    public function store(Request $request)
    {
        // Глобальный лимит: 1 заявка с одного IP раз в 3 часа (white-list поддерживается)
        $ip = $request->ip();
        $whitelist = collect(explode(',', (string) config('services.applications_whitelist')))
            ->map(fn($v) => trim($v))
            ->filter()
            ->all();
        $isWhitelisted = in_array($ip, $whitelist, true);

        $lockKey = 'applications:lock:' . $ip;
        if (!$isWhitelisted) {
            $lockedUntilTs = Cache::get($lockKey);
            if ($lockedUntilTs && $lockedUntilTs > time()) {
                $remaining = max(0, $lockedUntilTs - time());
                $hours = floor($remaining / 3600);
                $minutes = floor(($remaining % 3600) / 60);
                $message = 'Заявка уже была отправлена. Повторная отправка будет доступна через ';
                if ($hours > 0) { $message .= $hours . ' ч '; }
                $message .= $minutes . ' мин.';
                return response()->json([
                    'success' => false,
                    'message' => $message,
                ], 429);
            }
        }
        // Антибот-проверки: honeypot и минимальное время заполнения
        if ($request->filled('website')) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка валидации',
                'errors' => ['name' => ['Пожалуйста, проверьте введенные данные']]
            ], 422);
        }

        if ($request->filled('form_started_at')) {
            $elapsedMs = now()->diffInMilliseconds(\Carbon\Carbon::createFromTimestampMs((int)$request->input('form_started_at')));
            if ($elapsedMs < 3000) { // минимум 3 секунды на заполнение формы
                return response()->json([
                    'success' => false,
                    'message' => 'Слишком быстрая отправка формы',
                    'errors' => ['name' => ['Попробуйте еще раз через несколько секунд']]
                ], 429);
            }
        }

        // Валидация данных
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'nullable|string|max:1000',
            'consent' => 'required|accepted',
        ], [
            'name.required' => 'Поле "Имя" обязательно для заполнения',
            'name.max' => 'Имя не должно превышать 255 символов',
            'phone.required' => 'Поле "Телефон" обязательно для заполнения',
            'phone.max' => 'Телефон не должен превышать 20 символов',
            'message.max' => 'Сообщение не должно превышать 1000 символов',
            'consent.required' => 'Необходимо согласие на обработку персональных данных',
            'consent.accepted' => 'Необходимо согласие на обработку персональных данных',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка валидации',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Создание нового клиента
            $client = Client::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'message' => $request->message,
                'consent' => $request->has('consent') ? 1 : 0,
                'status' => 'new'
            ]);

            // Устанавливаем блокировку повторной отправки на 3 часа (если IP не в white-list)
            if (!$isWhitelisted) {
                $lockUntil = time() + 3 * 3600;
                Cache::put($lockKey, $lockUntil, Carbon::now()->addHours(3));
            }

            // Отправляем уведомление в Telegram (не блокируя основной поток)
            try {
                $botToken = (string) config('services.telegram.bot_token');
                $chatIdSingle = (string) config('services.telegram.chat_id');
                $chatIdsListRaw = (string) config('services.telegram.chat_ids');

                // Собираем список получателей: либо один ID, либо список из TELEGRAM_CHAT_IDS
                $chatIds = collect(explode(',', $chatIdsListRaw))
                    ->map(fn($v) => trim($v))
                    ->filter()
                    ->when(empty($chatIdsListRaw) && !empty($chatIdSingle), function ($c) use ($chatIdSingle) {
                        return collect([$chatIdSingle]);
                    })
                    ->unique()
                    ->values()
                    ->all();

                if (!empty($botToken) && !empty($chatIds)) {
                    $siteHost = $request->getHost();
                    $moscowNow = now()->setTimezone('Europe/Moscow');
                    $messageLines = [
                        '🆕 Новая заявка с сайта',
                        '— Имя: ' . $client->name,
                        '— Телефон: ' . $client->phone,
                        '— Сообщение: ' . (trim((string) $client->message) !== '' ? $client->message : '—'),
                        '— Время: ' . $moscowNow->format('Y-m-d H:i'),
                        '— IP: ' . $request->ip(),
                        '— Страница: ' . ($request->headers->get('referer') ?: $siteHost),
                        '— ID: #' . $client->id,
                    ];
                    $text = implode("\n", $messageLines);

                    $apiUrl = rtrim((string) config('services.telegram.api_url', 'https://api.telegram.org'), '/');
                    $endpoint = $apiUrl . '/bot' . $botToken . '/sendMessage';

                    foreach ($chatIds as $chatId) {
                        Http::timeout(5)->asForm()->post($endpoint, [
                            'chat_id' => $chatId,
                            'text' => $text,
                            'parse_mode' => 'HTML',
                            'disable_web_page_preview' => true,
                        ]);
                    }
                }
            } catch (\Throwable $e) {
                // Игнорируем ошибку уведомления, чтобы не ломать UX пользователя
            }

            return response()->json([
                'success' => true,
                'message' => 'Заявка успешно отправлена! Мы свяжемся с вами в ближайшее время.',
                'client_id' => $client->id
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Произошла ошибка при отправке заявки. Попробуйте еще раз.'
            ], 500);
        }
    }
}
