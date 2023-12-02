@extends('adminlte::page')

@section('title', 'Asignaturas')

@section('content_header')
    <br>
@stop

@section('content')
<div class="container-fluid">
    @if (session('success'))
        <div class="modal fade" id="customSuccessModal" tabindex="-1" aria-labelledby="customSuccessModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title" id="customSuccessModalLabel">Mensaje de éxito</h5>
                    </div>
                    <div class="modal-body">
                        {{ session('success') }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var myModal = new bootstrap.Modal(document.getElementById('customSuccessModal'), {});
                myModal.show();
            });
        </script>
    @endif

    <!-- Botón para crear nueva asignatura -->
    <div class="row">
        <div class="col-12 mb-2">
            <a href="{{ route('asignaturas.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                {{ __('Crear Nueva') }}
            </a>
        </div>
    </div>

    <!-- Loop de asignaturas -->
    @foreach ($asignaturas as $asignatura)
        <div class="card">
            <div class="card-header">
                <h5>{{ $asignatura->nombre }}</h5>
            </div>
            <div class="card-body">
                <p><strong>Objetivo:</strong> {{ $asignatura->objetivo }}</p>
                <button onclick="toggleInfo({{ $asignatura->id }})" class="btn btn-secondary btn-sm">
                    Mostrar Más
                </button>
                <div id="infoAdicional{{ $asignatura->id }}" style="display: none;">
                    <ul class="asignatura-list">
                        <li><strong>Competencia General:</strong> {!! preg_replace('/(\d+\.-)/', '<br>$1', e($asignatura->competencia_general)) !!}</li>
                        <li><strong>Competencia Específica:</strong> {!! preg_replace('/(\d+\.-)/', '<br>$1', e($asignatura->competencia_especifica)) !!}</li>
                        <li><strong>Fuentes Información:</strong> {!! preg_replace('/(\d+\.-)/', '<br>$1', e($asignatura->fuentes_informacion)) !!}</li>
                    </ul>
                </div>
                <div class="action-buttons">
                    <a class="btn btn-primary btn-sm" href="{{ route('asignaturas.edit', $asignatura->id) }}">
                        {{ __('Editar') }}
                    </a>
                    <form action="{{ route('asignaturas.destroy', $asignatura->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            {{ __('Eliminar') }}
                        </button>
                    </form>
                    <button class="btn btn-secondary btn-sm" type="button" data-toggle="collapse" data-target="#collapseUnidades{{ $asignatura->id }}" aria-expanded="false" aria-controls="collapseUnidades{{ $asignatura->id }}">
                        Ver / Añadir Unidades
                    </button>
                </div>
                <div class="collapse" id="collapseUnidades{{ $asignatura->id }}">
                    <strong>{{ __('Unidades:') }}</strong>
                    @foreach ($asignatura->unidades as $unidad)
                        <div class="card mt-2">
                            <div class="card-header">
                                <span class="font-weight-bold">{{ $unidad->nombre }}</span>
                                <!-- Botones para editar y eliminar unidad -->
                                <div class="float-right">
                                    <a href="{{ route('unidades.edit', $unidad->id) }}" class="btn btn-primary btn-sm mr-2">
                                        Editar Unidad
                                    </a>
                                    <form action="{{ route('unidades.destroy', $unidad->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de que desea eliminar esta unidad?');">
                                            Eliminar Unidad
                                        </button>
                                    </form>
                                </div>
                                <button onclick="toggleObjetivo({{ $unidad->id }})" class="btn btn-sm float-right">
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                            </div>
                            <div class="card-body" id="objetivoUnidad{{ $unidad->id }}" style="display: none;">
                                <strong>{{ __('Objetivo:') }}</strong>
                                <p>{{ $unidad->objetivo }}</p>
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('temas.create', ['id_unidad' => $unidad->id]) }}" class="btn btn-outline-success btn-sm mr-2">
                                        Añadir Tema
                                    </a>
                                    <a href="{{ route('temas.indexPorUnidad', ['unidadId' => $unidad->id]) }}">Ver Temas</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <a href="{{ route('unidades.create', ['asignatura_id' => $asignatura->id]) }}" class="btn btn-primary btn-sm mt-2">
                        Crear Unidad
                    </a>
                </div>
            </div>
        </div>
        <br>
    @endforeach
</div>
{!! $asignaturas->links() !!}
@stop

@section('css')
    <style>
        .asignatura-list {
            list-style: none;
            padding: 0;
            text-align: justify;
        }
        
        .asignatura-list li {
            margin-bottom: 10px;
        }
        
        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
    </style>
@stop

@section('js')
    <script>
        function toggleInfo(asignaturaId) {
            var infoDiv = document.getElementById("infoAdicional" + asignaturaId);
            var button = event.currentTarget;
            
            if (infoDiv.style.display === "none") {
                infoDiv.style.display = "block";
                button.textContent = "Mostrar Menos";
            } else {
                infoDiv.style.display = "none";
                button.textContent = "Mostrar Más";
            }
        }

        function toggleObjetivo(unidadId) {
            var objetivoDiv = document.getElementById("objetivoUnidad" + unidadId);
            var button = event.currentTarget;
            
            if (objetivoDiv.style.display === "none") {
                objetivoDiv.style.display = "block";
                button.innerHTML = '<i class="fas fa-chevron-up"></i>';
            } else {
                objetivoDiv.style.display = "none";
                button.innerHTML = '<i class="fas fa-chevron-down"></i>';
            }
        }
    </script>
@stop
