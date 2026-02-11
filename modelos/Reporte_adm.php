<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Reporte_adm{


	//implementamos nuestro constructor
public function __construct(){

}

public function insertar($fecha_evento, $hora_evento, $uas, $lugar_evento, $lugar_r, $descripcion, $nombre_reporta){
	
       
         $f=date('d/m/y');
	$sql="INSERT INTO reporte_adm (fecha_adm, fecha_ev_adm, hora_ev_adm, sede, lugar_evento, relacion, descripcion_adm, nombre_re) VALUES ('$f','$fecha_evento','$hora_evento','$uas','$lugar_evento','$lugar_r','$descripcion','$nombre_reporta')"; 
      
     return ejecutarConsulta($sql);
         
}




                    
public function consultar_cpb($codigo) {
                       
                        $sql = "SELECT * FROM producto_bodega WHERE codigo_producto='$codigo'";
                        
                        return ejecutarConsulta($sql);
                    }
                    




//listar registros
public function listar_adm($sede){
	if ($sede == 'Bordo') {
                        $sql = "SELECT * FROM reporte_adm";
                } else {
                        $sql = "SELECT * FROM reporte_adm WHERE sede='$sede'";
                }
                return ejecutarConsulta($sql);
}





public function cantidad_recibidas_i(){
        $sede=$_SESSION['sede'];
	$sql="SELECT count(*) check_recibido FROM recibida_i WHERE check_recibido='No' AND sede_destino='$sede' ";
	return ejecutarConsulta($sql);
}

// consulta para graficas todas las sedes
public function cantidad_recibidas_i_grafias($tipo,$fecha_i,$fecha_f){
        
	$sql="SELECT count(*) respuesta FROM recibida_i WHERE tipo_tramite='$tipo' AND (fecha>='$fecha_i') AND (fecha<='$fecha_f')";
	
        return ejecutarConsulta($sql);
}
// consulta para graficas todas las sedes
public function cantidad_recibidas_i_grafias_sede($tipo,$fecha_i,$fecha_f,$sede){
        
	$sql="SELECT count(*) respuesta FROM recibida_i WHERE tipo_tramite='$tipo' AND (fecha>='$fecha_i') AND (fecha<='$fecha_f')AND (sede_radicador='$sede')";
	
        return ejecutarConsulta($sql);
}

}

 ?>
