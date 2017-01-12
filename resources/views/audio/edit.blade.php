@extends("create")

@section("title")
    Editando audio #{{ $audio->id }}
@endsection

@section("resource_title")
    Editando audio #{{ $audio->id }} - {{ $audio->name }}
@endsection

@section("form")
    {!! Form::model($audio, ["method" => "put", "enctype" => "multipart/form-data", "route" => array("audio.update", $audio->id)]) !!}
    @include("audio._model")
    {!! Form::close() !!}
    @include("audio._destroy")
@endsection

@section("scripts")
    @parent
    <script>
        initAudioValidation();
    </script>
@endsection