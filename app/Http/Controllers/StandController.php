<?php
namespace App\Http\Controllers;
use App\Image;
use App\Stand;
use App\Audio;
use App\Video;
use App\Language;
use App\Text;
use Auth;
use Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class StandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stands = Stand::orderBy('created_at', 'desc')->paginate(15);
        return view('stands.index', compact('stands'));
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
        return view('stands.create', compact('languages'));
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
            $stand = new Stand();
            $stand->user_id = Auth::id();
            $this->silentSave($stand,$request);
        } catch (ModelNotFoundException $e) {
            session()->flash('flash_message', 'Ha habido un error');
        }

        session()->flash('flash_message', 'Se ha creado el stand #'.$stand->id.' - '.$stand->name.' con éxito');
        return redirect()->route('stand.index');
    }

    /**
     * Basic save operation used for update & store.
     *
     * @param $stand
     * @param Request $request
     * @param bool $save
     * @return mixed
     */
    public function silentSave(&$stand, Request $request, $save = true)
    {
        $stand->last_update_user_id = Auth::id();
        $stand->name = $request->input('name');

        //Creo antes el stand para que se cree su id
        ($save) ? $stand->save() : null;

        //Creo los textos asociados al stand en los distintos idiomas
        $texts = $request->input('texts');
        if (isset($texts)) {
            $current_texts = $stand->texts;
            foreach ($current_texts as $current_text) {
                if (array_has($texts, $current_text->id)){
                    unset($texts[$current_text->id]);
                }
                else {
                    $current_text->delete();
                }
            }

            foreach ($texts as $id_language => $stand_info) {
                $text = $stand->texts()->where('language_id', $id_language)->first();
                if(is_null($text) || empty($text)){
                    $text = new Text();
                }

                $text->user_id = Auth::id();
                $text->last_update_user_id = Auth::id();
                $text->title = $stand_info["title"];
                $text->description = $stand_info["description"];

                $language = Language::findOrFail($id_language);
                $language->texts()->save($text);
                $stand->texts()->save($text);
            }
        }
        else {
            $current_texts = $stand->texts;
            foreach ($current_texts as $current_text){
                $current_text->delete();
            }
        }

        $videos = $request->input('videos');
        if (isset($videos)) {
            $current_videos = $stand->videos;
            foreach ($current_videos as $current_video) {
                if (in_array($current_video->id, $videos, true)){
                    unset($videos[$current_video->id]);
                }
                else {
                    $current_video->stand_id = null;
                    $current_video->save();
                }
            }
            Log::info($current_videos);
            Log::info($videos);
            foreach ($videos as $video_id) {
                $video = Video::findOrFail($video_id);
                $stand->videos()->save($video);
            }
        }
        else {
            $current_videos = $stand->videos;
            foreach ($current_videos as $current_video){
                $current_video->stand_id = null;
                $current_video->save();
            }
        }

        $audio = $request->input('audio');
        if (isset($audio)) {
            $current_audios = $stand->audio;
            foreach ($current_audios as $current_audio) {
                if (in_array($current_audio->id, $audio, true)){
                    unset($audio[$current_audio->id]);
                }
                else {
                    $current_audio->stand_id = null;
                    $current_audio->save();
                }
            }

            foreach ($audio as $audio_id) {
                $audio = Audio::findOrFail($audio_id);
                $stand->audio()->save($audio);
            }
        }
        else {
            $current_audios = $stand->audio;
            foreach ($current_audios as $current_audio) {
                $current_audio->stand_id = null;
                $current_audio->save();
            }
        }

        $images = $request->input('images');
        if (isset($images)) {
            $current_images = $stand->images;
            foreach ($current_images as $current_image) {
                if (in_array($current_image->id, $images, true)){
                    unset($images[$current_image->id]);
                }
                else {
                    $current_image->stand_id = null;
                    $current_image->save();
                }
            }

            foreach ($images as $image_id) {
                $image = Image::findOrFail($image_id);
                $stand->images()->save($image);
            }
        }
        else {
            $current_images = $stand->images;
            foreach ($current_images as $current_image) {
                $current_image->stand_id = null;
                $current_image->save();
            }
        }
        
        return $stand;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stand = Stand::findOrFail($id);
        $available = Language::all()->sortBy('language');
        $languages = array();

        foreach ($available as $language){
            $languages[$language->id] = $language->language;
        }

        $texts = $stand->texts;
        $videos = $stand->videos;
        $audio = $stand->audio;
        $images = $stand->images;

        return view('stands.show', compact('stand', 'languages', 'texts', 'videos', 'audio', 'images'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stand = Stand::findOrFail($id);
        $available = Language::all()->sortBy('language');
        $languages = array();

        foreach ($available as $language){
            $languages[$language->id] = $language->language;
        }

        $texts = $stand->texts;
        $videos = $stand->videos;
        $audio = $stand->audio;
        $images = $stand->images;

        return view('stands.edit', compact('stand', 'languages', 'texts', 'videos', 'audio', 'images'));
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
            $stand = Stand::findOrFail($id);
            $this->silentSave($stand,$request);
        } catch (ModelNotFoundException $e) {
            session()->flash('flash_message', 'Ha habido un error');
        }

        session()->flash('flash_message', 'Se ha actualizado el stand #'.$stand->id.' - '.$stand->name.' con éxito');
        return redirect()->route('stand.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stand = Stand::findOrFail($id);
        $stand->delete();
        session()->flash('flash_message', 'Se ha eliminado el stand'.$id.' con éxito');
        return redirect()->route('stand.index');
    }

    /**
     * Returns an specific searched element
     *
     * @param $id
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function find($id)
    {
        $stand = Stand::findOrFail($id);
        return view('stands.show', compact('stand'));
    }

    /**
     * Searches for an especific stand name
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function search(Request $request)
    {
        $stands = Stand::where('name','like','%'.$request->input('search').'%')
            ->orWhere('id',$request->input('search'))
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('stands.index',compact('stands'));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll()
    {
        try {
            $stands = Stand::all();
        } catch(NotFoundHttpException $e) {
            abort(404);
        }

        return response()->json($stands);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAvailable()
    {
        try {
            if(isset($_GET['resource'])) {
                if($_GET['resource'] == 'zone'){
                    $stands = Stand::whereNull('zone_id')->orderBy('name')->select('id', 'name')->get();
                }
                else if($_GET['resource'] == 'route'){
                    $stands = Stand::whereNull('route_id')->orderBy('name')->select('id', 'name')->get();
                }
                else{
                    $stands = 'BAD VALUE';
                }
            }
            else{
                $stands = 'BAD PROTOCOL';
            }
        } catch(NotFoundHttpException $e) {
            abort(404);
        }

        return response()->json($stands);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($id)
    {
        try {
            $stand = Stand::findOrFail($id);
        } catch(NotFoundHttpException $e) {
            abort(404);
        }

        return response()->json($stand);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getImages($id)
    {
        try {
            $stand = Stand::findOrFail($id);
                $images = $stand->images->toArray();

        } catch(NotFoundHttpException $e) {
            abort(404);
        }

        return response()->json($images);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAudio($id)
    {
        try {
            $stand = Stand::findOrFail($id);
            if(isset($_GET['language']) && isset($_GET['mode']) ){
                $audio = Audio::where('stand_id','=',$id)
                    ->where('language_id','=',$_GET['language'])
                    ->where('mode','like',$_GET['mode'])->get();

            }
            elseif(!isset($_GET['language']) && isset($_GET['mode'])){
                $audio = Audio::where('stand_id','=',$id)
                    ->where('mode','=',$_GET['mode'])->get();
            }
            elseif(isset($_GET['language']) && !isset($_GET['mode'])){
                $audio = Audio::where('stand_id','=',$id)
                    ->where('language_id','like',$_GET['language'])->get();
            }
            else{
                $audio = $stand->audio->toArray();
            }
        } catch(NotFoundHttpException $e) {
            abort(404);
        }

        return response()->json($audio);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getVideos($id)
    {
        try {
            $stand = Stand::findOrFail($id);
            if(isset($_GET['language']) && isset($_GET['mode']) ){
                $videos = Video::where('stand_id','=',$id)
                    ->where('language_id','=',$_GET['language'])
                    ->where('mode','like',$_GET['mode'])->get();

            }
            elseif(!isset($_GET['language']) && isset($_GET['mode'])){
                $videos = Video::where('stand_id','=',$id)
                    ->where('mode','=',$_GET['mode'])->get();
            }
            elseif(isset($_GET['language']) && !isset($_GET['mode'])){
                $videos = Video::where('stand_id','=',$id)
                    ->where('language_id','like',$_GET['language'])->get();
            }
            else{
                $videos = $stand->videos->toArray();
            }

        } catch(NotFoundHttpException $e) {
            abort(404);
        }

        return response()->json($videos);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTexts($id)
    {
        try {
            $stand = Stand::findOrFail($id);
            if(isset($_GET['language'])){
                $texts = Text::where('stand_id','=',$id)
                    ->where('language_id','=',$_GET['language'])->get();

            }
            else{
                $texts = $stand->texts->toArray();
            }
        } catch(NotFoundHttpException $e) {
            abort(404);
        }

        return response()->json($texts);
    }

}
