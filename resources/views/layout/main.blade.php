<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title')</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">
        @yield('head')
    </head>
    <body>
        <header class="container mx-auto mt-3 flex ">
            <div>
                <a href="/"><img src="{{asset('images/logo.png')}}" alt=""></a>
            </div>

            <nav class='ml-auto justify-center items-center flex text-gray-50 text-bold'>
                <ul class='flex gap-10'>
                    <li class='hover:backdrop-blur hover:bg-white/8 hover:shadow transition-all ease-in-out duration-100 p-2 rounded cursor-pointer'><a href="/">HOME</a></li>
                    <li class='hover:backdrop-blur hover:bg-white/8 hover:shadow transition-all ease-in-out duration-100 p-2 rounded cursor-pointer'>SERVIÇOS</li>
                    <li class='hover:backdrop-blur hover:bg-white/8 hover:shadow transition-all ease-in-out duration-100 p-2 rounded cursor-pointer'>CONTATOS</li>
                    <li class='hover:backdrop-blur hover:bg-white/8 hover:shadow transition-all ease-in-out duration-100 p-2 rounded cursor-pointer'>SOBRE</li>
                </ul>
            </nav>
        </header>
        @yield('content')
        <footer></footer>
    </body>
</html>