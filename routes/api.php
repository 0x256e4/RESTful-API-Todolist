<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    // Controller untuk autentikasi
    Route::controller(AuthController::class)->group(function () {
        Route::withoutMiddleware('auth:sanctum')->group(function () {
            // Login
            Route::post('/login', 'login_store')->name('login.store');

            // Register
            Route::post('/register', 'register_store')->name('register.store');

        });

        // Route Logout
        Route::post('/logout', 'logout_store')->name('logout.store');

        // Detail user yang login
        Route::get('/user', 'user_show')->name('user.show');

    });

    Route::resource('/todo', TodoController::class);
});

Route::fallback(function () {
    return response()->json([
        'message' => 'Url endpoint nya pasti salah! ^^',
        'endpoint_tersedia' => [
            'Login' => [
                'route' => route('login.store'),
                'method' => 'POST',
                'Data Form' => [
                    'email' => 'string',
                    'password' => 'string'
                ],
            ],
            'Daftar akun api' => [
                'route' => route('register.store'),
                'method' => 'POST',
                'Data Form' => [
                    'name' => 'string',
                    'email' => 'string',
                    'password' => 'string'
                ],
            ],
            'Detail user login' => [
                'route' => route('user.show'),
                'method' => 'GET',
                'Data Form' => [
                    'Authorization' => 'Bearer token',
                ],
            ],
            'Logout user' => [
                'route' => route('login.store'),
                'method' => 'POST',
                'Data Form' => [
                    'Authorization' => 'Bearer token',
                ],
            ],
        ],
    ]);
});