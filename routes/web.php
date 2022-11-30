<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\DsrController;
use App\Http\Controllers\DsrReturnController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BankController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[AdminController::class,'main'])->name('/');
Route::post('login_dash',[AdminController::class,'Login'])->name('login_dash');
Route::get('logout',[AdminController::class,'Logout'])->name('logout');


//Dashboard
Route::get('/dashboard',[DashboardController::class,'Dashboard'])->name('dashboard');


//User
Route::get('/user',[UserController::class,'user']);
Route::post('user_registration',[UserController::class, 'UserRegistration'])->name('user_registration');
Route::post('get_user',[UserController::class, 'GetUser'])->name('get_user');
Route::post('user_update',[UserController::class, 'UserUpdate'])->name('user_update');
Route::post('delete_user',[UserController::class, 'DeleteUser'])->name('delete_user');

//Bank
Route::get('bank',[BankController::class,'index']);
Route::post('bank_registration',[BankController::class,'create'])->name('bank_registration');
Route::post('get_bank',[BankController::class,'store'])->name('get_bank');
Route::post('bank_update',[BankController::class,'update'])->name('bank_update');
Route::post('delete_bank',[BankController::class,'destroy'])->name('delete_bank');


//Item
Route::get('/item',[ItemController::class,'item']);
Route::post('/item_registration',[ItemController::class,'ItemRegistration'])->name('item_registration');
Route::post('/get_item',[ItemController::class,'GetItem'])->name('get_item');
Route::post('/item_update',[ItemController::class,'ItemUpdate'])->name('item_update');
Route::post('/delete_item',[ItemController::class,'DeleteItem'])->name('delete_item');


Route::get('/send_inventry',[StockController::class,'SendInventry']);
Route::post('/send_item',[StockController::class,'SendItem'])->name('send_item');

Route::get('/dsr_receive',[DsrReturnController::class,'DsrReturn']);
Route::post('update_return_items',[DsrReturnController::class,'UpdateReturnItems'])->name('update_return_items');
Route::get('rolling_return_items/{id}',[DsrReturnController::class,'RollBackReturnItems'])->name('rolling_return_items');

Route::get('transfer_status',[StockController::class,'TransferStatus']);
Route::post('view_transfer_items',[StockController::class,'viewTransferItems']);
Route::post('view_transfer_rejected_items',[StockController::class,'viewTransferRejectedItems']);

Route::get('/view_balance',[StockController::class,'ViewBalance'])->name('view_balance');
Route::post('/get_view_balance',[StockController::class,'GetStockItemsById'])->name('get_view_balance');


//DSR
Route::get('pending_dsr',[DsrController::class,'PendingDsr'])->name('pending_dsr');
Route::post('dsr_save',[DsrController::class,'DsrSave'])->name('dsr_save');
Route::post('get_dsr',[DsrController::class,'GetDsr'])->name('get_dsr');
Route::post('get_complete_dsr',[DsrController::class,'getCompleteDsr'])->name('get_complete_dsr');
Route::post('remove_sale',[DsrController::class,'RemoveSale'])->name('remove_sale');
Route::post('remove_inhand',[DsrController::class,'RemoveInhand'])->name('remove_inhand');
Route::post('remove_bank',[DsrController::class,'RemoveBank'])->name('remove_bank');
Route::post('remove_dbank',[DsrController::class,'RemoveDBank'])->name('remove_dbank');
Route::post('remove_credit',[DsrController::class,'RemoveCredit'])->name('remove_credit');
Route::post('remove_retailer',[DsrController::class,'RemoveRetailer'])->name('remove_retailer');
Route::post('remove_creditCol',[DsrController::class,'RemoveCreditCol'])->name('remove_creditCol');
Route::post('approve_dsr',[DsrController::class,'ApproveDsr'])->name('approve_dsr');
Route::get('reject_approve/{id}',[DsrController::class,'rejectApprove'])->name('reject_approve');

Route::post('inhand_cheques',[DsrController::class,'InhandCheques'])->name('inhand_cheques');
Route::post('credit_items',[DsrController::class,'CreditItems'])->name('credit_items');
Route::post('creditcol_items',[DsrController::class,'CreditCollectionItems'])->name('creditcol_items');

Route::get('search_pending_dsr',[DsrController::class,'SearchPendingDsr'])->name('search_pending_dsr');
Route::get('/complete_dsr',[DsrController::class,'CompleteDsr']);
Route::get('search_complete_dsr',[DsrController::class,'SearchCompleteDsr'])->name('search_complete_dsr');


//Report
// Route::get('/sales_summery',[ReportController::class,'SalesReport']);
Route::get('/collection',[ReportController::class,'Collection']);
Route::get('search_collection',[ReportController::class,'SearchCollection']);
Route::get('/additional_details',[ReportController::class,'AdditionalDetails']);
Route::post('/get_additional_data',[ReportController::class,'getAdditionalData']);