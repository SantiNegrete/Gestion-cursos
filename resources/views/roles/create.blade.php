@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <br>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        {!! Form::open(['route' => 'roles.store']) !!}

        @include('roles.partials.form')

        <button type="submit" class="btn btn-primary">
            <i class="fa fa-save"></i> Guardar 
       </button>

        
        <a href="{{route('roles.index') }}" class="btn btn-danger">
            <i class="fa fa-fw fa-ban"></i></i> Cancelar
        </a>

        {!! Form::close() !!}
    </div>
</div>
@stop


