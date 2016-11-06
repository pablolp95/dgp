@extends('auth.main')

@section('title')
    Reestablecer Contraseña
@endsection

@section('auth_form')
    {!! Form::open(["method" => "post", "route" => "password.submit"]) !!}

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

        <div class="col s12">
            <p class="grey-text darken-2">Si el email está en nuestra base de datos te enviaremos un correo electrónico con un enlace de recuperación.</p>
        </div>

        <div class="col s12">
            {!! Form::submit("Enviar enlace de recuperación", ["class" => "btn waves-effect waves-light"]) !!}
        </div>

        <div class="col s12">
            <p class="center-align"><a href="{!! route("login") !!}">¿Recuerdas tu contraseña?</a></p>
        </div>


        {!! Form::close() !!}
@endsection
