<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
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
     $admin_login = Admin::all()->where('email', '=', $request->get('email'))->where('password', '=', $request->get('password'));
     if(count($admin_login) != 0){
        $request->session()->put('user_id', $admin_login[0]->id);
        $request->session()->put('user_name', $admin_login[0]->name);
        return redirect()->route('dashboard');
    }else{
       Alert::warning('Oops..', 'User Not Exist!');
       return redirect()->back();
   }
}

public function Logout(Request $request){
    $request->session()->flush();
    return redirect()->route('/');
}


}
