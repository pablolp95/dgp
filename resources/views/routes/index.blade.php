@extends('index')

@section('title')
    Lista de rutas
@endsection

@section('elem_title')
    Rutas
@endsection

@section('elem_description')
    @if(isset($_GET["search"]))
        Estos son todas las rutas que coinciden con tu búsqueda. ¿quieres añadir una <a href="{!! route('route.create') !!}">nueva ruta</a>?
    @else
        Estos son todas las rutas, ¿quieres añadir una <a href="{!! route('route.create') !!}">nueva ruta</a>?
    @endif

@endsection

@section('search')
    @include('_search', ['search_route' => 'route.search', 'searchbox_text' => 'Buscar una ruta...'])
@endsection

@section('table')
    <thead>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Planta</th>
        <th class="center-align">Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($routes as $route)
        <tr>
            <td>{{ $route->id }}</td>
            <td>{{ $route->name }}</td>
            <td>{{$route->floor}}</td>
            <td class="center-align">
                <a class="btn-floating btn-large waves-effect waves-light deep-orange" href="{{ route('route.edit', ['id' => $route->id]) }}"><i class="material-icons">create</i></a>
                <a class="btn-floating btn-large waves-effect waves-light indigo tooltipped" href="{{ route('route.associate.stand', ['id' => $route->id]) }}" data-position="top" data-delay="50" data-tooltip="Asociar stand"><i class="material-icons">note_add</i></a>
                <a class="btn-floating btn-large waves-effect waves-light red" href="{{ route('route.show', ['id' => $route->id]) }}"><i class="material-icons">visibility</i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
@endsection

@section('pagination')
    {!! $routes->appends(Request::only('search'))->render() !!}
@endsection