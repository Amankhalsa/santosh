<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \App\Http\Middleware\TrustProxies::class,
        \App\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,

    \RenatoMarinho\LaravelPageSpeed\Middleware\InlineCss::class,
    \RenatoMarinho\LaravelPageSpeed\Middleware\ElideAttributes::class,
    \RenatoMarinho\LaravelPageSpeed\Middleware\InsertDNSPrefetch::class,
    \RenatoMarinho\LaravelPageSpeed\Middleware\RemoveComments::class,
    \RenatoMarinho\LaravelPageSpeed\Middleware\RemoveQuotes::class,

];

//\RenatoMarinho\LaravelPageSpeed\Middleware\TrimUrls::class,
//\RenatoMarinho\LaravelPageSpeed\Middleware\CollapseWhitespace::class,


    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
         'payment' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            //\App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'checkRole1' => \App\Http\Middleware\Admin\CheckRole1::class,
        'checkRole2' => \App\Http\Middleware\Admin\CheckRole2::class,
        'checkRole3' => \App\Http\Middleware\Admin\CheckRole3::class,
        'checkRole4' => \App\Http\Middleware\Admin\CheckRole4::class,
        'checkRole5' => \App\Http\Middleware\Admin\CheckRole5::class,
        'checkRole6' => \App\Http\Middleware\Admin\CheckRole6::class,
        'checkRole7' => \App\Http\Middleware\Admin\CheckRole7::class,
        'checkRole8' => \App\Http\Middleware\Admin\CheckRole8::class,
        'checkRole9' => \App\Http\Middleware\Admin\CheckRole9::class,
        'checkRole10' => \App\Http\Middleware\Admin\CheckRole10::class,
        'checkRole11' => \App\Http\Middleware\Admin\CheckRole11::class,
        'checkRole12' => \App\Http\Middleware\Admin\CheckRole12::class,
        'checkRole13' => \App\Http\Middleware\Admin\CheckRole13::class,
        'checkRole14' => \App\Http\Middleware\Admin\CheckRole14::class,
        'checkRole15' => \App\Http\Middleware\Admin\CheckRole15::class,
        'checkRole16' => \App\Http\Middleware\Admin\CheckRole16::class,
        'checkRole17' => \App\Http\Middleware\Admin\CheckRole17::class,
        'checkRole18' => \App\Http\Middleware\Admin\CheckRole18::class,
        'checkRole19' => \App\Http\Middleware\Admin\CheckRole19::class,
        'checkRole20' => \App\Http\Middleware\Admin\CheckRole20::class,
        'checkRole21' => \App\Http\Middleware\Admin\CheckRole21::class,
        'checkRole22' => \App\Http\Middleware\Admin\CheckRole22::class,
        'checkRole23' => \App\Http\Middleware\Admin\CheckRole23::class,
        'checkRole24' => \App\Http\Middleware\Admin\CheckRole24::class,
        'checkRole25' => \App\Http\Middleware\Admin\CheckRole25::class,
        'checkRole26' => \App\Http\Middleware\Admin\CheckRole26::class,
        'checkRole27' => \App\Http\Middleware\Admin\CheckRole27::class,
        'checkRole28' => \App\Http\Middleware\Admin\CheckRole28::class,
        'checkRole29' => \App\Http\Middleware\Admin\CheckRole29::class,
        'checkSuperAdmin' => \App\Http\Middleware\Admin\CheckSuperAdmin::class,
    ];

    /**
     * The priority-sorted list of middleware.
     *
     * This forces non-global middleware to always be in the given order.
     *
     * @var array
     */
    protected $middlewarePriority = [
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\Authenticate::class,
        \Illuminate\Session\Middleware\AuthenticateSession::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
        \Illuminate\Auth\Middleware\Authorize::class,
    ];
}
