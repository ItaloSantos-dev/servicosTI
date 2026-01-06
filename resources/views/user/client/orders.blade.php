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
                @foreach($clientWithOrders->client->orders as $order)
                    <div class="bg-white rounded-[20px] p-6 mb-6 shadow-lg border  transition-all duration-300 hover:bg-purple-200 hover:shadow-lg hover:scale-105 hover:border-purple-400 transform  border-purple-200 " >
                        <div class="flex justify-between items-center">
                            <div class="">
                                <div class="text-lg font-semibold text-purple-700 mb-2">Pedido {{$order->id}}</div>
                                <div class="text-base text-gray-700 mb-2">
                                    <span class="font-semibold text-purple-600">Descrição:</span> {{$order->description}}
                                </div>
                                <div class="px-4 py-2 rounded-[15px] text-sm font-semibold uppercase bg-{{$order->statusColor()}}-200 text-black inline-block">
                                    {{$order->TranslateStatus()}}
                                </div>
                            </div>

                            @if($order->TranslateStatus()=='AGENDADO')
                            <div class="px-4 py-2 rounded-[15px] text-sm font-semibold uppercase bg-blue-200 text-yellow-800 inline-block">
                                {{$order->scheduling_date}}
                            </div>
                            @endif


                            <div>
                                <button onclick="showOrderDetails('{{$order->id}}')" class="px-4 py-2 bg-purple-600 text-white font-semibold rounded-lg hover:bg-purple-700 transition-colors ml-4 cursor-pointer hover:shadow-2xl ">
                                    Ver mais
                                </button>
                            </div>
                        </div>
                    </div>
<!--Detalhes ocultos -->
                    <div class="hidden">
                        <div id="orderIdValue{{$order->id}}">{{$order->id}}</div>
                        <div id="typeOrderValue{{$order->id}}">{{$order->TypeOrder->name}}</div>
                        <div id="orderDescValue{{$order->id}}">{{$order->description}}</div>
                        <div id="orderAddressValue{{$order->id}}">{{$order->address}}</div>
                        <div id="orderStatusValue{{$order->id}}">{{$order->TranslateStatus()}}</div>
                        <div id="orderDateValue{{$order->id}}">{{$order->order_date}}</div>


                        @if($order->TranslateStatus()=='AGENDADO')
                            <div id="schedulingDateValue{{$order->id}}">{{$order->scheduling_date}}</div>
                        @endif

                        @if($order->TranslateStatus()=='CONCLUÍDO')
                            <div id="completionDateValue{{$order->id}}">{{$order->completion_date}}</div>
                        @endif
                        
                        @if($order->TranslateStatus()=='CANCELADO')
                            <div id="cancellationDateValue{{$order->id}}">{{$order->cancellation_date}}</div>
                            <div id="cancellationReason{{$order->id}}">{{$order->reason_for_cancellation}}</div>
                        @endif


                        
                        
                        

                    </div>
                @endforeach
            </div>
        </div>


        
    </div>

    <!-- Overlay com Blur -->
    <div id="order-overlay" class="fixed inset-0 bg-black/50 bg-opacity-60 backdrop-blur-md z-50  hidden items-center justify-center p-4">

        <div class="bg-white rounded-[20px] p-8 shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
            
            <div class="flex justify-between items-center mb-8">
                <h2 id="orderId" class="text-3xl font-semibold text-purple-700">Detalhes do Pedido #1</h2>
                <button 
                    onclick="hideOrderDetails()"
                    class="px-6 py-3 bg-gray-500 text-white font-semibold rounded-lg hover:bg-gray-600 transition-colors"
                >
                    Fechar
                </button>
            </div>
