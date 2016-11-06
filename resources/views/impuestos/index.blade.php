@extends('index')

@section('title')
    Lista de impuestos
@endsection

@section('elem_title')
    Impuestos
@endsection

@section('elem_description')
    Estos son todos los impuestos, ¿quieres crear un <a href="{!! route('impuesto.create') !!}">nuevo impuesto</a>?
@endsection

@section('search')
    @include('_search', ['search_route' => 'impuesto.show', 'searchbox_text' => 'Buscar un impuesto...'])
@endsection

@section('table')
    <thead>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Fecha</th>
        <th>Ver</th>
    </tr>
    </thead>
    <tbody>
    @foreach($impuestos as $impuesto)
        <tr>
            <td>{{ $impuesto->id }}</td>
            <td>{{ $impuesto->name }}</td>
            <td>{{ $impuesto->created_at }}</td>
            <td>
                <a class="btn-floating btn-large waves-effect waves-light deep-orange" href="{{ route('impuesto.edit', ['id' => $impuesto->id]) }}"><i class="material-icons">create</i></a>
                <a class="btn-floating btn-large waves-effect waves-light red" href="{{ route('impuesto.show', ['id' => $impuesto->id]) }}"><i class="material-icons">visibility</i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
@endsection

@section('pagination')
    {!! $impuestos->appends(Request::only('search'))->render() !!}
@endsection