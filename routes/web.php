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



Auth::routes();


Route::get('/', 'HomeController@index')->name('principal');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/novetats', 'NovetatsController@novetats')->name('novetats');
Route::get('/perfil', 'PerfilController@comprobarPerfil')->name('perfil');
Route::get('/editarPerfil', 'PerfilController@editarPerfil')->name('editarPerfil');
Route::get('/buscarPerfil', 'PerfilController@buscarPerfil')->name('buscarPerfil');
Route::get('perfil/{id}', 'PerfilController@buscarPerfilConcret')->name('buscarPerfilConcret');
Route::get('editarPerfilAjax/{id}', 'PerfilController@editarPerfilAjax')->name('editarPerfilAjax');
Route::get('/afegirProximaModa', 'ModesController@afegirProximaModa')->name('afegirProximaModa');
Route::get('/proximaModa', 'ModesController@proximaModa')->name('proximaModa');
Route::get('/generadorConfigurador', 'GeneradorController@generadorConfigurador')->name('generadorConfigurador');
Route::get('/generarRoba', 'GeneradorController@generarRoba')->name('generarRoba');
Route::get('/generarCombinacio', 'GeneradorController@generarCombinacio')->name('generarCombinacio');
Route::get('/combinacions', 'GeneradorController@combinacions')->name('combinacions');
Route::get('/pagamentcarrito', 'GeneradorController@pagamentcarrito')->name('pagamentcarrito');

Route::post('/ajax_subestacio','PerfilController@ajax_subestacio')->name('ajax_subestacio');
Route::post('/dades_primerPerfil','PerfilController@dades_primerPerfil')->name('dades_primerPerfil');
Route::post('/dades_editarPerfil','PerfilController@dades_editarPerfil')->name('dades_editarPerfil');
Route::post('/dades_proximaModa','ModesController@dades_proximaModa')->name('dades_proximaModa');
Route::post('/ajax_buscador','PerfilController@ajax_buscador')->name('ajax_buscador');
Route::post('/dades_editarColors','GeneradorController@dades_editarColors')->name('dades_editarColors');
Route::post('/ajax_eliminar','PerfilController@ajax_eliminar')->name('ajax_eliminar');
Route::post('/dades_afegirCombinacio', 'GeneradorController@dades_afegirCombinacio')->name('dades_afegirCombinacio');
Route::post('/ajax_eliminarCombinacio', 'GeneradorController@ajax_eliminarCombinacio')->name('ajax_eliminarCombinacio');
Route::post('/ajax_comprarRoba', 'GeneradorController@ajax_comprarRoba')->name('ajax_comprarRoba');
Route::post('/ajax_actualitzarCarrito', 'GeneradorController@ajax_actualitzarCarrito')->name('ajax_actualitzarCarrito');
Route::post('/ajax_eliminarPesaCarrito', 'GeneradorController@ajax_eliminarPesaCarrito')->name('ajax_eliminarPesaCarrito');
