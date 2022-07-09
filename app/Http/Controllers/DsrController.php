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


class DsrController extends Controller
{
    public function PendingDsr(){
        // $sales = DSR::all();
        // dd($sales);

        $pdsr = DB::table('dsrs')
        ->join('sales', 'dsrs.id', '=', 'sales.dsr_id')
        ->join('credits', 'dsrs.id', '=', 'credits.dsr_id')
        ->join('credit_collections', 'dsrs.id', '=', 'credit_collections.dsr_id')
        ->join('retailer_returns', 'dsrs.id', '=', 'retailer_returns.dsr_id')
        ->join('bankings', 'dsrs.id', '=', 'bankings.dsr_id')
        ->join('directbankings', 'dsrs.id', '=', 'directbankings.dsr_id')
        ->join('users', 'dsrs.id', '=', 'users.id')
        ->select('dsrs.id',
            'dsrs.created_at',
            'dsrs.in_hand',
            'users.name',
            DB::raw('SUM(sales.item_amount) as salesum'),
            DB::raw('SUM(bankings.bank_amount) as banksum'),
            DB::raw('SUM(directbankings.direct_bank_amount) as dbsum'),
            DB::raw('SUM(credits.credit_amount) as csum'),
            DB::raw('SUM(retailer_returns.re_item_amount) as resum'),
            DB::raw('SUM(credit_collections.credit_collection_amount) as ccsum')
        )
        ->where('dsrs.status', '=', 1)
        ->orderBy('dsrs.id','desc')
        ->groupBy('dsrs.id')
        ->groupBy('sales.dsr_id')
        ->paginate(5);

        return view('admin.dsr.pending_dsr',["dsrData"=>$pdsr]);
    }

