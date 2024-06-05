<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TechController;

Route::prefix('user')->group(function (){
    Route::get('/users', function () {
        return $request->user();
    });
    Route::post('/register', [AuthController::class, 'register']);   
    Route::get('/login', [AuthController::class, 'login'])->name('login');   
    Route::post('/login', [AuthController::class, 'login']);   
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');   
});

Route::apiResource('tech', TechController::class, [
    'only' => [
        'index',
        'show'
    ]
]);

Route::apiResource('tech', TechController::class, [
    'except' => [
        'index',
        'show'
    ]
])->middleware(['auth:api']);