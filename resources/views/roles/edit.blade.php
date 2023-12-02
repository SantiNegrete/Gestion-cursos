@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <br>
@stop

@section('content')


    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
        
    @endif


    <div class="card">
        <div class="card-body">
            {!! Form::model($role, ['route' => ['roles.update', $role], 'method' => 'put']) !!}
            @include('roles.partials.form')

               
            <button type="submit" class="btn btn-primary">
                 <i class="fa fa-save"></i> Actualizar rol
            </button>

            <a href="{{route('roles.index') }}" class="btn btn-danger">
                <i class="fa fa-fw fa-ban"></i></i> Cancelar
            </a>
            {!! Form::close() !!}
        </div>
    </div>
@stop


