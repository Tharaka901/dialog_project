<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sums extends Model
{

 protected $fillable = [
    'dsr_id',
    'date',
    'inhand_sum',
    'sales_sum',
    'credit_sum',
    'credit_collection_sum',
    'banking_sum',
    'direct_banking_sum',
    'retialer_sum',
];


use HasFactory;
}
