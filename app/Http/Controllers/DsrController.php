<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;
use Alert;
use Session;
use App\Models\DSR;
use App\Models\Sale;
use App\Models\Credit;
use App\Models\CreditCollection;
use App\Models\RetailerReturn;
use App\Models\banking;
use App\Models\directbanking;
use App\Models\Sums;


class DsrController extends Controller
{

    public function PendingDsr(){

        date_default_timezone_set("Asia/colombo");
        $todayDate = date('Y-m-d');

        $pdsr = DB::table('pending_sum')
        ->join('users', 'pending_sum.dsr_id', 'users.id')
        ->select('pending_sum.id','pending_sum.dsr_id','users.name','date','inhand_sum','sales_sum','credit_sum','credit_collection_sum','banking_sum','direct_banking_sum','retialer_sum','pending_sum.status')
        // ->where('date', '=', $todayDate)
        ->where('pending_sum.status', '!=', 2)
        ->orderBy('pending_sum.date','desc')
        ->paginate(20);

        return view('admin.dsr.pending_dsr',["dsrData"=>$pdsr]);
    }


    public function SearchPendingDsr(Request $request){

        date_default_timezone_set("Asia/colombo");
        $todayDate = date('Y-m-d');
        $name = $request->get('name');

        if($name != ""){
            session(['pending_dsr_name' => $name]);
        }

        $pdsr = DB::table('pending_sum')
        ->join('users', 'pending_sum.dsr_id', 'users.id')
        ->select('pending_sum.id','pending_sum.dsr_id','users.name','date','inhand_sum','sales_sum','credit_sum','credit_collection_sum','banking_sum','direct_banking_sum','retialer_sum','pending_sum.status')
        ->where('users.name', 'like', '%' . $request->session()->get('pending_dsr_name') . '%' )
        ->where('pending_sum.status', '!=', 2)
        ->orderBy('pending_sum.date','desc')
        ->paginate(20);

        return view('admin.dsr.search_dsr1',["dsrData"=>$pdsr]);
    }


    public function GetDsr(Request $request)
    {
       date_default_timezone_set("Asia/colombo");
       $todayDate = date('Y-m-d');

       $data = [];

       $sales = DB::table('sales')
       ->join('dsr_stock_items','sales.stock_id','dsr_stock_items.id')
       ->select('sales.id','sales.item_id','sales.item_name', DB::raw('sum(sales.item_qty) as item_qty '),'sales.item_amount as item_amount','sales.dsr_id','sales.sum_id','dsr_stock_items.id as dsr_stock_id')
       ->where('sales.status', '=', 1)
       ->where('sales.sum_id',$request->id)
       ->groupBy('sales.item_id')
       ->get();

       $inhand = DB::table('dsrs')
       ->select('dsrs.id','dsrs.in_hand','dsrs.cash','dsrs.cheque')
       ->where('dsrs.status', '=', 1)
       ->where('dsrs.sum_id',$request->id)
       ->get();

       $credit = DB::table('credits')
       ->select('credits.id','credits.credit_customer_name','credits.credit_amount')
       ->where('credits.status', '=', 1)
       ->where('credits.sum_id',$request->id)
       ->get();

       $creditCollection = DB::table('credit_collections')
       ->select('credit_collections.id','credit_collection_customer_name','credit_collection_amount','option_id')
       ->where('credit_collections.status', '=', 1)
       ->where('credit_collections.sum_id',$request->id)
       ->get();

       $retailer = DB::table('retailer_returns')
       ->join('items','retailer_returns.re_item_id','items.id')
       ->leftjoin('dsr_stock_items','items.id','dsr_stock_items.item_id')
       ->select('retailer_returns.id','retailer_returns.re_item_id','items.name','re_customer_name','re_item_qty','re_item_amount','dsr_stock_items.id as dsr_stock_id')
       ->where('retailer_returns.status', '=', 1)
       ->where('retailer_returns.sum_id',$request->id)
       ->get();

       $bank = DB::table('bankings')
       ->join('banks','banks.id','bankings.bank_id')
       ->select('bankings.id','banks.id as bankId','banks.bank_name','bank_ref_no','bank_amount')
       ->where('bankings.status', '=', 1)
       ->where('bankings.sum_id',$request->id)
       ->get();

       $direct_bank = DB::table('directbankings')
       ->join('banks','banks.id','directbankings.direct_bank_id')
       ->select('directbankings.id','direct_bank_customer_name','banks.id as bankId','banks.bank_name','direct_bank_ref_no','direct_bank_amount')
       ->where('directbankings.status', '=', 1)
       ->where('directbankings.sum_id',$request->id)
       ->get();


       $data["saleData"] = $sales;
       $data["inhandData"] = $inhand;
       $data["creditData"] = $credit;
       $data["creditcolData"] = $creditCollection;
       $data["reData"] = $retailer;
       $data["bankData"] = $bank;
       $data["directbankData"] = $direct_bank;

       return response($data);
   }


