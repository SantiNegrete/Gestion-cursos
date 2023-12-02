<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span id="card_title">{{ __('Usuario') }}</span>
                    <a href="{{ route('usuarios.create') }}" class="btn btn-primary btn-sm" data-placement="left">
                        {{ __('Crear Nuevo') }}
                    </a>
                </div>
                <div class="input-group">
                    <input wire:model="search" type="search" class="form-control" placeholder="Ingrese el nombre o correo de un usuario">
                    <div class="input-group-append">
                      <button class="btn btn-outline-secondary" type="button">
                        <i class="fas fa-search"></i>
                      </button>
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

                @if($usuarios->count())
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Rol</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usuarios as $usuario)
                                    <tr>
                                        <td>{{ $usuario->id }}</td>
                                        <td>{{ $usuario->name }}</td>
                                        <td>{{ $usuario->email }}</td>
                                        <td>
                                            @if ($usuario->roles->isNotEmpty())
                                                {{ $usuario->roles->first()->name }}
                                            @else
                                                Sin rol
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" class="d-inline">
                                                <a class="btn btn-primary btn-sm" href="{{ route('usuarios.edit', $usuario->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="card-footer">
                            {{$usuarios->links()}}
                        </div>
                    </div>
                </div>
                @else
                    <div class="card-body">
                        <strong>No hay registros</strong>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
