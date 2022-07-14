<?php

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PassportAuthController;

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
    return $request->user();
});



// mobile apis
Route::post('mobile_login',[PassportAuthController::class,'MobileLogin'])->name('mobile_login');
Route::post('mobile_update_password',[PassportAuthController::class,'MobileUpdatePassword'])->name('mobile_update_password');
Route::post('mobile_getItems',[PassportAuthController::class,'MobileGetItems'])->name('mobile_getItems');
Route::post('mobile_dsr_stock',[PassportAuthController::class,'MobileDsrStockData'])->name('mobile_dsr_stock');