   public function CollectionApprove(Request $request){

    $pending_sum = $request->get('pending_sum_id');
    $dsr_id = $request->get('id');
    date_default_timezone_set("Asia/colombo");
    $todayDate = date('Y-m-d');
    $todayTime = date('h:i:s:a');
    $user_id = $request->session()->get('user_id');

    $creditCollectionTable = json_decode($request->get('creditCollectionTable'),true);
    $creditCollectionItemTable = json_decode($request->get('creditCollectionItemTable'),true);
    if($creditCollectionTable){

        $credit_collection_sum = 0;
        $credit_collection_item_total = 0;
        $credit_id = 0;


        foreach($creditCollectionItemTable as $credit_items){
            $credit_collection_sum += $credit_items['price'];
        }

        foreach($creditCollectionItemTable as $credit_item){
            DB::update('update credit_collection_items set item_price = ? where id = ?', array($credit_item['price'],$credit_item['collection_item_id']));
            DB::update('update credit_collections set credit_collection_amount = ? where id = ?', array($credit_collection_sum , $credit_item['collection_id']));
        }

        $set_sum_default = DB::update('update pending_sum set credit_collection_sum = ? where id = ?', array(0, $pending_sum));

        if($set_sum_default){

            $credit_collection_total = DB::table('credit_collections')->select('credit_collection_amount')->where('status', '=', 1)->where('sum_id',$pending_sum)->get();

            foreach($credit_collection_total as $credits){
                $credit_collection_item_total += $credits->credit_collection_amount;
            }

            DB::update('update pending_sum set credit_collection_sum = ? where id = ?', array($credit_collection_item_total, $pending_sum));
        }

        foreach($creditCollectionTable as $credit){
           DB::table('credit_collections')->where('id','=',$credit['id'])->update(['credit_collection_customer_name'=>$credit['ccName'] ]);
       }

       foreach($creditCollectionItemTable as $credit_collections){
        if(floatval($credit_collections['old_price']) != floatval($credit_collections['price'])){

            $lastInsertId = 0;
            $check_additional_data = DB::table('additional')->where('sum_id', '=', $pending_sum)->where('dsr_id', '=', $dsr_id)->where('date', '=', $todayDate)->get();

            if(count($check_additional_data) == 0){
                DB::insert('insert into additional (dsr_id, sum_id, date, user_id, status, created_at) values (?, ?, ?, ?, ?, ?)', [$dsr_id, $pending_sum, $todayDate, $user_id, 1, $todayDate." ".$todayTime]);
                $lastInsertId  = DB::table('additional')->latest('id')->first();
            }else{
                foreach($check_additional_data as $ad_data)
                    $lastInsertId = $ad_data;
            }

            $accUpdate = DB::insert('insert into addtional_credit_collection (
                additional_id,
                credit_collection_customer_name,
                edited_credit_collection_customer_name,
                credit_collection_amount,
                edited_credit_collection_amount
            ) values (?, ?, ?, ?, ?)', 
            [
                $lastInsertId->id,
                '',
                '',
                $credit_collections['old_price'],
                $credit_collections['price'] 
            ]
        );
            $last_additional  = DB::table('addtional_credit_collection')->latest('id')->first();

            foreach($creditCollectionTable as $credit_collection_table){
                if($credit_collection_table['oldccName']  !== $credit_collection_table['ccName']){
                    DB::table('addtional_credit_collection')
                    ->where('id','=',$last_additional->id)
                    ->update([
                        'credit_collection_customer_name'=>$credit_collection_table['oldccName'],
                        'edited_credit_collection_customer_name'=>$credit_collection_table['ccName'] 
                    ]);

                }
            }
        }
    }


    return response(1);


}
}



