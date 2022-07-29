<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;
use Alert;
use App\Models\DSR;
use App\Models\Sale;
use App\Models\Credit;
use App\Models\CreditCollection;
use App\Models\RetailerReturn;
use App\Models\banking;
use App\Models\directbanking;
use App\Models\Sums;


class DsrController extends Controller
{
    public function PendingDsr(){

        date_default_timezone_set("Asia/colombo");
        $todayDate = date('Y-m-d');

        $pdsr = DB::table('pending_sum')
        ->join('users', 'pending_sum.dsr_id', 'users.id')
        ->select('pending_sum.id','pending_sum.dsr_id','users.name','date','inhand_sum','sales_sum','credit_sum','credit_collection_sum','banking_sum','direct_banking_sum','retialer_sum','status')
        ->where('date', '=', $todayDate)
        ->where('pending_sum.status', '=', 0)->orWhere('pending_sum.status', '=', 1)->paginate(5);

        return view('admin.dsr.pending_dsr',["dsrData"=>$pdsr]);
    }



    public function GetDsr(Request $request)
    {

        $data = [];

        $sales = DB::table('sales')
        ->select('sales.id','sales.item_name','sales.item_qty','sales.item_amount')
        ->where('sales.status', '=', 1)
        ->where('sales.dsr_id',$request->id)
        ->get();

        $inhand = DB::table('dsrs')
        ->select('dsrs.id','dsrs.in_hand','dsrs.cash','dsrs.cheque')
        ->where('dsrs.status', '=', 1)
        ->where('dsrs.dsr_user_id',$request->id)
        ->get();

        $credit = DB::table('credits')
        ->select('credits.id','credits.credit_customer_name','credits.credit_amount')
        ->where('credits.status', '=', 1)
        ->where('credits.dsr_id',$request->id)
        ->get();

        $creditCollection = DB::table('credit_collections')
        ->select('id','credit_collection_customer_name','credit_collection_amount')
        ->where('status', '=', 1)
        ->where('dsr_id',$request->id)
        ->get();

        $retailer = DB::table('retailer_returns')
        ->join('items','retailer_returns.re_item_id','items.id')
        ->select('retailer_returns.id','retailer_returns.re_item_id','items.name','re_customer_name','re_item_qty','re_item_amount')
        ->where('retailer_returns.status', '=', 1)
        ->where('dsr_id',$request->id)
        ->get();

        $bank = DB::table('bankings')
        ->select('id','bank_name','bank_ref_no','bank_amount')
        ->where('status', '=', 1)
        ->where('dsr_id',$request->id)
        ->get();

        $direct_bank = DB::table('directbankings')
        ->select('id','direct_bank_customer_name','direct_bank_name','direct_bank_ref_no','direct_bank_amount')
        ->where('status', '=', 1)
        ->where('dsr_id',$request->id)
        ->get();

        $data["saleData"] = $sales;
        $data["inhandData"] = $inhand;
        $data["creditData"] = $credit;
        $data["creditcolData"] = $creditCollection;
        $data["reData"] = $retailer;
        $data["bankData"] = $bank;
        $data["directbankData"] = $direct_bank;

        return response($data);
    }


    public function ApproveDsr(Request $request){

       $inHandTable = json_decode($request->get('inHandTable'),true);
       $saleTable = json_decode($request->get('saleTable'),true);
       $creditTable = json_decode($request->get('creditTable'),true);
       $creditCollectionTable = json_decode($request->get('creditCollectionTable'),true);
       $retailerTable = json_decode($request->get('retailerTable'),true);
       $bankingTable = json_decode($request->get('bankingTable'),true);
       $directBankingTable = json_decode($request->get('directBankingTable'),true);


       foreach($inHandTable as $inhand){
        $dsr = DB::table('dsrs')
        ->where('id','=',$inhand['id'])
        ->update([
         'in_hand' => floatval($inhand['cash']) + floatval($inhand['cheque']),
         'cash' => $inhand['cash'],
         'cheque' => $inhand['cheque'],
     ]);
    }


    foreach($saleTable as $sale){
        $sale = DB::table('sales')
        ->where('id','=',$sale['id'])
        ->update([
         'item_name'=>$sale['itemName'],
         'item_qty'=>$sale['itemQty'],
         'item_amount'=>$sale['itemPrice'],
           // 'status'=>2,
     ]);
    }

    foreach($creditTable as $credit){
     $credit = DB::table('credits')
     ->where('id','=',$credit['id'])
     ->update([
        'credit_customer_name'=>$credit['customerName'],
        'credit_amount'=>$credit['amount'],
    ]);
 }

 foreach($creditCollectionTable as $cc){
    $creditcol = DB::table('credit_collections')
    ->where('id','=',$cc['id'])
    ->update([
        'credit_collection_customer_name'=>$cc['ccName'],
        'credit_collection_amount'=>$cc['ccAmount'],
    ]);
}

foreach($retailerTable as $retailer){
   $retailers = DB::table('retailer_returns')
   ->where('id','=',$retailer['id'])
   ->update([
    're_customer_name'=>$retailer['reCustomerName'],
    're_item_id'=>$retailer['reitemId'],
    're_item_qty'=>$retailer['reQuantity'],
    're_item_amount'=>$retailer['reAmount'],
]);
}

foreach($bankingTable as $banking){
    $bankings = DB::table('bankings')
    ->where('id','=',$banking['id'])
    ->update([
        'bank_name'=>$banking['bank'],
        'bank_ref_no'=>$banking['refno'],
        'bank_amount'=>$banking['amount'],
        // 'status'=>2,
    ]);
}

foreach($directBankingTable as $db){
    $direct_bankings = DB::table('directbankings')
    ->where('id','=',$db['id'])
    ->update([
       'direct_bank_customer_name'=>$db['customerName'],
       'direct_bank_name'=>$db['bank'],
       'direct_bank_ref_no'=>$db['refno'],
       'direct_bank_amount'=>$db['amount'],
   ]);
}

$updateItemData = DB::table('pending_sum')
->where('id','=',$request->get('pending_sum_id'))
->update([
    'status'=>2,
]);

return response($inHandTable);


}



public function CompleteDsr(){

    date_default_timezone_set("Asia/colombo");
    $todayDate = date('Y-m-d');

    $pdsr = DB::table('pending_sum')
    ->join('users', 'pending_sum.dsr_id', 'users.id')
    ->select('pending_sum.id','pending_sum.dsr_id','users.name','date','inhand_sum','sales_sum','credit_sum','credit_collection_sum','banking_sum','direct_banking_sum','retialer_sum')
    ->where('date', '=', $todayDate)
    ->where('pending_sum.status', '=', 2)->paginate(5);

    return view('admin.dsr.complete_dsr',["dsrData"=>$pdsr]);
}



}
