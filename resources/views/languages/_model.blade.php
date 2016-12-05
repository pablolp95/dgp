<div class="row">

    <!-- Language field -->
    <div class="input-field col s12 m6">
        {!! Form::select("language_code", App\Language::$languages, null, ["id" => "language_code","class" => "validate"]) !!}
        {!! Form::label("language", "Idioma:*") !!}
    </div>
    
    <div class="col s12">
        {!! Form::button("Guardar", ["type" => "submit", "class" => "btn waves-effect waves-light right indigo"]) !!}
    </div>

    <div class="col s12">
        <div class="clearfix"></div>
    </div>
</div>
