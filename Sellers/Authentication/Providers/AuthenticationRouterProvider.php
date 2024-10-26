<?php

namespace Sellers\Authentication\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Route;
use Sellers\Authentication\Http\Controllers\{AuthenticationController, ProfileController};

class AuthenticationRouterProvider extends RouteServiceProvider
{
    public function map(): void
    {
        Route::name('auth.')
            ->controller(AuthenticationController::class)
            ->group(function () {
                Route::post('/register', 'store')->name('store');
                Route::middleware(['throttle:login'])
                    ->post('/login', 'login')->name('login');
                Route::middleware('auth')
                    ->get('/logout', 'destroy')->name('logout');
            });
        Route::name('profile.')
            ->middleware('auth')
            ->controller(ProfileController::class)
            ->group(function () {
                Route::get('/me', 'show')->name('show');
                Route::put('/profile/update', 'update')->name('update');
            });
    }
}
