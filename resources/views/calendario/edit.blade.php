@extends('adminlte::page') 

@section('title', 'Calendario') 
@section('content_header')
    <br>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors') 
                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Actualizar') }} Calendario</span> <!-- Título de la tarjeta -->
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('calendario.update', $calendario->id) }}" role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }} 
                            @csrf 

                            @include('calendario.form') 

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop


