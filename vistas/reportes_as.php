<?php
//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
    header("Location: login.html");
} else {

    require 'header.php';
    require_once('../modelos/Usuario.php');

    //$sede = $_SESSION['sede'];

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
                            <h1 class="box-title">EVENTOS ASISTENCIALES</h1>
                            <div class="box-tools pull-right">

                            </div>
                        </div>
                        <!--box-header-->
                        <!--centro-->
                        <div class="panel-body table-responsive" id="listadoregistros">
                            <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                                <thead>

                                    <th>Fecha_reporte</th>
                                    <th>Fecha_evento</th>
                                    <th>Hora_evento</th>
                                    <th>Sede</th>
                                    <th>Lugar_evento</th>
                                    <th>Relacion</th>
                                    <th>Descripcion</th>
                                    <th>HC_paciente</th>
                                    <th>Nombre_reporta</th>

                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <th>Fecha_reporte</th>
                                    <th>Fecha_evento</th>
                                    <th>Hora_evento</th>
                                    <th>Sede</th>
                                    <th>Lugar_evento</th>
                                    <th>Relacion</th>
                                    <th>Descripcion</th>
                                    <th>HC_paciente</th>
                                    <th>Nombre_reporta</th>
                                </tfoot>

                            </table>
                        </div>



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
    <script src="scripts/reportes_as.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
   

<?php
}

ob_end_flush();
?>