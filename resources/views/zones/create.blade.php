@extends("create")

@section("title")
    Crear una nueva zona
@endsection

@section("resource_title")
    Crear una nueva zona
@endsection

@section("form")
    {!! Form::open(["method" => "post", "route" => "zone.store"]) !!}
    @include("zones._model")
    {!! Form::close() !!}
@endsection

@section("scripts")
    @parent
    <script>
        initZoneValidation()
    </script>
@endsection