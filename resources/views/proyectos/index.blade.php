@extends('index')

@section('title')
    Lista de proyectos
@endsection

@section('elem_title')
    Proyectos
@endsection

@section('elem_description')
    @if(isset($_GET["search"]))
        Estos son todos los proyectos que coinciden con tu búsqueda. ¿quieres crear un <a href="{!! route('proyecto.create') !!}">nuevo proyecto</a>?
    @else
        Estos son todos los proyectos, ¿quieres crear un <a href="{!! route('proyecto.create') !!}">nuevo proyecto</a>?
    @endif

@endsection

@section('search')
    @include('_search', ['search_route' => 'proyecto.search', 'searchbox_text' => 'Buscar un proyecto...'])
@endsection

@section('table')
    <thead>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Fecha</th>
        <th class="center-align">Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($proyectos as $proyecto)
        <tr>
            <td>{{ $proyecto->id }}</td>
            <td>{{ $proyecto->name }}</td>
            <td class="date">{{ $proyecto->created_at }}</td>
            <td class="center-align">
                <a class="btn-floating btn-large waves-effect waves-light deep-orange tooltipped" href="{{ route('proyecto.edit', ['id' => $proyecto->id]) }}" data-position="top" data-delay="50" data-tooltip="Editar"><i class="material-icons">create</i></a>
                <a class="btn-floating btn-large waves-effect waves-light indigo tooltipped" href="{{ route('proyecto.associate.invoice', ['id' => $proyecto->id]) }}" data-position="top" data-delay="50" data-tooltip="Asociar factura"><i class="material-icons">receipt</i></a>
                <a class="btn-floating btn-large waves-effect waves-light indigo tooltipped" href="{{ route('proyecto.associate.proposal', ['id' => $proyecto->id]) }}" data-position="top" data-delay="50" data-tooltip="Asociar presupuesto"><i class="material-icons">note_add</i></a>
                <a class="btn-floating btn-large waves-effect waves-light red" href="{{ route('proyecto.show', ['id' => $proyecto->id]) }}"><i class="material-icons">visibility</i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
@endsection

@section('pagination')
    {!! $proyectos->appends(Request::only('search'))->render() !!}
@endsection
