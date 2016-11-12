@extends('index')

@section('title')
    Lista de audios
@endsection

@section('elem_title')
    Audios
@endsection

@section('elem_description')
    @if(isset($_GET["search"]))
        Estos son todos los audios que coinciden con tu búsqueda. ¿quieres añadir un <a href="{!! route('audio.create') !!}">nuevo audio</a>?
    @else
        Estos son todos los audios, ¿quieres añadir un <a href="{!! route('audio.create') !!}">nuevo audio</a>?
    @endif

@endsection

@section('search')
    @include('_search', ['search_route' => 'audio.search', 'searchbox_text' => 'Buscar un audio...'])
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
    @foreach($audios as $audio)
        <tr>
            <td>{{ $audio->id }}</td>
            <td>{{ $audio->name }}</td>
            <td class="truncate">{{ $audio->description }}</td>
            <td>{{ $audio->language }}</td>
            <td class="center-align">
                <a class="btn-floating btn-large waves-effect waves-light deep-orange" href="{{ route('audio.edit', ['id' => $audio->id]) }}"><i class="material-icons">create</i></a>
                <a class="btn-floating btn-large waves-effect waves-light red" href="{{ route('audio.show', ['id' => $audio->id]) }}"><i class="material-icons">visibility</i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
@endsection

@section('pagination')
    {!! $audios->appends(Request::only('search'))->render() !!}
@endsection