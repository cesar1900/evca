<?php

require_once "../modelos/Cargar_salida.php";
if (strlen(session_id()) < 1)
    session_start();
 require_once('../modelos/Usuario.php');
$cargar_salida= new Cargar_salida();

 $sede=$_SESSION['sede'];
 $a=$_SESSION['area'];
 

   
$codigo_producto = isset($_POST["codigo_producto"]) ? limpiarCadena($_POST["codigo_producto"]) : "";
$idpeae = isset($_POST["idpeae"]) ? limpiarCadena($_POST["idpeae"]) : "";
$nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";
$cantidad = isset($_POST["cantidad"]) ? limpiarCadena($_POST["cantidad"]) : "";
$punto = isset($_POST["punto"]) ? limpiarCadena($_POST["punto"]) : "";
$cantidad_a = isset($_POST["cantidad_a"]) ? limpiarCadena($_POST["cantidad_a"]) : "";
$area = isset($_POST["area"]) ? limpiarCadena($_POST["area"]) : "";
$lote = isset($_POST["lote"]) ? limpiarCadena($_POST["lote"]) : "";
$m_salida = isset($_POST["m_salida"]) ? limpiarCadena($_POST["m_salida"]) : "";
$cums = isset($_POST["cums"]) ? limpiarCadena($_POST["cums"]) : "";
$invima= isset($_POST["invima"]) ? limpiarCadena($_POST["invima"]) : "";
$fecha_vencimiento = isset($_POST["fecha_vencimiento"]) ? limpiarCadena($_POST["fecha_vencimiento"]) : "";
$valor_unitario = isset($_POST["valor_unitario"]) ? limpiarCadena($_POST["valor_unitario"]) : "";
$orden_medica = isset($_POST["orden_medica"]) ? limpiarCadena($_POST["orden_medica"]) : "";
$uas = isset($_POST["uas"]) ? limpiarCadena($_POST["uas"]) : "";
$observacion = isset($_POST["observacion"]) ? limpiarCadena($_POST["observacion"]) : "";
$observacionf = isset($_POST["observacionf"]) ? limpiarCadena($_POST["observacionf"]) : "";

