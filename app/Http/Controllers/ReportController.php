<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function SalesSummery(){
        return view('admin.report.sales_summery');
    }

    public function Collection(){
        return view('admin.report.collection');
    }
}
