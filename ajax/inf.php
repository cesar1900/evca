<?php
require __DIR__ . "/vendor/autoload.php";
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
     
  
  function info_c($datos) {
$documento = new Spreadsheet();
$documento
    ->getProperties()
    ->setCreator("Aquí va el creador, como cadena")
    ->setLastModifiedBy('Parzibyte') // última vez modificado por
    ->setTitle('Mi primer documento creado con PhpSpreadSheet')
    ->setSubject('El asunto')
    ->setDescription('Este documento fue generado para parzibyte.me')
    ->setKeywords('etiquetas o palabras clave separadas por espacios')
    ->setCategory('La categoría');
  
 $contador=1;
 $contador2=1;
 $n="inform";
  $hoja = $documento->getActiveSheet();
  $hoja->setTitle($n);


 foreach ($datos as $d) {
  if($d==";"){
      $contador2=$contador2+1;
      $contador=1;
  }else{
       $hoja->setCellValueByColumnAndRow($contador, $contador2, $d);
       $contador=$contador+1;
  }
   
   
    
      
      
 }
 
$writer = new Xlsx($documento);

# Le pasamos la ruta de guardado

$writer->save("../archivos/informe_general/X.xlsx");
  }
  
    function info_e($datos) {
$documento = new Spreadsheet();
$documento
    ->getProperties()
    ->setCreator("Aquí va el creador, como cadena")
    ->setLastModifiedBy('Parzibyte') // última vez modificado por
    ->setTitle('Mi primer documento creado con PhpSpreadSheet')
    ->setSubject('El asunto')
    ->setDescription('Este documento fue generado para parzibyte.me')
    ->setKeywords('etiquetas o palabras clave separadas por espacios')
    ->setCategory('La categoría');
  
 $contador=1;
 $contador2=1;
 $n="informe";
  $hoja = $documento->getActiveSheet();
  $hoja->setTitle($n);


 foreach ($datos as $d) {
 
       $hoja->setCellValueByColumnAndRow(1, $contador, $d);
       $contador=$contador+1;
  
   
   
    
      
      
 }
 
$writer = new Xlsx($documento);

# Le pasamos la ruta de guardado

$writer->save("../archivos/informe_general/ojo.xlsx");
  }
  
  
  