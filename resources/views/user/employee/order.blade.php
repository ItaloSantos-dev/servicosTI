@extends('layout.main')
@section('title', 'Pedidos - Funcionário')

@section('head')

@endsection
   
@section('content')
    <div class="max-w-6xl mx-auto p-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="font-light text-purple-700 text-3xl">Pedidos Atribuídos</h1>
        </div>
            <div class="bg-white rounded-[20px] p-6 mb-6 shadow-lg border border-purple-200">
                <div class="mb-6">
                    <h2 class="text-2xl font-semibold text-purple-700 mb-6">Pedido #{{$order->id}}</h2>
                    
                    <div class="flex gap-5 justify-between items-center">
                        
                        <div class="flex flex-col gap-2">
                            <span class="text-sm font-bold text-purple-600">Nome do Cliente</span>
                            <div class="text-base text-gray-800 p-4 bg-purple-50 rounded-lg">{{$order->client->user->name}}</div>
                        </div>
                        
                        <div class="flex flex-col gap-2">
                            <span class="text-sm font-bold text-purple-600">Tipo</span>
                            <div class="text-base text-gray-800 p-4 bg-purple-50 rounded-lg">{{$order->TypeOrder->name}}</div>
                        </div>
                        
                        <div class="flex flex-col gap-2 md:col-span-2 lg:col-span-3">
                            <span class="text-sm font-bold text-purple-600">Descrição</span>
                            <div class="text-base text-gray-800 p-4 bg-purple-50 rounded-lg">{{$order->description}}</div>
                        </div>
                    </div>
                    <div class="flex gap-5 justify-between items-center">
                        <div class="flex flex-col gap-2 md:col-span-2 lg:col-span-3">
                            <span class="text-sm font-bold text-purple-600">Endereço</span>
                            <div class="text-base text-gray-800 p-4 bg-purple-50 rounded-lg">{{$order->address}}</div>
                        </div>
                        <div class="flex flex-col gap-2">
                            <span class="text-sm font-bold text-purple-600">Status</span>
                            <div class="px-4 py-2 rounded-[15px] text-sm font-semibold uppercase bg-yellow-100 text-yellow-800 inline-block w-fit">
                                {{$order->TranslateStatus()}}
                            </div>
                        </div>
                    
                        
                        <div class="flex flex-col gap-2">
                            <span class="text-sm font-bold text-purple-600">Data do Pedido</span>
                            <div class="text-base text-gray-800 p-4 bg-purple-50 rounded-lg">
                                {{$order->order_date ? \Carbon\Carbon::parse($order->order_date)->format('d/m/Y H:i:s') : 'Não informado'}}
                            </div>
                        </div>
                    </div>
                    
                    @if($order->TranslateStatus()!= 'EM ANÁLISE')
                        <div class="flex gap-5 justify-between items-center">
                            
                            <div class="flex flex-col gap-2">
                                <span class="text-sm font-bold text-purple-600">Data de Agendamento</span>
                                <div class="text-base {{$order->scheduling_date ? 'text-gray-800' : 'text-purple-400 italic'}} p-4 bg-purple-50 rounded-lg">
                                    {{$order->scheduling_date ? \Carbon\Carbon::parse($order->scheduling_date)->format('d/m/Y H:i:s') : 'Não agendado'}}
                                </div>
                            </div>

                        </div>    
                            <div class="flex flex-col gap-2">
                                <span class="text-sm font-bold text-purple-600">Data de Conclusão</span>
                                <div class="text-base {{$order->completion_date ? 'text-gray-800' : 'text-purple-400 italic'}} p-4 bg-purple-50 rounded-lg">
                                    {{$order->completion_date ? \Carbon\Carbon::parse($order->completion_date)->format('d/m/Y H:i:s') : 'Não concluído'}}
                                </div>
                            </div>
                            
                            <div class="flex flex-col gap-2">
                                <span class="text-sm font-bold text-purple-600">Data de Cancelamento</span>
                                <div class="text-base {{$order->cancellation_date ? 'text-gray-800' : 'text-purple-400 italic'}} p-4 bg-purple-50 rounded-lg">
                                    {{$order->cancellation_date ? \Carbon\Carbon::parse($order->cancellation_date)->format('d/m/Y H:i:s') : 'Não cancelado'}}
                                </div>
                            </div>
                            
                            <div class="flex flex-col gap-2">
                                <span class="text-sm font-bold text-purple-600">Avaliação</span>
                                <div class="text-base {{$order->rating ? 'text-gray-800' : 'text-purple-400 italic'}} p-4 bg-purple-50 rounded-lg">
                                    {{$order->rating ? $order->rating : 'Não avaliado'}}
                                </div>
                            </div>
                            
                            <div class="flex flex-col gap-2 md:col-span-2 lg:col-span-3">
                                <span class="text-sm font-bold text-purple-600">Motivo do Cancelamento</span>
                                <div class="text-base {{$order->reason_for_cancellation ? 'text-gray-800' : 'text-purple-400 italic'}} p-4 bg-purple-50 rounded-lg">
                                    {{$order->reason_for_cancellation ? $order->reason_for_cancellation : '-'}}
                                </div>
                            </div>
                            
                            <div class="flex flex-col gap-2">
                                <span class="text-sm font-bold text-purple-600">Criado em</span>
                                <div class="text-base text-gray-800 p-4 bg-purple-50 rounded-lg">
                                    {{$order->created_at ? \Carbon\Carbon::parse($order->created_at)->format('d/m/Y H:i:s') : 'N/A'}}
                                </div>
                            </div>
                            
                            <div class="flex flex-col gap-2">
                                <span class="text-sm font-bold text-purple-600">Atualizado em</span>
                                <div class="text-base text-gray-800 p-4 bg-purple-50 rounded-lg">
                                    {{$order->updated_at ? \Carbon\Carbon::parse($order->updated_at)->format('d/m/Y H:i:s') : 'N/A'}}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
    </div>
@endsection
