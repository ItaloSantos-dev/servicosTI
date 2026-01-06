<?php
namespace App\useCases\order;

use App\Models\Order;

use function Symfony\Component\Clock\now;

class CancellationOrder{
    public function execute($id, $data){
        $order = Order::findOrFail($id);
        $order->status = 'canceled';
        $order->reason_for_cancellation=$data['reason_for_cancellation'];
        $order->cancellation_date=now();
        return $order->save();
    }
}