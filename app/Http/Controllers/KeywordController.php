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

			if($tipo=='precondicion'){
				$precondicion=Precondicion::find($input['idPrecondicion']);
				$nombres_argumentos=Argumento::entregarNombres($input['argumentos']);
				$nombre= $input['nombre'];
				$source= $input['source'];

				$keyword=new Keyword;
				$keyword->nombre=$nombre;
				$keyword->source=$source;
				$keyword->save();
				$keyword->asociarArgumentosPorNombre($nombres_argumentos);
				$keyword->precondiciones()->attach($precondicion->id);



				return redirect('/precondicion/'.$precondicion->id);

			}

			if($tipo=='asercion'){
				$asercion=Asercion::find($input['idAsercion']);
				$nombres_argumentos=explode(' ', $input['argumentos']);
				$nombre= $input['nombre'];
				$source= $input['source'];

				$keyword=new Keyword;
				$keyword->nombre=$nombre;
				$keyword->source=$source;
				$keyword->save();
				$keyword->asociarArgumentosPorNombre($nombres_argumentos);
				$keyword->aserciones()->attach($asercion->id);

				return redirect('/asercion/'.$asercion->id);


			}

			return redirect('/modulos');
		

	}

	public function desasociar($tipo,$idKeyword,$id){

		if($tipo=='precondicion'){
			
			$keyword=Keyword::find($idKeyword);

			$keyword->precondiciones()->detach($id);

			if(sizeof($keyword->precondiciones()->get())==0)
				$keyword->purge();

			return redirect('/precondicion/'.$id);

		}
		if ($tipo=='asercion') {

			$keyword=Keyword::find($idKeyword);

			$keyword->aserciones()->detach($id);

			if(sizeof($keyword->aserciones()->get())==0)
				$keyword->purge();


			return redirect('/asercion/'.$id);
		
		}

		return redirect('/modulos');
		

	}

	public function verKeyword($idKeyword){

		$keyword=Keyword::find($idKeyword);
		$modulos=Modulo::All();
		$argumentosKeyword=$keyword->argumentos()->get();
		
		return view('keywords.verKeyword',['keyword'=>$keyword,'modulos'=>$modulos,'argumentosKeyword'=>$argumentosKeyword]);
	}


	public function editarKeyword(Request $request){


		$input=$request->all();	

		$keyword=Keyword::find($input['id']);
		$nombres_argumentos=Argumento::entregarNombres($input['argumentos']);

		$keyword->actualizar($input);
		$keyword->asociarArgumentosPorNombre($nombres_argumentos);

		return redirect('/keyword/'.$keyword->id);

	}

    //
}
