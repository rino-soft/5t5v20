



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
    $ids_resp = $datos_rendicion->row()->id_responsable_proy;
    $ids_vobos = $datos_rendicion->row()->ids_vobos;
    $id_me = $this->session->userdata('id_admin');
    //echo $tipo_rendicion;
}
?>

<div class="">

    <div id="respuesta"></div>
    <input id="id_rend" type="hidden" value="<?php echo $id_rend; ?>">
    <input id="ids_responsables" type="hidden" title="id_responsables" value="<?php echo $ids_resp; ?>">
    <input id="ids_vobos" type="hidden" title="id_vobos" value="<?php echo $ids_vobos; ?>">
    <input id="mi_id" type="hidden" title="mi id"value="<?php echo $id_me; ?>">

    
<!--            //<input class="input_redond_200" type="hidden" id="fechaS" readonly="readonly" value=" <?php //echo date("Y-m-d H:i:s"); ?>" placeholder="">  -->
        
    <div class="grid_10" >
        <div class="grid_10 " >
            <div class="letraChica "> Proyecto :
                <select id="proyecto_seleccionado" style="width: 300px;">
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
        <div class="grid_10">
            Tipo : 

            <select id="tipo_rendicion">
                <option value="Rendicion" <?php if ($tipo_rendicion == "Rendicion") echo "selected='selected'"; ?> > Rendicion de fondos</option>
                <option value="Reembolso" <?php if ($tipo_rendicion == "Reembolso") echo "selected='selected'"; ?> > Reembolso de gastos</option>
            </select>
        </div>


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
    <div class="grid_10">
        <div class="grid_5 ">
            <?php if ($id_rend != 0) { ?>
                <div class="grid_4 fondo_amarillo_claro ">
                    <div class="grid_1 f10 negrilla centrartexto">ID Rendicion</div>
                    <div class="grid_3 f18 negrilla centrartexto"><?php echo $id_rend; ?></div>
                </div>

            <?php }
            ?>
            <div class="grid_5 ">
                <div class="grid_4 OK">
                    <div class="grid_1 f10 negrilla centrartexto">Estado</div>
                    <div class="grid_3 f10 negrilla centrartexto"><?php echo $estado; ?></div>
                </div>
            </div>
        </div>
        <div class=" grid_5  ">
            <div class="grid_5">
            <div class="grid_5 negrilla f10">Pertenece a :</div>
            <div class="grid_5 negrilla"><?php echo $d_tecnico->nombre." ".$d_tecnico->ap_paterno." ".$d_tecnico->ap_materno;?></div>
            </div>
            <?php if ($estado == "Guardado" || $estado == "Nuevo"){?>
            <div class="boton centrartexto milink" onclick="add_registro()">Agregar nuevo Registro de Factura</div>
            <?php }?>
        </div>
    </div>

    <div class="clear"></div>

    <div class="grid_20 ">

        <div id="grilla_modelo" class="oculto">
            <div class="bordeado grid_20 esparriba5 espabajo5 fondo_plomo_claro_areas"> 
                <div class="grid_2">
                    <div class="letraChica negrilla centrartexto">
                        Tipo de gastos
                    </div>
                    <div class="esparriba5">
                        <select style="width: 95px;" id="tipo_gasto_for" onchange="carga_tipo_gasto('drXX #tipo_gasto_for', 'selec_tipo_servg', 'drXX #gasto_bloque', 0);">
                            <option value="-1">seleccione...</option>
                            <option value="1"> Transporte </option>
                            <option value="2"> Operativos </option>
                            <option value="3"> Telefonia </option>
                        </select> 
                    </div>
                </div>
                <div class="grid_3" id="gasto_bloque">
                    <div class="letraChica negrilla  centrartexto">
                        Apropiacion
                    </div>
                    <div class="esparriba5">
                        <select id="selec_tipo_servg">
                            <option value="0">seleccione tipo...</option>
                        </select>
                        <script>carga_tipo_gasto('tipo_gasto_for', 'selec_tipo_servg', 'gasto_bloque', 0);</script>
                    </div>
                </div> 
                <div class="grid_1 ">
                    <div class="letraChica negrilla centrartexto">C/Fac</div>
                    <div style="margin-top: 7px" title="Check si el registro es de una Factura">SI <input  type="checkbox" name="resp"  value="1" id="fac"  ></div>
                </div>

                <div class="grid_2 centrartexto" style="width: 75px;" title="ingrese la fecha de factura">
                    <div class="letraChica negrilla centrartexto">Fecha Fac</div>
                    <input class="input_redond_100_c" style="margin-top: 0px; width: 69px; font-size: 10px; padding: 7 0 7 0;" type="text" id="fec_factXX"  value="<?php //echo nro_fact;                                ?>">




                </div>

                <div class="grid_2 centrartexto" style="width: 75px;" title="ingrese el numero de factura">
                    <div class="letraChica negrilla centrartexto">Nro Fac</div>
                    <input class="input_redond_100_c" style="margin-top: 0px; width: 69px;" type="text" id="nro_fact"  value="<?php //echo nro_fact;                                ?>">
                </div>

                <div class="grid_2 centrartexto" style="width: 75px; " title="ingrese el monto de la Factura en Bs">
                    <div class="letraChica negrilla centrartexto">Monto (bs)</div>
                    <input class="input_redond_100_c" style="margin-top: 0px; width: 69px;"    type="text" id="monto" onkeyup="val_numero('drXX #monto');sumar_total_rend()"   value="<?php //echo $monto                                ?>">

                </div>
                <div class="grid_3" title="ingrese el detalle de la factura">
                    <div class="letraChica negrilla centrartexto">Detalle Factura</div>
                    <textarea id="detalle_factura" style="width: 145px; height: 27px;font-size: 10px;"></textarea>
                </div>
                <div class="grid_2" style="width: 85px;" title="ingrese la placa del vehiculo (si corresponde)">
                    <div class=" letraChica negrilla centrartexto">Placa</div>
                    <input class="input_redond_100_c" style="margin-top:0px; width: 79" type="text" id="placa_veh" value="">
                </div>
                <div class="grid_1 ">
                    <div class="letraChica negrilla centrartexto">Cobrar Cliente</div>
                    <div>SI <input  type="checkbox" name="resp"  value="1" id="cobrar_cliente" ></div>
                </div>
                <div class="grid_3" >
                    <input type="hidden" id="adjuntos_rutasXX">
                    <div class="ocultar">
                        <form id="fileformXX" enctype="multipart/form-data" method="POST">
                            <input type="file" id="userfileXX"  name="userfile"  
                                   style="padding-left: 30px" title="Subir Archivo" onchange="subir_archivo_rend('XX');" >
                        </form>
                    </div>
                    <div class="ocultar" id="dialog_div_uploadXX">
                        <!--                        <div id="dialog_nom_archXX" class="centrartexto">
                                                    <span class="f16 negrilla colorAzul">AtenciÃ³n</span> 
                                                    <br><span class="colorRojo negrilla">el archivo a Subir debe ser de tipo JPG/PNG/GIF , 
                                                        las dimensiones no deben superar los limites de 2000px x 2000px y el
                                                        tamaÃ±o del archivo no debe superar los 3Mb</span> <br><br> Indique el nombre del archivo<br>
                                                    <input type="text" id="name_archXX" class="input_redond_300">
                                                    <div id="men_load_XX">
                                                    </div>
                                                </div>-->

                    </div>
                    <div class="letraChica negrilla centrartexto milinktext" title="Click para adjuntar archivos" onclick="$('#userfileXX').trigger('click');">Archivos adjuntos</div>
                    <div class="f10" id="adjuntosXX"></div>


                </div>
                <div class=" grid_1 " style="margin-top: 15px; width: 30px;">
                    <div class="delete_ico" onclick="del_registro_rendicion('XX')" title="Borrar Registro de factura"></div>
                </div>

                <div class="grid_20 espabajo5"></div>
            </div>
        </div>

        <input type="hidden" id="nro_reg" value="0">
        <input type="hidden" id="items_select" value="0">
        <?php $sumador = 0.00; ?>

        <div class="grid_20 esparriba10" id="add_nuevo_rendicion">    
            <?php
            if ($id_rend != 0) {
                $cont = 0;
                $cadena = "0";

                foreach ($datos_rendicion_detalle->result() as $fila) {
                    $cont++;
                    $cadena.="," . $cont;
                    //  echo $cont.'--->'.$cadena.'<br>';
                    ?>
                    <div id="dr<?php echo $cont; ?>" class="">
                        <div class="grid_20 esparriba5 espabajo5 bordeado fondoVerde_regional">
                            <div class="grid_2">
                                <div class="letraChica negrilla ">
                                    <?php // echo $cont;  ?> Tipo de Gastos
                                </div>
                                <div class="esparriba5">
                                    <select  style="width: 95px;" id="tipo_gasto_for" onchange="carga_tipo_gasto('dr<?php echo $cont . ''; ?> #tipo_gasto_for', 'selec_tipo_servg', 'dr<?php echo $cont; ?> #gasto_bloque', 0);">
                                        <option value="-1"  >seleccione...</option>
                                        <option value="1" <?php if ($fila->tipo == "tra") echo "selected='selected' "; ?> > Transporte </option>
                                        <option value="2" <?php if ($fila->tipo == "sgr") echo "selected='selected' "; ?> > Operativo </option>
                                        <option value="3" <?php if ($fila->tipo == "tel") echo "selected='selected' "; ?> > Telefonia </option>
                                    </select> 
                                </div>

                            </div>
                            <div class="grid_3" id="gasto_bloque">
                                <div class="letraChica negrilla centrartexto">
                                    Apropiacion
                                </div>
                                <div class="esparriba5">
                                    <select id="selec_tipo_servg">
                                        <option value="0">seleccione tipo...</option>
                                    </select>
                                    <script>carga_tipo_gasto('tipo_gasto_for', 'selec_tipo_servg', 'gasto_bloque', 0);</script>
                                </div>
                            </div>
                            <script> carga_tipo_gasto('dr<?php echo $cont; ?> #tipo_gasto_for', 'selec_tipo_servg', 'dr<?php echo $cont; ?> #gasto_bloque',<?php echo $fila->id_tipo_gasto; ?>);</script>

                            <div class="grid_1 ">
                                <div class="letraChica negrilla centrartexto">C/Fac</div>
                                <div style="margin-top: 7px" title="Check si el registro es de una Factura">SI <input  type="checkbox" name="resp"  value="1" id="fac" <?php if ($fila->c_s_factura == 1) echo'checked="checked"'; ?>   ></div>
                            </div>


                            <div class="grid_2 centrartexto" style="width: 75px;" title="ingrese la fecha de factura">
                                <div class="letraChica negrilla centrartexto">Fecha Fac</div>
                                <input class="input_redond_100_c" style="margin-top: 0px; width: 69px; font-size: 10px; padding: 7 0 7 0;" type="text" id="fec_fact<?php echo $cont; ?>"  value="<?php echo $fila->fecha_factura; ?>">
                                <script>
                                    $("#fec_fact<?php echo $cont; ?>").datepicker();
                                </script>
                            </div>

                            <div class="grid_2 centrartexto" style="width: 75px;" title="ingrese el numero de factura">
                                <div class="letraChica negrilla centrartexto">Nro Fac</div>
                                <input class="input_redond_100_c" style="margin-top: 0px; width: 69px;" type="text" id="nro_fact"  value="<?php echo $fila->nro_fac; ?>">
                            </div>



                            <div class="grid_2 centrartexto" style="width: 75px; " title="ingrese el monto de la Factura en Bs">
                                <div class="letraChica negrilla centrartexto">Monto (bs)</div>
                                <input class="input_redond_100_c" style="margin-top: 0px; width: 69px;"    type="text" id="monto" onkeyup="val_numero('dr<?php echo $cont; ?> #monto'); sumar_total_rend()"   value="<?php echo $fila->monto; ?>">

                            </div>
                            <div class="grid_3" title="ingrese el detalle de la factura">
                                <div class="letraChica negrilla centrartexto">Detalle Factura</div>
                                <textarea id="detalle_factura" style="width: 145px; height: 27px;font-size: 10px;"><?php echo $fila->glosa; ?></textarea>
                            </div>
                            <div class="grid_2" style="width: 85px;" title="ingrese la placa del vehiculo (si corresponde)">
                                <div class=" letraChica negrilla centrartexto">Placa</div>
                                <input class="input_redond_100_c" style="margin-top:0px; width: 79" type="text" id="placa_veh" value="<?php echo $fila->placa_vehiculo; ?>">
                            </div>
                            <div class="grid_1 ">
                                <div class="letraChica negrilla centrartexto">Cobrar Cliente</div>
                                <div>SI <input  type="checkbox" name="resp"  value="1" id="cobrar_cliente" <?php if ($fila->cobrar_cliente == 1) echo'checked="checked"'; ?>  ></div>
                            </div>
                            <div class="grid_3" title="archivos adjuntos">



                                <input type="hidden" id="adjuntos_rutas<?php echo $cont; ?>" value="<?php echo $fila->adjuntos; ?>">
                                <div class="ocultar">
                                    <form id="fileform<?php echo $cont; ?>" enctype="multipart/form-data" method="POST">
                                        <input type="file" id="userfile<?php echo $cont; ?>"  name="userfile"  
                                               style="padding-left: 30px" title="Subir Archivo" onchange="subir_archivo_rend('<?php echo $cont; ?>');" >
                                    </form>
                                </div>
                                <div class="ocultar" id="dialog_div_upload<?php echo $cont; ?>">
        <!--                                    <div id="dialog_nom_arch<?php //echo $cont;    ?>" class="centrartexto">
                                        <span class="f16 negrilla colorAzul">AtenciÃ³n</span> 
                                        <br><span class="colorRojo negrilla">el archivo a Subir debe ser de tipo JPG/PNG/GIF , 
                                            las dimensiones no deben superar los limites de 2000px x 2000px y el
                                            tamaÃ±o del archivo no debe superar los 3Mb</span> <br><br> Nombre del archivo
                                        <input type="text" id="name_arch<?php // echo $cont;    ?>" class="input_redond_300">
                                        <div id="men_load_<?php //echo $cont;    ?>">
                                        </div>
                                    </div>-->

                                </div>
                                <div class="letraChica negrilla centrartexto milinktext" title="Click para adjuntar archivos" onclick="$('#userfile<?php echo $cont; ?>').trigger('click');">Archivos adjuntos</div>
                                <div class="f10" id="adjuntos<?php echo $cont; ?>">
                                    <?php
                                    $adj = explode("|", $fila->adjuntos);
                                    for ($i = 1; $i < count($adj); $i++) {
                                        ?>
                                        <div id="<?php echo str_replace(".", "", $adj[$i]); ?>dmd">
                                            <div class='milinktextm' style='float:right;' onclick='ver_archivo("uploads/doc_rendicion/<?php echo $adj[$i] ?>", "<?php echo $adj[$i]; ?>")'>
                                                <?php echo substr($adj[$i], 0, 19); ?>
                                            </div >
                                            <div title="quitar Adjunto" onclick='del_arch_adj("<?php echo $adj[$i]; ?>", "<?php echo $cont; ?>")' class='negrilla colorRojo t14 milinktext' style='float:left; margin:0 5 0 5;'>
                                                X
                                            </div>

                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>

                            </div>


                            <div class=" grid_1 " style="margin-top: 15px; width: 30px;">
                                <div class="delete_ico" onclick="enviar_baul_rechazados('<?php echo $fila->id_det; ?>');del_registro_rendicion('<?php echo $cont; ?>');sumar_total_rend()" title="Rechazar Registro de factura"></div>
                            </div>




                        </div>
                    </div>
                    <div class="grid_20 espabajo5"></div>
                    <?php
                    $sumador+= $fila->monto;
                }
                ?>
                <script>
                    $("#nro_reg").val('<?php echo $cont ?>');
                    $("#items_select").val('<?php echo $cadena ?>');
                </script>
                <?php
            } else {
                ?>
                <script>add_registro();</script>
            <?php }
            ?>
        </div>




    </div>

    <div class="grid_20">
        <div class="grid_6 f10 negrilla colorRojo">X facturas/recibos fueron registrados</div>
        <div class="grid_8 OK espabajo5 esparriba5">
            <div class="grid_3 f14 negrilla ">T O T A L .- </div>
            <div class="grid_4 f16 negrilla " id="monto_total_rendicion"><?php echo number_format($sumador, 2, ".", ","); ?></div>
        </div>
    </div>    


    <div class="grid_15 "style="padding-top: 20px" >
        <textarea class="textarea_redond_382x65" type="text" id="desc" placeholder=""   placeholder="Escriba una descripciÃ³n" ><?php echo $desc; ?></textarea>
        <div class="f11 letraChica"> Descripcion</div>
    </div>

    <?php
    //echo $estado;
    
    if ($estado != "Modificado Responsable" &&   $estado != "Enviado a responsable"){
        $vobos=  explode("|",$ids_vobos);
        
      if(in_array($id_me, $vobos))
      {  
        echo "<script>  $('#vB').button('disable');
             $('#save_reg').button('disable');</script>";
      }
    } 
    ?>
</div>
<div id="mensaje_fin"></div>







