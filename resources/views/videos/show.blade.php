@extends("show")

@section('title')
    Video #{{ $video->id }} - {{ $video->name }}
@endsection

@section("resource_title")
    Video #{{ $video->id }} - {{ $video->name }}
@endsection

@section("data")
    <div class="row">
        <div class="col s12 m6">
            <p><strong>Creado el:</strong> {{ $video->created_at }}</p>
            <p><strong>Última modificación:</strong> {{ $video->updated_at }}</p>
        </div>
        <div class="col m6">
            <p><strong>ID del usuario que lo creó:</strong> {{ $video->user_id }}</p>
            <p><strong>Email del usuario que lo creó:</strong> {{ $video->user->email }}</p>
            <p><strong>ID del usuario de su última modificación:</strong> {{ $video->last_update_user_id }}</p>
            <p><strong>Email del usuario de su última modificación:</strong> {{ $video->last_update_user->email }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <p><strong>Nombre:</strong> {{ $video->name }}</p>
            <p><strong>Descripción:</strong> {{ $video->filename }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col m2">
            <p><strong>Reproducir video:</strong></p>
        </div>
    </div>
    <div class="row">
        <div class="col m6 offset-l1">
            <video controls Pause>
                <source src="http://{{$_SERVER['HTTP_HOSTS']}}/api/video/{{ $video->id }}/file" type="{{ $video->mime }}">
            </video>
        </div>
    </div>
@endsection