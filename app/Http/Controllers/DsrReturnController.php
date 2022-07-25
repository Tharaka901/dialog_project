<?php

namespace App\Http\Controllers;

use App\Models\DsrReturn;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;
use Alert;

class DsrReturnController extends Controller
{

    public function DsrReturn(Request $request){

    // need to change the query according to mobile side
       $results = DB::table('dsr_returns')
       ->join('items', 'dsr_returns.item_id', 'items.id')
       ->join('users', 'dsr_returns.dsr_id', 'users.id')
       ->select('items.id as item_id','items.name','items.created_at','dsr_returns.id as return_id','dsr_returns.qty','users.name as user_name')
       ->where('dsr_returns.status','=',0)
       ->orderBy('items.name','asc')
       ->paginate(5);

       return view('admin.item.dsr_receive', ['returnData'=>$results]);
   }




   public function UpdateReturnItems(Request $request){

    $return_data = DB::table('dsr_retun_no')->join('dsr_returns', 'dsr_returns.id', 'dsr_retun_no.dsr_return_id')
    ->select('dsr_stock_id','qty')->where('dsr_returns.status','=',0)->where('dsr_returns.id','=',$request->get('id'))->get();

    $can_deduct = 0;
    $deduct_stock = 0;

    foreach($return_data as $ids){
        $stock_items_data = DB::table('dsr_stock_items')->join('dsr_stocks' ,'dsr_stock_items.dsr_stock_id' ,'dsr_stocks.id')->select('dsr_stock_items.id','dsr_stock_id','item_id','qty')->where('dsr_stock_items.dsr_stock_id','=',$ids->dsr_stock_id)->where('dsr_stock_items.item_id','=',$request->item_id)->get();

        foreach($stock_items_data as $sid){

            if($sid->qty >=  $ids->qty){
                $can_deduct = 1;
                $deduct_stock = $sid->id;
                break;
            }
        }
    }

    
        // $update_dsr_qty = DB::table('dsr_stock_items')->where('item_id','=',$request->item_id)->where('dsr_stock_id','=',$ids->dsr_stock_id)->decrement('qty', $ids->qty);


    // update dsr stock (-)
    $update_dsr_qty = DB::table('dsr_stock_items')->where('id','=',$deduct_stock)->decrement('qty', $ids->qty);

       // update stock (+)
    $update_item_qty = DB::table('items')->where('id','=',$request->item_id)->increment('qty', $request->qty);

    // update return table status as 1
    $update_return_status = DB::table('dsr_returns')->where('id','=',$request->id)->update(['status'=>1]);

    return response("ok");

}

public function RollBackReturnItems(Request $request){

    // update return table status as 2
    $update_return_status = DB::table('dsr_returns')->where('id','=',$request->id)->update(['status'=>2]);

    Alert::success('Success!!', 'Stock Rejected successfully!');
    return redirect()->back();

}


}
