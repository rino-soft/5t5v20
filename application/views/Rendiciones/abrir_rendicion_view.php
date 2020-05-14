



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


<!--            //<input class="input_redond_200" type="hidden" id="fechaS" readonly="readonly" value=" <?php //echo date("Y-m-d H:i:s");         ?>" placeholder="">  -->

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

    <div id="ayuda_autocomplete">
        <script> var etiquetas = [""];</script>

    </div>
    <script></script>
    <!-- 
      <div class="grid_9 " >
      <div class="letraChica "> <br> Tecnico :
      <select id="tecnico_seleccionado">
   
    
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
                <div class="grid_5 negrilla"><?php echo $d_tecnico->nombre . " " . $d_tecnico->ap_paterno . " " . $d_tecnico->ap_materno; ?></div>
            </div>
           
        </div>
    </div>

    <div class="clear"></div>

    <div class="grid_20 ">

        <div id="grilla_modelo" class="oculto">
            <div class="bordeado grid_20 esparriba5 espabajo5 fondo_plomo_claro_areas" style="position: relative" >


                <div class="grid_2">
                    <div class="letraChica negrilla centrartexto">
                        Tipo de gastos
                    </div>
                    <div class="esparriba5">
                        <select  style="width: 95px;font-size: 10px;" id="tipo_gasto_for" onchange="mostrar_placa_numero('drXX #tipo_gasto_for', 'div_campoXX', '');carga_tipo_gasto('drXX #tipo_gasto_for', 'selec_tipo_servg', 'drXX #gasto_bloque', 0);">
                            <option value="-1" selected="selected">seleccione...</option>
                            <option value="1"> Transporte </option>
                            <option value="2"> Operativos </option>
                            <option value="3"> Telefonia </option>
                        </select> 
                    </div>
                    <div id="div_campoXX" >

                    </div>

                </div>
                <div class="grid_3" id="gasto_bloque">
                    <div class="letraChica negrilla  centrartexto">
                        Apropiacion
                    </div>
                    <div class="esparriba5 centrartexto f10">
                        debe seleccionar el tipo de gasto
  <!--                        <script>carga_tipo_gasto('tipo_gasto_for', 'selec_tipo_servg', 'gasto_bloque', 0);</script>-->
                    </div>
                </div> 
                <div class="grid_2 centrartexto" style="width: 75px;">
                    <input id='id_apropiacion' type="hidden" value='0'>
                    <div class="letraChica negrilla centrartexto">C/Fac</div>
                    <div style="" title="Check si el registro es de una Factura">SI <input  type="checkbox" name="resp"  id="fac" onclick="ver_campo_nro_factura('drXX #fac', 'drXX #campo_nro_factura')"  ></div>
                    <div class="centrartexto ocultar" id="campo_nro_factura" style="width: 75px;" title="ingrese el numero de factura">
                        <input class="input_redond_100_c f10" placeholder="Nro Factura" style="padding: 1px;margin-top: 0px; width: 69px;" type="text" id="nro_fact"  value="">
                    </div>
                </div>

                <div class="grid_2 centrartexto" style="width: 75px;" title="ingrese la fecha de factura">
                    <div class="letraChica negrilla centrartexto">Fecha Fac</div>
                    <input class="input_redond_100_c " style="margin-top: 0px; width: 69px; font-size: 10px; padding: 5 0 5 0;" type="text" id="fec_factXX"  value="<?php echo date('Y/m/d'); ?>">
                </div>



                <div class="grid_2 centrartexto" style="width: 75px; " title="ingrese el monto de la Factura en Bs">
                    <div class="letraChica negrilla centrartexto">Monto (bs)</div>
                    <input class="input_redond_100_c" style="margin-top: 0px; width: 69px;"    type="text" id="monto" onkeyup="val_numero('drXX #monto');sumar_total_rend()"   value="<?php //echo $monto                                                ?>">

                </div>
                <div class="grid_3" title="ingrese el detalle de la factura">
                    <div class="letraChica negrilla centrartexto">Detalle Factura</div>
                    <textarea id="detalle_factura" style="width: 145px; height: 27px;font-size: 10px;"></textarea>
                </div>

                <div class="grid_1 ">
                    <div class="letraChica negrilla centrartexto">Cobrar Cliente</div>
                    <div>SI <input  type="checkbox" name="resp"  value="1" id="cobrar_cliente" ></div>
                </div>

                <div class="grid_2 " style="width: 148px;">
                    <div class="letraChica negrilla centrartexto">Estacion/Sitio</div>
                    <input class="input_redond_100_c estsit" style="margin-top: 0px; width: 148px;"    type="text" id="estacion_sitio" placeholder="Buscar estacion" value="">
                    <script>$("#drXX #estacion_sitio").autocomplete({source: etiquetas});</script>
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

                    </div>
                    <div class="letraChica negrilla centrartexto milinktext" title="Click para adjuntar archivos" onclick="$('#userfileXX').trigger('click');">Archivos adjuntos</div>
                    <div class="f10" id="adjuntosXX"><br></div>


                </div>
                <div class=" grid_1 " style="margin-top: 15px; width: 20px;">
                    <div class="delete_ico milink" onclick="del_registro_rendicion('XX')" title="Borrar Registro de factura"></div>
                </div>
                <div class="negrilla f18" style=" color:#7EB5EA ; position: absolute;right: 2px; bottom: 2px;">
                    XX
                </div>


            </div>
            <div class="grid_20" style="padding-bottom:  2px;"></div>
        </div>

        <input type="hidden" id="nro_reg" value="0">
        <input type="hidden" id="items_select" value="0">
        <?php
        $sumador = 0.00;
        $sumtraA = 0.00;
        $sumtraB = 0.00;
        $sumsgrA = 0.00;
        $sumsgrB = 0.00;
        $sumsgrC = 0.00;
        $sumador = 0.00;
        $subsumador = 0.00;
        ?>

        <div class="grid_20 esparriba10" id="add_nuevo_rendicion">    
            <?php
            if ($id_rend != 0) {
                $cont = 0;
                $cadena = "0";

                if ($datos_rendicion_detalle_traA->num_rows() > 0) {
                    ?>
                    <div class="f16 colorcel negrilla espabajo5">TRA-08<span class="colorGuindo">A</span> CON <span class="colorGuindo">FACTURA</span></div>

                    <div class="">
                        <div class="grid_20 fondoazul colorBlanco" style="position: relative">
                            <div class="grid_4">
                                <div class="letraChica negrilla ">
                                    Tipo de Gastos / Apropiacion
                                </div>

                            </div>
                            <!--                            <div class="grid_1" id="gasto_bloque">
                                                            <div class="letraChica negrilla centrartexto">
                                                                Apropiacion
                                                            </div>
                                                        </div>-->
                            <div class="grid_2 centrartexto " style="width: 75px;">
                                <div class="letraChica negrilla centrartexto">C/Fac Numero</div>
                            </div>
                            <div class="grid_2 centrartexto" style="width: 75px;" title="ingrese la fecha de factura">
                                <div class="letraChica negrilla centrartexto">Fecha Fac</div>
                            </div>

                            <div class="grid_2 centrartexto" style="width: 75px; " title="ingrese el monto de la Factura en Bs">
                                <div class="letraChica negrilla centrartexto">Monto (bs)</div>
                            </div>
                            <div class="grid_3" title="ingrese el detalle de la factura">
                                <div class="letraChica negrilla centrartexto">Detalle Factura</div>
                            </div>
                            <div class="grid_1 ">
                                <div class="letraChica negrilla centrartexto">Cobrar Cliente</div>
                            </div>
                            <div class="grid_2"style="width: 148px;">
                                <div class="letraChica negrilla centrartexto">Estacion/Sitio</div>
                            </div>

                            <div class="grid_3" title="archivos adjuntos">
                                <div class="letraChica negrilla centrartexto milinktext" title="Click para adjuntar archivos" >Archivos adjuntos</div>

                            </div>

                        </div>
                    </div>

                    <?php
                    foreach ($datos_rendicion_detalle_traA->result() as $fila) {
                        $cont++;
                        $cadena.="," . $cont;
                        ?>

                        <div id="dr<?php echo $cont; ?>" class="oculto">
                            <div class="grid_20 esparriba5 espabajo5 fondo_azulclaro_c_borde" style="position: relative">
                                <div class="grid_2">
                                    <div class="letraChica negrilla ">
                                        Tipo de Gastos
                                    </div>
                                    <div class="esparriba5">
                                        <select  style="width: 95px;font-size: 10px;" id="tipo_gasto_for" onchange="mostrar_placa_numero('dr<?php echo $cont; ?> #tipo_gasto_for', 'div_campo<?php echo $cont; ?> ', '<?php echo $fila->placa_vehiculo; ?>');carga_tipo_gasto('dr<?php echo $cont . ''; ?> #tipo_gasto_for', 'selec_tipo_servg', 'dr<?php echo $cont; ?> #gasto_bloque', 0);">
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
                                <div class="grid_3" id="gasto_bloque">
                                    <div class="letraChica negrilla centrartexto">
                                        Apropiacion
                                    </div>
                                    <div class="esparriba5 centrartexto f10">
                                        debe seleccionar el tipo de gasto
                                    </div>
                                </div>
                                <script> carga_tipo_gasto('dr<?php echo $cont; ?> #tipo_gasto_for', 'selec_tipo_servg', 'dr<?php echo $cont; ?> #gasto_bloque',<?php echo $fila->id_tipo_gasto; ?>);</script>

                                <div class="grid_2 centrartexto " style="width: 75px;">
                                     <input id='id_apropiacion' type="hidden" value='<?php echo $fila->id_tipo_gasto; ?>'>
                                    <div class="letraChica negrilla centrartexto">C/Fac</div>
                                    <div style="" title="Check si el registro es de una Factura">SI <input  type="checkbox" name="resp"  value="1" id="fac" <?php if ($fila->c_s_factura == 1) echo'checked="checked"'; ?> onclick="ver_campo_nro_factura('dr<?php echo $cont; ?> #fac', 'dr<?php echo $cont; ?> #campo_nro_factura');"  ></div>
                                    <div class="centrartexto ocultar" id="campo_nro_factura" style="width: 75px;" title="ingrese el numero de factura">
                                        <input class="input_redond_100_c f10" placeholder="Nro Factura" style="padding: 1px;margin-top: 0px; width: 69px;" type="text" id="nro_fact"  value="<?php echo $fila->nro_fac; ?>">
                                    </div>
                                    <script>ver_campo_nro_factura('dr<?php echo $cont; ?> #fac', 'dr<?php echo $cont; ?> #campo_nro_factura');</script>
                                </div>


                                <div class="grid_2 centrartexto" style="width: 75px;" title="ingrese la fecha de factura">
                                    <div class="letraChica negrilla centrartexto">Fecha Fac</div>
                                    <input class="input_redond_100_c" style="margin-top: 0px; width: 69px; font-size: 10px; padding: 7 0 7 0;" type="text" id="fec_fact<?php echo $cont; ?>"  value="<?php echo $fila->fecha_factura; ?>">
                                    <script>
                                        $("#fec_fact<?php echo $cont; ?>").datepicker();
                                    </script>
                                </div>

                                <div class="grid_2 centrartexto" style="width: 75px; " title="ingrese el monto de la Factura en Bs">
                                    <div class="letraChica negrilla centrartexto">Monto (bs)</div>
                                    <input class="input_redond_100_c" style="margin-top: 0px; width: 69px;"    type="text" id="monto" onkeyup="val_numero('dr<?php echo $cont; ?> #monto'); sumar_total_rend()"   value="<?php echo $fila->monto; ?>">

                                </div>
                                <div class="grid_3" title="ingrese el detalle de la factura">
                                    <div class="letraChica negrilla centrartexto">Detalle Factura</div>
                                    <textarea id="detalle_factura" style="width: 145px; height: 27px;font-size: 10px;"><?php echo $fila->glosa; ?></textarea>
                                </div>

                                <div class="grid_1 ">
                                    <div class="letraChica negrilla centrartexto">Cobrar Cliente</div>
                                    <div>SI <input  type="checkbox" name="resp"  value="1" id="cobrar_cliente" <?php if ($fila->cobrar_cliente == 1) echo'checked="checked"'; ?>  ></div>
                                </div>

                                <div class="grid_2"style="width: 148px;">
                                    <div class="letraChica negrilla centrartexto">Estacion/Sitio</div>
                                    <input class="input_redond_100_c estsit" style="margin-top: 0px; width: 148px; font-size: 10px"    type="text" id="estacion_sitio" value="<?php echo $fila->estacion; ?>">

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


                                <!--                                <div class=" grid_1 " style="margin-top: 15px; width: 20px;">
                                                                    <div class="delete_ico milink" onclick="del_registro_rendicion('<?php // echo $cont;      ?>');
                                                                                        sumar_total_rend()" title="Borrar Registro de factura"></div>
                                                                </div>-->
                                <div class=" grid_1 " style=" width: 20px;">
                                    <div class="no_edit_ico milink" onclick="mostrar_edit_ocultar_datos(<?php echo $cont; ?>, 0);" title="Cancelar la edicion"></div>
                                    <div class="delete_ico" onclick="enviar_baul_rechazados('<?php echo $fila->id_det; ?>',<?php echo $cont; ?>);
                                                       " title="Rechazar Registro de factura"></div>

                                </div>
                                <div class="negrilla f18" style=" color:#7EB5EA ; position: absolute;right: 2px; bottom: 2px;">
                                    <?php echo $cont; ?>
                                </div>




                            </div>
                        </div>
                        <!--!//////////////////////////   aqui se muestra los datos para ver-->
                        <div id="drdatos<?php echo $cont; ?>" class="f10">
                            <div class="grid_20 filas esparriba5" style="position: relative">
                                <div class="grid_4 negrilla">
                                    <div class=" ">
                                        <?php
                                        if ($fila->tipo == "tra")
                                            echo $fila->descripcion_tra . "<br><span class='colorGuindo  f14'>" . $fila->placa_vehiculo . "</span>";
                                        if ($fila->tipo == "sgr")
                                            echo $fila->descripcion_tra;
                                        if ($fila->tipo == "tel")
                                            echo $fila->descripcion_tra . "<br><span class='colorGuindo negrilla f14'>" . $fila->placa_vehiculo . "</span>";
                                        ?>

                                    </div>
                                </div>
                                <!--                                <div class="grid_1" id="gasto_bloque">
                                <?php // echo $fila->descripcion_tra; ?>
                                                                </div>-->
                                <div class="grid_2 centrartexto negrilla f14" style="width: 75px;">
                                    <div style="" title="Check si el registro es de una Factura"> <?php if ($fila->c_s_factura == 1)
                        echo $fila->nro_fac;
                    else
                        echo "RECIBO" . $fila->nro_fac;
                    ?></div>
                                </div>
                                <div class="grid_2 centrartexto esparriba5" style="width: 75px;" title="ingrese la fecha de factura">
                                    <?php echo $fila->fecha_factura . "<br>"; ?>
                                </div>

                                <div  class="grid_2 centrartexto colorcel negrilla f12 fondo_amarillo_claro esparriba5 espabajo5" style="width: 75px; " title="ingrese el monto de la Factura en Bs">
                                    <?php echo number_format($fila->monto, 2, ".", ",") . "<br>"; ?>
                                </div>
                                <div class="grid_3" title="ingrese el detalle de la factura">
                                    <?php echo $fila->glosa . "<br>"; ?>
                                </div>
                                <div class="grid_1 centrartexto ">
            <?php if ($fila->cobrar_cliente == 1)
                echo'SI';
            else
                echo "NO";
            ?> 
                                </div>

                                <div class="grid_2"style="width: 148px;">

            <?php echo $fila->estacion . "<br>"; ?>

                                </div>

                                <div class="grid_3" title="archivos adjuntos">


                                    <div class="f10" id="adjuntos<?php echo $cont; ?>">
                                                <?php
                                                $adj = explode("|", $fila->adjuntos);
                                                for ($i = 1; $i < count($adj); $i++) {
                                                    ?>
                                            <div id="<?php echo str_replace(".", "", $adj[$i]); ?>dmd">
                                                <div class='milinktextm' style='float:right;' onclick='ver_archivo("uploads/doc_rendicion/<?php echo $adj[$i] ?>", "<?php echo $adj[$i]; ?>")'>
                                            <?php echo substr($adj[$i], 0, 19); ?>
                                                </div >

                                            </div>
                <?php
            }
            ?>  <br>
                                    </div>

                                </div>


                                <!--                                <div class=" grid_1 " style="margin-top: 15px; width: 20px;">
                                                                    <div class="delete_ico milink" onclick="del_registro_rendicion('<?php // echo $cont;      ?>');
                                                                                        sumar_total_rend()" title="Borrar Registro de factura"></div>
                                                                </div>-->
                                <div class=" grid_1 " style="width: 40px;">
                                    <div class="delete_ico milink" onclick="enviar_baul_rechazados('<?php echo $fila->id_det; ?>',<?php echo $cont; ?>);
                                                        " title="Rechazar Registro de factura"></div>
                                    <div class="edit_ico milink" onclick="mostrar_edit_ocultar_datos(<?php echo $cont; ?>, 1);" title="Editar los Datos"></div>
                                </div>
                                <div class="negrilla f18" style=" color:#7EB5EA ; position: absolute;right: 2px; bottom: 2px;">
            <?php echo $cont; ?>
                                </div>




                            </div>
                        </div>

                        <!--                        <div class="grid_20" style="padding-bottom:  2px;"></div>-->

                        <?php
                        $sumador+= $fila->monto;
                        $subsumador+= $fila->monto;
                    }
                    $sumtraA = $subsumador;
                    $subsumador = 0;
                    ?>
                    <div class="grid_20 f14 negrilla fondoazul colorBlanco">
                        <div class=" grid_7 alin_der " id="">SUBTOTAL .- </div><div class="grid_1 centrartexto fondo_amarillo_claro negrocolor negrilla espabajo5 esparriba5" style="width:75px;"><?php echo number_format($sumtraA, 2, ".", ","); ?></div>
                        <div class="grid_10"></div>
                    </div>  
                    <?php
                }



                if ($datos_rendicion_detalle_traB->num_rows() > 0) {
                    /* $cant = 0;
                      $suma_s = 0;
                      $suma_total_final=0; */
                    ?>
                    <div class="f16 colorcel negrilla espabajo5">TRA-08<span class="colorGuindo">B</span> CON <span class="colorGuindo">RECIBO</span></div>
                    <div class="">
                        <div class="grid_20 fondoazul colorBlanco" style="position: relative">
                            <div class="grid_4">
                                <div class="letraChica negrilla ">
                                    Tipo de Gastos / Apropiacion
                                </div>

                            </div>
                            <!--                            <div class="grid_1" id="gasto_bloque">
                                                            <div class="letraChica negrilla centrartexto">
                                                                Apropiacion
                                                            </div>
                                                        </div>-->
                            <div class="grid_2 centrartexto " style="width: 75px;">
                                <div class="letraChica negrilla centrartexto">C/Fac Numero</div>
                            </div>
                            <div class="grid_2 centrartexto" style="width: 75px;" title="ingrese la fecha de factura">
                                <div class="letraChica negrilla centrartexto">Fecha Fac</div>
                            </div>

                            <div class="grid_2 centrartexto" style="width: 75px; " title="ingrese el monto de la Factura en Bs">
                                <div class="letraChica negrilla centrartexto">Monto (bs)</div>
                            </div>
                            <div class="grid_3" title="ingrese el detalle de la factura">
                                <div class="letraChica negrilla centrartexto">Detalle Factura</div>
                            </div>
                            <div class="grid_1 ">
                                <div class="letraChica negrilla centrartexto">Cobrar Cliente</div>
                            </div>
                            <div class="grid_2"style="width: 148px;">
                                <div class="letraChica negrilla centrartexto">Estacion/Sitio</div>
                            </div>

                            <div class="grid_3" title="archivos adjuntos">
                                <div class="letraChica negrilla centrartexto milinktext" title="Click para adjuntar archivos" >Archivos adjuntos</div>

                            </div>

                        </div>
                    </div>

        <?php
        foreach ($datos_rendicion_detalle_traB->result() as $fila) {
            $cont++;
            $cadena.="," . $cont;
            ?>

                        <div id="dr<?php echo $cont; ?>" class="oculto">
                            <div class="grid_20 esparriba5 espabajo5 fondo_azulclaro_c_borde" style="position: relative">
                                <div class="grid_2">
                                    <div class="letraChica negrilla ">
                                        Tipo de Gastos
                                    </div>
                                    <div class="esparriba5">
                                        <select  style="width: 95px;font-size: 10px;" id="tipo_gasto_for" onchange="mostrar_placa_numero('dr<?php echo $cont; ?> #tipo_gasto_for', 'div_campo<?php echo $cont; ?> ', '<?php echo $fila->placa_vehiculo; ?>');
                                                            carga_tipo_gasto('dr<?php echo $cont . ''; ?> #tipo_gasto_for', 'selec_tipo_servg', 'dr<?php echo $cont; ?> #gasto_bloque', 0);">
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
                                <div class="grid_3" id="gasto_bloque">
                                    <div class="letraChica negrilla centrartexto">
                                        Apropiacion
                                    </div>
                                    <div class="esparriba5 centrartexto f10">
                                        debe seleccionar el tipo de gasto
                                    </div>
                                </div>
                                <script> carga_tipo_gasto('dr<?php echo $cont; ?> #tipo_gasto_for', 'selec_tipo_servg', 'dr<?php echo $cont; ?> #gasto_bloque',<?php echo $fila->id_tipo_gasto; ?>);</script>

                                <div class="grid_2 centrartexto " style="width: 75px;">
                                     <input id='id_apropiacion' type="hidden" value='<?php echo $fila->id_tipo_gasto; ?>'>
                                    <div class="letraChica negrilla centrartexto">C/Fac</div>
                                    <div style="" title="Check si el registro es de una Factura">SI <input  type="checkbox" name="resp"  value="1" id="fac" <?php if ($fila->c_s_factura == 1) echo'checked="checked"'; ?> onclick="ver_campo_nro_factura('dr<?php echo $cont; ?> #fac', 'dr<?php echo $cont; ?> #campo_nro_factura');"  ></div>
                                    <div class="centrartexto ocultar" id="campo_nro_factura" style="width: 75px;" title="ingrese el numero de factura">
                                        <input class="input_redond_100_c f10" placeholder="Nro Factura" style="padding: 1px;margin-top: 0px; width: 69px;" type="text" id="nro_fact"  value="<?php echo $fila->nro_fac; ?>">
                                    </div>
                                    <script>ver_campo_nro_factura('dr<?php echo $cont; ?> #fac', 'dr<?php echo $cont; ?> #campo_nro_factura');</script>
                                </div>


                                <div class="grid_2 centrartexto" style="width: 75px;" title="ingrese la fecha de factura">
                                    <div class="letraChica negrilla centrartexto">Fecha Fac</div>
                                    <input class="input_redond_100_c" style="margin-top: 0px; width: 69px; font-size: 10px; padding: 7 0 7 0;" type="text" id="fec_fact<?php echo $cont; ?>"  value="<?php echo $fila->fecha_factura; ?>">
                                    <script>
                                        $("#fec_fact<?php echo $cont; ?>").datepicker();
                                    </script>
                                </div>

                                <div class="grid_2 centrartexto" style="width: 75px; " title="ingrese el monto de la Factura en Bs">
                                    <div class="letraChica negrilla centrartexto">Monto (bs)</div>
                                    <input class="input_redond_100_c" style="margin-top: 0px; width: 69px;"    type="text" id="monto" onkeyup="val_numero('dr<?php echo $cont; ?> #monto');
                                                        sumar_total_rend()"   value="<?php echo $fila->monto; ?>">

                                </div>
                                <div class="grid_3" title="ingrese el detalle de la factura">
                                    <div class="letraChica negrilla centrartexto">Detalle Factura</div>
                                    <textarea id="detalle_factura" style="width: 145px; height: 27px;font-size: 10px;"><?php echo $fila->glosa; ?></textarea>
                                </div>

                                <div class="grid_1 ">
                                    <div class="letraChica negrilla centrartexto">Cobrar Cliente</div>
                                    <div>SI <input  type="checkbox" name="resp"  value="1" id="cobrar_cliente" <?php if ($fila->cobrar_cliente == 1) echo'checked="checked"'; ?>  ></div>
                                </div>

                                <div class="grid_2"style="width: 148px;">
                                    <div class="letraChica negrilla centrartexto">Estacion/Sitio</div>
                                    <input class="input_redond_100_c estsit" style="margin-top: 0px; width: 148px; font-size: 10px"    type="text" id="estacion_sitio" value="<?php echo $fila->estacion; ?>">

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


                                <!--                                <div class=" grid_1 " style="margin-top: 15px; width: 20px;">
                                                                    <div class="delete_ico milink" onclick="del_registro_rendicion('<?php // echo $cont;     ?>');
                                                                                        sumar_total_rend()" title="Borrar Registro de factura"></div>
                                                                </div>-->
                                <div class=" grid_1 " style=" width: 20px;">
                                    <div class="no_edit_ico milink" onclick="mostrar_edit_ocultar_datos(<?php echo $cont; ?>, 0);" title="Cancelar la edicion"></div>
                                    <div class="delete_ico" onclick="enviar_baul_rechazados('<?php echo $fila->id_det; ?>',<?php echo $cont; ?>);
                                                        " title="Rechazar Registro de factura"></div>

                                </div>
                                <div class="negrilla f18" style=" color:#7EB5EA ; position: absolute;right: 2px; bottom: 2px;">
            <?php echo $cont; ?>
                                </div>




                            </div>
                        </div>
                        <!--!//////////////////////////   aqui se muestra los datos para ver-->
                        <div id="drdatos<?php echo $cont; ?>" class="f10">
                            <div class="grid_20 filas esparriba5" style="position: relative">
                                <div class="grid_4 negrilla">
                                    <div class=" ">
                                        <?php
                                        if ($fila->tipo == "tra")
                                            echo $fila->descripcion_tra . "<br><span class='colorGuindo  f14'>" . $fila->placa_vehiculo . "</span>";
                                        if ($fila->tipo == "sgr")
                                            echo $fila->descripcion_tra;
                                        if ($fila->tipo == "tel")
                                            echo $fila->descripcion_tra . "<br><span class='colorGuindo negrilla f14'>" . $fila->placa_vehiculo . "</span>";
                                        ?>

                                    </div>
                                </div>
                                <!--                                <div class="grid_1" id="gasto_bloque">
                                    <?php // echo $fila->descripcion_tra;   ?>
                                                                </div>-->
                                <div class="grid_2 centrartexto negrilla f14" style="width: 75px;">
                                    <div style="" title="Check si el registro es de una Factura"> <?php if ($fila->c_s_factura == 1)
                                        echo $fila->nro_fac;
                                    else
                                        echo "RECIBO" . $fila->nro_fac;
                                    ?></div>
                                </div>
                                <div class="grid_2 centrartexto esparriba5" style="width: 75px;" title="ingrese la fecha de factura">
                                    <?php echo $fila->fecha_factura . "<br>"; ?>
                                </div>

                                <div  class="grid_2 centrartexto colorcel negrilla f12 fondo_amarillo_claro esparriba5 espabajo5" style="width: 75px; " title="ingrese el monto de la Factura en Bs">
            <?php echo number_format($fila->monto, 2, ".", ",") . "<br>"; ?>
                                </div>
                                <div class="grid_3" title="ingrese el detalle de la factura">
                                    <?php echo $fila->glosa . "<br>"; ?>
                                </div>
                                <div class="grid_1 centrartexto ">
            <?php if ($fila->cobrar_cliente == 1)
                echo'SI';
            else
                echo "NO";
            ?> 
                                </div>

                                <div class="grid_2"style="width: 148px;">

            <?php echo $fila->estacion . "<br>"; ?>

                                </div>

                                <div class="grid_3" title="archivos adjuntos">


                                    <div class="f10" id="adjuntos<?php echo $cont; ?>">
                                        <?php
                                        $adj = explode("|", $fila->adjuntos);
                                        for ($i = 1; $i < count($adj); $i++) {
                                            ?>
                                            <div id="<?php echo str_replace(".", "", $adj[$i]); ?>dmd">
                                                <div class='milinktextm' style='float:right;' onclick='ver_archivo("uploads/doc_rendicion/<?php echo $adj[$i] ?>", "<?php echo $adj[$i]; ?>")'>
                <?php echo substr($adj[$i], 0, 19); ?>
                                                </div >

                                            </div>
                <?php
            }
            ?>  <br>
                                    </div>

                                </div>


                                <!--                                <div class=" grid_1 " style="margin-top: 15px; width: 20px;">
                                                                    <div class="delete_ico milink" onclick="del_registro_rendicion('<?php // echo $cont;      ?>');
                                                                                        sumar_total_rend()" title="Borrar Registro de factura"></div>
                                                                </div>-->
                                <div class=" grid_1 " style="width: 40px;">
                                    <div class="delete_ico milink" onclick="enviar_baul_rechazados('<?php echo $fila->id_det; ?>',<?php echo $cont; ?>);
                                                        " title="Rechazar Registro de factura"></div>
                                    <div class="edit_ico milink" onclick="mostrar_edit_ocultar_datos(<?php echo $cont; ?>, 1);" title="Editar los Datos"></div>
                                </div>
                                <div class="negrilla f18" style=" color:#7EB5EA ; position: absolute;right: 2px; bottom: 2px;">
                        <?php echo $cont; ?>
                                </div>




                            </div>
                        </div>


                        <?php
                        $sumador+= $fila->monto;
                        $subsumador+= $fila->monto;
                    }
                    $sumtraB = $subsumador;
                    $subsumador = 0;
                    ?>
                    <div class="grid_20 f14 negrilla fondoazul colorBlanco">
                        <div class=" grid_7 alin_der " id="">SUBTOTAL .- </div><div class="grid_1 centrartexto fondo_amarillo_claro negrocolor negrilla espabajo5 esparriba5" style="width:75px;"><?php echo number_format($sumtraB, 2, ".", ","); ?></div>
                        <div class="grid_10"></div>
                    </div>  
        <?php
    }


    if ($datos_rendicion_detalle_sgrA->num_rows() > 0) {
        /* $cant = 0;
          $suma_s = 0;
          $suma_total_final=0; */
        ?>
                    <div class="f16 colorcel negrilla espabajo5">SGR-17<span class="colorGuindo">A</span> CON <span class="colorGuindo"> FACTURA</span></div>
                    <div class="">
                        <div class="grid_20 fondoazul colorBlanco" style="position: relative">
                            <div class="grid_4">
                                <div class="letraChica negrilla ">
                                    Tipo de Gastos / Apropiacion
                                </div>

                            </div>
                            <!--                            <div class="grid_1" id="gasto_bloque">
                                                            <div class="letraChica negrilla centrartexto">
                                                                Apropiacion
                                                            </div>
                                                        </div>-->
                            <div class="grid_2 centrartexto " style="width: 75px;">
                                <div class="letraChica negrilla centrartexto">C/Fac Numero</div>
                            </div>
                            <div class="grid_2 centrartexto" style="width: 75px;" title="ingrese la fecha de factura">
                                <div class="letraChica negrilla centrartexto">Fecha Fac</div>
                            </div>

                            <div class="grid_2 centrartexto" style="width: 75px; " title="ingrese el monto de la Factura en Bs">
                                <div class="letraChica negrilla centrartexto">Monto (bs)</div>
                            </div>
                            <div class="grid_3" title="ingrese el detalle de la factura">
                                <div class="letraChica negrilla centrartexto">Detalle Factura</div>
                            </div>
                            <div class="grid_1 ">
                                <div class="letraChica negrilla centrartexto">Cobrar Cliente</div>
                            </div>
                            <div class="grid_2"style="width: 148px;">
                                <div class="letraChica negrilla centrartexto">Estacion/Sitio</div>
                            </div>

                            <div class="grid_3" title="archivos adjuntos">
                                <div class="letraChica negrilla centrartexto milinktext" title="Click para adjuntar archivos" >Archivos adjuntos</div>

                            </div>

                        </div>
                    </div>

        <?php
        foreach ($datos_rendicion_detalle_sgrA->result() as $fila) {
            $cont++;
            $cadena.="," . $cont;
            ?>

                        <div id="dr<?php echo $cont; ?>" class="oculto">
                            <div class="grid_20 esparriba5 espabajo5 fondo_azulclaro_c_borde" style="position: relative">
                                <div class="grid_2">
                                    <div class="letraChica negrilla ">
                                        Tipo de Gastos
                                    </div>
                                    <div class="esparriba5">
                                        <select  style="width: 95px;font-size: 10px;" id="tipo_gasto_for" onchange="mostrar_placa_numero('dr<?php echo $cont; ?> #tipo_gasto_for', 'div_campo<?php echo $cont; ?> ', '<?php echo $fila->placa_vehiculo; ?>');
                                                            carga_tipo_gasto('dr<?php echo $cont . ''; ?> #tipo_gasto_for', 'selec_tipo_servg', 'dr<?php echo $cont; ?> #gasto_bloque', 0);">
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
                                <div class="grid_3" id="gasto_bloque">
                                    <div class="letraChica negrilla centrartexto">
                                        Apropiacion
                                    </div>
                                    <div class="esparriba5 centrartexto f10">
                                        debe seleccionar el tipo de gasto
                                    </div>
                                </div>
                                <script> carga_tipo_gasto('dr<?php echo $cont; ?> #tipo_gasto_for', 'selec_tipo_servg', 'dr<?php echo $cont; ?> #gasto_bloque',<?php echo $fila->id_tipo_gasto; ?>);</script>

                                <div class="grid_2 centrartexto " style="width: 75px;">
                                     <input id='id_apropiacion' type="hidden" value='<?php echo $fila->id_tipo_gasto; ?>'>
                                    <div class="letraChica negrilla centrartexto">C/Fac</div>
                                    <div style="" title="Check si el registro es de una Factura">SI <input  type="checkbox" name="resp"  value="1" id="fac" <?php if ($fila->c_s_factura == 1) echo'checked="checked"'; ?> onclick="ver_campo_nro_factura('dr<?php echo $cont; ?> #fac', 'dr<?php echo $cont; ?> #campo_nro_factura');"  ></div>
                                    <div class="centrartexto ocultar" id="campo_nro_factura" style="width: 75px;" title="ingrese el numero de factura">
                                        <input class="input_redond_100_c f10" placeholder="Nro Factura" style="padding: 1px;margin-top: 0px; width: 69px;" type="text" id="nro_fact"  value="<?php echo $fila->nro_fac; ?>">
                                    </div>
                                    <script>ver_campo_nro_factura('dr<?php echo $cont; ?> #fac', 'dr<?php echo $cont; ?> #campo_nro_factura');</script>
                                </div>


                                <div class="grid_2 centrartexto" style="width: 75px;" title="ingrese la fecha de factura">
                                    <div class="letraChica negrilla centrartexto">Fecha Fac</div>
                                    <input class="input_redond_100_c" style="margin-top: 0px; width: 69px; font-size: 10px; padding: 7 0 7 0;" type="text" id="fec_fact<?php echo $cont; ?>"  value="<?php echo $fila->fecha_factura; ?>">
                                    <script>
                                        $("#fec_fact<?php echo $cont; ?>").datepicker();
                                    </script>
                                </div>

                                <div class="grid_2 centrartexto" style="width: 75px; " title="ingrese el monto de la Factura en Bs">
                                    <div class="letraChica negrilla centrartexto">Monto (bs)</div>
                                    <input class="input_redond_100_c" style="margin-top: 0px; width: 69px;"    type="text" id="monto" onkeyup="val_numero('dr<?php echo $cont; ?> #monto');
                                                        sumar_total_rend()"   value="<?php echo $fila->monto; ?>">

                                </div>
                                <div class="grid_3" title="ingrese el detalle de la factura">
                                    <div class="letraChica negrilla centrartexto">Detalle Factura</div>
                                    <textarea id="detalle_factura" style="width: 145px; height: 27px;font-size: 10px;"><?php echo $fila->glosa; ?></textarea>
                                </div>

                                <div class="grid_1 ">
                                    <div class="letraChica negrilla centrartexto">Cobrar Cliente</div>
                                    <div>SI <input  type="checkbox" name="resp"  value="1" id="cobrar_cliente" <?php if ($fila->cobrar_cliente == 1) echo'checked="checked"'; ?>  ></div>
                                </div>

                                <div class="grid_2"style="width: 148px;">
                                    <div class="letraChica negrilla centrartexto">Estacion/Sitio</div>
                                    <input class="input_redond_100_c estsit" style="margin-top: 0px; width: 148px; font-size: 10px"    type="text" id="estacion_sitio" value="<?php echo $fila->estacion; ?>">

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


                                <!--                                <div class=" grid_1 " style="margin-top: 15px; width: 20px;">
                                                                    <div class="delete_ico milink" onclick="del_registro_rendicion('<?php // echo $cont;      ?>');
                                                                                        sumar_total_rend()" title="Borrar Registro de factura"></div>
                                                                </div>-->
                                <div class=" grid_1 " style=" width: 20px;">
                                    <div class="no_edit_ico milink" onclick="mostrar_edit_ocultar_datos(<?php echo $cont; ?>, 0);" title="Cancelar la edicion"></div>
                                    <div class="delete_ico" onclick="enviar_baul_rechazados('<?php echo $fila->id_det; ?>',<?php echo $cont; ?>);
                                                        " title="Rechazar Registro de factura"></div>

                                </div>
                                <div class="negrilla f18" style=" color:#7EB5EA ; position: absolute;right: 2px; bottom: 2px;">
                                        <?php echo $cont; ?>
                                </div>




                            </div>
                        </div>
                        <!--!//////////////////////////   aqui se muestra los datos para ver-->
                        <div id="drdatos<?php echo $cont; ?>" class="f10">
                            <div class="grid_20 filas esparriba5" style="position: relative">
                                <div class="grid_4 negrilla">
                                    <div class=" ">
                                <?php
                                if ($fila->tipo == "tra")
                                    echo $fila->descripcion_tra . "<br><span class='colorGuindo  f14'>" . $fila->placa_vehiculo . "</span>";
                                if ($fila->tipo == "sgr")
                                    echo $fila->descripcion_tra;
                                if ($fila->tipo == "tel")
                                    echo $fila->descripcion_tra . "<br><span class='colorGuindo negrilla f14'>" . $fila->placa_vehiculo . "</span>";
                                ?>

                                    </div>
                                </div>
                                <!--                                <div class="grid_1" id="gasto_bloque">
            <?php // echo $fila->descripcion_tra;   ?>
                                                                </div>-->
                                <div class="grid_2 centrartexto negrilla f14" style="width: 75px;">
                                    <div style="" title="Check si el registro es de una Factura"> <?php if ($fila->c_s_factura == 1)
                echo $fila->nro_fac;
            else
                echo "RECIBO" . $fila->nro_fac;
            ?></div>
                                </div>
                                <div class="grid_2 centrartexto esparriba5" style="width: 75px;" title="ingrese la fecha de factura">
                                    <?php echo $fila->fecha_factura . "<br>"; ?>
                                </div>

                                <div  class="grid_2 centrartexto colorcel negrilla f12 fondo_amarillo_claro esparriba5 espabajo5" style="width: 75px; " title="ingrese el monto de la Factura en Bs">
            <?php echo number_format($fila->monto, 2, ".", ",") . "<br>"; ?>
                                </div>
                                <div class="grid_3" title="ingrese el detalle de la factura">
            <?php echo $fila->glosa . "<br>"; ?>
                                </div>
                                <div class="grid_1 centrartexto ">
                                        <?php if ($fila->cobrar_cliente == 1)
                                            echo'SI';
                                        else
                                            echo "NO";
                                        ?> 
                                </div>

                                <div class="grid_2"style="width: 148px;">
                                        <?php echo $fila->estacion . "<br>"; ?>


                                </div>

                                <div class="grid_3" title="archivos adjuntos">


                                    <div class="f10" id="adjuntos<?php echo $cont; ?>">
            <?php
            $adj = explode("|", $fila->adjuntos);
            for ($i = 1; $i < count($adj); $i++) {
                ?>
                                            <div id="<?php echo str_replace(".", "", $adj[$i]); ?>dmd">
                                                <div class='milinktextm' style='float:right;' onclick='ver_archivo("uploads/doc_rendicion/<?php echo $adj[$i] ?>", "<?php echo $adj[$i]; ?>")'>
                                             <?php echo substr($adj[$i], 0, 19); ?>
                                                </div >

                                            </div>
                                        <?php
                                    }
                                    ?>  <br>
                                    </div>

                                </div>


                                <!--                                <div class=" grid_1 " style="margin-top: 15px; width: 20px;">
                                                                    <div class="delete_ico milink" onclick="del_registro_rendicion('<?php // echo $cont;     ?>');
                                                                                        sumar_total_rend()" title="Borrar Registro de factura"></div>
                                                                </div>-->
                                <div class=" grid_1 " style="width: 40px;">
                                    <div class="delete_ico milink" onclick="enviar_baul_rechazados('<?php echo $fila->id_det; ?>',<?php echo $cont; ?>);
                                                        " title="Rechazar Registro de factura"></div>
                                    <div class="edit_ico milink" onclick="mostrar_edit_ocultar_datos(<?php echo $cont; ?>, 1);" title="Editar los Datos"></div>
                                </div>
                                <div class="negrilla f18" style=" color:#7EB5EA ; position: absolute;right: 2px; bottom: 2px;">
            <?php echo $cont; ?>
                                </div>




                            </div>
                        </div>

                        <?php
                        $sumador+= $fila->monto;
                        $subsumador+= $fila->monto;
                    }
                    $sumsgrA = $subsumador;
                    $subsumador = 0;
                    ?>
                    <div class="grid_20 f14 negrilla fondoazul colorBlanco">
                        <div class=" grid_7 alin_der " id="">SUBTOTAL .- </div><div class="grid_1 centrartexto fondo_amarillo_claro negrocolor negrilla espabajo5 esparriba5" style="width:75px;"><?php echo number_format($sumsgrA, 2, ".", ","); ?></div>
                        <div class="grid_10"></div>
                    </div>  
        <?php
    }

    if ($datos_rendicion_detalle_sgrB->num_rows() > 0) {
        /* $cant = 0;
          $suma_s = 0;
          $suma_total_final=0; */
        ?>
                    <div class="f16 colorcel negrilla espabajo5">SGR-17<span class="colorGuindo">B</span> CON <span class="colorGuindo">RECIBO</span></div>
                    <div class="">
                        <div class="grid_20 fondoazul colorBlanco" style="position: relative">
                            <div class="grid_4">
                                <div class="letraChica negrilla ">
                                    Tipo de Gastos / Apropiacion
                                </div>

                            </div>
                            <!--                            <div class="grid_1" id="gasto_bloque">
                                                            <div class="letraChica negrilla centrartexto">
                                                                Apropiacion
                                                            </div>
                                                        </div>-->
                            <div class="grid_2 centrartexto " style="width: 75px;">
                                <div class="letraChica negrilla centrartexto">C/Fac Numero</div>
                            </div>
                            <div class="grid_2 centrartexto" style="width: 75px;" title="ingrese la fecha de factura">
                                <div class="letraChica negrilla centrartexto">Fecha Fac</div>
                            </div>

                            <div class="grid_2 centrartexto" style="width: 75px; " title="ingrese el monto de la Factura en Bs">
                                <div class="letraChica negrilla centrartexto">Monto (bs)</div>
                            </div>
                            <div class="grid_3" title="ingrese el detalle de la factura">
                                <div class="letraChica negrilla centrartexto">Detalle Factura</div>
                            </div>
                            <div class="grid_1 ">
                                <div class="letraChica negrilla centrartexto">Cobrar Cliente</div>
                            </div>
                            <div class="grid_2"style="width: 148px;">
                                <div class="letraChica negrilla centrartexto">Estacion/Sitio</div>
                            </div>

                            <div class="grid_3" title="archivos adjuntos">
                                <div class="letraChica negrilla centrartexto milinktext" title="Click para adjuntar archivos" >Archivos adjuntos</div>

                            </div>

                        </div>
                    </div>

        <?php
        foreach ($datos_rendicion_detalle_sgrB->result() as $fila) {
            $cont++;
            $cadena.="," . $cont;
            ?>

                        <div id="dr<?php echo $cont; ?>" class="oculto">
                            <div class="grid_20 esparriba5 espabajo5 fondo_azulclaro_c_borde" style="position: relative">
                                <div class="grid_2">
                                    <div class="letraChica negrilla ">
                                        Tipo de Gastos
                                    </div>
                                    <div class="esparriba5">
                                        <select  style="width: 95px;font-size: 10px;" id="tipo_gasto_for" onchange="mostrar_placa_numero('dr<?php echo $cont; ?> #tipo_gasto_for', 'div_campo<?php echo $cont; ?> ', '<?php echo $fila->placa_vehiculo; ?>');carga_tipo_gasto('dr<?php echo $cont . ''; ?> #tipo_gasto_for', 'selec_tipo_servg', 'dr<?php echo $cont; ?> #gasto_bloque', 0);">
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
                                <div class="grid_3" id="gasto_bloque">
                                    <div class="letraChica negrilla centrartexto">
                                        Apropiacion
                                    </div>
                                    <div class="esparriba5 centrartexto f10">
                                        debe seleccionar el tipo de gasto
                                    </div>
                                </div>
                                <script> carga_tipo_gasto('dr<?php echo $cont; ?> #tipo_gasto_for', 'selec_tipo_servg', 'dr<?php echo $cont; ?> #gasto_bloque',<?php echo $fila->id_tipo_gasto; ?>);</script>

                                <div class="grid_2 centrartexto " style="width: 75px;">
                                     <input id='id_apropiacion' type="hidden" value='<?php echo $fila->id_tipo_gasto; ?>'>
                                    <div class="letraChica negrilla centrartexto">C/Fac</div>
                                    <div style="" title="Check si el registro es de una Factura">SI <input  type="checkbox" name="resp"  value="1" id="fac" <?php if ($fila->c_s_factura == 1) echo'checked="checked"'; ?> onclick="ver_campo_nro_factura('dr<?php echo $cont; ?> #fac', 'dr<?php echo $cont; ?> #campo_nro_factura');"  ></div>
                                    <div class="centrartexto ocultar" id="campo_nro_factura" style="width: 75px;" title="ingrese el numero de factura">
                                        <input class="input_redond_100_c f10" placeholder="Nro Factura" style="padding: 1px;margin-top: 0px; width: 69px;" type="text" id="nro_fact"  value="<?php echo $fila->nro_fac; ?>">
                                    </div>
                                    <script>ver_campo_nro_factura('dr<?php echo $cont; ?> #fac', 'dr<?php echo $cont; ?> #campo_nro_factura');</script>
                                </div>


                                <div class="grid_2 centrartexto" style="width: 75px;" title="ingrese la fecha de factura">
                                    <div class="letraChica negrilla centrartexto">Fecha Fac</div>
                                    <input class="input_redond_100_c" style="margin-top: 0px; width: 69px; font-size: 10px; padding: 7 0 7 0;" type="text" id="fec_fact<?php echo $cont; ?>"  value="<?php echo $fila->fecha_factura; ?>">
                                    <script>
                                        $("#fec_fact<?php echo $cont; ?>").datepicker();
                                    </script>
                                </div>

                                <div class="grid_2 centrartexto" style="width: 75px; " title="ingrese el monto de la Factura en Bs">
                                    <div class="letraChica negrilla centrartexto">Monto (bs)</div>
                                    <input class="input_redond_100_c" style="margin-top: 0px; width: 69px;"    type="text" id="monto" onkeyup="val_numero('dr<?php echo $cont; ?> #monto'); sumar_total_rend()"   value="<?php echo $fila->monto; ?>">

                                </div>
                                <div class="grid_3" title="ingrese el detalle de la factura">
                                    <div class="letraChica negrilla centrartexto">Detalle Factura</div>
                                    <textarea id="detalle_factura" style="width: 145px; height: 27px;font-size: 10px;"><?php echo $fila->glosa; ?></textarea>
                                </div>

                                <div class="grid_1 ">
                                    <div class="letraChica negrilla centrartexto">Cobrar Cliente</div>
                                    <div>SI <input  type="checkbox" name="resp"  value="1" id="cobrar_cliente" <?php if ($fila->cobrar_cliente == 1) echo'checked="checked"'; ?>  ></div>
                                </div>

                                <div class="grid_2"style="width: 148px;">
                                    <div class="letraChica negrilla centrartexto">Estacion/Sitio</div>
                                    <input class="input_redond_100_c estsit" style="margin-top: 0px; width: 148px; font-size: 10px"    type="text" id="estacion_sitio" value="<?php echo $fila->estacion; ?>">

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


                                <!--                                <div class=" grid_1 " style="margin-top: 15px; width: 20px;">
                                                                    <div class="delete_ico milink" onclick="del_registro_rendicion('<?php // echo $cont;     ?>');
                                                                                        sumar_total_rend()" title="Borrar Registro de factura"></div>
                                                                </div>-->
                                <div class=" grid_1 " style=" width: 20px;">
                                    <div class="no_edit_ico milink" onclick="mostrar_edit_ocultar_datos(<?php echo $cont; ?>, 0);" title="Cancelar la edicion"></div>
                                    <div class="delete_ico" onclick="enviar_baul_rechazados('<?php echo $fila->id_det; ?>',<?php echo $cont; ?>);
                                                        " title="Rechazar Registro de factura"></div>

                                </div>
                                <div class="negrilla f18" style=" color:#7EB5EA ; position: absolute;right: 2px; bottom: 2px;">
                                        <?php echo $cont; ?>
                                </div>




                            </div>
                        </div>
                        <!--!//////////////////////////   aqui se muestra los datos para ver-->
                        <div id="drdatos<?php echo $cont; ?>" class="f10">
                            <div class="grid_20 filas esparriba5" style="position: relative">
                                <div class="grid_4 negrilla">
                                    <div class=" ">
                                    <?php
                                    if ($fila->tipo == "tra")
                                        echo $fila->descripcion_tra . "<br><span class='colorGuindo  f14'>" . $fila->placa_vehiculo . "</span>";
                                    if ($fila->tipo == "sgr")
                                        echo $fila->descripcion_tra;
                                    if ($fila->tipo == "tel")
                                        echo $fila->descripcion_tra . "<br><span class='colorGuindo negrilla f14'>" . $fila->placa_vehiculo . "</span>";
                                    ?>

                                    </div>
                                </div>
                                <!--                                <div class="grid_1" id="gasto_bloque">
                                    <?php // echo $fila->descripcion_tra; ?>
                                                                </div>-->
                                <div class="grid_2 centrartexto negrilla f14" style="width: 75px;">
                                    <div style="" title="Check si el registro es de una Factura"> <?php if ($fila->c_s_factura == 1)
                            echo $fila->nro_fac;
                        else
                            echo "RECIBO" . $fila->nro_fac;
                        ?></div>
                                </div>
                                <div class="grid_2 centrartexto esparriba5" style="width: 75px;" title="ingrese la fecha de factura">
            <?php echo $fila->fecha_factura . "<br>"; ?>
                                </div>

                                <div  class="grid_2 centrartexto colorcel negrilla f12 fondo_amarillo_claro esparriba5 espabajo5" style="width: 75px; " title="ingrese el monto de la Factura en Bs">
                                        <?php echo number_format($fila->monto, 2, ".", ",") . "<br>"; ?>
                                </div>
                                <div class="grid_3" title="ingrese el detalle de la factura">
            <?php echo $fila->glosa . "<br>"; ?>
                                </div>
                                <div class="grid_1 centrartexto ">
            <?php if ($fila->cobrar_cliente == 1)
                echo'SI';
            else
                echo "NO";
            ?> 
                                </div>

                                <div class="grid_2"style="width: 148px;">

            <?php echo $fila->estacion . "<br>"; ?>

                                </div>

                                <div class="grid_3" title="archivos adjuntos">


                                    <div class="f10" id="adjuntos<?php echo $cont; ?>">
                                    <?php
                                         $adj = explode("|", $fila->adjuntos);
                                         for ($i = 1; $i < count($adj); $i++) {
                                             ?>
                                            <div id="<?php echo str_replace(".", "", $adj[$i]); ?>dmd">
                                                <div class='milinktextm' style='float:right;' onclick='ver_archivo("uploads/doc_rendicion/<?php echo $adj[$i] ?>", "<?php echo $adj[$i]; ?>")'>
                <?php echo substr($adj[$i], 0, 19); ?>
                                                </div >

                                            </div>
                <?php
            }
            ?>  <br>
                                    </div>

                                </div>


                                <!--                                <div class=" grid_1 " style="margin-top: 15px; width: 20px;">
                                                                    <div class="delete_ico milink" onclick="del_registro_rendicion('<?php // echo $cont;     ?>');
                                                                                        sumar_total_rend()" title="Borrar Registro de factura"></div>
                                                                </div>-->
                                <div class=" grid_1 " style="width: 40px;">
                                    <div class="delete_ico milink" onclick="enviar_baul_rechazados('<?php echo $fila->id_det; ?>',<?php echo $cont; ?>);
                                                       " title="Rechazar Registro de factura"></div>
                                    <div class="edit_ico milink" onclick="mostrar_edit_ocultar_datos(<?php echo $cont; ?>, 1);" title="Editar los Datos"></div>
                                </div>
                                <div class="negrilla f18" style=" color:#7EB5EA ; position: absolute;right: 2px; bottom: 2px;">
                        <?php echo $cont; ?>
                                </div>




                            </div>
                        </div>


            <?php
            $sumador+= $fila->monto;
            $subsumador+= $fila->monto;
        }
        $sumsgrB = $subsumador;
        $subsumador = 0;
        ?>
                    <div class="grid_20 f14 negrilla fondoazul colorBlanco">
                        <div class=" grid_7 alin_der " id="">SUBTOTAL .- </div><div class="grid_1 centrartexto fondo_amarillo_claro negrocolor negrilla espabajo5 esparriba5" style="width:75px;">
        <?php echo number_format($sumsgrB, 2, ".", ","); ?></div>
                        <div class="grid_10"></div>
                    </div>  
        <?php
    }


    if ($datos_rendicion_detalle_sgrC->num_rows() > 0) {
        ?>
                    <div class="f16 colorcel negrilla espabajo5">SGR-17<span class="colorGuindo">C</span> TELEFONIA CON <span class="colorGuindo">FACTURA</span></div>
                    <div class="">
                        <div class="grid_20 fondoazul colorBlanco" style="position: relative">
                            <div class="grid_4">
                                <div class="letraChica negrilla ">
                                    Tipo de Gastos / Apropiacion
                                </div>

                            </div>
                            <!--                            <div class="grid_1" id="gasto_bloque">
                                                            <div class="letraChica negrilla centrartexto">
                                                                Apropiacion
                                                            </div>
                                                        </div>-->
                            <div class="grid_2 centrartexto " style="width: 75px;">
                                <div class="letraChica negrilla centrartexto">C/Fac Numero</div>
                            </div>
                            <div class="grid_2 centrartexto" style="width: 75px;" title="ingrese la fecha de factura">
                                <div class="letraChica negrilla centrartexto">Fecha Fac</div>
                            </div>

                            <div class="grid_2 centrartexto" style="width: 75px; " title="ingrese el monto de la Factura en Bs">
                                <div class="letraChica negrilla centrartexto">Monto (bs)</div>
                            </div>
                            <div class="grid_3" title="ingrese el detalle de la factura">
                                <div class="letraChica negrilla centrartexto">Detalle Factura</div>
                            </div>
                            <div class="grid_1 ">
                                <div class="letraChica negrilla centrartexto">Cobrar Cliente</div>
                            </div>
                            <div class="grid_2"style="width: 148px;">
                                <div class="letraChica negrilla centrartexto">Estacion/Sitio</div>
                            </div>

                            <div class="grid_3" title="archivos adjuntos">
                                <div class="letraChica negrilla centrartexto milinktext" title="Click para adjuntar archivos" >Archivos adjuntos</div>

                            </div>

                        </div>
                    </div>

        <?php
        foreach ($datos_rendicion_detalle_sgrC->result() as $fila) {
            $cont++;
            $cadena.="," . $cont;
            ?>

                        <div id="dr<?php echo $cont; ?>" class="oculto">
                            <div class="grid_20 esparriba5 espabajo5 fondo_azulclaro_c_borde" style="position: relative">
                                <div class="grid_2">
                                    <div class="letraChica negrilla ">
                                        Tipo de Gastos
                                    </div>
                                    <div class="esparriba5">
                                        <select  style="width: 95px;font-size: 10px;" id="tipo_gasto_for" onchange="mostrar_placa_numero('dr<?php echo $cont; ?> #tipo_gasto_for', 'div_campo<?php echo $cont; ?> ', '<?php echo $fila->placa_vehiculo; ?>');
                                                            carga_tipo_gasto('dr<?php echo $cont . ''; ?> #tipo_gasto_for', 'selec_tipo_servg', 'dr<?php echo $cont; ?> #gasto_bloque', 0);">
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
                                <div class="grid_3" id="gasto_bloque">
                                    <div class="letraChica negrilla centrartexto">
                                        Apropiacion
                                    </div>
                                    <div class="esparriba5 centrartexto f10">
                                        debe seleccionar el tipo de gasto
                                    </div>
                                </div>
                                <script> carga_tipo_gasto('dr<?php echo $cont; ?> #tipo_gasto_for', 'selec_tipo_servg', 'dr<?php echo $cont; ?> #gasto_bloque',<?php echo $fila->id_tipo_gasto; ?>);</script>

                                <div class="grid_2 centrartexto " style="width: 75px;">
                                     <input id='id_apropiacion' type="hidden" value='<?php echo $fila->id_tipo_gasto; ?>'>
                                    <div class="letraChica negrilla centrartexto">C/Fac</div>
                                    <div style="" title="Check si el registro es de una Factura">SI <input  type="checkbox" name="resp"  value="1" id="fac" <?php if ($fila->c_s_factura == 1) echo'checked="checked"'; ?> onclick="ver_campo_nro_factura('dr<?php echo $cont; ?> #fac', 'dr<?php echo $cont; ?> #campo_nro_factura');"  ></div>
                                    <div class="centrartexto ocultar" id="campo_nro_factura" style="width: 75px;" title="ingrese el numero de factura">
                                        <input class="input_redond_100_c f10" placeholder="Nro Factura" style="padding: 1px;margin-top: 0px; width: 69px;" type="text" id="nro_fact"  value="<?php echo $fila->nro_fac; ?>">
                                    </div>
                                    <script>ver_campo_nro_factura('dr<?php echo $cont; ?> #fac', 'dr<?php echo $cont; ?> #campo_nro_factura');</script>
                                </div>


                                <div class="grid_2 centrartexto" style="width: 75px;" title="ingrese la fecha de factura">
                                    <div class="letraChica negrilla centrartexto">Fecha Fac</div>
                                    <input class="input_redond_100_c" style="margin-top: 0px; width: 69px; font-size: 10px; padding: 7 0 7 0;" type="text" id="fec_fact<?php echo $cont; ?>"  value="<?php echo $fila->fecha_factura; ?>">
                                    <script>
                                        $("#fec_fact<?php echo $cont; ?>").datepicker();
                                    </script>
                                </div>

                                <div class="grid_2 centrartexto" style="width: 75px; " title="ingrese el monto de la Factura en Bs">
                                    <div class="letraChica negrilla centrartexto">Monto (bs)</div>
                                    <input class="input_redond_100_c" style="margin-top: 0px; width: 69px;"    type="text" id="monto" onkeyup="val_numero('dr<?php echo $cont; ?> #monto'); sumar_total_rend()"   value="<?php echo $fila->monto; ?>">

                                </div>
                                <div class="grid_3" title="ingrese el detalle de la factura">
                                    <div class="letraChica negrilla centrartexto">Detalle Factura</div>
                                    <textarea id="detalle_factura" style="width: 145px; height: 27px;font-size: 10px;"><?php echo $fila->glosa; ?></textarea>
                                </div>

                                <div class="grid_1 ">
                                    <div class="letraChica negrilla centrartexto">Cobrar Cliente</div>
                                    <div>SI <input  type="checkbox" name="resp"  value="1" id="cobrar_cliente" <?php if ($fila->cobrar_cliente == 1) echo'checked="checked"'; ?>  ></div>
                                </div>

                                <div class="grid_2"style="width: 148px;">
                                    <div class="letraChica negrilla centrartexto">Estacion/Sitio</div>
                                    <input class="input_redond_100_c estsit" style="margin-top: 0px; width: 148px; font-size: 10px"    type="text" id="estacion_sitio" value="<?php echo $fila->estacion; ?>">

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


                                <!--                                <div class=" grid_1 " style="margin-top: 15px; width: 20px;">
                                                                    <div class="delete_ico milink" onclick="del_registro_rendicion('<?php // echo $cont;     ?>');
                                                                                        sumar_total_rend()" title="Borrar Registro de factura"></div>
                                                                </div>-->
                                <div class=" grid_1 " style=" width: 20px;">
                                    <div class="no_edit_ico milink" onclick="mostrar_edit_ocultar_datos(<?php echo $cont; ?>, 0);" title="Cancelar la edicion"></div>
                                    <div class="delete_ico" onclick="enviar_baul_rechazados('<?php echo $fila->id_det; ?>',<?php echo $cont; ?>);
                                                        " title="Rechazar Registro de factura"></div>

                                </div>
                                <div class="negrilla f18" style=" color:#7EB5EA ; position: absolute;right: 2px; bottom: 2px;">
                                <?php echo $cont; ?>
                                </div>




                            </div>
                        </div>
                        <!--!//////////////////////////   aqui se muestra los datos para ver-->
                        <div id="drdatos<?php echo $cont; ?>" class="f10">
                            <div class="grid_20 filas esparriba5" style="position: relative">
                                <div class="grid_4 negrilla">
                                    <div class=" ">
            <?php
            if ($fila->tipo == "tra")
                echo $fila->descripcion_tra . "<br><span class='colorGuindo  f14'>" . $fila->placa_vehiculo . "</span>";
            if ($fila->tipo == "sgr")
                echo $fila->descripcion_tra;
            if ($fila->tipo == "tel")
                echo $fila->descripcion_tra . "<br><span class='colorGuindo negrilla f14'>" . $fila->placa_vehiculo . "</span>";
            ?>

                                    </div>
                                </div>
                                <!--                                <div class="grid_1" id="gasto_bloque">
            <?php // echo $fila->descripcion_tra;   ?>
                                                                </div>-->
                                <div class="grid_2 centrartexto negrilla f14" style="width: 75px;">
                                    <div style="" title="Check si el registro es de una Factura"> <?php if ($fila->c_s_factura == 1)
                echo $fila->nro_fac;
            else
                echo "RECIBO" . $fila->nro_fac;
            ?></div>
                                </div>
                                <div class="grid_2 centrartexto esparriba5" style="width: 75px;" title="ingrese la fecha de factura">
                                        <?php echo $fila->fecha_factura . "<br>"; ?>
                                </div>

                                <div  class="grid_2 centrartexto colorcel negrilla f12 fondo_amarillo_claro esparriba5 espabajo5" style="width: 75px; " title="ingrese el monto de la Factura en Bs">
            <?php echo number_format($fila->monto, 2, ".", ",") . "<br>"; ?>
                                </div>
                                <div class="grid_3" title="ingrese el detalle de la factura">
                                        <?php echo $fila->glosa . "<br>"; ?>
                                </div>
                                <div class="grid_1 centrartexto ">
            <?php if ($fila->cobrar_cliente == 1)
                echo'SI';
            else
                echo "NO";
            ?> 
                                </div>

                                <div class="grid_2"style="width: 148px;">

            <?php echo $fila->estacion . "<br>"; ?>

                                </div>

                                <div class="grid_3" title="archivos adjuntos">


                                    <div class="f10" id="adjuntos<?php echo $cont; ?>">
            <?php
            $adj = explode("|", $fila->adjuntos);
            for ($i = 1; $i < count($adj); $i++) {
                ?>
                                            <div id="<?php echo str_replace(".", "", $adj[$i]); ?>dmd">
                                                <div class='milinktextm' style='float:right;' onclick='ver_archivo("uploads/doc_rendicion/<?php echo $adj[$i] ?>", "<?php echo $adj[$i]; ?>")'>
                <?php echo substr($adj[$i], 0, 19); ?>
                                                </div >

                                            </div>
                            <?php
                        }
                        ?>  <br>
                                    </div>

                                </div>


                                <!--                                <div class=" grid_1 " style="margin-top: 15px; width: 20px;">
                                                                    <div class="delete_ico milink" onclick="del_registro_rendicion('<?php // echo $cont;     ?>');
                                                                                        sumar_total_rend()" title="Borrar Registro de factura"></div>
                                                                </div>-->
                                <div class=" grid_1 " style="width: 40px;">
                                    <div class="delete_ico milink" onclick="enviar_baul_rechazados('<?php echo $fila->id_det; ?>',<?php echo $cont; ?>);
                                                        " title="Rechazar Registro de factura"></div>
                                    <div class="edit_ico milink" onclick="mostrar_edit_ocultar_datos(<?php echo $cont; ?>, 1);" title="Editar los Datos"></div>
                                </div>
                                <div class="negrilla f18" style=" color:#7EB5EA ; position: absolute;right: 2px; bottom: 2px;">
                        <?php echo $cont; ?>
                                </div>




                            </div>
                        </div>


            <?php
            $sumador+= $fila->monto;
            $subsumador+= $fila->monto;
        }
        $sumsgrC = $subsumador;
        $subsumador = 0;
        ?>
                    <div class="grid_20 f14 negrilla fondoazul colorBlanco">
                        <div class=" grid_7 alin_der " id="">SUBTOTAL .- </div><div class="grid_1 centrartexto fondo_amarillo_claro negrocolor negrilla espabajo5 esparriba5" style="width:75px;"><?php echo number_format($sumsgrC, 2, ".", ","); ?></div>
                        <div class="grid_10"></div>
                    </div>  
            <?php } ?>

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
        <div class="grid_4 f10 negrilla colorRojo">..</div>
        <div class="grid_8 OK espabajo5 esparriba5">
            <div class="grid_3 f14 negrilla ">T O T A L .- </div>
            <div class="grid_4 f16 negrilla " id="monto_total_rendicion"><?php echo number_format($sumador, 2, ".", ","); ?></div>
        </div>
         <div class="grid_5 prefix_2">
             <div class="boton centrartexto milink" onclick="add_registro()" style="">Agregar nuevo Registro de Factura</div>
           </div>
    </div>    


    <div class="grid_20">
<?php if ($id_rend != 0) { ?>
            <div class="grid_6" style="padding-top: 10px">
                <div class="negrilla" >Resumen</div>
                <div class="grid_6 centrartexto f10 ">
                    <div class="grid_6 fondoazul colorBlanco negrilla bordeado">
                        <div class="grid_2">Formulario</div>
                        <div class="grid_2">Cantidad Factura/recibos</div>
                        <div class="grid_2">Subtotal (bs)</div></div>
                    <div class="grid_6 fondo_plomo_claro_areas">
                        <div class="grid_2 ">TRA08 A</div>
                        <div class="grid_2"><?php echo $datos_rendicion_detalle_traA->num_rows(); ?></div>
                        <div class="grid_2 alin_der"><?php echo number_format($sumtraA, 2, ".", ","); ?></div></div>
                    <div class="grid_6">
                        <div class="grid_2">TRA08 B</div>
                        <div class="grid_2"><?php echo $datos_rendicion_detalle_traB->num_rows(); ?></div>
                        <div class="grid_2 alin_der"><?php echo number_format($sumtraB, 2, ".", ","); ?></div></div>
                    <div class="grid_6 fondo_plomo_claro_areas">
                        <div class="grid_2 ">SGR17 A</div>
                        <div class="grid_2"><?php echo $datos_rendicion_detalle_sgrA->num_rows(); ?></div>
                        <div class="grid_2 alin_der"><?php echo number_format($sumsgrA, 2, ".", ","); ?></div></div>
                    <div class="grid_6">
                        <div class="grid_2">SGR17 B</div>
                        <div class="grid_2"><?php echo $datos_rendicion_detalle_sgrB->num_rows(); ?></div>
                        <div class="grid_2 alin_der"><?php echo number_format($sumsgrB, 2, ".", ","); ?></div></div>
                    <div class="grid_6 fondo_plomo_claro_areas">
                        <div class="grid_2 ">SGR17 C</div>
                        <div class="grid_2"><?php echo $datos_rendicion_detalle_sgrC->num_rows(); ?></div>
                        <div class="grid_2 alin_der"><?php echo number_format($sumsgrC, 2, ".", ","); ?></div>
                    </div >
                    <div class="grid_6 fondoazul colorBlanco f10 negrilla bordeado">
                        <div class="grid_2">TOTAL</div>
                        <div class="grid_2"><?php echo $datos_rendicion_detalle_traA->num_rows() + $datos_rendicion_detalle_traB->num_rows() + $datos_rendicion_detalle_sgrA->num_rows() + $datos_rendicion_detalle_sgrB->num_rows() + $datos_rendicion_detalle_sgrC->num_rows(); ?></div>
                        <div class="grid_2 alin_der"><?php echo number_format(($sumsgrA + $sumsgrB + $sumsgrC + $sumtraA + $sumtraB), 2, ".", ","); ?></div>
                    </div >
                </div >


            </div>
<?php } ?>
        <div class="grid_12 prefix_1  "style="padding-top: 10px" >
            <div class="f11 letraChica negrilla "> Descripcion General de la Rendicion</div
            ><textarea class="textarea_redond_382x65" style="width: 647px; height: 103px;" type="text" id="desc" placeholder=""   placeholder="Escriba una descripcion" ><?php echo $desc; ?></textarea>

        </div>
    </div>
    <script>carga_estaciones_proy("proyecto_seleccionado", "ayuda_autocomplete");
        $('#vB').button('enable');
        $('#rechazar_rend').button('enable');
        $('#save_reg').button('enable');
    </script>
<?php
//echo $estado;

if ($estado != "Modificado Responsable" && $estado != "Enviado a responsable") {
    $vobos = explode("|", $ids_vobos);

    if (in_array($id_me, $vobos)) {
        echo "<script>  $('#vB').button('disable');$('#rechazar_rend').button('disable');
             $('#save_reg').button('disable');</script>";
    }
}
?>
</div>
<div id="mensaje_fin"></div>







