@extends('adminlte::page')

@section('title', 'Criterios de Evaluación')

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
                        <span class="card-title">{{ __('Ver') }} Criterio de Evaluación</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary" href="{{ route('criterios.index') }}"> {{ __('Regresar') }}</a>
                    </div>
                </div>

                <div class="card-body">
                    
                    <div class="form-group">
                        <strong>Descripción:</strong>
                        {{ $criteriosEvaluacion->descripcion }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@stop