    public function DsrSave(Request $request){

        $last_id = 0;
        $inHandTable = json_decode($request->get('inHandTable'),true);
        $saleTable = json_decode($request->get('saleTable'),true);
        $creditTable = json_decode($request->get('creditTable'),true);
        $creditCollectionTable = json_decode($request->get('creditCollectionTable'),true);
        $retailerTable = json_decode($request->get('retailerTable'),true);
        $bankingTable = json_decode($request->get('bankingTable'),true);
        $directBankingTable = json_decode($request->get('directBankingTable'),true);

        foreach($inHandTable as $inhand){
            $inhand = new Dsr([
                'in_hand' => $inhand['inHand'],
                'cash' => $inhand['cash'],
                'cheque' => $inhand['cheque'],
            ]);
            $inhand->save();
            $last_id = $inhand->id;
        }

        foreach($saleTable as $sale){
            $sales = new Sale([
                'item_name'=>$sale['itemName'],
                'item_qty'=>$sale['itemQty'],
                'item_amount'=>$sale['itemPrice'],
                'dsr_id'=>$last_id,
            ]);
            $sales->save();
        }

        foreach($creditTable as $credit){
            $credits = new Credit([
                'credit_customer_name'=>$credit['customerName'],
                'credit_amount'=>$credit['amount'],
                'dsr_id'=>$last_id,
            ]);
            $credits->save();
        }

        foreach($creditCollectionTable as $cc){
            $credit_collections = new CreditCollection([
                'credit_collection_customer_name'=>$cc['ccName'],
                'credit_collection_amount'=>$cc['ccAmount'],
                'dsr_id'=>$last_id,
            ]);
            $credit_collections->save();
        }

        foreach($retailerTable as $retailer){
            $retailers = new RetailerReturn([
                're_customer_name'=>$retailer['reCustomerName'],
                're_item_name'=>$retailer['reitemName'],
                're_item_qty'=>$retailer['reQuantity'],
                're_item_amount'=>$retailer['reAmount'],
                'dsr_id'=>$last_id,
            ]);
            $retailers->save();
        }

        foreach($bankingTable as $banking){
            $bankings = new banking([
                'bank_name'=>$banking['bank'],
                'bank_ref_no'=>$banking['refno'],
                'bank_amount'=>$banking['amount'],
                'dsr_id'=>$last_id,
            ]);
            $bankings->save();
        }

        foreach($directBankingTable as $db){
            $direct_bankings = new directbanking([
                'direct_bank_customer_name'=>$db['customerName'],
                'direct_bank_name'=>$db['bank'],
                'direct_bank_ref_no'=>$db['refno'],
                'direct_bank_amount'=>$db['amount'],
                'dsr_id'=>$last_id,
            ]);
            $direct_bankings->save();
        }

        return response($last_id);
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
        ->select('id','re_customer_name','re_item_name','re_item_qty','re_item_amount')
        ->where('status', '=', 1)
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

        // approved dsr status is 2
        // $approveDsr = DB::table('dsrs')
        // ->where('id','=',$request->id)
        // ->update([
        //     'status'=>2,
        // ]);
        // return response($approveDsr);

     $inHandTable = json_decode($request->get('inHandTable'),true);
     $saleTable = json_decode($request->get('saleTable'),true);
     $creditTable = json_decode($request->get('creditTable'),true);
     $creditCollectionTable = json_decode($request->get('creditCollectionTable'),true);
     $retailerTable = json_decode($request->get('retailerTable'),true);
     $bankingTable = json_decode($request->get('bankingTable'),true);
     $directBankingTable = json_decode($request->get('directBankingTable'),true);


     foreach($inHandTable as $inhand){
        $dsr = DB::table('dsrs')
        ->where('id','=',$request->id)
        ->update([
           'in_hand' => $inhand['inHand'],
           'cash' => $inhand['cash'],
           'cheque' => $inhand['cheque'],
           'status'=>2,
       ]);
    }

    foreach($saleTable as $sale){
        $sale = DB::table('sales')
        ->where('dsr_id','=',$request->id)
        ->update([
           'item_name'=>$sale['itemName'],
           'item_qty'=>$sale['itemQty'],
           'item_amount'=>$sale['itemPrice'],
           // 'status'=>2,
       ]);
    }

    foreach($creditTable as $credit){
       $credit = DB::table('credits')
       ->where('dsr_id','=',$request->id)
       ->update([
        'credit_customer_name'=>$credit['customerName'],
        'credit_amount'=>$credit['amount'],
        // 'status'=>2,
    ]);
   }

   foreach($creditCollectionTable as $cc){
    $creditcol = DB::table('credit_collections')
    ->where('dsr_id','=',$request->id)
    ->update([
        'credit_collection_customer_name'=>$cc['ccName'],
        'credit_collection_amount'=>$cc['ccAmount'],
        // 'status'=>2,
    ]);
}

foreach($retailerTable as $retailer){
 $retailers = DB::table('retailer_returns')
 ->where('dsr_id','=',$request->id)
 ->update([
    're_customer_name'=>$retailer['reCustomerName'],
    're_item_name'=>$retailer['reitemName'],
    're_item_qty'=>$retailer['reQuantity'],
    're_item_amount'=>$retailer['reAmount'],
    // 'status'=>2,
]);
}

foreach($bankingTable as $banking){
    $bankings = DB::table('bankings')
    ->where('dsr_id','=',$request->id)
    ->update([
        'bank_name'=>$banking['bank'],
        'bank_ref_no'=>$banking['refno'],
        'bank_amount'=>$banking['amount'],
        // 'status'=>2,
    ]);
}

foreach($directBankingTable as $db){
    $direct_bankings = DB::table('directbankings')
    ->where('dsr_id','=',$request->id)
    ->update([
     'direct_bank_customer_name'=>$db['customerName'],
     'direct_bank_name'=>$db['bank'],
     'direct_bank_ref_no'=>$db['refno'],
     'direct_bank_amount'=>$db['amount'],
     // 'status'=>2,
 ]);
}

return response($inHandTable);


}



public function CompleteDsr(){

   $viewTable = DB::table('dsrs')
   ->join('sales', 'dsrs.id', '=', 'sales.dsr_id')
   ->join('credits', 'dsrs.id', '=', 'credits.dsr_id')
   ->join('credit_collections', 'dsrs.id', '=', 'credit_collections.dsr_id')
   ->join('retailer_returns', 'dsrs.id', '=', 'retailer_returns.dsr_id')
   ->join('bankings', 'dsrs.id', '=', 'bankings.dsr_id')
   ->join('directbankings', 'dsrs.id', '=', 'directbankings.dsr_id')
   ->join('users', 'dsrs.id', '=', 'users.id')
   ->select('dsrs.id','dsrs.created_at','dsrs.in_hand','dsrs.cash','dsrs.cheque','sales.item_amount','bankings.bank_amount','directbankings.direct_bank_amount','credits.credit_amount','retailer_returns.re_item_amount','credit_collections.credit_collection_amount','users.name')
   ->where('dsrs.status', '=', 2)
   ->orderBy('dsrs.id','desc')
   ->groupBy('dsrs.id')
   ->paginate(1);

   return view('admin.dsr.complete_dsr',["dsrData"=>$viewTable]);
}



}
