@extends('index')

@section('title')
    Lista de clientes
@endsection

@section('elem_title')
    Clientes
@endsection

@section('elem_description')
    @if(isset($_GET["search"]))
        Estos son todos los clientes que coinciden con tu búsqueda. ¿quieres crear un <a href="{!! route('cliente.create') !!}">nuevo cliente</a>?
    @else
        Estos son todos los clientes, ¿quieres crear un <a href="{!! route('cliente.create') !!}">nuevo cliente</a>?
    @endif

@endsection

@section('search')
    @include('_search', ['search_route' => 'cliente.search', 'searchbox_text' => 'Buscar un cliente...'])
@endsection

@section('table')
    <thead>
    <tr>
        <th>ID</th>
        <th>Email</th>
        <th>Nombre</th>
        <th>NIF</th>
        <th class="center-align">Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($clientes as $cliente)
        <tr>
            <td>{{ $cliente->id }}</td>
            <td>{{ $cliente->email }}</td>
            <td>{{ $cliente->name }}</td>
            <td>{{ $cliente->nif }}</td>
            <td class="center-align">
                <a class="btn-floating btn-large waves-effect waves-light deep-orange" href="{{ route('cliente.edit', ['id' => $cliente->id]) }}"><i class="material-icons">create</i></a>
                <a class="btn-floating btn-large waves-effect waves-light red" href="{{ route('cliente.show', ['id' => $cliente->id]) }}"><i class="material-icons">visibility</i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
@endsection

@section('pagination')
    {!! $clientes->appends(Request::only('search'))->render() !!}
@endsection