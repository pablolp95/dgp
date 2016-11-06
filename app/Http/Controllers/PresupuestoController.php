<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Presupuesto;
use App\Proyecto;
use App\Factura;
use Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PresupuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $presupuestos = Presupuesto::orderBy('created_at', 'desc')->paginate(15);
        return view('presupuestos.index', compact('presupuestos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('presupuestos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $presupuesto = new Presupuesto();
            $presupuesto->user_id = Auth::id();
            if ($request->input("cliente_id") != null && $request->input("cliente_id") != "") {
                $cliente = Cliente::findOrFail($request->input("cliente_id"));
                $presupuesto->cliente()->associate($cliente);
            }
            PresupuestoController::silentSave($presupuesto, $request);
            $this->syncMany($presupuesto, $request);
        } catch (ModelNotFoundException $e) {
            session()->flash('flash_message', 'Ha habido un error');
        }

        session()->flash('flash_message', 'Se ha creado el presupuesto #' . $presupuesto->id . ' con éxito');
        return redirect()->route("presupuesto.index");
    }

    /**
     * @param $presupuesto
     * @param Request $request
     */
    private function syncMany(&$presupuesto, Request $request)
    {
        $productos = array_filter(explode(",", $request->input("products_ids")));
        $servicios = array_filter(explode(",", $request->input("services_ids")));
        $presupuesto->productos()->sync($productos);
        $presupuesto->servicios()->sync($servicios);
    }

    /**
     * Gets proposal total from attached products and services.
     * It mind taxes.
     * @param Presupuesto $presupuesto
     * @return int|mixed
     */
    public static function getTotalFromProposal(Presupuesto &$presupuesto) {
        $total = 0;
        foreach($presupuesto->productos as $producto) {
            $total += $producto->price;
        }
        foreach($presupuesto->servicios as $servicio) {
            $total += $servicio->price;
        }

        $total -= ($total*($presupuesto->percentage_discount/100));

        $total -= $presupuesto->amount_discount;

        return round($total,2);
    }

    /**
     * Basic save operation used for update & store.
     *
     * @param $presupuesto
     * @param Request $request
     * @param bool $save
     * @return mixed
     */
    public static function silentSave(&$presupuesto, Request $request, $save = true)
    {
        $presupuesto->last_update_user_id = Auth::id();
        $presupuesto->aceptation_days = $request->input("aceptation_days");
        $presupuesto->percentage_discount = $request->input("percentage_discount");
        $presupuesto->amount_discount = $request->input("amount_discount");
        $presupuesto->notes = $request->input("notes");

        $presupuesto->r_invoicing_name = $request->input("r_invoicing_name");
        $presupuesto->r_entity_type = $request->input("r_entity_type");
        $presupuesto->r_nif = $request->input("r_nif");
        $presupuesto->r_country = $request->input("r_country");
        $presupuesto->r_state = $request->input("r_state");
        $presupuesto->r_city = $request->input("r_city");
        $presupuesto->r_zip_code = $request->input("r_zip_code");
        $presupuesto->r_address_1 = $request->input("r_address_1");
        $presupuesto->r_address_2 = $request->input("r_address_2");
        $presupuesto->e_invoicing_name = $request->input("e_invoicing_name");
        $presupuesto->e_entity_type = $request->input("e_entity_type");
        $presupuesto->e_nif = $request->input("e_nif");
        $presupuesto->e_country = $request->input("e_country");
        $presupuesto->e_state = $request->input("e_state");
        $presupuesto->e_city = $request->input("e_city");
        $presupuesto->e_zip_code = $request->input("e_zip_code");
        $presupuesto->e_address_1 = $request->input("e_address_1");
        $presupuesto->e_address_2 = $request->input("e_address_2");

        ($save) ? $presupuesto->save() : null;
        return $presupuesto;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $presupuesto = Presupuesto::findOrFail($id);
        $facturas = $presupuesto->facturas;
        $productos = $presupuesto->productos;
        $servicios = $presupuesto->servicios;
        $importe_facturas = [];
        foreach ($facturas as $factura) {
            $importe_facturas[$factura->id] = FacturaController::getTotalFromInvoice($factura);
        }
        $presupuesto->importe = 0;
        foreach($productos as $producto) {
            $presupuesto->importe += $producto->price;
        }
        foreach($servicios as $servicio) {
            $presupuesto->importe += $servicio->price;
        }
        $presupuesto->importe_facturas = array_sum($importe_facturas);
        return view('presupuestos.show', compact('presupuesto', 'facturas', 'importe_facturas', 'productos', 'servicios'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $presupuesto = Presupuesto::findOrFail($id);
        $productos = $presupuesto->productos;
        $servicios = $presupuesto->servicios;
        $ids_productos = [];
        $ids_servicios = [];
        foreach ($productos as $producto) {
            array_push($ids_productos, $producto->id);
        }
        foreach ($servicios as $servicio) {
            array_push($ids_servicios, $servicio->id);
        }
        $presupuesto->products_ids = implode(",", $ids_productos);
        $presupuesto->services_ids = implode(",", $ids_servicios);

        return view('presupuestos.edit', compact('presupuesto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $presupuesto = Presupuesto::findOrFail($id);
            if ($request->input("cliente_id") != null && $request->input("cliente_id") != "" && $request->input("cliente_id") != $presupuesto->cliente->id) {
                $cliente = Cliente::findOrFail($request->input("cliente_id"));
                $presupuesto->cliente()->save($cliente);
            }
            PresupuestoController::silentSave($presupuesto, $request);
            $this->syncMany($presupuesto, $request);
        } catch (ModelNotFoundException $e) {
            session()->flash('flash_message', 'Ha habido un error');
        }

        session()->flash('flash_message', 'Se ha actualizado el prespuesto #' . $presupuesto->id . ' con éxito');
        return redirect()->route("dashboard");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $presupuesto = Presupuesto::findOrFail($id);
        $presupuesto->delete();
        session()->flash('flash_message', 'Se ha eliminado el presupuesto #' . $id . ' con éxito');
        return redirect()->route("presupuesto.index");
    }

    /**
     * Returns an specific searched element
     *
     * @param $id
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function find($id)
    {
        $presupuesto = Presupuesto::findOrFail($id);
        return view("presupuesto.show", compact("presupuesto"));
    }

    public function associateInvoice($id)
    {
        return view("presupuestos.associate_invoice", compact("id"));
    }

    public function search(Request $request)
    {
        $presupuestos = Presupuesto::where("id",'like','%'.$request->input("search").'%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view("presupuestos.index",compact("presupuestos"));
    }

    public function addInvoice(Request $request, $id)
    {
        try {
            $presupuesto = Presupuesto::findOrFail($id);
            $invoice = Factura::findOrFail($request->input("invoice_id"));
            $presupuesto->last_update_user_id = Auth::id();
            $presupuesto->facturas()->save($invoice);
            session()->flash('flash_message', 'Se ha asociado la factura #' . $request->input("invoice_id") . ' al presupuesto #' . $presupuesto->id . ' con éxito');
        } catch (ModelNotFoundException $e) {
            session()->flash('flash_message', 'Ha habido un error');
        }
        return redirect()->route("presupuesto.associate.invoice", ["id" => $id]);
    }

}
