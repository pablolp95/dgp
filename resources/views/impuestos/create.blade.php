@extends("create")

@section("title")
    Crear un nuevo impuesto
@endsection

@section("resource_title")
    Crear un nuevo impuesto
@endsection

@section("form")
    {!! Form::open(["method" => "post", "route" => "impuesto.store"]) !!}
    @include("impuestos._model")
    {!! Form::close() !!}
@endsection

@section("scripts")
    @parent
    <script>
        initTaxValidation();
    </script>
@endsection