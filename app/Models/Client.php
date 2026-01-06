<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'user_id',
    ];

    public function orders(){
        return $this->hasMany(Order::class)->orderBy('order_date','desc');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
