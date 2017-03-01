<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
	protected $table = 'keywords';

	public function aserciones(){

		return $this->belongsToMany('App\Asercion', 'asercion_keyword');

	}

	public function precondiciones(){

		return $this->belongsToMany('App\Precondicion', 'precondicion_keyword');

	}
    //
}
