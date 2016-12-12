<?php

namespace App\Http\Controllers;

use App\Video;
use App\Language;
use App\Helpers\Stream;
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
        $videos = Video::orderBy('created_at', 'desc')->paginate(15);
        return view('videos.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $available = Language::all()->sortBy('language');
        $languages = array();

        foreach ($available as $language){
            $languages[$language->id] = $language->language;
        }

        return view('videos.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        try{
            $video = new Video();
            $video->user_id = Auth::id();
            $this->silentSave($video,$request);
        } catch (ModelNotFoundException $e) {
            session()->flash('flash_message', 'Ha habido un error');
        }

        session()->flash('flash_message', 'Se ha creado el video #'.$video->id.' - '.$video->name.' con éxito');
        return redirect()->route('video.index');
    }

    /**
     * Basic save operation used for update & store.
     *
     * @param $video
     * @param Request $request
     * @param bool $save
     * @return mixed
     */
    public function silentSave(&$video, Request $request, $save = true)
    {
        $video->last_update_user_id = Auth::id();
        $video->name = $request->input('name');
        $video->description = $request->input('description');
        $video->language_id = $request->input('language_id');

        if ($request->hasFile('video')) {
            if ($request->file('video')->isValid()) {
                $extension = $request->file('video')->getClientOriginalExtension();
                $video->mime = $request->file('video')->getClientMimeType();
                $video->original_filename = $request->file('video')->getClientOriginalName();
                $video->filename = $request->file('video')->getFilename().'.'.$extension;
                $request->file('video')->move(base_path().'/storage/app/videos/', $request->file('video')->getFilename().'.'.$extension);
            }
        }
        ($save) ? $video->save() : null;
        return $video;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $video = Video::findOrFail($id);
        return view('videos.show',compact('video'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $video = Video::findOrFail($id);
        $available = Language::all()->sortBy('language');
        $languages = array();

        foreach ($available as $language){
            $languages[$language->id] = $language->language;
        }

        return view('videos.edit',compact('video', 'languages'));
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
            $video = Video::findOrFail($id);
            $this->silentSave($video,$request);
        } catch (ModelNotFoundException $e) {
            session()->flash('flash_message', 'Ha habido un error');
        }

        session()->flash('flash_message', 'Se ha actualizado el video #'.$video->id.' - '.$video->name.' con éxito');
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
        $video = Video::findOrFail($id);
        Storage::delete('/video/'.$video->filename);
        $video->delete();
        session()->flash('flash_message', 'Se ha eliminado el video #'.$id.' con éxito');
        return redirect()->route('video.index');
    }

    /**
     * Returns an specific searched element
     *
     * @param $id
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function find($id)
    {
        $video = Video::findOrFail($id);
        return view('videos.show',compact('video'));
    }

    /**
     * Searches for an especific audio name
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function search(Request $request)
    {
        $videos = Video::where('name','like','%'.$request->input('search').'%')
            ->orWhere('id',$request->input('search'))
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('videos.index',compact('videos'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($id)
    {
        try {
            $video = Video::findOrFail($id);
        } catch(NotFoundHttpException $e) {
            abort(404);
        }

        return response()->json($video);
    }
    public function getFile($id)
    {
        try {
            $video = Video::findOrFail($id);

            $Dir = base_path('storage/app/videos');
            if (file_exists($filePath = $Dir."/".$video->filename)) {
                $stream = new Stream($filePath, $video->mime);
                return response()->stream(function() use ($stream) {
                    $stream->start();
                });
            }

        } catch(NotFoundHttpException $e) {
            abort(404);
        }

        return response("File doesn't exists", 404);
    }
}
