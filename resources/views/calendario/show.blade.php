@extends('adminlte::page')

@section('title', 'Calendario') 

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
                            <span class="card-title">{{ __('Mostrar') }} Calendario</span> <!-- Título de la tarjeta -->
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('calendario.index') }}"> {{ __('Volver') }}</a> <!-- Botón para volver a la lista de calendarios -->
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre Semana:</strong> 
                            {{ $calendario->nombre_semana }} 
                        </div>
                        <div class="form-group">
                            <strong>Fecha Inicio:</strong> 
                            {{ $calendario->fecha_inicio }} 
                        </div>
                        <div class="form-group">
                            <strong>Fecha Fin:</strong> 
                            {{ $calendario->fecha_fin }} 
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@stop


