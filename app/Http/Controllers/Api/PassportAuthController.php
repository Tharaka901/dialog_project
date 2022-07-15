<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use DB;

class PassportAuthController extends Controller
{

   public function MobileLogin(Request $request){
       $request->validate([
           'email' => 'required',
           'password' => 'required',
       ]);
       $user_login = DB::table('users')->where('email', '=', $request->get('email'))->get();
       if(count($user_login) !=0){
           foreach($user_login as $user){
             if(Hash::check($request->get('password'), $user->password)){
                return response()->json(['data' => array('info'=>$user_login,'error'=>null)], 200);
            }else{
                //User name or password is incorrect!
                return response()->json(['data' => array('info'=>[],'error'=>1) ], 200);   
            }
        }
    }else{
        // Please check your credentials!
        return response()->json(['data' => array('info'=>[],'error'=>0) ], 200);   
    }
}

public function MobileUpdatePassword(Request $request){
   $request->validate([
       'user_id' => 'required',
       'email' => 'required',
       'password' => 'required',
   ]);
   //get the new password with hash
   $new_password = HASH::make($request->get('password'));

   $updateUserData = DB::table('users')
   ->where('id','=',$request->get('user_id'))
   ->update([
    'password'=> $new_password
]);

   $user_data = DB::table('users')->where('email', '=', $request->get('email'))->get();
   if($updateUserData){
    return response()->json(['data' => array('info'=>$user_data,'error'=>null)], 200);
}else{
    // Oops.. Error Occured!
 return response()->json(['data' => array('info'=>[],'error'=>0) ], 401); 
}
}


public function MobileGetUserbyId(Request $request){
    $user_data = DB::table('users')->where('status', '=', $request->get('user_id'))->get();
    if($user_data){
        return response()->json(['data' => array('info'=>$user_data,'error'=>null)], 200);
    }else{
    // Oops.. Error Occured!
     return response()->json(['data' => array('info'=>[],'error'=>0) ], 401); 
 }
}

public function MobileGetItems(Request $request){
    $item_data = DB::table('items')->where('status', '=', 1)->get();
    if($item_data){
        return response()->json(['data' => array('info'=>$item_data,'error'=>null)], 200);
    }else{
    // Oops.. Error Occured!
     return response()->json(['data' => array('info'=>[],'error'=>0) ], 401); 
 }
}



public function MobileDsrStockData(Request $request){
    $allData = [];
    $results = DB::select('select sd.id, sd.stock_id, s.stock_name, sd.dsr_id, u.name from stock_has_dsrs AS sd inner join users AS u on(sd.dsr_id = u.id) inner join stocks AS s on (sd.stock_id = s.id) where sd.status = ? AND u.id = ?', [1,$request->id]);
    $allData["stock_data"] = $results;
    foreach($results as $data){
        $items = DB::select('select sd.id, sd.dsr_id, sd.created_at, sdi.id, sdi.item_id, sdi.qty, i.name FROM stock_has_dsrs AS sd
            INNER JOIN stock_dsr_items AS sdi ON (sd.id = sdi.stock_dsr_id) INNER JOIN items AS i ON (sdi.item_id = i.id) 
            WHERE sd.status = ? AND sdi.stock_dsr_id= ?', [1, $data->id]);
        $allData["item_data"] = $items;
    }
    return response()->json(['data' => array('info'=>$allData,'error'=>null)],200);
}




}


