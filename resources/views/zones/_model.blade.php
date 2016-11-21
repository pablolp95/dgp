<div class="row">
    <!-- Name field -->
    <div class="input-field col s12 m6">
        {!! Form::text("name", null, ["id" => "name","class" => "validate"]) !!}
        {!! Form::label("name", "Nombre de la zona:*") !!}
    </div>
    <div class="input-field col s12">
        {!! Form::textarea("description", null, ["id" => "description","class" => "materialize-textarea"]) !!}
        {!! Form::label("description", "Descripción de la zona ") !!}
    </div>
    <div class="input-field col s8">
        {!! Form::textarea("thematic", null, ["id" => "thematic","class" => "materialize-textarea"]) !!}
        {!! Form::label("thematic", "Temática de la zona  ") !!}
    </div>
    <div class="input-field col s4">
        {!! Form::textarea("floor", null, ["id" => "floor","class" => "materialize-textarea"]) !!}
        {!! Form::label("floor", "Nº Planta ") !!}
    </div>
    <div class="col s12">
        {!! Form::button("Guardar", ["type" => "submit", "class" => "btn waves-effect waves-light right indigo"]) !!}
    </div>

    <div class="col s12">
        <div class="clearfix"></div>
    </div>
</div>