<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Nombre') }}
            {{ Form::text('name', $usuario->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('email') }}
            {{ Form::text('email', $usuario->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email']) }}
            {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('password', 'Contraseña') }}
            {{ Form::password('password', ['class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''), 'placeholder' => 'Contraseña']) }}
            {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('role', 'Rol') }}
            {{ Form::select('role', $rolesConPlaceholder, $usuario->roles->first()->name ?? '', ['class' => 'form-control' . ($errors->has('role') ? ' is-invalid' : '')]) }}
            {!! $errors->first('role', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        

    </div>
    <div class="box-footer mt-3">
        <div class="d-flex justify-content-end">
            <a class="btn btn-danger mr-2" href="{{ route('usuarios.index') }}"><i class="fa fa-fw fa-ban"></i> {{ __('Cancelar') }}</a>
            <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-save"></i> {{ __('Guardar') }}</button>
        </div>
    </div>
</div>
