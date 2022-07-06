<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class banking extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank_name',
        'bank_ref_no',
        'bank_amount',
        'dsr_id',
        'status',
    ];

}
