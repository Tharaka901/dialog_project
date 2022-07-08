<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use DB;

class PassportAuthController extends Controller
{

   public function MobileLogin(Request $request)
   {

       $request->validate([
           'email' => 'required',
           'password' => 'required',
       ]);
       $user_login = DB::table('users')->where('email', '=', $request->get('email'))->get();


       if(count($user_login) !=0){
           foreach($user_login as $user){
             if(Hash::check($request->get('password'), $user->password)){
                return response()->json(['data' => $user_login], 200);
            }else{
                return response()->json(['data' => "User name or password is incorrect!"], 200);
            }
        }
    }else{
        return response()->json(['data' => "Please check your credentials!"], 401);
    }

}

}