public function CreditApprove(Request $request){
    $pending_sum = $request->get('pending_sum_id');
    $dsr_id = $request->get('id');
    date_default_timezone_set("Asia/colombo");
    $todayDate = date('Y-m-d');
    $todayTime = date('h:i:s:a');
    $user_id = $request->session()->get('user_id');

    $creditTables = json_decode($request->get('creditTable'),true);
    $creditItemTable = json_decode($request->get('creditItemTable'),true);
    if($creditTables){

        $credit_sum = 0;
        $credit_item_total = 0;
        $credit_id = 0;


        foreach($creditItemTable as $credit_items){
            $credit_sum += $credit_items['price'];
        }

        foreach($creditItemTable as $credit_item){
            DB::update('update credit_items set item_price = ? where id = ?', array($credit_item['price'],$credit_item['item_id']));
            DB::update('update credits set credit_amount = ? where id = ?', array($credit_sum , $credit_item['credit_id']));
        }

        $set_sum_default = DB::update('update pending_sum set credit_sum = ? where id = ?', array(0, $pending_sum));

        if($set_sum_default){

            $credit_total = DB::table('credits')->select('credit_amount')->where('status', '=', 1)->where('sum_id',$pending_sum)->get();

            foreach($credit_total as $credits){
                $credit_item_total += $credits->credit_amount;
            }

            DB::update('update pending_sum set credit_sum = ? where id = ?', array($credit_item_total, $pending_sum));
        }

        foreach($creditTables as $credit){
            DB::table('credits')->where('id','=',$credit['id'])->update(['credit_customer_name'=>$credit['customerName'] ]);  
        }

        foreach($creditItemTable as $credit_item){
            if(floatval($credit_item['old_price']) != floatval($credit_item['price'])){
             $lastInsertId = 0;
             $check_additional_data = DB::table('additional')->where('sum_id', '=', $pending_sum)->where('dsr_id', '=', $dsr_id)->where('date', '=', $todayDate)->get();

             if(count($check_additional_data) == 0){
                DB::insert('insert into additional (dsr_id, sum_id, date, user_id, status, created_at) values (?, ?, ?, ?, ?, ?)', [$dsr_id, $pending_sum, $todayDate, $user_id, 1, $todayDate." ".$todayTime]);
                $lastInsertId  = DB::table('additional')->latest('id')->first();
            }else{
                foreach($check_additional_data as $ad_data)
                    $lastInsertId = $ad_data;
            }


            DB::insert('insert into addtional_credit (additional_id, credit_customer_name, edited_credit_customer_name, credit_amount, edited_credit_amount) values (?, ?, ?, ?, ?)', [$lastInsertId->id, '', '', $credit_item['old_price'], $credit_item['price'] ]);

            $last_additional  = DB::table('addtional_credit')->latest('id')->first();

            foreach($creditTables as $credit_table){
                if($credit_table['oldcustomerName']  !== $credit_table['customerName']){
                    DB::table('addtional_credit')
                    ->where('id','=',$last_additional->id)
                    ->update([
                        'credit_customer_name'=>$credit_table['oldcustomerName'],
                        'edited_credit_customer_name'=>$credit_table['customerName'] 
                    ]);

                }
            }


        }
    }

    return response(1);
}
}


public function ApproveDsr(Request $request){

    $pending_sum = $request->get('pending_sum_id');
    $dsr_id = $request->get('id');
    date_default_timezone_set("Asia/colombo");
    $todayDate = date('Y-m-d');
    $todayTime = date('h:i:s:a');
    $user_id = $request->session()->get('user_id');

    $inHandTable = json_decode($request->get('inHandTable'),true);
    $inHandChequeTable = json_decode($request->get('inHandChequeTable'),true);
    $cheque_total = 0;
    $cash_total = 0;

    if($inHandTable){
        foreach($inHandTable as $inhand){
            DB::table('dsrs')->where('id','=',$inhand['id'])->update(['cash' => $inhand['cash'] ]);
            DB::table('pending_sum')->where('id','=',$pending_sum)->update(['inhand_cash' => $inhand['cash'] ]);
            $cash_total += $inhand['cash'];
        }
        foreach($inHandChequeTable as $cheque){
            DB::table('drs_cheques')->where('id','=',$cheque['id'])->update(['cheque_no' => $cheque['chequeNo'], 'cheque_amount' => $cheque['chequeAmount'] ]);
        }

        $new_cheque_data = DB::table('drs_cheques')->where('sum_id', '=', $pending_sum)->where('status',1)->get();

        foreach($new_cheque_data as $new_data){
            $cheque_total += $new_data->cheque_amount;
        }

        DB::table('dsrs')->where('sum_id','=',$pending_sum)->update(['cheque'=>$cheque_total, "in_hand"=>floatval($cash_total)+floatval($cheque_total) ]);

        DB::table('pending_sum')->where('id','=',$pending_sum)
        ->update(['inhand_sum'=>floatval($cash_total)+floatval($cheque_total),
         "inhand_cash"=>$cash_total,
         'inhand_cheque'=>$cheque_total ]);
    }


    $saleTable = json_decode($request->get('saleTable'),true);
    if($saleTable){
        $sale_sum = 0;
        foreach($saleTable as $sale){
            $get_dsr_stock_id = DB::table('sales')
            ->select('id as saleId' , DB::raw('sum(sales.item_qty) as item_qty')) 
            ->where('status', '!=', 0)
            ->where('stock_id', '=', $sale['stockId'])
            ->whereIn('item_id', [$sale['itemId']] )
            ->get();


            foreach($get_dsr_stock_id as $stockId){
                $new_qty = floatval($sale['itemQty']) - floatval($stockId->item_qty);
                if($new_qty != 0){
                    DB::update('update dsr_stock_items set sale_qty = ? where id = ?', array($sale['itemQty'],$sale['stockId']));
                }
                if($stockId->item_qty > $sale['itemQty']){
                    DB::update('update dsr_stock_items set qty = qty + ? where id = ?', array( abs(floatval($stockId->item_qty) - floatval($sale['itemQty']))   ,$sale['stockId'] ) );

                    DB::update('update sales set item_qty = item_qty - ? where id = ?', array( abs(floatval($stockId->item_qty) - floatval($sale['itemQty']))   ,$sale['id'] ) );
                }else{
                    DB::update('update dsr_stock_items set qty = qty - ? where id = ?', array( abs(floatval($sale['itemQty']) - floatval($stockId->item_qty)) ,$sale['stockId'] ) );
                    DB::update('update sales set item_qty = item_qty + ? where id = ?', array( abs(floatval($stockId->item_qty) - floatval($sale['itemQty']))   ,$sale['id'] ) );
                }
            }
            // $sales = DB::table('sales')->where('id','=',$sale['id'])->update(['item_name'=>$sale['itemName'],'item_amount'=>$sale['itemPrice']]);
            $sale_sum += $sale['itemPrice'] * $sale['itemQty'];
        }
        $sale_sum_update = DB::table('pending_sum')->where('id','=',$pending_sum)->update(['sales_sum'=> $sale_sum]);
    }


    $retailerTable = json_decode($request->get('retailerTable'),true);
    if($retailerTable){
        $retailer_sum = 0;
        foreach($retailerTable as $retailer){
            $retailers = DB::table('retailer_returns')
            ->where('id','=',$retailer['id'])
            ->update(['re_customer_name'=>$retailer['reCustomerName'],'re_item_id'=>$retailer['reitemId'],'re_item_qty'=>$retailer['reQuantity'],'re_item_amount'=>$retailer['reAmount']]);
            $retailer_sum += $retailer['reAmount'] * $retailer['reQuantity'];
            //   DB::update('update dsr_stock_items set qty = ? where id = ?', array( $retailer['reQuantity'], $retailer['reStockId']) );

        }
        $retailers_sum_update = DB::table('pending_sum')->where('id','=',$pending_sum)->update(['retialer_sum'=>  $retailer_sum]);
    }


    $bankingTable = json_decode($request->get('bankingTable'),true);
    if($bankingTable){
        DB::update('update pending_sum set banking_sum = ?, banking_sampath = ?, banking_cargils = ?, banking_peoples = ? where id = ?', array( 0, 0, 0, 0, $pending_sum));

        $banking_sum = 0;
        $sampath = 0;
        $peoples = 0;
        $cargils = 0;
        $sampthonline = 0;

        foreach($bankingTable as $banking){

            $banking_sum += $banking['amount'];

            if($banking["bank"] == "Sampath Bank"){
                $sampath += $banking['amount'];
            }

            if($banking["bank"] == "People's Bank"){
                $peoples += $banking['amount'];
            }

            if($banking["bank"] == "Cargills Bank"){
                $cargils += $banking['amount'];
            }

            if($banking["bank"] == "Sampath Bank - Online"){
                $sampthonline += $banking['amount'];
            }


            $bankings = DB::table('bankings')->where('id','=',$banking['id'])->update(['bank_ref_no'=>$banking['refno'],'bank_amount'=>$banking['amount']]);

        // set data to additional table
            if(floatval($banking['oldamount']) != floatval($banking['amount']) ){

                $lastInsertId = 0;
                $check_additional_data = DB::table('additional')->where('sum_id', '=', $pending_sum)->where('dsr_id', '=', $dsr_id)->where('date', '=', $todayDate)->get();

                if(count($check_additional_data) == 0){
                    DB::insert('insert into additional (dsr_id, sum_id, date, user_id, status, created_at) values (?, ?, ?, ?, ?, ?)', [$dsr_id, $pending_sum, $todayDate, $user_id, 1, $todayDate." ".$todayTime]);
                    $lastInsertId  = DB::table('additional')->latest('id')->first();
                }else{
                    foreach($check_additional_data as $ad_data)
                        $lastInsertId = $ad_data;
                }

                DB::insert('insert into addtional_bank (additional_id, bank_id, bank_ref_no, edited_bank_ref_no, bank_amount, edited_bank_amount) values (?, ?, ?, ?, ?, ?)', [$lastInsertId->id, $banking["bankId"], $banking['oldrefno'], $banking['refno'], $banking['oldamount'], $banking['amount'] ]);

            }




        }

        $bankings_sum_update = DB::update('update pending_sum set banking_sum = banking_sum + ? ,banking_sampath = banking_sampath+ ? ,banking_cargils = banking_cargils+ ? ,banking_peoples = banking_peoples + ?, banking_sampth_online = banking_sampth_online + ?  where id = ?', array($banking_sum, $sampath, $cargils, $peoples, $sampthonline, $pending_sum));
    }


    $directBankingTable = json_decode($request->get('directBankingTable'),true);
    if($directBankingTable){
        DB::update('update pending_sum set direct_banking_sum = ?, direct_banking_sampath = ?, direct_banking_cargils = ?, direct_banking_peoples = ? where id = ?', array( 0, 0, 0, 0, $pending_sum));
        $db_sum = 0;
        $sampath = 0;
        $peoples = 0;
        $cargils = 0;
        $sampthonline = 0;
        foreach($directBankingTable as $db){
            $db_sum += $db['amount'];

            if($db["bank"] == "Sampath Bank"){
                $sampath += $db['amount'];
            }

            if($db["bank"] == "People's Bank"){
                $peoples += $db['amount'];
            }

            if($db["bank"] == "Cargills Bank"){
                $cargils += $db['amount'];
            }

            if($db["bank"] == "Sampath Bank - Online"){
                $sampthonline += $db['amount'];
            }


            $direct_bankings = DB::table('directbankings')->where('id','=',$db['id'])->update(['direct_bank_customer_name'=>$db['customerName'],'direct_bank_ref_no'=>$db['refno'],'direct_bank_amount'=>$db['amount']]);

        // set data to additional table
            if(floatval($db['oldamount']) != floatval($db['amount'])){

                $lastInsertId = 0;
                $check_additional_data = DB::table('additional')->where('sum_id', '=', $pending_sum)->where('dsr_id', '=', $dsr_id)->where('date', '=', $todayDate)->get();

                if(count($check_additional_data) == 0){
                    DB::insert('insert into additional (dsr_id, sum_id, date, user_id, status, created_at) values (?, ?, ?, ?, ?, ?)', [$dsr_id, $pending_sum, $todayDate, $user_id, 1, $todayDate." ".$todayTime]);
                    $lastInsertId  = DB::table('additional')->latest('id')->first();
                }else{
                    foreach($check_additional_data as $ad_data)
                        $lastInsertId = $ad_data;
                }

                DB::insert('insert into addtional_directbank (additional_id, bank_id, direct_bank_ref_no, edited_direct_bank_ref_no, direct_bank_amount, edited_direct_bank_amount) values (?, ?, ?, ?, ?, ?)', [$lastInsertId->id, $db["bankId"], $db['oldrefno'], $db['refno'], $db['oldamount'], $db['amount'] ]);
            }
        }
        $bankings_sum_update = DB::update('update pending_sum set direct_banking_sum = direct_banking_sum + ? ,direct_banking_sampath = direct_banking_sampath+ ? ,direct_banking_cargils = direct_banking_cargils+ ? ,direct_banking_peoples = direct_banking_peoples + ?, direct_banking_sampth_online = direct_banking_sampth_online + ?  where id = ?', array($db_sum, $sampath, $cargils, $peoples, $sampthonline, $pending_sum));
    }




$updateItemData = DB::table('pending_sum')
->where('id','=',$request->get('pending_sum_id'))
->update([
    'status'=>2,
]);

    return response(1);


}


