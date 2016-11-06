@extends("create")

@section("title")
    Crear un nuevo presupuesto
@endsection

@section("resource_title")
    Crear un nuevo presupuesto
@endsection

@section("form")
    {!! Form::open(["method" => "post", "route" => "presupuesto.store"]) !!}
    @include("presupuestos._model")
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