@extends('adminlte::page')

@section('title', 'Unidades')

@section('content_header')
    <br>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <!-- Card Header -->
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span id="card_title">
                            {{ __('Unidades') }}
                        </span>
                        <div class="float-right">
                            <a href="{{ route('unidades.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                                {{ __('Crear Nueva') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            @if (session('success'))
                <!-- Modal -->
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

            @php
                $groupedUnidades = $unidades->groupBy('asignatura.nombre');
            @endphp

            @foreach ($groupedUnidades as $asignatura => $unidadesGroup)
                <div class="card mt-3">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span>{{ 'Asignatura: ' . $asignatura }}</span>
                            <a class="btn btn-primary btn-sm" href="{{ route('unidades.edit', $unidadesGroup[0]->id) }}">
                                <i class="fa fa-fw fa-edit"></i> {{ __('Editar Unidades') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @foreach ($unidadesGroup as $unidade)
                            <p><strong>Unidad:</strong> {{ $unidade->nombre }}</p>
                            <p><strong>Objetivo:</strong> {{ $unidade->objetivo }}</p>
                            <form action="{{ route('unidades.destroy', $unidade->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}
                                </button>
                            </form>
                            <hr>
                        @endforeach
                    </div>
                </div>
            @endforeach
            <div class="mt-3">
                {!! $unidades->links() !!}
            </div>
        </div>
    </div>
</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
