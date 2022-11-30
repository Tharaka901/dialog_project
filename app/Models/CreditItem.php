<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditItem extends Model
{
  use HasFactory;

  protected $primaryKey = 'id';
  protected $fillable = [
    'credit_id',
    'item_id',
    'item_price',
    'status'
 ];
}
