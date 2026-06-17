<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SaleController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])
    ->group(function () {

        Route::middleware(['role:owner,admin'])
            ->group(function () {
                Route::apiResource('products', ProductController::class);
            });

        Route::middleware(['role:admin,owner,cashier'])
            ->group(function () {
                Route::apiResource('sales', SaleController::class);
            });

    });
