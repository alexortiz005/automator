<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Test extends Model
{

	protected $table = 'tests';	

	protected $fillable = ['tipo','keyword_id'];

	public function keyword(){
		return $this->BelongsTo('App\Keyword');
	} 

	public function argumentos(){

		return $this->belongsToMany('App\Argumento', 'test_argumento');

	}

	public function asociarArgumentosDesdeString($stringArgumentos){

		$arrayStringArgumentos=explode(' ', $stringArgumentos);

		$arrayArgumentos=[];

		foreach ($arrayStringArgumentos as $stringArgumento) {		
			if($stringArgumento!=''){
				$argumento=Argumento::firstOrCreate(['nombre' => $stringArgumento,'tipo'=>'definido']);
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

	public function purge(){

		$argumentos=$this->argumentos;
		$this->argumentos()->detach();

		foreach ($argumentos as $key => $argumento) {
			$argumento->tryDelete();
		}

		$this->delete();

	}


    //
}
