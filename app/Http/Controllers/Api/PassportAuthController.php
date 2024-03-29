<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\DsrReturn;
use App\Models\Item;
use App\Models\Dsr;
use App\Models\DrsCheque;
use App\Models\Sale;
use App\Models\Credit;
use App\Models\CreditItem;
use App\Models\CreditCollection;
use App\Models\CreditCollectionItem;
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
       $user_login = DB::table('users')->where('email', '=', $request->get('email'))->where('status','=',1)->get();
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
        ->where('dsr_stock_items.qty','!=',0)
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
 $dsr_return->dsr_id = $request->get('dsr_id');
 $dsr_return->item_id = $request->get('item_id');
 $dsr_return->qty = $request->get('qty');
 $dsr_return->status = 0;
 $dsr_return->save();

 foreach($request->get('dsr_stock_ids') as $ids){
    DB::insert('insert into dsr_retun_no (dsr_return_id, dsr_stock_id) values (?,?)', array($dsr_return->id, $ids['id']));
}



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


    $dsr_stock_items = DB::table('dsr_stock_items')
    ->select('item_id','qty')
    ->where('dsr_stock_id', '=', $request->get('stock_id'))
    ->get();

    if($request->get('stock_status') == 1){
     foreach($dsr_stock_items as $item){
        $update_item_qty = DB::table('items')->where('id','=',$item->item_id)->decrement('qty', $item->qty); 
    }
}


return response()->json(['data' => array('info'=>$updateUserData,'error'=>null)],200);
}


public function MobileGetItemCount(Request $request){

    $allData = [];

    $stock_item_data = DB::table('dsr_stock_items')
    ->join('dsr_stocks','dsr_stock_items.dsr_stock_id','dsr_stocks.id')
    ->leftjoin('dsr_returns','dsr_stock_items.item_id','dsr_returns.item_id')
    ->select('dsr_stock_items.item_id')
    ->where('dsr_stocks.dsr_id', '=', $request->get('dsr_id'))
    ->where('dsr_stocks.status', '=', 1)
    ->groupBy('dsr_stock_items.item_id')
    ->get();


    $stock_qty_sum = DB::table('dsr_stock_items')
    ->join('dsr_stocks','dsr_stock_items.dsr_stock_id','dsr_stocks.id')
    ->select(DB::raw('sum(dsr_stock_items.qty) as qty_sum'))
    ->where('dsr_stocks.dsr_id', '=', $request->get('dsr_id'))
    ->where('dsr_stocks.status', '=', 1)
    ->groupBy('dsr_stock_items.item_id')
    ->get();

    $srqs = [];
    foreach($stock_item_data as $sid){
       $stock_return_qty_sum = DB::table('dsr_returns')
       ->select(DB::raw('sum(dsr_returns.qty) as return_qty'))
       ->where('dsr_id', '=', $request->get('dsr_id'))
       ->where('item_id', '=', $sid->item_id)
       ->where('status','=',0)
       ->get();
       $srqs[] = $stock_return_qty_sum;
   }



   for ($x = 0; $x < count($stock_item_data); $x++) {
    $allData[] = (object) ['item_id' => $stock_item_data{$x}->item_id, "qty_sum" => $stock_qty_sum[$x]->qty_sum, "return_qty" => $srqs[$x][0]->return_qty];
}

return response()->json(['data' => array('info'=>$allData,'error'=>null)],200);
}





public function MobileDsrSales(Request $request){
    $dsrId = $request->get('dsr_id');
    $saleItems = $request->get('sales');
    $saleDate = $request->get('date');
    date_default_timezone_set("Asia/colombo");
    $todayDate = date('Y-m-d');
    $todayTime = date('h:i:s a');
    $saleSum = 0;
    $can_deduct = 0;
    $deduct_stock = 0;
    $deduct_qty = 0;
    $stock_qty = 0;
    $balance_stock = 0;
    $updated_id = 0;
    $item_exist = 0;
    $sum_id = 0;
    $sale_id = 0;

    foreach($saleItems as $sale){

          //cal sum
        $saleSum = floatval($sale['itemQty']) * floatval($sale['itemPrice']);


           // check if there is data in pending sum table for dsr today
        $psum = DB::table('pending_sum')->select('id','dsr_id','date')->where('dsr_id', '=', $dsrId)->where('date', '=', $saleDate)->get();
        $pstatus = DB::table('pending_sum_status')->select('dsr_id','date')->where('dsr_id', '=', $dsrId)->where('date', '=', $saleDate)->get();

        if(count($psum)==0){
        // insert
            $pendingSum = DB::insert('insert into pending_sum (dsr_id, date,sales_sum) values (?,?,?)', array($dsrId, $saleDate, $saleSum));
            $sum_id = DB::table('pending_sum')->latest('id')->first();

        }else{
        // update
            DB::update('update pending_sum set sales_sum = sales_sum + ? where dsr_id = ? and date = ?', array($saleSum,$dsrId,$saleDate));

            foreach($psum as $sum){
             $sum_id = $sum;
         }
     }



     if(count($pstatus)==0){
        // insert
        DB::insert('insert into pending_sum_status (sum_id, dsr_id, date,sales_sum) values (?,?,?,?)', array($sum_id->id,$dsrId, $saleDate, 1));
    }else{
        // update
        DB::update('update pending_sum_status set sales_sum = ? where dsr_id = ? and date = ?', array(1,$dsrId,$saleDate));
    }



    $sale_dsr_items = DB::table('sales')
    ->join('pending_sum','pending_sum.id','sales.sum_id','sales.stock_id')
    ->where('sum_id','=',$sum_id->id)
    ->where('sales.dsr_id','=',$dsrId)
    ->where('sales.status','!=',0)
    ->get();

    // $sale_dsr_items = DB::table('sales')
    // ->select('sum_id','created_at','status')
    // ->where('sum_id','=',$sum_id->id)
    // ->where('created_at','=',$saleDate)
    // ->where('status','!=',0)
    // ->get();


    foreach($sale_dsr_items as $sitems){
        // print_r($sitems->item_id ."----". $sale['itemId'].",");
        if($sitems->item_id == $sale['itemId']){
            $item_exist = 1;
            // break;
        }else{
           $item_exist = 0;
       }
   }

    // print_r($item_exist."---");   0 1 1 1
   if($item_exist == 0){

    $sales = new Sale([
        'item_id'=>$sale['itemId'],
        'item_name'=>$sale['itemName'],
        'item_qty'=>$sale['itemQty'],
        'item_amount'=>$sale['itemPrice'],
        'stock_balance'=>0,
        'sum_id'=>$sum_id->id,
        'dsr_id'=>$dsrId,
        'created_at'=>$saleDate." ".$todayTime
    ]);
    $sales->save();
    $sale_id = $sales->id;

}else{
    print_r("asdasd");
    DB::update('update sales set item_qty = item_qty + ? where item_id = ? and dsr_id = ?', array($sale['itemQty'],$sale['itemId'],$dsrId));
}






        /////////////////////////////////////////////////

foreach($sale['dsrStockIds'] as $ids){

    $stock_items_data = DB::table('dsr_stock_items')
    ->rightjoin('dsr_stocks' ,'dsr_stock_items.dsr_stock_id' ,'dsr_stocks.id')
    ->select('dsr_stock_items.id','dsr_stock_id','item_id','qty')
    ->where('dsr_stock_items.dsr_stock_id','=',$ids['id'])
    ->where('dsr_stock_items.item_id','=',$sale['itemId'])
        // ->whereDate('dsr_stocks.created_at', '=', $saleDate)
    ->get();

    foreach($stock_items_data as $sid){
        $stock_qty += $sid->qty;
        if($sid->qty >=  $sale['itemQty']){
            $can_deduct = 1;
            $deduct_stock = $sid->id;
            $deduct_qty = $sid->qty;
            break;
        }
    }
}


if($can_deduct != 0){
        // update dsr stock (-)
    $update_dsr_qty = DB::table('dsr_stock_items')->where('id','=',$deduct_stock)->decrement('qty', $sale['itemQty']);

    DB::update('update dsr_stock_items set sale_qty = sale_qty + ? where id = ?', array($sale['itemQty'],$deduct_stock));
    DB::update('update sales set stock_id = ? where id = ?', array($deduct_stock,$sale_id));


}else{


 if($stock_qty > $sale['itemQty']) {
    $count = 0;

    foreach($sale['dsrStockIds'] as $stock_ids){
        $stock_items_data1 = DB::table('dsr_stock_items')
        ->join('dsr_stocks' ,'dsr_stock_items.dsr_stock_id' ,'dsr_stocks.id')
        ->select('dsr_stock_items.id','dsr_stock_id','item_id','qty')
        ->where('dsr_stock_items.dsr_stock_id','=',$stock_ids['id'])
        ->where('dsr_stock_items.item_id','=',$sale['itemId'])
            // ->whereDate('dsr_stocks.created_at', '=', $saleDate)
        ->get();

        foreach($stock_items_data1 as $sid1){
            $count++;
            $updated_id = $sid1->id;

            DB::update('update dsr_stock_items set sale_qty = sale_qty + ? where id = ?', array($sid1->qty,$sid1->id) );
            DB::update('update sales set stock_id = ? where id = ?', array($deduct_stock,$sale_id));

                    // set 0 to every primary key to set the actual blance by calculating
            DB::update('update dsr_stock_items set qty =  0 where id = ?', array($sid1->id));
        }

        if($count == 1){
           $balance_stock = $sale['itemQty'] - $sid1->qty;
       }else {
        $balance_stock = $balance_stock - $sid1->qty;
    }

}
        // set the actual balance in db
DB::update('update dsr_stock_items set qty =  ? where id = ?', array(abs($balance_stock),$updated_id));
DB::update('update dsr_stock_items set sale_qty = ? where id = ?', array(abs($balance_stock),$updated_id));

}

}
        /////////////////////////////////////////////////
}



return response()->json(['data' => array('info'=>$saleItems,'error'=>null)],200);
}




