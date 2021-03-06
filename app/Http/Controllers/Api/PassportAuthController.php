<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\DsrReturn;
use App\Models\Item;
use App\Models\Dsr;
use App\Models\Sale;
use App\Models\Credit;
use App\Models\CreditCollection;
use App\Models\RetailerReturn;
use App\Models\banking;
use App\Models\directbanking;
use App\Models\Sums;
use DB;

class PassportAuthController extends Controller
{

   public function MobileLogin(Request $request){
       $request->validate([
           'email' => 'required',
           'password' => 'required',
       ]);
       $user_login = DB::table('users')->where('email', '=', $request->get('email'))->get();
       if(count($user_login) !=0){
           foreach($user_login as $user){
             if(Hash::check($request->get('password'), $user->password)){
                return response()->json(['data' => array('info'=>$user_login,'error'=>null)], 200);
            }else{
                //User name or password is incorrect!
                return response()->json(['data' => array('info'=>[],'error'=>1) ], 200);   
            }
        }
    }else{
        // Please check your credentials!
        return response()->json(['data' => array('info'=>[],'error'=>0) ], 200);   
    }
}



public function MobileUpdatePassword(Request $request){
   $request->validate([
       'user_id' => 'required',
       'email' => 'required',
       'password' => 'required',
   ]);
   //get the new password with hash
   $new_password = HASH::make($request->get('password'));

   $updateUserData = DB::table('users')
   ->where('id','=',$request->get('user_id'))
   ->update([
    'password'=> $new_password
]);

   $user_data = DB::table('users')->where('email', '=', $request->get('email'))->get();
   if($updateUserData){
    return response()->json(['data' => array('info'=>$user_data,'error'=>null)], 200);
}else{
    // Oops.. Error Occured!
 return response()->json(['data' => array('info'=>[],'error'=>0) ], 401); 
}
}



public function MobileGetUserbyId(Request $request){
    $user_data = DB::table('users')->where('id', '=', $request->get('user_id'))->get();
    if($user_data){
        return response()->json(['data' => array('info'=>$user_data,'error'=>null)], 200);
    }else{
    // Oops.. Error Occured!
     return response()->json(['data' => array('info'=>[],'error'=>0) ], 401); 
 }
}



public function MobileGetItems(Request $request){
    $item_data = DB::table('items')->where('status', '=', 1)->get();
    if($item_data){
        return response()->json(['data' => array('info'=>$item_data,'error'=>null)], 200);
    }else{
    // Oops.. Error Occured!
     return response()->json(['data' => array('info'=>[],'error'=>0) ], 401); 
 }
}



public function MobileGetItemsById(Request $request){
    $item_data = DB::table('items')->where('id', '=', $request->get('item_id'))->get();
    if($item_data){
        return response()->json(['data' => array('info'=>$item_data,'error'=>null)], 200);
    }else{
    // Oops.. Error Occured!
     return response()->json(['data' => array('info'=>[],'error'=>0) ], 401); 
 }
}


public function MobileGetItemsByDsrId(Request $request){

    $item_data = DB::table('dsr_stock_items')
    ->join('dsr_stocks','dsr_stock_items.dsr_stock_id','dsr_stocks.id')
    ->join('items','dsr_stock_items.item_id','items.id')
    ->select('items.id', 'items.name')
    ->where('dsr_id', '=', $request->get('dsr_id'))
    ->where('dsr_stocks.status', '=', 1)
    ->where('dsr_stock_items.qty', '!=', 0)
    ->groupBy('items.id')
    ->orderBy('items.name')
    ->get();


    if($item_data){
        return response()->json(['data' => array('info'=>$item_data,'error'=>null)], 200);
    }else{
    // Oops.. Error Occured!
     return response()->json(['data' => array('info'=>[],'error'=>0) ], 401); 
 }
}



public function MobileDsrStockData(Request $request){

    $results = DB::table('dsr_stocks')
    ->join('stocks','dsr_stocks.stock_id','stocks.id')
    ->join('users','dsr_stocks.dsr_id','users.id')
    ->select('dsr_stocks.id','dsr_stocks.dsr_id','dsr_stocks.created_at','stocks.stock_name','stocks.stock_name','users.name')
    ->where('dsr_stocks.status','=',0)
    ->where('users.id','=',$request->id)
    ->get();

    return $this->MobileDsrStockDataItem($results);
}


public function MobileDsrStockDataItem($results){
    $allData = [];
    $itemData = [];


    foreach($results as $data){
        $items = DB::table('dsr_stocks')
        ->join('dsr_stock_items','dsr_stocks.id','dsr_stock_items.dsr_stock_id')
        ->join('items','dsr_stock_items.item_id','items.id')
        ->select('dsr_stock_items.id','dsr_stock_items.item_id','items.name','dsr_stock_items.qty')
        ->where('dsr_stocks.status','=',0)
        ->where('dsr_stock_items.dsr_stock_id','=',$data->id)
        ->get();

        array_push($itemData, $items);
    }


    for ($x = 0; $x < count($results); $x++) {
        $allData[] = (object) ['bulk_id' => $results{$x}->id,'bulk_created_at' => $results{$x}->created_at,'items'=>$itemData[$x]];
    }

    return response()->json(['data' => array('info'=>$allData,'error'=>null)],200);
}


public function MobileGetDsrStockIds(Request $request){
 $allData = [];
 $itemData = [];

 $stock_data = DB::table('dsr_stocks')->select('id')->where('dsr_id','=',$request->get('dsr_id'))->where('status', '=', 1)->get();

 foreach($stock_data as $sd){
    $stock_item_data = DB::table('dsr_stock_items')
    ->join('dsr_stocks','dsr_stock_items.dsr_stock_id','dsr_stocks.id')
    ->select('qty')
    ->where('item_id', '=', $request->get('item_id'))
    ->where('dsr_stocks.id', '=', $sd->id)
    ->where('dsr_stocks.status', '=', 1)
    ->where('dsr_stock_items.qty', '!=', 0)
    ->get();

    array_push($itemData, $stock_item_data);
    
}

for ($x = 0; $x < count($stock_data); $x++) {
    if(isset($itemData[$x][0]->qty)){
        $allData[] = (object) ['stock_id' => $stock_data{$x}->id, 'qty' => $itemData[$x][0]->qty];
    }
}

return response()->json(['data' => array('info'=>$allData,'error'=>null)],200);
}



public function MobileAddDsrReturnData(Request $request){

 $dsr_return = new DsrReturn;
 $dsr_return->dsr_stock_id = $request->get('dsr_stock_id');
 $dsr_return->dsr_id = $request->get('dsr_id');
 $dsr_return->item_id = $request->get('item_id');
 $dsr_return->qty = $request->get('qty');
 $dsr_return->status = 0;
 $dsr_return->save();

 if($dsr_return){
    return response()->json(['data' => array('info'=>$dsr_return,'error'=>null)],200);
}else{
    return response()->json(['data' => array('info'=>[],'error'=>null)],401);
}

}


public function MobileGetDsrReturnData(Request $request){

    $dsr_return = DB::table('dsr_returns')
    ->select('id','item_id',DB::raw('sum(qty) as qty_sum'))
    ->where('status','=',0)
    ->where('dsr_id','=',$request->get('dsr_id'))
    ->where('dsr_stock_id','=',$request->get('dsr_stock_id'))
    ->where('item_id','=',$request->get('item_id'))
    ->groupBy('item_id')
    ->get();

    if($dsr_return){
        return response()->json(['data' => array('info'=>$dsr_return,'error'=>null)],200);
    }else{
        return response()->json(['data' => array('info'=>[],'error'=>null)],401);
    }

}



public function MobileUpdateStockStatus(Request $request){

    $updateUserData = DB::table('dsr_stocks')
    ->where('id','=',$request->get('stock_id'))
    ->update([
        'status'=> $request->get('stock_status')
    ]);

    return response()->json(['data' => array('info'=>$updateUserData,'error'=>null)],200);
}


public function MobileGetItemCount(Request $request){

    $stock_item_data = DB::table('dsr_stock_items')
    ->join('dsr_stocks','dsr_stock_items.dsr_stock_id','dsr_stocks.id')
    ->select('item_id', DB::raw('sum(qty) as qty_sum'))
    ->where('dsr_id', '=', $request->get('dsr_id'))
    ->where('dsr_stocks.status', '=', 1)
    ->groupBy('item_id')
    ->get();

    return response()->json(['data' => array('info'=>$stock_item_data,'error'=>null)],200);
}



public function MobileDsrSales(Request $request){
    $dsrId = $request->get('dsr_id');
    $saleItems = $request->get('sales');
    date_default_timezone_set("Asia/colombo");
    $todayDate = date('Y-m-d');
    $saleSum = 0;

    foreach($saleItems as $sale){
        $sales = new Sale([
            'item_id'=>$sale['itemId'],
            'item_name'=>$sale['itemName'],
            'item_qty'=>$sale['itemQty'],
            'item_amount'=>$sale['itemPrice'],
            'dsr_id'=>$dsrId
        ]);
        $sales->save();

        //cal sum
        $saleSum += floatval($sale['itemQty']) * floatval($sale['itemPrice']);

          // update dsr stock (-)
        $update_dsr_qty = DB::table('dsr_stock_items')->where('item_id','=',$sale['itemId'])->where('dsr_stock_id','=',$sale['dsrStockId'])->decrement('qty', $sale['itemQty']);
    }

    // check if there is data in pending sum table for dsr today
    $psum = DB::table('pending_sum')->select('dsr_id','date')->where('dsr_id', '=', $dsrId)->where('date', '=', $todayDate)->get();

    if(count($psum)==0){
        // insert
        DB::insert('insert into pending_sum (dsr_id, date,sales_sum) values (?,?,?)', array($dsrId, $todayDate, $saleSum));
    }else{
        // update
        DB::update('update pending_sum set sales_sum = sales_sum + ? where dsr_id = ? and date = ?', array($saleSum,$dsrId,$todayDate));
    }

    return response()->json(['data' => array('info'=>$saleItems,'error'=>null)],200);
}


public function MobileDsrCredits(Request $request){
    $dsrId = $request->get('dsr_id');
    $creditItems = $request->get('credits');
    date_default_timezone_set("Asia/colombo");
    $todayDate = date('Y-m-d');
    $creditSum = 0;

    foreach($creditItems as $credit){
        $credits = new Credit([
            'credit_customer_name'=>$credit['customerName'],
            'credit_amount'=>$credit['amount'],
            'dsr_id'=>$dsrId,
        ]);
        $credits->save();
        $creditSum += $credit['amount'];
    }

    // check if there is data in pending sum table for dsr today
    $csum = DB::table('pending_sum')->select('dsr_id','date')->where('dsr_id', '=', $dsrId)->where('date', '=', $todayDate)->get();

    if(count($csum)==0){
        // insert
        DB::insert('insert into pending_sum (dsr_id, date,credit_sum) values (?,?,?)', array($dsrId, $todayDate, $creditSum));
    }else{
        // update
        DB::update('update pending_sum set credit_sum = credit_sum + ? where dsr_id = ? and date = ?', array($creditSum,$dsrId,$todayDate));
    }

    return response()->json(['data' => array('info'=>$creditItems,'error'=>null)],200);
}


public function MobileDsrCreditcollections(Request $request){
    $dsrId = $request->get('dsr_id');
    $creditCollectionItems = $request->get('creditcollections');
    date_default_timezone_set("Asia/colombo");
    $todayDate = date('Y-m-d');
    $creditColSum = 0;

    foreach($creditCollectionItems as $cc){
        $credit_collections = new CreditCollection([
            'credit_collection_customer_name'=>$cc['ccName'],
            'credit_collection_amount'=>$cc['ccAmount'],
            'dsr_id'=>$dsrId,
        ]);
        $credit_collections->save();
        $creditColSum += $cc['ccAmount'];
    }

    // check if there is data in pending sum table for dsr today
    $csum = DB::table('pending_sum')->select('dsr_id','date')->where('dsr_id', '=', $dsrId)->where('date', '=', $todayDate)->get();

    if(count($csum)==0){
        // insert
        DB::insert('insert into pending_sum (dsr_id, date,credit_collection_sum) values (?,?,?)', array($dsrId, $todayDate, $creditColSum));
    }else{
        // update
        DB::update('update pending_sum set credit_collection_sum = credit_collection_sum + ? where dsr_id = ? and date = ?', array($creditColSum,$dsrId,$todayDate));
    }

    return response()->json(['data' => array('info'=>$creditCollectionItems,'error'=>null)],200);
}


public function MobileDsrRetialers(Request $request){
    $dsrId = $request->get('dsr_id');
    $retilerItems = $request->get('retilers');
    date_default_timezone_set("Asia/colombo");
    $todayDate = date('Y-m-d');
    $retailerSum = 0;

    foreach($retilerItems as $reit){
        $retailers = new RetailerReturn([
            're_customer_name'=>$reit['reCustomerName'],
            're_item_id'=>$reit['reitemId'],
            're_item_qty'=>$reit['reQuantity'],
            're_item_amount'=>$reit['reAmount'],
            'dsr_id'=>$dsrId,
        ]);
        $retailers->save();
        $retailerSum += floatval($reit['reQuantity']) * floatval($reit['reAmount']);

          // update dsr stock (+)
        $update_item_qty = DB::table('items')->where('id','=',$reit['reitemId'])->increment('qty', $reit['reQuantity']);
    }

    // check if there is data in pending sum table for dsr today
    $csum = DB::table('pending_sum')->select('dsr_id','date')->where('dsr_id', '=', $dsrId)->where('date', '=', $todayDate)->get();

    if(count($csum)==0){
        // insert
        DB::insert('insert into pending_sum (dsr_id, date,retialer_sum) values (?,?,?)', array($dsrId, $todayDate, $retailerSum));
    }else{
        // update
        DB::update('update pending_sum set retialer_sum = retialer_sum + ? where dsr_id = ? and date = ?', array($retailerSum,$dsrId,$todayDate));
    }

    return response()->json(['data' => array('info'=>$retilerItems,'error'=>null)],200);
}


public function MobileDsrBankings(Request $request){
    $dsrId = $request->get('dsr_id');
    $bankingItems = $request->get('bankings');
    date_default_timezone_set("Asia/colombo");
    $todayDate = date('Y-m-d');
    $bankingSum = 0;

    foreach($bankingItems as $banking){
        $bankings = new banking([
            'bank_name'=>$banking['bank'],
            'bank_ref_no'=>$banking['refno'],
            'bank_amount'=>$banking['amount'],
            'dsr_id'=>$dsrId,
        ]);
        $bankings->save();
        $bankingSum += floatval($banking['amount']);
    }

     // check if there is data in pending sum table for dsr today
    $csum = DB::table('pending_sum')->select('dsr_id','date')->where('dsr_id', '=', $dsrId)->where('date', '=', $todayDate)->get();

    if(count($csum)==0){
        // insert
        DB::insert('insert into pending_sum (dsr_id, date,banking_sum) values (?,?,?)', array($dsrId, $todayDate, $bankingSum));
    }else{
        // update
        DB::update('update pending_sum set banking_sum = banking_sum + ? where dsr_id = ? and date = ?', array($bankingSum,$dsrId,$todayDate));
    }

    return response()->json(['data' => array('info'=>$bankingItems,'error'=>null)],200);
}


public function MobileDsrDirectBankings(Request $request){
    $dsrId = $request->get('dsr_id');
    $dbankingItems = $request->get('dbankings');
    date_default_timezone_set("Asia/colombo");
    $todayDate = date('Y-m-d');
    $dbankingSum = 0;

    foreach($dbankingItems as $db){
        $direct_bankings = new directbanking([
            'direct_bank_customer_name'=>$db['customerName'],
            'direct_bank_name'=>$db['bank'],
            'direct_bank_ref_no'=>$db['refno'],
            'direct_bank_amount'=>$db['amount'],
            'dsr_id'=>$dsrId,
        ]);
        $direct_bankings->save();
        $dbankingSum += floatval($db['amount']);
    }

    // check if there is data in pending sum table for dsr today
    $csum = DB::table('pending_sum')->select('dsr_id','date')->where('dsr_id', '=', $dsrId)->where('date', '=', $todayDate)->get();

    if(count($csum)==0){
        // insert
        DB::insert('insert into pending_sum (dsr_id, date,direct_banking_sum) values (?,?,?)', array($dsrId, $todayDate, $dbankingSum));
    }else{
        // update
        DB::update('update pending_sum set direct_banking_sum = direct_banking_sum + ? where dsr_id = ? and date = ?', array($dbankingSum,$dsrId,$todayDate));
    }

    return response()->json(['data' => array('info'=>$dbankingItems,'error'=>null)],200);
}


public function MobileDsrInhands(Request $request){

    date_default_timezone_set("Asia/colombo");
    $todayDate = date('Y-m-d');
    $inhandSum = 0;

    $check_data = DB::table('dsrs')->select('dsr_user_id','in_hand','cash','cheque')->where('dsrs.dsr_user_id', '=', $request->get('dsr_id'))->whereDate('dsrs.created_at', '=', date($todayDate))->get();

    if(count($check_data) == 0){
     $inhand = new Dsr([
        'in_hand' => floatval($request->get('cash')) + floatval($request->get('cheque')),
        'cash' => $request->get('cash'),
        'cheque' => $request->get('cheque'),
        'dsr_user_id' => $request->get('dsr_id'),
    ]);
     $inhand->save();
 }else{

    DB::update('update dsrs set cash = cash+?, cheque = cheque+?, in_hand = in_hand+? WHERE dsr_user_id =?',array($request->get('cash'),$request->get('cheque'),floatval($request->get('cash')) + floatval($request->get('cheque')),$request->get('dsr_id') ));

}


// check if there is data in pending sum table for dsr today
$csum = DB::table('pending_sum')->select('dsr_id','date')->where('dsr_id', '=', $request->get('dsr_id'))->where('date', '=', $todayDate)->get();

if(count($csum)==0){
        // insert
    DB::insert('insert into pending_sum (dsr_id, date,inhand_sum) values (?,?,?)', array($request->get('dsr_id'), $todayDate, floatval($request->get('cash')) + floatval($request->get('cheque'))));
}else{
        // update
    DB::update('update pending_sum set inhand_sum = ? where dsr_id = ? and date = ?', array(floatval($request->get('cash')) + floatval($request->get('cheque')),$request->get('dsr_id'),$todayDate));
}

$array = (object) ['cash' => $request->get('cash'),'cheque' => $request->get('cheque')];

return response()->json(['data' => array('info'=>$array,'error'=>null)],200);
}



public function MobileDsrSumery(Request $request){

 $pdsr = DB::table('pending_sum')
 ->join('users', 'pending_sum.dsr_id', 'users.id')
 ->select('pending_sum.id','pending_sum.dsr_id','users.name','date','inhand_sum','sales_sum','credit_sum','credit_collection_sum','banking_sum','direct_banking_sum','retialer_sum')
 ->where('date', '=', $request->get('date'))
 ->where('pending_sum.dsr_id', '=', $request->get('dsr_id'))
 ->get();


 if($pdsr){
    return response()->json(['data' => array('info'=>$pdsr,'error'=>null)], 200);
}else{
    // Oops.. Error Occured!
 return response()->json(['data' => array('info'=>[],'error'=>0) ], 401); 
}
}



public function MobileGetSaleSumery(Request $request){

 $sale_summery_items = DB::table('sales')
 ->select('item_id','item_qty as qty',DB::raw('sum(item_amount) as sub_total'))
 ->whereDate('created_at', '=', $request->get('date'))
 ->where('dsr_id', '=', $request->get('dsr_id'))
 ->groupBy('item_id')
 ->get();


 if($sale_summery_items){
    return response()->json(['data' => array('info'=>$sale_summery_items,'error'=>null)], 200);
}else{
    // Oops.. Error Occured!
 return response()->json(['data' => array('info'=>[],'error'=>0) ], 401); 
}
}



public function MobileGetInhandSumery(Request $request){

    $inhand_summery_items = DB::table('dsrs')
    ->select('in_hand','cash','cheque')
    ->whereDate('created_at', '=', $request->get('date'))
    ->where('dsr_user_id', '=', $request->get('dsr_id'))
    ->get();


    if($inhand_summery_items){
        return response()->json(['data' => array('info'=>$inhand_summery_items,'error'=>null)], 200);
    }else{
    // Oops.. Error Occured!
     return response()->json(['data' => array('info'=>[],'error'=>0) ], 401); 
 }
}



public function MobileGetBankingSumery(Request $request){

    $bank_summery_items = DB::table('bankings')
    ->select('bank_name','bank_ref_no','bank_amount')
    ->whereDate('created_at', '=', $request->get('date'))
    ->where('dsr_id', '=', $request->get('dsr_id'))
    ->get();


    if($bank_summery_items){
        return response()->json(['data' => array('info'=>$bank_summery_items,'error'=>null)], 200);
    }else{
    // Oops.. Error Occured!
     return response()->json(['data' => array('info'=>[],'error'=>0) ], 401); 
 }
}


public function MobileGetDirectBankingSumery(Request $request){

    $dbank_summery_items = DB::table('directbankings')
    ->select('direct_bank_customer_name','direct_bank_name','direct_bank_ref_no','direct_bank_amount')
    ->whereDate('created_at', '=', $request->get('date'))
    ->where('dsr_id', '=', $request->get('dsr_id'))
    ->get();


    if($dbank_summery_items){
        return response()->json(['data' => array('info'=>$dbank_summery_items,'error'=>null)], 200);
    }else{
    // Oops.. Error Occured!
     return response()->json(['data' => array('info'=>[],'error'=>0) ], 401); 
 }
}



public function MobileGetCreditSumery(Request $request){

    $credit_summery_items = DB::table('credits')
    ->select('credit_customer_name','credit_amount')
    ->whereDate('created_at', '=', $request->get('date'))
    ->where('dsr_id', '=', $request->get('dsr_id'))
    ->get();


    if($credit_summery_items){
        return response()->json(['data' => array('info'=>$credit_summery_items,'error'=>null)], 200);
    }else{
    // Oops.. Error Occured!
     return response()->json(['data' => array('info'=>[],'error'=>0) ], 401); 
 }
}



public function MobileGetCreditColSumery(Request $request){

    $credit_summery_items = DB::table('credit_collections')
    ->select('credit_collection_customer_name','credit_collection_amount')
    ->whereDate('created_at', '=', $request->get('date'))
    ->where('dsr_id', '=', $request->get('dsr_id'))
    ->get();


    if($credit_summery_items){
        return response()->json(['data' => array('info'=>$credit_summery_items,'error'=>null)], 200);
    }else{
    // Oops.. Error Occured!
     return response()->json(['data' => array('info'=>[],'error'=>0) ], 401); 
 }
}





}


