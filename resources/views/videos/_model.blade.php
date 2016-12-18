<div class="row">
    <!-- Name field -->
    <div class="input-field col s12 m6">
        {!! Form::text("name", null, ["id" => "name","class" => "validate"]) !!}
        {!! Form::label("name", "Nombre del video:*") !!}
    </div>

    <!-- Language field -->
    <div class="input-field col s12 m3">
        {!! Form::select("language_id", $languages, null, ["id" => "language_id"]) !!}
        {!! Form::label("language", "Idioma:*") !!}
    </div>

    <!-- Mode field -->
    <div class="input-field col s12 m3">
        {!! Form::select("mode", App\Video::$modes, null, ["id" => "mode"]) !!}
        {!! Form::label("mode", "Modo visualización:*") !!}
    </div>

    <!-- Description field -->
    <div class="input-field col s12">
        {!! Form::textarea("description", null, ["id" => "description","class" => "materialize-textarea"]) !!}
        {!! Form::label("description", "Descripción del vídeo") !!}
    </div>

    <!-- Upload file -->
    <div class="file-field input-field col s12">
        <div class="btn indigo">
            <span>Seleccionar fichero</span>
            {!! Form::file('video')!!}
        </div>
        <div class="file-path-wrapper">
            <input class="file-path validate" type="text">
        </div>
    </div>

    <div class="col s12">
        {!! Form::button("Guardar", ["type" => "submit", "class" => "btn waves-effect waves-light right indigo"]) !!}
    </div>

    <div class="col s12">
        <div class="clearfix"></div>
    </div>
</div>
