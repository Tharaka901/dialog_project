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
Route::post('mobile_getItems_bydsrId',[PassportAuthController::class,'MobileGetItemsByDsrId'])->name('mobile_getItems_bydsrId');
Route::post('mobile_dsr_stock',[PassportAuthController::class,'MobileDsrStockData'])->name('mobile_dsr_stock');
Route::post('mobile_get_dsr_stockIds',[PassportAuthController::class,'MobileGetDsrStockIds'])->name('mobile_get_dsr_stockIds');
Route::post('mobile_add_dsr_return',[PassportAuthController::class,'MobileAddDsrReturnData'])->name('mobile_add_dsr_return');
Route::post('mobile_get_dsr_returndata',[PassportAuthController::class,'MobileGetDsrReturnData'])->name('mobile_get_dsr_returndata');
Route::post('mobile_update_stock_status',[PassportAuthController::class,'MobileUpdateStockStatus'])->name('mobile_update_stock_status');
Route::post('mobile_get_item_count',[PassportAuthController::class,'MobileGetItemCount'])->name('mobile_get_item_count');

Route::post('mobile_dsr_sales',[PassportAuthController::class,'MobileDsrSales'])->name('mobile_dsr_sales');
Route::post('mobile_dsr_credits',[PassportAuthController::class,'MobileDsrCredits'])->name('mobile_dsr_credits');
Route::post('mobile_dsr_creditcollections',[PassportAuthController::class,'MobileDsrCreditcollections'])->name('mobile_dsr_creditcollections');
Route::post('mobile_dsr_retialers',[PassportAuthController::class,'MobileDsrRetialers'])->name('mobile_dsr_retialers');
Route::post('mobile_dsr_bankings',[PassportAuthController::class,'MobileDsrBankings'])->name('mobile_dsr_bankings');
Route::post('mobile_dsr_direct_bankings',[PassportAuthController::class,'MobileDsrDirectBankings'])->name('mobile_dsr_direct_bankings');
Route::post('mobile_dsr_inhands',[PassportAuthController::class,'MobileDsrInhands'])->name('mobile_dsr_inhands');
Route::post('mobile_dsr_summary',[PassportAuthController::class,'MobileDsrSumery'])->name('mobile_dsr_summary');
Route::post('mobile_get_sale_summary',[PassportAuthController::class,'MobileGetSaleSumery'])->name('mobile_get_sale_summary');
Route::post('mobile_get_inhand_summary',[PassportAuthController::class,'MobileGetInhandSumery'])->name('mobile_get_inhand_summary');
Route::post('mobile_get_banking_summary',[PassportAuthController::class,'MobileGetBankingSumery'])->name('mobile_get_banking_summary');
Route::post('mobile_get_direct_banking_summary',[PassportAuthController::class,'MobileGetDirectBankingSumery'])->name('mobile_get_direct_banking_summary');
Route::post('mobile_get_credit_summary',[PassportAuthController::class,'MobileGetCreditSumery'])->name('mobile_get_credit_summary');
Route::post('mobile_get_creditcol_summary',[PassportAuthController::class,'MobileGetCreditColSumery'])->name('mobile_get_creditcol_summary');
Route::post('mobile_get_retailer_summary',[PassportAuthController::class,'MobileGetRetailerSumery'])->name('mobile_get_retailer_summary');
Route::post('mobile_get_summary_status',[PassportAuthController::class,'MobileGetSumeryStatus'])->name('mobile_get_summary_status');
Route::post('mobile_issue_dsr_return',[PassportAuthController::class,'MobileReturnBulkStock'])->name('mobile_issue_dsr_return');
Route::post('mobile_approve_summary',[PassportAuthController::class,'MobileApproveSumery'])->name('mobile_approve_summary');
Route::post('mobile_approve_status',[PassportAuthController::class,'MobileApproveStatus'])->name('mobile_approve_status');

Route::post('mobile_remove_sale_summary',[PassportAuthController::class,'MobileRemoveSaleSummary'])->name('mobile_remove_sale_summary');
Route::post('mobile_remove_banking_summary',[PassportAuthController::class,'MobileRemoveBankingSummary'])->name('mobile_remove_banking_summary');
Route::post('mobile_remove_dbanking_summary',[PassportAuthController::class,'MobileRemoveDBankingSummary'])->name('mobile_remove_dbanking_summary');
Route::post('mobile_remove_credit_summary',[PassportAuthController::class,'MobileRemoveCreditSummary'])->name('mobile_remove_credit_summary');
Route::post('mobile_remove_cc_summary',[PassportAuthController::class,'MobileRemoveCreditColSummary'])->name('mobile_remove_cc_summary');
Route::post('mobile_remove_retailer_summary',[PassportAuthController::class,'MobileRemoveRetailerSummary'])->name('mobile_remove_retailer_summary');

Route::post('mobile_edit_sale_summary',[PassportAuthController::class,'MobileEditSaleSummary'])->name('mobile_edit_sale_summary');
Route::post('mobile_edit_banking_summary',[PassportAuthController::class,'MobileEditBankSummary'])->name('mobile_edit_banking_summary');
Route::post('mobile_edit_dbanking_summary',[PassportAuthController::class,'MobileEditDBankSummary'])->name('mobile_edit_dbanking_summary');
Route::post('mobile_edit_credit_summary',[PassportAuthController::class,'MobileEditCreditSummary'])->name('mobile_edit_credit_summary');
Route::post('mobile_edit_cc_summary',[PassportAuthController::class,'MobileEditCreditColSummary'])->name('mobile_edit_cc_summary');
Route::post('mobile_edit_retailer_summary',[PassportAuthController::class,'MobileEditRetailerSummary'])->name('mobile_edit_retailer_summary');

Route::post('mobile_banks',[PassportAuthController::class,'MobileBanks'])->name('mobile_banks');
