@extends("create")

@section("title")
    Editando imagen #{{ $image->id }}
@endsection

@section("resource_title")
    Editando Imagen #{{ $image->id }} - {{ $image->name }}
@endsection

@section("form")
    {!! Form::model($image, ["method" => "put", "route" => array("image.update", $image->id)]) !!}
    @include("image._model")
    {!! Form::close() !!}
    @include("image._destroy")
@endsection

@section("scripts")
    @parent
    <script>initProductValidation()</script>
@endsection