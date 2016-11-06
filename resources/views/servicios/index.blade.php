@extends('index')

@section('title')
    Lista de servicios
@endsection

@section('elem_title')
    Servicios
@endsection

@section('elem_description')
    @if(isset($_GET["search"]))
        Estos son todos los servicios que coinciden con tu búsqueda. ¿quieres crear un <a href="{!! route('servicio.create') !!}">nuevo servicio</a>?
    @else
        Estos son todos los servicios, ¿quieres crear un <a href="{!! route('servicio.create') !!}">nuevo servicio</a>?
    @endif

@endsection

@section('search')
    @include('_search', ['search_route' => 'servicio.search', 'searchbox_text' => 'Buscar un servicio...'])
@endsection

@section('table')
    <thead>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th class="truncate">Descripción</th>
        <th>Período de facturación (días)</th>
        <th>Precio</th>
        <th class="center-align">Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($servicios as $servicio)
        <tr>
            <td>{{ $servicio->id }}</td>
            <td>{{ $servicio->name }}</td>
            <td>{{ $servicio->description }}</td>
            <td>{{ $servicio->invoice_period }}</td>
            <td>{{ $servicio->price }}</td>
            <td class="center-align">
                <a class="btn-floating btn-large waves-effect waves-light deep-orange" href="{{ route('servicio.edit', ['id' => $servicio->id]) }}"><i class="material-icons">create</i></a>
                <a class="btn-floating btn-large waves-effect waves-light red" href="{{ route('servicio.show', ['id' => $servicio->id]) }}"><i class="material-icons">visibility</i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
@endsection

@section('pagination')
    {!! $servicios->appends(Request::only('search'))->render() !!}
@endsection