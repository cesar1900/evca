var tabla;

//funcion que se ejecuta al inicio
function init(){
   mostrarform(false);
     mostrarform_mf(false);
   listar();
   $("#formulario").on("submit",function(e){
   	guardaryeditar(e);
   });
   $("#formulario_mf").on("submit",function(e){
   	guardaryeditar_mf(e);
   });
  

}

//funcion limpiar
function limpiar(){
	$("#idpeae").val("");
        $("#codigo_producto").val("");
	$("#nombre").val("");
	$("#cantidad").val("");
        $("#punto").val("");
        $("#lote").val("");
        $("#cums").val("");
        $("#invima").val("");
        $("#Valor_unitario").val("");
        $("#fecha_vencimiento").val("");
        $("#area").val("");
        $("#area_e").val("");
        $("#cantidad_a").val("");
        $("#m_salida").val("");
        $("#orden_medica").val("");
        $("#uas").val("");
        $("#observacion").val("");
        $("#centro_s").val("");
             
}

//funcion mostrar formulario
function mostrarform(flag){
	limpiar();
	if(flag){
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		
	}else{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		
	}
}
function mostrarform_mf(flag){
	limpiar_mf();
	if(flag){
		$("#listadoregistros").hide();
		$("#formularioregistros_mf").show();
		$("#btnGuardar_mf").prop("disabled",false);
		
	}else{
		$("#listadoregistros").show();
		$("#formularioregistros_mf").hide();
		
	}
}


//cancelar form
function cancelarform(){
	limpiar();
        limpiar_mf();
	mostrarform(false);
        mostrarform_mf(false);
}


//funcion listar
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
			url:'../ajax/articulos_area_farmacia.php?op=listar_area_medicamentos',
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

function mostrar(idpeae){
	$.post("../ajax/articulos_area_farmacia.php?op=mostrar_area_e",{idpeae : idpeae},
		function(data,status)
		{
			data=JSON.parse(data);
			mostrarform(true);
                        $("#codigo_producto").val(data.codigo_producto);
			$("#nombre").val(data.nombre);
			$("#cantidad").val(data.cantidad);
			$("#punto").val(data.punto);
                        $("#lote").val(data.lote);
                        $("#cums").val(data.cums);
                        $("#invima").val(data.invima);
                        $("#area").val(data.area);
                        $("#fecha_vencimiento").val(data.fecha_vencimiento);
                        $("#valor_unitario").val(data.valor_unitario);
                        $("#tipo").val(data.tipo);
                        $("#idpeae").val(data.idpeae);
		}); 
}
function limpiar_mf(){
	 
                        $("#codigo_producto_mf").val("");
			$("#nombre_mf").val("");
			$("#principio_activo").val("");
			$("#forma_farmaceutica").val("");
                        $("#concentracion").val();
                        $("#fecha_vencimiento_mf").val("");
                        $("#presentacion_comercial").val("");
                        $("#unidad_medidad").val("");
                        $("#invima_mf").val("");
                        $("#valor_mf").val("");
             
}
function mostrar_mf(idpeae){
	$.post("../ajax/articulos_area_farmacia.php?op=mostrar_area_e",{idpeae : idpeae},
		function(data,status)
		{
                    
                        data = JSON.parse(data);
                        mostrarform_mf(true);
                        $("#codigo_producto_mf").val(data.codigo_producto);
                        $("#nombre_mf").val(data.nombre);
                        //$("#principio_activo").val(data.principio_activo);
                        //$("#forma_farmaceutica").val(data.forma_farmaceutica);
                        // $("#concentracion").val(data.concentracion);
                        $("#lote_mf").val(data.lote);
                        $("#fecha_vencimiento_mf").val(data.fecha_vencimiento);
                        //$("#presentacion_comercial").val(data.presentacion_comercial);
                        //$("#unidad_medidad").val(data.unidad_medidad);
                        $("#invima_mf").val(data.invima);
                        $("#valor_mf").val(data.valor_unitario);
                    
                
                    
			
		}); 
}

//funcion para guardaryeditar
function guardaryeditar(e){
     e.preventDefault();//no se activara la accion predeterminada 
     $("#btnGuardar").prop("disabled",true);
     var formData=new FormData($("#formulario")[0]);

     $.ajax({
        url: "../ajax/articulos_area_farmacia.php?op=guardaryeditar",
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
                text: 'Articulo asignado y guardado correctamente '

            }).then(function () {
                window.location = "../vistas/escritorio.php";
            })
          }else if(datos=='r2'){
              limpiar();
              Swal.fire({
                icon: 'error',
                title: 'debes selecionar la modalidad de salida',
                text: 'Gracias'

            }).then(function () {
                 $("#btnGuardar").prop("disabled",false);
            })
          }else if(datos=='r3'){
                Swal.fire({
                icon: 'error',
                title: 'NO SE PUEDE REALIZAR UNA ROTACION EN LA MISMA UAS',
                text: 'gracias'

            }).then(function () {
                $("#btnGuardar").prop("disabled",false);
            })
          }else if(datos=='r4'){
                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'LA CANTIDAD A ASIGNAR ES MAYOR A LA CANTIDAD EN BODEGA'

            }).then(function () {
                window.location = "../vistas/escritorio.php";
            })
          }else if(datos=='r5'){
                Swal.fire({
                icon: 'error',
                title: 'EL CENTRO DE SALUD NO PERTENECES A TU UAS',
                text: 'revisa ese item'

            }).then(function () {
                window.location = "../vistas/articulos_area_medicamentos.php";
            })
          }


        }
    }) 
     
     
}

//funcion para guardaryeditar norma medicamentos
function guardaryeditar_mf(e){
     e.preventDefault();//no se activara la accion predeterminada 
     $("#btnGuardar_mf").prop("disabled",true);
     var formData=new FormData($("#formulario_mf")[0]);

     $.ajax({
        url: "../ajax/articulos_area_farmacia.php?op=guardaryeditar_mf",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function (datos) {
            //bootbox.alert(datos);
            if(datos=='r1'){
              limpiar_mf();
              Swal.fire({
                icon: 'success',
                title: 'Saludos',
                text: 'Articulo asignado y guardado correctamente '

            }).then(function () {
                window.location = "../vistas/escritorio.php";
            })
          }else if(datos=='r2'){
              limpiar_mf();
              Swal.fire({
                icon: 'error',
                title: 'debes selecionar la modalidad de salida',
                text: 'Gracias'

            }).then(function () {
                 $("#btnGuardar").prop("disabled",false);
            })
          }else if(datos=='r3'){
                Swal.fire({
                icon: 'error',
                title: 'no se puede realizar una rotacion en la misma UAS',
                text: 'gracias'

            }).then(function () {
                $("#btnGuardar").prop("disabled",false);
            })
          }else if(datos=='r4'){
                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'LA CANTIDAD A ASIGNAR ES MAYOR A LA CANTIDAD EN BODEGA'

            }).then(function () {
                window.location = "../vistas/escritorio.php";
            })
          }else if(datos=='r5'){
                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'MEDICAMNETO YA REGISTRADO'

            }).then(function () {
                window.location = "../vistas/escritorio.php";
            })
          }else if(datos=='r6'){
              limpiar_mf();
                Swal.fire({
                icon: 'success',
                title: 'DATOS DE NORMA GUARDADOS CON EXITO',
                text: 'SALUDOS'

            }).then(function () {
                window.location = "../vistas/escritorio.php";
            })
          }

        }
    }) 
     
     
}
 
init();