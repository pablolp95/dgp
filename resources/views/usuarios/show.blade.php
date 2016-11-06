@extends("show")

@section("title")
    Mostrando a {{ $usuario->name }}
@endsection

@section("resource_title")
    Usuario #{{ $usuario->id }} - {{ $usuario->name }}
@endsection

@section("data")
    <div class="row">
        <div class="col s12 m6">
            <p><strong>Creado el:</strong> {{ $usuario->created_at }}</p>
            <p><strong>Última modificación:</strong> {{ $usuario->updated_at }}</p>
            <p><strong>Nombre:</strong> {{ $usuario->name }}</p>
            <p><strong>Email:</strong> {{ $usuario->email }}</p>
            <p><strong>Estado:</strong> {{ $usuario->status }}</p>
            <p><strong>Notas:</strong> {{ $usuario->notes }}</p>
        </div>
    </div>
@endsection