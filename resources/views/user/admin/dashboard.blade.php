@extends('layout.main')

@section('title', 'Dashboard')

@section('head')

@endsection

@section('content')
<main class="min-h-screen bg-linear-to-br  py-8 px-4">

    <div class="max-w-7xl mx-auto">
        <div class="bg-linear-to-r from-purple-600 to-indigo-600 rounded-3xl shadow-xl p-8 mb-8 relative overflow-hidden">
            <div class="absolute inset-0 bg-black opacity-10"></div>
            <div class="relative z-10">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-3">
                    Olá, {{ Auth()->user()->name }} 👋
                </h1>
            </div>
        </div>
        <div class="gri grid-cols-1 mb-6">
            <div class="stat-card bg-white rounded-2xl shadow-soft p-6 hover-glow flex flex-col justify-between text-center">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <div class="bg-linear-to-r from-pink-500 to-rose-500 p-3 rounded-xl mr-4">
                            <i class="fa-regular fa-calendar text-white text-2xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800">Agendamentos<br><span class="text-sm text-gray-600">Este mês</span></h2>
                    </div>
                    <span class="bg-linear-to-r from-pink-100 to-rose-100 text-pink-600 px-3 py-1 rounded-full text-sm font-semibold">
                        {{ $ordersCurrentMonth->count() }} total
                    </span>
                </div>

                <div class="space-y-3 max-h-80 overflow-y-auto pr-2 custom-scrollbar">
                    @forelse($ordersCurrentMonth as $order)
                    <a  class="block">
                        <div class="order-card bg-linear-to-r from-gray-50 to-white rounded-xl p-4 border border-gray-200 hover:border-purple-300">
                            <div class="flex items-center justify-between">

                                <div>
                                    <div class="flex items-center mb-1">
                                        <div class="w-2 h-2 bg-purple-500 rounded-full mr-2"></div>
                                        <span class="font-bold text-gray-800">
                                            {{ $order->DateDayAndMonth($order->scheduling_date)}}
                                        </span>
                                        <span class="mx-2 text-gray-400">•</span>
                                        <span class="text-gray-600">
                                            {{ $order->DateHour($order->scheduling_date)}}
                                        </span>
                                    </div>
                                    <div class="text-gray-600 text-sm truncate">
                                        Cliente: {{$order->client->user->name}}
                                    </div>
                                </div>

                                <a href="{{route('admin.orders.show', $order->id)}}" class="bg-white text-black font-bold py-3 px-6 rounded-lg hover:bg-purple-100 border-2 border-purple-300 hover:border-purple-500 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-transl ate-y-0.5">
                                    Ver mais
                                </a>

                            </div>
                        </div>
                    </a>
                    @empty
                    <div class="text-center py-8 text-gray-500">
                        <svg class="w-12 h-12 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <p class="mt-2">Nenhum agendamento este mês</p>
                    </div>
                    @endforelse
                </div>
                <div class="flex justify-between items-center text-center mt-2"><a href="{{route('admin.orders.filter', 'scheduled')}}" class="text-center p-2 bg-purple-600 text-white font-semibold rounded-lg hover:bg-purple-700 transition-colors cursor-pointer hover:shadow-2xl ">Ver todos agendados</a></div>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="stat-card glass-effect rounded-2xl shadow-soft p-6 hover-glow relative overflow-hidden">
                <div class="absolute inset-0 bg-white/10 backdrop-blur-2xl"></div>

                <div class="relative z-10">
                    <div class="flex items-center mb-6">
                        <div class="bg-linear-to-r from-purple-500/40 to-indigo-500/40 p-3 rounded-xl mr-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-7a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0z">
                                </path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800">Usuários Ativos</h2>
                    </div>

                    <div class="space-y-4">

                        <a href="" class="flex items-center justify-between p-4  bg-white/50 rounded-xl   border border-purple-200 cursor-pointer transition-all duration-300 hover:bg-purple-200 hover:shadow-lg hover:scale-105 hover:border-purple-400 transform">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-blue-500 rounded-full mr-3"></div>
                                <span class="text-gray-700 font-medium">Clientes</span>
                            </div>
                            <span class="text-2xl font-bold text-gray-800">{{ $clients->count() }}</span>
                        </a>

                        <a href="" class="flex items-center justify-between p-4 bg-white/50 rounded-xl border border-purple-200 cursor-pointer transition-all duration-300 hover:bg-purple-200 hover:shadow-lg hover:scale-105 hover:border-purple-400 transform">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-green-500 rounded-full mr-3"></div>
                                <span class="text-gray-700 font-medium">Funcionários</span>
                            </div>
                            <span class="text-2xl font-bold text-gray-800">{{ $employee->count() }}</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-linear-to-r from-purple-500 to-indigo-600 rounded-2xl p-6 text-white">
                <div class="flex justify-between">
                    <h3 class="text-xl font-bold mb-3">Ações Rápidas</h3>
                    <a class="text-xl font-bold" href="">MAIS</a>
                </div>

                <div class="space-y-3">

                    <a href="{{route('admin.orders.create')}}" class="cursor-pointer w-full bg-white/20 hover:bg-white/30 rounded-lg p-3 text-left transition-colors flex items-center ">
                        <i class="fa-solid fa-plus w-5 mr-3"></i>
                        Novo pedido
                    </a>


                    <a class="cursor-pointer w-full bg-white/20 hover:bg-white/30 rounded-lg p-3 text-left transition-colors flex items-center">
                        <i class="fa-solid fa-user-tie w-5 mr-3"></i>
                        Adicionar funcionário
                    </a>

                    <a href="{{route('admin.orderTypes')}}" class="cursor-pointer w-full bg-white/20 hover:bg-white/30 rounded-lg p-3 text-left transition-colors flex items-center ">
                        <i class="fa-solid fa-cog w-5 mr-3"></i>
                        Gerenciar tipos de serviços
                    </a>

                    <a href="{{route('admin.discountCupons')}}" class="cursor-pointer w-full bg-white/20 hover:bg-white/30 rounded-lg p-3 text-left transition-colors flex items-center ">
                        <i class="fa-solid fa-ticket w-5 mr-3"></i>
                        Gerenciar cupons
                    </a>

                </div>
            </div>
        </div>
        <div class="bg-white rounded-3xl shadow-soft p-6 mb-8">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">Métricas do Sistema</h2>
                    <p class="text-gray-600 mt-1">Visão geral do desempenho</p>
                </div>
                <div class="bg-linear-to-r from-purple-50 to-indigo-50 px-4 py-2 rounded-full">
                    <a href="/dashboard" class="text-2xl font-semibold text-purple-600">↻</a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <a class="stat-card bg-linear-to-b from-green-50 to-emerald-50 rounded-2xl p-6 border border-green-100 hover:border-green-200">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <div class="text-sm font-semibold text-green-600 uppercase tracking-wider mb-1">Concluídos</div>
                            <div class="text-4xl font-bold text-gray-800">{{ $ordersCount['completed']}}</div>
                        </div>
                        <div class="bg-linear-to-r from-green-500 to-emerald-500 p-3 rounded-xl">
                            <i class="fa-solid fa-circle-check text-white text-2xl"></i>
                        </div>
                    </div>
                </a>

                <a class="stat-card bg-linear-to-br from-blue-50 to-cyan-50 rounded-2xl p-6 border border-blue-100 hover:border-blue-200">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <div class="text-sm font-semibold text-blue-600 uppercase tracking-wider mb-1">Agendados</div>
                            <div class="text-4xl font-bold text-gray-800">{{ $ordersCount['scheduled'] ?? 0 }}</div>
                        </div>
                        <div class="bg-linear-to-r from-blue-500 to-cyan-500 p-3 rounded-xl">
                            <i class="fa-solid fa-calendar-check text-white text-2xl"></i>
                        </div>
                    </div>
                </a>

                <a class="stat-card bg-linear-to-br from-red-50 to-rose-50 rounded-2xl p-6 border border-red-100 hover:border-red-200">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <div class="text-sm font-semibold text-red-600 uppercase tracking-wider mb-1">Cancelados</div>
                            <div class="text-4xl font-bold text-gray-800">{{ $ordersCount['canceled'] ?? 0 }}</div>
                        </div>
                        <div class="bg-linear-to-r from-red-500 to-rose-500 p-3 rounded-xl">
                            <i class="fa-solid fa-circle-xmark text-white text-2xl"></i>
                        </div>
                    </div>
                </a>

                <a class="stat-card bg-linear-to-br from-yellow-50 to-amber-50 rounded-2xl p-6 border border-yellow-100 hover:border-yellow-200">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <div class="text-sm font-semibold text-yellow-600 uppercase tracking-wider mb-1">Em Análise</div>
                            <div class="text-4xl font-bold text-gray-800">{{ $ordersCount['in_analysis'] ?? 0 }}</div>
                        </div>
                        <div class="bg-linear-to-r from-yellow-500 to-amber-500 p-3 rounded-xl">
                            <i class="fa-solid fa-clock text-white text-2xl"></i>
                        </div>
                    </div>
                </a>

                <div class="stat-card bg-linear-to-br from-purple-50 to-violet-50 rounded-2xl p-6 border border-purple-100 hover:border-purple-200">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <div class="text-sm font-semibold text-purple-600 uppercase tracking-wider mb-1">Avaliação Média</div>
                            <div class="text-4xl font-bold text-gray-800">{{ number_format($avgRating ?? 0, 1) }}</div>
                        </div>
                        <div class="bg-linear-to-r from-purple-500 to-violet-500 p-3 rounded-xl">
                            <i class="fa-solid fa-star text-white text-2xl"></i>
                        </div>
                    </div>
                </div>

                <a href="{{route('admin.orders')}}" class="stat-card bg-linear-to-br from-gray-50 to-slate-50 rounded-2xl p-6 border border-gray-100 hover:border-gray-200">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <div class="text-sm font-semibold text-gray-600 uppercase tracking-wider mb-1">Total de Serviços</div>
                            <div class="text-4xl font-bold text-gray-800">
                                {{ $orders->count()}}
                            </div>
                        </div>
                        <div class="bg-linear-to-r from-gray-500 to-slate-600 p-3 rounded-xl">
                            <i class="fa-solid fa-layer-group text-white text-2xl"></i>
                        </div>
                    </div>
                    <div class="text-sm text-gray-600">
                        <span class="font-medium">Todos os registros do sistema</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</main>
@endsection

@section('scripts')

@endsection
