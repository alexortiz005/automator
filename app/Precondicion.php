<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Precondicion extends Model
{

	protected $table = 'precondiciones';	
    protected $fillable = ['variable','ruta','objeto','ruta','descripcion','descripcion_formateada'];

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
        $this->actualizarEstado();

    }

    public function maxNumeroArgumentos(){

        $keywords=$this->keywords()->get();       
        $max=0;

        foreach ($keywords as $key => $keyword) {
            if(sizeof($keyword->argumentos()->get())>$max)         
                $max=sizeof($keyword->argumentos()->get());
        }

        return $max;
    }

    public function tryDelete(){
             
        if(sizeof($this->escenarios)==0){
            $this->purge();
            return true;
        }

        $this->actualizarEstado();

        return false;
    }

    public function purge(){

        $this->modulos()->detach();

        $keywords=$this->keywords;
        $this->keywords()->detach();

        foreach ($keywords as $key => $keyword) {
            $keyword->tryDelete();            
        }

        $this->delete();


    }

    public function merge(Precondicion $precondicion_to_merge){


        $escenarios_precondicion_to_merge=$precondicion_to_merge->escenarios;

        $ids=[];      

        foreach ($escenarios_precondicion_to_merge as $key => $escenario) {   
            $ids[]=$escenario->id;
        }

        $this->escenarios()->syncWithoutDetaching($ids);

        $precondicion_to_merge->escenarios()->detach(); 

        $precondicion_to_merge->purge();

        $this->actualizarEstado();


    }

    public function actualizarEstado(){

        $keywords=$this->keywords;

        if(sizeof($keywords)==0){

            $this->estado=='sin_asignar';
         
        }else{

            $this->estado='disenada';

            foreach ($keywords as $key => $keyword) {
                if(sizeof($keyword->argumentos)==0)
                    $this->estado='sin_disenar';
            }

            if($this->estado=='disenada'){

                $this->estado='testeada';

                foreach ($keywords as $key => $keyword) {
                    if(sizeof($keyword->tests)==0)
                        $this->estado='disenada';
                }
            }

        }       

        $this->save();

    }

    public static function actualizarEstados(){

        $precondiciones=self::All();

        foreach ($precondiciones as $key => $precondicion) {
            $precondicion->actualizarEstado();
        }

    }

    //
}
