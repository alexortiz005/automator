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
	App\Precondicion::actualizarEstados();
	App\Asercion::actualizarEstados();
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

Route::post('asociarObjeto','ModulosController@asociarObjeto');

Route::post('crearObjeto','ModulosController@crearObjeto');

//Precondiciones

Route::get('precondicion/{precondicionId}','PrecondicionController@verPrecondicion');

Route::post('editarPrecondicion','PrecondicionController@editar');

Route::post('mergePrecondiciones','PrecondicionController@merge');

//Aserciones

Route::get('asercion/{asercionId}','AsercionController@verAsercion');

Route::post('editarAsercion','AsercionController@editar');

Route::post('mergeAserciones','AsercionController@merge');

//Argumentos

Route::get('argumentos','ArgumentoController@vistaArgumentos');
Route::post('unificarArgumentos','ArgumentoController@unificarArgumentos');

//Flujos

Route::post('editarFlujo','FlujosController@editar');

//Keywords

Route::post('vistaCrearKeyword','KeywordController@vistaCrearKeyword');
Route::post('validarNombreKeyword','KeywordController@validarNombreKeyword');
Route::post('editarKeyword','KeywordController@editarKeyword');
Route::post('crearKeyword','KeywordController@crearKeyword');
Route::post('obtenerKeywordJSON','KeywordController@obtenerKeywordJSON');
Route::post('asociarOtrosKeywords','KeywordController@asociarOtrosKeywords');
Route::get('desasociarKeyword/{tipo}/{idKeyword}/{idPrecondicion}', 'KeywordController@desasociar');
Route::get('keyword/{idKeyword}', 'KeywordController@verKeyword');

//Protokeywords

Route::get('protokeywords', 'ProtokeywordController@vistaProtokeywords');

//Escenarios

Route::get('escenario/{idEscenario}', 'EscenarioController@verEscenario');
Route::post('toggleAsociacion', 'EscenarioController@toggleAsociacion');
//Tests

Route::post('editarTests','TestsController@editarTests');








