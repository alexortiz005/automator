<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Reader;
use App\Writer;
use App\Precondicion;
use App\Asercion;

class uploadController extends Controller
{
	public function vistaSubir(){
		return view('upload.upload');
	}

	public function subir(request $request){

		if($request->hasFile('archivoWord')){

			$file = $request->file('archivoWord');
			$reader= new Reader($file);
			//$reader->dumpFile();
			$precondiciones=$reader->extraerPrecondiciones();
			$aserciones=$reader->extraerAserciones();

			/*
			echo "las precondiciones son: <br>";
			dd($precondiciones);

			echo "<br>";

			*/

			echo "las aserciones son: <br>";
			dd($aserciones);
		
		    

		}else{
			return "No selecciono archivo alguno";
		}
		
	}
    //
}
