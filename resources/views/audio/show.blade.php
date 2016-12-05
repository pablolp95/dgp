@extends("show")

@section("title")
    Editando audio #{{ $audio->id }}
@endsection

@section("resource_title")
    Audio #{{ $audio->id }} - {{ $audio->name }}
@endsection

@section("data")
    <div class="row">

        <div class="col m6">
            <p><strong>ID del usuario que lo creó:</strong> {{ $audio->user_id }}</p>
            <p><strong>Email del usuario que lo creó:</strong> {{ $audio->user->email }}</p>
            <p><strong>ID del usuario de su última modificación:</strong> {{ $audio->last_update_user_id }}</p>
            <p><strong>Email del usuario de su última modificación:</strong> {{ $audio->last_update_user->email }}</p>
        </div>

    </div>
    <div class="row">
        <div class="col s12">
            <p><strong>Nombre:</strong> {{ $audio->name }}</p>
            <p><strong>Idioma:</strong> {{ $audio->language->language }}</p>
            <p><strong>Descripción:</strong> {{ $audio->description }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col m2">
            <p><strong>Reproducir audio:</strong></p>
        </div>
    </div>
    <div class="row">
        <div class="col m6 offset-l1">
            <audio controls>
                <source src="http://dgp.com/api/audio/{{ $audio->id }}/file" type="{{ $audio->mime }}">
            </audio>
        </div>
    </div>
@endsection