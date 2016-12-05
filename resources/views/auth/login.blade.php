@extends('auth.main')

@section('title')
    Iniciar Sesión
@endsection

@section('auth_form')
    {!! Form::open(["method" => "post", "route" => "login.submit"]) !!}

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

        @if (count($errors) > 0)
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <div class="col s12">
            {!! Form::button("Entrar", ["type" => "submit", "class" => "btn waves-effect waves-light"]) !!}
        </div>

        <div class="col s12">
            <p class="center-align"><a href="{!! route("password") !!}">¿Has olvidado tu contraseña?</a></p>
        </div>

    {!! Form::close() !!}
@endsection
