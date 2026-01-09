@extends('layout.main')

@section('title', 'Detalhes do Pedido')

@section('content')
<main class="">
    <div class="container max-w-7xl mx-auto px-4 bg-white/40 p-2 rounded-2xl shadow">
        <!-- Cabeçalho -->
        <div class="mb-8 backdrop-blur-2xl">
            <div class="flex items-center gap-4 mb-6">
                <a href="{{ route('admin.orders') }}" 
                   class="text-gray-600 hover:text-gray-900 transition-colors duration-200">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="text-3xl font-bold text-gray-900">Detalhes do Pedido</h1>
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
                            Criado em {{ $order->created_at->format('d/m/Y à\s H:i') }}
                        </p>
                    </div>
                    
                    @if(in_array($order->status, ['in_analysis', 'scheduled']))
                        <a
                                href="{{route('admin.orders.edit', $order->id)}}"
                                class="bg-linear-to-r from-yellow-500 to-yellow-600  text-white px-6 py-2.5 rounded-xl hover:from-yellow-600 hover:to-yellow-700 transition-all duration-200 font-semibold flex items-center gap-2 cursor-pointer">
                            <i class="fas fa-edit"></i>
                            Editar Pedido
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Coluna principal -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Informações do Cliente -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6 pb-3 border-b border-gray-200">
                        <i class="fas fa-user text-blue-500 mr-2"></i>
                        Informações do Cliente
                    </h2>
                    
                    <div class="flex items-start gap-4">
                        <div class="shrink-0 h-14 w-14">
                            <div class="h-14 w-14 rounded-full bg-linear-to-r from-blue-500 to-indigo-500 flex items-center justify-center">
                                <span class="text-white font-bold text-lg">
                                    {{ strtoupper(substr($order->client->user->name ?? '', 0, 1)) }}
                                </span>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-1">
                                {{ $order->client->user->name ?? 'Não informado' }}
                            </h3>
                            <p class="text-gray-600 mb-2">
                                <i class="fas fa-envelope mr-2"></i>
                                {{ $order->client->user->email ?? 'Não informado' }}
                            </p>
                            <p class="text-sm text-gray-500">
                                ID do Cliente: #{{ str_pad($order->client->id, 5, '0', STR_PAD_LEFT) }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Detalhes do Pedido -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6 pb-3 border-b border-gray-200">
                        <i class="fas fa-clipboard-list text-green-500 mr-2"></i>
                        Detalhes do Pedido
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">
                                Tipo de Pedido
                            </h3>
                            <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                                <p class="text-gray-900 font-medium">
                                    {{ $order->TypeOrder->name ?? 'Não especificado' }}
                                </p>
                            </div>
                        </div>
                        
                        <div>
                            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">
                                Data do Pedido
                            </h3>
                            <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                                <p class="text-gray-900 font-medium">
                                    {{ $order->order_date->format('d/m/Y') }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    {{ $order->order_date->format('H:i') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">
                            Descrição
                        </h3>
                        <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                            <p class="text-gray-900 whitespace-pre-line">
                                {{ $order->description ?? 'Sem descrição' }}
                            </p>
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">
                            Endereço
                        </h3>
                        <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                            <p class="text-gray-900 whitespace-pre-line">
                                {{ $order->address ?? 'Endereço não informado' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Datas Importantes -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6 pb-3 border-b border-gray-200">
                        <i class="fas fa-calendar-alt text-purple-500 mr-2"></i>
                        Datas Importantes
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">
                                Data do pedido
                            </h3>
                            <div class="bg-blue-50 rounded-xl p-4 border border-blue-200">
                                <p class="text-gray-900 font-medium">
                                    {{ $order->order_date->format('d/m/Y') }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    {{ $order->order_date->format('H:i') }}
                                </p>
                            </div>
                        </div>
                        @if($order->scheduling_date)
                        <div>
                            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">
                                Data de Agendamento
                            </h3>
                            <div class="bg-blue-50 rounded-xl p-4 border border-blue-200">
                                <p class="text-gray-900 font-medium">
                                    {{ $order->scheduling_date->format('d/m/Y') }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    {{ $order->scheduling_date->format('H:i') }}
                                </p>
                            </div>
                        </div>
                        @endif
                        
                        @if($order->completion_date)
                        <div>
                            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">
                                Data de Conclusão
                            </h3>
                            <div class="bg-green-50 rounded-xl p-4 border border-green-200">
                                <p class="text-gray-900 font-medium">
                                    {{ $order->completion_date->format('d/m/Y') }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    {{ $order->completion_date->format('H:i') }}
                                </p>
                            </div>
                        </div>
                        @endif
                        
                        @if($order->cancellation_date)
                        <div>
                            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">
                                Data de Cancelamento
                            </h3>
                            <div class="bg-red-50 rounded-xl p-4 border border-red-200">
                                <p class="text-gray-900 font-medium">
                                    {{ $order->cancellation_date->format('d/m/Y') }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    {{ $order->cancellation_date->format('H:i') }}
                                </p>
                            </div>
                        </div>
                        @endif
                        
                        @if($order->reason_for_cancellation)
                        <div class="md:col-span-2">
                            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">
                                Motivo do Cancelamento
                            </h3>
                            <div class="bg-red-50 rounded-xl p-4 border border-red-200">
                                <p class="text-gray-900 whitespace-pre-line">
                                    {{ $order->reason_for_cancellation }}
                                </p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Coluna lateral -->
            <div class="space-y-8">
                <!-- Avaliação -->
                @if($order->rating)
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6 pb-3 border-b border-gray-200">
                        <i class="fas fa-star text-yellow-500 mr-2"></i>
                        Avaliação
                    </h2>
                    
                    <div class="flex flex-col items-center justify-center">
                        <div class="text-4xl font-bold text-gray-900 mb-2">
                            {{ $order->rating }}/10
                        </div>
                        <div class="flex gap-1 mb-4">
                            <i class="fas fa-star text-yellow-500"></i>

                        </div>
                        <p class="text-gray-600 text-center">
                            Avaliação do cliente
                        </p>
                    </div>
                </div>
                @endif

                <!-- Funcionários Envolvidos -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6 pb-3 border-b border-gray-200">
                        <i class="fas fa-users text-indigo-500 mr-2"></i>
                        Funcionários Envolvidos
                    </h2>
                    
                    @if($order->employees && $order->employees->count() > 0)
                    <div class="space-y-4">
                        @foreach($order->employees as $employee)
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 border border-gray-200">
                            <div class="shrink-0 h-10 w-10">
                                <div class="h-10 w-10 rounded-full bg-linear-to-r from-indigo-500 to-purple-500 flex items-center justify-center">
                                    <span class="text-white font-semibold">
                                        {{ strtoupper(substr($employee->user->name ?? '', 0, 1)) }}
                                    </span>
                                </div>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">
                                    {{ $employee->user->name ?? 'Nome não disponível' }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    {{ $employee->user->email ?? 'Email não disponível' }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-6">
                        <i class="fas fa-user-slash text-gray-400 text-4xl mb-3"></i>
                        <p class="text-gray-600">Nenhum funcionário atribuído</p>
                    </div>
                    @endif
                </div>

                <!-- Resumo do Status -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6 pb-3 border-b border-gray-200">
                        <i class="fas fa-info-circle text-gray-500 mr-2"></i>
                        Resumo
                    </h2>
                    
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Status Atual:</span>
                            <span class="px-3 py-1 text-sm font-semibold rounded-full 
                                bg-{{ $order->statusColor() }}-100 text-{{ $order->statusColor() }}-800">
                                {{ $order->translateStatus() }}
                            </span>
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Tipo:</span>
                            <span class="font-medium text-gray-900">{{ $order->TypeOrder->name }}</span>
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Cliente:</span>
                            <span class="font-medium text-gray-900">{{ $order->client->user->name }}</span>
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Data do Pedido:</span>
                            <span class="font-medium text-gray-900">{{ $order->order_date->format('d/m/Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection