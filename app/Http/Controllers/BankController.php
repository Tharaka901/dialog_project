<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Bank;
use DB;
use Alert;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $banks = Bank::orderBy('bank_name')->paginate(5);
        return view('admin.bank.bank',["banks"=>$banks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $banks = Bank::updateOrCreate(
            ['bank_name' => $request->get('bank_name')],
            ['status' => 1]
        );

        DB::statement("alter table pending_sum add ".$request->get('bank_name')." varchar(10)");

        if($banks){
            Alert::success('Success!!', 'Bank Registered.');
        }else{
            Alert::success('Oops!!', 'Error Occured.');
        }

        
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $selected_bank = Bank::find($request->id);
        return response($selected_bank);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function show(Bank $bank)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function edit(Bank $bank)
    {
     //  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bank $bank)
    {

        $update_bank = Bank::where('id', $request->edit_bank_id)
        ->update(['bank_name' => $request->edit_bank_name]);

        if($update_bank){
            Alert::success('Success!!', 'Bank Updated!');
        }else{
            Alert::success('Oops!!', 'Error Occured.');
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Bank $bank)
    {
        $delete_bank = Bank::where('id', $request->delete_bank_id)
        ->update(['status' => 0]);

        if($delete_bank){
            Alert::success('Success!!', 'Bank Deleted!');
        }else{
            Alert::success('Oops!!', 'Error Occured.');
        }

        return redirect()->back();
    }
}
