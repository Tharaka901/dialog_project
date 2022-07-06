<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;
use Alert;
use App\Models\Item;


class ItemController extends Controller
{
    public function item(){
        $data = DB::table('items')
        ->select('id','name','purchasing_price','selling_price','qty')
        ->where('status','=','1')
        ->orderBy('id', 'desc')
        ->paginate(5);
        return view('admin.item.item',['itemData'=>$data]);
    }

    public function ItemRegistration(Request $request){
        $data = Item::all()->where('status', '=',"1")->where('name', '=',$request->get('item_name'));
        if($data->isEmpty()){

         $item = new Item;
         $item->name = $request->get('item_name');
         $item->purchasing_price = $request->get('item_pprice');
         $item->selling_price = $request->get('item_sprice');
         $item->qty = $request->get('item_qty');
         $item->save();
        // getting last id after save
        // $last_id = $item->id;
         Alert::success('Success!!', 'Item Registered');
         return redirect()->back();
     }
 }

 public function GetItem(Request $request){
    $data = DB::table('items')
    ->select('id','name','purchasing_price','selling_price','qty')
    ->where('status','=','1')
    ->where('id','=',$request->id)
    ->paginate(5);

    return response($data);
}


public function ItemUpdate(Request $request){
  $updateItemData = DB::table('items')
  ->where('id','=',$request->get('edit_item_id'))
  ->update([
    'name'=>$request->get('edit_item_name'),
    'purchasing_price'=>$request->get('edit_item_pprice'),
    'selling_price'=>$request->get('edit_item_sprice'),
    'qty'=>$request->get('edit_item_qty'),
]);
  Alert::success('Updated!!', 'Item Update Successfully');
  return redirect()->back();
}


public function DeleteItem(Request $request){

  $updateItemData = DB::table('items')
  ->where('id','=',$request->get('delete_item_id'))
  ->update([
    'status'=>0,
]);

  Alert::success('Deleted!!', 'Item Deleted Successfully');
  return redirect()->back();

}

public function SendInventry(){
    return view('admin.item.send_inventry');
}

public function ReturnInventry(){
    return view('admin.item.return_inventry');
}

public function ViewBalance(){
    return view('admin.item.view_balance');
}


}
