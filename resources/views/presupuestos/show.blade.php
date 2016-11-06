@extends("show")

@section("title")
    Mostrando Presupuesto #{{ $presupuesto->id }}
@endsection

@section("resource_title")
    Presupuesto #{{ $presupuesto->id }}
@endsection

@section("data")
    <div class="row">
        <div class="col s12 m6">
            <p><strong>Creado el:</strong> {{ $presupuesto->created_at }}</p>
            <p><strong>Última modificación:</strong> {{ $presupuesto->updated_at }}</p>
            <p><strong>Días de aceptación:</strong> {{ $presupuesto->aceptation_days }}</p>
            <p><strong>Descuento en %:</strong> {{ $presupuesto->percentage_discount }}%</p>
            <p><strong>Descuento en cantidad:</strong> {{ $presupuesto->amount_discount }}€</p>
            <p><strong>Notas:</strong> {{ $presupuesto->notes }}</p>
        </div>
        <div class="col s12 m6">
            <p><strong>ID del usuario que lo creó:</strong> {{ $presupuesto->user_id }}</p>
            <p><strong>Email del usuario que lo creó:</strong> {{ $presupuesto->user->email }}</p>
            <p><strong>ID del usuario de su última modificación:</strong> {{ $presupuesto->last_update_user_id }}</p>
            <p><strong>Email del usuario de su última modificación:</strong> {{ $presupuesto->last_update_user->email }}</p>
        </div>
    </div>
    @if($presupuesto->cliente != null)
    <div class="row">
        <div class="col s12">
            <p><strong>Cliente asociado:</strong> <a href="{{ route("cliente.show",[$presupuesto->cliente->id]) }}">{{ $presupuesto->cliente->name }}</a> </p>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col s12">
            <h3>Datos de facturación</h3>
        </div>
        <div class="col s12">
            <h4>Datos del emisor</h4>
        </div>
        @include("facturas._invoicing_data_show",["elem" => $presupuesto, "prefix" => "e_"])
        <div class="col s12">
            <h4>Datos del receptor</h4>
        </div>
        @include("facturas._invoicing_data_show",["elem" => $presupuesto, "prefix" => "r_"])
    </div>
    <div class="row">
        <div class="col s6">
            <div class="card indigo darken-1">
                <div class="card-content white-text">
                    <span class="card-title">Facturas:</span>
                </div>
                <div class="card-action indigo lighten-5 indigo-text">
                    <div class="row ">
                        <div class="col s12">
                            @foreach($facturas as $factura)
                                <p>Factura <a href="{{ route("factura.show",$factura->id) }}">#{{$factura->id}}</a> Importe: {{  $importe_facturas[$factura->id] }}€</p>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="card-action indigo lighten-5 indigo-text">
                    <span class="card-title">Importe total: {{ $presupuesto->importe_facturas }}€</span>
                </div>
            </div>
        </div>
        <div class="col s6">
            <div class="card indigo darken-1">
                <div class="card-content white-text">
                    <span class="card-title">Productos y/o servicios:</span>
                </div>
                <div class="card-action indigo lighten-5 indigo-text">
                    <div class="row ">
                        <div class="col s12">
                            @foreach($productos as $producto)
                                <p><a href="{{ route("producto.show",$producto->id) }}">{{ $producto->name }} - {{ $producto->price }}€</a></p>
                            @endforeach
                            @foreach($servicios as $servicio)
                                <p><a href="{{ route("servicio.show",$servicio->id) }}">{{ $servicio->name }} - {{ $servicio->price }}€</a></p>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="card-action indigo lighten-5 indigo-text">
                    <span class="card-title">Importe total: {{ $presupuesto->importe }}€
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection