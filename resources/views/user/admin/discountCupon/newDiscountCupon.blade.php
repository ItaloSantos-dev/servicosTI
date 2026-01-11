@extends('layout.main')

@section('title', 'Criar Pedido')


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
            <div class="bg-white/40  rounded-3xl shadow-lg p-8 mb-8 border border-gray-200">
                <div class="flex backdrop-blur-2xl flex-col md:flex-row md:items-center justify-between gap-6">
                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">
                            Criar novo cupom de desconto
                        </h1>
                        <p class="text-gray-600">
                            Preencha os campos abaixo
                        </p>
                    </div>
                </div>
            </div>
            <form  action="{{route('admin.discountCupons.store')}}" method="POST">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2 space-y-8">
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                            <h2 class="text-xl font-semibold text-gray-900 mb-6 pb-3 border-b border-gray-200">
                                <i class="fas fa-align-left text-green-500 mr-2"></i>
                                Detalhes
                            </h2>

                            <div class="mb-6">
                                <label for="slug" class="block text-sm font-semibold text-gray-700 mb-2">
                                    slug
                                </label>
                                <input name="slug" id="slug" type="text" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none">

                            </div>

                            <div class="grid grid-cols-2 gap-5 ">
                                <div>
                                    <label for="amount" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Valor do desconto (inteiro)
                                    </label>
                                    <input name="amount" id="amount" type="number" step="1"
                                           class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none">
                                </div>

                                <div>
                                    <label for="minimum_amount" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Valor mínimo de compra
                                    </label>
                                    <input autocomplete="new-password" name="minimum_amount" id="amount" type="number" step="1"
                                           class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-8">

                        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                            <h2 class="text-xl font-semibold text-gray-900 mb-6 pb-3 border-b border-gray-200">
                                <i class="fas fa-cogs text-gray-500 mr-2"></i>
                                Ações
                            </h2>

                            <div class="space-y-4">
                                <button
                                    onclick="showOrderDetails('order-overlay')"
                                    id="btnSalvarPedido"
                                    type="button"
                                    class="cursor-pointer w-full bg-linear-to-r from-green-500 to-emerald-600 text-white px-6 py-3.5 rounded-xl hover:from-green-600 hover:to-emerald-700 transition-all duration-200 font-semibold flex items-center justify-center gap-2">
                                    <i class="fas fa-save"></i>
                                    Salvar cupom
                                </button>
                            </div>
                        </div>
                        <div id="order-overlay" class="fixed hidden inset-0 bg-black/50 bg-opacity-60 backdrop-blur-md z-50  items-center justify-center p-4">
                            <div class="bg-white rounded-[20px] p-8 shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
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
            function  ExibirListaFuncionarios(btn, div) {
                const  btnIExibir = document.getElementById(btn);
                if(btnIExibir.classList.contains('fa-arrow-down')){
                    document.getElementById(div).classList.replace('max-h-7', 'max-h-50')
                    btnIExibir.classList.replace('fa-arrow-down', 'fa-arrow-up');

                }
                else{
                    document.getElementById(div).classList.replace('max-h-50', 'max-h-7')
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

        </script>
    @endsection
@endsection
