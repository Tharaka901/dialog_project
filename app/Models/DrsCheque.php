<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrsCheque extends Model
{
    use HasFactory;

    protected $fillable = [
        'sum_id',
        'dsrs_id',
        'cheque_no',
        'cheque_amount',
        'status',
        'created_at',
        'updated_at',
    ];

}
