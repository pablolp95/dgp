@extends("show")

@section("resource_title")
    Producto #{{ $producto->id }} - {{ $producto->name }}
@endsection

@section("data")
    <div class="row">
        <div class="col s12 m6">
            <p><strong>Creado el:</strong> {{ $producto->created_at }}</p>
            <p><strong>Última modificación:</strong> {{ $producto->updated_at }}</p>
            <p><strong>Tiempo de desarrollo:</strong> {{ $producto->development_time }}</p>
            <p><strong>Estado:</strong> {{ $producto->status }}</p>
        </div>
        <div class="col m6">
            <p><strong>ID del usuario que lo creó:</strong> {{ $producto->user_id }}</p>
            <p><strong>Email del usuario que lo creó:</strong> {{ $producto->user->email }}</p>
            <p><strong>ID del usuario de su última modificación:</strong> {{ $producto->last_update_user_id }}</p>
            <p><strong>Email del usuario de su última modificación:</strong> {{ $producto->last_update_user->email }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <p><strong>Nombre:</strong> {{ $producto->name }}</p>
            <p><strong>Precio:</strong> {{ $producto->price }}</p>
            <p><strong>URL de imagen:</strong> {{ $producto->img_url }}</p>
            <p><strong>Descripción:</strong> {{ $producto->description }}</p>
        </div>
    </div>
@endsection