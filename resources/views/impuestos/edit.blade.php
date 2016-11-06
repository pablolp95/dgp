@extends("create")

@section("title")
    Editando impuesto #{{ $impuesto->id }}
@endsection

@section("resource_title")
    Editando impuesto #{{ $impuesto->id }} - {{ $impuesto->name }}
@endsection

@section("form")
    {!! Form::model($impuesto, ["method" => "put", "route" => array("impuesto.update",$impuesto->id)]) !!}
    @include("impuestos._model")
    {!! Form::close() !!}
    @include("impuestos._destroy")
@endsection

@section("scripts")
    @parent
    <script>
        initTaxValidation();
    </script>
@endsection