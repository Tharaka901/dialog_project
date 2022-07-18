<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DsrStockItem extends Model
{

    protected $fillable = [
        'id',
        'dsr_stock_id',
        'item_id',
        'qty',
        'status',
    ];

    use HasFactory;
}
