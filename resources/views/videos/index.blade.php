@extends('index')

@section('title')
    Lista de videos
@endsection

@section('elem_title')
    Videos
@endsection

@section('elem_description')
    @if(isset($_GET["search"]))
        Estos son todos los videos que coinciden con tu búsqueda. ¿quieres añadir un <a href="{!! route('video.create') !!}">nuevo video</a>?
    @else
        Estos son todos los videos, ¿quieres añadir un <a href="{!! route('video.create') !!}">nuevo video</a>?
    @endif

@endsection

@section('search')
    @include('_search', ['search_route' => 'video.search', 'searchbox_text' => 'Buscar un video...'])
@endsection

@section('table')
    <thead>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Lenguaje</th>
        <th class="center-align">Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($videos as $video)
        <tr>
            <td>{{ $video->id }}</td>
            <td>{{ $video->name }}</td>
            <td class="truncate">{{ $video->description }}</td>
            <td>{{ $video->language }}</td>
            <td class="center-align">
                <a class="btn-floating btn-large waves-effect waves-light deep-orange tooltipped" href="{{ route('video.edit', ['id' => $video->id]) }}" data-position="top" data-delay="50" data-tooltip="Editar video"><i class="material-icons">create</i></a>
                <a class="btn-floating btn-large waves-effect waves-light red tooltipped" href="{{ route('video.show', ['id' => $video->id]) }}" data-position="top" data-delay="50" data-tooltip="Mostrar video"><i class="material-icons">visibility</i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
@endsection
