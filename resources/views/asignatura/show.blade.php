@extends('adminlte::page')

@section('title', 'Asignaturas')

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
                        <span class="card-title">{{ __('Ver') }} Asignatura</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary" href="{{ route('asignaturas.index') }}"> {{ __('Regresar') }}</a>
                    </div>
                </div>

                <div class="card-body">
                    
                    <div class="form-group">
                        <strong>Nombre:</strong>
                        {{ $asignatura->nombre }}
                    </div>
                    <div class="form-group">
                        <strong>Objetivo:</strong>
                        {{ $asignatura->objetivo }}
                    </div>
                    <div class="form-group">
                        <strong>Competencia General:</strong>
                        {{ $asignatura->competencia_general }}
                    </div>
                    <div class="form-group">
                        <strong>Competencia Específica:</strong>
                        {{ $asignatura->competencia_especifica }}
                    </div>
                    <div class="form-group">
                        <strong>Fuentes de Información:</strong>
                        {{ $asignatura->fuentes_informacion }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@stop


