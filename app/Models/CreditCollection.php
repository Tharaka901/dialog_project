<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditCollection extends Model
{
    use HasFactory;

    protected $fillable = [
        'credit_collection_customer_name',
        'credit_collection_amount',
        'dsr_id',
        'status',
    ];

}
