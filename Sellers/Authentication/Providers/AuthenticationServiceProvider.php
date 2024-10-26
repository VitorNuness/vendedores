<?php

namespace Sellers\Authentication\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use RateLimiter;

class AuthenticationServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(AuthenticationRouterProvider::class);
    }

    public function boot(): void
    {
        RateLimiter::for('login', function (Request $request) {
            return [
                Limit::perHour(3)->by($request->input('email')),
            ];
        });
    }
}
