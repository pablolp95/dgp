<div class="row">
    <!-- Name field -->
    <div class="input-field col s12 m6">
        {!! Form::text("name", null, ["id" => "name","class" => "validate"]) !!}
        {!! Form::label("name", "Nombre del impuesto:*") !!}
    </div>

    <!-- Aplicable to all field -->
    <div class="col s12 m6">
        <div class="col s12">
            <p>Aplicable a todos los productos y servicios:*</p>
        </div>
        <div class="col s12 input-field">
            {!! Form::select("aplicable_to_all", ["No","Si"],"No", ["id" => "aplicable_to_all","class" => "browser-default"]) !!}
        </div>
    </div>

    <!-- Percentage field -->
    <div class="input-field col s12 m6">
        {!! Form::number("percentage", null, ["id" => "percentage","class" => "materialize-textarea"]) !!}
        {!! Form::label("percentage", "Porcentaje de impuesto:") !!}
    </div>

    <!-- Fixed amount field -->
    <div class="input-field col s12 m6">
        {!! Form::text("fixed_amount", null, ["id" => "fixed_amount","class" => "validate"]) !!}
        {!! Form::label("fixed_amount", "Cantidad fija:") !!}
    </div>
    
    <div class="col s12">
        {!! Form::button("Guardar", ["type" => "submit", "class" => "btn waves-effect waves-light right indigo"]) !!}
    </div>

    <div class="col s12">
        <div class="clearfix"></div>
    </div>
</div>