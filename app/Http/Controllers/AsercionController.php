<?php

namespace App\Http\Controllers;

use App\Asercion;

use Illuminate\Http\Request;

class AsercionController extends Controller
{

	public function verAsercion($asercionId){

		$asercion=Asercion::find($asercionId);
		$estados=Asercion::estados();		

		if($asercion==null)
			return redirect('/modulos');	
		
		return view('aserciones.verAsercion',['asercion'=>$asercion],['estados'=>$estados]);
	}

	public function editar(Request $request){

		$input=$request->all();		
		$asercion=Asercion::find($input['id']);	

		$asercion->actualizar($input);			
		
		return redirect()->back();
	}
    //
}
