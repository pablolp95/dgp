@extends("create")

@section("title")
    Crear un nuevo usuario
@endsection

@section("resource_title")
    Crear un nuevo usuario
@endsection

@section("form")
    {!! Form::open(["method" => "post", "route" => "usuario.store"]) !!}
    @include("usuarios._model")
    {!! Form::close() !!}
@endsection

@section("scripts")
    @parent
    <script>
        $('.datepicker').pickadate();
        initUserValidation();
    </script>
@endsection