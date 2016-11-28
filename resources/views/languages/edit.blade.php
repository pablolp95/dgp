@extends("create")

@section("title")
    Editando idioma #{{ $language->id }}
@endsection

@section("resource_title")
    Editando idioma #{{ $language->id }} - {{ $language->language }}
@endsection

@section("form")
    {!! Form::model($language, ["method" => "put", "route" => array("language.update", $language->id)]) !!}
    @include("languages._model")
    {!! Form::close() !!}
    @include("languages._destroy")
@endsection

@section("scripts")
    @parent
    <script>initProductValidation()</script>
@endsection