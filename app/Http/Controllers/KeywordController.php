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

			$precondicion=Precondicion::find($input['idPrecondicion']);
			return view('keywords.crearKeyword',['modulos'=>$modulos,'precondicion'=>$precondicion,'argumentos'=>$argumentos]);

		}
		if($tipo=='asercion'){

			$asercion=Asercion::find($input['idAsercion']);
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

				$precondicion=Precondicion::find($input['idPrecondicion']);

				$keyword=new Keyword;
				$keyword->nombre=$nombre;
				$keyword->source=$source;
				$keyword->save();
				$keyword->asociarArgumentosDesdeString($argumentosString);
				$keyword->precondiciones()->attach($precondicion->id);

				return redirect('/precondicion/'.$precondicion->id);

			}

			if($tipo=='asercion'){

				$asercion=Asercion::find($input['idAsercion']);	

				$keyword=new Keyword;
				$keyword->nombre=$nombre;
				$keyword->source=$source;
				$keyword->save();
				$keyword->asociarArgumentosDesdeString($argumentosString);
				$keyword->aserciones()->attach($asercion->id);

				return redirect('/asercion/'.$asercion->id);


			}

			return redirect('/modulos');
		

	}


	public function asociarOtrosKeywords(Request $request){

		$input=$request->all();	
		$tipo=$input['tipo'];

		if($tipo=='precondicion'){			
			
			$precondicion=Precondicion::find($input['idPrecondicion']);

			$keywords=$input['otros_keywords'];

			$precondicion->keywords()->sync($keywords,false);

			return redirect('/precondicion/'.$precondicion->id);

		}
		if ($tipo=='asercion') {

			$asercion=Asercion::find($input['idAsercion']);

			$keywords=$input['otros_keywords'];

			$asercion->keywords()->sync($keywords,false);

			return redirect('/asercion/'.$asercion->id);
		
		}

		return redirect('/modulos');


	}

	public function desasociar($tipo,$idKeyword,$id){

		if($tipo=='precondicion'){
			
			$keyword=Keyword::find($idKeyword);

			$keyword->precondiciones()->detach($id);

			if(sizeof($keyword->precondiciones)==0&&sizeof($keyword->aserciones)==0)
				$keyword->purge();

			return redirect('/precondicion/'.$id);

		}
		if ($tipo=='asercion') {

			$keyword=Keyword::find($idKeyword);

			$keyword->aserciones()->detach($id);

			if(sizeof($keyword->precondiciones)==0&&sizeof($keyword->aserciones)==0)
				$keyword->purge();


			return redirect('/asercion/'.$id);
		
		}

		return redirect('/modulos');
		

	}

	public function verKeyword($idKeyword){

		$keyword=Keyword::find($idKeyword);
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


	public function editarKeyword(Request $request){


		$input=$request->all();	

		$keyword=Keyword::find($input['id']);
		$argumentosString=Argumento::entregarNombresComoString($input['argumentos']);

		$keyword->actualizar($input);
		$keyword->asociarArgumentosDesdeString($argumentosString);

		return redirect('/keyword/'.$keyword->id);

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
