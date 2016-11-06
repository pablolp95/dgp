<div class="col s12">
    <p><strong>Nombre:</strong> {{ $elem[$prefix."invoicing_name"] }}</p>
    <p><strong>Tipo de entidad:</strong> {{ $elem[$prefix."entity_type"] }}</p>
    <p><strong>NIF/CIF:</strong> {{ $elem[$prefix."nif"] }}</p>
    <p><strong>País:</strong> {{ App\Cliente::$countries[$elem[$prefix."country"]] }}</p>
    <p><strong>Provincia:</strong> {{ App\Cliente::$provinces[$elem[$prefix."state"]] }}</p>
    <p><strong>Ciudad:</strong> {{ $elem[$prefix."city"] }}</p>
    <p><strong>Código postal:</strong> {{ $elem[$prefix."zip_code"] }}</p>
    <p><strong>Dirección 1:</strong> {{ $elem[$prefix."address_1"] }}</p>
    <p><strong>Dirección 2:</strong> {{ $elem[$prefix."address_2"] }}</p>
</div>