<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dsr extends Model
{
    use HasFactory;

    protected $fillable = [
        'in_hand',
        'cash',
        'cheque',
        'status',
    ];
    
}