require_once "vendor/autoload.php";
require "inf.php";
use PhpOffice\PhpSpreadsheet\IOFactory;
set_time_limit(0);
switch ($_GET["op"]) {
    case 'guardaryeditar':
        
       
        
        if ($cantidad < $cantidad_a) {
            echo "r4";
        } else if($m_salida==""){
            echo "r2";
            
        }elseif($sede==$uas){
            echo "r3";
        }else{
            $c = $cantidad - $cantidad_a;
            $cargar_salida->actualizar_producto_area_e($idpeae, $c);
           
            if ($m_salida=="facturado") {
                 $cargar_salida->salida_farmacia_f($codigo_producto, $nombre, $cantidad_a, $punto, $area, $lote, $cums, $invima, $fecha_vencimiento,$valor_unitario,$orden_medica);
    
            } else if ($m_salida=="rotacion"){
               $cargar_salida->salida_farmacia_r($codigo_producto, $nombre, $cantidad_a, $punto, $area, $lote, $cums, $invima, $fecha_vencimiento,$valor_unitario,$uas);
    
            }else if ($m_salida=="vencimiento"){
                $cargar_salida->salida_farmacia_v($codigo_producto, $nombre, $cantidad_a, $punto, $area, $lote, $cums, $invima, $fecha_vencimiento,$valor_unitario,$observacion);
    
            }else if ($m_salida=="no_facturado"){
                 $cargar_salida->salida_farmacia_nf($codigo_producto, $nombre, $cantidad_a, $punto, $area, $lote, $cums, $invima, $fecha_vencimiento,$valor_unitario,$observacionf);
    
            }else if ($m_salida==""){
                 
            }
            echo "r1";
        }









        break;

   

    case 'listar':
        $rspta = $cargar_salida->listar();
        //declaramos un array
        $data = Array();


        while ($reg = $rspta->fetch_object()) {
            
            $data[] = array(
                "0" => $reg->codigo_salida,
                "1" => $reg->codigo_producto,
                "2" => $reg->nombre,
                "3" => $reg->cantidad,
                "4" => $reg->valor_unitario,
                "5" => $reg->subtotal,
                "6" => $reg->punto_at,
                "7" => $reg->lote,
                "8" => $reg->cums,
                "9" => $reg->fecha_salida,
                "10" => $reg->fecha_vencimiento
            );
        }

        $results = array(
            "sEcho" => 1, //info para datatables
            "iTotalRecords" => count($data), //enviamos el total de registros al datatable
            "iTotalDisplayRecords" => count($data), //enviamos el total de registros a visualizar
            "aaData" => $data);
        echo json_encode($results);

        break;
        
        
        case 'listar_p':
        $rspta = $cargar_salida->listar_p($sede);
        //declaramos un array
        $data = Array();


        while ($reg = $rspta->fetch_object()) {
            
            $data[] = array(
                "0" => $reg->codigo_salida,
                "1" => $reg->codigo_producto,
                "2" => $reg->nombre,
                "3" => $reg->cantidad,
                "4" => $reg->valor_unitario,
                "5" => $reg->subtotal,
                "6" => $reg->punto_at,
                "7" => $reg->lote,
                "8" => $reg->cums,
                "9" => $reg->fecha_salida,
                "10" => $reg->fecha_vencimiento
            );
        }

        $results = array(
            "sEcho" => 1, //info para datatables
            "iTotalRecords" => count($data), //enviamos el total de registros al datatable
            "iTotalDisplayRecords" => count($data), //enviamos el total de registros a visualizar
            "aaData" => $data);
        echo json_encode($results);

        break;
        
         case 'listar_ap':
        $rspta = $cargar_salida->listar_ap($sede);
        //declaramos un array
        $data = Array();


        while ($reg = $rspta->fetch_object()) {
            
            $data[] = array(
                "0" => '<button class="btn btn-warning btn-xs" onclick="mostrar(' . $reg->idpbp . ')"><i class="fa fa-pencil"></i></button>',
                "1" => $reg->codigo_producto,
                "2" => $reg->nombre,
                "3" => $reg->cantidad,
                "4" => $reg->punto,
                "5" => $reg->lote,
                "6" => $reg->cums,
                "7" => $reg->invima,
                "8" => $reg->meses_vencimiento,
                "9" => $reg->fecha_vencimiento
            );
        }

        $results = array(
            "sEcho" => 1, //info para datatables
            "iTotalRecords" => count($data), //enviamos el total de registros al datatable
            "iTotalDisplayRecords" => count($data), //enviamos el total de registros a visualizar
            "aaData" => $data);
        echo json_encode($results);

        break;
        
        case 'mostrar_area_e':
        $rspta = $cargar_salida->mostrar_area_e($idpeae);
        echo json_encode($rspta);
        break;
case 'listar_area_e':
        $rspta = $cargar_salida->listar_area_e($sede,$a);
        //declaramos un array
        $data = Array();


        while ($reg = $rspta->fetch_object()) {
            if($reg->fecha_vencimiento!=""){
            $hoy_str = Date("d/m/Y H:i");
                            $hoy = DateTime::createFromFormat('d/m/Y H:i', $hoy_str);
                            $fecha = DateTime::createFromFormat('d/m/Y H:i', $reg->fecha_vencimiento);

                           // Calcula la diferencia en meses
                            $diferencia = $hoy->diff($fecha);

                          // Obtiene el total de meses
                            $total_meses = $diferencia->y * 12 + $diferencia->m;//no debe ir se debe calcular al momento de listar el articulo
        }else{
            $total_meses="No_aplica_vencimiento";
        }
        if($total_meses<7 && $total_meses!="No_aplica_vencimiento"){  
                $r = '<button class="btn btn-danger btn-xs""><i class="fa fa-battery-0"></i></button>'.' por_vencer' ;
            }else if($total_meses<13 && $total_meses>6){
                $r = '<button class="btn btn-warning btn-xs""><i class="fa fa-battery-2"></i></button>'.' vencimiento_amarillo' ;
            }else if($total_meses>12){
                $r = '<button class="btn btn-success btn-xs""><i class="fa fa-battery-4"></i></button>'.' vencimiento_verde' ;
            }else if($total_meses===0){
                $r = '<button class="btn btn-danger btn-xs""><i class="fa fa-battery-0"></i></button>'.' articulo_vencido' ;
            }else if($total_meses==="No_aplica_vencimiento"){
                $r=$total_meses;
            }
            $data[] = array(
                "0" => '<button class="btn btn-warning btn-xs" onclick="mostrar(' . $reg->idpeae . ')"><i class="fa fa-pencil"></i></button>',
                "1" => $reg->codigo_producto,
                "2" => $r,
                "3" => $reg->nombre,
                "4" => $reg->cantidad,
                "5" => $reg->punto,
                "6" => $reg->area,
                "7" => $reg->lote,
                "8" => $reg->cums,
                "9" => $reg->invima,
                "10" => $total_meses,
                "11" => $reg->fecha_vencimiento,
                "12" => $reg->valor_unitario,
                "13" => $reg->tipo
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