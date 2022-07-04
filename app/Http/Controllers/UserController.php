<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use DB;
use Alert;
use App\Models\User;

class UserController extends Controller
{
    public function user(){

        $data = DB::table('users')
        ->select('id','name','email','nic','contact','route','profile_photo_path')
        ->where('status','=','1')
        ->orderBy('id', 'desc')
        ->paginate(5);

        return view('admin.user.user', ['userData'=>$data]);
    }

    public function UserRegistration(Request $request){      

        // $validated = $request->validate([
        //     'user_name' => 'required|:posts|max:255',
        //     'user_email' => 'required',
        //     'user_password' => 'required',
        //     'user_confirm_password' => 'required|confirmed',
        //     'user_image' => 'required',
        // ]);

        $data = User::all()->where('status', '=',"1")->where('email', '=',$request->get('user_email'));

        if($data->isEmpty()){

             // CREATE(insert)
            if ($request->file('user_image')){

               $name = $request->file('user_image')->getClientOriginalName(); 
               $fileName = time().'.'.$request->file('user_image')->extension();  
               $saveFile = $request->file('user_image')->move(public_path('upload/user_images'), $fileName);

               $user = new User;
               $user->name = $request->get('user_name');
               $user->email = $request->get('user_email');
               $user->nic = $request->get('user_nic');
               $user->contact = $request->get('user_contact');
               $user->route = $request->get('user_route');
               $user->password = HASH::make($request->get('user_password'));
               $user->profile_photo_path = "upload/user_images/".$fileName;
               $user->save();
            // getting last id after save
            // $last_id = $user->id;
               Alert::success('Success!!', 'User Registered');
               return redirect()->back();
           }
       }else{
            // user is exist
        Alert::warning('Oops!!', "User Exist");
        return redirect()->back();
    }
}


public function GetUser(Request $request){
 $data = DB::table('users')
 ->select('id','name','email','nic','contact','route','profile_photo_path')
 ->where('status','=','1')
 ->where('id','=',$request->id)
 ->paginate(5);

 return response($data);
}

public function UserUpdate(Request $request){

    $data = User::all()->where('status', '=',"1")->where('email', '=',$request->get('edit_user_email'));
    $new_password = "";
    $new_image = "";

    foreach($data as $dat){
        if($request->file('edit_user_image') == ""){
            $new_image = $dat->profile_photo_path;
        }else{
            $name = $request->file('edit_user_image')->getClientOriginalName(); 
            $fileName = time().'.'.$request->file('edit_user_image')->extension();  
            $saveFile = $request->file('edit_user_image')->move(public_path('upload/user_images'), $fileName);
            $new_image = "upload/user_images/".$fileName;
        }

        if($request->get('edit_user_password') == ""){
            $new_password = $dat->password;
        }else{
            $new_password = HASH::make($request->get('edit_user_password'));
        }
    }


    if(!$data->isEmpty()){

        $updateUserData = DB::table('users')
        ->where('id','=',$request->get('edit_user_id'))
        ->update([
            'name'=>$request->get('edit_user_name'),
            'email'=>$request->get('edit_user_email'),
            'nic'=>$request->get('edit_user_nic'),
            'contact'=>$request->get('edit_user_contact'),
            'route'=>$request->get('edit_user_route'),
            'password'=> $new_password,
            'profile_photo_path'=>$new_image
        ]);

        Alert::success('Updated!!', 'User Update Successfully');
        return redirect()->back();

    }

}


public function DeleteUser(Request $request){

 $deleUser = DB::table('users')
 ->where('id','=',$request->get('delete_user_id'))
 ->update([
    'status'=>0,
]);

 Alert::success('Deleted!!', 'User deleted Successfully');
 return redirect()->back();

}



}
