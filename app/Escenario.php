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

     public function orquestarAserciones(){


        $aserciones_testeadas = $this->aserciones()->where('aserciones.estado','testeada')->get();
        $aserciones_disenadas = $this->aserciones()->where('aserciones.estado','disenada')->get();


        $argumentos_aserciones=[];

        foreach ($aserciones_disenadas as $asercion) {
            $keywords=$asercion->keywords;
            foreach ($keywords as $keyword) {
                $argumentos=$keyword->argumentos;
                foreach ($argumentos as $key => $argumento) {
                    $argumentos_aserciones[]=$argumento->nombre;
                    
                }           
            }
        }

        foreach ($aserciones_testeadas as $asercion) {
            $keywords=$asercion->keywords;
            foreach ($keywords as $keyword) {
                $argumentos=$keyword->argumentos;
                foreach ($argumentos as $key => $argumento) {
                    $argumentos_aserciones[]=$argumento->nombre;
                    
                }           
            }
        }

        $argumentos_aserciones=array_unique($argumentos_aserciones); 

        $result="";
        $result.="AsercionesEscenario Test ".$this->numero;
        $result.=PHP_EOL;

        $result.="    [Arguments]";
        foreach ($argumentos_aserciones as $argumento) {
            $result.='    ${'.$argumento.'}';
        }
        $result.=PHP_EOL;

        foreach ($aserciones_testeadas as $asercion) {
            foreach ($asercion->keywords as $keyword) {
                $result.='    '.$keyword->nombre;
                foreach ($keyword->argumentos as $argumento) {
                    $result.='    ${'.$argumento->nombre.'}';
                } 
                $result.=PHP_EOL;                
            }
          
        }

        foreach ($aserciones_disenadas as $asercion) {
            foreach ($asercion->keywords as $keyword) {
                $result.='    '.$keyword->nombre;
                foreach ($keyword->argumentos as $argumento) {
                    $result.='    ${'.$argumento->nombre.'}';
                } 
                $result.=PHP_EOL;                
            }
                      
        }


        return $result;

    }

    public function orquestarPrecondiciones(){


        $precondiciones_testeadas = $this->precondiciones()->where('precondiciones.estado','testeada')->get();
        $precondiciones_disenadas = $this->precondiciones()->where('precondiciones.estado','disenada')->get();


        $argumentos_precondiciones=[];

        foreach ($precondiciones_disenadas as $precondicion) {
            $keywords=$precondicion->keywords;
            foreach ($keywords as $keyword) {
                $argumentos=$keyword->argumentos;
                foreach ($argumentos as $key => $argumento) {
                    $argumentos_precondiciones[]=$argumento->nombre;
                    
                }           
            }
        }

        foreach ($precondiciones_testeadas as $precondicion) {
            $keywords=$precondicion->keywords;
            foreach ($keywords as $keyword) {
                $argumentos=$keyword->argumentos;
                foreach ($argumentos as $key => $argumento) {
                    $argumentos_precondiciones[]=$argumento->nombre;
                    
                }           
            }
        }

        $argumentos_precondiciones=array_unique($argumentos_precondiciones); 

        $result="";
        $result.="PrecondicionesEscenario Test ".$this->numero;
        $result.=PHP_EOL;

        $result.="    [Arguments]";
        foreach ($argumentos_precondiciones as $argumento) {
            $result.='    ${'.$argumento.'}';
        }
        $result.=PHP_EOL;

        foreach ($precondiciones_testeadas as $precondicion) {
            foreach ($precondicion->keywords as $keyword) {
                $result.='    '.$keyword->nombre;
                foreach ($keyword->argumentos as $argumento) {
                    $result.='    ${'.$argumento->nombre.'}';
                } 
                $result.=PHP_EOL;                
            }
         
        }

        foreach ($precondiciones_disenadas as $precondicion) {
            foreach ($precondicion->keywords as $keyword) {
                $result.='    '.$keyword->nombre;
                foreach ($keyword->argumentos as $argumento) {
                    $result.='    ${'.$argumento->nombre.'}';
                }  
                $result.=PHP_EOL;               
            }
     

        }


        return $result;

    }

    public function orquestarTestUnitariosAserciones(){

        $aserciones_testeadas = $this->aserciones()->where('aserciones.estado','testeada')->get();
        $aserciones_disenadas = $this->aserciones()->where('aserciones.estado','disenada')->get();

        $result="";

        foreach($aserciones_testeadas as $asercion){        
            foreach($asercion->keywords as $keyword){
                foreach($keyword->tests as $test){

                    $result.=$test->nombre;
                    $result.=PHP_EOL;

                    if($test->tipo=='exitoso'){
                        $result.="    \${estatus}=    Run Keyword And Return Status    ".$keyword->nombre;
                        foreach($test->argumentos as $argumento){    
                            $result.='    '.$argumento->nombre;
                        }
                        $result.=PHP_EOL;                           
                        $result.="    should be true    '\${estatus}'=='True'";
                        $result.=PHP_EOL.PHP_EOL;   
                    }else{


                        $result.="    \${estatus}=    Run Keyword And Return Status    ".$keyword->nombre;
                        foreach($test->argumentos as $argumento){
                            $result.='    '.$argumento->nombre;
                        }
                        $result.=PHP_EOL;                        
                        $result.= "    should be true    '\${estatus}'=='False'";
                        $result.=PHP_EOL.PHP_EOL;   
                    
                    }
                }
            }        
        }

        return $result;
    }
    
    public function orquestarTestUnitariosPrecondiciones(){

        $precondiciones_testeadas = $this->precondiciones()->where('precondiciones.estado','testeada')->get();
        $precondiciones_disenadas = $this->precondiciones()->where('precondiciones.estado','disenada')->get();

        $result="";

        foreach($precondiciones_testeadas as $precondicion){        
            foreach($precondicion->keywords as $keyword){
                foreach($keyword->tests as $test){

                    $result.=$test->nombre;
                    $result.=PHP_EOL;

                    if($test->tipo=='exitoso'){
                        $result.="    \${estatus}=    Run Keyword And Return Status    ".$keyword->nombre;
                        foreach($test->argumentos as $argumento){    
                            $result.='    '.$argumento->nombre;
                        }
                        $result.=PHP_EOL;                           
                        $result.="    should be true    '\${estatus}'=='True'";
                        $result.=PHP_EOL.PHP_EOL;   
                    }else{


                        $result.="    \${estatus}=    Run Keyword And Return Status    ".$keyword->nombre;
                        foreach($test->argumentos as $argumento){
                            $result.='    '.$argumento->nombre;
                        }
                        $result.=PHP_EOL;                        
                        $result.= "    should be true    '\${estatus}'=='False'";
                        $result.=PHP_EOL.PHP_EOL;   
                    
                    }
                }
            }        
        }

        return $result;
    }
	

    //
}
