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
    @foreach($videos as $videos)
        <tr>
            <td>{{ $videos->id }}</td>
            <td>{{ $videos->name }}</td>
            <td class="truncate">{{ $videos->description }}</td>
            <td>{{ $videos->language }}</td>
            <td class="center-align">
                <a class="btn-floating btn-large waves-effect waves-light deep-orange" href="{{ route('video.edit', ['id' => $videos->id]) }}"><i class="material-icons">create</i></a>
                <a class="btn-floating btn-large waves-effect waves-light red" href="{{ route('video.show', ['id' => $videos->id]) }}"><i class="material-icons">visibility</i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
@endsection