public function MobileDsrCredits(Request $request)
{
    date_default_timezone_set("Asia/colombo");

    $dsrId = $request->get("dsr_id");
    $todayDate = $request->get("date");
    $credits = $request->get("credits");
    $creditItems = $request->get("items");
    $creditSum = 0;
    $sum_id = 0;

        // check if there is data in pending sum table for dsr today
    $crsum = DB::table("pending_sum")
    ->select("id", "dsr_id", "date")
    ->where("dsr_id", "=", $dsrId)
    ->where("date", "=", $todayDate)
    ->get();
    $pstatus = DB::table("pending_sum_status")
    ->select("dsr_id", "date")
    ->where("dsr_id", "=", $dsrId)
    ->where("date", "=", $todayDate)
    ->get();

    foreach ($credits as $credit) {
        $creditSum += $credit["amount"];
    }

    if (count($crsum) == 0) {
            // insert
        DB::insert(
            "insert into pending_sum (dsr_id, date, credit_sum) values (?,?,?)",
            [$dsrId, $todayDate, $creditSum]
        );
        $sum_id = DB::table("pending_sum")
        ->latest("id")
        ->first();
    } else {
            // update
        DB::update(
            "update pending_sum set credit_sum = credit_sum + ? where dsr_id = ? and date = ?",
            [$creditSum, $dsrId, $todayDate]
        );
        foreach ($crsum as $sum) {
            $sum_id = $sum;
        }
    }

    if (count($pstatus) == 0) {
            // insert
        DB::insert(
            "insert into pending_sum_status (sum_id, dsr_id, date, credit_sum) values (?,?,?,?)",
            [$sum_id->id, $dsrId, $todayDate, 1]
        );
    } else {
            // update
        DB::update(
            "update pending_sum_status set credit_sum = ? where dsr_id = ? and date = ?",
            [1, $dsrId, $todayDate]
        );
    }

    foreach ($credits as $credit) {
        $credits = new Credit([
            "credit_customer_name" => $credit["customerName"],
            "credit_amount" => $credit["amount"],
            "sum_id" => $sum_id->id,
            "dsr_id" => $dsrId,
        ]);
        $credits->save();

        foreach ($credit["items"] as $citem) {
            $credit_items = new CreditItem([
                "credit_id" => $credits->id,
                "item_id" => $citem["item_id"],
                "item_price" => $citem["price"],
            ]);
            $credit_items->save();
        }
    }

    return response()->json(
        ["data" => ["info" => $credits, "error" => null]],
        200
    );
}

public function MobileDsrCreditcollections(Request $request)
{
    date_default_timezone_set("Asia/colombo");

    $dsrId = $request->get("dsr_id");
    $todayDate = $request->get("date");
    $creditcollections = $request->get("creditcollections");
    $creditColSum = 0;
    $sum_id = 0;

        // check if there is data in pending sum table for dsr today
    $csum = DB::table("pending_sum")
    ->select("id", "dsr_id", "date")
    ->where("dsr_id", "=", $dsrId)
    ->where("date", "=", $todayDate)
    ->get();
    $pstatus = DB::table("pending_sum_status")
    ->select("dsr_id", "date")
    ->where("dsr_id", "=", $dsrId)
    ->where("date", "=", $todayDate)
    ->get();

    foreach ($creditcollections as $cc) {
        $creditColSum += $cc["ccAmount"];
    }

    if (count($csum) == 0) {
            // insert
        DB::insert(
            "insert into pending_sum (dsr_id, date, credit_collection_sum) values (?,?,?)",
            [$dsrId, $todayDate, $creditColSum]
        );
        $sum_id = DB::table("pending_sum")
        ->latest("id")
        ->first();
    } else {
            // update
        DB::update(
            "update pending_sum set credit_collection_sum = credit_collection_sum + ? where dsr_id = ? and date = ?",
            [$creditColSum, $dsrId, $todayDate]
        );
        foreach ($csum as $sum) {
            $sum_id = $sum;
        }
    }

    if (count($pstatus) == 0) {
            // insert
        DB::insert(
            "insert into pending_sum_status (sum_id,dsr_id, date,credit_collection_sum) values (?,?,?,?)",
            [$sum_id->id, $dsrId, $todayDate, 1]
        );
    } else {
            // update
        DB::update(
            "update pending_sum_status set credit_collection_sum = ? where dsr_id = ? and date = ?",
            [1, $dsrId, $todayDate]
        );
    }

        // CreditCollectionItem

    foreach ($creditcollections as $cc) {
        $credit_collections = new CreditCollection([
            "credit_collection_customer_name" => $cc["ccName"],
            "credit_collection_amount" => $cc["ccAmount"],
            "sum_id" => $sum_id->id,
            "dsr_id" => $dsrId,
        ]);
        $credit_collections->save();

        foreach ($cc["items"] as $ccitem) {
            $credit_items = new CreditCollectionItem([
                "credit_collection_id" => $credit_collections->id,
                "item_id" => $ccitem["item_id"],
                "item_price" => $ccitem["price"],
            ]);
            $credit_items->save();
        }
    }

    return response()->json(
        ["data" => ["info" => $creditcollections, "error" => null]],
        200
    );
}



