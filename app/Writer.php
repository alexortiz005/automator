<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Excel;
use App\Precondicion;
use App\Asercion;

class Writer extends Model
{

	public function generarExcel($modulo,$escenarios,$precondiciones,$aserciones){       
        

        return Excel::create('Control de Implementación CXP '.$modulo->nombre, function($excel) use ($modulo,$escenarios,$precondiciones,$aserciones) {

        	

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Control de Implementación CXP '.$modulo->nombre);
            $excel->setCreator("Alex")->setCompany('HTS');
            $excel->setDescription('Control de implementacion');


           
            $excel->sheet('Precondiciones', function($sheet) use ($escenarios,$precondiciones) {

                $maxNumber=sizeof($precondiciones);  

                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Calibri',
                        'size'      =>  12,
                        )
                ));
                      

                //$sheet->fromArray($egresadosArray, null, 'A1', false, false);
                $sheet->setBorder('A1:S'.$maxNumber, 'thin');
                $sheet->freezeFirstRow();

                $sheet->row(1, function($row) {
                	dd(get_class_methods($row));

                    $row->setAlignment('center');                    
                    $row->setFontWeight('bold');
                    $row->setBackground('#AAAAAA');
                    $row->setFontFamily('Calibri');
                    $row->setFontSize(14);

                });

                

               

                $sheet->setOrientation('landscape');
            });

            



        });      
    }

	
}
