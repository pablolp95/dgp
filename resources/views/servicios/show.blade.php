@extends("show")

@section("resource_title")
    Servicio #{{ $servicio->id }} - {{ $servicio->name }}
@endsection

@section("data")
    <div class="row">
        <div class="col s12 m6">
            <p><strong>Creado el:</strong> {{ $servicio->created_at }}</p>
            <p><strong>Última modificación:</strong> {{ $servicio->updated_at }}</p>
            <p><strong>Tiempo de desarrollo:</strong> {{ $servicio->development_time }}</p>
            <p><strong>Estado:</strong> {{ $servicio->status }}</p>
        </div>
        <div class="col m6">
            <p><strong>ID del usuario que lo creó:</strong> {{ $servicio->user_id }}</p>
            <p><strong>Email del usuario que lo creó:</strong> {{ $servicio->user->email }}</p>
            <p><strong>ID del usuario de su última modificación:</strong> {{ $servicio->last_update_user_id }}</p>
            <p><strong>Email del usuario de su última modificación:</strong> {{ $servicio->last_update_user->email }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col s12 m6">
            <p><strong>Nombre:</strong> {{ $servicio->name }}</p>
            <p><strong>Precio:</strong> {{ $servicio->price }}</p>
            <p><strong>URL de imagen:</strong> {{ $servicio->img_url }}</p>
            <p><strong>Descripción:</strong> {{ $servicio->description }}</p>
        </div>
        <div class="col s12 m6">
            <p><strong>Inicio del servicio:</strong> {{ $servicio->starting_date }}</p>
            <p><strong>Fin del servicio:</strong> {{ $servicio->ending_date }}</p>
            <p><strong>Período de facturación en días:</strong> {{ $servicio->invoice_period }}</p>
        </div>
    </div>
@endsection