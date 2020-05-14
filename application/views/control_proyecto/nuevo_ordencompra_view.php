
<!-- bootstrap-datetimepicker -->
<link href="<?php echo base_url(); ?>vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">

<?php
$nropo = "";
$duid = "";
$titulo = "";
$monto = "";
$duracion = "";
$fecha_ini = "";
$usuario = "";
$cabeza = " alert-info alert-dismissible fade in";
if ($id_send != 0) {
    $nropo = $oc_dat->nroPO;
    $duid = $oc_dat->DUID;
    $titulo = $oc_dat->titulo;
    $monto = $oc_dat->monto;
    $duracion = $oc_dat->duracion;
    $fecha_ini = $oc_dat->posible_fecha;
    $usuario = "$oc_dat->usuario_asignado";
    $cabeza = " alert-success alert-dismissible fade in ";
}
?>



<div class="x_content <?= $cabeza ?>">
    <div class="col-md-12">
        <div class="col-md-6 f10 alin_der ">Id Orden Compra:</div><div class="col-md-6 f16  negrilla alin_izq"><?php echo $id_send; ?></div>
        <input type="hidden" value="<?php echo $id_send; ?>" id="idordencompra">
    </div>

    <div class="col-md-12">
        <div class="col-md-6 alin_der f10 alin_der ">Estado Actual: </div><div class="col-md-6  negrilla f12 alin_izq"><?php //echo $estado;             ?></div>
    </div>

</div>

<div class="x_content alert alert-warning alert-dismissible fade in col-md-12" id="respuesta"></div>




<div class="x_content">

    <form class="form-horizontal form-label-left input_mask">

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nro PO</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control" placeholder="nro PO" id="nropo" value="<?= $nropo ?>" >
            </div>
        </div> 

        <div class="form-group">

            <label class="control-label col-md-3 col-sm-3 col-xs-12"> DUID </label>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control" placeholder="DUID" id="duid" value="<?= $duid ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Titulo (nombre/sitio)</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control" placeholder="Sitio/Nombre/titulo" id="titulo" value="<?= $titulo ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Monto Asignado</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="number" id="monto" value="<?= $monto ?>" name="number" required="required" data-validate-minmax="0,1000000" class="form-control col-md-7 col-xs-12">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Duracion orden</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="number" id="duracion" value="<?= $duracion ?>" required="required" data-validate-minmax="0,365" class="form-control col-md-7 col-xs-12">
            </div>
        </div>



        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha Inicio</label>

            <div class='col-md-9 col-sm-9 col-xs-12 input-group date' id='myDatepicker4'>
                <input type='text' class="form-control" id="fechainicial" value="<?php echo $fecha_ini; ?>" readonly="readonly"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>



        </div>




        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Personal Asignado</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <select class="select2_single form-control" tabindex="-1" id="id_personal">
                    <option value="0">seleccione personal...</option>
                    <?php
                    foreach ($personal_datos->result() as $reg) {
                        if ($reg->cod_user == $usuario)
                            echo "<option selected ='selected' value='$reg->cod_user'>$reg->ap_paterno $reg->ap_materno, $reg->nombre </option>";
                        else
                            echo "<option value='$reg->cod_user'>$reg->ap_paterno $reg->ap_materno, $reg->nombre </option>";
                    }
                    ?>

                </select>
            </div> 
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Proyecto</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <select class="select2_single form-control" tabindex="-1" id="id_proyecto">
                    <option></option>

                </select>
            </div> 
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Proyecto Interno</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" id="proyinterno" class="form-control col-md-10"/>
            </div>
        </div>
        <div class="form-group">
            <label for="message">Observaciones Comentarios (100 max caracteres) :</label>
            <textarea id="message" required="required" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="0" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.."
                      data-parsley-validation-threshold="10"></textarea>
        </div>





    </form>
</div>



<!-- jQuery -->
<script src="<?php echo base_url(); ?>/vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap --> <script src="<?php echo base_url(); ?>utilidades/modForm/jquery-ui.js"></script>

<script src="<?php echo base_url(); ?>/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- bootstrap-datetimepicker -->    
<script src="<?php echo base_url(); ?>/vendors/moment/min/moment.min.js"></script>
<script src="<?php echo base_url(); ?>/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<!-- Custom Theme Scripts -->
<script src="<?php echo base_url(); ?>/build/js/custom.min.js"></script>

<script>
    
    $('#myDatepicker4').datetimepicker({
        ignoreReadonly: true,
        allowInputToggle: true,
        format: 'YYYY-MM-DD'
    });
</script>




