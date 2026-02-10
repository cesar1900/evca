<?php
//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
    header("Location: login.html");
} else {


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
                            <h1 class="box-title">Reporte de correspondencia Externa</h1>
                            <div class="box-tools pull-right">

                            </div>
                        </div>
                        <!--box-header-->
                        <!--centro-->
                        <div class="panel-body table-responsive" id="listadoregistros">
                            <form id='form1' name='form1'class="formulario" action="reportes.php"  method="post" >
                                <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <label>Fecha Inicio</label>
                                    <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio" value="<?php echo date("Y-m-d"); ?>">
                                </div>
                                <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <label>Fecha Fin</label>
                                    <input type="date" class="form-control" name="fecha_fin" id="fecha_fin" value="<?php echo date("Y-m-d"); ?>">
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-xs-12" id="claves">
                                    <label for="">Sede:</label>
                                    <select name="sede" id="sede"  class="form-control select-picker"  required>
                                        <option value="Todas">Todas</option> 
                                        <option value="Argelia">Argelia</option> 
                                        <option value="Bordo" selected>Bordo</option>
                                        <option value="Bolivar">Bolivar</option>
                                        <option value="Balboa">Balboa</option> 
                                        <option value="Florencia" >Florencia</option>
                                        <option value="Mercaderes">Mercaderes</option>
                                        <option value="Sucre">Sucre</option> 
                                    </select>
                                </div>
                                <div class="form-inline col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <input type="submit" name="submit" value="Buscar">

                                </div>
                                 
                            </form>
                        </div>

                        <!--fin centro-->
                    </div>
                </div>
            </div>
            <!-- /.box -->
            <?php
            if (isset($_POST['submit'])) {
                $fecha_i = $_POST['fecha_inicio'];
                $fecha_f = $_POST['fecha_fin'];
                $sede = $_POST['sede'];

                if ($sede == "Todas") {
                    require_once('../modelos/Recibida_e.php');
                    $recibida_e = new Recibida_e();
                    $rsptan_e = $recibida_e->cantidad_recibidas_e_grafias("Queja", $fecha_i, $fecha_f);
                    $queja = $rsptan_e->fetch_object();
                    $q = $queja->respuesta;

                    $rspt_solicitud = $recibida_e->cantidad_recibidas_e_grafias("Solicitud", $fecha_i, $fecha_f);
                    $solicitud = $rspt_solicitud->fetch_object();
                    $s = $solicitud->respuesta;

                    $rspt_Tutela = $recibida_e->cantidad_recibidas_e_grafias("Tutela", $fecha_i, $fecha_f);
                    $Tutela = $rspt_Tutela->fetch_object();
                    $t = $Tutela->respuesta;

                    $rspt_Derecho = $recibida_e->cantidad_recibidas_e_grafias("Derecho de peticion", $fecha_i, $fecha_f);
                    $Derecho = $rspt_Derecho->fetch_object();
                    $d = $Derecho->respuesta;

                    $rspt_Tramite = $recibida_e->cantidad_recibidas_e_grafias("Tramite", $fecha_i, $fecha_f);
                    $Tramite = $rspt_Tramite->fetch_object();
                    $tr = $Tramite->respuesta;

                    $rspt_Glosas = $recibida_e->cantidad_recibidas_e_grafias("Glosas", $fecha_i, $fecha_f);
                    $Glosas = $rspt_Glosas->fetch_object();
                    $g = $Glosas->respuesta;

                    $rspt_entes = $recibida_e->cantidad_recibidas_e_grafias("Solicitud entes de control", $fecha_i, $fecha_f);
                    $entes = $rspt_entes->fetch_object();
                    $e = $entes->respuesta;

                    $rspt_Otro = $recibida_e->cantidad_recibidas_e_grafias("Otro", $fecha_i, $fecha_f);
                    $Otro = $rspt_Otro->fetch_object();
                    $o = $Otro->respuesta;
                } else {
                    require_once('../modelos/Recibida_e.php');
                    $recibida_e = new Recibida_e();
                    $rsptan_e = $recibida_e->cantidad_recibidas_e_grafias_sede("Queja", $fecha_i, $fecha_f,$sede);
                    $queja = $rsptan_e->fetch_object();
                    $q = $queja->respuesta;

                    $rspt_solicitud = $recibida_e->cantidad_recibidas_e_grafias_sede("Solicitud", $fecha_i, $fecha_f,$sede);
                    $solicitud = $rspt_solicitud->fetch_object();
                    $s = $solicitud->respuesta;

                    $rspt_Tutela = $recibida_e->cantidad_recibidas_e_grafias_sede("Tutela", $fecha_i, $fecha_f,$sede);
                    $Tutela = $rspt_Tutela->fetch_object();
                    $t = $Tutela->respuesta;

                    $rspt_Derecho = $recibida_e->cantidad_recibidas_e_grafias_sede("Derecho de peticion", $fecha_i, $fecha_f,$sede);
                    $Derecho = $rspt_Derecho->fetch_object();
                    $d = $Derecho->respuesta;

                    $rspt_Tramite = $recibida_e->cantidad_recibidas_e_grafias_sede("Tramite", $fecha_i, $fecha_f,$sede);
                    $Tramite = $rspt_Tramite->fetch_object();
                    $tr = $Tramite->respuesta;

                    $rspt_Glosas = $recibida_e->cantidad_recibidas_e_grafias_sede("Glosas", $fecha_i, $fecha_f,$sede);
                    $Glosas = $rspt_Glosas->fetch_object();
                    $g = $Glosas->respuesta;

                    $rspt_entes = $recibida_e->cantidad_recibidas_e_grafias_sede("Solicitud entes de control", $fecha_i, $fecha_f,$sede);
                    $entes = $rspt_entes->fetch_object();
                    $e = $entes->respuesta;

                    $rspt_Otro = $recibida_e->cantidad_recibidas_e_grafias_sede("Otro", $fecha_i, $fecha_f,$sede);
                    $Otro = $rspt_Otro->fetch_object();
                    $o = $Otro->respuesta;
                }
                ?>
                <script type="text/javascript" src="../js/loader.js"></script>  
                <script type="text/javascript">
                    google.charts.load("current", {packages: ["corechart"]});
                    google.charts.setOnLoadCallback(drawChart);
                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Task', 'Hours per Day'],
                            ['Quejas', <?php echo $q; ?>],
                            ['Solicitud', <?php echo $s; ?>],
                            ['Tutela', <?php echo $t; ?>],
                            ['Derecho de peticion', <?php echo $d; ?>],
                            ['Tramite', <?php echo $tr; ?>],
                            ['Glosas', <?php echo $g; ?>],
                            ['Solicitud entes de control', <?php echo $e; ?>],
                            ['Otros', <?php echo $o; ?>]
                        ]);

                        var options = {
                            title: 'Estadística por tipo de correspondencia ',
                            is3D: true,
                        };

                        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
                        chart.draw(data, options);
                    }
                </script>
                <div id="piechart_3d"    style=" margin-left: auto; margin-right:auto; width: 900px; height: 500px;"></div>
                <br><br>
        <?php
    }
    ?>
        </section>
        <!-- /.content -->
    </div>
    <?php
    require 'footer.php';
    ?>

    <?php
}

ob_end_flush();
?>

