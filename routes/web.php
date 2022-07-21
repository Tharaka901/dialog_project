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
Route::post('login',[AdminController::class,'Login'])->name('login');
Route::get('logout',[AdminController::class,'Logout'])->name('logout');


//Dashboard
Route::get('/dashboard',[DashboardController::class,'Dashboard'])->name('dashboard');


//User
Route::get('/user',[UserController::class,'user']);
Route::post('user_registration',[UserController::class, 'UserRegistration'])->name('user_registration');
Route::post('get_user',[UserController::class, 'GetUser'])->name('get_user');
Route::post('user_update',[UserController::class, 'UserUpdate'])->name('user_update');
Route::post('delete_user',[UserController::class, 'DeleteUser'])->name('delete_user');


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

Route::get('/view_balance',[StockController::class,'ViewBalance'])->name('view_balance');
Route::post('/get_view_balance',[StockController::class,'GetStockItemsById'])->name('get_view_balance');


//DSR
Route::get('/pending_dsr',[DsrController::class,'PendingDsr']);
Route::post('dsr_save',[DsrController::class,'DsrSave'])->name('dsr_save');
Route::post('get_dsr',[DsrController::class,'GetDsr'])->name('get_dsr');
Route::post('approve_dsr',[DsrController::class,'ApproveDsr'])->name('approve_dsr');


Route::get('/complete_dsr',[DsrController::class,'CompleteDsr']);


//Report
Route::get('/sales_summery',[ReportController::class,'SalesSummery']);
Route::get('/collection',[ReportController::class,'Collection']);