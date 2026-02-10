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

    case 'mostrar':
        $rspta = $recibida_i->mostrar($idrecibida_i);
        echo json_encode($rspta);
        break;

    case 'listar':
        $rspta = $cargar_entrada->listar();
        //declaramos un array
        $data = Array();


        while ($reg = $rspta->fetch_object()) {
            
            $data[] = array(
                "0" => $reg->codigo_entrada,
                "1" => $reg->codigo_producto,
                "2" => $reg->nombre,
                "3" => $reg->cantidad,
                "4" => $reg->valor_unitario,
                "5" => $reg->iva,
                "6" => $reg->subtotal,
                "7" => $reg->fecha_vencimiento,
                "8" => $reg->lote,
                "9" => $reg->cums,
                "10" => $reg->invima,
                "11" => $reg->fecha_entrada
             
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