public function RemoveSale(Request $request){

    $get_sales_details = DB::table('sales')->select("id","item_id","item_name","item_qty")->where('sum_id', '=', $request->sum_id)->where('item_id', '=', $request->item_id)->get();

    $item_qty_total = 0;
    foreach($get_sales_details as $sale_details){
       $item_qty_total += $sale_details->item_qty;
   }

   if($item_qty_total == $request->deductQty){
    foreach($get_sales_details as $sd){
        $updateSale = DB::table('sales')->where('id','=',$sd->id)->update(['status'=>0]);
    }
}else{
    // just where
  $updateSale = DB::table('sales')->where('id','=',$request->id)->update(['status'=>0]);
}


DB::update('update pending_sum set sales_sum = sales_sum - ? where id = ?', array($request->deduction,$request->sum_id));

$get_dsr_stock_id = DB::table('sales')
->join('dsr_stock_items','sales.stock_id','dsr_stock_items.id')
->select('dsr_stock_items.id','sales.status')
->where('sales.id', '=', $request->id)
->get();

foreach($get_dsr_stock_id as $stockId){
    DB::update('update dsr_stock_items set sale_qty = sale_qty - ? where id = ?', array($request->deductQty,$stockId->id));
    DB::update('update dsr_stock_items set qty = qty + ? where id = ?', array($request->deductQty,$stockId->id));
}


return response($updateSale);
}

public function RemoveInhand(Request $request){
    $updateInhand = DB::table('dsrs')->where('id','=',$request->id)->update(['status'=>0]);
    DB::update('update pending_sum set inhand_sum = inhand_sum - ? where id = ?', array($request->deduction,$request->sum_id));
    return response($updateInhand);
}

