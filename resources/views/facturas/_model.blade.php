<div class="row">

    <div class="col s12">
        <h3>Datos de cliente:</h3>
    </div>

    <!-- Client field -->
    <div class="input-field col s12 m6">
        {!! Form::text("cliente_id", null, ["id" => "cliente_id","class" => "validate"]) !!}
        {!! Form::label("cliente_id", "Asociar a ID de cliente (dejar en blanco si asociada a proyecto):") !!}
    </div>

    <!-- Aceptation field -->
    <div class="input-field col s12 m6">
        {!! Form::text("aceptation_days", null, ["id" => "aceptation_days","class" => "validate"]) !!}
        {!! Form::label("aceptation_days", "Días para aceptación:") !!}
    </div>

    <!-- Percentage field -->
    <div class="input-field col s12 m6">
        {!! Form::text("percentage_discount", null, ["id" => "percentage_discount","class" => "validate"]) !!}
        {!! Form::label("percentage_discount", "Descuento en porcentaje:") !!}
    </div>

    <!-- Amount discount field -->
    <div class="input-field col s12 m6">
        {!! Form::text("amount_discount", null, ["id" => "amount_discount","class" => "validate"]) !!}
        {!! Form::label("amount_discount", "Descuento sobre el total:") !!}
    </div>

    <!-- Notas field -->
    <div class="input-field col s12">
        {!! Form::text("notes", null, ["id" => "notes","class" => "validate"]) !!}
        {!! Form::label("notes", "Notas:") !!}
    </div>

    <!-- IDs de productos field -->
    <div class="input-field col s12 m6">
        {!! Form::text("products_ids", null, ["id" => "products_ids","class" => "validate"]) !!}
        {!! Form::label("products_ids", "IDs de los productos separados por comas:") !!}
    </div>

    <!-- IDs de servicios field -->
    <div class="input-field col s12 m6">
        {!! Form::text("services_ids", null, ["id" => "services_ids","class" => "validate"]) !!}
        {!! Form::label("services_ids", "IDs de los servicios separados por comas:") !!}
    </div>

    <!-- Totales -->
    <div class="col s12">
        <a id="get_total" class="waves-effect waves-light btn indigo">Calcular total</a>
        <a id="apply_discounts" class="waves-effect waves-light btn indigo">Aplicar descuentos</a>
    </div>

    <div class="col s12">
        <p class="flow-text">Total de factura: <strong><span id="total_amount">0</span></strong>€</p>
    </div>

    <!-- Taxes ids field -->
    <div class="input-field col s12">
        {!! Form::text("taxes_ids", null, ["id" => "taxes_ids","class" => "validate"]) !!}
        {!! Form::label("taxes_ids", "IDs de los impuestos separados por comas:") !!}
    </div>

    <div class="col s12">
        <h3>Datos de facturación:</h3>
    </div>

    <div class="col s12">
        <h4>Emisor</h4>
    </div>
    @include("facturas._invoicing_data",["prefix" => "e_"])
    <div class="col s12">
        <h4>Receptor</h4>
    </div>
    @include("facturas._invoicing_data",["prefix" => "r_"])


    <div class="col s12">
        {!! Form::button("Guardar", ["type" => "submit", "class" => "btn waves-effect waves-light right indigo"]) !!}
    </div>

    <div class="col s12">
        <div class="clearfix"></div>
    </div>
</div>
