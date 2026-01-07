<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['user_id'];

    public function orders(){
        return $this->belongsToMany(Order::class)->orderBy('order_date','desc');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function ordersCompleted(){
        return $this->belongsToMany(Order::class)->where('status', 'completed');
    }

    public function ordersScheduled(){
        return $this->belongsToMany(Order::class)->where('status', 'scheduled');
    }


}
