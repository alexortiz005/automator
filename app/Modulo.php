<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
	protected $table='modulos';

	public function escenarios(){
		return $this->hasMany('App\Escenario', 'modulo','nombre');
	}


	public function doSingleton(){    


        $modulo=self::where('nombre','=',$this->nombre)->first();
        
        if(is_null($modulo)){
            
            $this->save();  
            return $this;       
        }

        return $modulo;

    }

    public function precondiciones(){

        $escenarios=$this->escenarios()->get();       
        $precondiciones=array();

        foreach ($escenarios as $key => $escenario) {

            $escPrecondiciones=$escenario->precondiciones()->get(); 
            $idsEscPrecondiciones=array_pluck($escPrecondiciones, 'id');

            foreach ($escPrecondiciones as $key => $escPrecondicion) {
              

                $idsPrecondiciones=array_pluck($precondiciones, 'id');

                if(!in_array($escPrecondicion->id, $idsPrecondiciones)){
                    $precondiciones[]=$escPrecondicion;
                }

                                                   
            }   
        }      
        return $precondiciones;
    }

    public function aserciones(){

        $escenarios=$this->escenarios()->get();       
        $aserciones=array();

        foreach ($escenarios as $key => $escenario) {

            $escAserciones=$escenario->aserciones()->get(); 
            $idsEscAserciones=array_pluck($escAserciones, 'id');

            foreach ($escAserciones as $key => $escAsercion) {              

                $idsAserciones=array_pluck($aserciones, 'id');

                if(!in_array($escAsercion->id, $idsAserciones)){
                    $aserciones[]=$escAsercion;
                }
                                                   
            }   
        }      
        return $aserciones;
    }
    //
}
