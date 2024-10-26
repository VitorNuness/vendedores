<?php

namespace Sellers\Authentication\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Route;
use Sellers\Authentication\Http\Controllers\AuthenticationController;

class AuthenticationRouterProvider extends RouteServiceProvider
{
    public function map(): void
    {
        Route::name('auth.')
            ->controller(AuthenticationController::class)
            ->group(function () {
                Route::post('/register', 'store')->name('store');
                Route::post('/login', 'login')->name('login');
            });
    }
}
