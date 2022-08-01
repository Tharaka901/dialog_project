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
        'issue_return_qty',
        'approve_return_qty',
        'sale_qty',
        'status',
    ];

    use HasFactory;
}
