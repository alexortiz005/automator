<?php

namespace App\Http\Controllers;

use App\Asercion;
use App\Modulo;
use App\Argumento;

use Illuminate\Http\Request;

class AsercionController extends Controller
{

	public function verAsercion($asercionId){

		$asercion=Asercion::find($asercionId);
		$estados=Asercion::estados();	
		$keywords=$asercion->keywords()->get();	
		$maxNumeroArgumentos=$asercion->maxNumeroArgumentos();
		$modulos=Modulo::All();

		if($asercion==null)
			return redirect('/modulos');	
		
		return view('aserciones.verAsercion',['asercion'=>$asercion,'estados'=>$estados,'keywords'=>$keywords,'modulos'=>$modulos,'maxNumeroArgumentos'=>$maxNumeroArgumentos]);
	}

	public function editar(Request $request){

		$input=$request->all();		
		$asercion=Asercion::find($input['id']);	

		$asercion->actualizar($input);			
		
		return redirect()->back();
	}
    //
}
