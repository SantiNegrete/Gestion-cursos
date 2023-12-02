@extends('layout')

@section('content')

<style>

    .list-group-item {
        background-color: #f8f9fa; 
        border-left: none;
        border-right: none;
        border-top: none;
        border-bottom: 1px solid #ddd; 
        border-radius: 0; 
    }
    .list-group-item:last-child {
        border-bottom: none; 
    }
    .list-group-item-action:hover {
        background-color: #e9ecef; 
    }
    .list-group .d-flex {
        justify-content: space-between; 
        align-items: center; 
    }
    .list-group select.form-control {
        display: block; 
        width: 100%; 
        margin-top: 0.5rem; 
        padding: 0.375rem 0.75rem; 
        font-size: 1rem; 
        line-height: 1.5;
        color: #495057; 
        background-color: #fff; 
        background-clip: padding-box;
        border: 1px solid #ced4da; 
        border-radius: 0.25rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
</style>

<div class="container mt-3">
    <!-- Título del tema -->
    <div class="row mb-3">
        <div class="col">
            <h2>Unidad 1: Fundamentos de la Integración Continua</h2>
            <p>Objetivo: Comprender los conceptos fundamentales de la integración continua (CI) y su importancia en el desarrollo web.</p>
        </div>
    </div>

    <!-- Contenido del tema -->
    <div class="row">
        <div class="col-md-6">
            <!-- Columna izquierda para los temas -->
            <div class="list-group">
                <!-- Tema 1.1 -->
                <div class="list-group-item">
                    <h5 class="mb-1">1.1: Introducción a la integración continua (CI).</h5>
                    <small>Semana programada</small>
                    <select class="form-control mt-2">
                        <option selected>3/04-sep - 08-sep</option>
                        <!-- Añade más opciones según sea necesario -->
                    </select>
                </div>
                <!-- Tema 2.2 -->
                <div class="list-group-item">
                    <h5 class="mb-1">1.2: Beneficios de la integración continua en proyectos web.</h5>
                    <small>Semana programada</small>
                    <select class="form-control mt-2">
                        <option selected>3/04-sep - 08-sep</option>
                        <!-- Añade más opciones según sea necesario -->
                    </select>
                </div>
                <!-- Tema 2.3 -->
                <div class="list-group-item">
                    <h5 class="mb-1">1.3: Herramientas y sistemas de CI/CD populares.</h5>
                    <small>Semana programada</small>
                    <select class="form-control mt-2">
                        <option selected>4/11-sep - 15-sep</option>
                        <!-- Añade más opciones según sea necesario -->
                    </select>
                </div>
                <!-- Tema 2.4 -->
                <div class="list-group-item">
                    <h5 class="mb-1">1.4: Configuración del entorno de integración continua.</h5>
                    <small>Semana programada</small>
                    <select class="form-control mt-2">
                        <option selected>5/18-sep - 22-sep</option>
                        <!-- Añade más opciones según sea necesario -->
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <!-- Columna derecha para las evaluaciones e instrumentos -->
            <div class="list-group">
                <!-- Evaluación de la competencia -->
                <div class="list-group-item">
                    <h5 class="mb-1">Evaluación de la competencia</h5>
                    <small>Semana de evaluación</small>
                    <select class="form-control mt-2">
                        <option selected>5/18-sep - 22-sep</option>
                        <!-- Añade más opciones según sea necesario -->
                    </select>
                </div>
                <!-- Instrumento 1 -->
                <div class="list-group-item">
                    <h5 class="mb-1">Instrumentación</h5>
                    <small>Instrumento 1</small>
                    <select class="form-control mt-2">
                        <option selected>2 - Cátedra docente</option>
                        <!-- Añade más opciones según sea necesario -->
                    </select>
                </div>
                <!-- Instrumento 2 -->
                <div class="list-group-item">
                    <h5 class="mb-1">Instrumentación</h5>
                    <small>Instrumento 2</small>
                    <select class="form-control mt-2">
                        <option selected>3 - Prácticas de Laboratorio</option>
                        <!-- Añade más opciones según sea necesario -->
                    </select>
                </div>
                <!-- Instrumento 3 -->
                <div class="list-group-item">
                    <h5 class="mb-1">Instrumentación</h5>
                    <small>Instrumento 3</small>
                    <select class="form-control mt-2">
                        <option selected>4 - Proyecto</option>
                        <!-- Añade más opciones según sea necesario -->
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
