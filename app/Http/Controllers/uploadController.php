<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class uploadController extends Controller
{
	public function vistaSubir(){
		return view('upload.upload');
	}

	public function subir(request $request){

		if($request->hasFile('archivoWord')){



			$file = $request->file('archivoWord');
		    $wordFile = \PhpOffice\PhpWord\IOFactory::load($file,'ODText');		  
		    $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($wordFile, 'HTML');
			$objWriter->save('doc.html');



			

			foreach($wordFile->getSections() as $section) {
			    foreach($section->getElements() as $element) {
			        if(method_exists($element,'getText')) {
			        	var_dump($element->getText());
			        	var_dump($element->getElementId());
			        	echo "<br>";
			        	
			        }
			    }
			    echo 'fin seccion <br>';
			}

			dd($wordFile);
		    

		}else{
			return "No selecciono archivo alguno";
		}
		
	}
    //
}