public function removeInhandCheque(Request $request){
    $updateChequeStatus = DB::table('drs_cheques')->where('id','=',$request->id)->update(['status'=>0]);

    DB::update('update dsrs set cheque = cheque - ?, in_hand = in_hand - ? where sum_id = ?', array($request->chequeAmount, $request->chequeAmount, $request->sum_id));

    DB::update('update pending_sum set inhand_sum = inhand_sum - ?, inhand_cheque = inhand_cheque - ? where id = ?', array($request->chequeAmount, $request->chequeAmount,$request->sum_id));

    return response($updateChequeStatus);
}

public function RemoveBank(Request $request){
    $updateBank = DB::table('bankings')->where('id','=',$request->id)->update(['status'=>0]);
    DB::update('update pending_sum set banking_sum = banking_sum - ? where id = ?', array($request->deduction,$request->sum_id));
    
    if($request->bank_name == "Sampath Bank"){
        DB::update('update pending_sum set banking_sampath = banking_sampath - ? where id = ?', array($request->deduction,$request->sum_id));
    }

    if($request->bank_name == "Cargills Bank"){
        DB::update('update pending_sum set banking_cargils = banking_cargils - ? where id = ?', array($request->deduction,$request->sum_id));
    }

    if($request->bank_name == "People's Bank"){
        DB::update('update pending_sum set banking_peoples = banking_peoples - ? where id = ?', array($request->deduction,$request->sum_id));
    }

    if($request->bank_name == "Sampath Bank - Online"){
        DB::update('update pending_sum set banking_sampth_online = banking_sampth_online - ? where id = ?', array($request->deduction,$request->sum_id));
    }
    
    return response($updateBank);
}

public function RemoveDBank(Request $request){
    $updateDBank = DB::table('directbankings')->where('id','=',$request->id)->update(['status'=>0]);
    DB::update('update pending_sum set direct_banking_sum = direct_banking_sum - ? where id = ?', array($request->deduction,$request->sum_id));
    
    if($request->dbank_name == "Sampath Bank"){
        DB::update('update pending_sum set direct_banking_sampath = direct_banking_sampath - ? where id = ?', array($request->deduction,$request->sum_id));
    }

    if($request->dbank_name == "Cargills Bank"){
        DB::update('update pending_sum set direct_banking_cargils = direct_banking_cargils - ? where id = ?', array($request->deduction,$request->sum_id));
    }

    if($request->dbank_name == "People's Bank"){
        DB::update('update pending_sum set direct_banking_peoples = direct_banking_peoples - ? where id = ?', array($request->deduction,$request->sum_id));
    }

     if($request->dbank_name == "Sampath Bank - Online"){
        DB::update('update pending_sum set direct_banking_sampth_online = direct_banking_sampth_online - ? where id = ?', array($request->deduction,$request->sum_id));
    }
    
    return response($updateDBank);
}

public function RemoveCredit(Request $request){

    $updateCredit = DB::table('credits')->where('id','=',$request->id)->update(['status'=>0]);

    $get_credit_items = DB::table('credit_items')->where('credit_id',$request->id)->get();
    $creditItemAmount = 0;
    if(count($get_credit_items) != 0){
        foreach($get_credit_items as $credits){
           DB::table('credit_items')->where('credit_id','=',$request->id)->update(['status'=>0]);
           $creditItemAmount += $credits->item_price;
       }

       DB::update('update credits set credit_amount = credit_amount - ? where id = ?', array($creditItemAmount,$request->id));

   }

   DB::update('update pending_sum set credit_sum = credit_sum - ? where id = ?', array($request->deduction,$request->sum_id));

   return response($updateCredit);
}

public function removeCreditItems(Request $request){

  $updateCredit = DB::table('credit_items')->where('id','=',$request->creditItemsId)->update(['status'=>0]);
  
  DB::update('update credits set credit_amount = credit_amount - ? where id = ?', array($request->amount, $request->creditId));
  
  DB::update('update pending_sum set credit_sum = credit_sum - ? where id = ?', array($request->amount, $request->sum_id));

  return response($updateCredit);
}

public function RemoveRetailer(Request $request){
    $updateRetailer = DB::table('retailer_returns')->where('id','=',$request->id)->update(['status'=>0]);
    DB::update('update pending_sum set retialer_sum = retialer_sum - ? where id = ?', array($request->deduction,$request->sum_id));

    $get_dsr_stock_id = DB::table('retailer_returns')
    ->join('dsr_stock_items','dsr_stock_items.item_id','retailer_returns.re_item_id')
    ->select('dsr_stock_items.id','dsr_stock_items.dsr_stock_id','dsr_stock_items.qty','retailer_returns.status')
    ->where('retailer_returns.id', '=', $request->id)
    ->where('retailer_returns.sum_id', '=', $request->sum_id)
    ->where('retailer_returns.re_item_id', '=', $request->item_id)
    ->get();

    foreach($get_dsr_stock_id as $stockId){

        if($stockId->status == 0){
            DB::update('update dsr_stock_items set qty = ? where id = ?', array(0,$stockId->id));
        }

    }

    return response($updateRetailer);
}

