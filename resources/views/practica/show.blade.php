@extends('adminlte::page')

@section('title', 'Prácticas')

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
                        <span class="card-title">{{ __('Ver') }} Práctica</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary" href="{{ route('practicas.index') }}"> {{ __('Regresar') }}</a>
                    </div>
                </div>

                <div class="card-body">
                    
                    <div class="form-group">
                        <strong>Id Subtema:</strong>
                        {{ $practica->id_subtema }}
                    </div>
                    <div class="form-group">
                        <strong>Descripción:</strong>
                        {{ $practica->descripcion }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@stop


