@extends("create")

@section("title")
    Editando zona {{ $zone->id }}
@endsection

@section("resource_title")
    Editando zona #{{ $zone->id }} - {{ $zone->name }}
@endsection

@section("form")
    {!! Form::model($zone, ["method" => "put", "route" => array("zone.update",$zone->id)]) !!}
    @include("zones._model")
    {!! Form::close() !!}
    @include("zones._destroy")
@endsection
@section("scripts")
    @parent
    <script>
        initZoneValidation();
    </script>
@endsection