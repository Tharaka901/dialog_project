<?php

namespace App\Http\Controllers;

use App\Models\DsrReturn;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;

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

     // update stock (+)
    $update_item_qty = DB::table('items')->where('id','=',$request->item_id)->increment('qty', $request->qty);

    $dsr_stock_items = DB::table('dsr_stock_items')->where('item_id','=',$request->item_id)->get();
    $deduct_qty = $request->qty/2;

    foreach($dsr_stock_items as $sdi){
        if($deduct_qty <  $sdi->qty){
            $update_dsr_qty = DB::table('dsr_stock_items')->where('id','=',$sdi->id)->decrement('qty', $deduct_qty);
        }
    }

    // update return table status
    $update_return_status = DB::table('dsr_returns')->where('id','=',$request->id)->update(['status'=>1]);

    return response($update_item_qty);

}


}
