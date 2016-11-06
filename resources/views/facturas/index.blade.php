@extends('index')

@section('title')
    Lista de facturas
@endsection

@section('elem_title')
    Facturas
@endsection

@section('elem_description')
    @if(isset($_GET["search"]))
        Estas son todas las facturas que coinciden con tu búsqueda. ¿quieres crear una <a href="{!! route('factura.create') !!}">nueva factura</a>?
    @else
        Estas son todas las facturas, ¿quieres crear una <a href="{!! route('factura.create') !!}">nueva factura</a>?
    @endif

@endsection

@section('search')
    @include('_search', ['search_route' => 'factura.search', 'searchbox_text' => 'Buscar un factura...'])
@endsection

@section('table')
    <thead>
    <tr>
        <th>ID</th>
        <th class="center-align">Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($facturas as $factura)
        <tr>
            <td>{{ $factura->id }}</td>
            <td class="center-align">
                <a class="btn-floating btn-large waves-effect waves-light deep-orange" href="{{ route('factura.edit', ['id' => $factura->id]) }}"><i class="material-icons">create</i></a>
                <a class="btn-floating btn-large waves-effect waves-light red" href="{{ route('factura.show', ['id' => $factura->id]) }}"><i class="material-icons">visibility</i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
@endsection

@section('pagination')
    {!! $facturas->appends(Request::only('search'))->render() !!}
@endsection