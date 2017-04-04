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

	public function procesarElCrudo(){

		$flujo_crudo=trim($this->flujo_crudo);
		$flagFlujoErroneo=false;

		if(is_null($flujo_crudo)||$flujo_crudo==''){
			$this->flujo_procesado='';
			$this->dataset='';
			return;
		}

		$renglones=explode(PHP_EOL, $this->flujo_crudo);

		$flujo_procesado=[];
		$dataset=[];

		foreach ($renglones as $key => $renglon) {

			$flag=true;

			if(!strpos(strtolower($renglon), 'digitar'))
				$flag=false;
			

			if(strpos($renglon, '${empty}'))
				$flag=false;
			

			if(strpos(trim($renglon), '#') === 0)
				$flag=false;
				


			if($flag){

				$renglonProcesado=$this->procesarRenglon($renglon);

				if($renglonProcesado===false){
					$flagFlujoErroneo=true;
					break;
				}

				$tokens=$renglonProcesado['tokens'];
				

				
				$campo=$renglonProcesado['campo'];
				$argumento=$renglonProcesado['argumento'];

				$i=2;
				while(array_key_exists($campo, $dataset)&&$dataset[$campo]!=$argumento){
					$campo=$renglonProcesado['campo'].$i;
					$i++;
				}

				$tokens[3]=$campo;

				$tokens[1]="\${".$tokens[3]."}";

				$contenido='    '.implode('    ',$tokens);

				$flujo_procesado[]=$contenido;

				$dataset[$campo]=$argumento;

			}else{
				$flujo_procesado[]=$renglon;				
			}
			
		}

		if($flagFlujoErroneo){
			$this->flujo_procesado='Hay errores en el formato del flujo';
			$this->dataset='';
			return;

		}


		$this->flujo_procesado=implode(PHP_EOL, $flujo_procesado);
		$this->dataset=json_encode($dataset);
		
	}

	public function procesarRenglon($renglon){

		$result=[];
		$tokens=explode('    ', trim($renglon));

		if(sizeof($tokens)!=4)
			return false;

		$result['campo']=$tokens[3];
		$result['argumento']=$tokens[1];

		$tokens[1]="\${".$tokens[3]."}";
		$result['tokens']=$tokens;

		return $result;

	}

	public function formatedDataset(){

		if($this->dataset=='')
			return '';

		$argumentosTxt=[];
		$titulosArgumentos=[];
		$datos=[];

		$dataset=json_decode($this->dataset,true);

		foreach ((array)$dataset as $campo => $data) {
			$titulosArgumentos[]=$campo;
			$argumentosTxt[]='${'.$campo.'}';
			$datos[]=$data;
		}

		$argumentosRIDE=implode('|', $argumentosTxt);
		$argumentosTxt=implode('	', $argumentosTxt);
		$titulosArgumentos=implode('	', $titulosArgumentos);
		$datos=implode('	', $datos);

		$result="-------------------------------------------";
		$result.=PHP_EOL;
		$result.=$argumentosRIDE;
		$result.=PHP_EOL;
		$result.="-------------------------------------------";
		$result.=PHP_EOL;
		$result.=$argumentosTxt;
		$result.=PHP_EOL;
		$result.=$titulosArgumentos;
		$result.=PHP_EOL;
		$result.=$datos;

		
		return $result;
	}
}
