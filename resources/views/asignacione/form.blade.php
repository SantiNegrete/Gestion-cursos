<div class="box box-info padding-1">
    <div class="box-body">
        
        <!-- Selector de Profesores -->
        <div class="form-group">
            {{ Form::label('id_profesor', 'Profesor') }}
            {{ Form::select('id_profesor', $profesores, $asignacione->id_profesor, ['class' => 'form-control' . ($errors->has('id_profesor') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione un Profesor']) }}
            {!! $errors->first('id_profesor', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <!-- Selector de Asignaturas -->
        <div class="form-group">
            {{ Form::label('id_asignatura', 'Asignatura') }}
            {{ Form::select('id_asignatura', $asignaturas, $asignacione->id_asignatura, ['class' => 'form-control' . ($errors->has('id_asignatura') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione una Asignatura']) }}
            {!! $errors->first('id_asignatura', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-primary mr-2"><i class="fa fa-fw fa-save"></i> {{ __('Guardar') }}</button>
        <a class="btn btn-danger" href="{{ route('asignaciones.index') }}"><i class="fa fa-fw fa-ban"></i> {{ __('Cancelar') }}</a>
    </div>
</div>
