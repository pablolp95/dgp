@extends('index')

@section('title')
    Lista de Stands
@endsection

@section('elem_title')
    Stands
@endsection

@section('elem_description')
    @if(isset($_GET["search"]))
        Estos son todos las stands que coinciden con tu búsqueda. ¿quieres crear un <a href="{!! route('stand.create') !!}">nuevo stand</a>?
    @else
        Estos son todos las stands, ¿quieres crear un <a href="{!! route('stand.create') !!}">nuevo stand</a>?
    @endif

@endsection

@section('search')
    @include('_search', ['search_route' => 'stand.search', 'searchbox_text' => 'Buscar un stand ...'])
@endsection

@section('table')
    <thead>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th class="center-align">Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($stands as $stand)
        <tr>
            <td>{{ $stand->id }}</td>
            <td>{{ $stand->name }}</td>
            <td class="center-align">
                <a class="btn-floating btn-large waves-effect waves-light deep-orange tooltipped" href="{{ route('stand.edit', ['id' => $stand->id]) }}" data-position="top" data-delay="50" data-tooltip="Editar"><i class="material-icons">create</i></a>
                <a class="btn-floating btn-large waves-effect waves-light red tooltipped" href="{{ route('stand.show', ['id' => $stand->id]) }}" data-position="top" data-delay="50" data-tooltip="Mostrar stand"><i class="material-icons">visibility</i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
@endsection

@section('pagination')
    {!! $stands->appends(Request::only('search'))->render() !!}
@endsection
