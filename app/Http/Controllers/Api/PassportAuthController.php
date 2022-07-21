<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\DsrReturn;
use App\Models\Item;
use App\Models\Sale;
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
    ->get();

    array_push($itemData, $stock_item_data);
}

for ($x = 0; $x < count($stock_data); $x++) {
    $allData[] = (object) ['stock_id' => $stock_data{$x}->id, 'qty' => $itemData[$x][0]->qty ];
}

return response()->json(['data' => array('info'=>$allData,'error'=>null)],200);
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



public function MobileAddDsrReturnData(Request $request){

   $dsr_return = new DsrReturn;
   $dsr_return->dsr_stock_id = $request->get('dsr_stock_id');
   $dsr_return->dsr_id = $request->get('dsr_id');
   $dsr_return->item_id = $request->get('item_id');
   $dsr_return->qty = $request->get('qty');
   $dsr_return->status = 0;
   $dsr_return->save();

   return response()->json(['data' => array('info'=>$dsr_return,'error'=>null)],200);
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

  $allData = [];
  $itemData = [];

  $stock_data = DB::table('dsr_stocks')->select('id')->where('dsr_id','=',$request->get('dsr_id'))->where('status', '=', 1)->get();

  foreach($stock_data as $sd){
    $stock_item_data = DB::table('dsr_stock_items')
    ->join('dsr_stocks','dsr_stock_items.dsr_stock_id','dsr_stocks.id')
    ->select('dsr_stock_id','item_id', DB::raw('sum(qty) as qty_sum'))
    ->where('dsr_id', '=', $request->get('dsr_id'))
    ->where('dsr_stocks.id', '=', $sd->id)
    ->where('dsr_stocks.status', '=', 1)
    ->groupBy('item_id')
    ->get();

    array_push($itemData, $stock_item_data);

}

for ($x = 0; $x < count($stock_data); $x++) {
    $allData[] = (object) ['stock_id' => $stock_data{$x}->id, 'items' => $itemData[$x] ];
}

return response()->json(['data' => array('info'=>$allData,'error'=>null)],200);
}



public function MobileDsrSales(Request $request){
    $dsrId = $request->get('dsr_id');
    $saleItems = $request->get('sale_items');
    foreach($saleItems as $sale){
        $sales = new Sale([
            'item_name'=>$sale['itemName'],
            'item_qty'=>$sale['itemQty'],
            'item_amount'=>$sale['itemPrice'],
            'dsr_id'=>$dsrId
        ]);
        $sales->save();
    }
    return response()->json(['data' => array('info'=>$saleItems,'error'=>null)],200);
}


public function MobileDsrCredits(Request $request){
    $dsrId = $request->get('dsr_id');
    $saleItems = $request->get('sale_items');
    foreach($saleItems as $sale){
        $sales = new Sale([
            'item_name'=>$sale['itemName'],
            'item_qty'=>$sale['itemQty'],
            'item_amount'=>$sale['itemPrice'],
            'dsr_id'=>$dsrId
        ]);
        $sales->save();
    }
    return response()->json(['data' => array('info'=>$saleItems,'error'=>null)],200);
}





}


