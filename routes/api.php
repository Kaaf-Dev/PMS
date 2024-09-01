<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentCallbackApi;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {

});
Route::group([], function () {
    Route::any('benefit-kaaf-response', [PaymentCallbackApi::class, 'benefitKaafResponse'])->name('benefit.kaaf.response');
    Route::any('benefit-eslah-response', [PaymentCallbackApi::class, 'benefitEslahResponse'])->name('benefit.eslah.response');
});
