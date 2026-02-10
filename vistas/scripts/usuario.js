var tabla;

//funcion que se ejecuta al inicio
function init(){
   mostrarform(false);
    
   mostrarform_clave(false);
   listar();
   
$("#formularioc").on("submit",function(c){
   	editar_clave(c);
   })
   $("#formulario").on("submit",function(e){
   	guardaryeditar(e);
   })
    
   $("#imagenmuestra").hide();
//mostramos los permisos
$.post("../ajax/usuario.php?op=permisos&id=", function(r){
	$("#permisos").html(r);
});

   //cargamos los items al select departamento
   $.post("../ajax/departamento.php?op=selectDepartamento", function(r){
   	$("#departamento").html(r);
   	$('#departamento').selectpicker('refresh'); 
   });

   //cargamos los items al select tipousuario
   $.post("../ajax/tipousuario.php?op=selectTipousuario", function(r){
   	$("#idtipousuario").html(r);
   	$('#idtipousuario').selectpicker('refresh'); 
   });
   
   //cargamos los items al select sede destino
    $.post("../ajax/usuario.php?op=selectSede_destino", function(r){
   	$("#sede_destino").html(r);
   	$('#sede_destino').selectpicker('refresh');
   });

}

//funcion limpiar
function limpiar(){
        $("#idempleado").val("");
	$("#nombre").val("");
        $("#apellidos").val("");
	$("#direccion").val("");
	$("#departamento").selectpicker('refresh');
	$("#email").val("");
	$("#celular").val("");
	$("#cedula").val("");
	$("#sede_destino").selectpicker('refresh');
        $("#login").val("");
	$("#clave").val("");
        $("#imagenmuestra").attr("src","");
	$("#imagenactual").val("");
	
}

//funcion mostrar formulario
function mostrarform(flag){
	limpiar();
	if(flag){
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
                $("#btnagregar").show();
                 
		 
	}else{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
                 
	}
}
 
function mostrarform_clave(flag){
	limpiar();
	if(flag){
		$("#listadoregistros").hide();
		$("#formulario_clave").show();
		$("#btnGuardar_clave").prop("disabled",false);
		$("#btnagregar").hide();
	}else{
		$("#listadoregistros").show();
		$("#formulario_clave").hide();
		$("#btnagregar").show();
	}
}
//cancelar form
function cancelarform(){
	$("#claves").show();
	limpiar();
	mostrarform(false);
        
}
function cancelarform_clave(){
	limpiar();
	mostrarform_clave(false);

}
//funcion listar todos usuarios para radicador 
function listar(){
	tabla=$('#tbllistado').dataTable({
		"aProcessing": true,//activamos el procedimiento del datatable
		"aServerSide": true,//paginacion y filrado realizados por el server
		dom: 'Bfrtip',//definimos los elementos del control de la tabla
		buttons: [
                  'copyHtml5',
                  'excelHtml5',
                  'csvHtml5',
                  'pdf'
		],
		"ajax":
		{
			url:'../ajax/usuario.php?op=listar_empleados',
			type: "get",
			dataType : "json",
			error:function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy":true,
		"iDisplayLength":10,//paginacion
		"order":[[0,"desc"]]//ordenar (columna, orden)
	}).DataTable();
}
//funcion listar todos usuarios para radicador 
 
//funcion para guardaryeditar
function guardaryeditar(e){
     e.preventDefault();//no se activara la accion predeterminada 
     $("#btnGuardar").prop("disabled",true);
     var formData=new FormData($("#formulario")[0]);

     $.ajax({
     	url: "../ajax/usuario.php?op=guardaryeditar",
     	type: "POST",
     	data: formData,
     	contentType: false,
     	processData: false,

     	success: function(datos){
     		bootbox.alert(datos);
     		mostrarform(false);
     		tabla.ajax.reload();
                limpiar();
     	}
     });

     
}
 

function editar_clave(c){
     c.preventDefault();//no se activara la accion predeterminada 
     $("#btnGuardar_clave").prop("disabled",true);
     var formData=new FormData($("#formularioc")[0]);

     $.ajax({
     	url: "../ajax/usuario.php?op=editar_clave",
     	type: "POST",
     	data: formData,
     	contentType: false,
     	processData: false,

     	success: function(datos){
     		bootbox.alert(datos);
     		mostrarform_clave(false);
     		tabla.ajax.reload();
     	}
     });

     limpiar();
	 $("#getCodeModal").modal('hide');
}
function mostrar(idempleado){
	$.post("../ajax/usuario.php?op=mostrar",{idempleado : idempleado},
		function(data,status)
		{
			data=JSON.parse(data);
			mostrarform(true);
	    $("#idempleado").val(data.idempleado); 
	    $("#nombre").val(data.nombre);
            $("#departamento").val(data.departamento);
            $("#departamento").selectpicker('refresh');
            $("#nombre").val(data.nombre);
            $("#apellidos").val(data.apellidos);
            $("#cedula").val(data.cedula);
            $("#email").val(data.email);
            $("#celular").val(data.celular);
            $("#sede_destino").val(data.sede);
            $("#sede_destino").selectpicker('refresh');
            $("#imagenmuestra").show();
            $("#imagenmuestra").attr("src","../files/usuarios/"+data.imagen);
            $("#imagenactual").val(data.imagen);
 
		});
	
}

function mostrar_clave(idusuario){
	 $("#getCodeModal").modal('show');
	$.post("../ajax/usuario.php?op=mostrar_clave",{idusuario : idusuario},
		function(data,status)
		{
			data=JSON.parse(data);
            $("#idusuarioc").val(data.idusuario);
		});
}

//funcion para desactivar
function desactivar(idempleado){
	bootbox.confirm("¿Esta seguro eliminar el empleado?", function(result){
		if (result) {
			$.post("../ajax/usuario.php?op=desactivar", {idempleado : idempleado}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

function activar(idusuario){
	bootbox.confirm("¿Esta seguro de activar este dato?" , function(result){
		if (result) {
			$.post("../ajax/usuario.php?op=activar", {idusuario : idusuario}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

function generar(longitud)
{
  long=parseInt(longitud);
  var caracteres = "abcdefghijkmnpqrtuvwxyzABCDEFGHIJKLMNPQRTUVWXYZ2346789";
  var contraseña = "";
  for (i=0; i<long; i++) contraseña += caracteres.charAt(Math.floor(Math.random()*caracteres.length));
    $("#codigo_persona").val(contraseña);
}

init();