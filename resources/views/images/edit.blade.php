@extends("create")

@section("title")
    Editando imagen #{{ $image->id }} - {{ $image->name }}}
@endsection

@section("resource_title")
    Editando imagen #{{ $image->id }} - {{ $image->name }}
@endsection

@section("form")
    {!! Form::model($image, ["method" => "put", "enctype" => "multipart/form-data", "route" => array("image.update", $image->id)]) !!}
    @include("images._model")
    {!! Form::close() !!}
    @include("images._destroy")
@endsection

@section("scripts")
    @parent
    <script>
        initImageValidation();
    </script>
@endsection