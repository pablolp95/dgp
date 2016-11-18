<?php
$dashboard_elems = [
        route('stand.create') => ['deployment', 'Crear stand',['empleado','admin']],
        route('stand.index') => ['add_database', 'Stands',['empleado','admin']],
        route('zone.create') => ['shop', 'Crear zona',['empleado','admin']],
        route('zone.index') => ['accept_database', 'Zonas',['empleado','admin']],
        route('route.create') => ['opened_folder', 'Crear ruta', ['empleado','admin']],
        route('route.index') => ['idea', 'Rutas', ['empleado','admin']],
        route('image.create') => ['contacts', 'Añadir imágenes', ['empleado','admin']],
        route('image.index') => ['image_file', 'Imágenes', ['empleado','admin']],
        route('audio.create') => ['filing_cabinet', 'Añadir audio', ['empleado','admin']],
        route('audio.index') => ['audio_file', 'Audios', ['empleado','admin']],
        route('video.create') => ['money_transfer','Añadir vídeos',['empleado','admin']],
        route('video.index') => ['video_file','Vídeos',['empleado','admin']],
        route('usuario.create') => ['key', 'Crear usuario', ['admin']],
        route('usuario.index') => ['address_book', 'Usuarios', ['admin']]
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
                                        <img src="/components/flat-color-icons/svg/{{ $elem[0] }}.svg">
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