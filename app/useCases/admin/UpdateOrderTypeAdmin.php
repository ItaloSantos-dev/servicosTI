<?php
namespace App\useCases\admin;
use App\Models\OrderType;

class UpdateOrderTypeAdmin{
    public  function execute($id, $data)
    {
        $order = OrderType::findOrFail($id);
        $order->name = $data['name'];
        $order->amount = $data['amount'];
        if(isset($data['active'])){
            $order->active=true;
        }
        else{
            $order->active=false;
        }
        return $order->save();
    }
}
