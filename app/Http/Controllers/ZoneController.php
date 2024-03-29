<?php

namespace App\Http\Controllers;

use App\Zone;
use App\Stand;
use Auth;
use Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zones = Zone::orderBy('created_at', 'desc')->paginate(15);
        return view('zones.index', compact('zones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('zones.create');
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
            $zone = new Zone();
            $zone->user_id = Auth::id();
            $this->silentSave($zone,$request);

        }catch (ModelNotFoundException $e){
            session()->flash('flash_message', 'Ha habido un error');
        }

        session()->flash('flash_message', 'Se ha creado la zona '.$zone->name.' con éxito');
        return redirect()->route('zone.index');
    }

    /**
     * Basic save operation used for update & store.
     *
     * @param $zone
     * @param Request $request
     * @param bool $save
     * @return mixed
     */
    public function silentSave(&$zone, Request $request, $save = true){
        $zone->name = $request->input('name');
        $zone->description = $request->input('description');
        $zone->last_update_user_id = Auth::id();
        $zone->thematic = $request->input('thematic');
        $zone->floor = $request->input('floor');

        ($save) ? $zone->save() : null;

        $stands = $request->input('stands');
        if (isset($stands)) {
            $current_stands = $zone->stands;
            foreach ($current_stands as $current_stand) {
                if (in_array($current_stand->id, $stands, true)){
                    unset($stands[$current_stand->id]);
                }
                else {
                    $current_stand->zone_id = null;
                    $current_stand->save();
                }
            }

            foreach ($stands as $stand_id) {
                $stand = Stand::findOrFail($stand_id);
                $zone->stands()->save($stand);
            }
        }
        else {
            $current_stands = $zone->stands;
            foreach ($current_stands as $current_stand) {
                $current_stand->zone_id = null;
                $current_stand->save();
            }
        }
        
        return $zone;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $zone = Zone::findOrFail($id);
        $stands= $zone->stands;
        return view('zones.show', compact('zone','stands'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $zone = Zone::findOrFail($id);

        $stands = $zone->stands;

        return view('zones.edit', compact('zone', 'stands'));
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
            $zone = Zone::findOrFail($id);
            $this->silentSave($zone,$request);
        } catch (ModelNotFoundException $e) {
            session()->flash('flash_message', 'Ha habido un error');
        }

        session()->flash('flash_message', 'Se ha actualizado la zona #'.$zone->id.' - '.$zone->name.' con éxito');
        return redirect()->route('zone.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $zone = Zone::findOrFail($id);
        $zone->delete();
        session()->flash('flash_message', 'Se ha eliminado la zona '.$id.' con éxito');
        return redirect()->route('zone.index');
    }

    /**
     * Returns an specific searched element
     *
     * @param $id
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function find($id)
    {
        $zone = Zone::findOrFail($id);
        return view('zones.show', compact('zone'));
    }

    /**
     * Searches for an especific zone name
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function search(Request $request)
    {
        $zones = Zone::where('name','like','%'.$request->input('search').'%')
            ->orWhere('id',$request->input('search'))
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('zones.index', compact('zones'));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll()
    {
        try {
            $zones = Zone::all();
        } catch(NotFoundHttpException $e) {
            abort(404);
        }

        return response()->json($zones);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($id)
    {
        try {
            $zone = Zone::findOrFail($id);
        } catch(NotFoundHttpException $e) {
            abort(404);
        }

        return response()->json($zone);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStands($id)
    {
        try {
            $zone = Zone::findOrFail($id);
            $stands = $zone->stands->toArray();
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
        return view("zones.associate_stand", compact("id"));
    }

    public function addStand(Request $request,$id){
        try{
            $zone = Zone::findOrFail($id);
            $stand = Stand::findOrFail($request->input('stand_id'));
            $zone->last_update_user_id = Auth::id();
            $zone->stands()->save($stand);

        }catch (ModelNotFoundException $e) {
            session()->flash('flash_message', 'Ha habido un error');
        }
        session()->flash('flash_message', 'Se ha asociado el stand #' . $request->input("stand_id") . ' a la zona #' . $zone->id . ' - ' . $zone->name . ' con éxito');
        return redirect()->route("zone.associate.stand", ["id" => $id]);

    }

}
