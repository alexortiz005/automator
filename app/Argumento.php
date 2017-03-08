<?php

namespace App;
use App\Keyword;
use App\Test;

use Illuminate\Database\Eloquent\Model;

class Argumento extends Model
{
	protected $table = 'argumentos';
    protected $fillable = ['nombre','tipo'];

	public function keywords(){

		return $this->belongsToMany('App\Keyword', 'keyword_argumento');

	}

    public function tests(){

        return $this->belongsToMany('App\Test', 'test_argumento');

    }

    public function flujos(){

        return $this->belongsToMany('App\Flujo', 'flujo_argumento');

    }

	public function doSingleton(){    


        $argumento=self::where('nombre','=',$this->nombre)->first();
        
        if(is_null($argumento)){
            
            $this->save();  
            return $this;       
        }

        return $argumento;

    }

    public static function entregarNombres($parametro_argumentos){
    	$argumentos=explode(' ', $parametro_argumentos);
    	$nombres_argumentos=[];
    	$avoid=['${','}'];
    	foreach ($argumentos as $key => $argumento) {
    		$nombres_argumentos[]= str_replace($avoid, "", $argumento);
    	}

    	return $nombres_argumentos;

    }

    public static function entregarNombresComoString($parametro_argumentos){
        
        $avoid=['${','}'];
        
        $parametro_argumentos= str_replace($avoid, "", $parametro_argumentos);
       

        return $parametro_argumentos;

    }

    public function tryDelete(){
 
        if(sizeof($this->tests)==0&&sizeof($this->keywords)==0&&sizeof($this->flujos)==0){
              $this->delete();
              return true;
        }      

        return false;

    }

    //
}
