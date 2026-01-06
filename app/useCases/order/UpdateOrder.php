<?php
namespace App\useCases\order;

use App\Models\Order;

class UpdateOrder{
    public function execute($id, $data){
        $order = Order::findOrFail($id);
        $order->type_id = $data ['type_id'];
        $order->description = $data ['description'];
        $order->address = $data ['address'];

        return $order->save();
    }
}