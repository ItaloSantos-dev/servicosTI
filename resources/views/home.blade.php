@extends('layout.main')
@section('title', 'Home')
@section('head')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection
@section('content')
<main class="container mx-auto mt-25">
    <div class="flex gap-150">
        <div class='text-gray-200 w-115'>
            <h1 class='font-bold text-6xl' >SERVIÇOS</h1>
            <h3 class=' font-medium text-4xl'>TI</h3>
            <br />
            <div>
                <p class="text-justify">Oferecemos serviços completos de tecnologia para garantir segurança, desempenho e eficiência nos seus sistemas. Atuamos com suporte técnico, desenvolvimento de soluções sob medida, manutenção de sistemas e consultoria em TI.</p>
            </div>
            <button id='btnMais' class='rounded-4xl p-2 cursor-pointer mt-10 hover:scale-105 transition-all ease-in-out'>MAIS...</button>
        </div>
        <div class=''>
            <img id='vetorNote' class='hover:scale-104 transition-all cursor-pointer' src="{{asset('/images/home/notevetor.png')}}" alt="vetornotebook" />
        </div>
    </div>

    <div class='container flex  mx-auto w-100 justify-center '>
        <div class='flex gap-x-15 text-gray-200 text-2xl'>
            <a href="/register" class='cursor-pointer hover:bg-linear-to-t from-purple-600 to-blue-700 p-3  transition-all hover:scale-105 hover:shadow-lg hover:backdrop-blur-2xl hover:rounded-2xl btnBottom'>Cadastrar-se</a>

            <a href="" class='cursor-pointer hover:bg-linear-to-t from-purple-600/50 to-blue-700 p-2 transition-all hover:scale-105 hover:shadow-lg hover:backdrop-blur-2xl hover:rounded-2xl btnBottom'>Login</a>
        </div>
    </div>

    
</main>
@endsection