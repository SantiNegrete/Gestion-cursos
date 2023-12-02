<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $asignatura->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => '-- Ingrese el nombre de la asignatura --']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('objetivo') }}
            {{ Form::textarea('objetivo', $asignatura->objetivo, ['class' => 'form-control' . ($errors->has('objetivo') ? ' is-invalid' : ''), 'placeholder' => '-- Ingrese el objetivo de la asignatura --', 'rows' => 4]) }}
            {!! $errors->first('objetivo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('competencia_general') }}
            {{ Form::textarea('competencia_general', $asignatura->competencia_general, ['class' => 'form-control' . ($errors->has('competencia_general') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese la Competencia General correspondiente', 'rows' => 4]) }}
            {!! $errors->first('competencia_general', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('competencia_especifica') }}
            {{ Form::textarea('competencia_especifica', $asignatura->competencia_especifica, ['class' => 'form-control' . ($errors->has('competencia_especifica') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese la Competencia Específica correspondiente', 'rows' => 4]) }}
            {!! $errors->first('competencia_especifica', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fuentes_informacion') }}
            {{ Form::textarea('fuentes_informacion', $asignatura->fuentes_informacion, ['class' => 'form-control' . ($errors->has('fuentes_informacion') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese las Fuentes de Información adecuadas', 'rows' => 4]) }}
            {!! $errors->first('fuentes_informacion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="box-footer mt-3">
        <div class="d-flex justify-content-end">
            <a class="btn btn-danger mr-2" href="{{ route('asignaturas.index') }}"><i class="fa fa-fw fa-ban"></i> {{ __('Cancelar') }}</a>
            <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-save"></i> {{ __('Guardar') }}</button>
        </div>
    </div>
</div>
    