<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asercion extends Model
{

	protected $table = 'aserciones';	

    public function escenarios(){

		return $this->belongsToMany('App\Escenario', 'asercion_escenario');

	}

    public function modulos(){

        return $this->belongsToMany('App\Modulo', 'asercion_modulo');

    } 

    public function doSingleton(){    


        $asercion=self::where('variable','=',$this->variable)->where('descripcion','=',$this->descripcion)->first();
        
        if(is_null($asercion)){
            
            $this->save();  
            return $this;       
        }

        return $asercion;

    }

    public function equals(Asercion $asercion){
        
        if($this->variable!=$asercion->variable)
            return false;
        if($this->descripcion!=$asercion->descripcion)
            return false;
        return true;

    }
   
}

