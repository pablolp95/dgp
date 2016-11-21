@extends("show")

@section("resource_title")
    Videos #{{ $videos->id }} - {{ $videos->name }}
@endsection

@section("data")
    <div class="row">
        <div class="col s12 m6">
            <p><strong>Creado el:</strong> {{ $videos->created_at }}</p>
            <p><strong>Última modificación:</strong> {{ $videos->updated_at }}</p>
        </div>
        <div class="col m6">
            <p><strong>ID del usuario que lo creó:</strong> {{ $videos->user_id }}</p>
            <p><strong>Email del usuario que lo creó:</strong> {{ $videos->user->email }}</p>
            <p><strong>ID del usuario de su última modificación:</strong> {{ $videos->last_update_user_id }}</p>
            <p><strong>Email del usuario de su última modificación:</strong> {{ $videos->last_update_user->email }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <p><strong>Nombre:</strong> {{ $videos->name }}</p>
            <p><strong>URL de video:</strong> {{ $videos->video_url }}</p>
            <p><strong>Descripción:</strong> {{ $videos->filename }}</p>
        </div>
    </div>
@endsection