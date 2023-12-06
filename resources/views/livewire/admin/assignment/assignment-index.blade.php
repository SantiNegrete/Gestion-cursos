<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="px-3  py-2">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {{ __('Asignaciones') }}
                        </span>

                        <div class="float-right">
                            <a href="{{ route('asignaciones.create') }}" class="btn btn-primary btn-sm float-right"
                                data-placement="left">
                                {{ __('Asignar Curso') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="py-1 px-3">
                    <div class="d-flex ">

                        <div class="w-75">

                            <div class="input-group ">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Buscar</span>
                                </div>
                                <input wire:model.live="search" type="search" class="form-control"
                                    placeholder="Buscar por descripcion">
                            </div>


                        </div>

                        <div class="w-25">
                            <select name="" id="" class="form-control" wire:model.live="numPage">
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option value="50">50</option>
                            </select>
                        </div>



                    </div>

                </div>
                @if (session()->has('success'))
                    <div class="px-3 mt-2">

                        <div id="autoCloseAlert" class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <script>
                        // Cierra automáticamente el alert después de 3000 milisegundos (3 segundos)
                        setTimeout(function() {
                            $('#autoCloseAlert').alert('close');
                        }, 3000);
                    </script>
                @endif


                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>ID</th>
                                    <th>Docente</th>
                                    <th>Curso Asignado </th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($asignaciones as $asignacione)
                                    <tr>
                                        <td>{{ $asignacione->usuario->id }}</td>
                                        <td>{{ $asignacione->usuario->name ?? 'Nombre no disponible' }}</td>
                                        {{-- Asegúrate de que 'name' es el campo que contiene el nombre del profesor --}}
                                        <td>{{ $asignacione->asignatura->nombre ?? 'Nombre no disponible' }}</td>
                                        {{-- Asume que 'nombre' es el campo que contiene el nombre de la asignatura --}}


                                        <td>
                                            <a class="btn btn-primary btn-sm"
                                                href="{{ route('asignaciones.edit', $asignacione->id) }}"><i
                                                    class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>

                                            <button class="btn btn-danger btn-sm" type="button"
                                                wire:click="delete({{ $asignacione->id }})"
                                                wire:confirm="¿Estas seguro de eliminar esta asignacion?">
                                                <i class="fa fa-fw fa-trash"></i>
                                                Eliminar
                                            </button>

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
