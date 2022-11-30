<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class banking extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank_id',
        'bank_ref_no',
        'bank_amount',
        'sum_id',
        'dsr_id',
        'status',
    ];

}
