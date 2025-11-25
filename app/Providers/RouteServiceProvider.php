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
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('api')
                    ->prefix('api')
                    ->group(base_path('routes/api/auth.php'));
            
            Route::middleware('api')
                    ->prefix('api')
                    ->group(base_path('routes/api/gender.php'));

            Route::middleware('api')
                    ->prefix('api')
                    ->group(base_path('routes/api/document-type.php'));

             Route::middleware('api')
                    ->prefix('api')
                    ->group(base_path('routes/api/userType.php'));

            Route::middleware('api')
                    ->prefix('api')
                    ->group(base_path('routes/api/program.php'));

            Route::middleware('api')
                    ->prefix('api')
                    ->group(base_path('routes/api/event.php'));

            Route::middleware('api')
                    ->prefix('api')
                    ->group(base_path('routes/api/profile.php'));

            Route::middleware('api')
                    ->prefix('api')
                ->group(base_path('routes/api/schedule.php'));

            Route::middleware('api')
                    ->prefix('api')
                ->group(base_path('routes/api/theme.php'));

            Route::middleware('api')
                    ->prefix('api')
                ->group(base_path('routes/api/agenda.php'));

            Route::middleware('api')
                    ->prefix('api')
                ->group(base_path('routes/api/certificate.php'));

            Route::middleware('api')
                    ->prefix('api')
                ->group(base_path('routes/api/category.php'));

            
            Route::middleware('api')
                    ->prefix('api')
                ->group(base_path('routes/api/modality.php'));

            Route::middleware('api')
                    ->prefix('api')
                ->group(base_path('routes/api/userEvent.php'));

            Route::middleware('api')
                    ->prefix('api')
                ->group(base_path('routes/api/EventReview.php'));

             Route::middleware('api')
                    ->prefix('api')
                ->group(base_path('routes/api/prueba.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
            
            
        });
    }
}
