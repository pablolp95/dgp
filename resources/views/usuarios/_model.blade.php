<?php
if(isset($usuario)) {
    $current_role = $usuario->roles()->get()->first()->name;
} else {
    $current_role = null;
}

?>
<div class="row">
    <!-- Email field -->
    <div class="input-field col s12 m6">
        {!! Form::text("email", null, ["id" => "email","class" => "validate"]) !!}
        {!! Form::label("email", "Email:*") !!}
    </div>

    <!-- Contraseña field -->
    <div class="input-field col s12 m6">
        {!! Form::password("password", ["id" => "password","class" => "validate"]) !!}
        {!! Form::label("password", "Contraseña:*") !!}
    </div>

    <!-- Name field -->
    <div class="input-field col s12 m6">
        {!! Form::text("name", null, ["id" => "name","class" => "validate"]) !!}
        {!! Form::label("name", "Nombre:") !!}
    </div>

    <!-- Status field -->
    <div class="input-field col s12 m6">
        {!! Form::text("status", null, ["id" => "status","class" => "validate"]) !!}
        {!! Form::label("status", "Estado del usuario:") !!}
    </div>

    <!-- Notas field -->
    <div class="input-field col s12">
        {!! Form::text("notes", null, ["id" => "notes","class" => "validate"]) !!}
        {!! Form::label("notes", "Notas:") !!}
    </div>

    <!-- Role dropdown select -->
    <div class="col s12 m6">
        {!! Form::label("role", "Rol del usuario:") !!}
        {!! Form::select("role", $roles, $current_role, ["id" => "role", "class" => "browser-default"]) !!}
    </div>
    
    <div class="col s12">
        {!! Form::button("Guardar", ["type" => "submit", "class" => "btn waves-effect waves-light right indigo"]) !!}
    </div>

    <div class="col s12">
        <div class="clearfix"></div>
    </div>
</div>
