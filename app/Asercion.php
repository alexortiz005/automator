<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asercion extends Model
{

	protected $table = 'aserciones';	

    public function escenarios(){

		return $this->belongsToMany('App\Escenario', 'asercion_escenario');

	}

    public function doSingleton(){    


        $asercion=self::where('variable','=',$this->variable)->where('descripcion','=',$this->descripcion)->first();
        
        if(is_null($asercion)){
            
            $this->save();  
            return $this;       
        }

        return $asercion;

    }
   
}

