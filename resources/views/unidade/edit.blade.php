@extends('adminlte::page')

@section('title', 'Actualizar Unidad')

@section('content_header')
    <h1></h1>
@stop

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">

            @includeif('partials.errors')

            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title">Actualizar Unidad</span>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('unidades.update', $unidade->id) }}"  role="form" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            {{ Form::label('asignatura', 'Asignatura') }}
                            {{ Form::text('asignatura', $unidade->asignatura->nombre, ['class' => 'form-control', 'readonly' => 'readonly']) }}
                            {{ Form::hidden('asignatura_id', $unidade->asignatura->id) }}
                        </div>

                        <div class="unidad mb-4 border p-3">
                            <div class="form-group">
                                {{ Form::label('nombre', 'Unidad', ['class' => 'control-label']) }}
                                {{ Form::text('nombre', $unidade->nombre, ['class' => 'form-control', 'placeholder' => 'Nombre de la Unidad']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('objetivo', 'Objetivo', ['class' => 'control-label']) }}
                                {{ Form::text('objetivo', $unidade->objetivo, ['class' => 'form-control', 'placeholder' => 'Objetivo']) }}
                            </div>
                        </div>

                        <div class="box-footer mt-3">
                            <div class="d-flex justify-content-end">
                                <a class="btn btn-danger mr-2" href="{{ route('asignaturas.index') }}"><i class="fa fa-fw fa-ban"></i> Cancelar</a>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-save"></i> Actualizar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
