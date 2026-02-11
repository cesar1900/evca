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

 ?>
