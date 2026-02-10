<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Usuario{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar registro de un empleado (jefe de area) 
public function insertar($cedula,$nombre,$apellidos,$login, $password,$tipousuario,$email,$celular,$sede, $iddepartamento,$imagen){
	
	$sql="INSERT INTO empleados (cedula, nombre, apellidos, login, password,tipousuario, email, celular, sede, departamento,imagen) VALUES ('$cedula','$nombre','$apellidos','$login','$password','$tipousuario','$email','$celular','$sede','$iddepartamento','$imagen')";
	return ejecutarConsulta($sql);
}
// metodo actualizar empleado (jefe de area) 
public function editar($idempleado,$cedula,$nombre,$apellidos, $email,$celular,$sede, $iddepartamento){
	$sql="UPDATE empleados SET cedula='$cedula',nombre='$nombre',apellidos='$apellidos',email='$email',celular='$celular',sede='$sede',departamento='$iddepartamento'    
	WHERE idempleado='$idempleado'";
	 return ejecutarConsulta($sql);
}

//metodo insertar registro de un usuario radicador  
public function insertar_r($cedula,$nombre,$apellidos,$login,$idtipousuario, $email, $password,$celular,$sede,$imagen){
	
	$sql="INSERT INTO usuarios (cedula, nombre, apellidos, login,idtipousuario, email,password,  celular, sede,imagen) VALUES ('$cedula','$nombre','$apellidos','$login','$idtipousuario','$email','$password','$celular','$sede','$imagen')";
	return ejecutarConsulta($sql);
}
// metodo actualizar usuario radicador  
public function editar_r($idusuario,$cedula,$nombre,$apellidos, $email,$celular,$sede){
	$sql="UPDATE usuarios SET cedula='$cedula',nombre='$nombre',apellidos='$apellidos',email='$email',celular='$celular',sede='$sede'  
	WHERE idusuario='$idusuario'";
	 return ejecutarConsulta($sql);
}

public function editar_clave($clavehash){
    $idempleado=  $_SESSION['idempleado'];
	$sql="UPDATE empleados SET password='$clavehash' WHERE idempleado='$idempleado'";
	return ejecutarConsulta($sql);
}

public function editar_clave_r($clavehash){
    $idusuario=  $_SESSION['idusuario'];
	$sql="UPDATE usuarios SET password='$clavehash' WHERE idusuario='$idusuario'";
	return ejecutarConsulta($sql);
}

public function mostrar_clave($idusuario){
	$sql="SELECT idusuario, password FROM usuarios WHERE idusuario='$idusuario'";
	return ejecutarConsultaSimpleFila($sql);
}
public function desactivar($idempleado){
	$sql="DELETE FROM empleados   WHERE idempleado='$idempleado'";
	return ejecutarConsulta($sql);
}

public function desactivar_r($idusuario){
	$sql="DELETE FROM usuarios   WHERE idusuario='$idusuario'";
	return ejecutarConsulta($sql);
}

public function activar($idusuario){
	$sql="UPDATE usuarios SET estado='1' WHERE idusuario='$idusuario'";
	return ejecutarConsulta($sql);
}

//metodo para mostrar registros
public function mostrar($idempleado){
	$sql="SELECT * FROM empleados WHERE idempleado='$idempleado'";
	return ejecutarConsultaSimpleFila($sql);
}

//metodo para mostrar registros
public function mostrar_r($idusuario){
	$sql="SELECT * FROM usuarios WHERE idusuario='$idusuario'";
	return ejecutarConsultaSimpleFila($sql);
}
//listar registros
public function listar(){
	$sql="SELECT * FROM usuarios";
	return ejecutarConsulta($sql);
}

//listar registros
public function listar_r(){
     $idusuario=  $_SESSION['idusuario'];
	$sql="SELECT * FROM usuarios WHERE idusuario='$idusuario'";
	return ejecutarConsulta($sql);
}

//listar registros
public function listar_e(){
        $sede=$_SESSION['sede'];
	$sql="SELECT * FROM empleados WHERE sede='$sede'";
        return ejecutarConsulta($sql);
}

//listar registros
public function listar_e_i(){
        
	$sql="SELECT * FROM empleados";
        return ejecutarConsulta($sql);
}


//listar registros
public function listar_u(){
  $idempleado=  $_SESSION['idempleado'];
	$sql="SELECT * FROM empleados WHERE idempleado='$idempleado'";
        return ejecutarConsulta($sql);
}


 //verifica que el empleado origen pertenesca al departamento origen seleccionado 
public function ed($empleado_o,$departamento_o){
        $empleado_datos = explode(" ", $empleado_o);
        $n= $empleado_datos[0];  
       $a= $empleado_datos[1]; 
	$sql="SELECT * FROM empleados WHERE departamento='$departamento_o' AND nombre='$n' AND apellidos='$a'";
      // $sql="SELECT * FROM empleados WHERE departamento='$departamento_o' ";
        return ejecutarConsulta($sql);
}

 //verifica que el empleado origen pertenesca al departamento origen seleccionado 
public function ed_destino($empleado_d,$departamento_d,$sede_destino){
        $empleado_datos = explode(" ", $empleado_d);
        $n= $empleado_datos[0];  
       $a= $empleado_datos[1]; 
	$sql="SELECT * FROM empleados WHERE departamento='$departamento_d' AND nombre='$n' AND apellidos='$a'  AND sede='$sede_destino'";
      // $sql="SELECT * FROM empleados WHERE departamento='$departamento_o' ";
        return ejecutarConsulta($sql);
}
public function cantidad_usuario(){
	$sql="SELECT count(*) cedula FROM usuarios";
	return ejecutarConsulta($sql);
}

public function cantidad_usuario_e(){
	$sql="SELECT count(*) nombre FROM empleados";
	return ejecutarConsulta($sql);
}

public function numero_radicado(){
	$sql="SELECT numero_radicado  FROM numeroradicado";
	return ejecutarConsulta($sql);
}
public function numero_radicado_aumentar($num){
	$sql="UPDATE numeroradicado SET numero_radicado='$num' WHERE idradicado=1";
	return ejecutarConsulta($sql);
}

//Función para verificar el acceso al sistema
	public function verificar($login,$clave)
    {
    	$sql="SELECT u.idusuario,u.nombre,u.apellidos,u.login,u.imagen,u.idtipousuario,u.sede,u.email,u.celular,u.area, tu.nombre as tipousuario FROM usuarios u INNER JOIN tipousuario tu ON u.idtipousuario=tu.idtipousuario WHERE login='$login' AND password='$clave' "; 
    	return ejecutarConsulta($sql);  
    }
    
    //Función para verificar el acceso al sistema
	public function verificar_e($login,$clave)
    {
    	$sql="SELECT *  FROM empleados  WHERE login='$login' AND password='$clave' "; 
    	return ejecutarConsulta($sql);  
    }
    
    //listar registros sede destino 
public function listar_sede_destino(){
	$sql="SELECT * FROM sede_destino";
        return ejecutarConsulta($sql);
}
}

 ?>
