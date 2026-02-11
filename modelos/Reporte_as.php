<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Reporte_as
{


        //implementamos nuestro constructor
        public function __construct() {}

        public function insertar($fecha_evento, $hora_evento, $uas, $lugar_evento, $lugar_r, $descripcion, $hc_paciente, $nombre_reporta)
        {


                $f = date('d/m/y');
                $sql = "INSERT INTO reporte_as (fecha_as, fecha_ev_as, hora_ev_as, sede, lugar_evento, relacion, descripcion_as, hc_paciente, nombre_re) VALUES ('$f','$fecha_evento','$hora_evento','$uas','$lugar_evento','$lugar_r','$descripcion','$hc_paciente','$nombre_reporta')";

                return ejecutarConsulta($sql);
        }



        //listar registros

        public function listar_as($sede)
        {

                // $sede=" ".$sede;
                if ($sede == 'Bordo') {
                        $sql = "SELECT * FROM reporte_as";
                } else {
                        $sql = "SELECT * FROM reporte_as WHERE sede='$sede'";
                }
                return ejecutarConsulta($sql);
        }
}
<<<<<<< HEAD
=======

public function insertar($fecha_evento, $hora_evento, $uas, $lugar_evento, $lugar_r, $descripcion, $hc_paciente, $nombre_reporta){
	
        
         $f=date('d/m/y');
	$sql="INSERT INTO reporte_as (fecha_as, fecha_ev_as, hora_ev_as, sede, lugar_evento, relacion, descripcion_as, hc_paciente, nombre_re) VALUES ('$f','$fecha_evento','$hora_evento','$uas','$lugar_evento','$lugar_r','$descripcion','$hc_paciente','$nombre_reporta')"; 
      
     return ejecutarConsulta($sql);
         
}




                    
public function consultar_cpb($codigo) {
                       
                        $sql = "SELECT * FROM producto_bodega WHERE codigo_producto='$codigo'";
                        
                        return ejecutarConsulta($sql);
                    }
                    




//listar registros
public function listar(){
	$sql="SELECT * FROM entrada_bodega_central";
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
>>>>>>> 5742965a9c5de22767d8c9fffcb69974e3027bcf
