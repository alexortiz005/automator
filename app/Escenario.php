<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Escenario extends Model
{

	protected $table = 'escenarios';

	public function aserciones(){

		return $this->belongsToMany('App\Asercion', 'asercion_escenario');

	}

	public function precondiciones(){

		return $this->belongsToMany('App\Precondicion', 'precondicion_escenario');

	}

	public function modulo(){
		return $this->BelongsTo('App\Modulo', 'modulo','nombre');
	}

    public function flujo()
    {
        return $this->hasOne('App\Flujo');
    }

	public function sincronizarPrecondiciones($precondiciones){		

		$idsPrecondiciones=array();

		foreach ($precondiciones as $key => $precondicion) {
			$idsPrecondiciones[]=$precondicion->id;
		}

        $old_precondiciones=$this->precondiciones;

		$this->precondiciones()->sync($idsPrecondiciones);

        foreach ($old_precondiciones as $key => $precondicion) {
            $precondicion->tryDelete();
        }
	

	}

	public function sincronizarAserciones($aserciones){		

		$idsAserciones=array();

		foreach ($aserciones as $key => $asercion) {
			$idsAserciones[]=$asercion->id;
		}

        $old_aserciones=$this->aserciones;

		$this->aserciones()->sync($idsAserciones);

        foreach ($old_aserciones as $key => $asercion) {
            $asercion->tryDelete();
        }

	}
	

	public function doSingleton(){    


        $escenario=self::where('numero','=',$this->numero)->where('modulo','=',$this->modulo)->first();
        
        if(is_null($escenario)){
            
            $this->save();  
            return $this;       
        }

        return $escenario;

    }

    public function esMiPrecondicion($precondicion){    


        $MisPrecondiciones=$this->precondiciones()->get();


        foreach ($MisPrecondiciones as $key => $miPrecondicion) {
        	if($miPrecondicion->equals($precondicion))
        		return true;
        }

        return false;

    }

    public function esMiAsercion($asercion){    


        $MisAserciones=$this->aserciones()->get();

        foreach ($MisAserciones as $key => $miAsercion) {
        	if($miAsercion->equals($asercion))
        		return true;
        }

        return false;

    }

    public function purge(){

    	$precondiciones=$this->precondiciones;
    	$aserciones=$this->aserciones;

    	$this->precondiciones()->detach();
    	$this->aserciones()->detach();
        $flujo=$this->flujo();
        $flujo->escenario_id=null;
        $this->flujo_id=null;
        $flujo->delete();



    	foreach ($precondiciones as $key => $precondicion) {
    		$precondicion->tryDelete();
    	}

    	foreach ($aserciones as $key => $asercion) {
    		$asercion->tryDelete();
    	}


    	$this->delete();


    }
	

    //
}
