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
     $update_stock_total = DB::table('dsr_stocks')->where('id','=',$dsr_stock->id)->increment('total', ($td["qty"] * $td["sprice"]) ); 

      // update main stock (items table)
     $update_item_qty = DB::table('items')->where('id','=',$td["item_id"])->decrement('qty', $td["qty"]); 
 }


 return response()->json(['data' => $dsr_stock],200);

}






public function TransferStatus(){

 $TransferStatus = DB::table('dsr_stocks')
 ->join('users', 'dsr_stocks.dsr_id', 'users.id')
 ->select('users.id','users.name','dsr_stocks.total','dsr_stocks.created_at','dsr_stocks.status','dsr_stocks.id')
 ->get();

 return view('admin.item.transfer_status', ['transferStatus'=>$TransferStatus]);
}

public function viewTransferItems(Request $request){

    $transfer_items = DB::table('dsr_stock_items')
    ->join('items', 'dsr_stock_items.item_id', 'items.id')
    ->select('items.name','dsr_stock_items.qty')
    ->where('dsr_stock_id','=',$request->id)
    ->get();
    return response($transfer_items);
}





public function ViewBalance(){
    $dsrs = DB::table('users')->join('dsr_stocks', 'dsr_stocks.dsr_id', 'users.id')->select('users.id','users.name')->where('dsr_stocks.status','=',1)->where('users.status','=',1)->distinct()->get();
    $all_dsr_items = DB::table('items')->select('name','qty')->where('status','=',1)->orderBy('name','asc')->paginate(10);
    
    return view('admin.item.view_balance', ['dsrList'=>$dsrs,'dsrStockData'=>$all_dsr_items]);
}


public function GetStockItemsById(Request $request){

    $selected_date = $request->get('date');
    $stock_id = $request->get('stock_id');

    $dsrs = DB::table('users')->join('dsr_stocks', 'dsr_stocks.dsr_id', 'users.id')->select('users.id','users.name')->where('dsr_stocks.status','=',1)->where('users.status','=',1)->distinct()->get();

    if($stock_id == 0){

        $all_stock_items = DB::table('items')->select('name','qty')->where('status','=',1)->orderBy('name','asc')->get();

        $all_dsr_items = DB::table('items')->join('dsr_stock_items', 'dsr_stock_items.item_id', 'items.id')->join('dsr_stocks', 'dsr_stocks.id', 'dsr_stock_items.dsr_stock_id')->select('items.name','dsr_stock_items.qty')->where('items.status','=',1)->orderBy('items.name','asc')->get();

        for ($i=0; $i < count($all_dsr_items); $i++) { 
            $all_stock_items->push(array("name"=>$all_dsr_items[$i]->name,"qty"=>$all_dsr_items[$i]->qty));
        }

        $array = json_decode(json_encode($all_stock_items), true);

        return view('admin.item.view_balance', ['dsrList'=>$dsrs,'dsrStockData'=>$array]);

    }else if($stock_id == 00){


    }else{


    }



}




}
