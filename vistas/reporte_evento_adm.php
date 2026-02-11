<?php
//activamos almacenamiento en el buffer


require 'header2.php';

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
                        <h1 class="box-title">REPORTE EVENTO ADMINISTRATIVO: <button class="btn btn-success" onclick="mostrarform(true)" id="btnagregar"><i class="fa fa-plus-circle"></i>Agregar</button></h1>
                        <div class="box-tools pull-right">

                        </div>
                    </div>
                    <!--box-header-->
                    <!--centro-->
                    <div class="panel-body" id="formularioregistros_s">
                        <form action="" name="formulario_s" id="formulario_s" method="POST">

                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <label for="">Fecha del Evento(*):</label>
                                <input class="form-control" type="text" name="fecha_evento" id="fecha_evento" maxlength="100" placeholder="AAAA-MM-DD" required>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <label for="">Hora del Evento(*):</label>
                                <input class="form-control" type="text" name="hora_evento" id="hora_evento" maxlength="100" placeholder="HH:MM" required>
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <label for="">Sede(*):</label>
                                <select name="uas" id="uas" class="form-control select-picker" required>
                                    <option value="">--Seleccione--</option>
                                    <option value="Argelia">Argelia</option>
                                    <option value="Balboa">Balboa</option>
                                    <option value="Bolivar">Bolivar</option>
                                    <option value="Florencia">Florencia</option>
                                    <option value="Mercaderes">Mercaderes</option>
                                    <option value="Sucre">Sucre</option>
                                    <option value="Adm">Sede Administrativa</option>
                                </select>
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <label for="">Lugar del Evento(*):</label>
                                <select name="lugar_evento" id="lugar_evento" class="form-control select-picker" required>
                                    <option value="">--Seleccione--</option>
                                    <option value="Hospitalización">Hospitalización</option>
                                    <option value="Urgencias">Urgencias</option>
                                    <option value="Sala Partos">Sala Partos</option>
                                    <option value="Laboratorio">Laboratorio</option>
                                    <option value="Odontologia">Odontologia</option>
                                    <option value="Vacunación">Vacunación</option>
                                    <option value="Consulta Externa">Consulta Externa</option>
                                    <option value="Esterilización">Esterilización</option>
                                    <option value="Farmacia">Farmacia</option>
                                    <option value="Administrativa">Administrativa</option>
                                </select>
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <label for="">Con que estuvo relacionado:(*):</label>
                                <select name="lugar_r" id="lugar_r" class="form-control select-picker" required>
                                    <option value="">--Seleccione--</option>
                                    <option value="Identificación">Identificación</option>
                                    <option value="Caidas">Caidas</option>
                                    <option value="Medicamento">Medicamento</option>
                                    <option value="Dispositivos médicos">Dispositivos médicos</option>
                                    <option value="Reactivos">Reactivos</option>
                                    <option value="Cuidados en la atención">Cuidados en la atención</option>
                                    <option value="Ulceras por presión">Ulceras por presión</option>
                                    <option value="Traslado de pacientes">Traslado de pacientes</option>
                                    <option value="Procesos Administrativos">Procesos Administrativos</option>
                                    <option value="otro">otro</option>
                                </select>
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <label for="">Descripcion de lo ocurrido:</label><br>


                                <textarea rows="5" cols="70" name="descripcion" id="descripcion" placeholder="(Describa el evento, con el máximo de detalle posible, sin hacer mención específica a personas determinadas)" required></textarea>
                            </div>

                           

                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <label for="">Nombre de quien reporta:</label>
                                <input class="form-control" type="text" name="nombre_reporta" id="nombre_reporta" maxlength="100" placeholder="(Su reporte puede ser anónimo o identificable)">
                            </div>


                           
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" type="submit" id="btnGuardar_s"><i class="fa fa-save"></i> Guardar</button>

                                <button class="btn btn-danger" onclick="cancelarform_s()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                            </div>
                        </form>
                    </div>




                </div>
            </div>
            <!-- /.box -->
        </div>

        <!-- /.content -->
</div>

<?php
require 'footer.php';
?>
<script src="scripts/reporte_adm.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<?php


ob_end_flush();
?>