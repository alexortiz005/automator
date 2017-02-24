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

	public function eliminar(Request $request){


		$input=$request->all();
		$modulo=Modulo::find($input['idModulo']);
		$escenarios=$modulo->escenarios()->get();
		$precondiciones=$modulo->precondiciones();
		$aserciones=$modulo->aserciones();

		foreach ($escenarios as $key => $escenario) {
			$escenario->precondiciones()->detach();
			$escenario->aserciones()->detach();
			$escenario->delete();
		}

		foreach ($precondiciones as $key => $precondicion) {
			$precondicion->delete();
		}

		foreach ($aserciones as $key => $asercion) {
			$asercion->delete();
		}

		$modulo->delete();
		
		return redirect('/modulos');
	}
    //
}
