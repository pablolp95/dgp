<?php

namespace App\Http\Controllers;
use App\Video;

use Auth;
use Log;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $videos = Video::orderBy('created_at', 'desc')->paginate(15);
        return view('videos.index',compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('videos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        try{
            $videos = new Video();
            $videos->user_id = Auth::id();
            $this->silentSave($videos,$request);
        } catch (ModelNotFoundException $e) {
            session()->flash('flash_message', 'Ha habido un error');
        }

        session()->flash('flash_message', 'Se ha creado el audio #'.$videos->id.' - '.$videos->name.' con éxito');
        return redirect()->route('video.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function silentSave(&$videos, Request $request, $save = true)
    {
        $videos->last_update_user_id = Auth::id();
        $videos->name = $request->input('name');
        $videos->description = $request->input('description');
        $videos->language = $request->input('language');
        $videos->video_url = $request->input('video_url');
        if ($request->hasFile('video')) {
            if ($request->file('video')->isValid()) {
                $request->file('video')->move(base_path()."/storage/app/video/", $request->file('videos')->getFilename());
            }
        }
        ($save) ? $videos->save() : null;
        return $videos;
    }

    public function show($id)
    {
        $videos = Video::findOrFail($id);
        return view('videos.show',compact('videos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $videos = Video::findOrFail($id);
        return view('videos.edit',compact('videos'));
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
            $videos = Video::findOrFail($id);
            $this->silentSave($videos,$request);
        } catch (ModelNotFoundException $e) {
            session()->flash('flash_message', 'Ha habido un error');
        }

        session()->flash('flash_message', 'Se ha actualizado el audio #'.$videos->id.' - '.$videos->name.' con éxito');
        return redirect()->route('dashboard');
    }
    public function search(Request $request)
    {
        $videos = Video::where('name','like','%'.$request->input('search').'%')
            ->orWhere('id',$request->input('search'))
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('videos.index',compact('videos'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $videos = Video::findOrFail($id);
        $videos->delete();
        session()->flash('flash_message', 'Se ha eliminado el audio #'.$id.' con éxito');
        return redirect()->route('videos.index');
    }
}
