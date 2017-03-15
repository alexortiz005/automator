<?php

namespace App\Http\Controllers;

use App\Asercion;
use App\Modulo;
use App\Argumento;
use App\Keyword;

use Illuminate\Http\Request;

class AsercionController extends Controller
{

	public function verAsercion($asercionId){

		$asercion=Asercion::find($asercionId);
		if(is_null($asercion))
			return redirect('/modulos');
		$estados=Asercion::estados();	
		$keywords_asercion=$asercion->keywords()->get();
		$keywords=Keyword::orderBy('nombre')->get();
		$sizeSelectKeywords=sizeof($keywords);
		if($sizeSelectKeywords>20)
			$sizeSelectKeywords=20;	
		$maxNumeroArgumentos=$asercion->maxNumeroArgumentos();
		$modulos=Modulo::All();

		if($asercion==null)
			return redirect('/modulos');	
		
		return view('aserciones.verAsercion',['asercion'=>$asercion,
											  'estados'=>$estados,
											  'keywords'=>$keywords,
											  'keywords_asercion'=>$keywords_asercion,
											  'sizeSelectKeywords'=>$sizeSelectKeywords,
											  'modulos'=>$modulos,
											  'maxNumeroArgumentos'=>$maxNumeroArgumentos]);
	}

	public function editar(Request $request){

		$input=$request->all();		
		$asercion=Asercion::find($input['id']);	

		$asercion->actualizar($input);			
		
		return redirect()->back();
	}

	public function merge(Request $request){

		$input=$request->all();

		$idsAserciones=explode(',', $input['asercionesToMerge']);

		$aserciones=[];

		foreach ($idsAserciones as $key => $idAsercion) {
			$aserciones[]=Asercion::find($idAsercion);
		}

		$asercion_base=$aserciones[0];
		$asercion_to_merge=$aserciones[0];

		foreach ($aserciones as $key => $asercion) {

			if(strlen($asercion->descripcion)>=strlen($asercion_base->descripcion))
				$asercion_base=$asercion;
		
		}

		foreach ($aserciones as $key => $asercion) {

			if(strlen($asercion->descripcion)<=strlen($asercion_to_merge->descripcion))
				$asercion_to_merge=$asercion;
		
		}

		$asercion_base->merge($asercion_to_merge);

		return redirect()->back();

	}
    //
}
