@extends('layout.main')

@section('title', 'DashBoard Funcionário')

@section('head')
@endsection

@section('content')
    <div class="max-w-7xl mx-auto p-8">
        <!-- Cabeçalho -->
        <div class="bg-white/90 backdrop-blur-md rounded-2xl shadow-xl p-6 mb-6 border border-purple-200">
            <h1 class="text-3xl md:text-4xl font-bold text-black mb-2">
                Seu dashboard, {{ $employeeLoged->nameCompleted() }}
            </h1>
        </div>

        <!-- Grid Principal -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <!-- Coluna 1: Informações Pessoais -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-[20px] p-6 shadow-lg border border-purple-200">
                    <h2 class="text-2xl font-semibold text-purple-700 mb-6">Informações Pessoais</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        
                        <div class="flex flex-col gap-2">
                            <span class="text-sm font-bold text-purple-600">Nome</span>
                            <div class="text-base text-gray-800 p-4 bg-purple-50 rounded-lg">{{ $employeeLoged->nameCompleted() }}</div>
                        </div>
                        
                        
                        <div class="flex flex-col gap-2">
                            <span class="text-sm font-bold text-purple-600">CPF</span>
                            <div class="text-base text-gray-800 p-4 bg-purple-50 rounded-lg">{{$employeeLoged->cpf}}</div>
                        </div>
                        
                        <div class="flex flex-col gap-2">
                            <span class="text-sm font-bold text-purple-600">Email</span>
                            <div class="text-base text-gray-800 p-4 bg-purple-50 rounded-lg">{{$employeeLoged->email}}</div>
                        </div>
                        
                        <div class="flex flex-col gap-2">
                            <span class="text-sm font-bold text-purple-600">Telefone</span>
                            <div class="text-base text-gray-800 p-4 bg-purple-50 rounded-lg">{{$employeeLoged->telephone}}</div>
                        </div>
                        
                        <div class="flex flex-col gap-2">
                            <span class="text-sm font-bold text-purple-600">Data de Nascimento</span>
                            <div class="text-base text-gray-800 p-4 bg-purple-50 rounded-lg">{{$employeeLoged->date_birth}}</div>
                        </div>
                        
                        <div class="flex flex-col gap-2">
                            <span class="text-sm font-bold text-purple-600">Credenciais</span>
                            <div class="text-base text-gray-800 p-4 bg-purple-50 rounded-lg">{{$employeeLoged->employee->credential}}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Coluna 2: Métricas -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-[20px] p-6 shadow-lg border border-purple-200 mb-6">
                    <h2 class="text-2xl font-semibold text-purple-700 ">Métricas</h2>
                    
                    <div class="space-y-6">
                        <!-- Serviços Concluídos -->
                        <div class="bg-linear-to-br from-green-50 to-green-100 rounded-[15px] p-6 ransition-all duration-300 hover:bg-purple-200 hover:shadow-lg hover:scale-105 hover:border-purple-400 transform">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-semibold text-green-600 uppercase">Serviços Concluídos</span>
                            </div>
                            <div class="text-4xl font-bold text-green-700">{{$employeeLoged->employee->ordersCompleted->count()}}</div>
                            <div class="text-xs text-green-500 mt-2">Total de serviços finalizados</div>
                        </div>
                        
                        <!-- Média de Rating -->
                        <div class="bg-linear-to-br from-yellow-50 to-yellow-100 rounded-[15px] p-6 ransition-all duration-300 hover:bg-purple-200 hover:shadow-lg hover:scale-105 hover:border-purple-400 transform">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-semibold text-yellow-600 uppercase">Média de Rating</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="text-4xl font-bold text-yellow-700">{{number_format($avgRating, 1)??0}}</div>
                                <div class="text-2xl text-yellow-500">★</div>
                            </div>
                            <div class="text-xs text-yellow-500 mt-2">Baseado em 127 avaliações</div>
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>

        <!-- Área de Serviços Agendados -->
        <div class="bg-white rounded-[20px] p-6 shadow-lg border border-purple-200">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-purple-700">Serviços Agendados</h2>
                <div>
                    <a href="{{route('employee.orders')}}" class="bg-white text-black font-bold py-3 px-6 rounded-lg hover:bg-purple-100 border-2 border-purple-300 hover:border-purple-500 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-transl ate-y-0.5" >Ver todos</a>
                </div>
                <div class="text-sm text-gray-500">
                    Total: <span class="font-semibold text-purple-600">{{$employeeLoged->employee->ordersScheduled->count()}}</span> serviços
                </div>
            </div>

            <!-- Lista de Serviços -->
            @foreach($employeeLoged->employee->ordersScheduled as $order)
                <div class="space-y-4">
                    <!-- Serviço 1 -->
                    <div class="bg-linear-to-r from-purple-50 to-purple-100/50 rounded-xl p-6 border-2 border-purple-200/60 hover:shadow-lg hover:border-purple-300 transition-all duration-300">
                        <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-5">
                            
                            <div class="flex-1 space-y-3">
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="text-xl font-bold text-purple-800 tracking-tight">Serviço #{{$order->id}}</div>
                                    <div class="px-3 py-1.5 rounded-lg text-xs font-bold uppercase bg-green-200 text-green-900 border border-green-300 shadow-sm">
                                        {{$order->TypeOrder->name}}
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
                            <button 
                                class="px-6 py-3 bg-linear-to-r from-purple-600 to-purple-700 text-white font-bold rounded-lg hover:from-purple-700 hover:to-purple-800 transition-all duration-200 whitespace-nowrap shadow-md hover:shadow-lg transform hover:scale-105"
                            >
                                Ver Detalhes
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    
@endsection

@section('scripts')
    
@endsection