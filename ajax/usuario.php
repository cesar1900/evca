<?php 
session_start();
require_once "../modelos/Usuario.php";

$usuario=new Usuario();


$idempleado=isset($_POST["idempleado"])? limpiarCadena($_POST["idempleado"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$apellidos=isset($_POST["apellidos"])? limpiarCadena($_POST["apellidos"]):"";
$celular=isset($_POST["celular"])? limpiarCadena($_POST["celular"]):"";
$departamento=isset($_POST["departamento"])? limpiarCadena($_POST["departamento"]):"";
$cedula=isset($_POST["cedula"])? limpiarCadena($_POST["cedula"]):"";
$email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";
$sede_destino=isset($_POST["sede_destino"])? limpiarCadena($_POST["sede_destino"]):"";
$sede=isset($_POST["sede"])? limpiarCadena($_POST["sede"]):"";
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";

$idusuario=isset($_POST["idusuario"])? limpiarCadena($_POST["idusuario"]):"";
$clavec=isset($_POST["clavec"])? limpiarCadena($_POST["clavec"]):"";

switch ($_GET["op"]) {
	case 'guardaryeditar':
        if (!file_exists($_FILES['imagen']['tmp_name'])|| !is_uploaded_file($_FILES['imagen']['tmp_name']))  
		{
			$imagen=$_POST["imagenactual"];
		}else
		{

			$ext=explode(".", $_FILES["imagen"]["name"]);
			if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png")
			 {

			   $imagen = round(microtime(true)).'.'. end($ext);
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/usuarios/" . $imagen);
		 	}
		}
		if (empty($idempleado)) {
			//Hash SHA256 para la contraseña
		        $password=hash("SHA256", $cedula);
                        $login= $cedula;
                        $tipousuario='Empleado';
			$rspta=$usuario->insertar($cedula,$nombre,$apellidos,$login,$password,$tipousuario, $email,$celular,$sede_destino, $departamento,$imagen);
			echo $rspta ? "Datos registrados correctamente" : "No se pudo registrar todos los datos del usuario";
		}
		else {
			$rspta=$usuario->editar($idempleado,$cedula,$nombre,$apellidos, $email,$celular,$sede_destino, $departamento);
			echo $rspta ? "Datos actualizados correctamente" : "No se pudo actualizar los datos";
		}
	break;
        
        case 'guardaryeditar_r':
        if (!file_exists($_FILES['imagen']['tmp_name'])|| !is_uploaded_file($_FILES['imagen']['tmp_name']))  
		{
			$imagen=$_POST["imagenactual"];
		}else
		{

			$ext=explode(".", $_FILES["imagen"]["name"]);
			if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png")
			 {

			   $imagen = round(microtime(true)).'.'. end($ext);
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/usuarios/" . $imagen);
		 	}
		}
		if (empty($idusuario)) {
			//Hash SHA256 para la contraseña
		        $password=hash("SHA256", $cedula);
                        $login= $cedula;
                        $idtipousuario=1;
			$rspta=$usuario->insertar_r($cedula,$nombre,$apellidos,$login,$idtipousuario, $email, $password,$celular,$sede,$imagen);
			echo $rspta ? "Datos registrados correctamente" : "No se pudo registrar todos los datos del usuario";
		}
		else {
			$rspta=$usuario->editar_r($idusuario,$cedula,$nombre,$apellidos, $email,$celular,$sede);
			echo $rspta ? "Datos actualizados correctamente" : "No se pudo actualizar los datos";
		}
	break;
        
	case 'desactivar_r':
		$rspta=$usuario->desactivar_r($idusuario);
		echo $rspta ? "empleado eliminado correctamente" : "No se pudo eliminar el empleado";
	break;
    
       case 'desactivar':
		$rspta=$usuario->desactivar($idempleado);
		echo $rspta ? "empleado eliminado correctamente" : "No se pudo eliminar el empleado";
	break;

	case 'activar':
		$rspta=$usuario->activar($idusuario);
		echo $rspta ? "Datos activados correctamente" : "No se pudo activar los datos";
	break;
	
	case 'mostrar':
		$rspta=$usuario->mostrar($idempleado);
		echo json_encode($rspta);
	break;
    
       case 'mostrar_r':
		$rspta=$usuario->mostrar_r($idusuario);
		echo json_encode($rspta);
	break;

	case 'editar_clave':
		$clavehash=hash("SHA256", $clavec);

		$rspta=$usuario->editar_clave($clavehash);
		echo $rspta ? "Password actualizado correctamente" : "No se pudo actualizar el password";
	break;
    
         case 'editar_clave_r':
		$clavehash=hash("SHA256", $clavec);

		$rspta=$usuario->editar_clave_r($clavehash);
		echo $rspta ? "Password actualizado correctamente" : "No se pudo actualizar el password";
	break;

	case 'mostrar_clave':
		$rspta=$usuario->mostrar_clave($idusuario);
		echo json_encode($rspta);
	break;
	
	case 'listar_r':
		$rspta=$usuario->listar();
		//declaramos un array
		$data=Array();


		while ($reg=$rspta->fetch_object()) {
			$data[]=array(
				"0"=>($reg->idusuario)?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idusuario.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->idusuario.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idusuario.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-info btn-xs" onclick="mostrar_clave('.$reg->idusuario.')"><i class="fa fa-key"></i></button>'.' '.'<button class="btn btn-primary btn-xs" onclick="activar('.$reg->idusuario.')"><i class="fa fa-check"></i></button>',
				"1"=>$reg->cedula,
                                "2"=>$reg->nombre,
				"3"=>$reg->apellidos,
				"4"=>$reg->login,
				"5"=>$reg->email,
                                "6"=>$reg->celular,
                                "7"=>$reg->sede,
				"8"=>"<img src='../files/usuarios/".$reg->imagen."' height='50px' width='50px'>",
        
                            );
		}

		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		echo json_encode($results);

	break;
        
        case 'mi_listar_r':
		$rspta=$usuario->listar_r();
		//declaramos un array
		$data=Array();


		while ($reg=$rspta->fetch_object()) {
			$data[]=array(
				"0"=>($reg->idusuario)?'<button class="btn btn-info btn-xs" onclick="mostrar_clave('.$reg->idusuario.')"><i class="fa fa-key"></i></button>':'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idusuario.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-info btn-xs" onclick="mostrar_clave('.$reg->idusuario.')"><i class="fa fa-key"></i></button>'.' '.'<button class="btn btn-primary btn-xs" onclick="activar('.$reg->idusuario.')"><i class="fa fa-check"></i></button>',
				"1"=>$reg->cedula,
                                "2"=>$reg->nombre,
				"3"=>$reg->apellidos,
				"4"=>$reg->login,
				"5"=>$reg->email,
                                "6"=>$reg->celular,
                                "7"=>$reg->sede,
				"8"=>"<img src='../files/usuarios/".$reg->imagen."' height='50px' width='50px'>",
        
                            );
		}

		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		echo json_encode($results);

	break;
        case 'listar_e':
		$rspta=$usuario->listar_e();
		//declaramos un array
		$data=Array();


		while ($reg=$rspta->fetch_object()) {
			$data[]=array(
				"0"=>($reg->idempleado)?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idempleado.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->idempleado.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idempleado.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-info btn-xs" onclick="mostrar_clave('.$reg->idempleado.')"><i class="fa fa-key"></i></button>'.' '.'<button class="btn btn-primary btn-xs" onclick="activar('.$reg->idempleado.')"><i class="fa fa-check"></i></button>',
                                "1"=>$reg->cedula,
				"2"=>$reg->nombre,
				"3"=>$reg->apellidos,
                                "4"=>"<img src='../files/usuarios/".$reg->imagen."' height='50px' width='50px'>",
                                "5"=>$reg->login,
				"6"=>$reg->email,
				"7"=>$reg->celular,
				"8"=>$reg->sede,
				"9"=>$reg->departamento
				);
        
		}

		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		echo json_encode($results);

	break;
        
        case 'listar_empleados':
		$rspta=$usuario->listar_e_i();
		//declaramos un array
		$data=Array();


		while ($reg=$rspta->fetch_object()) {
			$data[]=array(
				"0"=>($reg->idempleado)?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idempleado.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->idempleado.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idempleado.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-info btn-xs" onclick="mostrar_clave('.$reg->idempleado.')"><i class="fa fa-key"></i></button>'.' '.'<button class="btn btn-primary btn-xs" onclick="activar('.$reg->idempleado.')"><i class="fa fa-check"></i></button>',
                                "1"=>$reg->cedula,
				"2"=>$reg->nombre,
				"3"=>$reg->apellidos,
                                "4"=>"<img src='../files/usuarios/".$reg->imagen."' height='50px' width='50px'>",
                                "5"=>$reg->login,
				"6"=>$reg->email,
				"7"=>$reg->celular,
				"8"=>$reg->sede,
				"9"=>$reg->departamento
				);
        
		}

		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		echo json_encode($results);

	break;
        case 'listar_u':
		$rspta=$usuario->listar_u();
		//declaramos un array
		$data=Array();


		while ($reg=$rspta->fetch_object()) {
			$data[]=array(
				"0"=>($reg->idempleado)?'<button class="btn btn-info btn-xs" onclick="mostrar_clave('.$reg->idempleado.')"><i class="fa fa-key"></i></button>' :'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idempleado.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-info btn-xs" onclick="mostrar_clave('.$reg->idempleado.')"><i class="fa fa-key"></i></button>'.' '.'<button class="btn btn-primary btn-xs" onclick="activar('.$reg->idempleado.')"><i class="fa fa-check"></i></button>',
                                "1"=>$reg->cedula,
				"2"=>$reg->nombre,
				"3"=>$reg->apellidos,
                                "4"=>"<img src='../files/usuarios/".$reg->imagen."' height='50px' width='50px'>",
                                "5"=>$reg->login,
				"6"=>$reg->email,
				"7"=>$reg->celular,
				"8"=>$reg->sede,
				"9"=>$reg->departamento
				);
        
		}

		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		echo json_encode($results);

	break;

	case 'verificar':
		//validar si el usuario tiene acceso al sistema
		$logina=$_POST['logina'];
		$clavea=$_POST['clavea'];

		//Hash SHA256 en la contraseña
		$clavehash=hash("SHA256", $clavea);
	
		$rspta=$usuario->verificar($logina, $clavehash);

		$fetch=$rspta->fetch_object();

		if (isset($fetch)) 
		{
			# Declaramos la variables de sesion
			$_SESSION['idusuario']=$fetch->idusuario;
			$id=$fetch->idusuario;
			$_SESSION['nombre']=$fetch->nombre;
            $_SESSION['imagen']=$fetch->imagen;
			$_SESSION['login']=$fetch->login;
			$_SESSION['tipousuario']=$fetch->tipousuario;
			$_SESSION['sede']=$fetch->sede;
                        $_SESSION['celular']=$fetch->celular;
                        $_SESSION['area']=$fetch->area;
			require "../config/Conexion.php";

			$sql="UPDATE usuarios SET iteracion='1' WHERE idusuario='$id'";
			echo $sql; 
	 		ejecutarConsulta($sql);	 		

		}

		echo json_encode($fetch);

	break;
        
        

	case 'salir':
			
			$id=$_SESSION['idusuario'];
			$sql="UPDATE usuarios SET iteracion='0' WHERE idusuario='$id'";
			echo $sql; 
	 		ejecutarConsulta($sql);	 		


		//Limpiamos las variables de sesión   
        session_unset();
        //Destruìmos la sesión
        session_destroy();
        //Redireccionamos al login
        header("Location: ../vistas/login.html");

	break;
    
    case 'selectSede_destino':
        require_once "../modelos/Usuario.php";
        $usuario= new Usuario();
        $rspta = $usuario->listar_sede_destino();
        while ($reg = $rspta->fetch_object()) {
            $sede_destino= $reg->sede_destino;
            echo '<option value="' . $sede_destino . '">' . $reg->sede_destino . ' </option>';
        }
        break;

}
?>