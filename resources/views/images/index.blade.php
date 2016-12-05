@extends('index')

@section('title')
    Lista de imágenes
@endsection

@section('elem_title')
    Imagen
@endsection

@section('elem_description')
    @if(isset($_GET["search"]))
        Estas son todas las imágenes que coinciden con tu búsqueda, ¿quieres añadir una <a href="{!! route('image.create') !!}">nueva imagen</a>?
    @else
        Estas son todas las imágenes, ¿quieres añadir un <a href="{!! route('image.create') !!}">nueva imagen</a>?
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
    @foreach($images as $image)
        <tr>
            <td>{{ $image->id }}</td>
            <td>{{ $image->name }}</td>
            <td class="truncate">{{ $image->description }}</td>
            <td class="center-align">
                <a class="btn-floating btn-large waves-effect waves-light deep-orange tooltipped" href="{{ route('image.edit', ['id' => $image->id]) }}" data-position="top" data-delay="50" data-tooltip="Editar imagen"><i class="material-icons">create</i></a>
                <a class="btn-floating btn-large waves-effect waves-light red tooltipped" href="{{ route('image.show', ['id' => $image->id]) }}" data-position="top" data-delay="50" data-tooltip="Mostrar imagen"><i class="material-icons">visibility</i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
@endsection
