<?php

namespace App\Http\Controllers;

use App\Servicio;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servicios = Servicio::orderBy('created_at', 'desc')->paginate(15);
        return view("servicios.index",compact("servicios"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("servicios.create");
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
            $servicio = new Servicio();
            $servicio->user_id = Auth::id();
            $this->silentSave($servicio,$request);
        } catch (ModelNotFoundException $e) {
            session()->flash('flash_message', 'Ha habido un error');
        }

        session()->flash('flash_message', 'Se ha creado el servicio #'.$servicio->id.' - '.$servicio->name.' con éxito');
        return redirect()->route("servicio.index");
    }

    /**
     * Basic save operation used for update & store.
     *
     * @param $servicio
     * @param Request $request
     * @param bool $save
     * @return mixed
     */
    public function silentSave(&$servicio, Request $request,$save = true)
    {
        $servicio->last_update_user_id = Auth::id();
        $servicio->name = $request->input("name");
        $servicio->description = $request->input("description");
        $servicio->price = $request->input("price");
        $servicio->img_url = $request->input("img_url");
        $servicio->development_time = $request->input("development_time");
        $servicio->starting_date = $request->input("starting_date_submit");
        $servicio->ending_date = $request->input("ending_date_submit");
        $servicio->invoice_period = $request->input("invoice_period");
        $servicio->status = $request->input("status");
        ($save) ? $servicio->save() : null;
        return $servicio;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $servicio = Servicio::findOrFail($id);
        return view("servicios.show",compact("servicio"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $servicio = Servicio::findOrFail($id);
        return view("servicios.edit",compact("servicio"));
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
            $servicio = Servicio::findOrFail($id);
            $this->silentSave($servicio,$request);
        } catch (ModelNotFoundException $e) {
            session()->flash('flash_message', 'Ha habido un error');
        }

        session()->flash('flash_message', 'Se ha actualizado el servicio #'.$servicio->id.' - '.$servicio->name.' con éxito');
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
        $servicio = Servicio::findOrFail($id);
        $servicio->delete();
        session()->flash('flash_message', 'Se ha eliminado el servicio #'.$id.' con éxito');
        return redirect()->route("servicio.index");
    }

    /**
     * Returns an specific searched element
     *
     * @param $id
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function find($id)
    {
        $servicio = Servicio::findOrFail($id);
        return view("servicios.show",compact("servicio"));
    }

    /**
     * Searches for an especific service name
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function search(Request $request)
    {
        $servicios = Servicio::where("name",'like','%'.$request->input("search").'%')
            ->orWhere("id",$request->input("search"))
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view("servicios.index",compact("servicios"));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($id)
    {
        try {
            $servicio = Servicio::findOrFail($id);
        } catch(NotFoundHttpException $e) {
            abort(404);
        }

        return response()->json($servicio);
    }
}
