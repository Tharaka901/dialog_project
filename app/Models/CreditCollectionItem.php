<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditCollectionItem extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $fillable = [
        'credit_collection_id',
        'item_id',
        'item_price',
        'status'
    ];
    
}
