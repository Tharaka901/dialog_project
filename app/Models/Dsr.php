<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Sale;

class Dsr extends Model
{
    use HasFactory;

    protected $fillable = [
        'in_hand',
        'cash',
        'cheque',
        'sum_id',
        'dsr_user_id',
        'created_at',
        'status',
    ];
}
