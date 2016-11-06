@extends("create")

@section("title")
    Crear un nuevo cliente
@endsection

@section("resource_title")
    Crear un nuevo cliente
@endsection

@section("form")
    {!! Form::open(["method" => "post", "route" => "cliente.store"]) !!}
    @include("clientes._model")
    {!! Form::close() !!}
@endsection

@section("scripts")
    @parent
    <script>
        $('.datepicker').pickadate();
        initClientValidation();
    </script>
@endsection