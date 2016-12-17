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
    @if(Entrust::user()->id != $usuario->id)
        @include("usuarios._destroy")
    @endif
@endsection

@section("scripts")
    @parent
    <script>
        $('.datepicker').pickadate();
        initUserValidation();
    </script>
@endsection