public function MobileDsrRetialers(Request $request){
    $dsrId = $request->get('dsr_id');
    $retilerItems = $request->get('retilers');
    date_default_timezone_set("Asia/colombo");
    // $todayDate = date('Y-m-d');
    $todayDate = $request->get('date');
    $retailerSum = 0;
    $qty = 0;
    $id = 0;
    $stock_id = 0;
    $sum_id = 0;

    foreach($retilerItems as $reit){

            // check if there is data in pending sum table for dsr today
        $rsum = DB::table('pending_sum')->select('id','dsr_id','date')->where('dsr_id', '=', $dsrId)->where('date', '=', $todayDate)->get();
        $pstatus = DB::table('pending_sum_status')->select('dsr_id','date')->where('dsr_id', '=', $dsrId)->where('date', '=', $todayDate)->get();

        if(count($rsum)==0){
        // insert
            DB::insert('insert into pending_sum (dsr_id, date) values (?,?)', array($dsrId, $todayDate));
            $sum_id = DB::table('pending_sum')->latest('id')->first();
        }else{
        // update
            DB::update('update pending_sum set retialer_sum = retialer_sum + ? where dsr_id = ? and date = ?', array($retailerSum,$dsrId,$todayDate));
            foreach($rsum as $sum){
             $sum_id = $sum;
         }
     }



     if(count($pstatus)==0){
        // insert
        DB::insert('insert into pending_sum_status (sum_id, dsr_id, date,retialer_sum) values (?,?,?,?)', array($sum_id->id, $dsrId, $todayDate, 1));
    }else{
        // update
      DB::update('update pending_sum_status set retialer_sum = ? where dsr_id = ? and date = ?', array(1,$dsrId,$todayDate));
  }


  $retailers = new RetailerReturn([
    're_customer_name'=>$reit['reCustomerName'],
    're_item_id'=>$reit['reitemId'],
    're_item_qty'=>$reit['reQuantity'],
    're_item_amount'=>$reit['reAmount'],
    'sum_id'=>$sum_id->id,
    'dsr_id'=>$dsrId,
]);
  $retailers->save();
  $retailerSum += floatval($reit['reQuantity']) * floatval($reit['reAmount']);

  DB::update('update pending_sum set retialer_sum = retialer_sum + ? where id = ? and date = ?', array($retailerSum,$sum_id->id,$todayDate));

         // update dsr stock (+)
  $get_stock_id = DB::table('dsr_stocks')
  ->join('dsr_stock_items','dsr_stocks.id','dsr_stock_items.dsr_stock_id')
  ->select('dsr_stock_items.id','dsr_stock_items.dsr_stock_id','dsr_stock_items.item_id')
  ->where('dsr_id', '=', $dsrId)
  ->where('dsr_stocks.status', '!=', 2)
  ->get();


  if(count($get_stock_id) > 0){
    $count = 0;
    foreach($get_stock_id as $ids){
        if($ids->item_id == $reit['reitemId']){
            $count = 1;
            $qty = $reit['reQuantity'];
            $id = $ids->id;
            $stock_id = $ids->dsr_stock_id;
            break;
        }else{
            $stock_id = $ids->dsr_stock_id;
        }
        $count++;
    }

    if($count == 1){
        DB::update('update dsr_stock_items set retailer_qty = retailer_qty + ? where id = ?', array($qty,$id));
        DB::update('update dsr_stock_items set qty = qty + ? where id = ?', array($qty,$id));
    }else{
    //  DB::insert('insert into dsr_stock_items (dsr_stock_id, item_id ,qty) values (?,?,?)', array($stock_id,$reit['reitemId'],$reit['reQuantity']));
        DB::insert('insert into dsr_stock_items (dsr_stock_id, item_id, qty, created_at) values (?,?,?,?)', array($stock_id, $reit['reitemId'], $reit['reQuantity'], $todayDate ));
    }

}

}


return response()->json(['data' => array('info'=>$retilerItems,'error'=>null)],200);
}


public function MobileDsrBankings(Request $request){

 date_default_timezone_set("Asia/colombo");

 $dsrId = $request->get('dsr_id');
 $bankingItems = $request->get('bankings');
 $todayDate = $request->get('date');
 $bankingSum = 0;
 $sum_id = 0;

 $sampath = 0;
 $peoples = 0;
 $cargils = 0;

 $bsum = DB::table('pending_sum')->select('id','dsr_id','date')->where('dsr_id', '=', $dsrId)->where('date', '=', $todayDate)->get();
 $pstatus = DB::table('pending_sum_status')->select('dsr_id','date')->where('dsr_id', '=', $dsrId)->where('date', '=', $todayDate)->get();


 if(count($bsum)==0){

    foreach($bankingItems as $banking){

        $bankingSum += floatval($banking['amount']);

        if($banking['bank_id'] == 3){
            $sampath += $banking['amount'];
        }

        if($banking['bank_id'] == 2){
            $peoples += $banking['amount'];
        }

        if($banking['bank_id'] == 1){
            $cargils += $banking['amount'];
        }

    }

    DB::insert('insert into pending_sum (dsr_id, date,banking_sum,banking_sampath,banking_cargils,banking_peoples) values (?,?,?,?,?,?)', array($dsrId, $todayDate,$bankingSum,$sampath,$cargils,$peoples));
    $sum_id = DB::table('pending_sum')->latest('id')->first();

}else{

  foreach($bankingItems as $banking){

    $bankingSum += floatval($banking['amount']);

    if($banking['bank_id'] == 3){
        $sampath += $banking['amount'];
    }

    if($banking['bank_id'] == 2){
        $peoples += $banking['amount'];
    }

    if($banking['bank_id'] == 1){
        $cargils += $banking['amount'];
    }

}

DB::update('update pending_sum set banking_sum = banking_sum + ? ,banking_sampath = banking_sampath+ ? ,banking_cargils = banking_cargils+ ? ,banking_peoples = banking_peoples + ?  where dsr_id = ? and date = ?', array($bankingSum, $sampath, $cargils, $peoples,  $dsrId,$todayDate));
foreach($bsum as $sum){
 $sum_id = $sum;
}

}



if(count($pstatus)==0){
    DB::insert('insert into pending_sum_status (sum_id, dsr_id, date,banking_sum) values (?,?,?,?)', array($sum_id->id, $dsrId, $todayDate, 1));
}else{
  DB::update('update pending_sum_status set banking_sum = ? where dsr_id = ? and date = ?', array(1,$dsrId,$todayDate));
}


foreach($bankingItems as $bank){
    $bankings = new banking([
        'bank_id' => $bank['bank_id'],
        'bank_ref_no' => $bank['ref_no'],
        'bank_amount' => $bank['amount'],
        'sum_id' => $sum_id->id,
        'dsr_id' => $dsrId
    ]);
    $bankings->save();
}



return response()->json(['data' => array('info'=>$bankingItems,'error'=>null)],200);
}



