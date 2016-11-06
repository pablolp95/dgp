@extends('index')

@section('title')
    Lista de presupuestos
@endsection

@section('elem_title')
    Presupuestos
@endsection

@section('elem_description')
    @if(isset($_GET["search"]))
        Estos son todos los presupuestos que coinciden con tu búsqueda. ¿quieres crear un <a href="{!! route('presupuesto.create') !!}">nuevo presupuesto</a>?
    @else
        Estos son todos los presupuestos, ¿quieres crear un <a href="{!! route('presupuesto.create') !!}">nuevo presupuesto</a>?
    @endif

@endsection

@section('search')
    @include('_search', ['search_route' => 'presupuesto.search', 'searchbox_text' => 'Buscar un presupuesto...'])
@endsection

@section('table')
    <thead>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Fecha</th>
        <th>Importe total</th>
        <th class="center-align">Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($presupuestos as $presupuesto)
        <tr>
            <td>{{ $presupuesto->id }}</td>
            <td>{{ $presupuesto->name }}</td>
            <td class="date">{{ $presupuesto->created_at }}</td>
            <td>{{ $presupuesto->total_amount }}</td>
            <td class="center-align">
                <a class="btn-floating btn-large waves-effect waves-light deep-orange" href="{{ route('presupuesto.edit', ['id' => $presupuesto->id]) }}"><i class="material-icons">create</i></a>
                <a class="btn-floating btn-large waves-effect waves-light indigo tooltipped" href="{{ route('presupuesto.associate.invoice', ['id' => $presupuesto->id]) }}" data-position="top" data-delay="50" data-tooltip="Asociar factura"><i class="material-icons">receipt</i></a>
                <a class="btn-floating btn-large waves-effect waves-light red" href="{{ route('presupuesto.show', ['id' => $presupuesto->id]) }}"><i class="material-icons">visibility</i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
@endsection

@section('pagination')
    {!! $presupuestos->appends(Request::only('search'))->render() !!}
@endsection