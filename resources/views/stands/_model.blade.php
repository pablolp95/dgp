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
            {!! Form::label("language", "Idioma:*") !!}
        </div>
        <!-- Add language Trigger -->
        <div class="input-field col s6 m6">
            {!! Form::button("Añadir idioma", ["type" => "button", "class" => "btn waves-effect waves-light right indigo", "id" => "add-language"]) !!}
        </div>
    </div>
    <!-- Languages tabs -->
    <div class="col s12">
        <ul class="tabs tabs-fixed-width" id="tabs">
            <li class="tab"><a class="active" href="#1">Test 1</a></li>
            <li class="tab"><a href="#2">Test 2</a></li>
        </ul>
    </div>
    <!-- Text for selected language -->
    <div class="col s12" id="content">
        <div id="1">
            <div class="input-field">
                <input id="title" class="validate" name="texts[1][title]" type="text">
                <label for="title">Titulo del stand:*</label>
            </div>
            <!-- Description field -->
            <div class="input-field">
                <textarea id="description" class="materialize-textarea" name="texts[1][description]" cols="50" rows="10"></textarea>
                <label for="description">Descripción del stand:*</label>
            </div>
        </div>
        <div id="2">
            <div class="input-field">
                <input id="title" class="validate" name="texts[2][title]" type="text">
                <label for="title">Titulo del stand:*</label>
            </div>
            <!-- Description field -->
            <div class="input-field">
                <textarea id="description" class="materialize-textarea" name="texts[2][description]" cols="50" rows="10"></textarea>
                <label for="description">Descripción del stand:*</label>
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