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

    $stock_has_dsrs = DB::insert('insert into stock_has_dsrs (stock_id, dsr_id, created_at) values (?, ?, ?)', [$stock, $dsr, date('Y-m-d')]);
    $last_inserted_data = DB::table('stock_has_dsrs')->latest('id')->first();
    $last_id = $last_inserted_data->id;

    foreach($tableData as $item){
        DB::insert('insert into stock_dsr_items (item_id, qty, stock_dsr_id, created_at) values (?, ?, ?, ?)', [$item['item_id'], $item['qty'],  $last_id , date('Y-m-d')]);
    }


    return response()->json(['data' => $last_inserted_data],200);

}

public function DsrReceive(Request $request){

    $results = DB::select('select sd.id, sd.stock_id, s.stock_name, sd.dsr_id, sd.created_at, u.name from stock_has_dsrs AS sd inner join users AS u on(sd.dsr_id = u.id) inner join stocks AS s on (sd.stock_id = s.id) where sd.status = ?', [1]);
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
    return view('admin.item.view_balance');
}


}
