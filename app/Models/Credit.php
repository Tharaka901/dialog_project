<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $fillable = [
        'credit_customer_name',
        'credit_amount',
        'sum_id',
        'dsr_id',
        'status',
        'created_at',
        'updated_at',
    ];

}
