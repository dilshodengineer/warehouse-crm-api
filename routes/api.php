<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware([
    'auth:sanctum',
    'role:owner,admin'
])->apiResource('products', ProductController::class);