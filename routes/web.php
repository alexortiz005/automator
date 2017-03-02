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

//Upload

Route::get('upload','uploadController@vistaSubir');

Route::post('subir','uploadController@subir');

//Download

Route::get('download','downloadController@vistaBajar');

Route::post('bajar','downloadController@bajar');

//Modulos

Route::get('modulos','ModulosController@vistaModulos');

Route::get('modulo/{moduloId}','ModulosController@verModulo');

Route::post('eliminarModulo','ModulosController@eliminar');

//Precondiciones

Route::get('precondicion/{precondicionId}','PrecondicionController@verPrecondicion');

Route::post('editarPrecondicion','PrecondicionController@editar');

//Aserciones

Route::get('asercion/{asercionId}','AsercionController@verAsercion');

Route::post('editarAsercion','AsercionController@editar');

//Keywords

Route::post('vistaCrearKeyword','KeywordController@vistaCrearKeyword');
Route::post('crearKeyword','KeywordController@crearKeyword');
Route::get('desasociarKeyword/{tipo}/{idKeyword}/{idPrecondicion}', 'KeywordController@desasociar');







