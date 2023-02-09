<?php

use App\Http\Controllers\DandhApi;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::prefix('v1')->group(function () {

    //! Authentication Routes
    include __DIR__ . './api/v1/authentication.php';
    include __DIR__ . './api/v1/products.php';


    //! Get teh auth token

    Route::get('/token', [DandhApi::class, 'getToken']);
    Route::get('/price', [DandhApi::class, 'getPriceAndAvail']);
});
