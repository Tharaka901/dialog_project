<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DsrStock extends Model
{
    protected $fillable = [
        'id',
        'stock_id',
        'dsr_id',
        'status',
    ];

    use HasFactory;
}