public function MobileDsrDirectBankings(Request $request){

  date_default_timezone_set("Asia/colombo");

  $dsrId = $request->get('dsr_id');
  $dbankingItems = $request->get('dbankings');
  $todayDate = $request->get('date');
  $dbankingSum = 0;
  $sum_id = 0;

  $sampath = 0;
  $peoples = 0;
  $cargils = 0;


    // check if there is data in pending sum table for dsr today
  $csum = DB::table('pending_sum')->select('id','dsr_id','date')->where('dsr_id', '=', $dsrId)->where('date', '=', $todayDate)->get();
  $pstatus = DB::table('pending_sum_status')->select('dsr_id','date')->where('dsr_id', '=', $dsrId)->where('date', '=', $todayDate)->get();

  if(count($csum)==0){

        // insert
    foreach($dbankingItems as $dbank){

     $dbankingSum += floatval($dbank['amount']);

     if($dbank['bank'] == "Sampath Bank"){           
        $sampath += $dbank['amount'];
    }

    if($dbank['bank'] == "People's Bank"){
        $peoples += $dbank['amount'];
    }

    if($dbank['bank'] == "Cargills Bank"){
        $cargils += $dbank['amount'];
    }
}

DB::insert('insert into pending_sum (dsr_id, date, direct_banking_sum, direct_banking_sampath, direct_banking_cargils, direct_banking_peoples) values (?,?,?,?,?,?)', array($dsrId, $todayDate, $dbankingSum, $sampath,$cargils,$peoples));
$sum_id = DB::table('pending_sum')->latest('id')->first();

// Sampath Bank  People's Bank   Cargills Bank
}else{

        // update
    foreach($dbankingItems as $dbank){

       $dbankingSum += floatval($dbank['amount']);

       if($dbank['bank'] == "Sampath Bank"){
        $sampath += $dbank['amount'];
    }

    if($dbank['bank'] == "People's Bank"){
        $peoples += $dbank['amount'];
    }

    if($dbank['bank'] == "Cargills Bank"){
        $cargils += $dbank['amount'];
    }
}

DB::update('update pending_sum set 
    direct_banking_sum = direct_banking_sum + ? ,
    direct_banking_sampath = direct_banking_sampath + ?
    ,direct_banking_cargils = direct_banking_cargils + ?
    ,direct_banking_peoples = direct_banking_peoples + ?
    where dsr_id = ?
    and date = ?',
    array($dbankingSum,$sampath,$cargils,$peoples,$dsrId,$todayDate));

foreach($csum as $sum){
   $sum_id = $sum;
}
}



if(count($pstatus)==0){
        // insert
    DB::insert('insert into pending_sum_status (sum_id, dsr_id, date,direct_banking_sum) values (?,?,?,?)', array($sum_id->id, $dsrId, $todayDate, 1));
}else{
        // update
  DB::update('update pending_sum_status set direct_banking_sum = ? where dsr_id = ? and date = ?', array(1,$dsrId,$todayDate));
}



foreach($dbankingItems as $db){
    $direct_bankings = new directbanking([
        'direct_bank_customer_name'=>$db['customerName'],
        'direct_bank_name'=>$db['bank'],
        'direct_bank_ref_no'=>$db['refno'],
        'direct_bank_amount'=>$db['amount'],
        'sum_id'=>$sum_id->id,
        'dsr_id'=>$dsrId
    ]);
    $direct_bankings->save();
}


return response()->json(['data' => array('info'=>$dbankingItems,'error'=>null)],200);
}


public function MobileDsrInhands(Request $request){

    date_default_timezone_set("Asia/colombo");
    // $todayDate = date('Y-m-d');
    $todayDate = $request->get('date');
    $cheque = 0;
    $chequeArr = $request->get("cheques");
    $inhandSum = 0;
    $sum_id = 0;
    $cheque_amount = 0;

        // check if there is data in pending sum table for dsr today
    $csum = DB::table('pending_sum')->select('id','dsr_id','date')->where('dsr_id', '=', $request->get('dsr_id'))->where('date', '=', $todayDate)->get();
    $pstatus = DB::table('pending_sum_status')->select('dsr_id','date')->where('dsr_id', '=', $request->get('dsr_id'))->where('date', '=', $todayDate)->get();

    if(count($csum)==0){
        // insert
        DB::insert('insert into pending_sum (dsr_id, date, inhand_cash, inhand_cheque) values (?,?,?,?)', array($request->get('dsr_id'), $todayDate, $request->get('cash'), $cheque    ));
        $sum_id = DB::table('pending_sum')->latest('id')->first();
    }else{
        // update
        DB::update('update pending_sum set inhand_sum = ? , inhand_cash = ? , inhand_cheque = ? where dsr_id = ? and date = ?', array(floatval($request->get('cash')) + floatval($request->get('cheque')), $request->get('cash'), $cheque, $request->get('dsr_id'),$todayDate));
        foreach($csum as $sum){
         $sum_id = $sum;
     }
 }


 if(count($pstatus)==0){
        // insert
    DB::insert('insert into pending_sum_status (sum_id,dsr_id, date,inhand_sum) values (?,?,?,?)', array($sum_id->id, $request->get('dsr_id'), $todayDate, 1));
}else{
        // update
   DB::update('update pending_sum_status set inhand_sum = ? where dsr_id = ? and date = ?', array(1,$request->get('dsr_id'),$todayDate));
}





$check_data = DB::table('dsrs')->select('sum_id', 'dsr_user_id','in_hand','cash','cheque')->where('dsrs.sum_id', '=', $sum_id->id)->get();

if(count($check_data) == 0){
 $inhand = new Dsr([
    'cash' => $request->get('cash'),
    'cheque' => $cheque,
    'sum_id' => $sum_id->id,
    'dsr_user_id' => $request->get('dsr_id'),
]);
 $inhand->save();

     // save dsr cheques
 foreach ($chequeArr as $cheque) {
    $inhand_cheque = new DrsCheque([
        "sum_id" => $sum_id->id,
        "dsrs_id" => 1,
        "cheque_no" => $cheque["cheque_no"],
        "cheque_amount" => $cheque["cheque_amount"],
    ]);
    $inhand_cheque->save();
    $cheque_amount += $cheque["cheque_amount"];
}

            // update cheque amount in dsrs table
Dsr::where("id", $inhand->id)->update(["cheque" => $cheque_amount,"cash" => $request->get('cash'), "in_hand" => $cheque_amount+$request->get('cash') ]);
DB::update('update pending_sum set inhand_sum =?, inhand_cheque = ? WHERE id =?',array($cheque_amount+$request->get('cash'), $cheque_amount, $sum_id->id ));

}else{


    DB::table('dsrs')->where('sum_id', $sum_id->id)->delete();
    DB::table('drs_cheques')->where('sum_id', $sum_id->id)->delete();

    $inhand = new Dsr([
        'in_hand' => floatval($request->get('cash')) + floatval($cheque),
        'cash' => $request->get('cash'),
        'cheque' => $cheque,
        'sum_id' => $sum_id->id,
        'dsr_user_id' => $request->get('dsr_id'),
    ]);
    $inhand->save();

     // save dsr cheques
    foreach ($chequeArr as $cheque) {
        $inhand_cheque = new DrsCheque([
            "dsrs_id" => 1,
            "cheque_no" => $cheque["cheque_no"],
            "cheque_amount" => $cheque["cheque_amount"],
        ]);
        $inhand_cheque->save();
        $cheque_amount += $cheque["cheque_amount"];
    }

            // update cheque amount in dsrs table
    Dsr::where("id", $inhand->id)->update(["cheque" => $cheque_amount]);
    DB::update('update pending_sum set inhand_cheque = ? WHERE id =?',array($cheque_amount+$request->get('cash'), $sum_id->id ));

}

$array = (object) ['cash' => $request->get('cash'),'cheque' => $cheque_amount];

return response()->json(['data' => array('info'=>$array,'error'=>null)],200);
}













