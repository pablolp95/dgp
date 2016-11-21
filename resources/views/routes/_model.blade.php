<div class="row">
    <!-- Name field -->
    <div class="input-field col s12 m6">
        {!! Form::text("name", null, ["id" => "name","class" => "validate"]) !!}
        {!! Form::label("name", "Nombre de la ruta:*") !!}
    </div>
    <div class="input-field col s12 m6">
        {!! Form::text("floor", null, ["id" => "floor","class" => "validate"]) !!}
        {!! Form::label("floor", "Planta de la ruta:*") !!}
    </div>
    <div class="input-field col s12">
        {!! Form::text("description", null, ["id" => "description","class" => "validate"]) !!}
        {!! Form::label("description", "Descripción de la ruta:*") !!}
    </div>
    <div class="col s12">
        {!! Form::button("Guardar", ["type" => "submit", "class" => "btn waves-effect waves-light right indigo"]) !!}
    </div>

    <div class="col s12">
        <div class="clearfix"></div>
    </div>
</div>
