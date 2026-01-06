@extends('layout.main')
@section('title', 'Pedidos - Funcionário')

@section('head')

@endsection
   
@section('content')
    <main>
        <div class="container justify-center flex flex-col mx-auto p-8">
            <div class="bg-white/90 backdrop-blur-md rounded-2xl shadow-xl mb-4 border border-purple-200 text-center">
                <h1 class="text-3xl font-bold text-black mb-2">
                    PEDIDO #{{$order->id}}
                </h1>
            </div>

            <div class="container bg-white/90 backdrop-blur-md rounded-2xl p-6 shadow-xl mb-6 border flex flex-col gap-5 border-purple-200">

                <div class="grid grid-cols-3 gap-6 items-start">
                    <div class="flex flex-col gap-2 text-center">
                        <span class="text-sm font-bold text-purple-600">Nome do Cliente</span>
                        <div class="text-base text-center text-gray-800 p-4 bg-purple-50 rounded-lg">{{$order->client->user->name}}</div>
                    </div>

                    <div class="flex flex-col gap-2 justify-center items-center text-red-200 text-center">
                        <span class="text-sm font-bold text-purple-600">Tipo do serviço</span>
                        <div class="px-4 py-2 rounded-[15px] text-sm font-semibold uppercase bg-orange-100 text-orange-800 inline-block w-fit">
                            {{$order->TypeOrder->name}}
                        </div>
                    </div>
                    
                    <div class="flex flex-col gap-2 text-center">
                        <span class="text-sm font-bold text-purple-600">Descrição</span>
                        <div class="text-base text-gray-800 p-4 bg-purple-50 rounded-lg">{{$order->description}}</div>
                    </div>
                </div>


                <div class="grid grid-cols-3 gap-6 items-start">
                    <div class="flex flex-col gap-2 text-center">
                        <span class="text-sm font-bold text-purple-600">Endereço</span>
                        <div class="text-base text-gray-800 p-4 bg-purple-50 rounded-lg">{{$order->address}}</div>
                    </div>

                    <div class="flex flex-col gap-2 justify-center items-center text-red-200 text-center">
                        <span class="text-sm font-bold text-purple-600">Status</span>
                        <div class="px-4 py-2 rounded-[15px] text-sm font-semibold uppercase bg-{{$order->statusColor()}}-100 text-{{$order->statusColor()}}-800 inline-block w-fit">
                            {{$order->TranslateStatus()}}
                        </div>
                    </div>
                
                    
                    <div class="flex flex-col gap-2 text-center">
                        <span class="text-sm font-bold text-purple-600">Data do Pedido</span>
                        <div class="text-base text-gray-800 p-4 bg-purple-50 rounded-lg">
                            {{$order->dateFormating($order->order_date)}}
                        </div>
                    </div>

                </div>

                @if($order->TranslateStatus()=='AGENDADO')
                    <div class="grid grid-cols-1 gap-6 items-start">
                        <div class="flex flex-col gap-2 text-center">
                            <span class="text-sm font-bold text-purple-600">Data do agendamento</span>
                            <div class="text-base text-gray-800 p-4 bg-purple-50 rounded-lg">
                                {{$order->dateFormating($order->scheduling_date)}}
                            </div>
                        </div>
                    </div>
                @endif

                @if($order->TranslateStatus()=='CONCLUÍDO')
                    <div class="grid grid-cols-3 gap-6 items-start">
                        <div class="flex flex-col gap-2 text-center">
                            <span class="text-sm font-bold text-purple-600">Data do agendamento</span>
                            <div class="text-base text-gray-800 p-4 bg-purple-50 rounded-lg">
                                {{$order->dateFormating($order->scheduling_date)}}
                            </div>
                        </div>
                        
                        <div class="flex flex-col gap-2 text-center">
                            <span class="text-sm font-bold text-purple-600">Data de conclusão</span>
                            <div class="text-base text-gray-800 p-4 bg-purple-50 rounded-lg">
                                {{$order->dateFormating($order->completion_date)}}
                            </div>
                        </div>

                        <div class="flex flex-col gap-2 text-center">
                            <span class="text-sm font-bold text-purple-600">Avaliação</span>
                            <div class="text-bas text-{{$order->ratingColor()}}-500  p-4 bg-purple-50 rounded-lg">
                                {{$order->rating }}
                            </div>
                        </div>
                    </div>
                @endif

                @if($order->TranslateStatus()=='CANCELADO')
                    <div class="grid grid-cols-3 gap-6 items-start">
                        <div class="flex flex-col gap-2 text-center">
                            <span class="text-sm font-bold text-purple-600">Data do agendamento</span>
                            <div class="text-base text-gray-800 p-4 bg-purple-50 rounded-lg">
                                {{$order->dateFormating($order->scheduling_date)}}
                            </div>
                        </div>
                        
                        <div class="flex flex-col gap-2 text-center">
                            <span class="text-sm font-bold text-purple-600">Data do cancelamento</span>
                            <div class="text-base text-gray-800 p-4 bg-purple-50 rounded-lg">
                                {{$order->dateFormating($order->cancellation_date)}}
                            </div>
                        </div>

                        <div class="flex flex-col gap-2 text-center">
                            <span class="text-sm font-bold text-purple-600">Motivo do cancelamento</span>
                            <div class="text-bas  p-4 bg-purple-50 rounded-lg">
                                {{$order->reason_for_cancellation}}
                            </div>
                        </div>
                    </div>
                @endif


            </div>
        </div>
    </main>
@endsection
