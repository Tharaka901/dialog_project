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
      $bigArray = [];

      $collection = DB::table('users')
      ->leftjoin('dsrs', 'users.id', 'dsrs.dsr_user_id')
      ->leftjoin('credit_collections', 'users.id', 'credit_collections.dsr_id')
      ->select('users.id','users.name','dsrs.created_at','in_hand','cash','cheque', DB::raw('sum(credit_collections.credit_collection_amount) as ccAmount'))
      ->whereDate('dsrs.created_at', '=', $todayDate)
      ->whereDate('credit_collections.created_at', '=', $todayDate)
      ->groupBy('dsrs.id')
      ->get();
      $bigArray["collections"] = $collection;


      $banks = DB::table('bankings')->select('bank_name','bank_amount')->whereDate('created_at', '=', $todayDate)->where('dsr_id', '=', $collection[0]->id)->get();
      $bigArray["banks"] = $banks;



      print_r(json_encode($bigArray));
      exit();

      return view('admin.report.collection',["collection"=> $bigArray]);
  }

}
