<?php

require_once "../modelos/Reporte_as.php";



$reporte_as= new Reporte_as();


  


require_once "vendor/autoload.php";
require "inf.php";
use PhpOffice\PhpSpreadsheet\IOFactory;
set_time_limit(0);


$fecha_evento = isset($_POST["fecha_evento"]) ? limpiarCadena($_POST["fecha_evento"]) : "";
$hora_evento = isset($_POST["hora_evento"]) ? limpiarCadena($_POST["hora_evento"]) : "";
$uas = isset($_POST["uas"]) ? limpiarCadena($_POST["uas"]) : "";
$lugar_evento = isset($_POST["lugar_evento"]) ? limpiarCadena($_POST["lugar_evento"]) : "";
$lugar_r = isset($_POST["lugar_r"]) ? limpiarCadena($_POST["lugar_r"]) : "";
$descripcion = isset($_POST["descripcion"]) ? limpiarCadena($_POST["descripcion"]) : "";
$hc_paciente = isset($_POST["hc_paciente"]) ? limpiarCadena($_POST["hc_paciente"]) : "";
$nombre_reporta = isset($_POST["nombre_reporta"]) ? limpiarCadena($_POST["nombre_reporta"]) : "";


switch ($_GET["op"]) {
    case 'guardaryeditar':
        
        if($nombre_reporta==''){
            $nombre_reporta='No registra';
                      $rspta = $reporte_as->insertar($fecha_evento,
                                                   $hora_evento,
                                                   $uas,
                                                   $lugar_evento,
                                                   $lugar_r,
                                                   $descripcion,
                                                   $hc_paciente,
                                                   $nombre_reporta);
                    echo $rspta ? "r1" : "r2";
                  }else{
                     $rspta = $reporte_as->insertar($fecha_evento,
                                                   $hora_evento,
                                                   $uas,
                                                   $lugar_evento,
                                                   $lugar_r,
                                                   $descripcion,
                                                   $hc_paciente,
                                                   $nombre_reporta);
                    echo $rspta ? "r1" : "r2";
 
                  }
                                  

        break;

    

    case 'listar_as':
        $rspta = $reporte_as->listar_as($sede);
      //$rspta = $reporte_as->listar_as();
        //declaramos un array
        $data = Array();


        while ($reg = $rspta->fetch_object()) {
            


            $data[] = array(
                "0" => $reg->fecha_as,
                "1" => $reg->fecha_ev_as,
                "2" => $reg->hora_ev_as,
                "3" => $reg->sede,
                "4" => $reg->lugar_evento,
                "5" => $reg->relacion,
                "6" => $reg->descripcion_as,
                "7" => $reg->hc_paciente,
                "8" => $reg->nombre_re
             
            );
        }

        $results = array(
            "sEcho" => 1, //info para datatables
            "iTotalRecords" => count($data), //enviamos el total de registros al datatable
            "iTotalDisplayRecords" => count($data), //enviamos el total de registros a visualizar
            "aaData" => $data);
        echo json_encode($results);

        break;
        
      
       
}
?>