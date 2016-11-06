<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Entrust::routeNeedsRole('dashboard*',['administrativo','admin','financiero'],Redirect::to('/'),false);
Route::get('dashboard', function()
{
    $username = Auth::user()->name;
    return view('dashboard', ["name" => $username]);
})->name('dashboard');

Route::get("test","ClienteController@test");
// Authentication routes...
Route::get('/', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('/login', ['as' => 'login.submit', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('/logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);

// Password reset link request routes...
Route::get('password', ['as' => 'password', 'uses' => 'Auth\PasswordController@getEmail']);
Route::post('password', ['as' => 'password.submit', 'uses' => 'Auth\PasswordController@postEmail']);

// Password reset routes...
Route::get('password/reset/{token}', ['as' => 'password.reset', 'uses' => 'Auth\PasswordController@getReset']);
Route::post('password/reset', ['as' => 'password.reset.submit', 'uses' => 'Auth\PasswordController@postReset']);

Entrust::routeNeedsRole('cliente*',['administrativo','admin'],Redirect::to('dashboard'),false);
Entrust::routeNeedsRole('presupuesto*',['administrativo','admin'],Redirect::to('dashboard'),false);
Entrust::routeNeedsRole('proyecto*',['administrativo','admin'],Redirect::to('dashboard'),false);
Entrust::routeNeedsRole('impuesto*',['financiero','admin'],Redirect::to('dashboard'),false);
Entrust::routeNeedsRole('factura*',['financiero','admin'],Redirect::to('dashboard'),false);
Entrust::routeNeedsRole('producto*',['admin'],Redirect::to('dashboard'),false);
Entrust::routeNeedsRole('servicio*',['admin'],Redirect::to('dashboard'),false);
Entrust::routeNeedsRole('usuario*',['administrativo','admin'],Redirect::to('dashboard'),false);


Route::resource("producto","ProductoController");
Route::resource("servicio","ServicioController");
Route::resource("cliente","ClienteController");
Route::resource("factura","FacturaController");
Route::resource("impuesto","ImpuestoController");
Route::resource("presupuesto","PresupuestoController");
Route::resource("proyecto","ProyectoController");
Route::resource("usuario","UsuarioController");


Route::post("producto/buscar",["as" => "producto.search", "uses" => "ProductoController@search"]);
Route::post("servicio/buscar",["as" => "servicio.search", "uses" => "ServicioController@search"]);
Route::post("usuario/buscar",["as" => "usuario.search", "uses" => "UsuarioController@search"]);
Route::post("cliente/buscar",["as" => "cliente.search", "uses" => "ClienteController@search"]);
Route::post("factura/buscar",["as" => "factura.search", "uses" => "FacturaController@search"]);
Route::post("presupuesto/buscar",["as" => "presupuesto.search", "uses" => "PresupuestoController@search"]);
Route::post("proyecto/buscar",["as" => "proyecto.search", "uses" => "ProyectoController@search"]);

Route::get("proyecto/{id}/asociar/factura",["as" => "proyecto.associate.invoice", "uses" => "ProyectoController@associateInvoice"]);
Route::post("proyecto/{id}/asociar/factura",["as" => "proyecto.add.invoice", "uses" => "ProyectoController@addInvoice"]);
Route::get("proyecto/{id}/asociar/presupuesto",["as" => "proyecto.associate.proposal", "uses" => "ProyectoController@associateProposal"]);
Route::post("proyecto/{id}/asociar/presupuesto",["as" => "proyecto.add.proposal", "uses" => "ProyectoController@addProposal"]);

Route::get("presupuesto/{id}/asociar/factura",["as" => "presupuesto.associate.invoice", "uses" => "PresupuestoController@associateInvoice"]);
Route::post("presupuesto/{id}/asociar/factura",["as" => "presupuesto.add.invoice", "uses" => "PresupuestoController@addInvoice"]);

Route::get("api/producto/{id}",["as" => "producto.get.json", "uses" => "ProductoController@get"]);
Route::get("api/servicio/{id}",["as" => "servicio.get.json", "uses" => "ServicioController@get"]);
Route::get("api/impuesto/{id}",["as" => "impuesto.get.json", "uses" => "ImpuestoController@get"]);