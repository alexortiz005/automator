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

Route::get('upload','uploadController@vistaSubir');

Route::get('download','downloadController@vistaBajar');

Route::get('modulos','modulosController@vistaModulos');

Route::get('ver/{moduloId}','modulosController@verModulo');

Route::post('subir','uploadController@subir');

Route::post('bajar','downloadController@bajar');


