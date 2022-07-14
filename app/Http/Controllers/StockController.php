<?php

namespace App\Http\Controllers;

use App\Models\Stock;
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

    $stock = $request->get('stock_id');
    $dsr = $request->get('dsr_id');
    $tableData = json_decode($request->get('tableData'),true);
    date_default_timezone_set('Asia/Colombo');
    $last_id = 0;

    $dsr_stock = DB::select('select sd.dsr_id,sdi.item_id,sdi.qty,sdi.created_at FROM stock_dsr_items AS sdi INNER JOIN stock_has_dsrs AS sd ON(sdi.stock_dsr_id =sd.id ) WHERE sd.dsr_id = ? AND date(sd.created_at) = ?', [$dsr, date('Y-m-d')]);

    if(count($dsr_stock) == 0){
         // insert data to stock has dsrs for today
        $stock_has_dsrs = DB::insert('insert into stock_has_dsrs (stock_id, dsr_id, created_at) values (?, ?, ?)', [$stock, $dsr, date('Y-m-d h:i:s a')]);
        $last_inserted_data = DB::table('stock_has_dsrs')->latest('id')->first();
        $last_id = $last_inserted_data->id;
    }


    // insert item data to stock dsr items
    foreach($tableData as $item){

        $dsr_items = DB::select('select sd.dsr_id,sdi.id,sdi.item_id,sdi.qty,sdi.created_at FROM stock_dsr_items AS sdi INNER JOIN stock_has_dsrs AS sd ON(sdi.stock_dsr_id =sd.id ) WHERE sdi.item_id = ? AND sd.dsr_id = ? AND date(sd.created_at) = ?', [$item['item_id'], $dsr, date('Y-m-d')]);

        if(count($dsr_items) !=0){
            // if the dsr have item, do not insert stock. it needs to be updated
            foreach($dsr_items as $ditems){
                DB::update('update stock_dsr_items set qty = qty+? where item_id = ? AND id = ?', array($item['qty'],$item['item_id'],$ditems->id));
            }
        }else{
            // if the dsr don't have item, insert stock.
            DB::insert('insert into stock_dsr_items (item_id, qty, stock_dsr_id, created_at) values (?, ?, ?, ?)', [$item['item_id'], $item['qty'],  $last_id , date('Y-m-d h:i:s a')]);

        }

        //update the balance stock after sending items
        DB::update('update items set qty = qty-? where id = ?', array($item['qty'],$item['item_id']));
    }

    return response()->json(['data' => $last_id],200);

}

public function DsrReceive(Request $request){

    // $results = DB::table('stock_has_dsrs')
    // ->join('users', 'stock_has_dsrs.dsr_id', 'users.id')
    // ->join('stocks', 'stock_has_dsrs.stock_id', 'stocks.id')
    // ->select('stock_has_dsrs.id','stock_has_dsrs.stock_id','stock_has_dsrs.created_at','stocks.stock_name','stock_has_dsrs.dsr_id','users.name')
    // ->where('stock_has_dsrs.status','=',1)
    // ->orderBy('stock_has_dsrs.id','desc')
    // ->paginate(5);

   $results = DB::table('stock_dsr_items')
   ->join('items', 'stock_dsr_items.item_id', 'items.id')
   ->join('stock_has_dsrs', 'stock_has_dsrs.id', 'stock_dsr_items.stock_dsr_id')
   ->join('users', 'stock_has_dsrs.dsr_id', 'users.id')
   ->select('items.name','items.updated_at','stock_dsr_items.qty','users.name as user_name')
   ->where('items.status','=',1)
   ->orderBy('items.name','asc')
   ->paginate(10);

   return view('admin.item.dsr_receive', ['stockData'=>$results]);
}




public function GetStockItems(Request $request){

    $items = DB::select('select sd.id, sd.dsr_id, sd.created_at, sdi.id, sdi.item_id, sdi.qty, i.name FROM stock_has_dsrs AS sd
        INNER JOIN stock_dsr_items AS sdi ON (sd.id = sdi.stock_dsr_id) INNER JOIN items AS i ON (sdi.item_id = i.id) 
        WHERE sd.status = ? AND sdi.stock_dsr_id= ?', [1, $request->id]);
    
    return response()->json(['data' => $items],200);
}





public function TransferStatus(){
    return view('admin.item.transfer_status');
}





public function ViewBalance(){

    $dsrs = DB::table('users')->join('stock_has_dsrs', 'stock_has_dsrs.dsr_id', 'users.id')->select('users.id','users.name')->where('stock_has_dsrs.status','=',1)->where('users.status','=',1)->get();

    $all_stock_items = DB::table('items')->select('name','qty')->where('status','=',1) ->orderBy('name','asc')->paginate(10);

    $all_dsr_items = DB::table('items')
    ->join('stock_dsr_items', 'stock_dsr_items.item_id', 'items.id')
    ->join('stock_has_dsrs', 'stock_has_dsrs.id', 'stock_dsr_items.stock_dsr_id')
    ->select('items.name','stock_dsr_items.qty')
    ->where('items.status','=',1)
    ->orderBy('items.name','asc')
    ->paginate(10);

    return view('admin.item.view_balance', ['dsrList'=>$dsrs,'stockData'=>$all_stock_items,'dsrStockData'=>$all_dsr_items]);

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
