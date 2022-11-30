<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use DB;
use Alert;
use App\Models\Admin;

class AdminController extends Controller
{

  public function main(Request $request){
    return view('admin.login');
  }

  public function Login(Request $request){
    $request->validate([
     'email' => 'required',
     'password' => 'required',
   ]);
   

    $admin_login = Admin::all()->where('email', '=', $request->get('email'));
    
    if(count($admin_login) != 0){

      foreach($admin_login as $login){
       if(Hash::check($request->get('password'), $login->password)){
         $request->session()->put('user_id', $login->id);
         $request->session()->put('user_name',$login->name);
         return redirect()->route('dashboard');

       }else{
         Alert::warning('Oops..', 'User name or password is incorrect!');
         return redirect()->back();
       }
     }


   }else{
     Alert::warning('Oops..', 'Please check your credentials!');
     return redirect()->back();
   }
 }


 public function Logout(Request $request){
  $request->session()->flush();
  return redirect()->route('/');
}


}
