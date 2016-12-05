@extends("show")

@section("resource_title")
    Ruta {{ $route->id }} - {{ $route->name }}
@endsection

@section("data")
    <div class="row">
        <div class="col s12 m6">
            <p><strong>Creado el:</strong> {{ $route->created_at }}</p>
            <p><strong>Última modificación:</strong> {{ $route->updated_at }}</p>
        </div>
        <div class="col m6">
            <p><strong>ID del usuario que lo creó:</strong> {{ $route->user_id }}</p>
            <p><strong>ID del usuario de su última modificación:</strong> {{ $route->last_update_user_id }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <p><strong>Nombre:</strong> {{ $route->name }}</p>
            <p><strong>Descripción:</strong> {{ $route->description }}</p>
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