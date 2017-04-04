<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Modulo;
use App\Precondicion;
use App\Asercion;
use App\Argumento;
use App\Keyword;


class KeywordController extends Controller
{

	public function vistaCrearKeyword(Request $request){

		$input=$request->all();	
		$modulos=Modulo::All();
		$argumentos=Argumento::All();
		$tipo=$input['tipo'];

		if($tipo=='precondicion'){

			$precondicion=Precondicion::find($input['idObjeto']);
			return view('keywords.crearKeyword',['modulos'=>$modulos,'precondicion'=>$precondicion,'argumentos'=>$argumentos]);

		}
		if($tipo=='asercion'){

			$asercion=Asercion::find($input['idObjeto']);
			return view('keywords.crearKeyword',['modulos'=>$modulos,'asercion'=>$asercion,'argumentos'=>$argumentos]);


		}

		
	}

	public function crearKeyword(Request $request){


			$input=$request->all();		
			$tipo=	$input['tipo'];
			$nombre= $input['nombre'];
			$source= $input['source'];
			$argumentosString=Argumento::entregarNombresComoString($input['argumentos']);			

			if($tipo=='precondicion'){

				$precondicion=Precondicion::find($input['idObjeto']);

				$keyword=new Keyword;
				$keyword->nombre=$nombre;
				$keyword->source=$source;
				$keyword->save();
				$keyword->asociarArgumentosDesdeString("");
				$keyword->asociarArgumentosDesdeString($argumentosString);				
				$keyword->precondiciones()->attach($precondicion->id);

				$precondicion->actualizarEstado();
			}

			if($tipo=='asercion'){

				$asercion=Asercion::find($input['idObjeto']);	

				$keyword=new Keyword;
				$keyword->nombre=$nombre;
				$keyword->source=$source;
				$keyword->save();
				$keyword->asociarArgumentosDesdeString("");
				$keyword->asociarArgumentosDesdeString($argumentosString);
				$keyword->aserciones()->attach($asercion->id);

				$asercion->actualizarEstado();

			}

			return redirect()->back();
		

	}


	public function asociarOtrosKeywords(Request $request){

		$input=$request->all();	
		$tipo=$input['tipo'];

		if($tipo=='precondicion'){			
			
			$precondicion=Precondicion::find($input['idObjeto']);

			$keywords=$input['otros_keywords'];

			$precondicion->keywords()->sync($keywords,false);

			$precondicion->actualizarEstado();


		}
		if ($tipo=='asercion') {

			$asercion=Asercion::find($input['idObjeto']);

			$keywords=$input['otros_keywords'];

			$asercion->keywords()->sync($keywords,false);

			$asercion->actualizarEstado();

		
		}

		return redirect()->back();




	}

	public function desasociar($tipo,$idKeyword,$id){

		if($tipo=='precondicion'){

			$precondicion=Precondicion::find($id);
			
			$keyword=Keyword::find($idKeyword);

			$keyword->precondiciones()->detach($id);

			$precondicion->actualizarEstado();
			

		}
		if ($tipo=='asercion') {

			$asercion=Asercion::find($id);

			$keyword=Keyword::find($idKeyword);

			$keyword->aserciones()->detach($id);

			$asercion->actualizarEstado();
		
		}

		return redirect()->back();
		

	}

	public function verKeyword($idKeyword){

		$keyword=Keyword::find($idKeyword);
		if(is_null($keyword))
			return redirect('/modulos');
		$modulos=Modulo::All();
		$argumentosKeyword=$keyword->argumentos()->get();
		
		$testExitoso=$keyword->tests()->where('tests.tipo','exitoso')->first();
		$testErrado=$keyword->tests()->where('tests.tipo','errado')->first();
		$testInexistente=$keyword->tests()->where('tests.tipo','inexistente')->first();
		$tests=['testExitoso'=>$testExitoso,'testErrado'=>$testErrado,'testInexistente'=>$testInexistente];
	
		return view('keywords.verKeyword',['keyword'=>$keyword,
										   'modulos'=>$modulos,
										   'tests'=>$tests,
										   'argumentosKeyword'=>$argumentosKeyword
										   ]);
	}

	public function obtenerKeywordJSON(Request $request){

		$input=$request->all();	

		$keyword=Keyword::find($input['id']);
		$argumentos=$keyword->argumentos()->get()->toArray();
		$argumentos=array_pluck($argumentos, 'nombre');

		return response()->json(['keyword'=>$keyword,'argumentos'=>$argumentos]);


	}


	public function editarKeyword(Request $request){

		$input=$request->all();	

		$keyword=Keyword::find($input['id']);
		$argumentosString=Argumento::entregarNombresComoString($input['argumentos']);

		$keyword->actualizar($input);
		$keyword->asociarArgumentosDesdeString("");
		$keyword->asociarArgumentosDesdeString($argumentosString);

		foreach ($keyword->aserciones as $key => $asercion) {
			$asercion->actualizarEstado();
		}

		foreach ($keyword->precondiciones as $key => $precondicion) {
			$precondicion->actualizarEstado();
		}

		return redirect()->back();

	}

	public function validarNombreKeyword(Request $request){

		$input=$request->all();			

		$old_keyword=Keyword::where('nombre',$input['nombre'])->first();

		if(is_null($old_keyword))
			return 'true';
		return 'false';


	}

    //
}
