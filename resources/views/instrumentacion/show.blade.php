@extends('adminlte::page')

@section('title', 'Instrumentación')

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
                            <span class="card-title">{{ __('Ver') }} Instrumentación</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('instrumentacion.index') }}"> {{ __('Regresar') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Tipo Instrumentacion:</strong>
                            {{ $instrumentacion->tipo_instrumentacion }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

