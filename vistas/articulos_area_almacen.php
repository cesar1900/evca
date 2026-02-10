<?php
//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
    header("Location: login.html");
} else {

    require 'header.php';
    require_once('../modelos/Usuario.php');
 
	$sede=$_SESSION['sede'];
       
    ?>
    <script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous">
    </script>
    
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h1 class="box-title">PRODUCTOS EN BODEGA DE ALMACEN</h1>
                            <div class="box-tools pull-right">

                            </div>
                        </div>
                        <!--box-header-->
                        <!--centro-->
                        <div class="panel-body table-responsive" id="listadoregistros">
                            <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                                <thead>
                                <th>Opciones</th>
                                <th>Codigo_producto</th>
                                <th>Semaforo</th>
                                <th>Nombre</th>
                                <th>Cantidad</th>
                                <th>Punto</th>
                                <th>Area</th>
                                <th>Lote</th>
                                <th>Cums</th>
                                <th>Invima</th>
                                <th>Meses_vencimiento</th>
                                <th>Fecha_vencimiento</th>
                                <th>Valor_unitario</th>
                                <th>Tipo</th>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                <th>Opciones</th>
                                <th>Codigo_producto</th>
                                <th>Semaforo</th>
                                <th>Nombre</th>
                                <th>Cantidad</th>
                                <th>Punto</th>
                                <th>Area</th>
                                <th>Lote</th>
                                <th>Cums</th>
                                <th>Invima</th>
                                <th>Meses_vencimiento</th>
                                <th>Fecha_vencimiento</th>
                                <th>Valor_unitario</th>
                                <th>Tipo</th>
                                </tfoot>   
                                </tfoot>   
                            </table>
                        </div>
                        <!--formulario 1-->
                        <div class="panel-body" id="formularioregistros">
                            <form action="" name="formulario" id="formulario" method="POST">
                                  <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                    <label for="">FORMULARIO DESPACHAR MEDICAMENTOS</label>
                                    
                                </div>
                                 <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                    <label for="">(porfavor llenar todos los campos)*</label>
                                    
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                 
                                    <label for="">codigo_producto</label>
                                    <input class="form-control" type="hidden" name="idpeae" id="idpeae">
                                    <input class="form-control" type="text" name="codigo_producto" id="codigo_producto" maxlength="256" placeholder="codigo_producto" readonly>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                        <label for="">Nombre</label>

                                        <input class="form-control" type="text" name="nombre" id="nombre" maxlength="50" placeholder="Nombre" readonly>
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                        <label for="">Cantidad en bodega</label>
                                        <input class="form-control" type="text" name="cantidad" id="cantidad" maxlength="256" placeholder="cantidad"readonly>
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                        <label for="">punto</label>
                                        <input class="form-control" type="text" name="punto" id="punto" maxlength="256" placeholder="punto"readonly>
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                        <label for="">lote</label>
                                        <input class="form-control" type="text" name="lote" id="lote" maxlength="256" placeholder="lote"readonly>
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                        <label for="">Cums</label>
                                        <input class="form-control" type="text" name="cums" id="cums" maxlength="256" placeholder="cums"readonly>
                                    </div>
                                
                                    <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                        <label for="">Invima</label>
                                        <input class="form-control" type="text" name="invima" id="invima" maxlength="256" placeholder="invima"readonly>
                                    </div>
                                    
                                    <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                        <label for="">Fecha_vencimiento</label>
                                        <input class="form-control" type="text" name="fecha_vencimiento" id="fecha_vencimiento" maxlength="256" placeholder="fecha_vencimiento"readonly>
                                    </div>
                                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                        <label for="">Valor unitario</label>
                                        <input class="form-control" type="text" name="valor_unitario" id="valor_unitario" maxlength="256" placeholder="fecha_vencimiento"readonly>
                                    </div>
                                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                        <label for="">Area</label>
                                        <input class="form-control" type="text" name="area" id="area" maxlength="256" placeholder="area"readonly>
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                        <label for="">Cantidad a entregar</label>
                                        <input class="form-control" type="text" name="cantidad_a" id="cantidad_a" maxlength="256" placeholder="cantidad a entregar" required>
                                    </div>
                              <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                        <label for="">Modalidad de salida</label>

                                        <select name="m_salida" id="m_salida" class="form-control select-picker" onchange="mostrarInput()">
                                            <option value="">...Selecciona una opción</option>
                                            <option value="facturado">facturado</option>
                                            <option value="rotacion">rotacion a un punto</option>
                                            <option value="vencimiento">por vencimiento</option>
                                            <option value="no_facturado">no facturado</option>
                                             
                                        </select>
                                    </div>
                                
                                
                                  <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                        <label for="">Orden medica</label>
                                        <input class="form-control" type="text" name="orden_medica" id="orden_medica" maxlength="256" placeholder="Orden medica" disabled required>
                                    </div>
                                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                       
                                     <label for="">UAS para rotar</label>
					<select name="uas" id="uas" class="form-control select-picker" disabled>
                                            <option value="">...Selecciona una opción</option>
                                            <option value="PUNTO DE ATENCION ARGELIA">Argelia</option>
                                            <option value="PUNTO DE ATENCION BALBOA">Balboa</option>
                                            <option value="PUNTO DE ATENCION BOLIVAR">Bolivar</option>
                                            <option value="PUNTO DE ATENCION FLORENCIA">Florenciao</option>
                                            <option value="PUNTO DE ATENCION MERCADERES">Mercaderes</option>
                                            <option value="PUNTO DE ATENCION SUCRE">Sucre</option>
                                        </select>	
                                    </div>
                                 	 <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                        <label for="">Observacion por vencimiento:</label>
                                        <br>
                                        <textarea rows="5" cols="50" name="observacion" id="observacion" disabled required></textarea>
                                    </div>
                                 <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                        <label for="">Observacion no facturado:</label>
                                        <br>
                                        <textarea rows="5" cols="50" name="observacionf" id="observacionf" disabled required></textarea>
                                    </div>	

                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i>  Guardar</button>

                                    <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                                </div>
                            </form> 
                   </div>
                        <!--fin formulario 1 -->
                         
 
                </div>
                <!-- /.box -->
</div>
                </div>
        </section>
        <!-- /.content -->
    </div>
    
   
    <?php
    require 'footer.php';
    ?>
    <script src="scripts/articulos_area_almacen.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
    function mostrarInput() {
      
    }
</script>
    
    <?php
}

ob_end_flush();
?>
