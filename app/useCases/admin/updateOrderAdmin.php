<?php
namespace App\useCases\admin;

use App\Models\Order;

class updateOrderAdmin 
{
    public function execute($id, $data){
        $order = Order::findOrFail($id);
        $order->type_id = $data ['type_id'];
        $order->description = $data ['description'];
        $order->address = $data ['address'];
        $order->employees()->sync($data['employees']);
        if(isset($data['scheduling_date'])){
            $order->scheduling_date=($data['scheduling_date']);
            $order->status='scheduled';
        }
        

        return $order->save();
    }    
}
