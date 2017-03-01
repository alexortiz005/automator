<?php

namespace App\Http\Controllers;

use App\Precondicion;

use Illuminate\Http\Request;

class PrecondicionController extends Controller
{

	public function verPrecondicion($precondicionId){

		$precondicion=Precondicion::find($precondicionId);
		$estados=Precondicion::estados();		

		if($precondicion==null)
			return redirect('/modulos');	
		
		return view('precondiciones.verPrecondicion',['precondicion'=>$precondicion],['estados'=>$estados]);
	}

	public function editar(Request $request){

		$input=$request->all();		
		$precondicion=Precondicion::find($input['id']);	

		$precondicion->actualizar($input);			
		
		return redirect()->back();
	}
    //
}
