<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asercion extends Model
{

	protected $table = 'aserciones';	

    protected static $estados=['sin_asignar'=>"Sin Asignar",'sin_disenar'=>"Sin Diseñar",'disenada'=>"Diseñada",'testeada'=>"Testeada"];

    public function escenarios(){

		return $this->belongsToMany('App\Escenario', 'asercion_escenario');

	}

    public function modulos(){

        return $this->belongsToMany('App\Modulo', 'asercion_modulo');

    } 

    public function aserciones(){

        return $this->belongsToMany('App\Asercion', 'asercion_keyword');

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

    public function actualizar($input){

        $this->estado=$input['estado'];
        $this->variable=$input['variable'];
        $this->objeto=$input['objeto'];
        $this->ruta=$input['ruta'];
        $this->descripcion=$input['descripcion'];
        $this->descripcion_formateada=$input['descripcion_formateada'];
        $this->save();

    }

    public static function estados(){
        return self::$estados;

    }
   
}

