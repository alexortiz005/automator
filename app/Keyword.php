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

	public function tests()
    {
        return $this->hasMany('App\Test');
    }

	public function asociarArgumentosDesdeString($stringArgumentos){

		$arrayStringArgumentos=explode(' ', $stringArgumentos);

		$arrayArgumentos=[];

		foreach ($arrayStringArgumentos as $stringArgumento) {		
			if($stringArgumento!=''){
				$argumento=Argumento::firstOrCreate(['nombre' => $stringArgumento]);
				$arrayArgumentos[]=$argumento;
			}			
		}

		$this->asociarArgumentos($arrayArgumentos);

	}

	public function asociarArgumentos($paramArgumentos){

		$idsArgumentos=[];

		foreach ($paramArgumentos as $key => $argumento) {
			$idsArgumentos[]=$argumento->id;
		}

		$argumentos=$this->argumentos;

		$this->argumentos()->sync($idsArgumentos);

		foreach ($argumentos as $key => $argumento) {
			$argumento->tryDelete();
		}

	}

	public function actualizar($input){
		$this->nombre=$input['nombre'];
		$this->source=$input['source'];
		$this->save();
	}

	public function tryDelete(){

		if(sizeof($this->aserciones)==0&&sizeof($this->precondiciones)==0){			
			$this->purge();
			return true;
		}

		return false;
	}

	public function purge(){

		$argumentos=$this->argumentos()->get();
		
		$this->argumentos()->detach();

		foreach ($this->tests as $test) {
			$test->purge();
		}

		foreach ($argumentos as $key => $argumento) {
			$argumento->tryDelete();
		}

		$this->delete();
	}


    //
}
