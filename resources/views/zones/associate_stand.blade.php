@extends("create")

@section("title")
    Asociar un stand a la zona {{ $id }}
@endsection

@section("resource_title")
    Asociar un stand a la zona {{ $id }}
@endsection

@section("form")
    {!! Form::open(["method" => "post", "route" => ["zone.associate.stand", $id]]) !!}
    <!-- ID del presupuesto field -->
    <div class="input-field col s12">
        {!! Form::text("stand_id", null, ["id" => "stand_id","class" => "validate"]) !!}
        {!! Form::label("stand_id", "ID del stand:") !!}
    </div>
    <div class="col s12">
        {!! Form::button("Asociar", ["type" => "submit", "class" => "btn waves-effect waves-light indigo right"]) !!}
    </div>
    <div class="col s12">
        <div class="clearfix"></div>
    </div>
    {!! Form::close() !!}
@endsection
