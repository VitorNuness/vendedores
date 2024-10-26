<?php

namespace Sellers\Authentication\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Route;
use Sellers\Authentication\Http\Controllers\AuthenticationController;

class AuthenticationRouterProvider extends RouteServiceProvider
{
    public function map(): void
    {
        Route::post(
            '/login',
            [AuthenticationController::class, 'store']
        )->name('auth.store');
    }
}
