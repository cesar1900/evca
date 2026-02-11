<?php
//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
  header("Location: login.php");
}else{

 
require 'header.php';
require_once('../modelos/Usuario.php');

  
 
  
?>
    <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        <div class="col-md-12">
      <div class="box">
<div class="panel-body">

<?php if ($_SESSION['tipousuario']=='Administrador') {
?>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
  <div class="small-box bg-yellow">
    
    <a href="reportes_as.php" class="small-box-footer">
    <div class="inner">
      <h5 style="font-size: 20px;">
        <strong>Eventos</strong>
      </h5>
      <p>ASISTENCIALES</p>
    </div>
    <div class="icon">
      <i class="fa fa-list" aria-hidden="true"></i>
    </div>&nbsp;
     <div class="small-box-footer">
           <i class="fa"></i>
     </div>

    </a>
  </div>
</div>
<?php } ?>

<?php if ($_SESSION['tipousuario']=='Administrador') {
?>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
  <div class="small-box bg-green">
    
    <a href="reportes_adm.php" class="small-box-footer">
    <div class="inner">
      <h5 style="font-size: 20px;">
        <strong>Eventos</strong>
      </h5>
      <p>ADMINISTRATIVOS</p>
    </div>
    <div class="icon">
      <i class="fa fa-list" aria-hidden="true"></i>
    </div>&nbsp;
     <div class="small-box-footer">
           <i class="fa"></i>
     </div>

    </a>
  </div>
</div>
<?php } ?>

  
<!--fin centro-->
      </div>
      </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>

<?php
require 'footer.php'; 
}
ob_end_flush();
?>