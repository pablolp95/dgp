@extends("show")

@section("title")
    Factura #{{ $factura->id }}
@endsection

@section("resource_title")
    Factura #{{ $factura->id }}
@endsection

@section("data")
    <div class="row">
        <div class="col s12 m6">
            <p><strong>Creado el:</strong> {{ $factura->created_at }}</p>
            <p><strong>Última modificación:</strong> {{ $factura->updated_at }}</p>
            @if($factura->cliente != null)<p><strong>ID Cliente:</strong><a href="{{ route("cliente.show",["id" => $factura->cliente->id]) }}">{{ $factura->cliente->id }}</a></p>@endif
            <p><strong>Días de aceptación:</strong> {{ $factura->aceptation_days }}</p>
            <p><strong>Descuento en %:</strong> {{ $factura->percentage_discount }}%</p>
            <p><strong>Descuento en cantidad:</strong> {{ $factura->amount_discount }}€</p>
            <p><strong>Notas:</strong> {{ $factura->notes }}</p>
        </div>
        <div class="col s12 m6">
            <p><strong>ID del usuario que lo creó:</strong> {{ $factura->user_id }}</p>
            <p><strong>Email del usuario que lo creó:</strong> {{ $factura->user->email }}</p>
            <p><strong>ID del usuario de su última modificación:</strong> {{ $factura->last_update_user_id }}</p>
            <p><strong>Email del usuario de su última modificación:</strong> {{ $factura->last_update_user->email }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <h3>Datos de facturación</h3>
        </div>
        <div class="col s12">
            <h4>Datos del emisor</h4>
        </div>
        @include("facturas._invoicing_data_show",["elem" => $factura, "prefix" => "e_"])
        <div class="col s12">
            <h4>Datos del receptor</h4>
        </div>
        @include("facturas._invoicing_data_show",["elem" => $factura, "prefix" => "r_"])
    </div>
    <div class="row">
        <div class="col s6">
            <div class="card indigo darken-1">
                <div class="card-content white-text">
                    <span class="card-title">Productos:</span>
                </div>
                <div class="card-action indigo lighten-5 indigo-text">
                    <div class="row ">
                        <div class="col s12">
                            @foreach($productos as $producto)
                                <p><a href="{{ route("producto.show",$producto->id) }}">{{ $producto->name }} - {{ $producto->price }}€</a></p>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s6">
            <div class="card indigo darken-1">
                <div class="card-content white-text">
                    <span class="card-title">Servicios:</span>
                </div>
                <div class="card-action indigo lighten-5 indigo-text">
                    <div class="row ">
                        <div class="col s12">
                            @foreach($servicios as $servicio)
                                <p><a href="{{ route("servicio.show",$servicio->id) }}">{{ $servicio->name }} - {{ $servicio->price }}€</a></p>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <p class="flow-text">Impuestos aplicables</p>
        </div>
        <div class="col s12">
            @foreach($impuestos as $impuesto)
                <a href="{{ route("impuesto.show",[$impuesto->id]) }}">{{ $impuesto->name }}</a>
            @endforeach
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <p class="flow-text">Total de factura: <strong>{{ $total }}</strong>€</p>
        </div>
    </div>
@endsection