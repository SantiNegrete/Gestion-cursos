<div class="container mt-3">
    <h2>Unidad: {{ $unidadActual->nombre }}</h2>
    <p>Objetivo: {{ $unidadActual->objetivo }}</p>

    @if (session()->has('success'))
        <div class="px-3 mt-2">

            <div id="autoCloseAlert" class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                {{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> --}}
            </div>
        </div>
   
    @endif


    <div class="row">
        <div class="col-md-6">
            <div class="list-group">
                @foreach ($temas as $tema)
                    <div class="list-group-item">
                        <h5 class="mb-1">{{ $tema->nombre }}</h5>
                        <small>Semana programada</small>
                        <select class="form-control mt-2" wire:model="temasForm.{{ $tema->id }}"
                            name="temasForm.{{ $tema->id }}">
                            <option value="">Selecciona Semana</option>
                            @foreach ($calendarios as $calendario)
                                <option value="{{ $calendario->id }}">
                                    {{ $calendario->nombre_completo }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endforeach

            </div>
        </div>

        {{-- Sección para evaluación de la competencia e instrumentaciones --}}
        <div class="col-md-6">
            <div class="list-group">
                <div class="list-group-item">
                    <h5 class="mb-1">Evaluación de la competencia</h5>
                    <small>Semana de evaluación</small>
                    <select class="form-control mt-2" wire:model="calendarioForm">
                        <option value="">Selecciona Semana</option>
                        @foreach ($calendarios as $calendario)
                            <option value="{{ $calendario->id }}"
                                {{ $tema->configuracionDocente->calendario_id ?? null == $calendario->id ? 'Selected' : '' }}>
                                {{ $calendario->nombre_completo }}
                            </option>
                        @endforeach
                    </select>
                </div>
                {{-- Instrumentaciones --}}
                @foreach ([1, 2, 3] as $i => $data)
                    <div class="list-group-item">
                        <h5 class="mb-1">Instrumentación</h5>
                        <small>Instrumento {{ $i + 1 }}</small>
                        <select class="form-control mt-2" wire:model="instrumentacionForm.{{ $data }}">
                            <option value="">Selecciona Instrumentación</option>

                            @foreach ($instrumentaciones as $instrumentacion)
                                <option value="{{ $instrumentacion->id }}">
                                    {{ $instrumentacion->tipo_instrumentacion }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endforeach
            </div>
        </div>

    </div>


    <div class="mb-3">
        @foreach ($numUnidades as $num => $numId)
            <button class="btn btn-custom" wire:click="cambiarUnidad({{ $numId }})">Unidad #
                {{ $num + 1 }}
            </button>
        @endforeach
        <button type="button" wire:click="save" class="btn btn-custom">
            <i class="fas fa-save"></i> Guardar
        </button>
    </div>
    <script>
        // Cierra automáticamente el alert después de 3000 milisegundos (3 segundos)
        setTimeout(function() {
            $('#autoCloseAlert').alert('close');
        }, 3000);
    </script>

</div>
