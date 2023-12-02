@extends('layout')

@section('content')

<style>
    .card {
        min-height: 300px;
        border: 1px solid #e0e0e0; 
        border-radius: 0.5rem;
        transition: box-shadow 0.3s ease-in-out, transform 0.3s ease-in-out; 
        background-color: #fff; 
    }
    .card:hover {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); 
        transform: translateY(-5px); 
    }
    .card-body {
        padding: 1.5rem;
        position: relative;
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    .card-title {
        font-size: 1.25rem;
        margin-bottom: 0.5rem;
    }
    .card-link {
        position: absolute;
        bottom: 10px;
        right: 10px;
        font-weight: bold;
        text-decoration: none; 
        color: #fff; 
    }
    .btn-primary {
        background-color: #007bff; 
        border: none; 
    }
</style>

<div class="container mt-3">
    <div class="row">
        <div class="col-12 mb-4">
            <h1 class="text-center">Gestión de Cursos</h1>
        </div>
    </div>
    <div class="row">
        <!-- Card 1 -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Integración Continua de Proyectos Web</h5>
                    <a href="#" class="card-link btn btn-primary">
                        <i class="fas fa-tools"></i> Gestión
                    </a>
                </div>
            </div>
        </div>
        

        <!-- Card 2 -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Fundamentos de Programación</h5>
                    <a href="#" class="card-link btn btn-primary">
                        <i class="fas fa-tools"></i> Gestión
                    </a>
                </div>
            </div>
        </div>

        <!-- Repite los cards según sea necesario -->
    </div>
</div>

@endsection
