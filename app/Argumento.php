<?php

namespace App;
use App\Keyword;

use Illuminate\Database\Eloquent\Model;

class Argumento extends Model
{
	protected $table = 'argumentos';

	public function keywords(){

		return $this->belongsToMany('App\Keyword', 'keyword_argumento');

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

    //
}
