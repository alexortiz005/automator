<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Modulo;
use App\Keyword;
use App\Precondicion;
use App\Asercion;

class ModulosController extends Controller
{

	public function vistaModulos(){

		$modulos=Modulo::All();		
		return view('modulos.vistaModulos')->with('modulos',$modulos);
	}

	public function verModulo($moduloId){

		$modulo=Modulo::find($moduloId);
		$modulos=Modulo::all();
		
		if(is_null($modulo))
			return redirect('/modulos');

		$keywords=Keyword::orderBy('nombre')->get();

		$sizeSelectKeywords=sizeof($keywords);
		if($sizeSelectKeywords>20)
			$sizeSelectKeywords=20;

		$modulo->testsPrecondiciones();

		$escenarios=$modulo->escenarios()->orderBy('numero')->get();
		$precondiciones=$modulo->precondiciones()->orderBy('variable')->get();
		$aserciones=$modulo->aserciones()->orderBy('variable')->get();
	
		return view('modulos.verModulo',['modulo'=>$modulo,
										'modulos'=>$modulos,
										'escenarios'=>$escenarios,
										'precondiciones'=>$precondiciones,
										'aserciones'=>$aserciones,
										'keywords'=>$keywords,
										'sizeSelectKeywords'=>$sizeSelectKeywords]);
	}

	public function eliminar(Request $request){

		$input=$request->all();
		$modulo=Modulo::find($input['idModulo']);
		$modulo->purge();
		
		return redirect('/modulos');
	}

	public function crearObjeto(Request $request)
	{
		$input=$request->all();
		$tipo=$input['tipo'];

		$modulo=Modulo::find($input['moduloId']);

		if($tipo=='precondicion'){

			$precondicion=Precondicion::firstOrCreate([ 
														'variable' => $input['variable'],
														'objeto' => $input['objeto'],
														'ruta' => $input['ruta'],
														'descripcion' => $input['descripcion'],
														'descripcion_formateada' => $input['descripcion'] 
													  ]);

			$modulo->precondiciones()->attach($precondicion->id);

		}

		if($tipo=='asercion'){

			$asercion=Asercion::firstOrCreate([ 
														'variable' => $input['variable'],
														'objeto' => $input['objeto'],
														'ruta' => $input['ruta'],
														'descripcion' => $input['descripcion'],
														'descripcion_formateada' => $input['descripcion'] 
													  ]);

			$modulo->aserciones()->attach($asercion->id);

		}

		return redirect()->back();

	}


	public function asociarObjeto(Request $request)
	{
		$input=$request->all();
		

		dd($input);
		# code...
	}
    //
}
