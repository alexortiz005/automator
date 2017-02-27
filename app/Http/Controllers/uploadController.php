<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use Storage;

use Response;

use App\Reader;
use App\Precondicion;
use App\Asercion;
use App\Escenario;
use App\Modulo;

class uploadController extends Controller
{
	public function vistaSubir(){
		return view('upload.upload');
	}

	public function subir(Request $request){
	
		$files=$request->file('file');
		$errors=array();		

		if(!empty($files)){

			foreach ($files as $key => $file) {
					
				$reader= new Reader($file);

				try {					
					$esc=$reader->extraerEscenario();
					$precondiciones=$reader->extraerPrecondiciones();
					$aserciones=$reader->extraerAserciones();
					
				} catch (\Exception $e) {

					$errors[]=array("file"=>$file,"message"=>$e->getMessage());				
					continue;
					
				}				

				$precondicionesAux=array();	
				foreach ($precondiciones as $key => $precondicion) {
						$precondicionesAux[]=$precondicion->doSingleton();					
				}

				$asercionesAux=array();
				foreach ($aserciones as $key => $asercion) {
						$asercionesAux[]=$asercion->doSingleton();					
				}		


				$esc->sincronizarPrecondiciones($precondicionesAux);
				$esc->sincronizarAserciones($asercionesAux);
				
			}		

			$modulos=Modulo::All();	
			foreach ($modulos as $key => $modulo) {
					$modulo->sincronizarAserciones();
					$modulo->sincronizarPrecondiciones();
			}	

			

			return response()->json(array('success' => True,"errors"=>$errors,"modulos"=>$modulos));

		}else{

			$errors[]=array("message"=>"No se selecciono ningun archivo");			
			return response()->json(array('success' => False,"errors"=>$errors));

		}
		
	}

    //
}
