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

       $results = DB::table('dsr_returns')
       ->join('items', 'dsr_returns.item_id', 'items.id')
       ->join('users', 'dsr_returns.dsr_id', 'users.id')
       ->select('items.id as item_id','items.name','dsr_returns.created_at','dsr_returns.id as return_id','dsr_returns.qty','users.name as user_name')
       ->where('dsr_returns.status','=',0)
       ->orderBy('items.name','asc')
       ->paginate(5);

       $results1 = DB::table('dsr_returns')
       ->join('items', 'dsr_returns.item_id', 'items.id')
       ->join('users', 'dsr_returns.dsr_id', 'users.id')
       ->select('items.id as item_id','items.name','dsr_returns.created_at','dsr_returns.id as return_id','dsr_returns.qty','users.name as user_name')
       ->where('dsr_returns.status','=',1)
       ->orderBy('items.name','asc')
       ->paginate(5);

       return view('admin.item.dsr_receive', ['returnData'=>$results,'returnedData'=>$results1]);
   }




 public function UpdateReturnItems(Request $request){

    $return_data = DB::table('dsr_retun_no')->join('dsr_returns', 'dsr_returns.id', 'dsr_retun_no.dsr_return_id')
    ->select('dsr_stock_id','qty')->where('dsr_returns.status','=',0)->where('dsr_returns.id','=',$request->get('id'))->get();

    $can_deduct = 0;
    $deduct_stock = 0;
    $deduct_qty = 0;
    $stock_qty = 0;
    $updated_id = 0;
    $balance_stock = 0;

    foreach($return_data as $ids){
        $stock_items_data = DB::table('dsr_stock_items')->join('dsr_stocks' ,'dsr_stock_items.dsr_stock_id' ,'dsr_stocks.id')->select('dsr_stock_items.id','dsr_stock_id','item_id','qty')->where('dsr_stock_items.dsr_stock_id','=',$ids->dsr_stock_id)->where('dsr_stock_items.item_id','=',$request->item_id)->get();

        foreach($stock_items_data as $sid){
            $stock_qty +=$sid->qty;

            if($sid->qty >=  $ids->qty){
                $can_deduct = 1;
                $deduct_stock = $sid->id;
                $deduct_qty = $ids->qty;
                break;
            }
        }
    }


        // $update_dsr_qty = DB::table('dsr_stock_items')->where('item_id','=',$request->item_id)->where('dsr_stock_id','=',$ids->dsr_stock_id)->decrement('qty', $ids->qty);

    if($can_deduct != 0){
        // update dsr stock (-)
        $update_dsr_qty = DB::table('dsr_stock_items')->where('id','=',$deduct_stock)->decrement('qty', $deduct_qty);
        DB::update('update dsr_stock_items set approve_return_qty = ? where id = ?', array(abs($deduct_qty),$deduct_stock));

    }else{


       if($stock_qty > $request->qty) {
        $count = 0;

        foreach($return_data as $stock_ids){
            $stock_items_data1 = DB::table('dsr_stock_items')
            ->join('dsr_stocks' ,'dsr_stock_items.dsr_stock_id' ,'dsr_stocks.id')
            ->select('dsr_stock_items.id','dsr_stock_id','item_id','qty')
            ->where('dsr_stock_items.dsr_stock_id','=',$stock_ids->dsr_stock_id)
            ->where('dsr_stock_items.item_id','=',$request->item_id)
            ->get();


            foreach($stock_items_data1 as $sid1){
                $updated_id = $sid1->id;

                 // set the approve_return_qty in db
                DB::update('update dsr_stock_items set approve_return_qty = approve_return_qty + ? where id = ?', array($sid1->qty,$sid1->id));

                    // set 0 to every primary key to set the actual blance by calculating
                DB::update('update dsr_stock_items set qty =  0 where id = ?', array($sid1->id));

                $count++;
            }

            if($count == 1){
             $balance_stock = $request->qty - $sid1->qty;
         }else {
            $balance_stock = $balance_stock - $sid1->qty;
        }

    }

        // set the actual balance in db
    DB::update('update dsr_stock_items set qty =  ? where id = ?', array(abs($balance_stock),$updated_id));
    DB::update('update dsr_stock_items set approve_return_qty = ? where id = ?', array(abs($balance_stock),$updated_id));





}



}


    // update stock (+)
$update_item_qty = DB::table('items')->where('id','=',$request->item_id)->increment('qty', $request->qty);


    // update return table status as 1
$update_return_status = DB::table('dsr_returns')->where('id','=',$request->id)->update(['status'=>1]);

return response($return_data);

}

public function RollBackReturnItems(Request $request){

    // update return table status as 2
    $update_return_status = DB::table('dsr_returns')->where('id','=',$request->id)->update(['status'=>2]);

    Alert::success('Success!!', 'Stock Rejected successfully!');
    return redirect()->back();

}


}
