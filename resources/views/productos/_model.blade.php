<div class="row">
    <!-- Name field -->
    <div class="input-field col s12 m6">
        {!! Form::text("name", null, ["id" => "name","class" => "validate"]) !!}
        {!! Form::label("name", "Nombre de producto:*") !!}
    </div>

    <!-- Price field -->
    <div class="input-field col s12 m6">
        {!! Form::text("price", null, ["id" => "price","class" => "validate"]) !!}
        {!! Form::label("price", "Precio:*") !!}
    </div>

    <!-- Description field -->
    <div class="input-field col s12">
        {!! Form::textarea("description", null, ["id" => "description","class" => "materialize-textarea"]) !!}
        {!! Form::label("description", "Descripción de producto") !!}
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

    <!-- Status field -->
    <div class="input-field col s12">
        {!! Form::text("status", null, ["id" => "status","class" => "validate"]) !!}
        {!! Form::label("status", "Estado del producto:") !!}
    </div>
    
    <div class="col s12">
        {!! Form::button("Guardar", ["type" => "submit", "class" => "btn waves-effect waves-light right indigo"]) !!}
    </div>

    <div class="col s12">
        <div class="clearfix"></div>
    </div>
</div>
