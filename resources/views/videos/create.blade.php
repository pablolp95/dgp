@extends("create")

@section("title")
    Crear un nuevo producto
@endsection

@section("resource_title")
    Crear un nuevo producto
@endsection

@section("form")
    {!! Form::open(["method" => "post", "route" => "producto.store"]) !!}
    @include("productos._model")
    {!! Form::close() !!}
@endsection

@section("scripts")
    @parent
    <script>initProductValidation()</script>
@endsection