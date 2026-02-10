<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Articulos_area_farmacia{


	//implementamos nuestro constructor
public function __construct(){

}


                 

public function listar_norma_medicamentos($sede){
	$sql="SELECT * FROM norma_medicamentos_f WHERE punto='$sede'";
	return ejecutarConsulta($sql);
}

public function listar_norma_medicoquirurgico($sede){
	$sql="SELECT * FROM norma_medico_q_f WHERE punto='$sede'";
   
	return ejecutarConsulta($sql);
}
public function listar_norma_laboratorio_f($sede){
	$sql="SELECT * FROM norma_laboratorio_f WHERE punto='$sede'";
   
	return ejecutarConsulta($sql);
}
public function listar_medicamentos_farmacia($sede,$area){
	$sql="SELECT * FROM producto_entregado_area_e WHERE punto='$sede' AND area='$area' AND tipo='medicamentos'";
	return ejecutarConsulta($sql);
}

public function listar_medicoquirurgico_farmacia($sede,$area){
	$sql="SELECT * FROM producto_entregado_area_e WHERE punto='$sede' AND area='$area' AND tipo='medico_quirurgico_farmacia'";
	return ejecutarConsulta($sql);
}

public function listar_laboratorio_farmacia($sede,$area){
	$sql="SELECT * FROM producto_entregado_area_e WHERE punto='$sede' AND area='$area' AND tipo='materiales_reactivos_laboratorio'";
	return ejecutarConsulta($sql);
}
public function mostrar_area_e($idpeae){
	$sql="SELECT * FROM producto_entregado_area_e WHERE idpeae='$idpeae'";
   
	return ejecutarConsultaSimpleFila($sql);
}

public function insertar_nmf($codigo_producto_mf, $nombre_mf, $principio_activo, $forma_farmaceutica, $concentracion, $lote_mf,$invima_mf,$fecha_vencimiento_mf,$presentacion_comercial,$unidad_medidad,$sede,$valor_mf){

 
	$sql="INSERT INTO norma_medicamentos_f (codigo_producto, nombre, principio_activo,forma_farmaceutica, concentracion, lote, fecha_vencimiento, presentacion_comercial, unidad_medida, invima, punto, valor_unitario) VALUES ('$codigo_producto_mf','$nombre_mf','$principio_activo','$forma_farmaceutica','$concentracion','$lote_mf','$fecha_vencimiento_mf','$presentacion_comercial','$unidad_medidad','$invima_mf','$sede', '$valor_mf')"; 
      
     return ejecutarConsulta($sql);
         
}

public function insertar_nmqf($codigo_producto_mqf, $nombre_mqf,$descripcion_mqf, $marca_dispositivo_mqf, $serie_mqf, $presentacion_comercial_mqf, $invima_mqf,$clasificacion_riesgo_mqf,$vida_util_mqf,$lote_mqf,$fecha_vencimiento_mqf,$sede,$valor_mqf){

  
  
	$sql="INSERT INTO norma_medico_q_f (codigo_producto, nombre, descripcion,marca_dispositivo, serie, presentacion_comercial, invima, clasificacion_riesgo, vida_util, lote, fecha_vencimiento, punto,valor_unitario) VALUES ('$codigo_producto_mqf','$nombre_mqf','$descripcion_mqf','$marca_dispositivo_mqf','$serie_mqf','$presentacion_comercial_mqf','$invima_mqf','$clasificacion_riesgo_mqf','$vida_util_mqf','$lote_mqf','$fecha_vencimiento_mqf','$sede','$valor_mqf')"; 
      
     return ejecutarConsulta($sql);
         
}

public function insertar_nlf($codigo_producto_lf, $nombre_lf, $marca_lf, $presentacion_comercial_lf, $invima_lf, $clasificacion_riesgo_lf, $vida_util_lf, $fecha_vencimiento_lf, $lote_lf,$sede,$valor_lf){

   
	$sql="INSERT INTO norma_laboratorio_f  (codigo_producto, nombre, marca,presentacion_comercial, invima, clasificacion_riesgo, vida_util, lote,fecha_vencimiento, punto,valor_unitario) VALUES ('$codigo_producto_lf','$nombre_lf','$marca_lf','$presentacion_comercial_lf','$invima_lf','$clasificacion_riesgo_lf','$vida_util_lf','$lote_lf','$fecha_vencimiento_lf','$sede','$valor_lf')"; 
      
     return ejecutarConsulta($sql);
         
}
public function consultar_nmf($codigo_producto_mf, $sede, $fecha_vencimiento_mf,$lote_mf,$invima_mf,$valor_mf) {
                       
                        $sql = "SELECT * FROM norma_medicamentos_f WHERE codigo_producto='$codigo_producto_mf' AND punto='$sede' AND lote='$lote_mf' AND fecha_vencimiento='$fecha_vencimiento_mf'AND invima='$invima_mf'AND valor_unitario='$valor_mf'";
                        
                        return ejecutarConsulta($sql);
                    }
public function consultar_nmqf($codigo_producto_mqf, $sede, $fecha_vencimiento_mqf,$lote_mqf,$invima_mqf,$valor_mqf) {
                       
                        $sql = "SELECT * FROM norma_medico_q_f WHERE codigo_producto='$codigo_producto_mqf' AND punto='$sede' AND lote='$lote_mqf' AND fecha_vencimiento='$fecha_vencimiento_mqf'AND invima='$invima_mqf'AND valor_unitario='$valor_mqf'";
                        
                        return ejecutarConsulta($sql);
                    }
 public function consultar_nlf($codigo_producto_lf, $sede, $fecha_vencimiento_lf,$lote_lf,$invima_lf,$valor_lf) {
                       
                        $sql = "SELECT * FROM norma_laboratorio_f WHERE codigo_producto='$codigo_producto_lf' AND punto='$sede' AND lote='$lote_lf' AND fecha_vencimiento='$fecha_vencimiento_lf'AND invima='$invima_lf'AND valor_unitario='$valor_lf'";
                        
                        return ejecutarConsulta($sql);
                    }
function actualizar_producto_area_e($idpeae, $c) {
                       
                        $sql = "UPDATE producto_entregado_area_e SET cantidad='$c'   WHERE idpeae='$idpeae'";
                        
                        return ejecutarConsulta($sql);
                    }
public function salida_farmacia_f($codigo_producto, $nombre, $cantidad_a, $punto, $area, $lote, $cums, $invima, $fecha_vencimiento, $valor_unitario,$area_e, $m_salida,$tipo, $orden_medica,$centro_s,$observacion,$uas){

$numeroMes = date('n'); 
$an = date('Y'); 
// Array de meses en letras 
// 
$meses = array( 1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril', 5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre' ); 
// Imprimir el mes actual en letras 
$mes = $meses[$numeroMes];
	$sql="INSERT INTO salida_farmacia (codigo_producto, nombre, cantidad,punto,area,lote,cums,invima,fecha_vencimiento,valor_unitario,area_e,m_salida,tipo,ordenmedica,centro_s,observacion_v,uas,mes,ano) VALUES ('$codigo_producto','$nombre','$cantidad_a','$punto','$area','$lote','$cums','$invima','$fecha_vencimiento','$valor_unitario','$area_e','$m_salida','$tipo','$orden_medica','$centro_s','$observacion','$uas','$mes','$an')"; 
      
     return ejecutarConsulta($sql);
         
}

public function consultar_cpcp($codigo,$punto_atencion) {
                       $ano_compra=date("Y");
                        $sql = "SELECT * FROM producto_comprado_p WHERE codigo_producto='$codigo' AND punto='$punto_atencion' AND ano_compra='$ano_compra'";
                        
                        return ejecutarConsulta($sql);
                    }
public function actualizar_pcp($idpcp,$c) {
                       
                        $sql = "UPDATE producto_comprado_p SET cantidad='$c'   WHERE idpcp='$idpcp'";
                        
                        return ejecutarConsulta($sql);
                    }
public function insertar_pcp($codigo, $nombre, $cantidad, $punto_atencion){
	
        $ano_compra=date("Y");
	$sql="INSERT INTO producto_comprado_p (codigo_producto, nombre, cantidad, punto, ano_compra) VALUES ('$codigo','$nombre','$cantidad','$punto_atencion','$ano_compra')"; 
      
     return ejecutarConsulta($sql);
         
}
public function consultar_pbp($codigo_producto, $uas,$lote,$fecha_vencimiento, $valor_unitario, $invima,$cums) {
                       
                        $sql = "SELECT * FROM producto_bodega_p WHERE codigo_producto='$codigo_producto' AND punto='$uas' AND lote='$lote' AND fecha_vencimiento='$fecha_vencimiento' AND valor_unitario='$valor_unitario' AND invima='$invima' AND cums='$cums'";
                        
                        return ejecutarConsulta($sql);
                    }
public function actualizar_pbp($idpbp,$c) {
                       
                        $sql = "UPDATE producto_bodega_p SET cantidad='$c'   WHERE idpbp='$idpbp'";
                        
                        return ejecutarConsulta($sql);
                    }
public function insertar_pbp($codigo, $nombre, $cantidad, $punto_atencion, $lote, $cums,$invima,$fecha_vencimiento,$valor_unicatio){
        
	$sql="INSERT INTO producto_bodega_p (codigo_producto, nombre, cantidad, punto, lote, cums, invima, fecha_vencimiento,valor_unitario) VALUES ('$codigo','$nombre','$cantidad','$punto_atencion','$lote','$cums','$invima','$fecha_vencimiento','$valor_unicatio')"; 
      
     return ejecutarConsulta($sql);
         
}

public function insertar_salida_rotacion($codigo_producto, $nombre, $cantidad_a, $uas, $lote, $cums, $invima, $fecha_vencimiento,$valor_unitario,$punto){
	
         $subtotal= $cantidad_a * $valor_unitario;
          $fecha_salida= date("Y-m-d H:i:s");
	$sql="INSERT INTO salida_rotacion (codigo_producto, nombre, cantidad, punto, lote, cums, invima, fecha_vencimiento, valor_unitario, subtotal, uas, fecha_salida) VALUES ('$codigo_producto','$nombre','$cantidad_a','$uas','$lote','$cums','$invima','$fecha_vencimiento','$valor_unitario', '$subtotal','$punto','$fecha_salida')"; 
      
        
     return ejecutarConsulta($sql);
         
}

public function listar_salida_medicamentos($sede){
	$sql="SELECT * FROM salida_farmacia WHERE punto='$sede' and tipo='medicamentos'";
	return ejecutarConsulta($sql);
}

public function listar_salida_medicoquirurgico($sede){
	$sql="SELECT * FROM salida_farmacia WHERE punto='$sede' AND tipo='medico_quirurgico_farmacia'";
	return ejecutarConsulta($sql);
}

public function listar_salida_reactivos_farmacia($sede){
	$sql="SELECT * FROM salida_farmacia WHERE punto='$sede' AND tipo='materiales_reactivos_laboratorio'";
	return ejecutarConsulta($sql);
}
}



 ?>
