@extends("create")

@section("title")
    Asociar una factura al presupuesto #{{ $id }}
@endsection

@section("resource_title")
    Asociar una factura al presupuesto #{{ $id }}
@endsection

@section("form")
    {!! Form::open(["method" => "post", "route" => ["presupuesto.add.invoice", $id]]) !!}
    <!-- ID de la factura field -->
    <div class="input-field col s12">
        {!! Form::text("invoice_id", null, ["id" => "invoice_id","class" => "validate"]) !!}
        {!! Form::label("invoice_id", "ID de la factura:") !!}
    </div>
    <div class="col s12">
        {!! Form::button("Asociar", ["type" => "submit", "class" => "btn waves-effect waves-light indigo right"]) !!}
    </div>
    <div class="col s12">
        <div class="clearfix"></div>
    </div>
    {!! Form::close() !!}
@endsection