public function MobileDsrSumery(Request $request){

    $allData = [];
    $pdsr = DB::table('pending_sum')
    ->join('users', 'pending_sum.dsr_id', 'users.id')
    ->select('pending_sum.id',
        'pending_sum.dsr_id',
        'users.name',
        'date',
        'inhand_sum',
        'sales_sum',
        'credit_sum',
        'credit_collection_sum',
        'banking_sum',
        'direct_banking_sum')
    ->where('pending_sum.date', '=', $request->get('date'))
    ->where('pending_sum.dsr_id', '=', $request->get('dsr_id'))
    ->get();


    $reData = DB::table('retailer_returns')
    ->select(DB::raw('count(distinct retailer_returns.re_item_id) as retialer_item_count'))
    ->whereDate('created_at', '=', $request->get('date'))
    ->where('dsr_id', '=', $request->get('dsr_id'))
    ->where('retailer_returns.status', '!=', 0)
    ->get();

   // $pdsr->push($reData[0]);
    for ($x = 0; $x < count($pdsr); $x++) {
        $allData[] = (object) ['id' => $pdsr{$x}->id, 'dsr_id' => $pdsr{$x}->dsr_id, 'name' => $pdsr{$x}->name, 'date' => $pdsr{$x}->date, 'inhand_sum' => $pdsr{$x}->inhand_sum, 'sales_sum' => $pdsr{$x}->sales_sum, 'credit_sum' => $pdsr{$x}->credit_sum, 'credit_collection_sum' => $pdsr{$x}->credit_collection_sum, 'banking_sum' => $pdsr{$x}->banking_sum, 'direct_banking_sum' => $pdsr{$x}->direct_banking_sum, 'retialer_item_count' => $reData[0]->retialer_item_count  ];
    }



    if($pdsr){
        return response()->json(['data' => array('info'=>$allData,'error'=>null)], 200);
    }else{
    // Oops.. Error Occured!
     return response()->json(['data' => array('info'=>[],'error'=>0) ], 401); 
 }
}



public function MobileGetSaleSumery(Request $request){

//   $sale_summery_items = DB::table('sales')
//   ->select('id','item_id',
//     DB::raw('sum(item_qty) as qty'),
//     DB::raw('sum(item_amount * item_qty) as sub_total'))
//   ->whereDate('created_at', '=', $request->get('date'))
//   ->where('dsr_id', '=', $request->get('dsr_id'))
//   ->where('status', '!=', 0)
//   ->groupBy('item_id')
//   ->get();

   $sale_summery_items = DB::table('sales')
   ->select('id','item_id',
    DB::raw('sum(item_qty) as qty'),
    DB::raw('sum(item_amount * item_qty) as sub_total'))
   ->whereDate('created_at', '=', $request->get('date'))
   ->where('dsr_id', '=', $request->get('dsr_id'))
   ->where('status', '!=', 0)
   ->groupBy('item_id')
   ->get();

   $allData = [];
   $stock_balance_by_items = DB::table('dsr_stocks')
   ->join('dsr_stock_items','dsr_stock_items.dsr_stock_id','dsr_stocks.id')
   ->select('item_id',DB::raw('sum(qty) as qty'),'issue_return_qty','approve_return_qty','sale_qty','retailer_qty')
   ->groupBy('item_id')
   ->get();


   for ($x = 0; $x < count($sale_summery_items); $x++) {

    $allData[] = (object) [
        'id' =>$sale_summery_items[$x]->id,
        'item_id' =>$sale_summery_items[$x]->item_id,
        'qty' =>$sale_summery_items[$x]->qty, 
        'sub_total' =>$sale_summery_items[$x]->sub_total,
        // 'stock_balance' => ($stock_balance_by_items[$x]->qty + $stock_balance_by_items[$x]->retailer_qty) -  ($stock_balance_by_items[$x]->issue_return_qty + $stock_balance_by_items[$x]->approve_return_qty + $stock_balance_by_items[$x]->sale_qty)
        'stock_balance' => ($stock_balance_by_items[$x]->qty + $stock_balance_by_items[$x]->sale_qty)
    ];
}

if($sale_summery_items){
    return response()->json(['data' => array('info'=>$allData,'error'=>null)], 200);
}else{
    // Oops.. Error Occured!
   return response()->json(['data' => array('info'=>[],'error'=>0) ], 401); 
}


if($sale_summery_items){
    return response()->json(['data' => array('info'=>$sale_summery_items,'stock_balance'=>$allData,'error'=>null)], 200);
}else{
    // Oops.. Error Occured!
 return response()->json(['data' => array('info'=>[],'error'=>0) ], 401); 
}
}



public function MobileGetInhandSumery(Request $request){

    $inhand_summery_items = DB::table('dsrs')
    ->leftjoin('pending_sum','pending_sum.id','dsrs.sum_id')
    ->select('in_hand','cash','cheque')
    ->where('pending_sum.date', '=', $request->get('date'))
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
    ->leftjoin('pending_sum','pending_sum.id','bankings.sum_id')
    ->select('bankings.id','bank_name','bank_ref_no','bank_amount','sum_id','bankings.dsr_id')
    ->where('pending_sum.date', '=', $request->get('date'))
    ->where('pending_sum.dsr_id', '=', $request->get('dsr_id'))
    ->where('bankings.status', '!=', 0)
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
    ->leftjoin('pending_sum','pending_sum.id','directbankings.sum_id')
    ->select('directbankings.id','direct_bank_customer_name','direct_bank_name','direct_bank_ref_no','direct_bank_amount','sum_id','directbankings.dsr_id')
    ->where('pending_sum.date', '=', $request->get('date'))
    ->where('pending_sum.dsr_id', '=', $request->get('dsr_id'))
    ->where('directbankings.status', '!=', 0)
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
    ->leftjoin('pending_sum','pending_sum.id','credits.sum_id')
    ->select('credits.id', 'credit_customer_name','credit_amount')
    ->where('pending_sum.date', '=', $request->get('date'))
    ->where('pending_sum.dsr_id', '=', $request->get('dsr_id'))
    ->where('credits.status', '!=', 0)
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
    ->leftjoin('pending_sum','pending_sum.id','credit_collections.sum_id')
    ->select('credit_collections.id','credit_collection_customer_name','credit_collection_amount')
    ->where('pending_sum.date', '=', $request->get('date'))
    ->where('pending_sum.dsr_id', '=', $request->get('dsr_id'))
    ->where('credit_collections.status', '!=', 0)
    ->get();


    if($credit_summery_items){
        return response()->json(['data' => array('info'=>$credit_summery_items,'error'=>null)], 200);
    }else{
    // Oops.. Error Occured!
     return response()->json(['data' => array('info'=>[],'error'=>0) ], 401); 
 }
}


public function MobileGetRetailerSumery(Request $request){

    $retailer_summery_items = DB::table('retailer_returns')
    ->leftjoin('pending_sum','pending_sum.id','retailer_returns.sum_id')
    ->select('retailer_returns.id','re_customer_name','re_item_id as item_id','re_item_qty as item_count')
    ->where('pending_sum.date', '=', $request->get('date'))
    ->where('pending_sum.dsr_id', '=', $request->get('dsr_id'))
    ->where('retailer_returns.status', '!=', 0)
    ->orderBy('item_id','asc')
    ->get();


    if($retailer_summery_items){
        return response()->json(['data' => array('info'=>$retailer_summery_items,'error'=>null)], 200);
    }else{
    // Oops.. Error Occured!
     return response()->json(['data' => array('info'=>[],'error'=>0) ], 401); 
 }
}


