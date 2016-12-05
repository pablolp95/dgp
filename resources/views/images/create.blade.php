@extends("create")

@section("title")
    Añadir una nueva imagen
@endsection

@section("resource_title")
    Añadir una nueva imagen
@endsection

@section("form")
    {!! Form::open(["method" => "post",  "enctype" => "multipart/form-data","route" => "image.store"]) !!}
    @include("images._model")
    {!! Form::close() !!}
@endsection

{{--@section("scripts")
    @parent
    <script>initProductValidation()</script>
@endsection--}}