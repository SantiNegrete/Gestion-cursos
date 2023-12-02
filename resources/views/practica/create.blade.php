@extends('adminlte::page')

@section('title', 'Prácticas')

@section('content_header')
    <br>
@stop

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">

            @includeif('partials.errors')

            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title">{{ __('Crear') }} Práctica</span>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('practicas.store') }}"  role="form" enctype="multipart/form-data">
                        @csrf

                        @include('practica.form')

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@stop


