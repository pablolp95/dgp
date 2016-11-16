<?php

namespace App\Http\Controllers;

use App\Cliente;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::orderBy('created_at', 'desc')->paginate(15);
        return view("clientes.index",compact("clientes"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("clientes.create");
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
            $cliente = new Cliente();
            $cliente->user_id = Auth::id();
            $this->silentSave($cliente,$request);
        } catch (ModelNotFoundException $e) {
            session()->flash('flash_message', 'Ha habido un error');
        }

        session()->flash('flash_message', 'Se ha creado el cliente #'.$cliente->id.' - '.$cliente->name.' con éxito');
        return redirect()->route("cliente.index");
    }

    /**
     * Basic save operation used for update & store.
     *
     * @param $cliente
     * @param Request $request
     * @param bool $save
     * @return mixed
     */
    public function silentSave(&$cliente, Request $request,$save = true)
    {
        $cliente->last_update_user_id = Auth::id();
        $cliente->img_url = $request->input("img_url");
        $cliente->type = $request->input("type");
        $cliente->name = $request->input("name");
        $cliente->surname = $request->input("surname");
        $cliente->invoicing_name = $request->input("invoicing_name");
        $cliente->entity_type= $request->input("entity_type");
        $cliente->nif = $request->input("nif");
        $cliente->country = $request->input("country");
        $cliente->state = $request->input("state");
        $cliente->city = $request->input("city");
        $cliente->zip_code = $request->input("zip_code");
        $cliente->address_1 = $request->input("address_1");
        $cliente->address_2 = $request->input("address_2");
        $cliente->phone = $request->input("phone");
        $cliente->mobile = $request->input("mobile");
        $cliente->email = $request->input("email");
        $cliente->notes = $request->input("notes");
        ($save) ? $cliente->save() : null;
        return $cliente;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view("clientes.show",compact("cliente"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view("clientes.edit",compact("cliente"));
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
            $cliente = Cliente::findOrFail($id);
            $this->silentSave($cliente,$request);
        } catch (ModelNotFoundException $e) {
            session()->flash('flash_message', 'Ha habido un error');
        }

        session()->flash('flash_message', 'Se ha actualizado el cliente #'.$cliente->id.' - '.$cliente->name.' con éxito');
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
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();
        session()->flash('flash_message', 'Se ha eliminado el cliente #'.$id.' con éxito');
        return redirect()->route("cliente.index");
    }

    /**
     * Returns an specific searched element
     *
     * @param $id
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function find($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view("clientes.show",compact("cliente"));
    }

    /**
     * Searches for an especific client name or id
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function search(Request $request)
    {
        $clientes = Cliente::where("name",'like','%'.$request->input("search").'%')
            ->orWhere("nif",'like','%'.$request->input("search").'%')
            ->orWhere("id",$request->input("search"))
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view("clientes.index",compact("clientes"));
    }
}
