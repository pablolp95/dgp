@extends("create")

@section("title")
    Crear una nueva factura
@endsection

@section("resource_title")
    Crear una nueva factura
@endsection

@section("form")
    {!! Form::open(["method" => "post", "route" => "factura.store"]) !!}
    @include("facturas._model")
    {!! Form::close() !!}
@endsection

@section("scripts")
    @parent
    <script>
        $('.datepicker').pickadate();
        initInvoiceCreationHandlers();
        initInvoicingDataValidation();
    </script>
@endsection