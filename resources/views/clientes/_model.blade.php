<div class="row">

    <div class="col s12">
        <h3>Datos de cliente:</h3>
    </div>
    
    <!-- Name field -->
    <div class="input-field col s12 m6">
        {!! Form::text("name", null, ["id" => "name","class" => "validate"]) !!}
        {!! Form::label("name", "Nombre o razón social:*") !!}
    </div>

    <!-- Surname field -->
    <div class="input-field col s12 m6">
        {!! Form::text("surname", null, ["id" => "surname","class" => "validate"]) !!}
        {!! Form::label("surname", "Apellidos o tipo de sociedad:") !!}
    </div>

    <!-- nif field -->
    <div class="input-field col s12 m6">
        {!! Form::text("nif", null, ["id" => "nif","class" => "validate"]) !!}
        {!! Form::label("nif", "NIF:*") !!}
    </div>

    <!-- Type field -->
    <div class="input-field col s12 m6">
        {!! Form::text("type", null, ["id" => "type","class" => "validate"]) !!}
        {!! Form::label("type", "Tipo de cliente:") !!}
    </div>

    <!-- Phone field -->
    <div class="input-field col s12 m6">
        {!! Form::text("phone", null, ["id" => "phone","class" => "validate"]) !!}
        {!! Form::label("phone", "Teléfono:") !!}
    </div>
    <!-- Mobile field -->
    <div class="input-field col s12 m6">
        {!! Form::text("mobile", null, ["id" => "mobile","class" => "validate"]) !!}
        {!! Form::label("mobile", "Móvil:") !!}
    </div>

    <!-- Email field -->
    <div class="input-field col s12 m6">
        {!! Form::text("email", null, ["id" => "email","class" => "validate"]) !!}
        {!! Form::label("email", "Email:") !!}
    </div>

    <!-- Notas field -->
    <div class="input-field col s12 m6">
        {!! Form::text("notes", null, ["id" => "notes","class" => "validate"]) !!}
        {!! Form::label("notes", "Notas:") !!}
    </div>

    <div class="col s12">
        <h3>Datos de facturación:</h3>
    </div>

    @include("facturas._invoicing_data",["prefix" => ""])

    <div class="col s12">
        {!! Form::button("Guardar", ["type" => "submit", "class" => "btn waves-effect waves-light right indigo"]) !!}
    </div>

    <div class="col s12">
        <div class="clearfix"></div>
    </div>
</div>
