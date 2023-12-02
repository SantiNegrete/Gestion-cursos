@extends('adminlte::page')

@section('title', 'Asignaciones')

@section('content_header')
    <br>
@stop

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <span class="card-title">{{ __('Ver') }} Asignación</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary" href="{{ route('asignaciones.index') }}"> {{ __('Regresar') }}</a>
                    </div>
                </div>

                <div class="card-body">
                    
                    <div class="form-group">
                        <strong>Id Profesor:</strong>
                        {{ $asignacione->id_profesor }}
                    </div>
                    <div class="form-group">
                        <strong>Id Asignatura:</strong>
                        {{ $asignacione->id_asignatura }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@stop

