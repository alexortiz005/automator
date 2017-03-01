<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Precondicion extends Model
{

	protected $table = 'precondiciones';	
    protected $fillable = ['name','variable','ruta','objeto','ruta','descripcion','descripcion_formateada'];

    protected static $estados=['sin_asignar'=>"Sin Asignar",'sin_disenar'=>"Sin Diseñar",'disenada'=>"Diseñada",'testeada'=>"Testeada"];


    public function escenarios(){

		return $this->belongsToMany('App\Escenario', 'precondicion_escenario');

	}    

    public function modulos(){

        return $this->belongsToMany('App\Modulo', 'precondicion_modulo');

    } 

    public function keywords(){

        return $this->belongsToMany('App\Keyword', 'precondicion_keyword');

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

    public static function estados(){
        return self::$estados;

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

    //
}
