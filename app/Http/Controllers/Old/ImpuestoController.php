<?php

namespace App\Http\Controllers;

use App\Impuesto;
use Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ImpuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $impuestos=Impuesto::orderBy('created_at', 'desc')->paginate(15);
        return view('impuestos.index',compact('impuestos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('impuestos.create');
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
            $impuesto = new Impuesto();
            $impuesto->user_id = Auth::id();
            $this->silentSave($impuesto,$request);
        } catch (ModelNotFoundException $e) {
            session()->flash('flash_message', 'Ha habido un error');
        }

        session()->flash('flash_message', 'Se ha creado el impuesto #'.$impuesto->id.' - '.$impuesto->name.' con éxito');
        return redirect()->route("impuesto.index");
    }

    /**
     * Basic save operation used for update & store.
     *
     * @param $impuesto
     * @param Request $request
     * @param bool $save
     * @return mixed
     */
    public function silentSave(&$impuesto, Request $request,$save = true)
    {
        $impuesto->last_update_user_id=Auth::id();
        $impuesto->name=$request->input('name');
        $impuesto->aplicable_to_all=$request->input('aplicable_to_all');
        $impuesto->fixed_amount=$request->input('fixed_amount');
        $impuesto->percentage=$request->input('percentage');
        ($save) ? $impuesto->save() : null;
        return $impuesto;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $impuesto=Impuesto::findOrFail($id);
        return view('impuestos.show',compact('impuesto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $impuesto=Impuesto::findOrFail($id);
        return view('impuestos.edit',compact('impuesto'));
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
            $impuesto = Impuesto::findOrFail($id);
            $this->silentSave($impuesto,$request);
        } catch (ModelNotFoundException $e) {
            session()->flash('flash_message', 'Ha habido un error');
        }

        session()->flash('flash_message', 'Se ha actualizado el impuesto #'.$impuesto->id.' - '.$impuesto->name.' con éxito');
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
        $impuesto = Impuesto::findOrFail($id);
        $impuesto->delete();
        session()->flash('flash_message', 'Se ha eliminado el impuesto #'.$id.' con éxito');
        return redirect()->route("impuesto.index");
    }

    /**
     * @param $name
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function search($name)
    {
        $impuestos = Impuesto::where("name",$name)->orderBy('created_at', 'desc')->paginate(10);
        return view("impuestos.index",compact("impuestos"));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($id)
    {
        try {
            $producto = Producto::findOrFail($id);
        } catch(NotFoundHttpException $e) {
            abort(404);
        }

        return response()->json($producto);
    }
}
