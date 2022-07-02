<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\DsrController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;

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

Route::get('/', function () {
    return view('admin.index');
});

//Dashboard
Route::get('/dashboard',[DashboardController::class,'Dashboard']);

//User
Route::get('/user',[UserController::class,'user']);

//Item
Route::get('/item',[ItemController::class,'item']);

//DSR
Route::get('/pending_dsr',[DsrController::class,'PendingDsr']);

Route::get('/complete_dsr',[DsrController::class,'CompleteDsr']);

//Report
Route::get('/sales_summery',[ReportController::class,'SalesSummery']);
Route::get('/collection',[ReportController::class,'Collection']);

