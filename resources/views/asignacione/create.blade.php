@extends('adminlte::page')

@section('title', 'Asignaciones')

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
                    <span class="card-title">{{ __('Asiganción') }} de Curso</span>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('asignaciones.store') }}"  role="form" enctype="multipart/form-data">
                        @csrf

                        @include('asignacione.form')

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@stop