public function MobileGetSumeryStatus(Request $request){

    $summery_details = DB::table('pending_sum_status')
    ->select(
        'pending_sum_status.dsr_id',
        'pending_sum_status.date',
        'inhand_sum',
        'sales_sum',
        'credit_sum',
        'credit_collection_sum',
        'banking_sum',
        'direct_banking_sum',
        'retialer_sum'
    )
    ->where('pending_sum_status.date', '=', $request->get('date'))
    ->where('pending_sum_status.dsr_id', '=', $request->get('dsr_id'))
    ->get();


    if($summery_details){
        return response()->json(['data' => array('info'=>$summery_details,'error'=>null)], 200);
    }else{
    // Oops.. Error Occured!
     return response()->json(['data' => array('info'=>[],'error'=>0) ], 401); 
 }
}


public function MobileReturnBulkStock(Request $request){

 $update_dsr_qty = DB::table('dsr_stock_items')->where('dsr_stock_id','=',$request->get('dsr_stock_id'))->where('item_id','=',$request->get('item_id'))->decrement('qty', $request->get('qty'));


 $update_sum_status = DB::table('dsr_stock_items')->where('dsr_stock_id','=',$request->get('dsr_stock_id'))->where('item_id','=',$request->get('item_id'))->increment('issue_return_qty', $request->get('qty'));


 $get_item_details = DB::table('items')->select('selling_price')->where('id','=',$request->get('item_id'))->where('status','=',1)->get();
 $update_stock_total = DB::table('dsr_stocks')->where('id','=',$request->get('dsr_stock_id'))->decrement('total', ($request->get('qty') * $get_item_details[0]->selling_price) ); 


 if($update_dsr_qty){
    return response()->json(['data' => array('info'=>$update_dsr_qty,'error'=>null)], 200);
}else{
    // Oops.. Error Occured!
 return response()->json(['data' => array('info'=>[],'error'=>0) ], 401); 
}
}



public function MobileApproveSumery(Request $request){

   $update_sum = DB::table('pending_sum')
   ->where('dsr_id','=',$request->get('dsr_id'))
   ->where('date','=',$request->get('date'))
   ->update([
    'status'=> 1
]);

   $update_sum_status = DB::table('pending_sum_status')
   ->where('dsr_id','=',$request->get('dsr_id'))
   ->where('date','=',$request->get('date'))
   ->update([
    'status'=> 1
]);


   if($update_sum == 1 && $update_sum_status == 1){
    return response()->json(['data' => array('info'=>$update_sum, 'comment'=>"updated", 'error'=>null)], 200);
}else if($update_sum == 0 && $update_sum_status == 0){
    return response()->json(['data' => array('info'=>0, 'comment'=>"not updated", 'error'=>null)], 200);
}else{
    // Oops.. Error Occured!
 return response()->json(['data' => array('info'=>[],'error'=>0) ], 401); 
}
}



public function MobileApproveStatus(Request $request){

    $approve_status = DB::table('pending_sum')
    ->select('status','date')
    ->where('dsr_id','=',$request->get('dsr_id'))
    ->where('date','=',$request->get('date'))
    ->get();


    if($approve_status){
        return response()->json(['data' => array('info'=>$approve_status,'error'=>null)], 200);
    }else{
    // Oops.. Error Occured!
     return response()->json(['data' => array('info'=>[],'error'=>0) ], 401); 
 }
}

public function MobileRemoveSaleSummary(Request $request){

    $remove_sales = DB::table('sales')
    ->where('id','=',$request->get('id'))
    ->update([
        'status'=> 0
    ]);
    
    $get_dsr_stock_id = DB::table('sales')
    ->join('dsr_stock_items','sales.stock_id','dsr_stock_items.id')
    ->select('dsr_stock_items.id','sales.status','sales.item_qty','sales.sum_id','sales.item_amount')
    ->where('sales.id', '=', $request->get('id'))
    ->get();

    foreach($get_dsr_stock_id as $stockId){

        $saleSum = floatval($stockId->item_qty) * floatval($stockId->item_amount);

        DB::update('update dsr_stock_items set sale_qty = sale_qty - ? where id = ?', array($stockId->item_qty,$stockId->id));
        DB::update('update dsr_stock_items set qty = qty + ? where id = ?', array($stockId->item_qty,$stockId->id));
        DB::update('update pending_sum set sales_sum = sales_sum - ? where id = ?', array($saleSum,$stockId->sum_id));
    }


    if($remove_sales){
        return response()->json(['data' => array('info'=>$remove_sales,'error'=>null)], 200);
    }else{
    // Oops.. Error Occured!
     return response()->json(['data' => array('info'=>[],'error'=>0) ], 401); 
 }
}



public function MobileRemoveBankingSummary(Request $request){

    $remove_sales = DB::table('bankings')->where('id','=',$request->get('id'))->update(['status'=> 0]);
    $get_banking_details = DB::table('bankings')->where('id', '=', $request->get('id'))->where('sum_id','=',$request->get('sum_id'))->get();

    $sampath = 0;
    $peoples = 0;
    $cargils = 0;

    if($request->get('bank_name') == "Sampath Bank"){
        foreach($get_banking_details as $bdata){
            DB::update('update pending_sum set banking_sum = banking_sum - ?, banking_sampath = banking_sampath - ? where id = ?', array($bdata->bank_amount,$bdata->bank_amount,$bdata->sum_id));
        }
    }

    if($request->get('bank_name') == "People's Bank"){
       foreach($get_banking_details as $bdata){
        DB::update('update pending_sum set banking_sum = banking_sum - ?, banking_peoples = banking_peoples - ? where id = ?', array($bdata->bank_amount,$bdata->bank_amount,$bdata->sum_id));
    }
}

if($request->get('bank_name') == "Cargills Bank"){
    foreach($get_banking_details as $bdata){
        DB::update('update pending_sum set banking_sum = banking_sum - ?, banking_cargils = banking_cargils - ? where id = ?', array($bdata->bank_amount,$bdata->bank_amount,$bdata->sum_id));
    }
}


if($get_banking_details){
    return response()->json(['data' => array('info'=>$remove_sales,'error'=>null)], 200);
}else{
    // Oops.. Error Occured!
   return response()->json(['data' => array('info'=>[],'error'=>0) ], 401); 
}
}



