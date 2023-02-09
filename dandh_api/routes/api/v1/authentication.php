<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/register', [UserController::class, 'register'])->name('user.register');

    Route::post('/login', [UserController::class, 'login'])->name('user.login');

    Route::post('/forget', [UserController::class, 'forget'])->name('user.forget');

    Route::post('/reset', [UserController::class, 'reset'])->name('password.reset');

    Route::middleware('auth:sanctum')->get('/logout', [UserController::class, 'logout'])->name('user.logout');
});
