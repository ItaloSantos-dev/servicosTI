@extends('layout.main')

@section('title', 'orders')

@section('head')
@endsection

@section('content')
<main>
    <div class="container mx-auto">
        <div class="space-y-4 m-2">
            @foreach($employeeWithOrders->employee->orders as $order)
                
                    <!-- Serviço 1 -->
                    <div class="bg-linear-to-r from-purple-50 to-purple-100/50 rounded-xl p-6 border-2 border-purple-200/60 hover:shadow-lg hover:border-purple-300 transition-all duration-300">
                        <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-5">
                            
                            <div class="flex-1 space-y-3">
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="text-xl font-bold text-purple-800 tracking-tight">Serviço #{{$order->id}}</div>
                                    <div class="px-3 py-1.5 rounded-lg text-xs font-bold uppercase bg-green-200 text-green-900 border border-green-300 shadow-sm">
                                        {{$order->TypeOrder->name}}
                                    </div>
                                    <div class="px-3 py-1.5 rounded-lg text-xs font-bold uppercase bg-{{$order->statusColor()}}-200 text-{{$order->statusColor()}}-900 border border-green-300 shadow-sm">
                                        {{$order->TranslateStatus()}}
                                    </div>
                                </div>
                                <div class="text-base text-gray-800 leading-relaxed mb-3 bg-white/60 rounded-lg p-3 border border-purple-100">
                                    <span class="font-bold text-purple-700 mr-2">Descrição:</span> 
                                    <span class="text-gray-700">{{$order->description}}</span>
                                </div>
                                <div class="text-base text-gray-800 bg-white/60 rounded-lg p-3 border border-purple-100">
                                    <span class="font-bold text-purple-700 mr-2">Data Agendada:</span> 
                                    <span class="text-gray-700 font-medium">{{$order->scheduling_date}}</span>
                                </div>

                                
                            </div>
                            <a
                                href="{{route('employee.orders.show', $order->id)}}" 
                                class="px-6 py-3 bg-linear-to-r from-purple-600 to-purple-700 text-white font-bold rounded-lg hover:from-purple-700 hover:to-purple-800 transition-all duration-200 whitespace-nowrap shadow-md hover:shadow-lg transform hover:scale-105"
                            >
                                Ver Detalhes
                            </a>
                        </div>
                    </div>
            @endforeach
        </div>
    </div>

    <div class="container mx-auto">
        <div class="flex justify-center items-center">
            <h1 class="text-2xl text-white font-bold">Navigator Page</h1>
        </div>
    </div>
</main>
@endsection

@section('scripts')
@endsection
