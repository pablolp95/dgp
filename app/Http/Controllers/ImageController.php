<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Support\Facades\Storage;
use Auth;
use Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::orderBy('created_at', 'desc')->paginate(15);
        return view('images.index',compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('images.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        try{
            $image = new Image();
            $image->user_id = Auth::id();
            $this->silentSave($image,$request);
        } catch (ModelNotFoundException $e) {
            session()->flash('flash_message', 'Ha habido un error');
        }

        session()->flash('flash_message', 'Se ha creado la imagen #'.$image->id.' - '.$image->name.' con éxito');
        return redirect()->route('image.index');
    }

    /**
     * Basic save operation used for update & store.
     *
     * @param image
     * @param Request $request
     * @param bool $save
     * @return mixed
     */
    public function silentSave(&$image, Request $request, $save = true)
    {
        $image->last_update_user_id = Auth::id();
        $image->name = $request->input('name');
        $image->description = $request->input('description');
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $extension = $request->file('image')->getClientOriginalExtension();
                $image->mime = $request->file('image')->getClientMimeType();
                $image->original_filename = $request->file('image')->getClientOriginalName();
                $image->filename = $request->file('image')->getFilename().'.'.$extension;
                $request->file('image')->move(base_path().'/storage/app/images/', $request->file('image')->getFilename().'.'.$extension);
            }
        }
        ($save) ? $image->save() : null;
        return $image;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $image = Image::findOrFail($id);
        return view('images.show',compact('image'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $image = Image::findOrFail($id);
        return view('images.edit',compact('image'));
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
            $image = Image::findOrFail($id);
            $this->silentSave($image,$request);
        } catch (ModelNotFoundException $e) {
            session()->flash('flash_message', 'Ha habido un error');
        }

        session()->flash('flash_message', 'Se ha actualizado la imagen #'.$image->id.' - '.$image->name.' con éxito');
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
        $image = Image::findOrFail($id);
        $image->delete();
        session()->flash('flash_message', 'Se ha eliminado la imagen #'.$id.' con éxito');
        return redirect()->route('image.index');
    }

    /**
     * Returns an specific searched element
     *
     * @param $id
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function find($id)
    {
        $image = Image::findOrFail($id);
        return view('images.show',compact('image'));
    }


    /**
     * Searches for an especific audio name
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function search(Request $request)
    {
        $image = Image::where('name','like','%'.$request->input('search').'%')
            ->orWhere('id',$request->input('search'))
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('images.index',compact('image'));
    }
    
    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($id)
    {
        try {
            $image = Image::findOrFail($id);
        } catch(NotFoundHttpException $e) {
            abort(404);
        }

        return response()->json($image);
    }
    public function getFile($id)
    {
        try {
            $image = Image::findOrFail($id);
            $file = Storage::get('/images/'.$image->filename);     //The filename is stored in a database.
            return response($file, 200)->header('Content-Type', $image->mime);

        } catch(NotFoundHttpException $e) {
            abort(404);
        }

    }
}
