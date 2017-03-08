<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flujo extends Model
{

	protected $table = 'flujos';

	protected $fillable = ['escenario_id','flujo_crudo','flujo_procesado','estado','dataset'];

	public function escenario()
    {
        return $this->hasOne('App\Escenario');
    }

    public function argumentos(){

		return $this->belongsToMany('App\Argumento', 'flujo_argumento');

	}

	public function procesarElCrudo(){

		$flujo_crudo=trim($this->flujo_crudo);

		if(is_null($flujo_crudo)||$flujo_crudo==''){
			$this->flujo_procesado='';
			$this->dataset='';
		}else{
			dd($flujo_crudo);

		}

	}
}
