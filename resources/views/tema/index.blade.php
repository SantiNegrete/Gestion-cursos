@extends('adminlte::page')

@section('title', 'Temas')

@section('content_header')
    <br>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-12 mb-2">
                    <a href="{{ route('asignaturas.index') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                        <i class="fas fa-backward"></i> {{ __(' Volver') }}
                    </a>
                </div>
            </div>
        </div>

        @if (session('success'))
            <!-- Modal para mensajes de éxito -->
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

        @foreach ($temas->groupBy('unidade.nombre') as $nombreUnidad => $temasPorUnidad)
            <div class="card mt-4">
                <div class="card-header">
                    Temas de la Unidad: {{ $nombreUnidad }}
                </div>
                <div class="card-body">
                    @if ($temasPorUnidad->isEmpty())
                        <p>No hay temas para esta unidad.</p>
                    @else
                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>Tema</th>
                                    <th>Práctica</th>
                                    <th>Semana de Impartición</th>
                                    <th>Instrumentación</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($temasPorUnidad as $tema)
                                    <tr>
                                        <td>{{ $tema->nombre }}</td>
                                        <td>{{ $tema->practica->descripcion }}</td>
                                        <td>{{ $tema->calendario->nombre_completo }}</td>
                                        <td>{{ $tema->instrumentacion->tipo_instrumentacion }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Acciones Tema">
                                                <a href="{{ route('temas.edit', $tema->id) }}" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit"></i>Editar
                                                </a>
                                                <form action="{{ route('temas.destroy', $tema->id) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este tema?');">
                                                        <i class="fas fa-trash-alt"></i>Eliminar
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
@stop

@section('css')
    <style>
        .btn-group > .btn {
            margin-right: 5px; /* Espaciado entre botones */
        }
        .btn-group > .btn:last-child {
            margin-right: 0; /* Evitar espacio extra al final */
        }
        form {
            margin-bottom: 0;
        }
    </style>
@stop

@section('js')
    <script>
        // Aquí puedes agregar cualquier script JS si es necesario
    </script>
@stop
