<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

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
        return $this->belongsTo(OrderType::class,'type_id');
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function employees(){
        return $this->belongsToMany(Employee::class);
    }

    public function clientName(){
        return $this->belongsTo(Client::class);
    }

    protected $casts = [
        'order_date' => 'datetime',
        'scheduling_date' => 'datetime',
        'completion_date' => 'datetime',
        'cancellation_date' => 'datetime',

    ];

    public  function payment ()
    {
        return $this->hasOne(Payment::class);
    }

    public function ratingColor(){
        if($this->rating<2){
            return "red";
        }
        else if($this->rating<4){
            return "yellow";
        }
        else{
            return "green";
        }
    }

    public function statusColor(){
        if($this->status=='in_analysis'){
            return "gray";
        }
        else if($this->status=='scheduled'){
            return "blue";
        }
        else if($this->status=='completed'){
            return "green";
        }
        else if($this->status=='canceled'){
            return "red";
        }
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

            case 'scheduled'://data do agendamento
                return 'AGENDADO';//azul
                break;

            case 'completed'://data do agendamento, data que foi concluido, rating
                return 'CONCLUÍDO';//verde
                break;

            case 'canceled'://data do agendamento, data que foi cancelado, motivo
                return 'CANCELADO';//vermelho
                break;

            default:
                return 'STATUS DESCONHECIDO';
                break;
        }
    }

    public function dateFormating($data){
        return $data->format('d/m/Y H:i');
    }

    public function dateDay($date){
        return $date->format('d');
    }

    public function dateDayAndMonth($date){
        return $date->format('d/m');
    }

    public function dateHour($date){
        return $date->format('H:m');
    }

    public function scopeScheduledthisMonth($query){
        return $query->orderBy('scheduling_date', 'asc')->where('status', 'scheduled')->whereBetween('scheduling_date', [now()->startOfMonth(),now()->endOfMonth()]);
    }

}
