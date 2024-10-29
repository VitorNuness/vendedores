<?php

return [
    App\Providers\AppServiceProvider::class,
    \PHPOpenSourceSaver\JWTAuth\Providers\LaravelServiceProvider::class,
    \Sellers\Authentication\Providers\AuthenticationServiceProvider::class,
    \Sellers\Sale\Providers\SaleRouterProvider::class,
];
