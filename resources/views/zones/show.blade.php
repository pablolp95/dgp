@extends("show")

@section('title')
    Mostrando a {{ $zone->name }}
@endsection

@section("resource_title")
    Zona {{ $zone->id }} - {{ $zone->name }}
@endsection

@section("data")
    <div class="row">
        <div class="col s12 m6">
            <p><strong>Creado el:</strong> {{ $zone->created_at }}</p>
            <p><strong>Última modificación:</strong> {{ $zone->updated_at }}</p>
        </div>
        <div class="col m6">
            <p><strong>ID del usuario que lo creó:</strong> {{ $zone->user_id }}</p>
            <p><strong>ID del usuario de su última modificación:</strong> {{ $zone->last_update_user_id }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col s12 m5">
            <p><strong>Nombre:</strong> {{ $zone->name }}</p>
        </div>
        <div class="col s12 m4">
            <p><strong>Temática:</strong> {{ $zone->thematic}}</p>
        </div>
        <div class="col s12 m3">
            <p><strong>Planta:</strong> {{ $zone->floor}}</p>
        </div>

    </div>
    <div class="row">
        <div class="col s12 m6">
            <p><strong>Descripción:</strong> {{ $zone->description}}</p>
        </div>
    </div>

@endsection
