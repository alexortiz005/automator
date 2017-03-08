<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Escenario;
use App\Flujo;

class FlujosController extends Controller
{

	public function editar(Request $request){

		$input=$request->all();
		$paramsFlujo=[];
	
		$escenario=Escenario::find($input['escenario_id']);
		$paramsFlujo['escenario_id']=$input['escenario_id'];

		$flujo=Flujo::firstOrNew($paramsFlujo);

		$flujo->flujo_crudo=$input['flujo_crudo'];

		if(array_key_exists('actualizar',$input)){
			$flujo->procesarElCrudo();
			$flujo->save();				
		}

		if(array_key_exists('guardar',$input)){

			$flujo->flujo_procesado=$input['flujo_procesado'];
			$flujo->dataset=$input['dataset'];
			$flujo->save();				

		}

		return redirect()->back();

	}

    //
}
