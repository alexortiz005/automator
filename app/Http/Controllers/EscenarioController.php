<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Escenario;
use App\Modulo;
use App\Precondicion;
use App\Asercion;

class EscenarioController extends Controller
{

	public function toggleAsociacion(Request $request)
	{

		$input=$request->all();
		$tipo=$input['tipo'];
		$id=$input['idObjeto'];
		$escenario= Escenario::find($input['idEscenario']);
		$output=[];
		$output['paintCell']=false;


		if($tipo=='precondicion'){
			$precondicion=Precondicion::find($id);
			$escenario->precondiciones()->toggle([$id]);
			if($escenario->esMiPrecondicion($precondicion))
				$output['paintCell']=true;


		}
		if($tipo=='asercion'){
			$asercion=Asercion::find($id);
			$escenario->aserciones()->toggle([$id]);
			if($escenario->esMiAsercion($asercion))
				$output['paintCell']=true;
			
		}

		return response()->json($output);
	}

	public function verEscenario($id){

		$escenario = Escenario::find($id);
		$modulo_escenario = $escenario->modulo()->get();
		$modulo_escenario=$modulo_escenario[0];
		$modulos=Modulo::All();
		$precondiciones_testeadas = $escenario->precondiciones()->where('precondiciones.estado','testeada')->get();
		$precondiciones_disenadas = $escenario->precondiciones()->where('precondiciones.estado','disenada')->get();		
		$aserciones_testeadas = $escenario->aserciones()->where('aserciones.estado','testeada')->get();
		$aserciones_disenadas = $escenario->aserciones()->where('aserciones.estado','disenada')->get();


		$argumentos_precondiciones=[];
		$argumentos_aserciones=[];

		foreach ($precondiciones_testeadas as $precondicion) {
			$keywords=$precondicion->keywords;
			foreach ($keywords as $keyword) {
				$argumentos=$keyword->argumentos;
				foreach ($argumentos as $key => $argumento) {
					$argumentos_precondiciones[]=$argumento->nombre;
					
				}			
			}
		}

		foreach ($aserciones_disenadas as $asercion) {
			$keywords=$asercion->keywords;
			foreach ($keywords as $keyword) {
				$argumentos=$keyword->argumentos;
				foreach ($argumentos as $key => $argumento) {
					$argumentos_aserciones[]=$argumento->nombre;
					
				}			
			}
		}

		foreach ($precondiciones_disenadas as $precondicion) {
			$keywords=$precondicion->keywords;
			foreach ($keywords as $keyword) {
				$argumentos=$keyword->argumentos;
				foreach ($argumentos as $key => $argumento) {
					$argumentos_precondiciones[]=$argumento->nombre;
					
				}			
			}
		}

		foreach ($aserciones_testeadas as $asercion) {
			$keywords=$asercion->keywords;
			foreach ($keywords as $keyword) {
				$argumentos=$keyword->argumentos;
				foreach ($argumentos as $key => $argumento) {
					$argumentos_aserciones[]=$argumento->nombre;
					
				}			
			}
		}

		$argumentos_precondiciones=array_unique($argumentos_precondiciones);
		$argumentos_aserciones=array_unique($argumentos_aserciones);	

		$precondiciones_disenadas->merge($precondiciones_testeadas);
		$aserciones_disenadas->merge($aserciones_testeadas);	

		return view('escenarios.verEscenario',['escenario'=>$escenario,
												'modulo_escenario'=>$modulo_escenario,
												'modulos'=>$modulos,
												'aserciones_disenadas'=>$aserciones_disenadas,
												'precondiciones_disenadas'=>$precondiciones_disenadas,
												'aserciones_testeadas'=>$aserciones_testeadas,
												'precondiciones_testeadas'=>$precondiciones_testeadas,
												'argumentos_precondiciones'=>$argumentos_precondiciones,
												'argumentos_aserciones'=>$argumentos_aserciones]
												);

	}
    //
}
