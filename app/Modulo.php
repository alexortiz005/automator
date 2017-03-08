<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
	protected $table='modulos';
    

	public function escenarios(){
		return $this->hasMany('App\Escenario', 'modulo','nombre');
	}

    public function aserciones(){

        return $this->belongsToMany('App\Asercion', 'asercion_modulo');

    }

    public function precondiciones(){

        return $this->belongsToMany('App\Precondicion', 'precondicion_modulo');

    }


	public function doSingleton(){    


        $modulo=self::where('nombre','=',$this->nombre)->first();
        
        if(is_null($modulo)){
            
            $this->save();  
            return $this;       
        }

        return $modulo;

    }

    //borra el modulo y todas sus variables del sistema
    public function purge(){

        $escenarios=$this->escenarios;
        $this->precondiciones()->detach();
        $this->aserciones()->detach();   
        
        foreach ($escenarios as $key => $escenario) {
            $escenario->purge();
        }

        $this->delete();
    }

    public function sincronizarPrecondiciones(){

        $precondiciones=$this->precondicionesDeMisEscenarios();

        $old_precondiciones=$this->precondiciones();

        $idsPrecondiciones=array();

        foreach ($precondiciones as $key => $precondicion) {
            $idsPrecondiciones[]=$precondicion->id;
        }

        $old_precondiciones->sync($idsPrecondiciones);
    

    }

    public function sincronizarAserciones(){

        $aserciones=$this->asercionesDeMisEscenarios();

        $old_aserciones=$this->aserciones();

        $idsAserciones=array();

        foreach ($aserciones as $key => $asercion) {
            $idsAserciones[]=$asercion->id;
        }

        $old_aserciones->sync($idsAserciones);

    }

    
    //FUNCIONES DEPRECADAS, PUES AHORA LA RELACION DEL MODULO CON LAS PRECONDICIONES ES DIRECTA

    public function precondicionesDeMisEscenarios(){

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

    public function asercionesDeMisEscenarios(){

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
    
}
