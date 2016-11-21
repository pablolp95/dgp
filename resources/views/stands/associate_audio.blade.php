@extends("create")

@section("title")
    Asociar un audio al stand {{ $id }}
@endsection

@section("resource_title")
    Asociar un audio al stand {{ $id }}
@endsection

@section("form")
    {!! Form::open(["method" => "post", "route" => ["stand.associate.audio", $id]]) !!}
    <!-- ID del presupuesto field -->
    <div class="input-field col s12">
        {!! Form::text("audio_id", null, ["id" => "audio_id","class" => "validate"]) !!}
        {!! Form::label("audio_id", "ID del audio:") !!}
    </div>
    <div class="col s12">
        {!! Form::button("Asociar", ["type" => "submit", "class" => "btn waves-effect waves-light indigo right"]) !!}
    </div>
    <div class="col s12">
        <div class="clearfix"></div>
    </div>
    {!! Form::close() !!}
@endsection