<!-- grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 -->
            <div id="orderdetails" class="flex flex-col gap-2  ">

                <div class="hidden" id="detailOrderId"></div>

                <div class="flex gap-20 justify-center items-center">
                    <div class="flex flex-col gap-2">
                        <span class="text-sm font-bold text-purple-600">Tipo</span>
                        <div id="detailTypeOrder" class="text-base text-gray-800 p-4 bg-purple-50 rounded-lg"></div>
                    </div>
                    
                    <div class="flex flex-col gap-2">
                        <span class="text-sm font-bold text-purple-600">Descrição</span>
                        <div id="detailDescOrder" class="text-base text-gray-800 p-4 bg-purple-50 rounded-lg "></div>
                    </div>
                    
                    <div class="flex flex-col gap-2">
                        <span class="text-sm font-bold text-purple-600">Endereço</span>
                        <div id="detailAddressOrder" class="text-base text-gray-800 p-4 bg-purple-50 rounded-lg"></div>
                    </div>
                </div>
                
                <div class="flex gap-20 justify-center items-center">
                    <div class="flex flex-col gap-2">
                        <span class="text-sm font-bold text-purple-600">Status</span>
                        <div id="detailStatusOrder" class="px-4 py-2 rounded-[15px] text-sm font-semibold uppercase bg-yellow-100 text-yellow-800 inline-block w-fit"></div>
                    </div>
                    
                    <div class="flex flex-col gap-2">
                        <span class="text-sm font-bold text-purple-600">Data do Pedido</span>
                        <div id="detailOrderDateOrder" class="text-base text-gray-800 p-4 bg-purple-50 rounded-lg"></div>
                    </div>
                    
                    <div id="schedulingDate" class="flex flex-col gap-2 hidden">
                        <span class="text-sm font-bold text-purple-600">Data de Agendamento</span>
                        <div id="detailSchedulingDate" class="text-base text-purple-400 italic p-4 bg-purple-50 rounded-lg">Não agendado</div>
                    </div>
                    
                    <div id="completionDate" class="flex flex-col gap-2 hidden">
                        <span class="text-sm font-bold text-purple-600">Data de Conclusão</span>
                        <div id="detailCompletionDateValue" class="text-base text-purple-400 italic p-4 bg-purple-50 rounded-lg">Não concluído</div>
                    </div>
                    
                    <div id="cancellationDate" class="flex flex-col gap-2 hidden">
                        <span class="text-sm font-bold text-purple-600">Data de Cancelamento</span>
                        <div id="detailCancellationDateValue" class="text-base text-purple-400 italic p-4 bg-purple-50 rounded-lg">Não cancelado</div>
                    </div>
                </div>

                <div class="flex justify-center items-center">
                    <div id="cancellationReason" class="flex flex-col gap-2 md:col-span-2 lg:col-span-3 hidden">
                        <span class="text-sm font-bold text-purple-600">Motivo do Cancelamento</span>
                        <div id="detailCancellationReasonValue" class="text-base text-purple-400 italic p-4 bg-purple-50 rounded-lg">-</div>
                    </div>
                </div>

                <div class="hidden"id="updateButton">
                    <div class="flex justify-center">
                        <button onclick="AcessarRota()" class="px-6 py-3 bg-gray-500 text-white font-semibold cursor-pointer rounded-[20px] shadow-lg hover:bg-gray-600 transition-colors">Editar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@section('scripts') 
    <script>
        function showOrderDetails(orderId) {
            CopyDetails(orderId)
            const overlay = document.getElementById('order-overlay');
            overlay.classList.remove('hidden');
            overlay.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function CopyDetails(orderId) {
            document.getElementById('orderId').innerText="Pedido #" + orderId;

            document.getElementById('detailOrderId').innerText=orderId;


            document.getElementById('detailTypeOrder').innerText = document.getElementById('typeOrderValue'+orderId).textContent;

            document.getElementById('detailDescOrder').innerText = document.getElementById('orderDescValue'+orderId).textContent;

            document.getElementById('detailAddressOrder').innerText = document.getElementById('orderAddressValue'+orderId).textContent;

            document.getElementById('detailStatusOrder').innerText = document.getElementById('orderStatusValue'+orderId).textContent;

            document.getElementById('detailOrderDateOrder').innerText = document.getElementById('orderDateValue'+orderId).textContent;

            const scheduledValue = document.getElementById('schedulingDateValue'+orderId);
            if(scheduledValue){
                document.getElementById('schedulingDate').classList.remove('hidden');
                document.getElementById('detailSchedulingDate').innerText = scheduledValue.textContent;    
            }
            else{
                document.getElementById('schedulingDate').classList.add('hidden');
            }

            const completionValue = document.getElementById('completionDateValue'+orderId);
            if(completionValue){
                document.getElementById('completionDate').classList.remove('hidden');
                document.getElementById('detailCompletionDateValue').innerText = completionValue.textContent;
            }
            else{
                document.getElementById('completionDate').classList.add('hidden');
                
            }

            const cancelationValue = document.getElementById('cancellationDateValue'+orderId);
            if(cancelationValue){
                document.getElementById('cancellationDate').classList.remove('hidden');
                document.getElementById('detailCancellationDateValue').innerText=cancelationValue.textContent;
                
                document.getElementById('cancellationReason').classList.remove('hidden');
                document.getElementById('detailCancellationReasonValue').innerText=document.getElementById('cancellationReason'+orderId).textContent;
                
            }
            else{
                document.getElementById('cancellationDate').classList.add('hidden');
                document.getElementById('cancellationReason').classList.add('hidden');
            }

            if(!completionValue && !cancelationValue){
                document.getElementById('updateButton').classList.remove('hidden');

            }
            else{
                document.getElementById('updateButton').classList.add('hidden');
            }

        }

        function hideOrderDetails() {
            const overlay = document.getElementById('order-overlay');
            overlay.classList.add('hidden');
            overlay.classList.remove('flex');
            document.body.style.overflow = 'auto';
        }

        // Fechar overlay ao clicar fora do conteúdo
        document.getElementById('order-overlay').addEventListener('click', function(e) {
            if (e.target === this) {
                hideOrderDetails();
            }
        });

        function AcessarRota(){
            
            const id = document.getElementById('detailOrderId').textContent;
            console.log(id);
            
            
            window.location.href = `/client/orders/${id}`;

        }

    </script>
@endsection
@endsection
