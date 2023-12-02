<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('tipo_instrumentación') }}
            {{ Form::text('tipo_instrumentacion', $instrumentacion->tipo_instrumentacion, ['class' => 'form-control' . ($errors->has('tipo_instrumentacion') ? ' is-invalid' : ''), 'placeholder' => 'Tipo Instrumentacion']) }}
            {!! $errors->first('tipo_instrumentacion', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt-3">
        <div class="d-flex justify-content-end">
            <a class="btn btn-danger mr-2" href="{{ route('instrumentacion.index') }}"><i class="fa fa-fw fa-ban"></i> {{ __('Cancelar') }}</a>
            <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-save"></i> {{ __('Guardar') }}</button>
        </div>
    </div>
</div>