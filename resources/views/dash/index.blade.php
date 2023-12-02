@extends('adminlte::page')

@section('title', 'Gestión de Cursos - TecNM-Instituto Tecnológico de Morelia')
@section('content_header')
    <div class="container">
        @if(auth()->check())
            @php
                // Establece la zona horaria a la Ciudad de México
                date_default_timezone_set('America/Mexico_City');

                $time = date('H:i'); 
                $greeting = 'Bienvenid@';

                if ($time >= '05:00' && $time < '12:00') {
                    $greeting = 'Buenos días';
                } elseif ($time >= '12:00' && $time < '19:00') {
                    $greeting = 'Buenas tardes';
                } elseif ($time >= '19:00' || $time < '05:00') {
                    $greeting = 'Buenas noches';
                }
            @endphp

            <!-- Tarjeta de Bienvenida -->
            <div class="welcome-card">
                <h1>{{ $greeting }}, {{ auth()->user()->name }}</h1>
            </div>
        @else
            <div class="welcome-card">
                <h1>Bienvenid@</h1>
            </div>
        @endif
    </div>
@stop



@section('content')
<div class="container">
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="row">
        <!-- Columna de Texto -->
        <div class="col-md-6">
            <p>"Como administrador de nuestro sistema de gestión de cursos, eres la clave para desbloquear el potencial educativo, transformando cada lección en una oportunidad de aprendizaje y crecimiento."</p>
        </div>

        <!-- Columna para la Imagen -->
        <div class="col-md-6">
            <!-- Aquí puedes insertar tu imagen, por ejemplo usando una etiqueta img -->
            <img src="img/ITM.png" alt="Descripción de la imagen" class="img-fluid">
        </div>
    </div>   
</div>
@stop


@section('css')
<style>
    .welcome-card {
        background-color: #f4f6f9; 
        border: 1px solid #ddd; 
        border-radius: 8px; 
        padding: 20px; 
        margin-top: 20px; 
        text-align: center; 
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .welcome-card h1 {
        color: #333; 
        font-size: 24px; 
        font-weight: bold; 
        margin-bottom: 0; 
    }
    </style>
    
@stop

@section('js')
    <script> console.log('Página cargada con éxito!'); </script>
@stop
