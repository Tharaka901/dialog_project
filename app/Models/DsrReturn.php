<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DsrReturn extends Model
{
    protected $fillable = [
        'dsr_id',
        'item_id',
        'qty',
        'status',
    ];

    use HasFactory;
}
