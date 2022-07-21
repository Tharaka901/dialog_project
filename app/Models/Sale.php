<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DSR;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'item_name',
        'item_qty',
        'item_amount',
        'dsr_id',
        'status',
    ];
}
