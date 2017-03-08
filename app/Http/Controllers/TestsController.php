<?php

namespace App\Http\Controllers;

use App\Test;
use App\Keyword;

use Illuminate\Http\Request;

class TestsController extends Controller
{

	public function editarTests(Request $request){

		$input=$request->all();	

		$keyword=Keyword::find($input['idKeyword']);

		$testExitoso = Test::firstOrNew(['tipo' => 'exitoso','keyword_id'=>$input['idKeyword']]);
		$testExitoso->nombre=$keyword->nombre.'Exitoso';			
		
		$testExitoso->save();
		$testExitoso->asociarArgumentosDesdeString($input['exitoso']);

		$testErrado = Test::firstOrNew(['tipo' => 'errado','keyword_id'=>$input['idKeyword']]);		
		$testErrado->nombre=$keyword->nombre.'Errado';		
		
		$testErrado->save();
		$testErrado->asociarArgumentosDesdeString($input['errado']);

		$testInexistente = Test::firstOrNew(['tipo' => 'inexistente','keyword_id'=>$input['idKeyword']]);
		$testInexistente->nombre=$keyword->nombre.'Inexistente';	
		
		$testInexistente->save();
		$testInexistente->asociarArgumentosDesdeString($input['inexistente']);

		return redirect()->back();
	}
}
