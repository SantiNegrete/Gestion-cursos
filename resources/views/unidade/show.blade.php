@extends('adminlte::page')

@section('title', 'Unidades')

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
                        <span class="card-title">{{ __('Mostrar') }} Unidad</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary" href="{{ route('unidades.index') }}"> {{ __('Regresar') }}</a>
                    </div>
                </div>

                <div class="card-body">
                    
                    <div class="form-group">
                        <strong>Asignatura:</strong>
                        {{ $unidade->asignatura->nombre  }}
                    </div>
                    <div class="form-group">
                        <strong>Nombre:</strong>
                        {{ $unidade->nombre }}
                    </div>

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