public function MobileRemoveDBankingSummary(Request $request){

    $remove_dbankings = DB::table('directbankings')->where('id','=',$request->get('id'))->update(['status'=> 0]);
    $get_dbanking_details = DB::table('directbankings')->where('id', '=', $request->get('id'))->where('sum_id','=',$request->get('sum_id'))->get();

    $sampath = 0;
    $peoples = 0;
    $cargils = 0;

    if($request->get('bank_name') == "Sampath Bank"){
        foreach($get_dbanking_details as $bdata){
            DB::update('update pending_sum set direct_banking_sum = direct_banking_sum - ?, direct_banking_sampath = direct_banking_sampath - ? where id = ?', array($bdata->direct_bank_amount,$bdata->direct_bank_amount,$bdata->sum_id));
        }
    }

    if($request->get('bank_name') == "People's Bank"){
       foreach($get_dbanking_details as $bdata){
        DB::update('update pending_sum set direct_banking_sum = direct_banking_sum - ?, direct_banking_peoples = direct_banking_peoples - ? where id = ?', array($bdata->direct_bank_amount,$bdata->direct_bank_amount,$bdata->sum_id));
    }
}

if($request->get('bank_name') == "Cargills Bank"){
    foreach($get_dbanking_details as $bdata){
        DB::update('update pending_sum set direct_banking_sum = direct_banking_sum - ?, direct_banking_cargils = direct_banking_cargils - ? where id = ?', array($bdata->direct_bank_amount,$bdata->direct_bank_amount,$bdata->sum_id));
    }
}


if($get_dbanking_details){
    return response()->json(['data' => array('info'=>$remove_dbankings,'error'=>null)], 200);
}else{
    // Oops.. Error Occured!
   return response()->json(['data' => array('info'=>[],'error'=>0) ], 401); 
}
}




public function MobileRemoveCreditSummary(Request $request){

    $remove_credits = DB::table('credits')->where('id','=',$request->get('id'))->update(['status'=> 0]);
    $get_credits = DB::table('credits')->where('id', '=', $request->get('id'))->get();

    foreach($get_credits as $cdata){
        DB::update('update pending_sum set credit_sum = credit_sum - ? where id = ?', array($cdata->credit_amount,$cdata->sum_id));
    }


    if($get_credits){
        return response()->json(['data' => array('info'=>$remove_credits,'error'=>null)], 200);
    }else{
    // Oops.. Error Occured!
     return response()->json(['data' => array('info'=>[],'error'=>0) ], 401); 
 }
}


public function MobileRemoveCreditColSummary(Request $request){

    $remove_col_credits = DB::table('credit_collections')->where('id','=',$request->get('id'))->update(['status'=> 0]);
    $get_col_credits = DB::table('credit_collections')->where('id', '=', $request->get('id'))->get();

    foreach($get_col_credits as $cdata){
        DB::update('update pending_sum set credit_collection_sum = credit_collection_sum - ? where id = ?', array($cdata->credit_collection_amount,$cdata->sum_id));
    }


    if($get_col_credits){
        return response()->json(['data' => array('info'=>$remove_col_credits,'error'=>null)], 200);
    }else{
    // Oops.. Error Occured!
       return response()->json(['data' => array('info'=>[],'error'=>0) ], 401); 
   }
}


public function MobileRemoveRetailerSummary(Request $request){

    $remove_col_credits = DB::table('retailer_returns')->where('id','=',$request->get('id'))->update(['status'=> 0]);
    $get_col_credits = DB::table('retailer_returns')->where('id', '=', $request->get('id'))->get();

    foreach($get_col_credits as $cdata){
        DB::update('update pending_sum set retialer_sum = retialer_sum - ? where id = ?', array( ($cdata->re_item_qty * $cdata->re_item_amount) ,$cdata->sum_id));
    }


    if($get_col_credits){
        return response()->json(['data' => array('info'=>$remove_col_credits,'error'=>null)], 200);
    }else{
    // Oops.. Error Occured!
     return response()->json(['data' => array('info'=>[],'error'=>0) ], 401); 
 }
}











public function MobileEditSaleSummary(Request $request){

    // $get_dsr_stock_id = DB::table('sales')->select('dsr_id','item_id','qty','sum_id','created_at')->where('id', '=', $request->get('id'))->get();

    $get_dsr_stock_id = DB::table('sales')
    ->join('dsr_stock_items','sales.stock_id','dsr_stock_items.id')
    ->select('sales.item_qty','sales.sum_id','dsr_stock_items.id','dsr_stock_items.issue_return_qty','dsr_stock_items.approve_return_qty','dsr_stock_items.sale_qty','dsr_stock_items.retailer_qty')
    ->where('sales.id', '=', $request->get('id'))
    ->where('sales.status', '!=', 0)
    ->get();


    $sum_id = 0;
    $sale_total = 0;

    foreach($get_dsr_stock_id as $sum){
         // set amount to 0 in pending sum->sales_sum to calculate new value
        DB::update('update pending_sum set sales_sum = ? where id = ?', array( 0 ,$sum->sum_id));

        DB::update('update dsr_stock_items set qty = qty - ?  where id = ?', array( (floatval($request->get('itemQty')) - floatval($sum->item_qty) ) ,$sum->id));

        DB::update('update dsr_stock_items set sale_qty = ?  where id = ?', array( $request->get('itemQty') ,$sum->id));
    }
    
    $sales_update = DB::table('sales')
    ->where('id','=',$request->get('id'))
    ->update(['item_name'=>$request->get('itemName'),'item_qty'=>$request->get('itemQty'),'item_amount'=>$request->get('itemPrice')]);
    
    $getTotal = DB::table('sales')->select('sum_id','item_qty','item_amount')->where('dsr_id', '=', $request->get('dsr_id'))->whereDate('created_at', '=', $request->get('date'))->where('status', '!=', 0)->get();

    foreach($getTotal as $tot){
        $sum_id = $tot->sum_id;
        $sale_total += ($tot->item_qty * $tot->item_amount);
    }

          // set new amount in pending sum->sales_sum
    DB::update('update pending_sum set sales_sum = sales_sum + ? where id = ?', array( $sale_total , $sum_id));   



    $allData = [];
    $stock_balance_by_items = DB::table('sales')
    ->join('dsr_stocks','sales.dsr_id','dsr_stocks.dsr_id')
    ->join('dsr_stock_items','dsr_stock_items.dsr_stock_id','dsr_stocks.id')
    ->select('item_name','qty','issue_return_qty','approve_return_qty','sale_qty','retailer_qty')
    ->groupBy('dsr_stock_items.item_id')
    ->get();


    for ($x = 0; $x < count($stock_balance_by_items); $x++) {

        $allData[] = (object) ['stock_balance' => ($stock_balance_by_items[$x]->qty + $stock_balance_by_items[$x]->retailer_qty) -  ($stock_balance_by_items[$x]->issue_return_qty + $stock_balance_by_items[$x]->approve_return_qty + $stock_balance_by_items[$x]->sale_qty)];

    }


    if($sales_update){
        return response()->json(['data' => array('info'=>$allData,'error'=>null)], 200);
    }else{
    // Oops.. Error Occured!
       return response()->json(['data' => array('info'=>[],'error'=>0) ], 401); 
   }

}


public function MobileEditBankSummary(Request $request){

    $bankings_update = DB::table('bankings')
    ->where('id','=',$request->get('id'))
    ->update(['bank_name'=>$request->get('bank'),'bank_ref_no'=>$request->get('refno'),'bank_amount'=>$request->get('amount')]);

    $banking_details = DB::table('bankings')->select('bank_name','bank_amount','sum_id')->where('status', '!=', 0)->where('sum_id','=',$request->get('sum_id'))->get();
    $bank_total = 0;
    $sampath = 0;
    $peoples = 0;
    $cargils = 0;

    foreach($banking_details as $banks){

     DB::update('update pending_sum set banking_sum = ?, banking_sampath = ?, banking_cargils = ?, banking_peoples = ? where id = ?', array( 0, 0, 0, 0, $banks->sum_id));

     $bank_total += floatval($banks->bank_amount);

     if($banks->bank_name == "Sampath Bank"){
        $sampath += $banks->bank_amount;
    }

    if($banks->bank_name == "People's Bank"){
        $peoples += $banks->bank_amount;
    }

    if($banks->bank_name == "Cargills Bank"){
        $cargils += $banks->bank_amount;
    }

    DB::update('update pending_sum set banking_sum = banking_sum + ? ,banking_sampath = banking_sampath+ ? ,banking_cargils = banking_cargils+ ? ,banking_peoples = banking_peoples + ?  where id = ?', array($bank_total, $sampath, $cargils, $peoples,  $banks->sum_id));
}

if($bankings_update){
    return response()->json(['data' => array('info'=>$bankings_update,'error'=>null)], 200);
}else{
    // Oops.. Error Occured!
 return response()->json(['data' => array('info'=>[],'error'=>0) ], 401); 
}

}


