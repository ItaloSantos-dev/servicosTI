<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderTypes extends Model
{
    protected $table='Order_Types';

    protected  $fillable = ['name', 'amount'];
}
