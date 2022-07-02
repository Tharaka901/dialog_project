<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DsrController extends Controller
{
    public function PendingDsr(){
        return view('admin.dsr.pending_dsr');
    }

    public function CompleteDsr(){
        return view('admin.dsr.complete_dsr');
    }
}
