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
    return view('dashboard', ['name' => $username]);
})->name('dashboard');

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

Entrust::routeNeedsRole('stand*',['administrativo','admin'],Redirect::to('dashboard'),false);
Entrust::routeNeedsRole('zone*',['administrativo','admin'],Redirect::to('dashboard'),false);
Entrust::routeNeedsRole('route*',['administrativo','admin'],Redirect::to('dashboard'),false);
Entrust::routeNeedsRole('audio*',['financiero','admin'],Redirect::to('dashboard'),false);
Entrust::routeNeedsRole('image*',['financiero','admin'],Redirect::to('dashboard'),false);
Entrust::routeNeedsRole('video*',['admin'],Redirect::to('dashboard'),false);
Entrust::routeNeedsRole('usuario*',['administrativo','admin'],Redirect::to('dashboard'),false);

//API REST HTML
Route::resource('stand','StandController');
Route::resource('zone','ZoneController');
Route::resource('route','RouteController');
Route::resource('audio','AudioController');
Route::resource('image','ImageController');
Route::resource('video','VideoController');
Route::resource('usuario','UsuarioController');

Route::post('stand/search',['as' => 'stand.search', 'uses' => 'StandController@search']);
Route::post('zone/search',['as' => 'zone.search', 'uses' => 'ZoneController@search']);
Route::post('route/search',['as' => 'route.search', 'uses' => 'RouteController@search']);
Route::post('audio/search',['as' => 'audio.search', 'uses' => 'AudioController@search']);
Route::post('image/search',['as' => 'image.search', 'uses' => 'ImageController@search']);
Route::post('video/search',['as' => 'video.search', 'uses' => 'VideoController@search']);
Route::post('usuario/search',['as' => 'usuario.search', 'uses' => 'UsuarioController@search']);


//Routes to associate
Route::get('stand/{id}/associate/audio',['as' => 'stand.associate.audio', 'uses' => 'StandController@associateAudio']);
Route::post('stand/{id}/associate/audio',['as' => 'stand.add.audio', 'uses' => 'StandController@addAudio']);
Route::get('stand/{id}/associate/image',['as' => 'stand.associate.image', 'uses' => 'StandController@associateImage']);
Route::post('stand/{id}/associate/image',['as' => 'stand.add.image', 'uses' => 'StandController@addImage']);
Route::get('stand/{id}/associate/video',['as' => 'stand.associate.video', 'uses' => 'StandController@associateVideo']);
Route::post('stand/{id}/associate/video',['as' => 'stand.add.video', 'uses' => 'StandController@addVideo']);

Route::get('zone/{id}/associate/stand',['as' => 'zone.associate.stand', 'uses' => 'ZoneController@associateStand']);
Route::post('zone/{id}/associate/stand',['as' => 'zone.add.stand', 'uses' => 'ZoneController@addStand']);

Route::get('route/{id}/associate/stand',['as' => 'route.associate.stand', 'uses' => 'RouteController@associateStand']);
Route::post('route/{id}/associate/stand',['as' => 'route.add.stand', 'uses' => 'RouteController@addStand']);

//API REST JSON
Route::get('api/stand/{id}',['as' => 'stand.get.json', 'uses' => 'StandController@get']);
Route::get('api/zone/{id}',['as' => 'zone.get.json', 'uses' => 'ZoneController@get']);
Route::get('api/route/{id}',['as' => 'route.get.json', 'uses' => 'RouteController@get']);
Route::get('api/audio/{id}',['as' => 'audio.get.json', 'uses' => 'AudioController@get']);
Route::get('api/image/{id}',['as' => 'image.get.json', 'uses' => 'ImageController@get']);
Route::get('api/video/{id}',['as' => 'video.get.json', 'uses' => 'VideoController@get']);