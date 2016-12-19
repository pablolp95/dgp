<?php

namespace App\Http\Controllers;

use App\Audio;
use App\Language;
use App\Helpers\Stream;
use Auth;
use Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AudioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $audios = Audio::orderBy('created_at', 'desc')->paginate(15);
        return view('audio.index', compact('audios'));
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

        return view('audio.create', compact('languages'));
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
            $audio = new Audio();
            $audio->user_id = Auth::id();
            $this->silentSave($audio,$request);
        } catch (ModelNotFoundException $e) {
            session()->flash('flash_message', 'Ha habido un error');
        }

        session()->flash('flash_message', 'Se ha creado el audio #'.$audio->id.' - '.$audio->name.' con éxito');
        return redirect()->route('audio.index');
    }

    /**
     * Basic save operation used for update & store.
     *
     * @param $audio
     * @param Request $request
     * @param bool $save
     * @return mixed
     */
    public function silentSave(&$audio, Request $request, $save = true)
    {
        $audio->last_update_user_id = Auth::id();
        $audio->name = $request->input('name');
        $audio->description = $request->input('description');
        $audio->language_id = $request->input('language_id');
        $audio->mode = $request->input('mode');

        if ($request->hasFile('audio')) {
            if ($request->file('audio')->isValid()) {
                if($audio->filename != null){
                    Storage::delete('/audio/'.$audio->filename);
                }
                $extension = $request->file('audio')->getClientOriginalExtension();
                $audio->mime = $request->file('audio')->getClientMimeType();
                $audio->original_filename = $request->file('audio')->getClientOriginalName();
                $audio->filename = $request->file('audio')->getFilename().'.'.$extension;
                $request->file('audio')->move(base_path().'/storage/app/audio/', $request->file('audio')->getFilename().'.'.$extension);
            }
        }
        ($save) ? $audio->save() : null;
        return $audio;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $audio = Audio::findOrFail($id);
        return view('audio.show',compact('audio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $audio = Audio::findOrFail($id);
        $available = Language::all()->sortBy('language');
        $languages = array();

        foreach ($available as $language){
            $languages[$language->id] = $language->language;
        }

        return view('audio.edit',compact('audio','languages'));
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
            $audio = Audio::findOrFail($id);
            $this->silentSave($audio,$request);
        } catch (ModelNotFoundException $e) {
            session()->flash('flash_message', 'Ha habido un error');
        }

        session()->flash('flash_message', 'Se ha actualizado el audio #'.$audio->id.' - '.$audio->name.' con éxito');
        return redirect()->route('audio.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $audio = Audio::findOrFail($id);
        if($audio->filename != null){
            Storage::delete('/audio/'.$audio->filename);
        }
        $audio->delete();
        session()->flash('flash_message', 'Se ha eliminado el audio #'.$id.' con éxito');
        return redirect()->route('audio.index');
    }

    /**
     * Returns an specific searched element
     *
     * @param $id
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function find($id)
    {
        $audio = Audio::findOrFail($id);
        return view('audio.show',compact('audio'));
    }

    /**
     * Searches for an especific audio name
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function search(Request $request)
    {
        $audios = Audio::where('name','like','%'.$request->input('search').'%')
            ->orWhere('id',$request->input('search'))
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('audio.index',compact('audios'));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll()
    {
        try {
            $audios = Audio::all();
        } catch(NotFoundHttpException $e) {
            abort(404);
        }

        return response()->json($audios);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($id)
    {
        try {
            $audio = Audio::findOrFail($id);
        } catch(NotFoundHttpException $e) {
            abort(404);
        }

        return response()->json($audio);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function getFile($id)
    {
        try {
            $audio = Audio::findOrFail($id);

            $dir = base_path('storage/app/audio');
            if (file_exists($filePath = $dir."/".$audio->filename)) {
                $stream = new Stream($filePath, $audio->mime);
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
