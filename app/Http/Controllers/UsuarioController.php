<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Zizaco\Entrust\Entrust;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::orderBy('created_at', 'desc')->paginate(15);
        return view("usuarios.index",compact("usuarios"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $r = Role::all();
        $roles = [];
        foreach($r as $role) {
            if($role["name"] == "admin" && Auth::user()->hasRole("admin")) {
                $roles[$role["name"]] = $role["display_name"];
            } else if($role["name"] != "admin") {
                $roles[$role["name"]] = $role["display_name"];
            }
        }
        return view("usuarios.create",compact("roles"));
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
            $usuario = new User();
            $this->silentSave($usuario,$request);
            $role = Role::where("name", $request->input("role"))->first();
            $usuario->roles()->save($role);
        } catch (ModelNotFoundException $e) {
            session()->flash('flash_message', 'Ha habido un error');
        }

        session()->flash('flash_message', 'Se ha creado el usuario #'.$usuario->id.' - '.$usuario->name.' con éxito');
        return redirect()->route("usuario.index");
    }

    /**
     * Basic save operation used for update & store.
     *
     * @param $usuario
     * @param Request $request
     * @param bool $save
     * @return mixed
     */
    public function silentSave(&$usuario, Request $request,$save = true)
    {
        $usuario->name = $request->input("name");
        $usuario->email = $request->input("email");
        $usuario->password = bcrypt($request->input("password"));
        $usuario->remember_token = str_random(10);
        $usuario->notes = $request->input("notes");
        $usuario->status = $request->input("status");
        ($save) ? $usuario->save() : null;
        return $usuario;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = User::findOrFail($id);
        return view("usuarios.show",compact("usuario"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        $r = Role::all();
        $roles = [];
        foreach($r as $role) {
            if($role["name"] == "admin" && Auth::user()->hasRole("admin")) {
                $roles[$role["name"]] = $role["display_name"];
            } else if($role["name"] != "admin") {
                $roles[$role["name"]] = $role["display_name"];
            }
        }
        return view("usuarios.edit",compact("usuario","roles"));
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
            $usuario = User::findOrFail($id);
            $this->silentSave($usuario,$request);
        } catch (ModelNotFoundException $e) {
            session()->flash('flash_message', 'Ha habido un error');
        }

        session()->flash('flash_message', 'Se ha actualizado el usuario #'.$usuario->id.' - '.$usuario->name.' con éxito');
        return redirect()->route("dashboard");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();
        session()->flash('flash_message', 'Se ha eliminado el usuario #'.$id.' con éxito');
        return redirect()->route("usuario.index");
    }

    /**
     * Returns an specific searched element
     *
     * @param $id
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function find($id)
    {
        $usuario = User::findOrFail($id);
        return view("usuarios.show",compact("usuario"));
    }

    /**
     * Searches for an especific user email or id
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function search(Request $request)
    {
        $usuarios = User::where("email",'like','%'.$request->input("search").'%')
            ->orWhere("id",$request->input("search"))
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view("usuarios.index",compact("usuarios"));
    }
}
