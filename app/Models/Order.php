<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [  
        'client_id',
        'type_id',
        'description',
        'address',
        'status',
        'order_date',
        'scheduling_date',
        'completion_date',
        'cancellation_date',
        'reason_for_cancellation',
        'rating',
    ];

    public function TypeOrder(){
        return $this->belongsTo(OrderTypes::class,'type_id');
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function clientName(){
        return $this->belongsTo(Client::class);
    }

    
    //sempre order_date 
    //se agendado retornar ...+ scheduling_date
    // se completo ...+ scheduling_date + completed_date
    //se cancelado ...+ order_date

    public function TranslateStatus(){
        switch ($this->status) {
            case 'in_analysis':
                return 'EM ANÁLISE';//amarelo
                break;

            case 'scheduled':
                return 'AGENDADO';//azul
                break;

            case 'completed':
                return 'CONCLUÍDO';//verde
                break;

            case 'canceled':
                return 'CANCELADO';//vermelho
                break;

            default:
                return 'STATUS DESCONHECIDO';
        }
    }

}
