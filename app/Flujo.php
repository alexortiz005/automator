<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flujo extends Model
{

	protected $table = 'flujos';

	public function escenario()
    {
        return $this->hasOne('App\Escenario');
    }
}
