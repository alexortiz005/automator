<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
	protected $table = 'keywords';

	public function aserciones(){

		return $this->belongsToMany('App\Asercion', 'asercion_keyword');

	}

	public function precondiciones(){

		return $this->belongsToMany('App\Precondicion', 'precondicion_keyword');

	}

	public function argumentos(){

		return $this->belongsToMany('App\Argumento', 'keyword_argumento');

	}

	public function asociarArgumentosPorNombre($nombres_argumentos){

		$nombres_argumentos=array_unique($nombres_argumentos);

		$argumentos_aux=[];

		foreach ($nombres_argumentos as $key => $nombre_argumento) {

			$argumento= new Argumento;
			$argumento->nombre=$nombre_argumento;
			$argumento=$argumento->doSingleton();	
			$argumentos_aux[]=$argumento->id;

		}

		$this->argumentos()->sync($argumentos_aux);

	}

	public function actualizar($input){
		$this->nombre=$input['nombre'];
		$this->source=$input['source'];
		$this->save();
	}

	public function purge(){

		$argumentos=$this->argumentos()->get();
		
		$this->argumentos()->detach();		

		foreach ($argumentos as $key => $argumento) {

			$cantidadKeywords=sizeof($argumento->keywords()->get());

			if($cantidadKeywords==0)
				$argumento->delete();
		}

		$this->delete();
	}


    //
}
