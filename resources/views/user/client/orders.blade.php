@extends('layout.main')
@section('title', 'Pedidos')

@section('head')
 <style>
    ::-webkit-scrollbar-track {
        width: 0px;
    }
    ::-webkit-scrollbar {
        width: 0px;
    }
    ::-webkit-scrollbar-thumb {
        width: 0px;
    }

 </style>
@endsection

@section('content')
<main>
    <div class="max-w-6xl mx-auto p-8">
        <div class="bg-white/90 backdrop-blur-md rounded-2xl shadow-xl  p-6  border flex flex-col  border-purple-200">

            <div class="flex justify-beetwen items-center mb-3 ">
                <h1 class="font-bold text-black text-3xl text-center">Pedidos</h1>

                <a href="{{route('client.orders.create')}}"  class= "ml-auto bg-white text-black font-bold py-3 px-6 rounded-lg hover:bg-purple-100 border-2 border-purple-300 hover:border-purple-500 transition-all  duration-200 shadow-lg hover:shadow-xl transform hover:-transl ate-y-0.5">
                    Novo Pedido
                </a>
            </div>

<!-- bg-purple-100 rounded-lg p-4 border border-purple-200 cursor-pointer transition-all duration-300 hover:bg-purple-200 hover:shadow-lg hover:scale-105 hover:border-purple-400 transform -->
            <div class="overflow-scroll lg:max-h-[65vh] p-8 ">
                @foreach($orders as $order)
                    <div class="bg-white rounded-[20px] p-6 mb-6 shadow-lg border  transition-all duration-300 hover:bg-purple-200 hover:shadow-lg hover:scale-105 hover:border-purple-400 transform  border-purple-200 " >
                        <div class="flex justify-between items-center">
                            <div class="">
                                <div class="text-lg font-semibold text-purple-700 mb-2">Pedido {{$order->id}}</div>
                                <div class="text-base text-gray-700 mb-2">
                                    <span class="font-semibold text-purple-600">Descrição:</span> {{$order->description}}
                                </div>
                                <div class="px-4 py-2 my-3 rounded-[15px] text-sm font-semibold uppercase bg-{{$order->statusColor()}}-200 text-black inline-block">
                                    {{$order->TranslateStatus()}}
                                </div>

                                <div class="flex gap-25 justify-between">
                                    <div>@if($order->status!='canceled'){{$order->payment->final_amount}} @endif</div>
                                    <div>
                                        @if($order->status!='canceled' && $order->payment->payment_status=='waiting')
                                            <a href="{{route('client.order.showFormPayment', $order->id)}}"  class= "ml-auto bg-white text-black font-bold py-3 px-6 rounded-lg hover:bg-purple-100 border-2 border-purple-300 hover:border-purple-500 transition-all  duration-200 shadow-lg hover:shadow-xl transform hover:-transl ate-y-0.5" type="">Pagar</a>
                                       @endif
                                    </div>
                                </div>
                            </div>

                            @if($order->TranslateStatus()=='AGENDADO')
                                <div class="px-4 py-2 rounded-[15px] text-sm font-semibold uppercase bg-blue-200 text-yellow-800 inline-block">
                                    {{$order->scheduling_date}}
                                </div>
                            @endif


                            <div>
                                <a href="{{route('client.orders.edit', $order->id)}}" class="px-4 py-2 bg-purple-600 text-white font-semibold rounded-lg hover:bg-purple-700 transition-colors ml-4 cursor-pointer hover:shadow-2xl ">
                                    Ver mais
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="flex justify-center items-center">
                    {{ $orders->links('pagination::simple-tailwind') }}
                </div>
            </div>
        </div>
    </div>

</main>


@endsection
