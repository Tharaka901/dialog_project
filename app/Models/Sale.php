<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DSR;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'stock_id',
        'item_id',
        'item_name',
        'item_qty',
        'item_amount',
        'stock_balance',
        'sum_id',
        'dsr_id',
        'status',
        'created_at',
    ];
}
