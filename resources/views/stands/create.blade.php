@extends("create")

@section("title")
    Crear un nuevo stand
@endsection

@section("resource_title")
    Crear un nuevo stand
@endsection

@section("form")
    {!! Form::open(["method" => "post", "route" => "stand.store"]) !!}
    @include("stands._model")
    {!! Form::close() !!}
@endsection

@section("scripts")
    @parent
    <script>
        initStandValidation();
    </script>
@endsection