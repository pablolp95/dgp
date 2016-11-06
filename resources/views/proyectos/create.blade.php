@extends("create")

@section("title")
    Crear un nuevo proyecto
@endsection

@section("resource_title")
    Crear un nuevo proyecto
@endsection

@section("form")
    {!! Form::open(["method" => "post", "route" => "proyecto.store"]) !!}
    @include("proyectos._model")
    {!! Form::close() !!}
@endsection

@section("scripts")
    @parent
    <script>
        $('.datepicker').pickadate();
        initProyectValidation();
    </script>
@endsection