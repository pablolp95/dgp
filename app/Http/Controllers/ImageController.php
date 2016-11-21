<?php

namespace App\Http\Controllers;
use App\Image;

use Auth;
use Log;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ImageController extends Controller
{
    public function index()
    {
        //
        $image = Image::orderBy('created_at', 'desc')->paginate(15);
        return view('image.index',compact('image'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('image.create');
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function silentSave(&$image, Request $request, $save = true)
    {
        $image->last_update_user_id = Auth::id();
        $image->name = $request->input('name');
        $image->description = $request->input('description');
        $image->image_url = $request->input('image_url');
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $request->file('image')->move(base_path()."/storage/app/image/", $request->file('image')->getFilename());
            }
        }
        ($save) ? $image->save() : null;
        return $image;
    }

    public function show($id)
    {
        $image = Image::findOrFail($id);
        return view('image.show',compact('image'));
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
        return view('image.edit',compact('image'));
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

        session()->flash('flash_message', 'Se ha actualizado el audio #'.$image->id.' - '.$image->name.' con éxito');
        return redirect()->route('dashboard');
    }
    public function search(Request $request)
    {
        $image = Image::where('name','like','%'.$request->input('search').'%')
            ->orWhere('id',$request->input('search'))
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('image.index',compact('image'));
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
        session()->flash('flash_message', 'Se ha eliminado la imágen #'.$id.' con éxito');
        return redirect()->route('image.index');
    }
}
