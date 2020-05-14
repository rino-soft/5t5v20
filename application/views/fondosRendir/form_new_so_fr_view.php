



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
    $titulo = $datos_solicitud->row()->titulo;
    $estado = $datos_solicitud->row()->estado;
    $cuenta = $datos_solicitud->row()->id_cuenta_banco;
    //echo $tipo_rendicion;
}
?>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <spam class="f20 negrilla">Registro de Solicitud de Fondos a Rendir</spam>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>

        <div id="respuesta"></div>
        <input id="id_rend" type="hidden" value="<?php echo $id_rend; ?>">


<!--            //<input class="input_redond_200" type="hidden" id="fechaS" readonly="readonly" value=" <?php //echo date("Y-m-d H:i:s");                                                               ?>" placeholder="">  -->

        <div class="col-md-12 col-sm-12 col-xs-12 espabajo5" >
            <div class='col-md-8 col-sm-8 col-xs-12'>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    Fondos a Rendir al Usuario:
                    <br>
                    <select id="tecnico_seleccionado" class="form-control" onchange="obtener_cuentas_usuario(0)" >
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


                <div class="col-md-4 col-sm-4 col-xs-12" id="cuenta_usuario">
                    Cuenta de banco del usuario:
                    <br>
                   <select class='form-control' id='cuenta_banco_usuario'>
                            <option value="0">Primero eleccione un Usuario</option>
                        </select>
                   
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    Proyecto: <br><select id="id_proy_sitio" class="form-control" onchange="cargar_sitiosproyecto();proyecto_mismo()">
                        <option value="0" > Seleccione un proyecto</option>
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
                <div class="col-md-12 col-sm-12 col-xs-12">
                    Referencia Solicitud : <input class="form-control" id="titulo" placeholder=" Titulo/referencia" value="<?= $titulo ?>">
                </div>

            </div>

            <div class='col-md-4 col-sm-4 col-xs-12'>
                <div class=" col-md-6 col-sm-6 col-xs-12 fondo_amarillo_claro centrartexto negrilla">
                    <?php if ($id_rend != 0) { ?>

                        ID Solicitud Fondos a Rendir <br>
                        <?php echo $id_rend; ?>


                    <?php }
                    ?>
                </div>
                <div class=" col-md-6 col-sm-6  col-xs-12 form-group ">
                    <div class="OK alin_cen negrilla">
                        Estado<br>
                        <?php echo $estado; ?>
                        <input type="hidden" id="estado_solicitud" value="<?=$estado?>">
                    </div>
                </div>

            </div>


        </div>

        <div class=" col-md-12 col-sm-12  col-xs-12  bg-blue form-control centrartexto">
            <spam class='f20 negrilla'>Detalle Solicitud de fondos a Rendir</spam>
            <spam class='f12'>(Registro de montos por item)</spam>
        </div>



        <!-- 
          <div class="grid_9 " >
          <div class="letraChica "> <br> Tecnico :
          <select id="tecnico_seleccionado">
        <?php
        /* foreach ($selec_tecnico->result() as $dato) {
          if ($dato->cod_user == $personal)
          echo '<option selected="selected" value="' . $dato->cod_user . '">' . $dato->ap_paterno . ' ' . $dato->ap_materno . ', ' . $dato->nombre . '</option>';
          else
          echo ' <option value="' . $dato->cod_user . '">' . $dato->ap_paterno . ' ' . $dato->ap_materno . ', ' . $dato->nombre . 's</option>';
          } */
        ?>
        
                        </select> 
                    </div>
                </div>
        
        
            </div>-->

        <div class="clear"></div>

        <div class="col-md-12 col-sm-12 col-xs-12 " style="padding: 0px;">

            <div id="grilla_modelo" class="oculto">
                <div class="bordeado col-md-12 col-sm-12 col-xs-12 esparriba5 espabajo5 fondo_plomo_claro_areas" style="position: relatsive;padding: 0px;" >

                    <input type="hidden" value="0" id="id_det_rend">        
                    <div class="gcol-md-1 col-sm-1 col-xs-12">
                        <div class="f10 negrilla centrartexto">
                            item
                        </div>
                        <div class="esparriba5 centrartexto f16 negrilla">
                            XX
                        </div>

                    </div>
                    <div class="gcol-md-4 col-sm-4 col-xs-12" id="gasto_bloque">
                        <div class="f10 negrilla centrartexto">Detalle </div>
                        <textarea id="detalle_factura" class="form-control" style=" height: 35px;font-size: 12px;padding: 0px;"></textarea>
                    </div> 
                    <div class="gcol-md-2 col-sm-2 col-xs-12 centrartexto" title="ingrese el monto  Bs">
                        <div class="f10 negrilla centrartexto">Monto (bs)</div>
                        <input class="form-control centrartexto"     type="number" id="monto" onkeyup="val_numero('drXX #monto');sumar_total_rend()"   value="<?php //echo $monto                                                                                              ?>">

                    </div>
                    <div class="gcol-md-2 col-sm-2 col-xs-12 centrartexto" >
                        <div class="gcol-md-12 col-sm-12 col-xs-12 f10 negrilla centrartexto ">Proyecto</div>
                        <div class='gcol-md-12 col-sm-12 col-xs-12 '>
                            <select id="id_proy_sitio_detalle" class="form-control proyecto_mismo_detalle" onchange="cargar_sitiosproyectodetalle(XX)">
                                <option value="0" > Seleccione un proyecto</option>
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
                    </div>
                    <div class="gcol-md-2 col-sm-2 col-xs-12 centrartexto" >
                        <div class="gcol-md-12 col-sm-12 col-xs-12 f10 negrilla centrartexto ">Estacion/Sitio</div>
                        <div class='gcol-md-12 col-sm-12 col-xs-12 sitioselect_carga'>
                            <?= $sitios ?>
