@extends("create")

@section("title")
    Editando stand {{ $stand->id }}
@endsection

@section("resource_title")
    Editando stand #{{ $stand->id }} - {{ $stand->name }}
@endsection

@section("form")
    {!! Form::model($stand, ["method" => "put", "route" => array("stand.update",$stand->id)]) !!}
    @include("stands._model")
    {!! Form::close() !!}
    @include("stands._destroy")
@endsection

@section("scripts")
    @parent
    <script>
        initStandValidation();
    </script>
@endsection

