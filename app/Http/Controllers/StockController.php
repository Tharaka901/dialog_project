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
     // $update_item_qty = DB::table('items')->where('id','=',$td["item_id"])->decrement('qty', $td["qty"]); 
   }


   return response()->json(['data' => $dsr_stock],200);

}






// public function TransferStatus(){

//     $allData = [];
//     $subData = [];

//     $TransferStatus = DB::table('dsr_stocks')
//     ->join('users', 'dsr_stocks.dsr_id', 'users.id')
//     ->select('users.id',
//         'users.name',
//         'dsr_stocks.total',
//         'dsr_stocks.created_at',
//         'dsr_stocks.status',
//         'dsr_stocks.id as stockid'
//     )
//     ->get();

    // foreach ($TransferStatus as $transfer){

    //     $transfer_items = DB::table('dsr_stock_items')
    //     ->leftjoin('dsr_stocks', 'dsr_stock_items.dsr_stock_id', 'dsr_stocks.id')
    //     ->join('users', 'dsr_stocks.dsr_id', 'users.id')
    //     ->join('items', 'dsr_stock_items.item_id', 'items.id')
    //     ->select('items.name',
    //         'dsr_stock_items.qty',
    //         'items.selling_price',
    //         'dsr_stock_items.issue_return_qty',
    //         'dsr_stock_items.sale_qty',
    //         'dsr_stock_items.approve_return_qty',
    //         'dsr_stock_items.created_at as dsic',
    //         'users.id',
    //         'users.name',
    //         'dsr_stocks.total',
    //         'dsr_stocks.created_at',
    //         'dsr_stocks.status',
    //         'dsr_stocks.id as stockid'
    //     )
    //     ->whereIN('dsr_stock_id',array($transfer->stockid))
    //     ->where('issue_return_qty','!=',0)
    //     ->limit(1)
    //     ->get();

    //     for ($x = 0; $x < count($transfer_items); $x++) {
    //         $subData[] = (object) ['user_id' => $transfer_items{$x}->id,'name' => $transfer_items{$x}->name,'total' => ($transfer_items{$x}->issue_return_qty * $transfer_items{$x}->selling_price) ,'status' => $transfer_items{$x}->status,'stockid' => $transfer_items{$x}->stockid, 'created_at' => $transfer_items{$x}->dsic,"subData"=>1];
    //     }
    // }



//     for ($x = 0; $x < count($TransferStatus); $x++) {
//         $allData[] = (object) ['user_id' => $TransferStatus{$x}->id,'name' => $TransferStatus{$x}->name,'total' => $TransferStatus{$x}->total,'status' => $TransferStatus{$x}->status,'stockid' => $TransferStatus{$x}->stockid, 'created_at' => $TransferStatus{$x}->created_at,"subData"=>0];
//     }


//     if(count($subData) >0 ){

//         foreach($subData as $subData){
//          $allData[] = $subData;  
//      }
//  }

//  return view('admin.item.transfer_status', ['transferStatus'=>$allData]);
// }


public function TransferStatus(){

    $allData = [];
    $subData = [];

    $pending_data = DB::table('dsr_stocks')
    ->join('users', 'dsr_stocks.dsr_id', 'users.id')
    ->select('users.id',
        'users.name',
        'dsr_stocks.total',
        'dsr_stocks.created_at',
        'dsr_stocks.status',
        'dsr_stocks.id as stockid'
    )
    ->where('dsr_stocks.status','=',0)
    ->paginate(5);

    $done_data = DB::table('dsr_stocks')
    ->join('users', 'dsr_stocks.dsr_id', 'users.id')
    ->select('users.id',
        'users.name',
        'dsr_stocks.total',
        'dsr_stocks.created_at',
        'dsr_stocks.status',
        'dsr_stocks.id as stockid'
    )
    ->where('dsr_stocks.status','=',1)
    ->paginate(5);


    $getRejectedItems = DB::table('dsr_stocks')
    ->join('users', 'dsr_stocks.dsr_id', 'users.id')
    ->select('users.id',
        'users.name',
        'dsr_stocks.total',
        'dsr_stocks.created_at',
        'dsr_stocks.status',
        'dsr_stocks.id as stockid'
    )
    ->get();

    // $idArr = [];
    // foreach($getRejectedItems as $ritems){
    //     $idArr[] =$ritems->stockid;
    // }

    $rejected_data = DB::table('dsr_stock_items')
    ->leftjoin('dsr_stocks', 'dsr_stock_items.dsr_stock_id', 'dsr_stocks.id')
    ->join('users', 'dsr_stocks.dsr_id', 'users.id')
    ->join('items', 'dsr_stock_items.item_id', 'items.id')
    ->select(
        DB::raw('sum(items.selling_price * dsr_stock_items.issue_return_qty) as total'),
        'dsr_stock_items.created_at',
        'users.name',
        'dsr_stocks.id as stockid')
    // ->whereIN('dsr_stock_items.dsr_stock_id',$idArr)
    ->where('issue_return_qty','!=',0)
    ->groupBy('dsr_stocks.id')
    ->paginate(5);

    return view('admin.item.transfer_status', ['pending_data'=>$pending_data, 'done_data'=>$done_data, 'rejected_data'=>$rejected_data]);
}



