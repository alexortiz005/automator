<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Modulo;

class ModulosController extends Controller
{

	public function vistaModulos(){

		$modulos=Modulo::All();		
		return view('modulos.vistaModulos')->with('modulos',$modulos);
	}

	public function verModulo($moduloId){

		$modulo=Modulo::find($moduloId);
		$escenarios=$modulo->escenarios()->get();
		$precondiciones=$modulo->precondiciones();
		$aserciones=$modulo->aserciones();
		
		return view('modulos.verModulo')->with('modulo',$modulo)->with('escenarios',$escenarios)->with('precondiciones',$precondiciones)->with('aserciones',$aserciones);
	}
    //
}
