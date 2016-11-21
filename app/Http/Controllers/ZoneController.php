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
        return view('zones.index',compact("zones"));
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
            $zona=new Zone();
            $zona->user_id=Auth::id();
            $this->silentSave($zona,$request);

        }catch (ModelNotFoundException $e){
            session()->flash('flash_message', 'Ha habido un error');
        }

        session()->flash('flash_message', 'Se ha creado la zona '.$zona->name.' con éxito');
        return redirect()->route('zone.index');
    }
    public function silentSave(&$zona, Request $request, $save = true){
        $zona->name=$request->input('name');
        $zona->description= $request->input('description');
        $zona->last_update_user_id= Auth::id();
        $zona->thematic= $request->input('thematic');
        $zona->floor= $request->input('floor');

        ($save) ? $zona->save() : null;
        return $zona;
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
        return view('zones.show',compact('zone','stands'));
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
        return view('zones.edit',compact('zone'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function associateStand($id){
        return view("zones.associate_stand", compact("id"));
    }
    public function addStand(Request $request,$id){
        try{
            $zone=Zone::findOrFail($id);
            $stand=Stand::findOrFail($request->input('stand_id'));
            $zone->last_update_user_id=Auth::id();
            $zone->stands()->save($stand);

        }catch (ModelNotFoundException $e) {
            session()->flash('flash_message', 'Ha habido un error');
        }
        session()->flash('flash_message', 'Se ha asociado el stand #' . $request->input("stand_id") . ' a la zona #' . $zone->id . ' - ' . $zone->name . ' con éxito');
        return redirect()->route("zone.associate.stand", ["id" => $id]);

    }
    public function update(Request $request, $id)
    {
        try{
            $zone = Zone::findOrFail($id);
            $this->silentSave($zone,$request);
        } catch (ModelNotFoundException $e) {
            session()->flash('flash_message', 'Ha habido un error');
        }

        session()->flash('flash_message', 'Se ha actualizado el audio #'.$zone->id.' - '.$zone->name.' con éxito');
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
        $zone = Zone::findOrFail($id);
        $zone->delete();
        session()->flash('flash_message', 'Se ha eliminado la zona '.$id.' con éxito');
        return redirect()->route('zone.index');
    }
    public function search(Request $request)
    {
        $zones = Zone::where('name','like','%'.$request->input('search').'%')
            ->orWhere('id',$request->input('search'))
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('zones.index',compact('zones'));
    }
}
