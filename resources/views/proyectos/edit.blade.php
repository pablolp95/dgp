@extends("create")

@section("title")
    Editando proyecto #{{ $proyecto->id }}
@endsection

@section("resource_title")
    Editando proyecto #{{ $proyecto->id }} - {{ $proyecto->name }}
@endsection

@section("form")
    {!! Form::model($proyecto, ["method" => "put", "route" => array("proyecto.update",$proyecto->id)]) !!}
    @include("proyectos._model")
    {!! Form::close() !!}
    @include("proyectos._destroy")
@endsection

@section("scripts")
    @parent
    <script>
        $('.datepicker').pickadate();
        initProyectValidation();
    </script>
@endsection