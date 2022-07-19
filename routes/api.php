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
Route::post('mobile_get_userbyId',[PassportAuthController::class,'MobileGetUserbyId'])->name('mobile_get_userbyId');
Route::post('mobile_getItems',[PassportAuthController::class,'MobileGetItems'])->name('mobile_getItems');
Route::post('mobile_getItems_byId',[PassportAuthController::class,'MobileGetItemsById'])->name('mobile_getItems_byId');
Route::post('mobile_dsr_stock',[PassportAuthController::class,'MobileDsrStockData'])->name('mobile_dsr_stock');
Route::post('mobile_add_dsr_return',[PassportAuthController::class,'MobileAddDsrReturnData'])->name('mobile_add_dsr_return');
Route::post('mobile_update_stock_status',[PassportAuthController::class,'MobileUpdateStockStatus'])->name('mobile_update_stock_status');
Route::post('mobile_get_item_count',[PassportAuthController::class,'MobileGetItemCount'])->name('mobile_get_item_count');