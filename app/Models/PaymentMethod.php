<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PaymentMethod extends Model
{
    use HasFactory;
//['name'=>'debit_card'],
//            ['name'=>'pix'],
//            ['name'=>'bank_slip'],
    public  function TranslateName ()
    {
        switch ($this->name){
            case'credit_card':
                return "CRÉDITO";
                break;

            case 'debit_card':
                return "DÉBITO ";
                break;

            case 'pix':
                return "PIX";
                break;

            case 'bank_slip':
                return "BOLETO BANCÁRIO";
                break;
        }
    }
}
