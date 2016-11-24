<div class="row">

    <!-- Language field -->
    <div class="input-field col s12 m6">
        {!! Form::select("name", ['Español', 'English', 'Alemán'], null, ["id" => "name","class" => "validate"]) !!}
        {!! Form::label("name", "Idioma:*") !!}
    </div>
    
    <div class="col s12">
        {!! Form::button("Guardar", ["type" => "submit", "class" => "btn waves-effect waves-light right indigo"]) !!}
    </div>

    <div class="col s12">
        <div class="clearfix"></div>
    </div>
</div>
