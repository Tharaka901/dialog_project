<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\DsrStock;
use App\Models\DsrStockItem;
use App\Models\User;
use App\Models\Item;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;


class StockController extends Controller
{

    public function SendInventry(){
       $stocks = Stock::all()->where('status', '=',1);
       $dsrs = User::all()->where('status', '=',1);
       $items = Item::all()->where('status', '=',1);
       return view('admin.item.send_inventry', ['stockData'=>$stocks,'dsrData'=>$dsrs,'itemData'=>$items]);
   }

   public function SendItem(Request $request){

    $stock_id = $request->get('stock_id');
    $dsr_id = $request->get('dsr_id');
    $tableData = json_decode($request->get('tableData'),true);
    date_default_timezone_set('Asia/Colombo');


    // check if there is a data for dsr in dsr_stocks for today
    $dsr_stock = new DsrStock([
        'stock_id'=> $stock_id,
        'dsr_id'=>$dsr_id,
        'status'=>0,
    ]);
    $dsr_stock->save();

    foreach($tableData as $td){
     $dsr_stock_item = new DsrStockItem([
        'dsr_stock_id'=> $dsr_stock->id,
        'item_id'=>$td["item_id"],
        'qty'=>$td["qty"],
    ]);
     $dsr_stock_item->save();

     // update stock
     $update_item_qty = DB::table('items')->where('id','=',$td["item_id"])->decrement('qty', $td["qty"]); 
 }


 return response()->json(['data' => $dsr_stock],200);

}






public function TransferStatus(){
    return view('admin.item.transfer_status');
}





public function ViewBalance(){

    $dsrs = DB::table('users')->join('stock_has_dsrs', 'stock_has_dsrs.dsr_id', 'users.id')->select('users.id','users.name')->where('stock_has_dsrs.status','=',1)->where('users.status','=',1)->get();

    $all_dsr_items = DB::table('items')
    ->join('stock_dsr_items', 'stock_dsr_items.item_id', 'items.id')
    ->join('stock_has_dsrs', 'stock_has_dsrs.id', 'stock_dsr_items.stock_dsr_id')
    ->select('items.name','items.qty as item_stock','stock_dsr_items.qty as dsr_stock')
    ->where('items.status','=',1)
    ->orderBy('items.name','asc')
    ->paginate(10);

    return view('admin.item.view_balance', ['dsrList'=>$dsrs,'dsrStockData'=>$all_dsr_items]);

}

public function GetStockItemsById(Request $request){

    $selected_date = $request->get('date');
    $stock_id = $request->get('stock_id');

    $dsrs = DB::table('users')->join('stock_has_dsrs', 'stock_has_dsrs.dsr_id', 'users.id')->select('users.id','users.name')->where('stock_has_dsrs.status','=',1)->where('users.status','=',1)->get();

    if($stock_id == 0){

        $all_stock_items = DB::table('items')->select('name','qty')->where('status','=',1)->orderBy('name','asc')->paginate(10);

        $all_dsr_items = DB::table('items')
        ->join('stock_dsr_items', 'stock_dsr_items.item_id', 'items.id')
        ->join('stock_has_dsrs', 'stock_has_dsrs.id', 'stock_dsr_items.stock_dsr_id')
        ->select('items.name','stock_dsr_items.qty')
        ->where('items.status','=',1)
        ->orderBy('items.name','asc')
        ->paginate(10);

        return view('admin.item.view_balance', ['dsrList'=>$dsrs,'stockData'=>$all_stock_items,'dsrStockData'=>$all_dsr_items]);

    }else if($stock_id == 00){

     $all_stock_items = DB::table('items')->select('name','qty')->where('status','=',1)->whereDate('created_at','=',$selected_date)->orderBy('name','asc')->paginate(10);
     return view('admin.item.view_balance', ['dsrList'=>$dsrs,'stockData'=>$all_stock_items,'dsrStockData'=>[] ]);

 }else{


    $all_stock_items = DB::table('items')->select('name','qty')->where('status','=',1)->whereDate('created_at','=',$selected_date)->orderBy('name','asc')->paginate(10);

    $all_dsr_items = DB::table('items')
    ->join('stock_dsr_items', 'stock_dsr_items.item_id', 'items.id')
    ->join('stock_has_dsrs', 'stock_has_dsrs.id', 'stock_dsr_items.stock_dsr_id')
    ->select('items.name','stock_dsr_items.qty')
    ->where('items.status','=',1)
    ->whereDate('stock_dsr_items.created_at','=',$selected_date)
    ->orderBy('items.name','asc')
    ->paginate(10);

    return view('admin.item.view_balance', ['dsrList'=>$dsrs,'stockData'=>$all_stock_items,'dsrStockData'=>$all_dsr_items]);

}



}


}
