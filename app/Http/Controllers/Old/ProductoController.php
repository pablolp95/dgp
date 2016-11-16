<?php

namespace App\Http\Controllers;

use App\Producto;
use Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::orderBy('created_at', 'desc')->paginate(15);
        return view("productos.index",compact("productos"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("productos.create");
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
            $producto = new Producto();
            $producto->user_id = Auth::id();
            $this->silentSave($producto,$request);
        } catch (ModelNotFoundException $e) {
            session()->flash('flash_message', 'Ha habido un error');
        }

        session()->flash('flash_message', 'Se ha creado el producto #'.$producto->id.' - '.$producto->name.' con éxito');
        return redirect()->route("producto.index");
    }

    /**
     * Basic save operation used for update & store.
     *
     * @param $producto
     * @param Request $request
     * @param bool $save
     * @return mixed
     */
    public function silentSave(&$producto, Request $request,$save = true)
    {
        $producto->last_update_user_id = Auth::id();
        $producto->name = $request->input("name");
        $producto->description = $request->input("description");
        $producto->price = $request->input("price");
        $producto->img_url = $request->input("img_url");
        $producto->development_time = $request->input("development_time");
        $producto->status = $request->input("status");
        ($save) ? $producto->save() : null;
        return $producto;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        return view("productos.show",compact("producto"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        return view("productos.edit",compact("producto"));
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
            $producto = Producto::findOrFail($id);
            $this->silentSave($producto,$request);
        } catch (ModelNotFoundException $e) {
            session()->flash('flash_message', 'Ha habido un error');
        }

        session()->flash('flash_message', 'Se ha actualizado el producto #'.$producto->id.' - '.$producto->name.' con éxito');
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
        $producto = Producto::findOrFail($id);
        $producto->delete();
        session()->flash('flash_message', 'Se ha eliminado el producto #'.$id.' con éxito');
        return redirect()->route("producto.index");
    }

    /**
     * Returns an specific searched element
     *
     * @param $id
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function find($id)
    {
        $producto = Producto::findOrFail($id);
        return view("productos.show",compact("producto"));
    }

    /**
     * Searches for an especific product name
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function search(Request $request)
    {
        $productos = Producto::where("name",'like','%'.$request->input("search").'%')
            ->orWhere("id",$request->input("search"))
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view("productos.index",compact("productos"));
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
