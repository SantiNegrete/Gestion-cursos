@extends('adminlte::page')

@section('title', 'Crear Nueva Unidad')

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
                    <span class="card-title">Crear Nueva Unidad</span>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('unidades.store') }}"  role="form" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            {{ Form::label('asignatura', 'Asignatura') }}
                            {{ Form::text('asignatura', $asignatura->nombre ?? '', ['class' => 'form-control', 'readonly' => 'readonly']) }}
                            {{ Form::hidden('asignatura_id', $asignatura->id ?? '') }}
                        </div>

                        <div id="unidades">
                            <div class="unidad mb-4 border p-3" id="unidad-1">
                                <div class="form-group">
                                    {{ Form::label('nombre[]', ' Unidad', ['class' => 'control-label']) }}
                                    {{ Form::text('nombre[]', null, ['class' => 'form-control', 'placeholder' => 'Unidad']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('objetivo[]', 'Objetivo', ['class' => 'control-label']) }}
                                    {{ Form::text('objetivo[]', null, ['class' => 'form-control', 'placeholder' => 'Objetivo']) }}
                                </div>
                            </div>
                        </div>

                        <button type="button" id="btnAgregarUnidad" class="btn btn-secondary mt-2">Agregar Unidad</button>

                        <div class="box-footer mt-3">
                            <div class="d-flex justify-content-end">
                                <a class="btn btn-danger mr-2" href="{{ route('asignaturas.index') }}"><i class="fa fa-fw fa-ban"></i> Cancelar</a>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-save"></i> Guardar</button>
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('btnAgregarUnidad').addEventListener('click', agregarUnidad);
    });

    function agregarUnidad() {
        const contenedor = document.getElementById('unidades');
        const indice = contenedor.children.length;
        const unidadDiv = document.createElement('div');
        unidadDiv.className = 'unidad mb-4 border p-3';
        unidadDiv.id = 'unidad-' + (indice + 1);
        unidadDiv.appendChild(crearCampo('nombre[]', 'Unidad ' + (indice + 1), 'text'));
        unidadDiv.appendChild(crearCampo('objetivo[]', 'Objetivo', 'text'));
        contenedor.appendChild(unidadDiv);
    }

    function crearCampo(name, label, type) {
        const div = document.createElement('div');
        div.className = 'form-group';
        const lbl = document.createElement('label');
        lbl.textContent = label;
        div.appendChild(lbl);
        const campo = document.createElement('input');
        campo.type = type;
        campo.name = name;
        campo.className = 'form-control';
        div.appendChild(campo);
        return div;
    }
</script>
@stop
