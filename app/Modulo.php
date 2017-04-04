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

    public function flujos(){
        $flujos=[];
        $escenarios=$this->escenarios;
        foreach ($escenarios as $key => $escenario) {
            if(!is_null($escenario->flujo))
                $flujos[]=$escenario->flujo;
        }
        return $flujos;
    }

    public function testsPrecondiciones(){

        $tests=[];

        $precondiciones_testeadas = $this->precondiciones()->where('precondiciones.estado','testeada')->get();

        foreach ($precondiciones_testeadas as $precondicion) {
            foreach ($precondicion->keywords as $keyword) {
                foreach ($keyword->tests as $test) {
                    if(sizeof($test->argumentos)>0)
                        $tests[]=$test;
                }
            }
        }

        return $tests;
      
    }

    public function testsAserciones(){

        $tests=[];

        $aserciones_testeadas = $this->aserciones()->where('aserciones.estado','testeada')->get();

        foreach ($aserciones_testeadas as $asercion) {
            foreach ($asercion->keywords as $keyword) {
                foreach ($keyword->tests as $test) {
                    if(sizeof($test->argumentos)>0)
                        $tests[]=$test;
                }
            }
        }

        return $tests;
      
    }

    public function infoPrecondiciones()
    {
        $result="";
        $precondiciones_testeadas=$this->precondiciones()->where('precondiciones.estado','testeada')->get();
        $precondiciones_disenadas=$this->precondiciones()->where('precondiciones.estado','disenada')->get();
        $precondiciones_sin_asignar=$this->precondiciones()->where('precondiciones.estado','sin_asignar')->get();
        $precondiciones_sin_disenar=$this->precondiciones()->where('precondiciones.estado','sin_disenar')->get();
        $result.='Testeadas: '.sizeof($precondiciones_testeadas);
        $result.=PHP_EOL;
        $result.='Diseñadas: '.sizeof($precondiciones_disenadas);
        $result.=PHP_EOL;
        $result.='Sin asignar: '.sizeof($precondiciones_sin_asignar);
        $result.=PHP_EOL;
        $result.='Sin diseñar: '.sizeof($precondiciones_sin_disenar);
        $result.=PHP_EOL;

        return $result;

    }

    public function infoAserciones()
    {
        $result="";
        $aserciones_testeadas=$this->aserciones()->where('aserciones.estado','testeada')->get();
        $aserciones_disenadas=$this->aserciones()->where('aserciones.estado','disenada')->get();
        $aserciones_sin_asignar=$this->aserciones()->where('aserciones.estado','sin_asignar')->get();
        $aserciones_sin_disenar=$this->aserciones()->where('aserciones.estado','sin_disenar')->get();
        $result.='Testeadas: '.sizeof($aserciones_testeadas);
        $result.=PHP_EOL;
        $result.='Diseñadas: '.sizeof($aserciones_disenadas);
        $result.=PHP_EOL;
        $result.='Sin asignar: '.sizeof($aserciones_sin_asignar);
        $result.=PHP_EOL;
        $result.='Sin diseñar: '.sizeof($aserciones_sin_disenar);
        $result.=PHP_EOL;

        return $result;

    }

    public function formatedTestPrecondiciones(){
        $tests=$this->testsPrecondiciones();
        $result="";

        foreach ($tests as $key => $test) {
            $result.=$test->nombre;
            $result.=PHP_EOL;

            if($test->tipo=='exitoso'){
                $result.="    \${estatus}=    Run Keyword And Return Status    ".$test->keyword->nombre;
                foreach($test->argumentos as $argumento) {
                    $result.="    ".$argumento->nombre;
                }
                $result.=PHP_EOL;
                $result.="    should be true    '\${estatus}'=='True'";

            }else{
                $result.="    \${estatus}=    Run Keyword And Return Status    ".$test->keyword->nombre;
                foreach($test->argumentos as $argumento) {
                    $result.="    ".$argumento->nombre;
                }
                $result.=PHP_EOL;
                $result.="    should be true    '\${estatus}'=='False'";
            }
            $result.=PHP_EOL;    
            $result.=PHP_EOL;               
        
        }

        return $result;
    }

     public function formatedTestAserciones(){
        $tests=$this->testsAserciones();
        $result="";

        foreach ($tests as $key => $test) {
            $result.=$test->nombre;
            $result.=PHP_EOL;

            if($test->tipo=='exitoso'){
                $result.="    \${estatus}=    Run Keyword And Return Status    ".$test->keyword->nombre;
                foreach($test->argumentos as $argumento) {
                    $result.="    ".$argumento->nombre;
                }
                $result.=PHP_EOL;
                $result.="    should be true    '\${estatus}'=='True'";

            }else{
                $result.="    \${estatus}=    Run Keyword And Return Status    ".$test->keyword->nombre;
                foreach($test->argumentos as $argumento) {
                    $result.="    ".$argumento->nombre;
                }
                $result.=PHP_EOL;
                $result.="    should be true    '\${estatus}'=='False'";
            }
            $result.=PHP_EOL;    
            $result.=PHP_EOL;               
        
        }

        return $result;
    }

    
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
