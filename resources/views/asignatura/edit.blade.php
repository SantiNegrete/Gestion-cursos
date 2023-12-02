@extends('adminlte::page')

@section('title', 'Asignaturas')

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
                    <span class="card-title">{{ __('Actualizar') }} Asignatura</span>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('asignaturas.update', $asignatura->id) }}"  role="form" enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        @csrf

                        @include('asignatura.form')

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@stop