public function viewTransferItems(Request $request){

    $transfer_items = DB::table('dsr_stock_items')
    ->join('dsr_stocks', 'dsr_stocks.id', 'dsr_stock_items.dsr_stock_id')
    ->join('items', 'dsr_stock_items.item_id', 'items.id')
    ->select('items.name',
        'dsr_stock_items.qty',
        'dsr_stock_items.issue_return_qty',
        'dsr_stock_items.sale_qty',
        'dsr_stock_items.approve_return_qty',
        'dsr_stock_items.retailer_qty',
        'dsr_stocks.status'
    )
    ->where('dsr_stock_id','=',$request->id)
    // ->where('dsr_stock_items.qty','!=',0)
     ->where('dsr_stock_items.updated_at','!=',null)
    ->get();

    return response($transfer_items);
}


public function viewTransferRejectedItems(Request $request){

    $transfer_items = DB::table('dsr_stock_items')
    ->join('dsr_stocks', 'dsr_stocks.id', 'dsr_stock_items.dsr_stock_id')
    ->join('items', 'dsr_stock_items.item_id', 'items.id')
    ->select('items.name',
        'dsr_stock_items.qty',
        'dsr_stock_items.issue_return_qty',
        'dsr_stock_items.sale_qty',
        'dsr_stock_items.approve_return_qty',
        'dsr_stock_items.retailer_qty',
        'dsr_stocks.status'
    )
    ->where('dsr_stock_items.dsr_stock_id','=',$request->id)
     ->where('dsr_stock_items.created_at','!=',null)
    ->where('dsr_stock_items.issue_return_qty','!=',0)
    // ->ORwhere('dsr_stock_items.approve_return_qty','!=',0)
    ->get();

    return response($transfer_items);
}





public function ViewBalance(){
    $dsrs = DB::table('users')
    ->join('dsr_stocks', 'dsr_stocks.dsr_id', 'users.id')
    ->select('users.id','users.name')->where('dsr_stocks.status','=',1)
    ->where('users.status','=',1)
    ->distinct()
    ->get();

    // $all_dsr_items = DB::table('items')
    // ->leftjoin('dsr_stock_items','dsr_stock_items.item_id','item_id')
    // ->leftjoin('dsr_stocks','dsr_stocks.id','dsr_stock_items.dsr_stock_id')
    // ->select('name','items.qty','dsr_stocks.status','dsr_stock_items.issue_return_qty')
    // ->where('items.status','=',1)
    // ->groupBy('items.id')
    // ->orderBy('name','asc')
    // ->get();
    
    $all_dsr_items = DB::table('items')->leftjoin('dsr_stock_items','dsr_stock_items.item_id','item_id')->leftjoin('dsr_stocks','dsr_stocks.id','dsr_stock_items.dsr_stock_id')->leftjoin('pending_sum', 'pending_sum.dsr_id', 'dsr_stocks.dsr_id')->select('name','items.qty','dsr_stocks.status','dsr_stock_items.issue_return_qty','dsr_stock_items.approve_return_qty','dsr_stock_items.sale_qty','dsr_stock_items.retailer_qty','pending_sum.status as pendingSum')->where('items.status','=',1)->groupBy('items.id')->orderBy('name','asc')->get();

    $array = json_decode(json_encode($all_dsr_items), true);
    
    return view('admin.item.view_balance', ['dsrList'=>$dsrs,'dsrStockData'=>$array,"part"=>0]);
}


public function GetStockItemsById(Request $request){

    $selected_date = $request->get('date');
    $selected_time = $request->get('time').":00";
    $stock_id = $request->get('stock_id');
    $array = [];


    $dsrs = DB::table('users')->join('dsr_stocks', 'dsr_stocks.dsr_id', 'users.id')->select('users.id','users.name')->where('dsr_stocks.status','=',1)->where('users.status','=',1)->distinct()->get();

    if($stock_id == "all"){

        $all_stock_items = DB::table('items')->select('name',DB::raw('sum(qty) as qty'))->where('status','=',1)->groupBy('items.id')->orderBy('name','asc')->get();

        $all_dsr_items = DB::table('items')->leftjoin('dsr_stock_items', 'dsr_stock_items.item_id', 'items.id')->leftjoin('dsr_stocks', 'dsr_stocks.id', 'dsr_stock_items.dsr_stock_id')->select('items.name',DB::raw('sum(items.qty) as qty'),'dsr_stocks.status','dsr_stock_items.issue_return_qty')->where('items.status','=',1)->groupBy('items.id')->orderBy('items.name','asc')->get();


        for ($i=0; $i < count($all_dsr_items); $i++) { 

            $itemName = $all_dsr_items[$i]->name;
            $itemPrice = floatval($all_dsr_items[$i]->qty);

            for ($j=0; $j < count($all_stock_items); $j++) { 
                if(isset($all_stock_items[$j]->name)){
                    if($itemName == $all_stock_items[$j]->name){
                        $itemPrice = $itemPrice + floatval($all_stock_items[$j]->qty);
                    }
                }
            }
            // $all_stock_items->push(array("name"=>$all_dsr_items[$i]->name,"qty"=>$itemPrice));
            $aaa = array("name"=>$all_dsr_items[$i]->name,"qty"=>$itemPrice, "status"=>$all_dsr_items[$i]->status,"issue_return_qty"=>$all_dsr_items[$i]->issue_return_qty);
            $array[] = json_decode(json_encode($aaa), true);
        }

        return view('admin.item.view_balance', ['dsrList'=>$dsrs,'dsrStockData'=>$array,'selected_date'=>$selected_date,'selected_time'=>$selected_time,'stock_name'=>$stock_id,"part"=>0]);


    }else if($stock_id == "main"){

        // $all_dsr_items = DB::table('items')->leftjoin('dsr_stock_items','dsr_stock_items.item_id','item_id')->leftjoin('dsr_stocks','dsr_stocks.id','dsr_stock_items.dsr_stock_id')->select('items.name','items.qty','dsr_stocks.status','dsr_stock_items.issue_return_qty')->where('items.status','=',1)->groupBy('items.id')->orderBy('items.name','asc')->get();
            DB::table('items')->leftjoin('dsr_stock_items','dsr_stock_items.item_id','item_id')->leftjoin('dsr_stocks','dsr_stocks.id','dsr_stock_items.dsr_stock_id')->leftjoin('pending_sum', 'pending_sum.dsr_id', 'dsr_stocks.dsr_id')->select('name','items.qty','dsr_stocks.status','dsr_stock_items.issue_return_qty','pending_sum.status as pendingSum')->where('items.status','=',1)->groupBy('items.id')->orderBy('name','asc')->get();

        $array = json_decode(json_encode($all_dsr_items), true);
        return view('admin.item.view_balance', ['dsrList'=>$dsrs,'dsrStockData'=>$array,'selected_date'=>$selected_date,'selected_time'=>$selected_time,'stock_name'=>$stock_id,"part"=>0]);

    }else{

 $all_dsr_items = DB::table('items')
        ->join('dsr_stock_items', 'dsr_stock_items.item_id', 'items.id')
        ->join('dsr_stocks', 'dsr_stocks.id', 'dsr_stock_items.dsr_stock_id')
        ->leftjoin('pending_sum', 'pending_sum.dsr_id', 'dsr_stocks.dsr_id')

        // ->select('items.name', DB::raw('sum(dsr_stock_items.qty + dsr_stock_items.retailer_qty ) as qty'),'dsr_stock_items.retailer_qty','dsr_stocks.status','dsr_stock_items.issue_return_qty','dsr_stock_items.sale_qty','dsr_stock_items.approve_return_qty','dsr_stocks.status')

        ->select('items.name', DB::raw('sum(dsr_stock_items.qty) as qty'),'dsr_stock_items.retailer_qty','dsr_stocks.status','dsr_stock_items.issue_return_qty','dsr_stock_items.sale_qty','dsr_stock_items.approve_return_qty','dsr_stocks.status','pending_sum.status as pendingSum')

        ->where('items.status','=',1)
        ->where('dsr_stocks.dsr_id','=',$stock_id)
        ->where('dsr_stocks.status','=',1)
        // ->where('dsr_stock_items.qty','!=',0)
        ->groupBy('items.name')
        ->orderBy('items.name','asc')
        ->get();


        $array = json_decode(json_encode($all_dsr_items), true);

        $dsr_name = DB::table('users')->join('dsr_stocks', 'dsr_stocks.dsr_id', 'users.id')->select('users.id','users.name')->where('dsr_stocks.dsr_id','=',$stock_id)->get();
        $name = "";
        foreach($dsr_name as $dsr){
            $name = $dsr->name;
        }

        return view('admin.item.view_balance', ['dsrList'=>$dsrs,'dsrStockData'=>$array,'selected_date'=>$selected_date,'selected_time'=>$selected_time,'stock_name'=>$name,"part"=>1]);
    }



}




}
