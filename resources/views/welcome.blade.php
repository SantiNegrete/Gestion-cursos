<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestión de Cursos - TecNM-Instituto Tecnológico de Morelia</title>
    
    @vite(['resources/css/styles.css', 'resources/js/script.js'])

  
</head>
<body class="antialiased bg-red-500">
    <header class="text-white text-center p-4">
        <h1 class="text-4xl font-semibold">¡Bienvenido a la Gestión de Cursos!</h1>
        <p class="text-xl mt-4">TecNM - Instituto Tecnológico de Morelia</p>
        @if (Route::has('login'))
    <div class="fixed top-0 right-0 p-6 text-right z-10">
        @auth
        <a href="{{ url('/dash') }}" class="font-semibold text-gray-200 hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
        @else
        <a href="{{ route('login') }}" class="font-semibold text-gray-200 hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Iniciar Sesión</a>

        @endauth
    </div>
    @endif
    </header>
    <img src="img/TecNM_Morelia.png" alt="TecNM" id="fondo-imagen">
    <div class="img">
        <img src="img/Logo_ITM.png" alt="LogoITM" >
    </div>
</body>
</html>