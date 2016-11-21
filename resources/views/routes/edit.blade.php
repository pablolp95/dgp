@extends("create")

@section("title")
    Editando ruta {{ $route->id }}
@endsection

@section("resource_title")
    Editando ruta {{ $route->id }} - {{ $route->name }}
@endsection

@section("form")
    {!! Form::model($route, ["method" => "put", "route" => array("route.update", $route->id)]) !!}
    @include("routes._model")
    {!! Form::close() !!}
    @include("routes._destroy")
@endsection
