@extends("create")

@section("title")
    Editando usuario #{{ $usuario->id }}
@endsection

@section("resource_title")
    Editando usuario #{{ $usuario->id }} - {{ $usuario->name }}
@endsection

@section("form")
    {!! Form::model($usuario, ["method" => "put", "route" => array("usuario.update",$usuario->id)]) !!}
    @include("usuarios._model")
    {!! Form::close() !!}
    @include("usuarios._destroy")
@endsection

@section("scripts")
    @parent
    <script>
        $('.datepicker').pickadate();
        initUserValidation();
    </script>
@endsection