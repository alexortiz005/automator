<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Precondicion;
use App\Asercion;

class Reader extends Model
{

	protected $file;

	function __construct($file, $attributes = array())
    {
        parent::__construct($attributes);

        $this->file = $file;
    }


	public function getTables(){

		$phpWord = \PhpOffice\PhpWord\IOFactory::load($this->file);			

		$sections = $phpWord->getSections();
		$precondicionesIndex= 0;
		$tables= array();

        foreach ($sections as $section) {

            $elements= $section->getElements();

            foreach ($elements as $elementIndex => $element) 
			    if(is_a($element, "PhpOffice\PhpWord\Element\Table"))
			    	$tables[]=$element;

        }	

        return $tables;

	}

	public function dumpFile(){

		$phpWord = \PhpOffice\PhpWord\IOFactory::load($this->file);			

		$sections = $phpWord->getSections();

		foreach ($sections as $section) {

            $elements= $section->getElements();

            foreach ($elements as $elementIndex => $element) 
			    self::dumpElement($element);

        }	

	}

	public static  function dumpElement($element){

		$flag=true;

		if(is_a($element, "PhpOffice\PhpWord\Element\TextBreak"))
			return;

		if(is_a($element, "PhpOffice\PhpWord\Element\PageBreak"))
			return;

		

		if(method_exists($element,'getText')) {
			var_dump($element->getText());
			echo "<br>";
			if(!(is_null($element->getText())))
				$flag=false;
		}

		if(method_exists($element,'getElements')) {

			$innerElements=$element->getElements();

			foreach ($innerElements as $key => $innerElement) {
				self::dumpElement($innerElement);		
			}

			$flag=false;

		}

		if(method_exists($element,'getRows')) {

			$innerElements=$element->getRows();

			foreach ($innerElements as $key => $innerElement) {
				self::dumpElement($innerElement);		
			}

			$flag=false;

		}

		if(method_exists($element,'getCells')) {

			$innerElements=$element->getCells();

			foreach ($innerElements as $key => $innerElement) {
				self::dumpElement($innerElement);		
			}

			$flag=false;

		}

		if($flag){
			var_dump(get_class($element));
			echo "<br>";
		}

	}


	public function extraerPrecondiciones(){	

		$precondiciones=array();

		$tables=$this->getTables();    

		$table=$tables[2];        

		$rows=$table->getRows();

		$rowCount=0;

    	foreach ($rows as $rowIndex => $row) {

    		if($rowCount>0){

    			$precondicion= new Precondicion();

    			$cells = $row->getCells();

	    		$cellCount=0;

	    		foreach ($cells as $cellIndex => $cell) {

	    			$descripcion="";	    			

	    			$cellElements=$cell->getElements();	    			

	    			foreach ($cellElements as $cellElementIndex => $cellElement) {

	    				

	    				if(method_exists($cellElement,'getText')) {

		    				if($cellCount==0)
		    					$precondicion->setVariable($cellElement->getText());
		    				if($cellCount==1)
		    					$precondicion->setObjeto($cellElement->getText());
		    				if($cellCount==2)
		    					$precondicion->setRuta($cellElement->getText());
				        	
				        	
				        }else{
				        	if(method_exists($cellElement,'getElements')){

				        		

				        		$innerCellElements=$cellElement->getElements();

					        	foreach ($innerCellElements as $innerCellElementIndex => $innerCellElement) {
					        		if(method_exists($innerCellElement,'getText')) {							        	

							        	if($innerCellElement->getText()!=null){
							        		$descripcion=$descripcion.$innerCellElement->getText();
							        		$descripcion.="<br>";					        		
							        	
							        	}
							        	
							        }
					        	}

					        	

				        	}							        	
				        }

				        
	    			}

	    			$precondicion->setDescripcion($descripcion);


	    			$cellCount++;
	    		}

	    		$precondiciones[]=$precondicion;
    		}

    		$rowCount++;
    	}

    	return $precondiciones; 
			   
	}

	public function extraerAserciones(){	

		$aserciones=array();

		$tables=$this->getTables();    

		$table=$tables[3];        

		$rows=$table->getRows();

		$rowCount=0;

    	foreach ($rows as $rowIndex => $row) {

    		if($rowCount>0){

    			$asercion= new Asercion();

    			$cells = $row->getCells();

	    		$cellCount=0;

	    		foreach ($cells as $cellIndex => $cell) {

	    			$descripcion="";	    			

	    			$cellElements=$cell->getElements();	    			

	    			foreach ($cellElements as $cellElementIndex => $cellElement) {

	    				

	    				if(method_exists($cellElement,'getText')) {

		    				if($cellCount==0)
		    					$asercion->setVariable($cellElement->getText());
		    				if($cellCount==1)
		    					$asercion->setObjeto($cellElement->getText());
		    				if($cellCount==2)
		    					$asercion->setRuta($cellElement->getText());
				        	
				        	
				        }else{
				        	if(method_exists($cellElement,'getElements')){

				        		

				        		$innerCellElements=$cellElement->getElements();

					        	foreach ($innerCellElements as $innerCellElementIndex => $innerCellElement) {
					        		if(method_exists($innerCellElement,'getText')) {							        	

							        	if($innerCellElement->getText()!=null){
							        		$descripcion=$descripcion.$innerCellElement->getText();
							        		$descripcion.="<br>";					        		
							        	
							        	}
							        	
							        }
					        	}

					        	

				        	}							        	
				        }

				        
	    			}

	    			$asercion->setDescripcion($descripcion);


	    			$cellCount++;
	    		}

	    		$aserciones[]=$asercion;
    		}

    		$rowCount++;
    	}

    	return $aserciones; 
			   
	}



    //
}

