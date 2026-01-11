<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscountCupon extends Model
{
    protected $table='discount_cupons';
    protected  $fillable = ['slug', 'amount', 'active', 'minimum_amount'];
}
