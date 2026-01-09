<?php
namespace App\useCases\admin;

use App\Models\Order;

class CreateOrderAdmin
{
    public function execute($data){
        if(isset($data['scheduling_date'])){
            $data['status']='scheduled';
        }
        else{
            $data['status']='in_analysis';
        }
        $data['order_date'] = now();

        return Order::create($data);
    }
}
