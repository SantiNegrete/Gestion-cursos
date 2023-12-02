@extends('adminlte::page')

@section('title', 'Crear Tema')

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
                    <span class="card-title">Crear Nuevo Tema</span>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('temas.store') }}" role="form" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            {{ Form::label('unidad', 'Unidad') }}
                            {{ Form::text('unidad', $unidad->nombre, ['class' => 'form-control', 'readonly' => 'readonly']) }}
                            {{ Form::hidden('id_unidad', $unidad->id) }}
                        </div>

                            <!-- Aquí comienza la sección de temas dinámica -->
                            <div id="temas">
                                <div class="tema mb-4 border p-3" id="tema-1">
                                    <div class="form-group">
                                        {{ Form::label('temas[]', 'Tema', ['class' => 'control-label']) }}
                                        {{ Form::text('temas[]', null, ['class' => 'form-control', 'placeholder' => 'Tema']) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('practica_id[]', 'Práctica:', ['class' => 'control-label']) }}
                                        {{ Form::select('practica_id[]', ['' => '--Seleccione Práctica--'] + $practica, null, ['class' => 'form-control']) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('calendario_id[]', 'Semana de impartición:', ['class' => 'control-label']) }}
                                        {{ Form::select('calendario_id[]', ['' => '--Seleccione Semana de impartición--'] + $calendario, null, ['class' => 'form-control']) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('instrumentacion_id[]', 'Instrumentación:', ['class' => 'control-label']) }}
                                        {{ Form::select('instrumentacion_id[]', ['' => '--Seleccione Instrumentación--'] + $instrumentacion, null, ['class' => 'form-control']) }}
                                    </div>
                                </div>
                            </div>
                                
                        

                        <button type="button" id="btnAgregarTema" class="btn btn-secondary mt-2">Agregar Tema</button>

                        <div class="box-footer mt-3">
                            <div class="d-flex justify-content-end">
                                <a class="btn btn-danger mr-2" href="{{ route('asignaturas.index') }}">Cancelar</a>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('btnAgregarTema').addEventListener('click', agregarTema);
    });

    function agregarTema() {
    const contenedor = document.getElementById('temas');
    const indice = contenedor.children.length;
    const divTema = document.createElement('div');
    divTema.className = 'tema mb-4 border p-3';
    divTema.id = 'tema-' + (indice + 1);
    divTema.appendChild(crearCampo('temas[]', 'Tema ' + (indice + 1), 'text'));
    divTema.appendChild(crearCampo('practica_id[]', 'Práctica:', 'select', '<option value="">--Seleccione Práctica--</option>@foreach($practica as $key => $value) <option value="{{$key}}">{{$value}}</option> @endforeach'));
    divTema.appendChild(crearCampo('calendario_id[]', 'Semana de impartición:', 'select', '<option value="">--Seleccione Semana de impartición--</option>@foreach($calendario as $key => $value) <option value="{{$key}}">{{$value}}</option> @endforeach'));
    divTema.appendChild(crearCampo('instrumentacion_id[]', 'Instrumentación:', 'select', '<option value="">--Seleccione Instrumentación--</option>@foreach($instrumentacion as $key => $value) <option value="{{$key}}">{{$value}}</option> @endforeach'));
    const btnEliminar = document.createElement('button');
    btnEliminar.textContent = 'Eliminar Tema';
    btnEliminar.className = 'btn btn-danger mt-2';
    btnEliminar.addEventListener('click', function() {
        eliminarTema(indice + 1);
    });
    divTema.appendChild(btnEliminar);
    contenedor.appendChild(divTema);
}


    function eliminarTema(indice) {
        const contenedor = document.getElementById('temas');
        const divTema = document.getElementById('tema-' + indice);
        if (divTema) {
            contenedor.removeChild(divTema);
        }
    }

    function crearCampo(name, label, type, value = '') {
        const div = document.createElement('div');
        div.className = 'form-group';
        const lbl = document.createElement('label');
        lbl.textContent = label;
        div.appendChild(lbl);
        let campo;
        if (type === 'select') {
            campo = document.createElement('select');
            campo.innerHTML = value;
        } else {
            campo = document.createElement('input');
            campo.type = type;
            campo.value = value;
        }
        campo.name = name;
        campo.className = 'form-control';
        div.appendChild(campo);
        return div;
    }
</script>
@stop
