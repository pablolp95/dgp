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
            <a class="btn waves-effect waves-light right indigo" href="#modal1">Añadir idioma</a>
        </div>
    </div>
    <!-- Languages selected tabs -->
    <div class="col s12">
        <ul class="tabs tabs-fixed-width">
            <li class="tab"><a class="active" href="#1">Test 1</a></li>
            <li class="tab"><a href="#test2">Test 2</a></li>
        </ul>
    </div>
    <!-- Text for selected language -->
    <div id="texts">
        <div class="col s12" id="1">
            <div class="input-field col s12 m6">
                {!! Form::text("title", null, ["id" => "title","class" => "validate"]) !!}
                {!! Form::label("title", "Titulo del stand:*") !!}
            </div>
            <!-- Description field -->
            <div class="input-field col s12">
                {!! Form::textarea("description", null, ["id" => "description","class" => "materialize-textarea"]) !!}
                {!! Form::label("description", "Descripción del stand:*") !!}
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