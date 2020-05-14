
<!-- PNotify -->
<link href="<?php echo base_url(); ?>vendors/pnotify/dist/pnotify.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">
<script>

    function cuentadebanco() {
        //alert("***** " + $('#cuenta_banco_usuario :selected').val());
        $('#cuenta_banco_usuario').on('change', function () {
            //alert($('#cuenta_banco_usuario :selected').val());
            if ($('#cuenta_banco_usuario :selected').val() == -1)
            {
                form_cuenta_banco("cuenta_new");
            } else
            {
                $("#cuenta_new").html('');
            }
        });
    }


</script>


<?php
$monto = 0;
/// $nro_fact="";
$desc = "";
//$asignado = "";
$personal = "";
$titulo = "";
$cuenta = 0;
$estado = "Nuevo";
if ($id_rend != 0) {
    $monto = $datos_solicitud->row()->monto;
    // $nro_fac=$datos_solicitud->row()->monto;
    $desc = $datos_solicitud->row()->comentario_global;
    // $asignado = $datos_solicitud->row()->id_proy;
    $personal = $datos_solicitud->row()->id_usuario;
   // $titulo = $datos_solicitud->row()->titulo;
    $estado = $datos_solicitud->row()->estado;
    $cuenta = $datos_solicitud->row()->id_cuenta_banco;
    //echo $tipo_rendicion;
}
?>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <spam class="f20 negrilla">Registro de Solicitud de Caja Chica</spam>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>

        <div id="respuesta"></div>
        <input id="id_cc" type="hidden" value="<?php echo $id_rend; ?>">


<!--            //<input class="input_redond_200" type="hidden" id="fechaS" readonly="readonly" value=" <?php //echo date("Y-m-d H:i:s");                                                                         ?>" placeholder="">  -->

        <div class="col-md-12 col-sm-12 col-xs-12 espabajo5" >
            <div class='col-md-8 col-sm-8 col-xs-12'>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    Caja Chica al Usuario:
                    <br>
                    <select id="tecnico_seleccionado" class="form-control" onchange="obtener_cuentas_usuario(0);
                            obtenercajas_chicas();
                            cuentadebanco();" >
                        <option value="0" > Seleccione un usuario</option>
                        <?php
                        foreach ($usuarios->result() as $user) {
                            $sel = "";
                            if ($user->cod_user == $personal)
                                $sel = "selected='selected'";
                            ?>
                            <option <?= $sel ?> value="<?= $user->cod_user ?>" ><?= $user->ap_paterno . " " . $user->ap_materno . "," . $user->nombre ?></option>
                            <?php
                        }
                        ?>

                    </select>
                </div>


                <div class="col-md-4 col-sm-4 col-xs-12" >
                    <div class="col-md-12 col-sm-12 col-xs-12" id="cuenta_usuario">
                        Cuenta de banco del usuario:
                        <br>
                        <select class='form-control' id='cuenta_banco_usuario'>
                            <option value="0">Primero eleccione un Usuario</option>
                        </select>


                    </div><div class="col-md-12 col-sm-12 col-xs-12"><button onclick="form_cuenta_banco('cuenta_new');">Nueva cuenta de banco</button></div></div>

                <div class="col-md-4 col-sm-4 col-xs-12">
                    Proyecto: <br><select id="id_proy_sitio" class="form-control" onchange="cargar_sitiosproyecto();proyecto_mismo()">
                        <option value="0" > todos los proyectos relacionados</option>
                        <?php
                        foreach ($selec_proyecto->result() as $dato) {
                            if ($dato->id_proy == $asignado)
                                echo '<option selected="selected" value="' . $dato->id_proy . '">' . $dato->nombre . '</option>';
                            else
                                echo ' <option value="' . $dato->id_proy . '">' . $dato->nombre . '</option>';
                        }
                        ?>

                    </select>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 form-group" id="cuenta_new">
                    
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 form-group " id="cajasrelacionadas">

                </div>

                <div class="col-md-8 col-sm-8 col-xs-12 form-group">
                    <label for="message">Descripcion General de la Solicitud de Caja Chica :</label>
                    <textarea id="desc" required="required" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="0" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.."
                              data-parsley-validation-threshold="10"><?= $desc ?></textarea>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 form-group">
                    <label for="message">Monto</label>
                    <input class="form-control" style="margin-top: 0px; height: 70px;font-size: 40px; text-align: right"    type="text" id="monto" onkeyup="val_numero('drXX #monto')"   value="<?=$monto?>">
                </div>

            </div>

            <div class='col-md-4 col-sm-4 col-xs-12'>
                <div class=" col-md-6 col-sm-6 col-xs-12 fondo_amarillo_claro centrartexto negrilla">
                    <?php if ($id_rend != 0) { ?>

                        ID Solicitud Caja Chica <br>
                        <?php echo $id_rend; ?>


                    <?php }
                    ?>
                </div>
                <div class=" col-md-6 col-sm-6  col-xs-12 form-group ">
                    <div class="OK alin_cen negrilla">
                        Estado<br>
                        <?php echo $estado; ?>
                        <input type="hidden" id="estado_solicitud" value="<?= $estado ?>">
                    </div>
                </div>

            </div>


        </div>




        <div class="clear"></div>







        <div class="col-md-12 col-sm-12 col-xs-12 form-group alin_der">


            <?php
            if ($estado == "Aprobado") {
                ?>
                <button type="button" class="btn btn-warning  has-feedback" style="margin-right: 0;" onclick="Imp_sol_fr(<?php echo $id_rend; ?>)" >Imprimir Solicitud</button>
                <?php
            }

            if ($estado == "Aprobado" || $estado == "Guardado") {
                ?>    
                <button type="button" class="btn btn-info  has-feedback" style="margin-right: 0;" onclick="Imp_sol_fr(<?php echo $id_rend; ?>)" >Duplicar Solicitud</button>
            <?php } ?>
            <button type="button" class="btn btn-dark  has-feedback" style="margin-right: 0;" onclick="mostrar_fomrulario_sol_fr(0);" >Nueva Solicitud de Fondos a Rendir</button>
            <?php
            // if ($estado == "Devuelto" || $estado == "Guarsdado") {
            ?>
            <button type="button" class="btn btn-primary  has-feedback"style="margin-right: 0; " onclick="enviar_sol_fondos_rendir()">Enviar Solicitud</button>
            <?php
            // } 

            if ($estado != "Aprobado" && $estado != "Enviado") {
                ?>
                <button type="button" class="btn btn-success  has-feedback"style="margin-right: 0;" onclick="guardar_sol_cc()" id="save">Guardar Solicitud</button>
            <?php } ?>

            <button type="button" class="btn btn-danger has-feedback" style="margin-right: 0;" onclick="ocultar_fomrulario_sfr()">Cancelar</button>
        </div>

    </div>
    <script>obtener_cuentas_usuario(<?= $cuenta ?>);
        cuentadebanco();
    </script>


    <script> $('#save').button('enable');
        $('#fin_send').button('enable');</script>
    <?php
    if ($estado != "Guardado" && $estado != "Nuevo") {
        echo "<script> $('#save').button('disable');
             $('#fin_send').button('disable');</script>";
    }
    ?>


    <div id="mensaje_fin"></div>


</div>




