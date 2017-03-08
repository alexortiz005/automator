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
		if($modulo==null)
			return redirect('/modulos');
		$escenarios=$modulo->escenarios()->orderBy('numero')->get();
		$precondiciones=$modulo->precondiciones()->orderBy('variable')->get();
		$aserciones=$modulo->aserciones()->orderBy('variable')->get();
		
		return view('modulos.verModulo')->with('modulo',$modulo)->with('escenarios',$escenarios)->with('precondiciones',$precondiciones)->with('aserciones',$aserciones);
	}

	public function eliminar(Request $request){

		$input=$request->all();
		$modulo=Modulo::find($input['idModulo']);
		$modulo->purge();
		
		return redirect('/modulos');
	}
    //
}
