<?php
namespace App\UseCases\Client;
use App\Models\Payment;

class ExecutePayment
{
    public function execute($data, $id)
    {
        $payment = Payment::findOrFail($id);
        if($payment->payment_status=='conclued'){
            return "Este pagamento ja foi concluido";
        }
        if($payment->payment_status=='canceled'){
            return  "Este pedido foi cancelado";
        }
        $payment->payment_method_id = $data['payment_method_id'];
        $payment->payment_status = 'conclued';
        return $payment->save();
    }
}
