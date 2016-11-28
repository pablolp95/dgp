@extends("create")

@section("title")
    Añadir una nueva ruta
@endsection

@section("resource_title")
    Añadir una nueva ruta
@endsection

@section("form")
    {!! Form::open(["method" => "post", "route" => "route.store"]) !!}
    @include("routes._model")
    {!! Form::close() !!}
@endsection

{{--@section("scripts")
    @parent
    <script>initAudioValidation()</script>
@endsection --}}