<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Precondicion extends Model
{

	protected $variable;
	protected $objeto;
	protected $ruta;
	protected $descripcion;

	function __construct( $attributes = array())
    {
        parent::__construct($attributes);

        $this->variable = "";
        $this->objeto = "";
        $this->ruta = "";
        $this->descripcion = "";

    }

    public function getVariable(){
    	return $this->variable;
    }

    public function setVariable($variable){
    	$this->variable=$variable;    	
    }

    public function getObjeto(){
    	return $this->objeto;
    }

    public function setObjeto($objeto){
    	$this->objeto=$objeto;    	
    }

    public function getRuta(){
    	return $this->ruta;
    }

    public function setRuta($ruta){
    	$this->ruta=$ruta;    	
    }

    public function getDescripcion(){
    	return $this->descripcion;
    }

    public function setDescripcion($descripcion){
    	$this->descripcion=$descripcion;    	
    }


    //
}
