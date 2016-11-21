@extends("create")

@section("title")
    Crear un nuevo video
@endsection

@section("resource_title")
    Crear un nuevo video
@endsection

@section("form")
    {!! Form::open(["method" => "post",  "enctype" => "multipart/form-data","route" => "video.store"]) !!}
    @include("videos._model")
    {!! Form::close() !!}
@endsection

{{--@section("scripts")
    @parent
    <script>initProductValidation()</script>
@endsection--}}