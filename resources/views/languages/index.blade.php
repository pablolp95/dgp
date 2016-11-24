@extends('index')

@section('title')
    Lista de idiomas
@endsection

@section('elem_title')
    Idiomas
@endsection

@section('elem_description')
    @if(isset($_GET["search"]))
        Estos son todos los idiomas que coinciden con tu búsqueda, ¿quieres añadir un <a href="{!! route('language.create') !!}">nuevo idioma</a>?
    @else
        Estos son todos los idiomas, ¿quieres añadir un <a href="{!! route('language.create') !!}">nuevo idioma</a>?
    @endif

@endsection

@section('search')
    @include('_search', ['search_route' => 'language.search', 'searchbox_text' => 'Buscar un idioma...'])
@endsection

@section('table')
    <thead>
    <tr>
        <th>ID</th>
        <th>Idioma</th>
        <th class="center-align">Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($languages as $language)
        <tr>
            <td>{{ $language->id }}</td>
            <td>{{ $language->language }}</td>
            <td class="center-align">
                <a class="btn-floating btn-large waves-effect waves-light deep-orange tooltipped" href="{{ route('language.edit', ['id' => $language->id]) }}" data-position="top" data-delay="50" data-tooltip="Editar language"><i class="material-icons">create</i></a>
                <a class="btn-floating btn-large waves-effect waves-light red tooltipped" href="{{ route('language.show', ['id' => $language->id]) }}" data-position="top" data-delay="50" data-tooltip="Mostrar language"><i class="material-icons">visibility</i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
@endsection

@section('pagination')
    {!! $languages->appends(Request::only('search'))->render() !!}
@endsection