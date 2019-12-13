<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return view('blanco');
});

Route::get('/bd', function () {
	$exitCode = Artisan::call('migrate:fresh', [
    		'--seed' => true,
	]);
    });

Route::get('/man' , 'mantencionController@calendario')->name('calendar');

Route::get('register', 'Auth\RegisterController@ReturnViewRegistro')->name('register');

Route::resource('users', 'UserController');

Auth::routes();

Route::resource('fases', 'faseController');

Route::resource('mantenciones', 'mantencionController');

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('Insumos', 'InsumosController');

Route::resource('cargos', 'CargoController');

Route::resource('equipos', 'EquipoController');

Route::resource('fabricantes', 'FabricanteController');

Route::resource('trabajadores', 'TrabajadorController');
