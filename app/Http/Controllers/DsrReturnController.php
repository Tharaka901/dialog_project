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
       ->select('dsr_returns.dsr_stock_id','items.id as item_id','items.name','items.created_at','dsr_returns.id as return_id','dsr_returns.qty','users.name as user_name')
       ->where('dsr_returns.status','=',0)
       ->orderBy('items.name','asc')
       ->paginate(5);

       return view('admin.item.dsr_receive', ['returnData'=>$results]);
   }




   public function UpdateReturnItems(Request $request){

     // update stock (+)
    $update_item_qty = DB::table('items')->where('id','=',$request->item_id)->increment('qty', $request->qty);

    // update dsr stock (-)
    $update_dsr_qty = DB::table('dsr_stock_items')->where('item_id','=',$request->item_id)->where('dsr_stock_id','=',$request->dsr_stock_id)->decrement('qty', $request->qty);


    // update return table status as 1
    $update_return_status = DB::table('dsr_returns')->where('id','=',$request->id)->update(['status'=>1]);

    return response($update_item_qty);

}

public function RollBackReturnItems(Request $request){

    // update return table status as 2
    $update_return_status = DB::table('dsr_returns')->where('id','=',$request->id)->update(['status'=>2]);

    Alert::success('Success!!', 'Stock Rejected successfully!');
    return redirect()->back();

}


}
