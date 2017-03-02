<?php

namespace App\Http\Controllers;

use App\Precondicion;
use App\Modulo;
use App\Argumento;


use Illuminate\Http\Request;

class PrecondicionController extends Controller
{

	public function verPrecondicion($precondicionId){

		$precondicion=Precondicion::find($precondicionId);
		$estados=Precondicion::estados();	
		$keywords=$precondicion->keywords()->get();	
		$maxNumeroArgumentos=$precondicion->maxNumeroArgumentos();
		$modulos=Modulo::All();

		if($precondicion==null)
			return redirect('/modulos');	
		
		return view('precondiciones.verPrecondicion',['precondicion'=>$precondicion,'estados'=>$estados,'keywords'=>$keywords,'modulos'=>$modulos,'maxNumeroArgumentos'=>$maxNumeroArgumentos]);
	}

	public function editar(Request $request){

		$input=$request->all();		
		$precondicion=Precondicion::find($input['id']);	

		$precondicion->actualizar($input);			
		
		return redirect()->back();
	}
    //
}
