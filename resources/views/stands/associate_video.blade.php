@extends("create")

@section("title")
    Asociar un video al stand {{ $id }}
@endsection

@section("resource_title")
    Asociar un video al stand {{ $id }}
@endsection

@section("form")
    {!! Form::open(["method" => "post", "route" => ["stand.associate.video", $id]]) !!}
    <!-- ID del presupuesto field -->
    <div class="input-field col s12">
        {!! Form::text("video_id", null, ["id" => "video_id","class" => "validate"]) !!}
        {!! Form::label("video_id", "ID del video:") !!}
    </div>
    <div class="col s12">
        {!! Form::button("Asociar", ["type" => "submit", "class" => "btn waves-effect waves-light indigo right"]) !!}
    </div>
    <div class="col s12">
        <div class="clearfix"></div>
    </div>
    {!! Form::close() !!}
@endsection
