<?php 
//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
  header("Location: login.html");
}else{      
                require 'header.php';
               
 ?>
    <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        <div class="col-md-12">
      <div class="box">
<div class="box-header with-border">
  <h1 class="box-title">Usuarios <button class="btn btn-success" onclick="mostrarform(true)" id="btnagregar"><i class="fa fa-plus-circle"></i>Agregar</button></h1>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->
<div class="panel-body table-responsive" id="listadoregistros">
  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
    <thead>
      <th>Opciones</th>
      <th>Cedula</th>
      <th>Nombre</th>
      <th>Apellidos</th>  
      <th>Login</th>
      <th>Email</th>
      <th>celular</th>
      <th>Sede</th>
       <th>Foto</th>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
      <th>Opciones</th>
      <th>Cedula</th>
      <th>Nombre</th>
      <th>Apellidos</th>  
      <th>Login</th>
      <th>Email</th>
      <th>celular</th>
      <th>Sede</th>
       <th>Foto</th>
    </tfoot>   
  </table>
</div>
<div class="panel-body" id="formularioregistros">
  <form action="" name="formulario" id="formulario" method="POST">
    
   
      <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Cedula(*):</label>
      <input class="form-control" type="text" name="cedula" id="cedula" maxlength="100" placeholder="Cedula" required>
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Nombre(*):</label>
      <input class="form-control" type="hidden" name="idusuario" id="idusuario">
      <input class="form-control" type="text" name="nombre" id="nombre" maxlength="100" placeholder="Nombre" required>
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Apellidos(*):</label>
      <input class="form-control" type="text" name="apellidos" id="apellidos" maxlength="100" placeholder="Apellidos" required>
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Email: </label>
      <input class="form-control" type="email" name="email" id="email" maxlength="70" placeholder="email">
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Celular(*):</label>
      <input class="form-control" type="text" name="celular" id="celular" maxlength="20" placeholder="celular" required>
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12" id="claves">
      <label for="">Sede(*):</label>
     
      <select name="sede" id="sede" class="form-control select-picker" >
              
          </select>
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Imagen:</label>
      <input class="form-control filestyle" data-buttonText="Seleccionar foto" type="file" name="imagen" id="imagen">
      <input type="hidden" name="imagenactual" id="imagenactual">
      <img src="" alt="" width="150px" height="120" id="imagenmuestra">
    </div>
    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i>  Guardar</button>
      
      <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
    </div>
  </form>
</div>




      </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
<?php 

require 'footer.php';
 ?>
 <script src="scripts/usuario_r.js"></script>
 <?php 
}

ob_end_flush();
  ?>
