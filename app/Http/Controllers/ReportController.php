<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ReportController extends Controller
{

  public function SalesSummery(){
    return view('admin.report.sales_summery');
  }

  public function Collection(){

    date_default_timezone_set("Asia/colombo");
    $todayDate = date('Y-m-d');

     $collection = DB::table('users')
      ->leftjoin('dsrs', 'users.id', 'dsrs.dsr_user_id')
      ->leftjoin('credit_collections', 'users.id', 'credit_collections.dsr_id')
      ->select('users.id','users.name','dsrs.created_at','in_hand','cash','cheque', DB::raw('sum(credit_collections.credit_collection_amount) as ccAmount'))
      ->groupBy('dsrs.id')
      ->get();


    return view('admin.report.collection',["collection"=> $collection]);
  }

}
