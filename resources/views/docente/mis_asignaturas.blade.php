@extends('layout')

@section('title', 'Mis Asignaturas')

@section('content')

<style>
    .navbar-custom {
        background-color: #800000; 
    }
    .btn-custom {
        background-color: #f5deb3; 
        color: #800000; 
        border: none;
    }
    .btn-custom:hover {
        background-color: #deb887; 
        color: #fff;
    }
    .card-custom {
        border: 1px solid #ddd;
        border-radius: 0.5rem;
        transition: box-shadow 0.3s ease-in-out, transform 0.3s ease-in-out;
        background-color: #fff;
    }
    .card-custom:hover {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        transform: translateY(-5px);
    }
    .card-body-custom {
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between; 
        height: 100%;
    }
    .card-title-custom {
        font-size: 1.25rem;
        margin-bottom: 0.5rem;
    }
    .card-link-custom {
        font-weight: bold;
        color: #f5deb3; 
    }
    .btn-primary {
        background-color: #007bff; 
        border: none; 
    }

    
    .card-deck .card {
        display: flex;
        flex-direction: column;
        margin-right: 15px; 
        margin-bottom: 30px; 
    }

    .card-body {
        flex: 1; 
        display: flex;
        flex-direction: column;
        justify-content: space-between; 
    }

        .welcome-card {
        background-color: #f4f6f9;
        border: 1px solid #ddd;
        border-radius: 0.5rem;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px; 
        padding: 1.5rem;
    }
    .welcome-message {
        font-size: 1.5rem; 
        font-weight: bold; 
        color: #333; 
        text-align: center; 
    }

    .card-custom {
    display: flex; /* Habilita Flexbox */
    flex-direction: column; /* Ordena los elementos en columna */
    height: 100%; /* Asegura que el card tenga una altura completa */
}

.card-img-top {
    width: 100%; /* La imagen ocupa el ancho completo */
    /* Altura de la imagen ajustada según tus necesidades */
}

.card-body-custom {
    flex: 1; /* Ocupa todo el espacio restante en el card */
    display: flex;
    flex-direction: column;
    justify-content: space-between; /* Distribuye el espacio verticalmente */
}




</style>

<nav class="navbar navbar-expand-md navbar-dark navbar-custom shadow-sm">
    <div class="container">
        <a class="navbar-brand text-white" href="{{ route('docente.mis_asignaturas') }}">
            <strong>Inicio</strong>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-user" aria-hidden="true"></i> <!-- Ícono de usuario -->
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Cerrar sesión') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <!-- Tarjeta de Bienvenida -->
    <div class="welcome-card">
        <h1 class="welcome-message">Bienvenid@ {{ Auth::user()->name }}, estos son los cursos que se le han asignado.</h1>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4"> 
        @forelse ($asignaciones as $asignacione)
        <div class="col">
            <div class="card h-100 card-custom">
                <!-- Aquí se añade la imagen del curso -->
                <img src="{{ asset('img/Gestion.png') }}" class="card-img-top" alt="Imagen de la Asignatura">
    
                <div class="card-body card-body-custom">
                    <h5 class="card-title card-title-custom">{{ $asignacione->asignatura->nombre ?? 'Asignatura no disponible' }}</h5>
                    <a href="{{ route('docente/gestionCurso', $asignacione->asignatura->id) }}" class="btn btn-custom mt-auto"> 
                        <i class="fas fa-tools"></i> Gestión
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="col">
            <p class="text-center text-white">No hay cursos asignados.</p>
        </div>
    @endforelse
    
    </div>
</div>

@endsection
