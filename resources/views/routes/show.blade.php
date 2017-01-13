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
        <div class="col s12">
            <p><strong>Stands asociados:</strong></p>
        </div>
    </div>
    <!-- Associate stands -->
    <div class="col s12 z-depth-2" id="stands" style="margin:15px 0 15px 0;padding:22.25px;">
        <div class='col s12 no-padding'>
            <h6 style='color:#9E9E9E'>Stands asociados</h6>
            <ul id='stand-list' class='list collection with-header'>
                @if(isset($stands) && !$stands->isEmpty())
                    @foreach($stands as $stand)
                        <li class='collection-item'> {{$stand->name}} </li>
                    @endforeach
                @else
                    <li id='stand-label' class='collection-item'><label>Ningún stand asociado</label></li>
                @endif
            </ul>
        </div>
    </div>

@endsection