<div class="row">
    <!-- Name field -->
    <div class="input-field col s12 m6">
        {!! Form::text("name", null, ["id" => "name","class" => "validate"]) !!}
        {!! Form::label("name", "Nombre de la zona:*") !!}
    </div>

    <div class="input-field col s12">
        {!! Form::textarea("description", null, ["id" => "description","class" => "materialize-textarea"]) !!}
        {!! Form::label("description", "Descripción de la zona ") !!}
    </div>

    <div class="input-field col s8">
        {!! Form::textarea("thematic", null, ["id" => "thematic","class" => "materialize-textarea"]) !!}
        {!! Form::label("thematic", "Temática de la zona  ") !!}
    </div>

    <div class="input-field col s4">
        {!! Form::textarea("floor", null, ["id" => "floor","class" => "materialize-textarea"]) !!}
        {!! Form::label("floor", "Nº Planta ") !!}
    </div>

    <!-- Associate stands -->
    <div class="col s12 z-depth-2" id="stands" style="margin:15px 0 15px 0;padding:22.25px;">
        <div class='col s12 no-padding'>
            <h6 style='color:#9E9E9E'>Stands asociados</h6>
            <ul id='stand-list' class='list collection with-header'>
                @if(isset($stands) && !$stands->isEmpty())
                    @foreach($stands as $stand)
                        <li class='collection-item'><input type="hidden" name="stands[]" value="{{ $stand->id }}"> {{$stand->name}} <a href="#!" class="delete-image-resource secondary-content"><i class="material-icons">delete</i></a></li>
                    @endforeach
                @else
                    <li id='stand-label' class='collection-item'><label>Asociar un nuevo stand...</label></li>
                @endif
            </ul>
        </div>
        <button type='button' id='show-stands-zones' class='waves-effect waves-light btn indigo left'>Mostrar stands</button>
    </div>

    <!-- Stand Modal Structure -->
    <div id="stand-response-modal" class="modal modal-fixed-footer">
        <div class="modal-content">
            <h4>Recursos disponibles</h4>
            <ul id="stand-response-container" class='collection'>
            </ul>
        </div>
        <div class="modal-footer">
            <a class="left modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
            <button type='button' id='stand-modal-confirm' class='waves-effect waves-light btn-flat'>Confirmar</button>
        </div>
    </div>

    <div class="col s12">
        {!! Form::button("Guardar", ["type" => "submit", "class" => "btn waves-effect waves-light right indigo"]) !!}
    </div>

    <div class="col s12">
        <div class="clearfix"></div>
    </div>
</div>