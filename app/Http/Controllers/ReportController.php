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
    ->select(
      'users.id',
      'users.name',
      'dsrs.created_at',
      'in_hand',
      'cash',
      'cheque',
      DB::raw('sum(credit_collections.credit_collection_amount) as ccAmount')
    )
    ->where('users.status','=',1)
    ->get();

    $bank_summery_items = DB::table('bankings')
    ->select('bank_name','bank_ref_no','bank_amount')
    ->where('status', '=', 1)
    ->get();

    $collection->push(array('bank' => $bank_summery_items));

    return view('admin.report.collection',["collection"=> $collection]);
  }

}
