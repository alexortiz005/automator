<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProtokeywordController extends Controller
{
	public function vistaProtokeywords(){
		$protokeywords=[];
		return view('protokeywords.vistaProtokeywords',['protokeywords'=>$protokeywords]);
	}
	

}
