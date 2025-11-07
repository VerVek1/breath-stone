<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ApplicationsController extends Controller
{
    public function index(Request $request)
    {
        $query = Client::query();
        
        // Фильтр по статусу
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Фильтр по дате от
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        
        // Фильтр по дате до
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        
        // Поиск по имени или телефону
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
        
        // Сортировка
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        
        if (in_array($sortBy, ['name', 'phone', 'email', 'status', 'created_at'])) {
            $query->orderBy($sortBy, $sortOrder);
        } else {
            $query->orderBy('created_at', 'desc');
        }
        
        $clients = $query->paginate(20)->appends($request->query());
        
        // Статистика для фильтров
        $stats = [
            'total' => Client::count(),
            'new' => Client::where('status', 'new')->count(),
            'contacted' => Client::where('status', 'contacted')->count(),
            'processed' => Client::where('status', 'processed')->count(),
            'completed' => Client::where('status', 'completed')->count(),
        ];
        
        return view('admin.applications.index', compact('clients', 'stats'));
    }

    public function show(Client $client)
    {
        return view('admin.applications.show', compact('client'));
    }

    public function updateStatus(Request $request, Client $client)
    {
        $request->validate([
            'status' => 'required|in:new,contacted,processed,completed'
        ]);

        $client->update([
            'status' => $request->status
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Статус заявки обновлен',
            'status' => $client->status
        ]);
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return response()->json([
            'success' => true,
            'message' => 'Заявка удалена'
        ]);
    }

}
