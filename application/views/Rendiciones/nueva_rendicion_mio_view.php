



<?php
$monto = "";
/// $nro_fact="";
$desc = "";
$asignado = "";
$personal = "";
$tipo_rendicion = "";
$estado = "Nuevo";
if ($id_rend != 0) {
    $monto = $datos_rendicion->row()->monto;
    // $nro_fac=$datos_rendicion->row()->monto;
    $desc = $datos_rendicion->row()->observacion;
    $asignado = $datos_rendicion->row()->id_proy;
    $personal = $datos_rendicion->row()->id_tecnico_asignado;
    $tipo_rendicion = $datos_rendicion->row()->tipo_rend;
    $estado = $datos_rendicion->row()->estado;
    //echo $tipo_rendicion;
}
?>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">

            <spam class="f20 negrilla">Registro de Rendicion </spam>

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


<!--            //<input class="input_redond_200" type="hidden" id="fechaS" readonly="readonly" value=" <?php //echo date("Y-m-d H:i:s");                                                         ?>" placeholder="">  -->

        <div class="col-md-12 col-sm-12 col-xs-12" >
            <div class='col-md-9 col-sm-9 col-xs-12'>
                <div class="col-md-2 col-sm-2 col-xs-12">
                    Tipo : <input class="form-control" readonly="readonly" id="tipo_rendicion" value="<?=$tipo?>">
                    
                </div>
                <div class="col-md-2 col-sm-2 col-xs-12">
                    documento Relacionado : <input class="form-control" id="documento" readonly="readonly" value="<?=$id_doc?>">
                    <input type="hiidden" id="tabla_documento"  value="<?=$datos_id_doc->row()->tabla;?>">
                    
                </div>
                <div class="col-md-2 col-sm-2 col-xs-12">
                    Saldo Asociado: <input class="form-control" id="monto_documento" readonly="readonly" value="<?=$datos_id_doc->row()->saldo;?>">
                    
                </div>
                

                <div class="col-md-4 col-sm-4 col-xs-12">
                    <span style="color:red">Proyecto</span> relacionado a la Caja Chica/Fondos a Rendir: <br><select id="id_proy_sitio" class="form-control" onchange="cargar_sitiosproyecto()"  >
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

                <div class="ocultar">
                    <select id="tecnico_seleccionado" class="form-control" >
                        <option value="<?= $data_user->cod_user; ?>" > <?= $data_user->nombre . " " . $data_user->ap_paterno; ?> </option>
                    </select>
                </div>






            </div>
            <div class='col-md-3 col-sm-3 col-xs-12'>
                <div class=" col-md-6 col-sm-6 col-xs-12 fondo_amarillo_claro centrartexto negrilla">
                    <?php if ($id_rend != 0) { ?>

                        ID Rendicion <br>
                        <?php echo $id_rend; ?>


                    <?php }
                    ?>
                </div>
                <div class=" col-md-6 col-sm-6  col-xs-12 form-group ">
                    <div class="OK alin_cen negrilla">
                        Estado<br>
                        <?php echo $estado; ?>
                    </div>
                </div>

            </div>

            <div class="clearfix"></div>
        </div>


       

        <div class=" col-md-12 col-sm-12  col-xs-12  btn-success form-control centrartexto">
            <spam class='f16 negrilla'>Detalle Rendicion</spam>
            <spam class='f12'>(Registro de Facturas)</spam>
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
                            Tipo de gastos
                        </div>
                        <div class="esparriba5">
                            <select class="form-control  "  id="tipo_gasto_for" style="padding: 0px; font-size: 12px;" 
                                    onchange="mostrar_placa_numero('drXX #tipo_gasto_for', 'div_campoXX', '');carga_tipo_gasto('drXX #tipo_gasto_for', 'selec_tipo_servg', 'drXX #gasto_bloque', 0);">
                                <option value="-1" selected="selected">seleccione...</option>
                                <option value="1"> Transporte </option>
                                <option value="2"> Operativos </option>
                                <option value="3"> Telefonia </option>
                            </select> 
                        </div>
                        <div id="div_campoXX" >

                        </div>

                    </div>
                    <div class="gcol-md-2 col-sm-2 col-xs-12" id="gasto_bloque">
                        <div class="gcol-md-12 col-sm-12 col-xs-12 f10 negrilla  centrartexto">
                            Apropiacion
                        </div>
                        <div class="gcol-md-12 col-sm-12 col-xs-12 esparriba5 centrartexto f10">
                            debe seleccionar el tipo de gasto
      <!--                        <script>carga_tipo_gasto('tipo_gasto_for', 'selec_tipo_servg', 'gasto_bloque', 0);</script>-->
                        </div>
                    </div> 
                    <div class="gcol-md-1 col-sm-1 col-xs-12 centrartexto" style="width: 75px;">
                        <input id='id_apropiacion' type="hidden" value='0'>
                        <div class="f10 negrilla centrartexto">C/Fac</div>
                        <div style="" title="Check si el registro es de una Factura">SI <input  type="checkbox" name="resp"  id="fac" onclick="ver_campo_nro_factura('drXX #fac', 'drXX #campo_nro_factura')"  ></div>
                        <div class="centrartexto ocultar" id="campo_nro_factura" style="width: 75px;" title="ingrese el numero de factura">
                            <input class="form-control f10" placeholder="Nro Factura" style="padding: 1px;margin-top: 0px; " type="text" id="nro_fact"  value="">
                        </div>
                    </div>

                    <div class="gcol-md-1 col-sm-1 col-xs-12 centrartexto" style="width: 75px;" title="ingrese la fecha de factura">
                        <div class="f10 negrilla centrartexto">Fecha Fac</div>
                        <input class="form-control " style="margin-top: 0px; width: 69px; font-size: 10px; padding: 5 0 5 0;" type="text" id="fec_factXX"  value="<?php echo date('Y/m/d'); ?>">
                    </div>



                    <div class="gcol-md-1 col-sm-1 col-xs-12 centrartexto" style="width: 75px; " title="ingrese el monto de la Factura en Bs">
                        <div class="f10 negrilla centrartexto">Monto (bs)</div>
                        <input class="form-control" style="margin-top: 0px; width: 69px;"    type="text" id="monto" onkeyup="val_numero('drXX #monto');sumar_total_rend()"   value="<?php //echo $monto                                                                                        ?>">

                    </div>
                    <div class="gcol-md-2 col-sm-2 col-xs-12 centrartexto" title="ingrese el detalle de la factura">
                        <div class="f10 negrilla centrartexto">Detalle Factura</div>
                        <textarea id="detalle_factura" class="form-control" style=" height: 35px;font-size: 10px;padding: 0px;"></textarea>
                    </div>

                    <div class="gcol-md-1 col-sm-1 col-xs-12 centrartexto">
                        <div class="f10 negrilla centrartexto">Cobrar Cliente</div>
                        <div>SI <input  type="checkbox" name="resp"  value="1" id="cobrar_cliente" ></div>
                    </div>

                    <div class="gcol-md-1 col-sm-1 col-xs-12 centrartexto" >
                        <div class="gcol-md-12 col-sm-12 col-xs-12 f10 negrilla centrartexto ">Estacion/Sitio</div>
                        <div class='gcol-md-12 col-sm-12 col-xs-12 sitioselect_carga'>
                            <?= $sitios ?>
    <!--                            <input class="input_redond_100_c estsit" style="margin-top: 0px; width: 148px;"    type="text" id="estacion_sitio" placeholder="Buscar estacion" value="">
                            <script>$("#drXX #estacion_sitio").autocomplete({source: etiquetas});</script>-->

                        </div>
                    </div>


                    <div class="gcol-md-2 col-sm-2 col-xs-12" >
                        <input type="hidden" id="adjuntos_rutasXX">
                        <div class="ocultar">
                            <form id="fileformXX" enctype="multipart/form-data" method="POST">
                                <input type="file" id="userfileXX"  name="userfile"  
                                       style="padding-left: 30px" title="Subir Archivo" onchange="subir_archivo_rend('XX');" >
                            </form>
                        </div>
                        <div class="ocultar" id="dialog_div_uploadXX">

                        </div>
                        <div class="f10 negrilla centrartexto milinktext" title="Click para adjuntar archivos" onclick="$('#userfileXX').trigger('click');">Archivos adjuntos</div>
                        <div class="f10" id="adjuntosXX"><br></div>


                    </div>
                    <div class=" gcol-md-1 col-sm-1 col-xs-12 " style="margin-top: 15px; width: 20px;">
                        <div class="delete_ico milink" onclick="del_registro_rendicion('XX')" title="Borrar Registro de factura"></div>
                    </div>
                    <div class="negrilla f18" style=" color:#7EB5EA ; position: absolute;right: 2px; bottom: 2px;">
                        XX
                    </div>


                </div>
                <div class="gcol-md-12 col-sm-12 col-xs-12" style="padding-bottom:  2px;"></div>
            </div>

            <input type="hidden" id="nro_reg" value="0">
            <input type="hidden" id="items_select" value="0">
            <?php
            $sumador = 0.00;
            $subsumador = 0.00;
            $titulos = array("TRA-08 A *FACTURAS*", "TRA-08 B *RECIBOS*", "SGR-17 A *FACTURAS*", "SGR-17 B *RECIBOS*", "SRG-17 C *FACTURAS*");
            $detalletitulo = array("datos_rendicion_detalle_traA", "datos_rendicion_detalle_traB", "datos_rendicion_detalle_sgrA", "datos_rendicion_detalle_sgrB", "datos_rendicion_detalle_sgrC");
            $sumas = array(0, 0, 0, 0, 0);
            $contadores = array(0, 0, 0, 0, 0);
            ?>

            <div class="col-md-12 col-sm-12 col-xs-12" id="add_nuevo_rendicion" style="padding: 0px;">  
                <input type="hidden" id="det_delete">
                <?php
                if ($id_rend != 0) {

                    $cont = 0;
                    $cadena = "0";

                    for ($i = 0; $i < count($titulos); $i++) {

                        $datos_rendicion_detalle_traA = $detalle[$detalletitulo[$i]];
                        $contadores[$i] = $datos_rendicion_detalle_traA->num_rows();

                        if ($datos_rendicion_detalle_traA->num_rows() > 0) {
                            ?>
                            <div class="f16 colorcel negrilla espabajo5"><?= $titulos[$i] ?> </div>
                            <?php
                            foreach ($datos_rendicion_detalle_traA->result() as $fila) {
                                $cont++;
                                $cadena.="," . $cont;
                                ?>
                                <div id="dr<?php echo $cont; ?>" class="">
                                    <div class="gcol-md-12 col-sm-12 col-xs-12 esparriba5 espabajo5 fondo_azulclaro_c_borde" style="position: relative;padding: 0px;">
                                        <input type="hidden" value="<?= $fila->id_det ?>" id="id_det_rend"> 
                                        <div class="gcol-md-1 col-sm-1 col-xs-12">
                                            <div class="f10 negrilla ">
                                                Tipo de Gastos
                                            </div>
                                            <div class="esparriba5">
                                                <select class="form-control "  style="padding: 0px; font-size: 12px;" id="tipo_gasto_for" onchange="mostrar_placa_numero('dr<?php echo $cont; ?> #tipo_gasto_for', 'div_campo<?php echo $cont; ?> ', '<?php echo $fila->placa_vehiculo; ?>');carga_tipo_gasto('dr<?php echo $cont . ''; ?> #tipo_gasto_for', 'selec_tipo_servg', 'dr<?php echo $cont; ?> #gasto_bloque', 0);">
                                                    <option value="-1"  >seleccione...</option>
                                                    <option value="1" <?php if ($fila->tipo == "tra") echo "selected='selected' "; ?> > Transporte </option>
                                                    <option value="2" <?php if ($fila->tipo == "sgr") echo "selected='selected' "; ?> > Operativo </option>
                                                    <option value="3" <?php if ($fila->tipo == "tel") echo "selected='selected' "; ?> > Telefonia </option>
                                                </select> 
                                            </div>
                                            <div id="div_campo<?php echo $cont; ?>" >

                                            </div>
                                            <script>mostrar_placa_numero('dr<?php echo $cont; ?>  #tipo_gasto_for', 'div_campo<?php echo $cont; ?> ', '<?php echo $fila->placa_vehiculo; ?>');</script>

                                        </div>
                                        <div class="gcol-md-2 col-sm-2 col-xs-12" id="gasto_bloque">
                                            <div class="gcol-md-12 col-sm-12 col-xs-12 f10 negrilla  centrartext">
                                                Apropiacion
                                            </div>
                                            <div class="gcol-md-12 col-sm-12 col-xs-12 f10 negrilla  centrartext">
                                                debe seleccionar el tipo de gasto
                                            </div>
                                        </div>
                                        <script> carga_tipo_gasto('dr<?php echo $cont; ?> #tipo_gasto_for', 'selec_tipo_servg', 'dr<?php echo $cont; ?> #gasto_bloque',<?php echo $fila->id_tipo_gasto; ?>);</script>

                                        <div class="gcol-md-1 col-sm-1 col-xs-12 centrartexto " style="width: 75px;">
                                            <input id='id_apropiacion' type="hidden" value='<?php echo $fila->id_tipo_gasto; ?>'>
                                            <div class="f10 negrilla centrartexto">C/Fac</div>
                                            <div style="" title="Check si el registro es de una Factura">SI <input  type="checkbox" name="resp"  value="1" id="fac" <?php if ($fila->c_s_factura == 1) echo'checked="checked"'; ?> onclick="ver_campo_nro_factura('dr<?php echo $cont; ?> #fac', 'dr<?php echo $cont; ?> #campo_nro_factura');"  ></div>
                                            <div class="centrartexto ocultar" id="campo_nro_factura" style="width: 75px;" title="ingrese el numero de factura">
                                                <input class="form-control  f10" placeholder="Nro Factura" style="padding: 1px;margin-top: 0px; width: 69px;" type="text" id="nro_fact"  value="<?php echo $fila->nro_fac; ?>">
                                            </div>
                                            <script>ver_campo_nro_factura('dr<?php echo $cont; ?> #fac', 'dr<?php echo $cont; ?> #campo_nro_factura');</script>
                                        </div>


                                        <div class="gcol-md-1 col-sm-1 col-xs-12 centrartexto" style="width: 75px;" title="ingrese la fecha de factura">
                                            <div class="f10 negrilla centrartexto">Fecha Fac</div>
                                            <input class="form-control " style="margin-top: 0px; width: 69px; font-size: 10px; padding: 7 0 7 0;" type="text" id="fec_fact<?php echo $cont; ?>"  value="<?php echo $fila->fecha_factura; ?>">
                                            <script>
                                                $("#fec_fact<?php echo $cont; ?>").datepicker();
                                            </script>
                                        </div>

                                        <div class="gcol-md-1 col-sm-1 col-xs-12 centrartexto" style="width: 75px; " title="ingrese el monto de la Factura en Bs">
                                            <div class="f10 negrilla centrartexto">Monto (bs)</div>
                                            <input class="form-control " style="margin-top: 0px; width: 69px;"    type="text" id="monto" onkeyup="val_numero('dr<?php echo $cont; ?> #monto'); sumar_total_rend()"   value="<?php echo $fila->monto; ?>">

                                        </div>
                                        <div class="gcol-md-2 col-sm-2 col-xs-12" title="ingrese el detalle de la factura">
                                            <div class="f10 negrilla centrartexto">Detalle Factura</div>
                                            <textarea id="detalle_factura" class="form-control" style=" height: 35px;font-size: 10px; padding: 0px"><?php echo $fila->glosa; ?></textarea>
                                        </div>

                                        <div class="gcol-md-1 col-sm-1 col-xs-12 ">
                                            <div class="f10 negrilla centrartexto">Cobrar Cliente</div>
                                            <div>SI <input  type="checkbox" name="resp"  value="1" id="cobrar_cliente" <?php if ($fila->cobrar_cliente == 1) echo'checked="checked"'; ?>  ></div>
                                        </div>

                                        <div class="gcol-md-2 col-sm-2 col-xs-12"style="width: 148px;">
                                            <div class="f10 negrilla centrartexto ">Estacion/Sitio</div>
                                            <div class='sitioselect_carga'>
                                                <?php
                                                echo str_replace('\'' . $fila->estacion . '\'', ' \'' . $fila->estacion . '\' selected=\'selected\'', $sitios);
                                                ?>

                                            </div>
                                        </div>

                                        <div class="gcol-md-2 col-sm-2 col-xs-12" title="archivos adjuntos">



                                            <input type="hidden" id="adjuntos_rutas<?php echo $cont; ?>" value="<?php echo $fila->adjuntos; ?>">

                                            <div class="ocultar">
                                                <form id="fileform<?php echo $cont; ?>" enctype="multipart/form-data" method="POST">
                                                    <input type="file" id="userfile<?php echo $cont; ?>"  name="userfile"  
                                                           style="padding-left: 30px" title="Subir Archivo" onchange="subir_archivo_rend('<?php echo $cont; ?>');" >
                                                </form>
                                            </div>
                                            <div class="ocultar" id="dialog_div_upload<?php echo $cont; ?>">

                                            </div>
                                            <div class="f10 negrilla centrartexto milinktext" title="Click para adjuntar archivos" ><spam onclick="$('#userfile<?php echo $cont; ?>').trigger('click');">Archivos adjuntos</spam></div>

                                            <div class="f10" id="adjuntos<?php echo $cont; ?>">
                                                <?php
                                                $adj = explode("|", $fila->adjuntos);
                                                for ($j = 1; $j < count($adj); $j++) {
                                                    ?>
                                                    <div id="<?php echo str_replace(".", "", $adj[$j]); ?>dmd">
                                                        <div class='milinktextm' style='float:right;' onclick='ver_archivo("uploads/doc_rendicion/<?php echo $adj[$j] ?>", "<?php echo $adj[$j]; ?>")'>
                                                            <?php echo substr($adj[$j], 0, 19); ?>
                                                        </div >
                                                        <div title="quitar Adjunto" onclick='del_arch_adj("<?php echo $adj[$j]; ?>", "<?php echo $cont; ?>")' class='negrilla colorRojo t14 milinktext' style='float:left; margin:0 5 0 5;'>
                                                            X
                                                        </div>

                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>

                                        </div>


                                        <div class=" gcol-md-1 col-sm-1 col-xs-12 " style="margin-top: 15px; width: 20px;">
                                            <div class="delete_ico milink" onclick="del_registro_rendicion('<?php echo $cont; ?>');
                                                    sumar_total_rend()" title="Borrar Registro de factura"></div>
                                        </div>
                                        <div class="negrilla f18" style=" color:#7EB5EA ; position: absolute;right: 2px; bottom: 2px;">
                                            <?php echo $cont; ?>
                                        </div>




                                    </div>
                                </div>
                                <div class="gcol-md-12 col-sm-12 col-xs-12" style="padding-bottom:  2px;"></div>
                                <?php
                                $sumador+= $fila->monto;
                                $subsumador+= $fila->monto;
                            }
                            $sumtraA = $subsumador;
                            $sumas[$i] = $subsumador;
                            $subsumador = 0;
                            ?>

                            <div class="col-md-12 col-sm-12 col-xs-12 f14 negrilla fondoazul colorBlanco">
                                <div class=" col-md-4 col-sm-4 col-xs-12 alin_der " id="">SUBTOTAL .- </div><div class="col-md-5 col-sm-5 col-xs-12"><?php echo number_format($sumas[$i], 2, ".", ","); ?></div>
                                <div class="grid_10"></div>
                            </div>  
                            <?php
                        }
                    }
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
                    <div class="boton centrartexto milink negrilla " style="float: right" onclick="add_registro()">Agregar nuevo Registro de Factura</div>
                <?php } ?>

            </div>
        </div>  


        <div class="col-md-6 col-sm-6 col-xs-12 form-group">
            <label for="message">Descripcion General de la Rendicion :</label>
            <textarea id="desc" required="required" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="0" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.."
                      data-parsley-validation-threshold="10"><?= $desc ?></textarea>
        </div>

        <div class="col-md-6 col-sm-6 col-xs-12 form-group f12">
            <?php if ($id_rend != 0) {
                ?>

                <div class="col-md-12 col-sm-12 col-xs-12negrilla centrartexto negrilla f14" >Resumen de Rendicion</div>
                <div class="col-md-12 col-sm-12 col-xs-12 centrartexto f10 ">
                    <div class="col-md-12 col-sm-12 col-xs-12 fondoazul colorBlanco negrilla bordeado">
                        <div class="col-md-4 col-sm-4 col-xs-12">Formulario</div>
                        <div class="col-md-4 col-sm-4 col-xs-12">Cantidad Factura/recibos</div>
                        <div class="col-md-4 col-sm-4 col-xs-12">Subtotal (bs)</div>

                    </div>
                    <?php
                    $sumasgrandes = 0;
                    $contadogrande = 0;
                    $sstil = "fondo_plomo_claro_areas";
                    for ($k = 0; $k < count($titulos); $k++) {
                        $sumasgrandes+=$sumas[$k];
                        $contadogrande+=$contadores[$k];
                        if ($sstil == "fondo_plomo_claro_areas")
                            $sstil = "";
                        else
                            $sstil = "fondo_plomo_claro_areas";
                        ?>
                        <div class="col-md-12 col-sm-12 col-xs-12 <?= $sstil ?>">
                            <div class="col-md-4 col-sm-4 col-xs-12 negrilla "><?= $titulos[$k] ?></div>
                            <div class="col-md-4 col-sm-4 col-xs-12"  <?php
                            $color = 'color:black';
                            if ($contadores[$k] > 0) {
                                $color = "color:red; font-weight: bold;font-size: 14px;";
                            }
                            ?> style='<?= $color ?>' ><?php echo $contadores[$k]; ?></div>
                            <div class="col-md-4 col-sm-4 col-xs-12 alin_der" style='<?= $color ?>'><?php echo number_format($sumas[$k], 2, ".", ","); ?></div>
                        </div>

                    <?php } ?>
                    <div class="col-md-12 col-sm-12 col-xs-12 fondoazul colorBlanco f14 negrilla bordeado">
                        <div class="col-md-4 col-sm-4 col-xs-12">TOTAL</div>
                        <div class="col-md-4 col-sm-4 col-xs-12"><?php echo $contadogrande ?></div>
                        <div class="col-md-4 col-sm-4 col-xs-12 alin_der"><?php echo number_format(($sumasgrandes), 2, ".", ","); ?></div>
                    </div >
                </div >



                <?php
            }
            ?>
        </div>


        <div class="col-md-12 col-sm-12 col-xs-12 form-group alin_der">
            <button type="button" class="btn btn-dark  has-feedback" style="margin-right: 0;" onclick="mostrar_fomrulario_nueva_rendicion_terceros(0);" >Nueva Rendicion</button>
            <button type="button" class="btn btn-warning  has-feedback"  style="margin-right: 0;" onclick="Imp_reporte_de_rendicion(<?php echo $id_rend; ?>)" >Imprimir Rendicion</button>
            <button type="button" class="btn btn-primary  has-feedback"style="margin-right: 0;" onclick="guardar_registro_rendicion()">Finalizar Rendicion</button>
            <button type="button" class="btn btn-success  has-feedback"style="margin-right: 0;" onclick="guardar_registro_rendicion()">Guardar Rendicion</button>


            <button type="button" class="btn btn-danger has-feedback" style="margin-right: 0;" onclick="ocultar_fomrulario_rendiciones()">Cancelar</button>
        </div>
    </div>

</div>
<div id="mensaje_fin"></div>
</div>
</div>
<!-- PNotify -->
<link href="<?php echo base_url(); ?>vendors/pnotify/dist/pnotify.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">








