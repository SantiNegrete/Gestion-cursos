@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <br>
@stop

@section('content')
    @livewire('admin.usuarios-index')

@stop
