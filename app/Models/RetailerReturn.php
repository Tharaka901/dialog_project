<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RetailerReturn extends Model
{
    use HasFactory;

    protected $fillable = [
        're_customer_name',
        're_item_id',
        're_item_name',
        're_item_qty',
        're_item_amount',
        'sum_id',
        'dsr_id',
        'status',
    ];

}
