<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bank;
use DB;

class ReportController extends Controller
{

  public function SalesSummery(){
    return view('admin.report.sales_summery');
  }

  public function Collection(){

    date_default_timezone_set("Asia/colombo");
    $todayDate = date('Y-m-d');

    $collection = DB::table('pending_sum')
    ->join('users','pending_sum.dsr_id','users.id')
    ->select('pending_sum.id','users.name',
      'pending_sum.date',
      'pending_sum.inhand_cash',
      'pending_sum.inhand_cheque',
      'pending_sum.credit_sum',
      'pending_sum.credit_collection_sum',
      'pending_sum.banking_sampath',
      'pending_sum.banking_peoples',
      'pending_sum.banking_cargils',
      'pending_sum.banking_sampth_online',
      'pending_sum.direct_banking_sampath',
      'pending_sum.direct_banking_peoples',
      'pending_sum.direct_banking_cargils',
      'pending_sum.direct_banking_sampth_online'
    )
    ->where('pending_sum.status','=',2)
    ->where('pending_sum.date','=',$todayDate)
    ->paginate(20);

    return view('admin.report.collection',["collectionData"=>$collection]);
  }


  public function SearchCollection(Request $request){

    $text = $request->search;
    $collection_from = $request->fromdate;
    $collection_to = $request->todate;

    if($text !=""){
      session(['collection_name' => $text]);
    }

    if($collection_from !=""){
      session(['collection_from' => $collection_from]);
    }

    if($collection_to !=""){
     session(['collection_to' => $collection_to]);
   }

   if($request->session()->get('collection_name') != ""){

    $users = DB::table('users')->select('id','name')->where('name', 'like', '%' . $request->session()->get('collection_name') . '%' )->where('status','=',1)->get();

    $userIds = [];
    foreach($users as $user){
      array_push($userIds,$user->id);
    }

    $collection = DB::table('pending_sum')
    ->join('users','pending_sum.dsr_id','users.id')
    ->select('pending_sum.id','users.name','pending_sum.date','pending_sum.inhand_cash','pending_sum.inhand_cheque','pending_sum.credit_sum','pending_sum.credit_collection_sum','pending_sum.banking_sampath','pending_sum.banking_peoples','pending_sum.banking_cargils','pending_sum.direct_banking_sampath','pending_sum.direct_banking_peoples','pending_sum.direct_banking_cargils')
    ->where('pending_sum.status','=',2)
    ->whereIn('users.id', $userIds)
    ->paginate(20);

    return view('admin.report.search_collection',["collectionData"=>$collection]);


  }else if($request->session()->get('collection_from') != "" && $request->session()->get('collection_to') != ""){

    $collection = DB::table('pending_sum')
    ->join('users','pending_sum.dsr_id','users.id')
    ->select('pending_sum.id','users.name','pending_sum.date','pending_sum.inhand_cash','pending_sum.inhand_cheque','pending_sum.credit_sum','pending_sum.credit_collection_sum','pending_sum.banking_sampath','pending_sum.banking_peoples','pending_sum.banking_cargils','pending_sum.direct_banking_sampath','pending_sum.direct_banking_peoples','pending_sum.direct_banking_cargils')
    ->where('pending_sum.status','=',2)
    ->whereBetween('pending_sum.date', [$request->session()->get('collection_from'), $request->session()->get('collection_to')])
    ->paginate(20);

    return view('admin.report.search_collection',["collectionData"=>$collection]);


  }else if($request->session()->get('collection_from') != "" && $request->session()->get('collection_to') != "" && $request->session()->get('collection_name') != ""){

   $users = DB::table('users')->select('id','name')->where('name', 'like', '%' . $request->session()->get('collection_name') . '%' )->where('status','=',1)->get();

   $userIds = [];
   foreach($users as $user){
    array_push($userIds,$user->id);
  }

  $collection = DB::table('pending_sum')
  ->join('users','pending_sum.dsr_id','users.id')
  ->select('pending_sum.id','users.name','pending_sum.date','pending_sum.inhand_cash','pending_sum.inhand_cheque','pending_sum.credit_sum','pending_sum.credit_collection_sum','pending_sum.banking_sampath','pending_sum.banking_peoples','pending_sum.banking_cargils','pending_sum.direct_banking_sampath','pending_sum.direct_banking_peoples','pending_sum.direct_banking_cargils')
  ->where('pending_sum.status','=',2)
  ->whereIn('users.id', $userIds)
  ->whereBetween('pending_sum.date', [$request->session()->get('collection_from'), $request->session()->get('collection_to')])
  ->paginate(20);

  return view('admin.report.search_collection',["collectionData"=>$collection]);

}else{
    // return $this->Collection();
  return redirect()->back()->withErrors(['msg' => 'No Data Found']);
}


}

public function SalesReport(){

    // $data = DB::table('dsr_stock_items')
    // ->join('dsr_stocks','dsr_stocks.id','dsr_stock_items.dsr_stock_id')
    // ->join('items','items.id','dsr_stock_items.item_id')
    // ->join('users','dsr_stocks.dsr_id','users.id')

    // ->select('users.name AS user_name','items.name AS item_name','dsr_stock_items.qty AS stock_qty','items.selling_price')
    // ->where('dsr_stocks.status','=',1)
    // ->where('items.status','=',1)
    // ->get();

  $items = DB::table('sales')
  ->join('items','sales.item_id','items.id')
  ->select('items.id','items.name','items.selling_price','sales.item_qty as qty','sales.dsr_id')
  ->groupBy('sales.item_id')
  ->get();

  $users = DB::table('sales')
  ->join('users','sales.dsr_id','users.id')
  ->select('users.id','users.name','sales.item_id')
  ->where('users.status','=',1)
  ->groupBy('sales.dsr_id')
  ->get();

  $user_items_arr = [];
  foreach($users as $user){

    $user_items = DB::table('sales')->select('id as sale_id','stock_id','item_id','item_qty','item_amount','dsr_id')->where('dsr_id','=',$user->id)->get();
    $user_items_arr[] = $user_items;

  }

  return view('admin.report.sales_summery',["itemSet"=>$items, "userSet"=>$users, "userItems"=>$user_items_arr]);

}



public function AdditionalDetails(){

  $userData = DB::table('additional')
  ->join('admins as u','additional.user_id','u.id')
  ->join('users as d','additional.dsr_id','d.id')
  ->select('additional.id','additional.date','additional.sum_id','u.name as admin_name','d.name as dsr_name')
  ->paginate(10);


  return view('admin.report.additional_details',["userData"=>$userData]);

}


public function getAdditionalData(Request $request){

  $data = [];

  $bank_data = DB::table('addtional_bank')
  ->join('additional','additional.id','addtional_bank.additional_id')
  ->join('banks','addtional_bank.bank_id','banks.id')
  ->select('addtional_bank.bank_ref_no','addtional_bank.edited_bank_ref_no','addtional_bank.bank_amount','addtional_bank.edited_bank_amount','banks.bank_name')
  ->where('additional_id','=',$request->id)
  ->groupBy('addtional_bank.id')
  ->get();

  $direct_bank_data = DB::table('addtional_directbank')
  ->join('additional','additional.id','addtional_directbank.additional_id')
  ->join('banks','addtional_directbank.bank_id','banks.id')
  ->select('addtional_directbank.direct_bank_ref_no','addtional_directbank.edited_direct_bank_ref_no','addtional_directbank.direct_bank_amount','addtional_directbank.edited_direct_bank_amount','banks.bank_name')
  ->where('additional_id','=',$request->id)
  ->groupBy('addtional_directbank.id')
  ->get();

  $credit_data = DB::table('addtional_credit')
  ->join('additional','additional.id','addtional_credit.additional_id')
  ->select('addtional_credit.credit_customer_name','addtional_credit.edited_credit_customer_name','addtional_credit.credit_amount','addtional_credit.edited_credit_amount')
  ->where('additional_id','=',$request->id)
  ->groupBy('addtional_credit.id')
  ->get();

  $credit_col_data = DB::table('addtional_credit_collection')
  ->join('additional','additional.id','addtional_credit_collection.additional_id')
  ->select('addtional_credit_collection.credit_collection_customer_name','addtional_credit_collection.edited_credit_collection_customer_name','addtional_credit_collection.credit_collection_amount','addtional_credit_collection.edited_credit_collection_amount')
  ->where('additional_id','=',$request->id)
  ->groupBy('addtional_credit_collection.id')
  ->get();


  $data["bankData"] = $bank_data;
  $data["directBankData"] = $direct_bank_data;
  $data["creditData"] = $credit_data;
  $data["creditColData"] = $credit_col_data;


  return response($data);

}


public function BankingDetails(){
 $banks = Bank::where('status',1)->get();
 return view('admin.report.banking',["banks"=>$banks]);
}

public function GetBankDetails(Request $request){


  $bankData = DB::table('bankings')
  ->join('users as bu','bankings.dsr_id','bu.id')
  ->select('bankings.created_at','bankings.bank_ref_no as ref_no','bankings.bank_amount as amount','bu.name')
  ->where('bankings.bank_id',$request->id)
  ->paginate(5);

  $directBankData = DB::table('directbankings')
  ->join('users as dbu','directbankings.dsr_id','dbu.id')
  ->select('directbankings.created_at','direct_bank_ref_no as ref_no','direct_bank_amount as amount','dbu.name')
  ->where('directbankings.direct_bank_id',$request->id)
  ->paginate(5);

  $banks = Bank::where('status',1)->get();

  return view('admin.report.banking',["bankData"=>$bankData, "directBankData"=>$directBankData]);


}



}
