<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\DsrController;
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

Route::get('/send_inventry',[ItemController::class,'SendInventry']);

Route::get('/dsr_receive',[ItemController::class,'DsrReceive']);

Route::get('transfer_status',[ItemController::class,'TransferStatus']);

Route::get('/view_balance',[ItemController::class,'ViewBalance']);

//DSR
Route::get('/pending_dsr',[DsrController::class,'PendingDsr']);

Route::get('/complete_dsr',[DsrController::class,'CompleteDsr']);

//Report
Route::get('/sales_summery',[ReportController::class,'SalesSummery']);
Route::get('/collection',[ReportController::class,'Collection']);

