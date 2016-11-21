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

    <div class="row">
        <div class="col s6">
            <div class="card indigo darken-1">
                <div class="card-content white-text">
                    <span class="card-title">Stands :</span>
                </div>
                <div class="card-action indigo lighten-5 indigo-text">
                    <div class="row ">
                        <div class="col s12">
                            @foreach($stands as $stand)
                                <p>Stand <a href="{{ route("stand.show",$stand->id) }}">#{{$stand->id}}</a></p>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
