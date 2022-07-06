<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class directbanking extends Model
{
    use HasFactory;

    protected $fillable = [
        'direct_bank_customer_name',
        'direct_bank_name',
        'direct_bank_ref_no',
        'direct_bank_amount',
        'dsr_id',
        'status',
    ];

}