public function MobileEditDBankSummary(Request $request){

  $direct_banking_update = DB::table('directbankings')
  ->where('id','=',$request->get('id'))
  ->update(['direct_bank_customer_name'=>$request->get('customerName'),'direct_bank_name'=>$request->get('bank'),'direct_bank_ref_no'=>$request->get('refno'),'direct_bank_amount'=>$request->get('amount')]);


  $direct_banking_details = DB::table('directbankings')->select('direct_bank_name','direct_bank_amount','sum_id')->where('status', '!=', 0)->where('sum_id','=',$request->get('sum_id'))->get();
  $dbank_total = 0;
  $sampath = 0;
  $peoples = 0;
  $cargils = 0;

  foreach($direct_banking_details as $dbanks){

     DB::update('update pending_sum set direct_banking_sum = ?, direct_banking_sampath = ?, direct_banking_cargils = ?, direct_banking_peoples = ? where id = ?', array( 0, 0, 0, 0, $dbanks->sum_id));

     $dbank_total += floatval($dbanks->direct_bank_amount);

     if($dbanks->direct_bank_name == "Sampath Bank"){
        $sampath += $dbanks->direct_bank_amount;
    }

    if($dbanks->direct_bank_name == "People's Bank"){
        $peoples += $dbanks->direct_bank_amount;
    }

    if($dbanks->direct_bank_name == "Cargills Bank"){
        $cargils += $dbanks->direct_bank_amount;
    }


    DB::update('update pending_sum set direct_banking_sum = direct_banking_sum + ? ,direct_banking_sampath = direct_banking_sampath+ ? ,direct_banking_cargils = direct_banking_cargils+ ? ,direct_banking_peoples = direct_banking_peoples + ?  where id = ?', array($dbank_total, $sampath, $cargils, $peoples,  $dbanks->sum_id));

}



if($direct_banking_update){
    return response()->json(['data' => array('info'=>$direct_banking_update,'error'=>null)], 200);
}else{
    // Oops.. Error Occured!
 return response()->json(['data' => array('info'=>[],'error'=>0) ], 401); 
}

}


public function MobileEditCreditSummary(Request $request){

  $credit_update = DB::table('credits')
  ->where('id','=',$request->get('id'))
  ->update(['credit_customer_name'=>$request->get('customerName'),'credit_amount'=>$request->get('amount')]);


  $credit_sum_id = DB::table('credits')->select('sum_id')->where('id', '=', $request->get('id'))->get();
  $sum_id = 0;
  $credit_total = 0;

  foreach($credit_sum_id as $sum){
         // set amount to 0 in pending sum->sales_sum
    DB::update('update pending_sum set credit_sum = ? where id = ?', array( 0 ,$sum->sum_id));

    $getCreditTotal = DB::table('credits')->select('credit_amount')->where('sum_id', '=', $sum->sum_id)->where('status', '!=', 0)->get();

    foreach($getCreditTotal as $tot){
        $sum_id = $sum->sum_id;
        $credit_total += $tot->credit_amount;
    }

          // set new amount in pending sum->sales_sum
    DB::update('update pending_sum set credit_sum = credit_sum + ? where id = ?', array( $credit_total , $sum_id));   
}


if($credit_update){
    return response()->json(['data' => array('info'=>$credit_update,'error'=>null)], 200);
}else{
    // Oops.. Error Occured!
 return response()->json(['data' => array('info'=>[],'error'=>0) ], 401); 
}

}



public function MobileEditCreditColSummary(Request $request){

  $creditcol_update = DB::table('credit_collections')
  ->where('id','=',$request->get('id'))
  ->update(['credit_collection_customer_name'=>$request->get('ccName'),'credit_collection_amount'=>$request->get('ccAmount')]);


  $credit_sum_id = DB::table('credit_collections')->select('sum_id')->where('id', '=', $request->get('id'))->get();
  $sum_id = 0;
  $creditCol = 0;

  foreach($credit_sum_id as $sum){
         // set amount to 0 in pending sum->sales_sum
    DB::update('update pending_sum set credit_collection_sum = ? where id = ?', array( 0 ,$sum->sum_id));

    $getCreditTotal = DB::table('credit_collections')->select('credit_collection_amount')->where('sum_id', '=', $sum->sum_id)->where('status', '!=', 0)->get();

    foreach($getCreditTotal as $tot){
        $sum_id = $sum->sum_id;
        $creditCol += $tot->credit_collection_amount;
    }

          // set new amount in pending sum->sales_sum
    DB::update('update pending_sum set credit_collection_sum = credit_collection_sum + ? where id = ?', array( $creditCol , $sum_id));   
}


if($creditcol_update){
    return response()->json(['data' => array('info'=>$creditcol_update,'error'=>null)], 200);
}else{
    // Oops.. Error Occured!
 return response()->json(['data' => array('info'=>[],'error'=>0) ], 401); 
}

}



public function MobileEditRetailerSummary(Request $request){

    $retailer_update = DB::table('retailer_returns')
    ->where('id','=',$request->get('id'))
    ->update(['re_customer_name'=>$request->get('reCustomerName'),'re_item_id'=>$request->get('reItemId'),'re_item_qty'=>$request->get('reQuantity'),'re_item_amount'=>$request->get('reAmount')]);


    $credit_sum_id = DB::table('retailer_returns')->select('sum_id')->where('id', '=', $request->get('id'))->get();
    $sum_id = 0;
    $retailerTot = 0;

    foreach($credit_sum_id as $sum){
         // set amount to 0 in pending sum->sales_sum
        DB::update('update pending_sum set retialer_sum = ? where id = ?', array( 0 ,$sum->sum_id));

        $getCreditTotal = DB::table('retailer_returns')->select('re_item_amount','re_item_qty')->where('sum_id', '=', $sum->sum_id)->where('status', '!=', 0)->get();

        foreach($getCreditTotal as $tot){
            $sum_id = $sum->sum_id;
            $retailerTot += ($tot->re_item_amount * $tot->re_item_qty);
        }

          // set new amount in pending sum->sales_sum
        DB::update('update pending_sum set retialer_sum = retialer_sum + ? where id = ?', array( $retailerTot , $sum_id));   
    }


    if($retailer_update){
        return response()->json(['data' => array('info'=>$retailer_update,'error'=>null)], 200);
    }else{
    // Oops.. Error Occured!
     return response()->json(['data' => array('info'=>[],'error'=>0) ], 401); 
 }

}



public function MobileBanks(Request $request)
{
    $bank_data = DB::table("banks")->where('status',1)->get();
    if ($bank_data) {
        return response()->json(
            ["data" => ["info" => $bank_data, "error" => null]],
            200
        );
    } else {
            // Oops.. Error Occured!
        return response()->json(
            ["data" => ["info" => [], "error" => 0]],
            401
        );
    }
}








}


