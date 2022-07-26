<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;
class DashboardController extends Controller
{
    public function Dashboard(){

         //set dashboard data
     $dashboard_data = DB::table('pending_sum')
     ->join('users', 'pending_sum.dsr_id', 'users.id')
     ->select('pending_sum.id','pending_sum.dsr_id','users.name','date','inhand_sum','sales_sum','credit_sum','credit_collection_sum','banking_sum','direct_banking_sum','retialer_sum')
     ->where('date', '=', $request->get('date'))
     ->where('pending_sum.dsr_id', '=', $request->get('dsr_id'))
     ->get();


     return view('admin.index','itemData'=>$dashboard_data);
 }
}
