<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('semana') }} 
            {{ Form::text('nombre_semana', $calendario->nombre_semana, ['class' => 'form-control' . ($errors->has('nombre_semana') ? ' is-invalid' : ''), 'placeholder' => 'Ejemplo: "Semana 1"']) }} <!-- Campo de texto para 'nombre_semana' -->
            {!! $errors->first('nombre_semana', '<div class="invalid-feedback">:message</p>') !!} <!-- Muestra el primer error para 'nombre_semana', si existe -->
        </div>
        <div class="form-group">
            {{ Form::label('fecha_inicio') }} 
            {{ Form::date('fecha_inicio', $calendario->fecha_inicio, ['class' => 'form-control' . ($errors->has('fecha_inicio') ? ' is-invalid' : ''), 'placeholder' => 'Fecha Inicio']) }} <!-- Selector de fecha para 'fecha_inicio' -->
            {!! $errors->first('fecha_inicio', '<div class="invalid-feedback">:message</div>') !!} <!-- Muestra el primer error para 'fecha_inicio', si existe -->
        </div>
        <div class="form-group">
            {{ Form::label('fecha_fin') }} 
            {{ Form::date('fecha_fin', $calendario->fecha_fin, ['class' => 'form-control' . ($errors->has('fecha_fin') ? ' is-invalid' : ''), 'placeholder' => 'Fecha Fin']) }} <!-- Selector de fecha para 'fecha_fin' -->
            {!! $errors->first('fecha_fin', '<div class="invalid-feedback">:message</div>') !!} <!-- Muestra el primer error para 'fecha_fin', si existe -->
        </div>

    </div>
    <div class="box-footer mt-3">
        <div class="d-flex justify-content-end">
            <a class="btn btn-danger mr-2" href="{{ route('calendario.index') }}"><i class="fa fa-fw fa-ban"></i> {{ __('Cancelar') }}</a>
            <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-save"></i> {{ __('Guardar') }}</button>
        </div>
    </div>
</div>
