@extends("show")

@section("title")
    Mostrando a {{ $cliente->name }}
@endsection

@section("resource_title")
    Cliente #{{ $cliente->id }} - {{ $cliente->name }}
@endsection

@section("data")
    <div class="row">
        <div class="col s12 m6">
            <p><strong>Creado el:</strong> {{ $cliente->created_at }}</p>
            <p><strong>Última modificación:</strong> {{ $cliente->updated_at }}</p>
            <p><strong>Nombre:</strong> {{ $cliente->name }}</p>
            <p><strong>Apellidos:</strong> {{ $cliente->surname }}</p>
            <p><strong>NIF:</strong> {{ $cliente->nif }}</p>
        </div>
        <div class="col s12 m6">
            <p><strong>ID del usuario que lo creó:</strong> {{ $cliente->user_id }}</p>
            <p><strong>Email del usuario que lo creó:</strong> {{ $cliente->user->email }}</p>
            <p><strong>ID del usuario de su última modificación:</strong> {{ $cliente->last_update_user_id }}</p>
            <p><strong>Email del usuario de su última modificación:</strong> {{ $cliente->last_update_user->email }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col s12 m6">
            <p><strong>URL de imagen:</strong> {{ $cliente->img_url }}</p>
            <p><strong>Tipo de cliente:</strong> {{ $cliente->type }}</p>
            <p><strong>Teléfono:</strong> {{ $cliente->phone }}</p>
            <p><strong>Móvil:</strong> {{ $cliente->mobile }}</p>
            <p><strong>Email:</strong> {{ $cliente->email }}</p>
            <p><strong>Notas:</strong> {{ $cliente->notes }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <h3>Datos de facturación</h3>
        </div>
        <div class="col s12 m6">
            <p><strong>Nombre de facturación:</strong> {{ $cliente->invoicing_name }}</p>
            <p><strong>Tipo de entidad:</strong> {{ $cliente->entity_type }}</p>
            <p><strong>NIF:</strong> {{ $cliente->nif }}</p>
        </div>
        <div class="col s12 m6">
            <p><strong>País:</strong> {{ $cliente->country }}</p>
            <p><strong>Provincia:</strong> {{ $cliente->state }}</p>
            <p><strong>Ciudad:</strong> {{ $cliente->city }}</p>
            <p><strong>Código postal:</strong> {{ $cliente->zip_code }}</p>
            <p><strong>Dirección:</strong> {{ $cliente->address_1 }}</p>
            <p><strong>Dirección línea 2:</strong> {{ $cliente->address_2 }}</p>
        </div>
    </div>
@endsection