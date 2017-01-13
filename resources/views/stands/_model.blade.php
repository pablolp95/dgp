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
    <div class="col s12 z-depth-2" id="languages" @if(isset($texts) && !$texts->isEmpty()) style="display:block" @endif>
        <!-- Languages tabs -->
        <div class="col s12">
            <ul class="tabs" id="tabs">
                @if(isset($texts))
                    @foreach($languages as $language_id => $language)
                        @foreach($texts as $text)
                            @if($text->language_id == $language_id)
                <li class='tab'><a href='#{{ $language_id }}'>{{ $language }}</a></li>
                            @endif
                        @endforeach
                    @endforeach
                @endif
            </ul>
        </div>
        <!-- Content for languages tabs -->
        <div class="col s12" id="stand-texts">
            @if(isset($texts) && !$texts->isEmpty())
                @foreach($languages as $language_id => $language)
                    @foreach($texts as $text)
                        @if($text->language_id == $language_id)
                            <div id='{{ $text->language_id }}'>
                                <div class='input-field'>
                                    <input id='title' class='validate' name='texts[{{ $language_id }}][title]' type='text' value="{{ $text->title }}">
                                    <label for='title'>Título del stand:*</label>
                                </div>
                                <!-- Description field -->
                                <div class='input-field'>
                                    <textarea id='description' class='materialize-textarea' name='texts[{{ $language_id }}][description]' cols='50' rows='10' value="{{ $text->description }}"></textarea>
                                    <label for='description'>Descripción del stand:*</label>
                                </div>
                                <div class='col s12 no-padding'>
                                    <h6 style='color:#9E9E9E'>Vídeos asociados</h6>
                                    <ul id='video-list-{{ $language_id }}' class='list collection with-header'>
                                        <?php $exist = false ?>
                                        @if(isset($videos) && !$videos->isEmpty())
                                            @foreach($videos as $video)
                                                @if($video->language_id == $language_id)
                                                    <?php $exist = true ?>
                                                    <li class='collection-item'><input type="hidden" name="videos[]" value="{{ $video->id }}"> {{$video->name}} <a href="#!" class="delete-video-resource secondary-content"><i class="material-icons">delete</i></a></li>
                                                @endif
                                            @endforeach
                                                @if(!$exist)
                                                    <li id='video-label' class='collection-item'><label>Asociar un nuevo vídeo...</label></li>
                                                @endif
                                        @else
                                            <li id='video-label' class='collection-item'><label>Asociar un nuevo vídeo...</label></li>
                                        @endif
                                    </ul>
                                </div>
                                <button type='button' id='show-videos' class='waves-effect waves-light btn indigo left'>Mostrar vídeos</button>
                                <div class='col s12 no-padding'>
                                    <h6 style='color:#9E9E9E'>Audios asociados</h6>
                                    <ul id='audio-list-{{ $language_id }}' class='list collection with-header'>
                                        <?php $exist = false ?>
                                        @if(isset($audio) && !$audio->isEmpty())
                                            @foreach($audio as $audioResource)
                                                @if($audioResource->language_id == $language_id)
                                                        <?php $exist = true ?>
                                                    <li class='collection-item'><input type="hidden" name="audios[]" value="{{ $audioResource->id }}"> {{$audioResource->name}} <a href="#!" class="delete-audio-resource secondary-content"><i class="material-icons">delete</i></a></li>
                                                @endif
                                            @endforeach
                                                @if(!$exist)
                                                    <li id='video-label' class='collection-item'><label>Asociar un nuevo audio...</label></li>
                                                @endif
                                        @else
                                            <li id='audio-label' class='collection-item'><label>Asociar un nuevo audio...</label></li>
                                        @endif
                                    </ul>
                                </div>
                                <button type='button' id='show-audio' class='waves-effect waves-light btn indigo left'>Mostrar audios</button>
                            </div>
                        @endif
                    @endforeach
                @endforeach
            @endif
            <div class="input-field col s6 m6 offset-m6 offset-s6" id="deleteLanguage">
                <!-- Delete language Trigger -->
                {!! Form::button("Eliminar idioma", ["type" => "button", "class" => "btn waves-effect waves-light right indigo", "id" => "deleteTrigger"]) !!}
            </div>
        </div>
    </div>
    <!-- Associate images -->
    <div class="col s12 z-depth-2" id="images" style="margin:15px 0 15px 0;padding:22.25px;">
        <div class='col s12 no-padding'>
            <h6 style='color:#9E9E9E'>Imágenes asociadas</h6>
            <ul id='image-list' class='list collection with-header'>
                @if(isset($images) && !$images->isEmpty())
                    @foreach($images as $image)
                            <li class='collection-item'><input type="hidden" name="images[]" value="{{ $image->id }}"> {{$image->name}} <a href="#!" class="delete-image-resource secondary-content"><i class="material-icons">delete</i></a></li>
                    @endforeach
                @else
                    <li id='image-label' class='collection-item'><label>Asociar una nueva imagen...</label></li>
                @endif
            </ul>
        </div>
        <button type='button' id='show-images' class='waves-effect waves-light btn indigo left'>Mostrar imágenes</button>
    </div>

    <!-- Video Modal Structure -->
    <div id="video-response-modal" class="modal modal-fixed-footer">
        <div class="modal-content">
            <h4>Recursos disponibles</h4>
            <ul id="video-response-container" class='collection'>
            </ul>
        </div>
        <div class="modal-footer">
            <a class="left modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
            <button type='button' id='video-modal-confirm' class='waves-effect waves-light btn-flat'>Confirmar</button>
        </div>
    </div>
    <!-- Audio Modal Structure -->
    <div id="audio-response-modal" class="modal modal-fixed-footer">
        <div class="modal-content">
            <h4>Recursos disponibles</h4>
            <ul id="audio-response-container" class='collection'>
            </ul>
        </div>
        <div class="modal-footer">
            <a class="left modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
            <button type='button' id='audio-modal-confirm' class='waves-effect waves-light btn-flat'>Confirmar</button>
        </div>
    </div>
    <!-- Image Modal Structure -->
    <div id="image-response-modal" class="modal modal-fixed-footer">
        <div class="modal-content">
            <h4>Recursos disponibles</h4>
            <ul id="image-response-container" class='collection'>
            </ul>
        </div>
        <div class="modal-footer">
            <a class="left modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
            <button type='button' id='image-modal-confirm' class='waves-effect waves-light btn-flat'>Confirmar</button>
        </div>
    </div>

    <div class="col s12">
        {!! Form::button("Guardar", ["type" => "submit", "class" => "btn waves-effect waves-light right indigo"]) !!}
    </div>

    <div class="col s12">
        <div class="clearfix"></div>
    </div>
</div>