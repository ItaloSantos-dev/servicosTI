@extends('layout.main')

@section('title', 'Editar Pedido')


@section('content')
<main class="">
    @if($errors->any()||session()->has('info'))
        <div id="divErrors" class="flex flex-col justify-center absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-purple-300/20 backdrop-blur-2xl rounded-[20px] p-8 shadow-2xl max-w-2xl w-full z-50">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-semibold text-purple-700">
                    @if($errors->any())
                        Erro
                    @else
                        Informação
                    @endif
                </h2>
                <button 
                    onclick="hideOrderDetails('divErrors')"
                    class="px-6 py-3 bg-gray-500 text-white font-semibold rounded-lg hover:bg-gray-600 transition-colors"
                >
                    Fechar
                </button>
            </div>

            <div class="flex flex-col gap-4">
                @if($errors->any())
                    @foreach($errors->all() as $erro)
                        <div class="p-4 bg-red-50 border-l-4 border-red-500 rounded-lg">
                            <p class="text-base text-red-800 font-medium">{{$erro}}</p>
                        </div>
                    @endforeach
                @endif

                @if(session()->has('info'))
                    <div class="p-4 bg-blue-50 border-l-4 border-blue-500 rounded-lg">
                        <p class="text-base text-blue-800 font-medium">{{session('info')}}</p>
                    </div>
                @endif
            </div>
        </div>
    @endif
    <div class="container max-w-7xl mx-auto px-4">
        <div class="mb-8">
            <div class="flex items-center gap-4 mb-6">
                <a href="{{ route('admin.orders.show', $order->id) }}" 
                   class="text-gray-600 hover:text-gray-900 transition-colors duration-200">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="text-3xl font-bold text-gray-900">Editar Pedido</h1>
            </div>
            
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <span class="text-xl font-bold text-gray-900 font-mono">
                                #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
                            </span>
                            <span class="px-4 py-1.5 inline-flex text-sm font-semibold rounded-full 
                                bg-{{ $order->statusColor() }}-100 text-{{ $order->statusColor() }}-800 border border-{{ $order->statusColor() }}-200">
                                {{ $order->translateStatus() }}
                            </span>
                        </div>
                        <p class="text-gray-600">
                            Última atualização: {{ $order->updated_at->format('d/m/Y à\s H:i') }}
                        </p>
                    </div>
                    
                    <div class="flex gap-3">
                        <a href="{{ route('admin.orders.show', $order->id) }}" 
                           class="bg-gray-100 text-red-700 px-5 py-2.5 rounded-xl hover:bg-red-200 transition-all duration-200 font-semibold flex items-center gap-2">
                            <i class="fas fa-times"></i>
                            Cancelar
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <form id="formUpdate" action="{{route('admin.orders.update', $order->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 space-y-8">
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-6 pb-3 border-b border-gray-200">
                            <i class="fas fa-edit text-blue-500 mr-2"></i>
                            Informações Básicas
                        </h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="type_id" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Tipo de Pedido *
                                </label>
                                <select name="type_id" id="type_id" 
                                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                    @foreach($typeOrders as $typeOrder)
                                    <option value="{{ $typeOrder->id }}" {{ $order->type_id == $typeOrder->id ? 'selected' : '' }}>
                                        {{ $typeOrder->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div>
                                <label for="scheduling_date" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Data de Agendamento
                                </label>
                                <input type="datetime-local" name="scheduling_date" id="scheduling_date"
                                       value="{{ $order->scheduling_date ? $order->scheduling_date->format('Y-m-d\TH:i') : '' }}"
                                       class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-6 pb-3 border-b border-gray-200">
                            <i class="fas fa-align-left text-green-500 mr-2"></i>
                            Conteúdo do Pedido
                        </h2>
                        
                        <div class="mb-6">
                            <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                                Descrição *
                            </label>
                            <textarea name="description" id="description" rows="6"
                                      class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none">{{ old('description', $order->description) }}
                            </textarea>
                        </div>
                        
                        <div>
                            <label for="address" class="block text-sm font-semibold text-gray-700 mb-2">
                                Endereço *
                            </label>
                            <textarea name="address" id="address" rows="4"
                                      class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none">{{ old('address', $order->address) }}
                            </textarea>
                        </div>
                    </div>
                </div>

                <div class="space-y-8">
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-6 pb-3 border-b border-gray-200">
                            <i class="fas fa-user-tag text-purple-500 mr-2"></i>
                            Cliente:
                        </h2>
                        
                        <div class="p-4 bg-gray-50 rounded-xl border border-gray-200">
                            <div class="flex items-center gap-3">
                                <div class="shrink-0 h-10 w-10">
                                    <div class="h-10 w-10 rounded-full bg-linear-to-r from-blue-500 to-indigo-500 flex items-center justify-center">
                                        <span class="text-white font-semibold">
                                            {{ strtoupper(substr($order->client->user->name ?? '', 0, 1)) }}
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">
                                        {{ $order->client->user->name }}
                                    </p>
                                    <p class="text-sm text-gray-600">
                                        {{ $order->client->user->email }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6 ">
                        <h2 class="text-xl font-semibold text-gray-900 mb-6 pb-3 border-b border-gray-200">
                            <i class="fas fa-users text-indigo-500 mr-2"></i>
                            Funcionários
                        </h2>
                        
                        <div id="funcionariosDisponiveis" class=" max-h-7 overflow-hidden  transition-all absolute">
                            <button  onclick="ExibirListaFuncionarios(true)" type="button" class="cursor-pointer hover:shadow-2xs shadow block text-sm font-semibold text-gray-700 mb-3">
                                Atribuir Funcionários
                                <i id = "exibirFuncionarios" class="fa fa-arrow-down"></i>
                            </button>
                            <div  class="bg-gray-300 rounded-2xl shadow-2xl p-3  w-85 flex flex-col">
                                @foreach($employees as $employe)
                                    <div> 
                                        <input type="checkbox"
                                        name="employees[]"
                                        value="{{$employe->id}}"
                                        {{$order->employees->contains('id', $employe->id) ? 'checked':''}}
                                        name="employess[]" 
                                        id="{{$employe->user->name}}"> 
                                        <label for="{{$employe->user->name}}">{{$employe->user->name}}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        
                        
                        
                        @if($order->employees->count() > 0)
                        <div class="mt-20  border-t border-gray-200">
                            <h3 class="text-sm font-semibold text-gray-700 mb-3">
                                Atualmente Atribuídos
                            </h3>
                            <div class="space-y-2">
                                @foreach($order->employees as $employee)
                                <div class="flex items-center gap-2">
                                    <div class="h-2 w-2 rounded-full bg-green-500"></div>
                                    <span class="text-sm text-gray-700">{{ $employee->user->name }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-6 pb-3 border-b border-gray-200">
                            <i class="fas fa-cogs text-gray-500 mr-2"></i>
                            Ações
                        </h2>
                        
                        <div class="space-y-4">
                            <button
                                    onclick="hideOrderDetails('order-overlay')"
                                    id="btnConfirmarEdicao"
                                    data-route="{{ route('admin.orders.update', $order->id)}}"
                                    data-method="PUT"
                                    data-show=false
                                    type="button"
                                    class="cursor-pointer w-full bg-linear-to-r from-green-500 to-emerald-600 text-white px-6 py-3.5 rounded-xl hover:from-green-600 hover:to-emerald-700 transition-all duration-200 font-semibold flex items-center justify-center gap-2">
                                <i class="fas fa-save"></i>
                                Salvar Alterações
                            </button>
                            
                            <a href="{{ route('admin.orders.show', $order->id) }}" 
                               class=" w-full bg-gray-100 text-gray-700 px-6 py-3.5 rounded-xl hover:bg-gray-200 transition-all duration-200 font-semibold flex items-center justify-center gap-2">
                                <i class="fas fa-eye"></i>
                                Visualizar Pedido
                            </a>
                            
                            <button type="button"
                                onclick="hideOrderDetails('order-overlay')"
                                id="btnCancelarPedido"
                                data-route="{{ route('admin.orders.destroy', $order->id)}}"
                                data-method="DELETE"
                                data-show=true
                               class="cursor-pointer w-full bg-linear-to-r from-red-500 to-red-600 text-white px-6 py-3.5 rounded-xl hover:from-red-600 hover:to-red-700 transition-all duration-200 font-semibold flex items-center justify-center gap-2">
                                <i class="fas fa-times-circle"></i>
                                Cancelar Pedido
                            </button>


                        </div>
                    </div>
                    <div id="order-overlay" class="fixed hidden inset-0 bg-black/50 bg-opacity-60 backdrop-blur-md z-50  items-center justify-center p-4">
                        <div class="bg-white rounded-[20px] p-8 shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">

                            <div id="divReasonCancellation" class="hidden">
                                <div class="text-center flex flex-col gap-3 p-3">
                                    <div class="flex flex-col justify-center">
                                        <label for="reason_for_cancellation" class="text-2xl font-bold">Motivo do cancelamento do pedido</label>
                                        <textarea class="text-base text-gray-800 p-4 bg-purple-50 rounded-lg border border-purple-200 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition resize-none" name="reason_for_cancellation" id="reason_for_cancellation"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center flex flex-col gap-3 p-3">
                                <div class="flex justify-center flex-col">
                                    <label for="password" class="text-2xl font-bold">Confirme sua senha</label>
                                    <div class="flex justify-center">
                                        <input type="password" name='password' id='password' class='border shadow rounded p-2 w-90' />
                                        <div class=" p-1 flex justify-center">
                                            <button type="button" id="exibirSenha" onclick="ExibirSenha()" class="fa-solid fa-eye"></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-center gap-5">
                                <button 
                                    class="px-6 py-3 bg-purple-600 text-white font-semibold cursor-pointer rounded-[20px] shadow-lg hover:bg-green-700 transition-colors"
                                    type="submit"
                                    
                                >
                                    Confirmar
                                </button>
                                <button class="px-6 py-3 bg-gray-500 text-white font-semibold rounded-[20px] shadow-lg hover:bg-red-600 transition-colors"
                                    onclick="hideOrderDetails('order-overlay')"
                                    type="button"
                                >
                                    Cancelar
                                </button>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>
@section('scripts')
<script>
    function  ExibirListaFuncionarios() {
        const  btnIExibir = document.getElementById('exibirFuncionarios');
        if(btnIExibir.classList.contains('fa-arrow-down')){
            document.getElementById('funcionariosDisponiveis').classList.replace('max-h-7', 'max-h-85')
            btnIExibir.classList.replace('fa-arrow-down', 'fa-arrow-up');
            
        }
        else{
            document.getElementById('funcionariosDisponiveis').classList.replace('max-h-85', 'max-h-7')
            btnIExibir.classList.replace('fa-arrow-up', 'fa-arrow-down');
            

        }
    }
    function ExibirSenha() {
        var senhaInput = document.getElementById("password");
        var exibirSenhaBtn = document.getElementById("exibirSenha");

        if (senhaInput.type === "password") {
            senhaInput.type = "text";
            exibirSenhaBtn.classList.remove("fa-eye");
            exibirSenhaBtn.classList.add("fa-eye-slash");
        } else {
            senhaInput.type = "password";
            exibirSenhaBtn.classList.remove("fa-eye-slash");
            exibirSenhaBtn.classList.add("fa-eye");
        }
    }

    function showOrderDetails(divId) {
        const overlay = document.getElementById(divId);
        overlay.classList.remove('hidden');
        overlay.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }
    function hideOrderDetails(divId) {
        const overlay = document.getElementById(divId);
        overlay.classList.add('hidden');
        overlay.classList.remove('flex');
        document.body.style.overflow = 'auto';
    }
    const btnConfirmar = document.getElementById('btnConfirmarEdicao');
    btnConfirmar.addEventListener('click', ()=>{
        AlterarRota(btnConfirmar.dataset.route, 'order-overlay', btnConfirmar.dataset.method, btnConfirmar.dataset.show);
        
    })

    const btnCancelar = document.getElementById('btnCancelarPedido');
    btnCancelar.addEventListener('click', ()=>{
        AlterarRota(btnCancelar.dataset.route, 'order-overlay', btnCancelar.dataset.method, btnCancelar.dataset.show);
    })

    function AlterarRota(rota, divId, method, showReasonCancellatio) {
        const methodInput = document.querySelector('input[name="_method"]');
        methodInput.value = method;
        document.getElementById('formUpdate').action=rota;
        console.log(showReasonCancellatio);
        
        const reasonDiv = document.getElementById('divReasonCancellation');
        const show = showReasonCancellatio === 'true';

        reasonDiv.classList.toggle('hidden', !show);

        
        showOrderDetails(divId)
    }
</script>
@endsection
@endsection