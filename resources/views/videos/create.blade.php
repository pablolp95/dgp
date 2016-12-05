@extends("create")

@section("title")
    Añadir un nuevo video
@endsection

@section("resource_title")
    Añadir un nuevo video
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