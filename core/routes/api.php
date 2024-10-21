<?php

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

Route::namespace('Api')->name('api.')->group(function () {

    Route::controller('InstallationController')->prefix('verify-purchase-code')->group(function () {
        Route::post('/', 'verifyPurchasedCode')->name('purchase.code.verify');
    });
    
});
