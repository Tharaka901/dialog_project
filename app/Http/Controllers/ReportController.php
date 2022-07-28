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
    ->leftjoin('dsrs', 'dsrs.dsr_user_id', 'users.id')
    ->leftjoin('credit_collections', 'credit_collections.dsr_id', 'users.id')
    ->select('users.id','users.name','dsrs.created_at','in_hand','cash','cheque',DB::raw('sum(credit_collections.credit_collection_amount) as ccAmount'))
    ->where('users.status','=',1)
    ->groupBy('dsrs.dsr_user_id')
    ->get();

    $bank_summery_items = DB::table('bankings')
    ->select('bank_name','bank_amount')
    ->where('status', '=', 1)
    ->get();

    $dbank_summery_items = DB::table('directbankings')
    ->select('direct_bank_name','direct_bank_amount')
    ->where('status', '=', 1)
    ->get();


    foreach($collection as $col){
      $bank_data = DB::table('bankings')
      ->select('bank_name','bank_amount')
      ->where('status', '=', 1)
      ->whereIN('dsr_id', array($col->id))
      ->get();

      $dbank_data = DB::table('directbankings')
      ->select('direct_bank_name','direct_bank_amount')
      ->where('status', '=', 1)
      ->where('dsr_id', '=', $col->id)
      ->get();

      $collection->push($bank_data);
      $collection->push($dbank_data);
    }


    print_r(json_encode($collection));
    exit();
    

    return view('admin.report.collection',["bank"=>$bank_summery_items, "dbank"=>$dbank_summery_items, "collectionData"=>$collection ]);
  }

}
