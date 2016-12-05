@extends('auth.main')

@section('title')
    Reestablecer Contraseña
@endsection

@section('auth_form')
    {!! Form::open(["method" => "post", "route" => "password.reset.submit"]) !!}

        @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif

        <!-- Email field -->
        <div class="input-field col s12">
            {!! Form::email("email", null, ["id" => "email","class" => "validate", "autofocus" => "autofocus"]) !!}
            {!! Form::label("email", "Email:") !!}
        </div>

        <!-- Password field -->
        <div class="input-field col s12">
            {!! Form::password("password", null, ["id" => "password","class" => "validate"]) !!}
            {!! Form::label("password", "Contraseña:") !!}
        </div>

        <!-- Password Confirmation field -->
        <div class="input-field col s12">
            {!! Form::password("password_confirmation", null, ["id" => "password_confirmation","class" => "validate"]) !!}
            {!! Form::label("password_confirmation", "Contraseña (de nuevo):") !!}
        </div>

        <div class="col s12">
            {!! Form::submit("Establecer nueva contraseña", ["class" => "btn waves-effect waves-light"]) !!}
        </div>
    {!! Form::close() !!}
@endsection
