<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stand;
use App\Audio;
use Auth;


use App\Http\Requests;
use App\Http\Controllers\Controller;

class StandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stands=Stand::orderBy('created_at', 'desc')->paginate(15);
        return view('stands.index',compact('stands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('stands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stand=Stand::findOrFail($id);
        return view('stands.show',compact('stand'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stand=Stand::findOrFail($id);
        return view('stands.edit',compact('stand'));
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
        //
    }

    public function destroy($id)
    {
        $stand = Stand::findOrFail($id);
        $stand->delete();
        session()->flash('flash_message', 'Se ha eliminado el stand'.$id.' con éxito');
        return redirect()->route('zone.index');
    }
    public function associateAudio($id){
        return view("stands.associate_audio", compact("id"));
    }
    public function addAudio(Request $request,$id){
        try{
            $stand=Stand::findOrFail($id);
            $audio=Audio::findOrFail($request->input('audio_id'));
            $stand->last_update_user_id=Auth::id();
            $stand->audio()->save($audio);

        }catch (ModelNotFoundException $e) {
            session()->flash('flash_message', 'Ha habido un error');
        }
        session()->flash('flash_message', 'Se ha asociado el audio #' . $request->input("audio_id") . ' al stand #' . $stand->id . ' - ' . $stand->name . ' con éxito');
        return redirect()->route("stand.associate.audio", ["id" => $id]);

    }
    public function associateVideo($id){
        return view("stands.associate_video", compact("id"));
    }
    public function addvideo(Request $request,$id){
        try{
            $stand=Stand::findOrFail($id);
            $video=video::findOrFail($request->input('video_id'));
            $stand->last_update_user_id=Auth::id();
            $stand->video()->save($video);

        }catch (ModelNotFoundException $e) {
            session()->flash('flash_message', 'Ha habido un error');
        }
        session()->flash('flash_message', 'Se ha asociado el video #' . $request->input("video_id") . ' al stand #' . $stand->id . ' - ' . $stand->name . ' con éxito');
        return redirect()->route("stand.associate.video", ["id" => $id]);

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
}