public function RemoveCreditCol(Request $request){
    $updateSale = DB::table('credit_collections')->where('id','=',$request->id)->update(['status'=>0]);
    DB::update('update pending_sum set credit_collection_sum = credit_collection_sum - ? where id = ?', array($request->deduction,$request->sum_id));
    return response($updateSale);
}


public function removeCreditCollectionItems(Request $request){
   $updateCreditCollection = DB::table('credit_collection_items')->where('id','=',$request->credit_col_items_id)->update(['status'=>0]);

   DB::update('update credit_collections set credit_collection_amount = credit_collection_amount - ? where id = ?', array($request->amount, $request->credit_col_id));

   DB::update('update pending_sum set credit_collection_sum = credit_collection_sum - ? where id = ?', array($request->amount, $request->sum_id));

   return response($updateCreditCollection);
}


public function CompleteDsr(){

    date_default_timezone_set("Asia/colombo");
    $todayDate = date('Y-m-d');

    $pdsr = DB::table('pending_sum')
    ->join('users', 'pending_sum.dsr_id', 'users.id')
    ->select('pending_sum.id','pending_sum.dsr_id','users.name','date','inhand_sum','sales_sum','credit_sum','credit_collection_sum','banking_sum','direct_banking_sum','retialer_sum','pending_sum.status')
    ->where('date', '=', $todayDate)
    ->where('pending_sum.status', '=', 2)
    ->orderBy('pending_sum.date','desc')
    ->paginate(20);

    return view('admin.dsr.complete_dsr',["dsrData"=>$pdsr]);
}


public function SearchCompleteDsr(Request $request){

   date_default_timezone_set("Asia/colombo");
   $todayDate = date('Y-m-d');

   $name = $request->get('name');
   $from = $request->get('from');
   $to = $request->get('to');

   if($name !=""){
    session(['dsr_name' => $name]);
}

if($from !=""){
    session(['dsr_from' => $from]);
}

if($to !=""){
   session(['dsr_to' => $to]);
}


if($request->session()->get('dsr_name') != ""){
    $pdsr = DB::table('pending_sum')
    ->join('users', 'pending_sum.dsr_id', 'users.id')
    ->select('pending_sum.id','pending_sum.dsr_id','users.name','date','inhand_sum','sales_sum','credit_sum','credit_collection_sum','banking_sum','direct_banking_sum','retialer_sum','pending_sum.status')
    ->where('users.name', 'like', '%' . $request->session()->get('dsr_name') . '%' )
    ->where('pending_sum.status', '=', 2)
    ->orderBy('pending_sum.date','desc')
    ->paginate(20);

    return view('admin.dsr.search_dsr',["dsrData"=>$pdsr]);
}


if($request->session()->get('dsr_from') != "" && $request->session()->get('dsr_to')){
    $pdsr = DB::table('pending_sum')
    ->join('users', 'pending_sum.dsr_id', 'users.id')
    ->select('pending_sum.id','pending_sum.dsr_id','users.name','date','inhand_sum','sales_sum','credit_sum','credit_collection_sum','banking_sum','direct_banking_sum','retialer_sum','pending_sum.status')
    ->where('pending_sum.status', '=', 2)
    ->whereBetween('date', [$request->session()->get('dsr_from'), $request->session()->get('dsr_to')])
    ->orderBy('pending_sum.date','desc')
    ->paginate(20);

    return view('admin.dsr.search_dsr',["dsrData"=>$pdsr]);
}


if($request->session()->get('dsr_name') != "" && $request->session()->get('dsr_from') != "" && $request->session()->get('dsr_to')){
    $pdsr = DB::table('pending_sum')
    ->join('users', 'pending_sum.dsr_id', 'users.id')
    ->select('pending_sum.id','pending_sum.dsr_id','users.name','date','inhand_sum','sales_sum','credit_sum','credit_collection_sum','banking_sum','direct_banking_sum','retialer_sum','pending_sum.status')
    ->where('users.name', 'like', '%' . $name . '%' )
    ->where('pending_sum.status', '=', 2)
    ->whereBetween('date',[$request->session()->get('dsr_from'), $request->session()->get('dsr_to')])
    ->orderBy('pending_sum.date','desc')
    ->paginate(20);

    return view('admin.dsr.search_dsr',["dsrData"=>$pdsr]);
}



}


