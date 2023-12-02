@extends('layout')

@section('content')

<style>
    .list-group-item {
        background-color: #f8f9fa; 
        border-left: none;
        border-right: none;
        border-top: none;
        border-bottom: 1px solid #ddd; 
        border-radius: 0; 
    }
    .list-group-item:last-child {
        border-bottom: none; 
    }
    .list-group-item-action:hover {
        background-color: #e9ecef; 
    }
    .list-group .d-flex {
        justify-content: space-between; 
        align-items: center; 
    }
    .list-group select.form-control {
        display: block; 
        width: 100%; 
        margin-top: 0.5rem; 
        padding: 0.375rem 0.75rem; 
        font-size: 1rem; 
        line-height: 1.5;
        color: #495057; 
        background-color: #fff; 
        background-clip: padding-box;
        border: 1px solid #ced4da; 
        border-radius: 0.25rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

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
                        <i class="fa fa-user" aria-hidden="true"></i> 
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

<form method="POST" action="{{ route('docente.guardarConfiguracion', ['asignatura' => $asignatura->id, 'unidadId' => $unidadActual->id]) }}">
    @csrf
    <div class="container mt-3">
        <h2>Unidad: {{ $unidadActual->nombre }}</h2>
        <p>Objetivo: {{ $unidadActual->objetivo }}</p>
    
        <div class="row">
            <div class="col-md-6">
                <div class="list-group">
                    @foreach ($unidadActual->temas as $tema)
                        <div class="list-group-item">
                            <h5 class="mb-1">{{ $tema->nombre }}</h5>
                            <small>Semana programada</small>
                            <select name="temas[{{ $tema->id }}][calendario_id]" class="form-control mt-2">
                                <option value="" disabled selected>Selecciona Semana</option>
                                @foreach ($calendarios as $calendario)
                                    <option value="{{ $calendario->id }}" {{ (isset($configuracionesGuardadas[$tema->id]) && $configuracionesGuardadas[$tema->id]->calendario_id == $calendario->id) ? 'selected' : '' }}>
                                        {{ $calendario->nombre_completo }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endforeach
                </div>
            </div>
            
    
            {{-- Sección para evaluación de la competencia e instrumentaciones --}}
            <div class="col-md-6">
                <div class="list-group">
                <div class="list-group-item">
                    <h5 class="mb-1">Evaluación de la competencia</h5>
                    <small>Semana de evaluación</small>
                    <select name="evaluacion_competencia[calendario_id]" class="form-control mt-2">
                        <option value="" disabled selected>Selecciona Semana</option>
                        @foreach ($calendarios as $calendario)
                            <option value="{{ $calendario->id }}" {{ (isset($configuracionesGuardadas['evaluacion_competencia']) && $configuracionesGuardadas['evaluacion_competencia']->calendario_id == $calendario->id) ? 'selected' : '' }}>
                                {{ $calendario->nombre_completo }}
                            </option>
                        @endforeach
                    </select>
                </div>
                {{-- Instrumentaciones --}}
                @for ($i = 1; $i <= 3; $i++)
                    <div class="list-group-item">
                        <h5 class="mb-1">Instrumentación</h5>
                        <small>Instrumento {{ $i }}</small>
                        <select name="instrumentaciones[{{ $i }}][instrumentacion_id]" class="form-control mt-2">
                            <option value="" disabled selected>Selecciona Instrumentación</option>
                            @foreach ($instrumentaciones as $instrumentacion)
                                <option value="{{ $instrumentacion->id }}" 
                                    {{ (isset($instrumentacionGuardada[$instrumentacion->id]) && $instrumentacionGuardada[$instrumentacion->id]->instrumentacion_id == $instrumentacion->id) ? 'selected' : '' }}>
                                    {{ $instrumentacion->tipo_instrumentacion }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endfor
                </div>
            </div>
        </div>
    
        <div class="mb-3">
            @if ($unidadAnterior)
                <a href="{{ route('docente/gestionCurso', ['asignatura' => $asignatura->id, 'unidadId' => $unidadAnterior->id]) }}" class="btn btn-custom">
                    <i class="fas fa-arrow-left"></i> Unidad Anterior
                </a>
            @endif
            @if ($unidadSiguiente)
                <a href="{{ route('docente/gestionCurso', ['asignatura' => $asignatura->id, 'unidadId' => $unidadSiguiente->id]) }}" class="btn btn-custom">
                    <i class="fas fa-arrow-right"></i> Unidad Siguiente
                </a>
            @endif
            <button type="submit" class="btn btn-custom">
                <i class="fas fa-save"></i> Guardar
            </button>
        </div>
        
    
    </div>
</form>



@endsection
