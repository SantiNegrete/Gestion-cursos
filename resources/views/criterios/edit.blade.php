@extends('adminlte::page')

@section('title', 'Criterios de Evaluación')

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
                    <span class="card-title">{{ __('Actualizar') }} Criterio de Evaluación</span>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('criterios.update', $criteriosEvaluacion->id) }}"  role="form" enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        @csrf

                        @include('criterios.form')

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@stop


