@extends("create")

@section("title")
    Editando Video #{{ $videos->id }}
@endsection

@section("resource_title")
    Editando Video #{{ $videos->id }} - {{ $videos->name }}
@endsection

@section("form")
    {!! Form::model($videos, ["method" => "put", "route" => array("video.update", $videos->id)]) !!}
    @include("videos._model")
    {!! Form::close() !!}
    @include("videos._destroy")
@endsection

@section("scripts")
    @parent
    <script>initProductValidation()</script>
@endsection