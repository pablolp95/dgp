<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Factura;
use App\Producto;
use App\Proyecto;
use App\Servicio;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facturas = Factura::orderBy('created_at', 'desc')->paginate(15);
        return view("facturas.index",compact("facturas"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("facturas.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $factura = new Factura();
            $factura->user_id = Auth::id();
            if($request->input("cliente_id") != null && $request->input("cliente_id") != "") {
                $cliente = Cliente::findOrFail($request->input("cliente_id"));
                $factura->cliente()->associate($cliente);
            }
            self::silentSave($factura,$request);
            $this->syncMany($factura,$request);
        } catch (ModelNotFoundException $e) {
            session()->flash('flash_message', 'Ha habido un error');
        }

        session()->flash('flash_message', 'Se ha creado la factura #'.$factura->id.' con éxito');
        return redirect()->route("factura.index");
    }

    /**
     * Syncs many to many relationships
     *
     * @param $factura
     * @param Request $request
     */
    private function syncMany(&$factura,Request $request)
    {
        $productos = array_filter(explode(",",$request->input("products_ids")));
        $servicios = array_filter(explode(",",$request->input("services_ids")));
        $impuestos = array_filter(explode(",",$request->input("taxes_ids")));
        $factura->productos()->sync($productos);
        $factura->servicios()->sync($servicios);
        $factura->impuestos()->sync($impuestos);
    }

    /**
     * Gets invoice total from attached products and services.
     * It mind taxes.
     * @param Factura $factura
     * @return int|mixed
     */
    public static function getTotalFromInvoice(Factura &$factura) {
        $total = 0;
        foreach($factura->productos as $producto) {
            $total += $producto->price;
        }
        foreach($factura->servicios as $servicio) {
            $total += $servicio->price;
        }

        $total -= ($total*($factura->percentage_discount/100));

        $total -= $factura->amount_discount;

        foreach($factura->impuestos as $impuesto){
            $total += ($total*($impuesto->percentage/100));
            $total += $impuesto->fixed_amount;
        }

        return round($total,2);
    }

    /**
     * Basic save operation used for update & store.
     *
     * @param $factura
     * @param Request $request
     * @param bool $save
     * @return mixed
     */
    public static function silentSave(&$factura, Request $request,$save = true)
    {
        $factura->last_update_user_id = Auth::id();
        $factura->aceptation_days = $request->input("aceptation_days");
        $factura->percentage_discount = $request->input("percentage_discount");
        $factura->amount_discount = $request->input("amount_discount");
        $factura->notes = $request->input("notes");

        $factura->r_invoicing_name = $request->input("r_invoicing_name");
        $factura->r_entity_type= $request->input("r_entity_type");
        $factura->r_nif = $request->input("r_nif");
        $factura->r_country = $request->input("r_country");
        $factura->r_state = $request->input("r_state");
        $factura->r_city = $request->input("r_city");
        $factura->r_zip_code = $request->input("r_zip_code");
        $factura->r_address_1 = $request->input("r_address_1");
        $factura->r_address_2 = $request->input("r_address_2");        
        $factura->e_invoicing_name = $request->input("e_invoicing_name");
        $factura->e_entity_type= $request->input("e_entity_type");
        $factura->e_nif = $request->input("e_nif");
        $factura->e_country = $request->input("e_country");
        $factura->e_state = $request->input("e_state");
        $factura->e_city = $request->input("e_city");
        $factura->e_zip_code = $request->input("e_zip_code");
        $factura->e_address_1 = $request->input("e_address_1");
        $factura->e_address_2 = $request->input("e_address_2");

        ($save) ? $factura->save() : null;
        return $factura;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $factura = Factura::findOrFail($id);
        $productos = $factura->productos;
        $servicios = $factura->servicios;
        $impuestos = $factura->impuestos;
        $total = self::getTotalFromInvoice($factura);
        return view("facturas.show",compact("factura","productos","servicios","impuestos","total"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $factura = Factura::findOrFail($id);
        $productos = $factura->productos;
        $servicios = $factura->servicios;
        $ids_productos = [];
        $ids_servicios = [];
        foreach($productos as $producto) {
            array_push($ids_productos,$producto->id);
        }
        foreach($servicios as $servicio) {
            array_push($ids_servicios,$servicio->id);
        }
        $factura->products_ids = implode(",",$ids_productos);
        $factura->services_ids = implode(",",$ids_servicios);

        return view("facturas.edit",compact("factura"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $factura = Factura::findOrFail($id);
            if($request->input("cliente_id") != null && $request->input("cliente_id") != "") {
                $cliente = Cliente::findOrFail($request->input("cliente_id"));
                $factura->cliente()->associate($cliente);
            }
            self::silentSave($factura,$request);
            $this->syncMany($factura,$request);
        } catch (ModelNotFoundException $e) {
            session()->flash('flash_message', 'Ha habido un error');
        }

        session()->flash('flash_message', 'Se ha actualizado la factura #'.$factura->id.' con éxito');
        return redirect()->route("dashboard");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $factura = Factura::findOrFail($id);
        $factura->delete();
        session()->flash('flash_message', 'Se ha eliminado la factura #'.$id.' con éxito');
        return redirect()->route("factura.index");
    }

    /**
     * Returns an specific searched element
     *
     * @param $id
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function find($id)
    {
        $factura = Factura::findOrFail($id);
        return view("facturas.show",compact("factura"));
    }

    /**
     * Searches for an especific invoice id
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function search(Request $request)
    {
        $facturas = Factura::where("id","like","%".$request->input("search")."%")
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view("facturas.index",compact("facturas"));
    }
}
