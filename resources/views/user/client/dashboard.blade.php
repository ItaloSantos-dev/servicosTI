@extends('layout.main')
@section('title', 'Dashboard')

@section('head')
<link rel="stylesheet" href="{{asset('css/client/dashboard.css')}}">
@endsection

@section('content')
<main class="container mt-10 mx-auto">
    <div class="container mx-auto max-w-7xl">
        <div class="bg-white/90 backdrop-blur-md rounded-2xl shadow-xl p-6 mb-6 border border-purple-200">
            <h1 class="text-3xl md:text-4xl font-bold text-black mb-2">
                Bem-vindo, {{ $clientLoged->name }} {{ $clientLoged->surname }}
            </h1>
            <p class="text-gray-600">Visualize suas informações e estatísticas</p>
        </div>

        <div class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
                <div class="bg-black/90 backdrop-blur-md rounded-2xl shadow-xl p-6 border border-purple-300">
                    <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Informações Pessoais
                    </h2>
                    <div class="space-y-3 text-white/90">
                        <div class="flex items-start">
                            <span class="font-semibold text-white mr-2 ">Nome:</span>
                            <span class="text-white/80">{{ $clientLoged->name }} {{ $clientLoged->surname }}</span>
                        </div>
                        <div class="flex items-start">
                            <span class="font-semibold text-white mr-2 ">Email:</span>
                            <span class="text-white/80 break-all">{{ $clientLoged->email }}</span>
                        </div>
                        <div class="flex items-start">
                            <span class="font-semibold text-white mr-2 ">CPF:</span>
                            <span class="text-white/80">{{ $clientLoged->cpf }}</span>
                        </div>
                        <div class="flex items-start">
                            <span class="font-semibold text-white mr-2 ">Telefone:</span>
                            <span class="text-white/80">{{ $clientLoged->telephone }}</span>
                        </div>
                        <div class="flex items-start">
                            <span class="font-semibold text-white mr-2 ">Nascimento:</span>
                            <span class="text-white/80">{{ \Carbon\Carbon::parse($clientLoged->date_birth)->format('d/m/Y') }}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white/90 backdrop-blur-md rounded-2xl shadow-xl p-6 border border-purple-200">
                    <div class="flex justify-center items-center p-2">
                        <h2 class="text-2xl font-bold text-black mb-4 flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            Estatísticas
                        </h2>

                        <div class="ml-auto">
                            <a href="{{ route('client.orders') }}" class="bg-white text-black font-bold py-3 px-6 rounded-lg hover:bg-purple-100 border-2 border-purple-300 hover:border-purple-500 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-transl ate-y-0.5" >Ver pedidos</a>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="bg-purple-100 rounded-lg p-4 border border-purple-200 cursor-pointer transition-all duration-300 hover:bg-purple-200 hover:shadow-lg hover:scale-105 hover:border-purple-400 transform">
                            <div class="text-3xl font-bold text-black transition-colors duration-300 hover:text-purple-700">{{ count($clientLoged->client->orders ?? []) }}</div>
                            <div class="text-gray-600 text-sm transition-colors duration-300 hover:text-gray-800">Total de Pedidos</div>
                        </div>
                        <div class="bg-purple-100 rounded-lg p-4 border border-purple-200 cursor-pointer transition-all duration-300 hover:bg-purple-200 hover:shadow-lg hover:scale-105 hover:border-purple-400 transform">
                            <div class="text-3xl font-bold text-black transition-colors duration-300 hover:text-purple-700">
                                {{ collect($clientLoged->client->orders ?? [])->where('status', 'in_analysis')->count() }}
                            </div>
                            <div class="text-gray-600 text-sm transition-colors duration-300 hover:text-gray-800">Em Análise</div>
                        </div>
                        <div class="bg-purple-100 rounded-lg p-4 border border-purple-200 cursor-pointer transition-all duration-300 hover:bg-purple-200 hover:shadow-lg hover:scale-105 hover:border-purple-400 transform">
                            <div class="text-3xl font-bold text-black transition-colors duration-300 hover:text-purple-700">
                                {{ collect($clientLoged->client->orders ?? [])->filter(function($order) { return $order->scheduling_date !== null; })->count() }}
                            </div>
                            <div class="text-gray-600 text-sm transition-colors duration-300 hover:text-gray-800">Agendados</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@section('scripts')
@endsection
@endsection


