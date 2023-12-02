<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('descripcion', 'Descripción') }}
            {{ Form::textarea('descripcion', $criteriosEvaluacion->descripcion, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Redacta la descripción', 'rows' => 4]) }}
            {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-primary mr-2"><i class="fa fa-fw fa-save"></i> {{ __('Guardar') }}</button>
        <a class="btn btn-danger" href="{{ route('criterios.index') }}"><i class="fa fa-fw fa-ban"></i> {{ __('Cancelar') }}</a>
    </div>
</div>
