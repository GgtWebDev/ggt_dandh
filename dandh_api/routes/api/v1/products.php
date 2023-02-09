<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('product')->group(function () {
    Route::middleware('auth:sanctum', 'admin')->post('/create', [ProductController::class, 'create'])->name('product.create');

    Route::post('/all', [ProductController::class, 'show'])->name('product.all');

    Route::post('/{id}', [ProductController::class, 'showById'])->name('product.get');

    Route::post('/delete', [ProductController::class, 'destroy'])->name('product.delete');
});
