@extends("show")

@section('title')
    Mostrando a {{ $stand->name }}
@endsection

@section("resource_title")
    Stand {{ $stand->id }} - {{ $stand->name }}
@endsection

@section("data")
    <div class="row">
        <div class="col s12 m6">
            <p><strong>Creado el:</strong> {{ $stand->created_at }}</p>
            <p><strong>Última modificación:</strong> {{ $stand->updated_at }}</p>
        </div>
        <div class="col m6">
            <p><strong>ID del usuario que lo creó:</strong> {{ $stand->user_id }}</p>
            <p><strong>ID del usuario de su última modificación:</strong> {{ $stand->last_update_user_id }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col s12 m5">
            <p><strong>Nombre:</strong> {{ $stand->name }}</p>
        </div>

        <div class="col s12 m4">
            <p><strong>Zona asociada:</strong> {{ $stand->zone_id}}</p>
        </div>
        <div class="col s12 m3">
            <p><strong>Ruta asociada:</strong> {{ $stand->route_id}}</p>
        </div>
    </div>
    <div class="row">
        <div class="col s12 m3">
            <p><strong>Contenido asociado:</strong></p>
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
                                    <input disabled id='title' class='validate' name='texts[{{ $language_id }}][title]' type='text' value="{{ $text->title }}">
                                    <label for='title'>Título del stand:*</label>
                                </div>
                                <!-- Description field -->
                                <div class='input-field'>
                                    <textarea disabled id='description' class='materialize-textarea' name='texts[{{ $language_id }}][description]' cols='50' rows='10'> {{ $text->description }} </textarea>
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
                                                    <li class='collection-item'> {{$video->name}} </li>
                                                @endif
                                            @endforeach
                                            @if(!$exist)
                                                <li id='video-label' class='collection-item'><label>Ningún vídeo asociado</label></li>
                                            @endif
                                        @else
                                            <li id='video-label' class='collection-item'><label>Ningún vídeo asociado</label></li>
                                        @endif
                                    </ul>
                                </div>
                                <div class='col s12 no-padding'>
                                    <h6 style='color:#9E9E9E'>Audios asociados</h6>
                                    <ul id='audio-list-{{ $language_id }}' class='list collection with-header'>
                                        <?php $exist = false ?>
                                        @if(isset($audio) && !$audio->isEmpty())
                                            @foreach($audio as $audioResource)
                                                @if($audioResource->language_id == $language_id)
                                                    <?php $exist = true ?>
                                                    <li class='collection-item'> {{$audioResource->name}} </li>
                                                @endif
                                            @endforeach
                                            @if(!$exist)
                                                <li id='video-label' class='collection-item'><label>Ningún audio asociado</label></li>
                                            @endif
                                        @else
                                            <li id='audio-label' class='collection-item'><label>Ningún audio asociado</label></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endforeach
            @endif
        </div>
    </div>
    <!-- Associate images -->
    <div class="col s12 z-depth-2" id="images" style="margin:15px 0 15px 0;padding:22.25px;">
        <div class='col s12 no-padding'>
            <h6 style='color:#9E9E9E'>Imágenes asociadas</h6>
            <ul id='image-list' class='list collection with-header'>
                @if(isset($images) && !$images->isEmpty())
                    @foreach($images as $image)
                        <li class='collection-item'> {{$image->name}} </li>
                    @endforeach
                @else
                    <li id='image-label' class='collection-item'><label>Ninguna imagen asociada</label></li>
                @endif
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col s12 m5">
            <p><strong>Código QR:</strong></p>
            <img alt="QrStand" src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate('http://ec2-52-59-235-58.eu-central-1.compute.amazonaws.com/api/stand/'.$stand->id)) !!} ">
        </div>
    </div>
@endsection
