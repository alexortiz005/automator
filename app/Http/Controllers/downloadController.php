<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Response;


use App\Writer;
use App\Precondicion;
use App\Asercion;
use App\Escenario;
use App\Modulo;


class downloadController extends Controller
{

	public function vistaBajar(){

		$modulos=Modulo::All();		
		return view('download.download')->with('modulos',$modulos);
	}

	public function bajar($moduloId){

		$modulo=Modulo::find($moduloId);
		$escenarios=$modulo->escenarios()->get();
		$precondiciones=$modulo->precondiciones();
		$aserciones=$modulo->aserciones();

		$writer= new Writer;

		$excel=$writer->generarExcel($modulo,$escenarios,$precondiciones,$aserciones);

		return $excel->download();

		dd(get_class_methods($excel));

		

		return "peng";
	}
    //
}
