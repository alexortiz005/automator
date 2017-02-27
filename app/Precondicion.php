<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Precondicion extends Model
{

	protected $table = 'precondiciones';	


    public function escenarios(){

		return $this->belongsToMany('App\Escenario', 'precondicion_escenario');

	}    

    public function modulos(){

        return $this->belongsToMany('App\Modulo', 'precondicion_modulo');

    } 

    public function doSingleton(){    


        $precondicion=self::where('variable','=',$this->variable)->where('descripcion','=',$this->descripcion)->first();
        
        if(is_null($precondicion)){
            
            $this->save();  
            return $this;       
        }

        return $precondicion;

    }

    public function equals(Precondicion $precondicion){
        
        if($this->variable!=$precondicion->variable)
            return false;
        if($this->descripcion!=$precondicion->descripcion)
            return false;
        return true;

    }

    //
}
