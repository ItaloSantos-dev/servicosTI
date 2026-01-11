@extends('layout.main')

@section('title', 'Todos os tipos de pedidos')

@section('content')
    <main class="">
        <div class="container max-w-7xl mx-auto">
            <div class="bg-white/40  rounded-3xl shadow-lg p-8 mb-8 border border-gray-200">
                <div class="flex backdrop-blur-2xl flex-col md:flex-row md:items-center justify-between gap-6">
                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">
                            Todos os Tipos de pedidos
                        </h1>
                        <p class="text-gray-600">
                            Gerencie e visualize os tipos de pedidos disponíveis no sistema
                        </p>
                    </div>
                    <div class="flex flex-wrap gap-4">
                        <a
                            href="{{route('admin.orderTypes.create')}}"
                            class="bg-linear-to-r from-blue-600 to-indigo-600 text-white px-6 py-2 rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 font-semibold flex items-center gap-2">
                            <i class="fas fa-plus"></i>
                            Novo tipo de pedido
                        </a>
                    </div>
                </div>
            </div>

            <div class="rounded-3xl shadow-lg overflow-hidden border  border-gray-200 mb-3">
                <div class="px-6 py-4 border-b border-gray-200 bg-linear-to-r from-gray-50 to-gray-100">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-semibold text-gray-900">Lista de Pedidos</h2>
                        <div class="text-sm text-gray-600">
                            {{ $orderTypes->count() }} pedidos encontrados
                        </div>
                    </div>
                </div>

                <div class="hidden md:grid md:grid-cols-5 gap-15 px-6 py-3  bg-gray-50 border-b border-gray-200">
                    <div class="text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</div>
                    <div class="text-xs font-semibold text-gray-600 ml-4 uppercase tracking-wider">Nome</div>
                    <div class="text-xs font-semibold text-gray-600 uppercase tracking-wider">Preço</div>
                    <div class="text-xs font-semibold text-gray-600 uppercase tracking-wider">Ativo</div>

                </div>

                <div class="divide-y divide-gray-200 bg-white/50 ">
                    @forelse($orderTypes as $orderType)
                        <div class="hover:bg-gray-50 transition-colors duration-350 backdrop-blur-2xl ">

                            <div class="hidden md:grid md:grid-cols-5 gap-8 px-6 py-4 items-center">
                                <div  class="text-sm font-medium text-gray-900 font-mono hover:scale-105 transition-all">
                                    #{{ str_pad($orderType->id, 5, '0', STR_PAD_LEFT) }}
                                </div >

                                <div class="flex items-center">

                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-center text-gray-900">
                                            {{ $orderType->name }}
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="text-sm ml-5 text-gray-900">
                                        {{ $orderType->amount}}
                                    </div>
                                </div>

                                <div>
                                    <div class="text-sm ml-5 text-gray-900">
                                        <p>{{$orderType->active?'SIM':'NÃO'}}</p>
                                    </div>
                                </div>

                                <div class="flex space-x-2">
                                    <a href="{{route('admin.orderTypes.edit', $orderType->id)}}" class="  text-yellow-500 hover:text-yellow-900 transition-colors duration-200 cursor-pointer">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>

                            </div>
                        </div>
                    @empty
                        <div class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fas fa-clipboard-list text-gray-400 text-5xl mb-4"></i>
                                <h3 class="text-lg font-semibold text-gray-700 mb-2">Nenhum tipo de pedido encontrado</h3>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>


            @if($orderTypes->hasPages())
                <div class="flex justify-center items-center bg-white/40 mt-2 rounded-2xl shadow-2xl mb-5 p-2">
                    <div class="backdrop-blur-2xl">
                        {{ $orderTypes->links('pagination::simple-tailwind') }}
                    </div>
                </div>
            @endif
        </div>
    </main>
@endsection
@section('scripts')
<script>

</script>
@endsection
