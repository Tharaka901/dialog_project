<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;
class DashboardController extends Controller
{
    public function Dashboard(){

      date_default_timezone_set("Asia/colombo");
      $todayDate = date('Y-m-d');

         //set dashboard data
      $dashboard_data1 = DB::table('pending_sum')
      ->select(
        DB::raw('sum(inhand_sum) as inhand'),
        DB::raw('sum(sales_sum) as sales'),
        DB::raw('sum(credit_sum) as credit'),
        DB::raw('sum(credit_collection_sum) as creditcol'),
        DB::raw('sum(banking_sum) as bank'),
        DB::raw('sum(direct_banking_sum) as direct_bank'),
        DB::raw('sum(retialer_sum) as retialer')
    )
      ->where('pending_sum.status', '=', 2)
      ->where('pending_sum.date', '=', $todayDate)
      ->get();


      $dashboard_data2 = DB::table('pending_sum')
      ->join('users', 'pending_sum.dsr_id', 'users.id')
      ->select('pending_sum.id','pending_sum.dsr_id','users.name','users.profile_photo_path','date','inhand_sum','sales_sum','credit_sum','credit_collection_sum','banking_sum','direct_banking_sum','retialer_sum')
      ->where('pending_sum.status', '=', 2)
       ->where('pending_sum.date', '=', $todayDate)
      ->paginate(5);


      return view('admin.index',['summaryData'=>$dashboard_data1,'usersData'=>$dashboard_data2]);
  }
}