public function getCompleteDsr(Request $request)
{
   date_default_timezone_set("Asia/colombo");
   $todayDate = date('Y-m-d');

   $data = [];

   $sales = DB::table('sales')
   ->join('dsr_stock_items','sales.stock_id','dsr_stock_items.id')
   ->select('sales.id','sales.item_id','sales.item_name', DB::raw('sum(sales.item_qty) as item_qty '),'sales.item_amount as item_amount','sales.dsr_id','sales.sum_id','dsr_stock_items.id as dsr_stock_id')
   ->where('sales.status', '=', 1)
   ->where('sales.sum_id',$request->id)
   ->groupBy('sales.item_id')
   ->get();

   $inhand = DB::table('dsrs')
   ->select('dsrs.id','dsrs.in_hand','dsrs.cash','dsrs.cheque','dsrs.sum_id','dsrs.status')
   ->where('dsrs.status', '=', 1)
   ->where('dsrs.sum_id',$request->id)
   ->get();

   $credit = DB::table('credits')
   ->select('credits.id','credits.credit_customer_name','credits.credit_amount','credits.sum_id','credits.status')
   ->where('credits.status', '=', 1)
   ->where('credits.sum_id',$request->id)
   ->get();

   $creditCollection = DB::table('credit_collections')
   ->select('credit_collections.id','credit_collection_customer_name','credit_collection_amount')
   ->where('credit_collections.status', '=', 1)
   ->where('credit_collections.sum_id',$request->id)
   ->get();

   $retailer = DB::table('retailer_returns')
   ->join('items','retailer_returns.re_item_id','items.id')
   ->leftjoin('dsr_stock_items','items.id','dsr_stock_items.item_id')
   ->select('retailer_returns.id','retailer_returns.re_item_id','items.name','re_customer_name','re_item_qty','re_item_amount','dsr_stock_items.id as dsr_stock_id')
   ->where('retailer_returns.status', '=', 1)
   ->where('retailer_returns.sum_id',$request->id)
   ->get();

   $bank = DB::table('bankings')
   ->join('banks','bankings.bank_id','banks.id')
   ->select('bankings.id','banks.bank_name','bank_ref_no','bank_amount')
   ->where('bankings.status', '=', 1)
   ->where('bankings.sum_id',$request->id)
   ->get();

   $direct_bank = DB::table('directbankings')
   ->join('banks','directbankings.direct_bank_id','banks.id')
   ->select('directbankings.id','direct_bank_customer_name','banks.bank_name','direct_bank_ref_no','direct_bank_amount')
   ->where('directbankings.status', '=', 1)
   ->where('directbankings.sum_id',$request->id)
   ->get();


   $data["saleData"] = $sales;
   $data["inhandData"] = $inhand;
   $data["creditData"] = $credit;
   $data["creditcolData"] = $creditCollection;
   $data["reData"] = $retailer;
   $data["bankData"] = $bank;
   $data["directbankData"] = $direct_bank;

   return response($data);
}


function InhandCheques(Request $request){
    $data = DB::table('drs_cheques')->where('status', '=', 1)->where('sum_id', '=', $request->id)->get();
    return response($data);


}function ViewInhandCheques(Request $request){
    $data = DB::table('drs_cheques')->where('status', '=', 1)->where('sum_id', '=', $request->id)->get();
    return response($data);
}

function CreditItems(Request $request){
    $data = DB::table('credit_items')
    ->join('items','items.id','credit_items.item_id')
    ->select('credit_items.id','credit_items.credit_id','items.name','credit_items.item_price','credit_items.status')
    ->where('credit_items.status', '=', 1)->where('credit_id', '=', $request->id)->get();
    return response($data);
}

function ViewCreditItems(Request $request){
    $data = DB::table('credit_items')
    ->join('items','items.id','credit_items.item_id')
    ->select('credit_items.id','credit_items.credit_id','items.name','credit_items.item_price','credit_items.status')
    ->where('credit_items.status', '=', 1)->where('credit_id', '=', $request->id)->get();
    return response($data);
}

function CreditCollectionItems(Request $request){
    $data = DB::table('credit_collection_items')
    ->join('items','items.id','credit_collection_items.item_id')
    ->select('credit_collection_items.id','credit_collection_items.credit_collection_id','items.name','credit_collection_items.item_price','credit_collection_items.status')
    ->where('credit_collection_items.status', '=', 1)->where('credit_collection_id', '=', $request->id)->get();
    return response($data);
}

function ViewCreditCollectionItems(Request $request){
    $data = DB::table('credit_collection_items')
    ->join('items','items.id','credit_collection_items.item_id')
    ->select('credit_collection_items.id','credit_collection_items.credit_collection_id','items.name','credit_collection_items.item_price','credit_collection_items.status')
    ->where('credit_collection_items.status', '=', 1)->where('credit_collection_items.credit_collection_id', '=', $request->id)->get();
    return response($data);
}


public function rejectApprove(Request $request){
    $reject_approve = DB::table('pending_sum')->where('id','=',$request->id)->update(['status'=> 0 ]);
    if($reject_approve){
        Alert::success('Updated!', 'Request has been rejected successfully.');
        return redirect()->route('pending_dsr');
    }else{
       Alert::warning('Oops..', 'Something went wrong!');
       return redirect()->back();
   }
}




}
