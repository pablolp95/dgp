<?php

namespace App\Http\Controllers;

use App\Route;
use App\Stand;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $routes= Route::orderBy('created_at', 'desc')->paginate(15);
        return view('routes.index',compact('routes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('routes.create');
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
            $route=new Route();
            $route->user_id=Auth::id();
            $this->silentSave($route,$request);

        }catch (ModelNotFoundException $e){
            session()->flash('flash_message', 'Ha habido un error');
        }

        session()->flash('flash_message', 'Se ha creado la ruta #' . $route->id . ' - ' . $route->name . ' con éxito');
        return redirect()->route("route.index");

    }
    public function silentSave(&$route,Request $request,$save=true){

        $route->last_update_user_id=Auth::id();
        $route->floor=$request->input('floor');
        $route->description=$request->input('description');
        $route->name=$request->input('name');
        ($save) ? $route->save() : null;

        return $route;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $route = Route::findOrFail($id);
        $stands = $route->stands;
        return view('routes.show',compact('route','stands'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $route = Route::findOrFail($id);
        return view('routes.edit',compact('route'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function associateStand($id){
        return view("routes.associate_stand", compact("id"));
    }
    public function addStand(Request $request,$id){
       try{
        $route=Route::findOrFail($id);
        $stand=Stand::findOrFail($request->input('stand_id'));
        $route->last_update_user_id=Auth::id();
        $route->stands()->save($stand);
        session()->flash('flash_message', 'Se ha asociado el stand #' . $request->input("stand_id") . ' a la ruta #' . $route->id . ' - ' . $route->name . ' con éxito');

       }catch (ModelNotFoundException $e) {
            session()->flash('flash_message', 'Ha habido un error');
        }
return redirect()->route("route.associate.stand", ["id" => $id]);

    }
    public function update(Request $request, $id)
    {
        try{
        $route=Route::findOrFail($id);
        $this->silentSave($route,$request);
        }catch (ModelNotFoundException $e) {
            session()->flash('flash_message', 'Ha habido un error');
        }

    session()->flash('flash_message', 'Se ha actualizado el audio '.$route->id.' - '.$route    ->name.' con éxito');
        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $route=Route::findOrFail($id);
        $route->delete();
        session()->flash('flash_message', 'Se ha eliminado la ruta '.$id.' con éxito');
        return redirect()->route('route.index');
    }

    public function search(Request $request)
    {
        $routes= Route::where('name','like','%'.$request->input('search').'%')
            ->orWhere('id',$request->input('search'))
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('routes.index',compact('routes'));
    }
}
