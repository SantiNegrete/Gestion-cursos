@extends('adminlte::page')

@section('title', 'Asignaciones')

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
                            {{ __('Asignaciones') }}
                        </span>

                         <div class="float-right">
                            <a href="{{ route('asignaciones.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                              {{ __('Asignar Curso') }}
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
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>No</th>
                                    
                                    <th>Docente</th>
                                    <th>Curso Asignado </th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
    				@foreach ($asignaciones as $asignacione)
        			<tr>
            			<td>{{ ++$i }}</td>
            			<td>{{ $asignacione->usuario->name ?? 'Nombre no disponible' }}</td> {{-- Asegúrate de que 'name' es el campo que contiene el nombre del profesor --}}
            			<td>{{ $asignacione->asignatura->nombre ?? 'Nombre no disponible' }}</td> {{-- Asume que 'nombre' es el campo que contiene el nombre de la asignatura --}}

  
                                        <td>
                                            <form action="{{ route('asignaciones.destroy',$asignacione->id) }}" method="POST">
                                                <a class="btn btn-primary btn-sm" href="{{ route('asignaciones.edit',$asignacione->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
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
            {!! $asignaciones->links() !!}
        </div>
    </div>
</div>
@stop