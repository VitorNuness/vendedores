<?php

namespace Sellers\Sale\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Route;
use Sellers\Sale\Http\Controllers\SaleController;

class SaleRouterProvider extends RouteServiceProvider
{
    public function map(): void
    {
        Route::name('sale.')
            ->middleware('auth')
            ->controller(SaleController::class)
            ->group(function () {
                Route::post('sales', 'store')->name('store');
            });
    }
}
