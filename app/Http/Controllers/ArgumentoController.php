<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Modulo;
use App\Argumento;

class ArgumentoController extends Controller
{
	public function vistaArgumentos()
	{
		$modulos=Modulo::all();
		$argumentos=Argumento::All();
		return view('argumentos.vistaArgumentos',['modulos'=>$modulos,'argumentos'=>$argumentos]);
	}

	public function unificarArgumentos(Request $request)
	{
		$input=$request->all();
		$ids=$input['argumentos_ids'];
		$nombre=$input['nombre'];

		$argumentos=Argumento::find($ids);

		$ids_keywords=[];
		$ids_tests=[];

		

		foreach ($argumentos as $keyArgumento => $argumento) {
			foreach ($argumento->keywords as $keyKeyword => $keyword) {
				$ids_keywords[]=$keyword->id;
			}
			foreach ($argumento->tests as $keyTest => $test) {
				$ids_tests[]=$test->id;
			}
			$argumento->keywords()->detach();
			$argumento->tests()->detach();
			$argumento->tryDelete();

		}

		$ids_keywords=array_unique($ids_keywords);
		$ids_tests=array_unique($ids_tests);

		$result_argumento=Argumento::firstOrCreate(['nombre'=>$nombre]);

		$result_argumento->keywords()->sync($ids_keywords,false);
		$result_argumento->tests()->sync($ids_tests,false);

		return redirect()->back();
	}
    //
}
