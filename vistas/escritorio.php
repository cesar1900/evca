<?php
//activamos almacenamiento en el buffer
ob_start();


require 'header2.php';


 
  
  
?>
    <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        <div class="col-md-12">
      <div class="box">
<div class="panel-body">


<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
  <div class="small-box bg-yellow">
    
      <a href="reporte_evento_asistencial.php" class="small-box-footer">
    <div class="inner">
      <h5 style="font-size: 20px;">
        <strong>Reporte eventos ASISTENCIALES</strong>
      </h5>
       
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


<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
  <div class="small-box bg-green">
    
    <a href="cargar_salida.php" class="small-box-footer">
    <div class="inner">
      <h5 style="font-size: 20px;">
        <strong>Reporte eventos ADMINISTRATIVOS</strong>
      </h5>
     
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

ob_end_flush();
?>