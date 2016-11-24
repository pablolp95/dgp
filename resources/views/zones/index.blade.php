@extends('index')

@section('title')
    Lista de Zonas
@endsection

@section('elem_title')
    Zonas
@endsection

@section('elem_description')
    @if(isset($_GET["search"]))
        Estos son todas las zonas que coinciden con tu búsqueda. ¿quieres crear un <a href="{!! route('zone.create') !!}">nuevo proyecto</a>?
    @else
        Estos son todas las zonas, ¿quieres crear un <a href="{!! route('zone.create') !!}">nueva zona</a>?
    @endif

@endsection

@section('search')
    @include('_search', ['search_route' => 'zone.search', 'searchbox_text' => 'Buscar una zona ...'])
@endsection

@section('table')
    <thead>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripcion</th>
        <th class="center-align">Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($zones as $zona)
        <tr>
            <td>{{ $zona->id }}</td>
            <td>{{ $zona->name }}</td>
            <td class="date">{{ $zona->description }}</td>
            <td class="center-align">
                <a class="btn-floating btn-large waves-effect waves-light deep-orange tooltipped" href="{{ route('zone.edit', ['id' => $zona->id]) }}" data-position="top" data-delay="50" data-tooltip="Editar zona"><i class="material-icons">create</i></a>
                <a class="btn-floating btn-large waves-effect waves-light indigo tooltipped" href="{{ route('zone.associate.stand', ['id' => $zona->id]) }}" data-position="top" data-delay="50" data-tooltip="Asociar stand"><i class="material-icons">note_add</i></a>
                <a class="btn-floating btn-large waves-effect waves-light red tooltipped" href="{{ route('zone.show', ['id' => $zona->id]) }}" data-position="top" data-delay="50" data-tooltip="Mostrar zona"><i class="material-icons">visibility</i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
@endsection

@section('pagination')
    {!! $zones->appends(Request::only('search'))->render() !!}
@endsection
