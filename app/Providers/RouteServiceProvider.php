<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        // Tighter limiter for application submissions to mitigate DOS/abuse
        RateLimiter::for('applications', function (Request $request) {
            $ip = $request->ip();
            $whitelist = collect(explode(',', (string) config('services.applications_whitelist')))
                ->map(fn($v) => trim($v))
                ->filter()
                ->all();

            if (in_array($ip, $whitelist, true)) {
                return Limit::none();
            }

            return [
                Limit::perMinute(5)->by($ip),          // hard limit per minute
                Limit::perHour(60)->by($ip),           // hourly backstop
            ];
        });
    }
}
