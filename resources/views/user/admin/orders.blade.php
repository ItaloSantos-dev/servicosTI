@extends('layout.main')

@section('title', 'Todos os Pedidos')

@section('content')
<main class="">
    <div class="container max-w-7xl mx-auto">
        <div class="bg-white/40  rounded-3xl shadow-lg p-8 mb-8 border border-gray-200">
            <div class="flex backdrop-blur-2xl flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">
                        Todos os Pedidos
                    </h1>
                    <p class="text-gray-600">
                        Gerencie e visualize todos os pedidos do sistema
                    </p>
                </div>
                <div class="flex flex-wrap gap-4">
                    <select class="border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Todos</option>
                        <option value="pending">Agendado</option>
                        <option value="in_progress">Em análise</option>
                        <option value="completed">Concluído</option>
                        <option value="cancelled">Cancelado</option>
                    </select>

                    <a
                        href="{{route('admin.orders.create')}}"
                        class="bg-linear-to-r from-blue-600 to-indigo-600 text-white px-6 py-2 rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 font-semibold flex items-center gap-2">
                        <i class="fas fa-plus"></i>
                        Novo Pedido
                    </a>
                </div>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8">

                <div class="bg-linear-to-r from-blue-50 to-blue-100 rounded-2xl p-4 border border-blue-200 hover:border-blue-500">
                    <div class="text-sm text-blue-600 font-semibold mb-1">Total</div>
                    <div class="text-2xl font-bold text-gray-900">{{ $orders->count() }}</div>
                    <div class="text-sm text-gray-600">Pedidos</div>
                </div>

                <div class="bg-linear-to-r from-green-50 to-green-100 rounded-2xl p-4 border border-green-200 hover:border-green-500">
                    <div class="text-sm text-green-600 font-semibold mb-1">Concluídos</div>
                    <div class="text-2xl font-bold text-gray-900">
                        {{ $ordersCount['completed'] }}
                    </div>
                    <div class="text-sm text-gray-600">Pedidos</div>
                </div>

                <div class="bg-linear-to-r from-yellow-50 to-yellow-100 rounded-2xl p-4 border border-yellow-200 hover:border-yellow-500">
                    <div class="text-sm text-yellow-600 font-semibold mb-1">Em Análise</div>
                    <div class="text-2xl font-bold text-gray-900">
                        {{ $ordersCount['in_analysis']}}
                    </div>
                    <div class="text-sm text-gray-600">Pedidos</div>
                </div>

                <div class="bg-linear-to-r from-red-50 to-red-100 rounded-2xl p-4 border border-red-200 hover:border-red-500">
                    <div class="text-sm text-red-600 font-semibold mb-1">Cancelados</div>
                    <div class="text-2xl font-bold text-gray-900">
                        {{ $ordersCount['canceled']}}
                    </div>
                    <div class="text-sm text-gray-600">Pedidos</div>
                </div>
            </div>
        </div>

        <div class="rounded-3xl shadow-lg overflow-hidden border  border-gray-200 ">

            <div class="px-6 py-4 border-b border-gray-200 bg-linear-to-r from-gray-50 to-gray-100">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-gray-900">Lista de Pedidos</h2>
                    <div class="text-sm text-gray-600">
                        {{ $orders->count() }} pedidos encontrados
                    </div>
                </div>
            </div>

            <div class="hidden md:grid md:grid-cols-6 gap-4 px-6 py-3  bg-gray-50 border-b border-gray-200">
                <div class="text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</div>
                <div class="text-xs font-semibold text-gray-600 uppercase tracking-wider">Cliente</div>
                <div class="text-xs font-semibold text-gray-600 uppercase tracking-wider">Tipo de Pedido</div>
                <div class="text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</div>
                <div class="text-xs font-semibold text-gray-600 uppercase tracking-wider">Data do pedido</div>
                <div class="text-xs font-semibold text-gray-600 uppercase tracking-wider">Ações</div>
            </div>
            <div class="divide-y divide-gray-200 bg-white/50">
                @forelse($orders as $order)
                    <div class="hover:bg-gray-50 transition-colors duration-350 backdrop-blur-2xl ">
                        <div class="hidden md:grid md:grid-cols-6 gap-4 px-6 py-4 items-center">
                            <div  class="text-sm font-medium text-gray-900 font-mono hover:scale-105 transition-all">
                                #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
                            </div >

                            <div class="flex items-center">
                                <div class="shrink-0 h-10 w-10">
                                    <div class="h-10 w-10 rounded-full bg-linear-to-r from-blue-500 to-indigo-500 flex items-center justify-center">
                                        <span class="text-white font-semibold">
                                            {{ strtoupper(substr($order->client->user->name ?? '', 0, 1)) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $order->client->user->name }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $order->client->user->email }}
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="text-sm text-gray-900">
                                    {{ $order->TypeOrder->name}}
                                </div>
                            </div>
                            <div>
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                    bg-{{$order->statusColor()}}-500">
                                    {{ $order->translateStatus() }}
                                </span>
                            </div>
                            <div>
                                <div class="text-sm text-gray-900">{{($order->order_date)->format('d/m/Y') }}</div>
                                <div class="text-sm text-gray-500">{{ ($order->order_date)->format('H:i') }}</div>
                            </div>
                            <form class="flex space-x-2">
                                <a href="{{route('admin.orders.show', $order->id)}}" class="text-blue-500 hover:text-blue-900 transition-colors duration-200 cursor-pointer">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </form>
                        </div>
                    </div>
                @empty
                <div class="px-6 py-12 text-center">
                    <div class="flex flex-col items-center justify-center">
                        <i class="fas fa-clipboard-list text-gray-400 text-5xl mb-4"></i>
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Nenhum pedido encontrado</h3>
                        <p class="text-gray-500">Comece criando seu primeiro pedido</p>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
        <div class="flex justify-center items-center bg-white/40 mt-2 rounded-2xl shadow-2xl mb-5 p-2">
            <div class="backdrop-blur-2xl">
                {{ $orders->links('pagination::simple-tailwind') }}
            </div>
        </div>
    </div>
</main>
@endsection
