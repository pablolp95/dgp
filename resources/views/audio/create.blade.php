@extends("create")

@section("title")
    Añadir un nuevo audio
@endsection

@section("resource_title")
    Añadir un nuevo audio
@endsection

@section("form")
    {!! Form::open(["method" => "post", "enctype" => "multipart/form-data","route" => "audio.store"]) !!}
    @include("audio._model")
    {!! Form::close() !!}
@endsection

@section("scripts")
    @parent
    <script>
        initAudioValidation();
    </script>
@endsection