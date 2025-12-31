@extends('layout.main')
@section('title', 'register')
@section('head')
@endsection

@section('content')
    <main class="container mx-auto h-100">
        @if ($errors->any())
            <div class="container mx-auto  mt-5 p-3 w-115 absolute bg-purple-500/30 rounded-lg">
                <ul class="list-disc list-inside text-white">
                    @foreach ($errors->all() as $error)
                        <li>{{ __($error) }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session()->has('info'))
            <div class="container mx-auto  mt-5 p-3 w-115 absolute bg-purple-500/30 rounded-lg">
                <pc class="text-white bold">{{ session('info') }}</p>
            </div>
        @endif

        <div>
            <div class="container flex justify-center text-white ">
                <form method="POST" action="{{route('client.store')}}"  class="bg-white/10 w-115 shadow-2xl p-3 mb-35 rounded-2xl backdrop-blur-lg ">
                    @csrf
                    <h1 class='text-center  text-4xl font-bold'>REGISTRAR</h1>

                    <div class="container flex gap-3 p-3">
                        <div class="text-center flex-1 flex flex-col gap-1">
                            <label class="font-bold" for="name">NOME</label>
                            <input class="border shadow rounded p-2" name="name" id="name" type="text" />
                        </div>

                        <div class="text-center flex-1 flex flex-col gap-1">
                            <label class="font-bold" for="surname">SOBRENOME</label>
                            <input class="border shadow rounded p-2" type="text" name="surname" id="surname" />
                        </div>

                    </div>

                    <div class="container flex gap-3 p-3">
                        <div class="text-center flex flex-col gap-1" >
                            <label for="cpf" class="font-bold">CPF</label>
                            <input class="border shadow rounded p-2" type="text" name="cpf" id="cpf">
                        </div>

                        <div class="text-center flex flex-col gap-1" >
                            <label for="date_birth" class="font-bold">DATA DE NASCIMENTO</label>
                            <input class="border shadow rounded p-2 w-50" type="date" name="date_birth" id="date_birth">
                        </div>
                        
                    </div>

                    <div class="container">
                        <div class="text-center flex flex-col gap-3 p-3">
                            <label for="email" class='font-bold'>EMAIL</label>
                            <input type="email" name='email' id='email' class='border shadow rounded p-2' />
                        </div>
                    </div>

                    <div class="container">
                        <div class="text-center flex flex-col gap-3 p-3">
                            <label for="password" class='font-bold'>SENHA</label>
                            <div class="flex">
                                <input type="password" name='password' id='password' class='border shadow rounded p-2 flex-1' />
                                <div class=" p-1 flex justify-center">
                                    <button type="button" id="exibirSenha" onclick="ExibirSenha()" class="fa-solid fa-eye"></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="text-center flex flex-col gap-3 p-3">
                            <label for="telephone" class='font-bold'>TELEFONE</label>
                            <input name='telephone' id='telephone' class='border shadow rounded p-2 flex-1' />

                        </div>
                    </div>

                    <div class="container">
                        <div class=" justify-center items-center text-center flex-col flex gap-3 p-3">
                            <span class='p-1'>Já possui uma conta? faça <a href="" class='hover:bg-gray-50/20 hover:backdrop-blur-2xl rounded hover:shadow transition-all'>login</a> </span>
                            <button class="font-semibold rounded-4xl p-2  w-80 bg-white transition-all ease-in-out hover:scale-105 cursor-pointer text-black" type="submit">Registrar</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </main>
    @section('scripts')
        <script>
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
            const cpf = document.getElementById('cpf');
            const phone = document.getElementById('telephone');
            if (phone) {
                IMask(phone, {
                    mask: '(00) 00000-0000'
                });
            }

            if (cpf) {
                IMask(cpf, {
                    mask: '000.000.000-00'
                });
            }
        </script>
    @endsection
@endsection