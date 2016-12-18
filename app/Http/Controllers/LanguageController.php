<?php

namespace App\Http\Controllers;

use App\Language;
use Auth;
use Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $languages = Language::orderBy('created_at', 'desc')->paginate(15);
        return view('languages.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('languages.create');
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
            $language = new Language();
            $language->user_id = Auth::id();
            $this->silentSave($language,$request);
        } catch (ModelNotFoundException $e) {
            session()->flash('flash_message', 'Ha habido un error');
        }

        session()->flash('flash_message', 'Se ha añadido el idioma #'.$language->id.' - '.$language->language.' con éxito');
        return redirect()->route('language.index');
    }

    /**
     * Basic save operation used for update & store.
     *
     * @param $language
     * @param Request $request
     * @param bool $save
     * @return mixed
     */
    public function silentSave(&$language, Request $request, $save = true)
    {
        $language->last_update_user_id = Auth::id();
        $language->language_code = $request->input('language_code');
        $language->language = Language::$languages[$language->language_code];

        ($save) ? $language->save() : null;
        return $language;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $language = Language::findOrFail($id);
        return view('languages.show',compact('language'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $language = Language::findOrFail($id);
        return view('languages.edit',compact('language'));
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
            $language = Language::findOrFail($id);
            $this->silentSave($language,$request);
        } catch (ModelNotFoundException $e) {
            session()->flash('flash_message', 'Ha habido un error');
        }

        session()->flash('flash_message', 'Se ha actualizado el idioma #'.$language->id.' - '.$language->language.' con éxito');
        return redirect()->route('language.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $language = Language::findOrFail($id);
        $language->delete();
        session()->flash('flash_message', 'Se ha eliminado el idioma #'.$id.' con éxito');
        return redirect()->route('language.index');
    }

    /**
     * Returns an specific searched element
     *
     * @param $id
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function find($id)
    {
        $language = Language::findOrFail($id);
        return view('languages.show', compact('language'));
    }

    /**
     * Searches for an especific language language
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function search(Request $request)
    {
        $languages = Language::where('language','like','%'.$request->input('search').'%')
            ->orWhere('id',$request->input('search'))
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('languages.index', compact('languages'));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll()
    {
        try {
            $languages = Language::all();
        } catch(NotFoundHttpException $e) {
            abort(404);
        }

        return response()->json($languages);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($id)
    {
        try {
            $language = Language::findOrFail($id);
        } catch(NotFoundHttpException $e) {
            abort(404);
        }

        return response()->json($language);
    }

}
