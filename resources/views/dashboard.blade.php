<?php
$dashboard_elems = [
        route('stand.create') => ['add_database', 'Crear stand',['empleado','admin','superadmin']],
        route('stand.index') => ['database', 'Stands',['empleado','admin','superadmin']],
        route('zone.create') => ['opened_folder', 'Crear zona',['empleado','admin','superadmin']],
        route('zone.index') => ['zone', 'Zonas',['empleado','admin','superadmin']],
        route('route.create') => ['opened_folder', 'Crear ruta', ['empleado','admin','superadmin']],
        route('route.index') => ['route', 'Rutas', ['empleado','admin','superadmin']],
        route('image.create') => ['add_image', 'Añadir imágenes', ['empleado','admin','superadmin']],
        route('image.index') => ['image_file', 'Imágenes', ['empleado','admin','superadmin']],
        route('audio.create') => ['add_audio_file', 'Añadir audio', ['empleado','admin','superadmin']],
        route('audio.index') => ['audio_file', 'Audios', ['empleado','admin','superadmin']],
        route('video.create') => ['add_video_file','Añadir vídeos',['empleado','admin','superadmin']],
        route('video.index') => ['video_file','Vídeos',['empleado','admin','superadmin']],
        route('language.create') => ['add_globe','Añadir idioma',['empleado','admin','superadmin']],
        route('language.index') => ['globe','Idiomas',['empleado','admin','superadmin']],
        route('usuario.create') => ['key', 'Crear usuario', ['admin','superadmin']],
        route('usuario.index') => ['address_book', 'Usuarios', ['admin','superadmin']]
];
$i=1;
?>
@extends('main')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="container">
        <div class="row padded">
            <div class="col s12">
                <div class="row">
                    <div class="col s12">
                        <h1 class="grey-text text-darken-4">Bienvenido a tu panel, {{ $name }}</h1>
                        <h5 class="grey-text text-darken-1">¿Qué deseas hacer?</h5>
                    </div>
                </div>
                <div class="row">
                    @foreach($dashboard_elems as $url => $elem)
                        <?php $can_see = false; ?>
                        @foreach($elem[2] as $role)
                            <?php (Entrust::hasRole($role)) ? $can_see = true : null; ?>
                        @endforeach
                        @if($can_see)
                            @if($i%4 == 0)<div class="row"> @endif
                            <a href="{!! $url !!}">
                                <div class="col s12 m4 l3 dashboard-item">
                                    <div class="dashboard-item-icon">
                                        <img src="/img/{{ $elem[0] }}.svg">
                                    </div>
                                    <div class="dashboard-item-text center-align uppercase">
                                        {{ $elem[1] }}
                                    </div>
                                </div>
                            </a>
                            @if($i%4 == 0) </div> @endif
                            <?php $i++; ?>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        initHome();
    </script>
@endsection