@extends("create")

@section("title")
    Crear un nuevo servicio
@endsection

@section("resource_title")
    Crear un nuevo servicio
@endsection

@section("form")
    {!! Form::open(["method" => "post", "route" => "servicio.store"]) !!}
    @include("servicios._model")
    {!! Form::close() !!}
@endsection

@section("scripts")
    @parent
    <script>
        $('.datepicker').pickadate();
        initServiceValidation();
    </script>
@endsection