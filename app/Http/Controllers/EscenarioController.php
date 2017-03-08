<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Escenario;
use App\Modulo;

class EscenarioController extends Controller
{

	public function verEscenario($id){

		$escenario = Escenario::find($id);
		$modulo = $escenario->modulo()->first();
		$modulos=Modulo::All();
		$precondiciones_testeadas = $escenario->precondiciones()->where('precondiciones.estado','testeada')->get();	
		$aserciones_testeadas = $escenario->aserciones()->where('aserciones.estado','testeada')->get();
		$keywords_precondiciones=[];

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

		return view('escenarios.verEscenario',['escenario'=>$escenario,
												'modulo'=>$modulo,
												'modulos'=>$modulos,
												'aserciones_testeadas'=>$aserciones_testeadas,
												'precondiciones_testeadas'=>$precondiciones_testeadas,
												'argumentos_precondiciones'=>$argumentos_precondiciones,
												'argumentos_aserciones'=>$argumentos_aserciones]
												);

	}
    //
}
