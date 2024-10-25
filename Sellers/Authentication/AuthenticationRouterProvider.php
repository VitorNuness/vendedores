<?php

namespace Sellers\Authentication;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Route;

class AuthenticationRouterProvider extends RouteServiceProvider
{
    public function map(): void
    {
        Route::post(
            '/login',
            fn () => ""
        )->name('auth.store');
    }
}
