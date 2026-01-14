<?php

namespace App\Http\Controllers;


use App\UseCases\Client\ExecutePayment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private ExecutePayment $executePayment;
    public function __construct()
    {
        $this->executePayment = new ExecutePayment();
    }

    public  function executePayment(Request $request, $id)
    {
        $password = $request->validate([
            'password' =>'required|string'
        ]);
        if(!$request->user()->checkPassword($password['password'])){
            return redirect()->back()->with('info', 'Senha incorreta');
        }
        $credential = $request->validate([
            'payment_method_id'=>'required|numeric'
        ]);
        $executePaymentStatus = $this->executePayment->execute($credential, $id);
        if($executePaymentStatus !== true){
            return redirect()->back()->with('info', $executePaymentStatus);
        }
        return redirect()->route('client.orders');

    }
}
