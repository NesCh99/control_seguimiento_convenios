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
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));

            /**
             * Ruta personalizada para la parte del administrador
             * Sin esta ruta Laravel no reconoce el archivo admin.php
             */
            Route::middleware('admin')
                ->prefix('admin') //prefijo para que todas las rutas empiezen con admin/
                ->namespace($this->namespace)
                ->group(base_path('routes/admin.php'));

            /**
             * Ruta personalizada para la parte del tecnico
             * Sin esta ruta Laravel no reconoce el archivo tecnico.php
             */
            Route::middleware('tecnico')
            ->prefix('tecnico') //prefijo para que todas las rutas empiezen con tecnico/
            ->namespace($this->namespace)
            ->group(base_path('routes/tecnico.php'));

            /**
             * Ruta personalizada para la parte del auditor
             * Sin esta ruta Laravel no reconoce el archivo auditor.php
             */
            Route::middleware('auditor')
            ->prefix('auditor') //prefijo para que todas las rutas empiezen con auditor/
            ->namespace($this->namespace)
            ->group(base_path('routes/auditor.php'));
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
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
