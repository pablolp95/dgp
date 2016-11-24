@extends("create")

@section("title")
    Añadir un nuevo idioma
@endsection

@section("resource_title")
    Añadir un nuevo idioma
@endsection

@section("form")
    {!! Form::open(["method" => "post", "enctype" => "multipart/form-data","route" => "language.store"]) !!}
    @include("languages._model")
    {!! Form::close() !!}
@endsection

{{--@section("scripts")
    @parent
    <script>initAudioValidation()</script>
@endsection --}}