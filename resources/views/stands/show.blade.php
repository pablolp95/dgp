@extends("show")

@section('title')
    Mostrando a {{ $stand->name }}
@endsection

@section("resource_title")
    Stand {{ $stand->id }} - {{ $stand->name }}
@endsection

@section("data")
    <div class="row">
        <div class="col s12 m6">
            <p><strong>Creado el:</strong> {{ $stand->created_at }}</p>
            <p><strong>Última modificación:</strong> {{ $stand->updated_at }}</p>
        </div>
        <div class="col m6">
            <p><strong>ID del usuario que lo creó:</strong> {{ $stand->user_id }}</p>
            <p><strong>ID del usuario de su última modificación:</strong> {{ $stand->last_update_user_id }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col s12 m5">
            <p><strong>Nombre:</strong> {{ $stand->name }}</p>
        </div>

        <div class="col s12 m4">
            <p><strong>Zona asociada:</strong> {{ $stand->zone_id}}</p>
        </div>
        <div class="col s12 m3">
            <p><strong>Ruta asociada:</strong> {{ $stand->route_id}}</p>
        </div>
    </div>
    <div class="visible-print text-center">
        {!! base64_encode(QrCode::format('png')->size(400)->generate('http://'.$_SERVER['HTTP_HOST'].'/'.$stand->id, '../QRs/Stand'.$stand->id.'.png'))!!}
    </div> 
@endsection
