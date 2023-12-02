@extends('adminlte::page')

@section('title', 'Editar Tema')

@section('content_header')
    <br>
@stop

@section('content')
<section class="content container-fluid">
    <div class="">
        <div class="col-md-12">

            @includeif('partials.errors')

            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title">Actualizar Tema</span>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('temas.update', $tema->id) }}"  role="form" enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        @csrf
                        
                        <div class="box box-info padding-1">
                            <div class="box-body">
                                <!-- Campo de Unidad -->
                                <div class="form-group">
                                    {{ Form::label('unidad', 'Unidad') }}
                                    {{ Form::text('unidad', $unidad->nombre, ['class' => 'form-control', 'readonly' => 'readonly']) }}
                                    {{ Form::hidden('id_unidad', $unidad->id) }}
                                </div>
                        
                                <!-- Campos para el Tema -->
                                <div class="form-group">
                                    {{ Form::label('nombre', 'Tema') }}
                                    {{ Form::text('nombre', $tema->nombre, ['class' => 'form-control', 'placeholder' => 'Tema']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('practica_id', 'Práctica:') }}
                                    {{ Form::select('practica_id', ['' => '--Seleccione Práctica--'] + $practica->toArray(), $tema->practica_id, ['class' => 'form-control']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('calendario_id', 'Semana de impartición:') }}
                                    {{ Form::select('calendario_id', ['' => '--Seleccione Semana de impartición--'] + $calendario->toArray(), $tema->calendario_id, ['class' => 'form-control']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('instrumentacion_id', 'Instrumentación:') }}
                                    {{ Form::select('instrumentacion_id', ['' => '--Seleccione Instrumentación--'] + $instrumentacion->toArray(), $tema->instrumentacion_id, ['class' => 'form-control']) }}
                                </div>
                        
                                <!-- Botones de Acción -->
                                <div class="box-footer mt-3">
                                    <div class="d-flex justify-content-end">
                                        <a class="btn btn-danger mr-2" href="{{ route('temas.indexPorUnidad', ['unidadId' => $unidad->id]) }}">
                                            <i class="fa fa-fw fa-ban"></i> Cancelar
                                        </a>
                                        
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-fw fa-save"></i> Actualizar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@stop
