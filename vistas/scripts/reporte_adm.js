var tabla;

//funcion que se ejecuta al inicio
function init(){
   mostrarform(false);
    
  
   
   
   $("#formulario_s").on("submit",function(e){
   	guardaryeditar(e);
   });
    
   
    
  
    
 
}

//funcion limpiar
function limpiar(){
	
        $("#fecha_evento").val("");
        $("#hora_evento").val("");
        $("#uas").val("");
        $("#lugar_evento").val("");
        $("#lugar_r").val("");
        $("#descripcion").val("");
        $("#nombre_reporta").val("");
}



//funcion mostrar formulario
function mostrarform(flag){
	limpiar();
	if(flag){
		
		$("#formularioregistros_s").show();
		$("#btnGuardar").prop("disabled",false);
                $("#btnagregar").show();
                 
		 
	}else{
	
		$("#formularioregistros_s").hide();
		$("#btnagregar").show();
                 
	}
}
 

//cancelar form
function cancelarform_s(){
	
	limpiar();
	mostrarform(false);
        
}


//funcion para guardaryeditar
function guardaryeditar(e){
     e.preventDefault();//no se activara la accion predeterminada 
     $("#btnGuardar").prop("disabled",true);
     var formData=new FormData($("#formulario_s")[0]);

     $.ajax({
        url: "../ajax/reporte_adm.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function (datos) {
            //bootbox.alert(datos);
            if(datos=='r1'){
              limpiar();
              Swal.fire({
                icon: 'success',
                title: 'Saludos',
                text: 'Los datos guardados correctamente '

            }).then(function () {
                window.location = "../vistas/escritorio.php";
            })
          }else if(datos=='r2'){
              limpiar();
              Swal.fire({
                icon: 'error',
                title: 'Saludos',
                text: 'Error en la consulta SQL'

            }).then(function () {
                window.location = "../vistas/escritorio.php";
            })
          }

        }
    }) 
     
     
}
 
 
 
 
init();