<?php

use App\Models\Company;
use App\Models\Hospital;
use App\Models\Institution;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Middleware\CheckLanguageApi;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        apiPrefix: 'api',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        using: function () {

            Route::middleware(['api','CheckLanguageApi'])
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware('web')
                ->group(base_path('routes/admin.php'));

            Route::middleware('web')
                ->group(base_path('routes/institution.php'));

            Route::middleware('web')
                ->group(base_path('routes/doctor.php'));

            Route::bind('companies', function ($value) {
                return Company::withTrashed()->where('id', $value)->firstOrFail();
            });
        },


    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin-role' => \App\Http\Middleware\CheckAdminRole::class,
            'check-institution' => \App\Http\Middleware\CheckInstitution::class,
            'localizeee' => \App\Http\Middleware\Localization::class,
            'setLocal' => \App\Http\Middleware\SetDefaultLocale::class,
            'Alert' => RealRashid\SweetAlert\Facades\Alert::class,
            'localize' => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes::class,
            'localizationRedirect' => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter::class,
            'localeSessionRedirect' => \Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect::class,
            'localeCookieRedirect' => \Mcamara\LaravelLocalization\Middleware\LocaleCookieRedirect::class,
            'localeViewPath' => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationViewPath::class,
            'CheckLanguageApi' => App\Http\Middleware\CheckLanguageApi::class



        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (AuthenticationException $e, Request $request) {
            if ($request->is('*')) {
                return response()->json([
                    'message' => $e->getMessage(),
                ], 401);
            }
        });
    })->create();