
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class=" p-3 d-flex justify-content-between ">

                    <span class=" card-title">{{ __('Instrumentacion') }}</span>

                    <a href="{{ route('instrumentacion.create') }}" class="btn btn-primary btn-sm" data-placement="left">
                        {{ __('Crear Nuevo') }}
                    </a>
                </div>
                <div class="px-3">
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

                                    <th>Tipo Instrumentación</th>

                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($instrumentacions as $instrumentacion)
                                    <tr>

                                        <td>{{ $instrumentacion->tipo_instrumentacion }}</td>

                                        <td>
                                            <a class="btn btn-primary btn-sm"
                                                href="{{ route('instrumentacion.edit', $instrumentacion->id) }}"><i
                                                    class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                    <button class="btn btn-danger btn-sm" type="button"
                                                    wire:click="delete({{ $instrumentacion->id }})"
                                                    wire:confirm="¿Estas seguro de eliminar esta instrumentacion?">
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
            {!! $instrumentacions->links() !!}
        </div>
    </div>
</div>
