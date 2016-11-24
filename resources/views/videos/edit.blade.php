@extends("create")

@section("title")
    Editando video #{{ $video->id }} - {{ $video->name }}
@endsection

@section("resource_title")
    Editando video #{{ $video->id }} - {{ $video->name }}
@endsection

@section("form")
    {!! Form::model($video, ["method" => "put", "route" => array("video.update", $video->id)]) !!}
    @include("videos._model")
    {!! Form::close() !!}
    @include("videos._destroy")
@endsection

@section("scripts")
    @parent
    <script>initProductValidation()</script>
@endsection