<?php


if (strlen(session_id()) < 1)
    session_start();

 
require "../config/Conexion.php";
$dep=isset($_POST["departamento"]) ? limpiarCadena($_POST["departamento"]) : "";
 
 $sede=$_SESSION['sede'];
$sql="SELECT nombre,apellidos FROM empleados WHERE (sede='$sede' OR sede='Bordo') AND departamento='$dep'";

$respt= ejecutarConsulta($sql);
$cadena="<label>Jefe de area:</label> 
			<select id='empleado' name='empleado'class='form-control select-picker'>";


      $na="";
	  $cadena_empleados="";
        while ($reg = $respt->fetch_object()) {
            $n = $reg->nombre;
            $a = $reg->apellidos;
            $na = $n . ' ' . $a;
            $temporal='<option value="'.$na.'">' .$na. ' </option>';
			$cadena_empleados=$cadena_empleados.$temporal;
        }
        echo  $cadena.$cadena_empleados.'</select>';
        
        
         
