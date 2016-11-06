@extends("create")

@section("title")
    Editando servicio #{{ $servicio->id }}
@endsection

@section("resource_title")
    Editando servicio #{{ $servicio->id }} - {{ $servicio->name }}
@endsection

@section("form")
    {!! Form::model($servicio, ["method" => "put", "route" => array("servicio.update",$servicio->id)]) !!}
    @include("servicios._model")
    {!! Form::close() !!}
    @include("servicios._destroy")
@endsection

@section("scripts")
    @parent
    <script>
        $('.datepicker').pickadate();
        initServiceValidation();
    </script>
@endsection