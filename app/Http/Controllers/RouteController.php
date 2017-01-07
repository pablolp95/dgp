<?php

namespace App\Http\Controllers;

use App\Route;
use App\Stand;
use Auth;
use Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Validator;
class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $routes = Route::orderBy('created_at', 'desc')->paginate(15);
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
            $route = new Route();
            $route->user_id = Auth::id();
            $this->silentSave($route,$request);

        }catch (ModelNotFoundException $e){
            session()->flash('flash_message', 'Ha habido un error');
        }

        session()->flash('flash_message', 'Se ha creado la ruta #' . $route->id . ' - ' . $route->name . ' con éxito');
        return redirect()->route("route.index");

    }

    /**
     * Basic save operation used for update & store.
     *
     * @param $route
     * @param Request $request
     * @param bool $save
     * @return mixed
     */
    public function silentSave(&$route,Request $request,$save=true){

        $route->last_update_user_id = Auth::id();
        $route->floor = $request->input('floor');
        $route->description = $request->input('description');
        $route->name = $request->input('name');
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
    public function update(Request $request, $id)
    {
        $route = Route::findOrFail($id);
        $validator=Validator::make($request->all(),['name'=> 'required|min:3|max:100','description' => 'required|min:2|max:500', 'floor'=>'required|numeric|min:0|max:5']);
        if($validator->fails()){
            $errors=$validator->errors();
            $cadena='';
            foreach ($errors->all() as $message) {
                $cadena = $cadena.$message.' ';
            }
            session()->flash('flash_message','ERROR:'.$cadena);
            return redirect()->route('routes.edit',['id'=>$id])->withErrors($validator)->withInput();;
        }
        else {

            try {
                $route = Route::findOrFail($id);
                $this->silentSave($route, $request);
            } catch (ModelNotFoundException $e) {
                session()->flash('flash_message', 'Ha habido un error');
            }

            session()->flash('flash_message', 'Se ha actualizado el audio ' . $route->id . ' - ' . $route->name . ' con éxito');
            return redirect()->route('dashboard');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $route = Route::findOrFail($id);
        $route->delete();
        session()->flash('flash_message', 'Se ha eliminado la ruta '.$id.' con éxito');
        return redirect()->route('route.index');
    }

    /**
     * Returns an specific searched element
     *
     * @param $id
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function find($id)
    {
        $route = Route::findOrFail($id);
        return view('route.show',compact('route'));
    }

    /**
     * Searches for an especific route name
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function search(Request $request)
    {
        $routes = Route::where('name','like','%'.$request->input('search').'%')
            ->orWhere('id',$request->input('search'))
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('route.index',compact('routes'));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll()
    {
        try {
            $routes = Route::all();
        } catch(NotFoundHttpException $e) {
            abort(404);
        }

        return response()->json($routes);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($id)
    {
        try {
            $route = Route::findOrFail($id);
        } catch(NotFoundHttpException $e) {
            abort(404);
        }

        return response()->json($route);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStands($id)
    {
        try {
            $route = Route::findOrFail($id);
            $stands = $route->stands->toArray();
        } catch(NotFoundHttpException $e) {
            abort(404);
        }

        return response()->json($stands);
    }
    
    /**
     * Display the view to associate an stand to an specific zone.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function associateStand($id){
        return view("routes.associate_stand", compact("id"));
    }

    public function addStand(Request $request,$id){
       try{
           $route = Route::findOrFail($id);
            $stand = Stand::findOrFail($request->input('stand_id'));
            $route->last_update_user_id = Auth::id();
            $route->stands()->save($stand);
            session()->flash('flash_message', 'Se ha asociado el stand #' . $request->input("stand_id") . ' a la ruta #' . $route->id . ' - ' . $route->name . ' con éxito');
       }catch (ModelNotFoundException $e) {
            session()->flash('flash_message', 'Ha habido un error');
       }
        return redirect()->route("route.associate.stand", ["id" => $id]);

    }

}
