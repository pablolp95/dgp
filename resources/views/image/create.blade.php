@extends("create")

@section("title")
    Crear una nueva imagen
@endsection

@section("resource_title")
    Crear una nueva imagen
@endsection

@section("form")
    {!! Form::open(["method" => "post",  "enctype" => "multipart/form-data","route" => "image.store"]) !!}
    @include("image._model")
    {!! Form::close() !!}
@endsection

{{--@section("scripts")
    @parent
    <script>initProductValidation()</script>
@endsection--}}