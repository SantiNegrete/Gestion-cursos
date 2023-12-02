@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <br>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {{ __('Roles') }}
                        </span>

                         <div class="float-right">
                            <a href="{{ route('roles.create') }}" class="btn btn-secondary btn-sm float-right"  data-placement="left">
                              {{ __('Crear Nuevo') }}
                            </a>
                          </div>
                    </div>
                </div>
                @if (session('success'))
                <!-- Modal -->
                <div class="modal fade" id="customSuccessModal" tabindex="-1" aria-labelledby="customSuccessModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-dark text-white">
                                <h5 class="modal-title" id="customSuccessModalLabel">Mensaje de éxito</h5>
                            </div>
                            <div class="modal-body">
                                {{ session('success') }}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        var myModal = new bootstrap.Modal(document.getElementById('customSuccessModal'), {});
                        myModal.show();
                    });
                </script>
            @endif

                <div class="card-body">
                    <table class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width: 15%;">ID</th> 
                                <th style="width: 55%;">Rol</th> 
                                <th style="width: 30%;" class="text-center">Acciones</th> 
                            </tr>
                        </thead> 
                        
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{$role->id}}</td>
                                    <td>{{$role->name}}</td>
                                    <td class="text-center"> 
                                        <form action="{{ route('roles.destroy',$role->id) }}" method="POST" class="d-inline-block">
                                            <a class="btn btn-primary btn-sm" href="{{ route('roles.edit',$role->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @stop
        
