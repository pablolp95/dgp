@extends('index')

@section('title')
    Lista de usuarios
@endsection

@section('elem_title')
    Usuarios
@endsection

@section('elem_description')
    @if(isset($_GET["search"]))
        Estos son todos los usuarios que coinciden con tu búsqueda. ¿quieres crear un <a href="{!! route('usuario.create') !!}">nuevo usuario</a>?
    @else
        Estos son todos los usuarios, ¿quieres crear un <a href="{!! route('usuario.create') !!}">nuevo usuario</a>?
    @endif

@endsection

@section('search')
    @include('_search', ['search_route' => 'usuario.search', 'searchbox_text' => 'Buscar un usuario...'])
@endsection

@section('table')
    <thead>
    <tr>
        <th>ID</th>
        <th>Email</th>
        <th>Nombre</th>
        <th>Rol</th>
        <th class="center-align">Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($usuarios as $usuario)
        <tr>
            <td>{{ $usuario->id }}</td>
            <td>{{ $usuario->email }}</td>
            <td>{{ $usuario->name }}</td>
            <td>{{ $usuario->roles()->get()->first()->display_name }}</td>
            <td class="center-align">
                <a class="btn-floating btn-large waves-effect waves-light deep-orange" href="{{ route('usuario.edit', ['id' => $usuario->id]) }}"><i class="material-icons">create</i></a>
                <a class="btn-floating btn-large waves-effect waves-light red" href="{{ route('usuario.show', ['id' => $usuario->id]) }}"><i class="material-icons">visibility</i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
@endsection

@section('pagination')
    {!! $usuarios->appends(Request::only('search'))->render() !!}
@endsection