<!--                            <input class="input_redond_100_c estsit" style="margin-top: 0px; width: 148px;"    type="text" id="estacion_sitio" placeholder="Buscar estacion" value="">
                            <script>$("#drXX #estacion_sitio").autocomplete({source: etiquetas});</script>-->

                        </div>
                    </div>

                    <div class=" gcol-md-1 col-sm-1 col-xs-12 " style="margin-top: 15px; width: 20px;">
                        <div class="delete_ico milink" onclick="del_registro_rendicion('XX')" title="Borrar Registro de factura"></div>
                    </div>


                </div>
                <div class="gcol-md-12 col-sm-12 col-xs-12" style="padding-bottom:  2px;"></div>
            </div>

            <input type="hidden" id="nro_reg" value="0">
            <input type="hidden" id="items_select" value="0">
            <?php
            $sumador = 0.00;
            $subsumador = 0.00;
            //    $titulos = array("TRA-08 A *FACTURAS*", "TRA-08 B *RECIBOS*", "SGR-17 A *FACTURAS*", "SGR-17 B *RECIBOS*", "SRG-17 C *FACTURAS*");
            //   $detalletitulo = array("datos_rendicion_detalle_traA", "datos_rendicion_detalle_traB", "datos_rendicion_detalle_sgrA", "datos_rendicion_detalle_sgrB", "datos_rendicion_detalle_sgrC");
            // $sumas = array(0, 0, 0, 0, 0);
            // $contadores = array(0, 0, 0, 0, 0);
            ?>

            <div class="col-md-12 col-sm-12 col-xs-12" id="add_nuevo_rendicion" style="padding: 0px;">  
                <input type="hidden" id="det_delete">
                <?php
                if ($id_rend != 0) {

                    $cont = 0;
                    $cadena = "0";

                    // for ($i = 0; $i < count($titulos); $i++) {
//                        $datos_rendicion_detalle_traA = $detalle[$detalletitulo[$i]];
//                        $contadores[$i] = $datos_rendicion_detalle_traA->num_rows();

                    if ($detalle_solicitud->num_rows() > 0) {

                        //  $item=1;
                        foreach ($detalle_solicitud->result() as $fila) {
                            $cont++;
                            $cadena.="," . $cont;
                            ?>
                            <div id="dr<?php echo $cont; ?>" class="">
                                <div class="gcol-md-12 col-sm-12 col-xs-12 esparriba5 espabajo5 fondo_azulclaro_c_borde" style="position: relative;padding: 0px;">
                                    <input type="hidden" value="<?= $fila->idsol_frendir_detalle ?>" id="id_det_rend"> 
                                    <div class="gcol-md-1 col-sm-1 col-xs-12">
                                        <div class="f10 negrilla centrartexto">
                                            item
                                        </div>
                                        <div class="esparriba5 centrartexto f16 negrilla">
                                            <?= $cont ?>
                                        </div>

                                    </div>
                                    <div class="gcol-md-4 col-sm-4 col-xs-12" id="gasto_bloque">
                                        <div class="f10 negrilla centrartexto">Detalle </div>
                                        <textarea id="detalle_factura" class="form-control" style=" height: 35px;font-size: 12px;padding: 0px;"><?= $fila->detalle ?></textarea>
                                    </div> 

                                    <div class="gcol-md-2 col-sm-2 col-xs-12 centrartexto" title="ingrese el monto  Bs">
                                        <div class="f10 negrilla centrartexto">Monto (bs)</div>
                                        <input class="form-control centrartexto"     type="number" id="monto" onkeyup="val_numero('dr<?= $cont ?> #monto');sumar_total_rend()"   
                                               value="<?php echo $fila->monto_detalle; ?>">

                                    </div>
                                    <div class="gcol-md-2 col-sm-2 col-xs-12 centrartexto" >
                                        <div class="gcol-md-12 col-sm-12 col-xs-12 f10 negrilla centrartexto ">Proyecto</div>
                                        <div class='gcol-md-12 col-sm-12 col-xs-12 '>
                                            <select id="id_proy_sitio_detalle" class="form-control proyecto_mismo_detalle" onchange="cargar_sitiosproyectodetalle(<?= $cont ?>)">
                                                <option value="0" > Seleccione un proyecto</option>
                                                <?php
                                                foreach ($selec_proyecto->result() as $dato) {
                                                    if ($dato->id_proy == $fila->id_proy)
                                                        echo '<option selected="selected" value="' . $dato->id_proy . '">' . $dato->nombre . '</option>';
                                                    else
                                                        echo ' <option value="' . $dato->id_proy . '">' . $dato->nombre . '</option>';
                                                }
                                                ?>

                                            </select>

                                        </div>
                                    </div>

                                    <div class="gcol-md-2 col-sm-2 col-xs-12 centrartexto" >
                                        <div class="gcol-md-12 col-sm-12 col-xs-12 f10 negrilla centrartexto ">Estacion/Sitio</div>
                                        <script>cargar_sitiosproyectodetalle(<?= $cont ?>);</script>
                                        <div class='gcol-md-12 col-sm-12 col-xs-12 sitioselect_carga'>


                                        </div>
                                    </div>

                                    <div class=" gcol-md-1 col-sm-1 col-xs-12 " style="margin-top: 15px; width: 20px;">
                                        <div class="delete_ico milink" onclick="del_registro_detalle('<?= $cont ?>')" title="Borrar Registro de factura"></div>
                                    </div>

                                </div>






                            </div>

                            <div class="gcol-md-12 col-sm-12 col-xs-12" style="padding-bottom:  2px;"></div>

                            <?php
                            $sumador+= $fila->monto_detalle;
                            //$subsumador+= $fila->monto;
                        }
                        ?>
                    </div>              
                    <?php
                }
                // }
                ?>


                <script>
                    $("#nro_reg").val('<?php echo $cont ?>');
                    $('#muestra_cuenta').html(<?php echo $cont ?>);
                    $("#items_select").val('<?php echo $cadena ?>');
                </script>
                <?php
            } else {
                ?>
                <script>
                    //setTimeout(function () {
                    add_registro();
                    //}, 2000);//alert('funciona');                
                </script>
            <?php }
            ?>
        </div>




    </div>

    <div class="col-md-12 col-sm-12 col-xs-12 ">
        <div class="col-md-5 col-sm-5 col-xs-12  f20 alin_der">T O T A L .- </div>
        <div class="col-md-2 col-sm-2 col-xs-12 negrilla f20" id="monto_total_rendicion">
            <?php echo number_format($sumador, 2, ".", ","); ?>
        </div>  
        <div class="col-md-2 col-sm-2 col-xs-12 form-group bordeado">
            <div class="col-md-4 col-sm-4 col-xs-12 form-group negrilla f16 alin_der" id="muestra_cuenta">
                0
            </div>
            <div class=" col-md-8 col-sm-8 col-xs-12 form-group alin_izq f12">
                Lineas agregadas
            </div>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-12 form-group">

            <?php if ($estado == "Guardado" || $estado == "Nuevo") { ?>
                <div class="boton centrartexto milink negrilla " style="float: right" onclick="add_registro()">Agregar nuevo Detalle</div>
            <?php } ?>

        </div>
    </div>  


    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
        <label for="message">Descripcion General de la Solicitud de Fondos a Rendir :</label>
        <textarea id="desc" required="required" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="0" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.."
                  data-parsley-validation-threshold="10"><?= $desc ?></textarea>
    </div>




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
        <?php // } 
        
        if ($estado != "Aprobado" && $estado != "Enviado") {
            ?>
        <button type="button" class="btn btn-success  has-feedback"style="margin-right: 0;" onclick="guardar_sol_fondos_rendir()">Guardar Solicitud</button>
        <?php } ?>

        <button type="button" class="btn btn-danger has-feedback" style="margin-right: 0;" onclick="ocultar_fomrulario_sfr()">Cancelar</button>
    </div>
    
</div>
<script>obtener_cuentas_usuario(<?=$cuenta?>)</script>
<script> $('#save').button('enable');
    $('#fin_send').button('enable');</script>
<?php
if ($estado != "Guardado" && $estado != "Nuevo") {
    echo "<script> $('#save').button('disable');
             $('#fin_send').button('disable');</script>";
}
?>
</div>
<div id="mensaje_fin"></div>
</div>
</div>
<!-- PNotify -->
<link href="<?php echo base_url(); ?>vendors/pnotify/dist/pnotify.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">








