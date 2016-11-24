@extends("show")

@section("title")
    Editando idioma #{{ $language->id }}
@endsection

@section("resource_title")
    Idioma #{{ $language->id }} - {{ $language->language }}
@endsection

@section("data")
    <div class="row">
        <div class="col s12 m6">
            <p><strong>Creado el:</strong> {{ $language->created_at }}</p>
            <p><strong>Última modificación:</strong> {{ $language->updated_at }}</p>
        </div>
        <div class="col m6">
            <p><strong>ID del usuario que lo creó:</strong> {{ $language->user_id }}</p>
            <p><strong>Email del usuario que lo creó:</strong> {{ $language->user->email }}</p>
            <p><strong>ID del usuario de su última modificación:</strong> {{ $language->last_update_user_id }}</p>
            <p><strong>Email del usuario de su última modificación:</strong> {{ $language->last_update_user->email }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <p><strong>Idioma:</strong> {{ $language->language }}</p>
        </div>
    </div>
@endsection