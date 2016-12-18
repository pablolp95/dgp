<div class="row">
    <!-- Name field -->
    <div class="input-field col s12 m6">
        {!! Form::text("name", null, ["id" => "name","class" => "validate"]) !!}
        {!! Form::label("name", "Nombre del stand:*") !!}
    </div>
    <div class="col s12 m6">
        <!-- Language field -->
        <div class="input-field col s6 m6">
            {!! Form::select("language_id", $languages, null, ["id" => "language_id"]) !!}
            {!! Form::label("language", "Idioma:") !!}
        </div>
        <!-- Add language Trigger -->
        <div class="col s6 m6">
            {!! Form::button("Añadir contenido", ["type" => "button", "class" => "btn waves-effect waves-light right indigo", "id" => "addTrigger"]) !!}
        </div>
    </div>
    <div class="col s12 z-depth-3" id="languages">
        <!-- Languages tabs -->
        <div class="col s12">
            <ul class="tabs" id="tabs">
            </ul>
        </div>
        <!-- Text for selected language -->
        <div class="col s12" id="stand-texts">
            <div class="input-field col s6 m6 offset-m6 offset-s6" id="deleteLanguage">
                <!-- Delete language Trigger -->
                {!! Form::button("Eliminar idioma", ["type" => "button", "class" => "btn waves-effect waves-light right indigo", "id" => "deleteTrigger"]) !!}
            </div>
        </div>
    </div>

    <div class="col s12">
        {!! Form::button("Guardar", ["type" => "submit", "class" => "btn waves-effect waves-light right indigo"]) !!}
    </div>

    <div class="col s12">
        <div class="clearfix"></div>
    </div>
</div>