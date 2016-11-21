@extends('index')

@section('title')
    Lista de imagenes
@endsection

@section('elem_title')
    Imagen
@endsection

@section('elem_description')
    @if(isset($_GET["search"]))
        Estos son todos las imagenes que coinciden con tu búsqueda. ¿quieres añadir un <a href="{!! route('image.create') !!}">nueva imagen</a>?
    @else
        Estos son todos las imagenes, ¿quieres añadir un <a href="{!! route('image.create') !!}">nuevo video</a>?
    @endif

@endsection

@section('search')
    @include('_search', ['search_route' => 'image.search', 'searchbox_text' => 'Buscar una imagen...'])
@endsection

@section('table')
    <thead>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th class="center-align">Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($image as $image)
        <tr>
            <td>{{ $image->id }}</td>
            <td>{{ $image->name }}</td>
            <td class="truncate">{{ $image->description }}</td>
            <td class="center-align">
                <a class="btn-floating btn-large waves-effect waves-light deep-orange" href="{{ route('image.edit', ['id' => $image->id]) }}"><i class="material-icons">create</i></a>
                <a class="btn-floating btn-large waves-effect waves-light red" href="{{ route('image.show', ['id' => $image->id]) }}"><i class="material-icons">visibility</i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
@endsection
