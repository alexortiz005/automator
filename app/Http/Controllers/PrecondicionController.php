<?php

namespace App\Http\Controllers;

use App\Precondicion;
use App\Modulo;
use App\Argumento;
use App\Keyword;


use Illuminate\Http\Request;

class PrecondicionController extends Controller
{

	public function verPrecondicion($precondicionId){

		$precondicion=Precondicion::find($precondicionId);
		$estados=Precondicion::estados();	
		$keywords_precondicion=$precondicion->keywords()->get();
		$keywords=Keyword::orderBy('nombre')->get();
		$sizeSelectKeywords=sizeof($keywords);
		if($sizeSelectKeywords>20)
			$sizeSelectKeywords=20;
		$maxNumeroArgumentos=$precondicion->maxNumeroArgumentos();
		$modulos=Modulo::All();

		if($precondicion==null)
			return redirect('/modulos');	
		
		return view('precondiciones.verPrecondicion',['precondicion'=>$precondicion,
													  'estados'=>$estados,
													  'keywords'=>$keywords,
													  'sizeSelectKeywords'=>$sizeSelectKeywords,
													  'keywords_precondicion'=>$keywords_precondicion,
													  'modulos'=>$modulos,
													  'maxNumeroArgumentos'=>$maxNumeroArgumentos
													  ]);
	}

	public function editar(Request $request){

		$input=$request->all();		
		$precondicion=Precondicion::find($input['id']);	

		$precondicion->actualizar($input);			
		
		return redirect()->back();
	}
    //
}
