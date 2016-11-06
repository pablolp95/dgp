<!-- Nombre para facturación field -->
<div class="input-field col s12 m6">
    {!! Form::text($prefix."invoicing_name", null, ["id" => $prefix."invoicing_name","class" => "validate"]) !!}
    {!! Form::label($prefix."invoicing_name", "Nombre completo:") !!}
</div>

<!-- Type field -->
<div class="input-field col s12 m6">
    {!! Form::text($prefix."entity_type", null, ["id" => $prefix."entity_type","class" => "validate"]) !!}
    {!! Form::label($prefix."entity_type", "Tipo de entidad:") !!}
</div>

@if($prefix != "")
    <!-- NIF field -->
    <div class="input-field col s12">
        {!! Form::text($prefix."nif", null, ["id" => $prefix."nif","class" => "validate"]) !!}
        {!! Form::label($prefix."nif", "NIF:") !!}
    </div>
@endif

<div class="col s12">
    <div class="col s12">
        <p>País:</p>
    </div>
    <div class="col s12 input-field">
        {!! Form::select($prefix."country", App\Cliente::$countries, null, ["id" => $prefix."country", "class" => "browser-default"]) !!}
    </div>
</div>

<div class="col s12 m6 hidden">
    <div class="col s12">
        <p>Provincia:</p>
    </div>
    <div class="col s12 input-field">
        {!! Form::select($prefix."state", App\Cliente::$provinces, null, ["id" => $prefix."state", "class" => "browser-default"]) !!}
    </div>
</div>

<!-- City field -->
<div class="input-field col s12 m6">
    {!! Form::text($prefix."city", null, ["id" => $prefix."city","class" => "validate"]) !!}
    {!! Form::label($prefix."city", "Ciudad:") !!}
</div>

<!-- Zip code field -->
<div class="input-field col s12 m6">
    {!! Form::text($prefix."zip_code", null, ["id" => $prefix."zip_code","class" => "validate"]) !!}
    {!! Form::label($prefix."zip_code", "Código postal:") !!}
</div>

<!-- Dirección 1 field -->
<div class="input-field col s12">
    {!! Form::text($prefix."address_1", null, ["id" => $prefix."address_1","class" => "validate"]) !!}
    {!! Form::label($prefix."address_1", "Dirección línea 1:") !!}
</div>

<!-- Dirección 2 field -->
<div class="input-field col s12">
    {!! Form::text($prefix."address_2", null, ["id" => $prefix."address_2","class" => "validate"]) !!}
    {!! Form::label($prefix."address_2", "Dirección línea 2:") !!}
</div>