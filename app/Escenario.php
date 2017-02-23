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

	public function attachPrecondiciones($precondiciones){

		$old_precondiciones=$this->precondiciones();

		$idsPrecondiciones=array();

		foreach ($precondiciones as $key => $precondicion) {
			$idsPrecondiciones[]=$precondicion->id;
		}

		$old_precondiciones->sync($idsPrecondiciones);
	

	}

	public function attachAserciones($aserciones){

		$old_aserciones=$this->aserciones();

		$idsAserciones=array();

		foreach ($aserciones as $key => $asercion) {
			$idsAserciones[]=$asercion->id;
		}

		$old_aserciones->sync($idsAserciones);

	}

	public function doSingleton(){    


        $escenario=self::where('numero','=',$this->numero)->where('modulo','=',$this->modulo)->first();
        
        if(is_null($escenario)){
            
            $this->save();  
            return $this;       
        }

        return $escenario;

    }
	

    //
}
