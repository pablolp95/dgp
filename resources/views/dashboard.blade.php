<?php
$dashboard_elems = [
        route("producto.create") => ["deployment", "Crear productos",["admin"]],
        route("servicio.create") => ["add_database", "Crear servicios",["admin"]],
        route("producto.index") => ["shop", "Productos",["admin"]],
        route("servicio.index") => ["accept_database", "Servicios",["admin"]],
        route("proyecto.index") => ["opened_folder", "Proyectos", ["administrativo","admin"]],
        route("proyecto.create") => ["idea", "Crear proyecto", ["administrativo","admin"]],
        route("cliente.index") => ["contacts", "Agenda", ["administrativo","admin"]],
        route("cliente.create") => ["good_decision", "Nuevo cliente", ["administrativo","admin"]],
        route("factura.index") => ["filing_cabinet", "Ver facturas", ["financiero","admin"]],
        route("factura.create") => ["invite", "Nueva factura", ["financiero","admin"]],
        route("usuario.index") => ["address_book", "Usuarios", ["administrativo","admin"]],
        route("usuario.create") => ["key", "Crear usuario", ["administrativo","admin"]],
        route("presupuesto.index") => ["money_transfer","Presupuestos",["administrativo","admin"]],
        route("presupuesto.create") => ["calculator","Nuevo presupuesto",["administrativo","admin"]],
        route("impuesto.index") => ["list","Impuestos", ["financiero","admin"]],
        route("impuesto.create") => ["donate","Nuevo impuesto", ["financiero","admin"]]
];
$i=1;
?>
@extends('main')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="container">
        <div class="row padded">
            <div class="col s12">
                <div class="row">
                    <div class="col s12">
                        <h1 class="grey-text text-darken-4">Bienvenido a tu panel, {{ $name }}</h1>
                        <h5 class="grey-text text-darken-1">¿Qué deseas hacer?</h5>
                    </div>
                </div>
                <div class="row">
                    @foreach($dashboard_elems as $url => $elem)
                        <?php $can_see = false; ?>
                        @foreach($elem[2] as $role)
                            <?php (Entrust::hasRole($role)) ? $can_see = true : null; ?>
                        @endforeach
                        @if($can_see)
                            @if($i%4 == 0)<div class="row"> @endif
                            <a href="{!! $url !!}">
                                <div class="col s12 m4 l3 dashboard-item">
                                    <div class="dashboard-item-icon">
                                        <img src="/components/flat-color-icons/svg/{{ $elem[0] }}.svg">
                                    </div>
                                    <div class="dashboard-item-text center-align uppercase">
                                        {{ $elem[1] }}
                                    </div>
                                </div>
                            </a>
                            @if($i%4 == 0) </div> @endif
                            <?php $i++; ?>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        initHome();
    </script>
@endsection