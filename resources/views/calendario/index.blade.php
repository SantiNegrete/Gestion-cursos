@extends('adminlte::page')

@section('title', 'Calendario')

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
                                {{ __('Listado de Semanas') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('calendario.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nueva') }}
                                </a>
                              </div>
                        </div>
                    </div>

                    @if (session('success'))
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
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>Información Semana</th>
                                        <th>Acciones</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($calendarios as $calendario)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
                                           
                                            <td>{{ $calendario->nombre_completo }}</td>

                                            <td>
                                                <form action="{{ route('calendario.destroy',$calendario->id) }}" method="POST">
                                                    <a class="btn btn-primary btn-sm" href="{{ route('calendario.edit',$calendario->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
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
                </div>
                {!! $calendarios->links() !!}
            </div>
        </div>
    </div>

@stop


