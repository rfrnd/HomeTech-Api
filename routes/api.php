<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TechController;

Route::prefix('user')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
});

Route::apiResource('tech', TechController::class, [
    'only' => ['index', 'show']
]);

Route::apiResource('tech', TechController::class, [
    'except' => ['index', 'show']
])->middleware(['auth:api']);
