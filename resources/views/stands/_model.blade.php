<div class="row">
    <!-- Name field -->
    <div class="input-field col s12 m6">
        {!! Form::text("name", null, ["id" => "name","class" => "validate"]) !!}
        {!! Form::label("name", "Nombre del stand:*") !!}
    </div>
    <div class="input-field col s12 m6">
        <!-- Modal Trigger -->
        <a class="btn waves-effect waves-light right indigo" href="#modal1">Añadir idioma</a>

        <!-- Modal Structure -->
        <div id="modal1" class="modal">
            <div class="modal-content">
                <h4>Modal Header</h4>
                <p>A bunch of text</p>
            </div>
            <div class="modal-footer">
                <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
            </div>
        </div>

    </div>
    <!-- Languages selected tabs -->
    <div class="col s12">
        <ul class="tabs">
            <li class="tab col s3 "><a href="#test1">Test 1</a></li>
            <li class="tab col s3"><a class="active " href="#test2">Test 2</a></li>
            <li class="tab col s3 "><a href="#test3">Test 3</a></li>
            <li class="tab col s3"><a href="#test4">Test 4</a></li>
        </ul>
    </div>
    <!-- Text for selected language -->
    <div class="col s12" id="texts">

    </div>

    <div class="col s12">
        {!! Form::button("Guardar", ["type" => "submit", "class" => "btn waves-effect waves-light right indigo"]) !!}
    </div>

    <div class="col s12">
        <div class="clearfix"></div>
    </div>
</div>