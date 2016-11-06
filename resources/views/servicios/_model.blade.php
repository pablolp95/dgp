<div class="row">
    <!-- Name field -->
    <div class="input-field col s12 m6">
        {!! Form::text("name", null, ["id" => "name","class" => "validate"]) !!}
        {!! Form::label("name", "Nombre de servicio:*") !!}
    </div>

    <!-- Price field -->
    <div class="input-field col s12 m6">
        {!! Form::text("price", null, ["id" => "price","class" => "validate"]) !!}
        {!! Form::label("price", "Precio:*") !!}
    </div>

    <!-- Description field -->
    <div class="input-field col s12">
        {!! Form::textarea("description", null, ["id" => "description","class" => "materialize-textarea"]) !!}
        {!! Form::label("description", "Descripción de servicio") !!}
    </div>

    <!-- IMG_URL field -->
    <div class="input-field col s12 m6">
        {!! Form::text("img_url", null, ["id" => "img_url","class" => "validate"]) !!}
        {!! Form::label("img_url", "URL de imagen:") !!}
    </div>

    <!-- DEvelopment Time field -->
    <div class="input-field col s12 m6">
        {!! Form::text("development_time", null, ["id" => "development_time","class" => "validate"]) !!}
        {!! Form::label("development_time", "Tiempo de desarrollo:") !!}
    </div>

    <!-- Starting date field -->
    <div class="col s12 m6">
        {!! Form::label("starting_date", "Fecha de inicio del servicio:") !!}
        {!! Form::date("starting_date", null, ["id" => "starting_date","class" => "datepicker"]) !!}

    </div>

    <!-- Ending date field -->
    <div class="col s12 m6">
        {!! Form::label("ending_date", "Fecha de fin de servicio:") !!}
        {!! Form::date("ending_date", null, ["id" => "ending_date", "class" => "datepicker"]) !!}
    </div>

    <!-- Invoice Period field -->
    <div class="input-field col s12">
        {!! Form::text("invoice_period", null, ["id" => "invoice_period", "class" => "validate"]) !!}
        {!! Form::label("invoice_period", "Período de facturación (en días):") !!}
    </div>

    <!-- Status field -->
    <div class="input-field col s12">
        {!! Form::text("status", null, ["id" => "status","class" => "validate"]) !!}
        {!! Form::label("status", "Estado del servicio:") !!}
    </div>
    
    <div class="col s12">
        {!! Form::button("Guardar", ["type" => "submit", "class" => "btn waves-effect waves-light right indigo"]) !!}
    </div>

    <div class="col s12">
        <div class="clearfix"></div>
    </div>
</div>
