@extends("show")

@section('title')
    Imagen #{{ $image->id }} - {{ $image->name }}
@endsection

@section("resource_title")
    Imagen #{{ $image->id }} - {{ $image->name }}
@endsection

@section("data")
    <div class="row">

        <div class="col m6">
            <p><strong>ID del usuario que lo creó:</strong> {{ $image->user_id }}</p>
            <p><strong>Email del usuario que lo creó:</strong> {{ $image->user->email }}</p>
            <p><strong>ID del usuario de su última modificación:</strong> {{ $image->last_update_user_id }}</p>
            <p><strong>Email del usuario de su última modificación:</strong> {{ $image->last_update_user->email }}</p>
        </div>
        <div class="col s12 m6">
            <p><strong>Creado el:</strong> {{ $image->created_at }}</p>
            <p><strong>Última modificación:</strong> {{ $image->updated_at }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <p><strong>Nombre:</strong> {{ $image->name }}</p>
            <p><strong>Descripción:</strong> {{ $image->filename }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col m2">
            <p><strong>Imagen:</strong></p>
        </div>
    </div>
    <div class="row">
        <div class="col m6 offset-l1">
            <img src="http://dgp.com/api/image/{{ $image->id }}/file" style="height:50%; width: 50%">
        </div>
    </div>
@endsection