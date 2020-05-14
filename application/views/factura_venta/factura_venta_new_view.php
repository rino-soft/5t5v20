<?php
$id_cliente = "";
$rs = "";
$nit = "";
$ids = "";
$cant_item = 0;
$monto_total = 0;
$comentario = "";
$codigo_items = "";
$nit_cliente = "";
$razon_social = "";
$id_proyecto = 0;
$id_contrato = 0;
$desactivado = '';
$penalidad = 0;
$comentario_penalidad = '';
$tipo_fac = "";
$fecha_est_cob = "";
$seguimiento_old = "";
$tpca = "";
$tpec = "";
$tpinst = "";
$tpinsu = "";
$tpven = "";
$tpotr = "";


if ($id_send != 0) {
    $num_fac = $data_fac->num_factura;
    $id_disificacion = $data_fac->id_dosificacion;
    $fecha_hora_registro = $data_fac->fh_registro;
    $id_cliente = $data_fac->id_cliente;
    $subtotal_bs = $data_fac->subtotal_bs;
    $nit_cliente = $data_fac->NIT_cliente;
    $razon_social = $data_fac->razon_social;

    $id_proyecto = $data_fac->id_proyecto;
    $id_contrato = $data_fac->id_contrato;

    //$cant_item = $data_fac->num_rows();
    $monto_total = $data_fac->monto_total_bs;
    $comentario = $data_fac->comentario;
    $vec_ids = array();
    $i = 0;
    $codigo_items = "";
    $desactivado = ' disabled="disabled "';

    $penalidad = $data_fac->penalidad;
    $comentario_penalidad = $data_fac->comentarios_penalidad;
    $tipo_fac = explode("*", $data_fac->tipo_trabajo);
    $fecha_est_cob = $data_fac->fecha_prevista_cobro;
    $seguimiento_old = $data_fac->comentarios_seguimiento;

    if (in_array("Canon", $tipo_fac))
        $tpca = " checked='checked' ";
    if (in_array("Extra Canon", $tipo_fac))
        $tpec = " checked='checked' ";
    if (in_array("Instalacion", $tipo_fac))
        $tpinst = " checked='checked' ";
    if (in_array("Insumos", $tipo_fac))
        $tpinsu = " checked='checked' ";
    if (in_array("Venta", $tipo_fac))
        $tpven = " checked='checked' ";
    if (in_array("Otro", $tipo_fac))
        $tpotr = " checked='checked' ";
}
?>







<div class="container_20">
    <div class="grid_20">
        <div class="grid_14">

            <div class="grid_14 esparriba10">
                <select id="id_actividad" style="width: 500px;" >

                    <?php
                    foreach ($lista_dosificacion->result() as $dosif) {
                        $sel = "";
                        if ($id_disificacion == $dosif->id_dosificacion)
                            $sel = " selected='selected' ";
                        echo "<option value='$dosif->id_dosificacion' $sel onclick='$(\"#tipo_dosificacion\").html(\"$dosif->tipo_dosificacion\")' >$dosif->tipo_dosificacion - $dosif->actividad</option>";
                    }
                    ?>
                </select>
            </div>
            <script> $("#id_actividad :selected").click();</script>
            <div class="grid_14 negrilla">Dosificaciones Activas</div>
        </div>
        <div class="grid_5 bordeado">
            <?php if ($id_send != 0) { ?>
                <div class="grid_2 ">
                    <div class="grid_2 f18 centrartexto  ">
                        <?php echo $id_send; ?>

                    </div>
                    <div class="grid_2 f10 negrilla centrartexto ">
                        Id Registro
                    </div>
                </div>
                <div class="grid_3 ">
                    <div class="grid_3 f18 colorRojo centrartexto ">
                        <?php echo $num_fac; ?>
                    </div>
                    <div class="grid_3 f10 negrilla centrartexto ">
                        Nro de Factura 
                    </div>
                </div>

            <?php } ?>
        </div>
        <div class="grid_20 alin_der f30 negrilla" id="tipo_dosificacion">
            
        </div>
    </div>
    <div class="grid_7 esparriba10">
        <div class="grid_7 esparriba5">
            <select id="cliente" style="float: left; margin-top: 5px ; width: 300px; " <?php echo $desactivado; ?> onchange="listar_proy_contr('cliente', 'proyecto_div', 0)" >
                <option value="-1" onclick="$('#id_cliente').val('');$('#nit').val('');$('#rs').val('')" disabled="disabled" selected="selected">Seleccione el cliente</option>
                <?php
                foreach ($lista_clientes as $cli) {
                    $sel = "";
                    if ($cli->id_cliente == $id_cliente)
                        $sel = " selected='selected' "
                        ?>
                    <option <?php echo $sel; ?> value='<?php echo $cli->id_cliente; ?>' onclick="$('#id_cliente').val('<?php echo $cli->id_cliente ?>');
                                $('#nit').val('<?php echo $cli->nit ?>');
                                $('#rs').val('<?php echo $cli->razon_social; ?>');" ><?php echo $cli->razon_social; ?></option>
                                                <?php
                                            }
                                            ?>
            </select>
            <div class=" empresa_icono milink" title="Cliente Nuevo" style="float: left;" 
                 onclick="dialog_contenidos_nuevo_cliente('ayuda_dialog', '<?php echo base_url() . "cliente/cliente_nuevo/0"; ?>')">

            </div>
        </div>



        <div class="grid_7 negrilla">Cliente</div>
    </div>
    <div class="grid_13">
        <div class="grid_4 prefix_1 suffix_1"> 
            <input class="" type="hidden" id="id_ov_pf" value="<?php echo $id_send; ?>">
            <input class="" type="hidden" id="id_cliente" value="<?php echo $id_cliente; ?>" placeholder="id_cliente">
            <input class="input_redond_200  " type="text" id="nit" placeholder="NIT" readonly="readonly" <?php echo $desactivado; ?> value="<?php echo $nit_cliente; ?>">

            <div class="f10 negrilla"> Numero de NIT o CI</div>
        </div>
        <div class="grid_7">
            <input class="input_redond_350 " type="text" id="rs" readonly="readonly" <?php echo $desactivado; ?> placeholder="Nombre o Razon Social" value="<?php echo $razon_social; ?>">
            <div class="f10 negrilla"> Nombre o Razon Social</div>
        </div>

    </div>
    <div class="grid_20">
        <div class="grid_6">
            <!--<div class="grid_5">
                <div class="grid_5 esparriba10"><select ><option>asasasdasdasd</option></select></div>
                <div class="grid_5 negrilla">sucursal</div>

            </div>-->
            <div class="grid_6 esparriba10" id="proyecto_div">Para mostrar Seleccione el cliente
            </div>
            <div class="grid_6 negrilla f10">proyecto</div>

        </div>
        <div class="grid_8 " >
            <div class="grid_8 esparriba10" id="contrato_div"> Para mostrar Seleccione el Proyecto
            </div>
            <div class="grid_8 negrilla f10">Contrato</div>
        </div>
        <script>
            listar_proy_contr('cliente', 'proyecto_div',<?php echo $id_proyecto; ?>);

        </script>
        <div class="grid_6" >
            <div class="grid_6 esparriba10" id="contrato_div">
                <input type="text" id="pcompra"  class="input_redond_300" style="margin-top: 0px">
            </div>
            <div class="grid_6 negrilla f10">Pedido de Compra</div>   
        </div>   
    </div>



    <br>
    <div class="grid_20 fondo_plomo_claro_areas esparriba10 espabajo10">    

        <div class="grid_20 centrartexto negrilla f16 espaciado5" >

            <div class="grid_10 prefix_5 colorGuindo">

                D E T A L L E </div>
            <div class="grid_3 prefix_1 suffix_1"> 
                <?php if ($desactivado == "") { ?>
                    <div class="boton2 f12 espaciado5 milink" onclick="add_fila_factura_venta()"> Adicionar Item</div>
                <?php } else echo "<br>"; ?>
            </div>
        </div>
        <div class="grid_20">
            <div class="grid_20 negrilla fondo_azul colorBlanco">
                <div class="grid_2 prefix_1 centrartexto">Cantidad</div>
                <div class="grid_10 centrartexto">Descripción</div>
                <div class="grid_3 centrartexto">Precio Unitario</div>
                <div class="grid_3 suffix_1 centrartexto">Subtotal</div>
            </div>


        </div>

        <div class="ocultar" id="modelo_fila">

            <div class="grid_2 prefix_1 centrartexto "> <input id="cantidad_f" onchange="calculo_fila('XXX');calcular_total();"  type="number" min="0" value="1" class="centrartexto" style="width: 90px ; padding: 10px 0 10px 0;"></div>
            <div class="grid_10 centrartexto ">
                <textarea required="required" id="descripcion_f" onkeyup="limitar_glosa_factura('XXX')" style="width: 490px; height: 40px" placeholder="Escriba la descripcion del Item a facturar"></textarea>
                <div class="grid_10 f10 colorGuindo alin_der ">cantidad de caracteres disponibles <span class="contador_caracteres">2771</span></div>
            </div>
            <div class="grid_3 centrartexto "><input class="centrartexto" value="0" onchange="calculo_fila('XXX');calcular_total();" onkeyup="val_numero('filaXXX #precio_unitario_f')" id="precio_unitario_f" type="text" style="width: 145px ;padding: 10px 0 10px 0;" ></div>
            <div class="grid_3 centrartexto "><input class="centrartexto negrilla fondo_amarillo_claro" readonly="true" value="0" id="subtotal_f" type="text" style="width: 145px ;padding: 10px 0 10px 0;" ></div>
            <div class="grid_1 centrartexto esparriba10"><div class="delete_ico" onclick="del_fila_factura_venta('XXX');calcular_total();"></div></div>
            <input type="hidden" id="filas_texto" value="0">
            <input type="hidden" id="caracter_texto" value="0">


        </div>
        <div class="grid_20 ">


            <?php
            if ($codigo_items == "")
                echo "";
            else
                echo $codigo_items;
            ?>
        </div>



        <input type="hidden" id="total_filas_factura" value="0">
        <?php
        $co = 0;
        $ids = "";
        if ($id_send != 0) {
            ?>
            <div class="grid_20" id="detalle_factura_venta">
                <!-- aqui se muestra el detalle de la facrura_ venta  -->
                <?php
                foreach ($detalle_fac->result() as $det) {
                    $co++;
                    $ids.="," . $co;
                    ?>
                    <div class="grid_20" id="fila<?php echo $co; ?>">
                        <div class="grid_2 prefix_1 centrartexto "> <input id="cantidad_f" onchange="calculo_fila('<?php echo $co; ?>');calcular_total();"  type="number" min="0" value="<?php echo $det->cantidad; ?>" class="centrartexto" style="width: 90px ; padding: 10px 0 10px 0;"></div>
                        <div class="grid_10 centrartexto ">
                            <textarea required="required" id="descripcion_f" onkeyup="limitar_glosa_factura('<?php echo $co; ?>')" style="width: 490px; height: 40px" placeholder="Escriba la descripcion del Item a facturar"><?php echo $det->detalle_ps; ?></textarea>
                            <div class="grid_10 f10 colorGuindo alin_der ">cantidad de caracteres disponibles <span class="contador_caracteres">2771</span></div>
                        </div>
                        <div class="grid_3 centrartexto "><input class="centrartexto" value="<?php echo $det->precio; ?>" onchange="calculo_fila('<?php echo $co; ?>');
                                        calcular_total();" onkeyup="val_numero('fila<?php echo $co; ?> #precio_unitario_f')" id="precio_unitario_f" <?php echo $desactivado; ?> type="text" style="width: 145px ;padding: 10px 0 10px 0;" ></div>
                        <div class="grid_3 centrartexto "><input class="centrartexto negrilla fondo_amarillo_claro" readonly="true" value="<?php echo $det->importe; ?>" id="subtotal_f" type="text" style="width: 145px ;padding: 10px 0 10px 0;" ></div>
                        <div class="grid_1 centrartexto esparriba10"><div class="delete_ico" onclick="del_fila_factura_venta('<?php echo $co; ?>');calcular_total();"></div></div>
                        <input type="hidden" id="filas_texto" value="0">
                        <input type="hidden" id="caracter_texto" value="0">
                    </div>
                <?php } ?>
            </div>

            <?php
        } else {
            ?>
            <div class="grid_20" id="detalle_factura_venta">

            </div>
            <script>add_fila_factura_venta();</script>
        <?php } ?>
        <input type="hidden" id="nro_reg" value="<?php echo $co; ?>"><input type="hidden" value="<?php echo $ids; ?>" id="items_select"> 
        <div class="grid_20" id="calculos">
            <div class="grid_12"><br></div>
            <div class="grid_8 negrilla fondo_azul f16 colorBlanco">
                <div class="grid_4 alin_der colorAmarillo esparriba5 f18">
                    TOTAL Bs.-
                </div>
                <div class="grid_3 suffix_1 centrartexto"><input class="OK negrilla centrartexto f16" style="color:#000 ; width: 145px ;padding: 10px 0 10px 0;" value="<?php echo $monto_total; ?>" id="total_factura" readonly="readonly"></div>

            </div>
        </div>
        <div class="grid_20 bordeado esparriba5 espabajo5">
            <div class="grid_12">
                <div class="grid_2 alin_der negrilla" style="width: 140px; margin: 0 10px 0 0;" >
                    Comentario de penalidad
                </div>
                <div class="grid_9">
                    <textarea id="comentario_penalidad" class="NO" style="width: 440px; height: 35px; background: #FFEAEB" placeholder="Escriba aqui un comentario de la penalidad"><?php echo $comentario_penalidad; ?></textarea>
                </div>
            </div>
            <div class="grid_8 negrilla fondo_Rojo f16 colorBlanco">
                <div class="grid_4 alin_der blanco_text esparriba5 f18">
                    PENALIDAD Bs.-
                </div>
                <div class="grid_3 suffix_1 centrartexto"><input class="NO negrilla centrartexto f16" style="color:#000 ; width: 145px ;padding: 10px 0 10px 0; background: #FFEAEB" value="<?php echo $penalidad; ?>" id="penalidad" ></div>

            </div>
        </div>



    </div>
    <div class="grid_20 f16 espabajo10 ">
        <div class="grid_11 ">
            Comentario :
            <textarea id="comentario_general" placeholder="puede escribir un comentario general" class="textarea_redond_990x50 f16" style="width: 540px;"><?php echo $comentario; ?></textarea>
        </div>
        <div class="grid_9 ">
            <div class="grid_9 centrartexto ">
                Tipo de Trabajo
            </div>
            <div class="grid_9 f12 centrartexto fondo_amarillo_claro" id="tipotrabajo">
                <div class="grid_3">Canon<input type="checkbox"  id="cano" <?php echo $tpca; ?> ></div>
                <div class="grid_3"> Extra Canon<input type="checkbox" id="ecan" <?php echo $tpec; ?>></div>
                <div class="grid_3"> Instalacion<input type="checkbox" id="inst" <?php echo $tpinst; ?>></div>
                <br>
                <div class="grid_3"> Insumos<input type="checkbox" id="insu" <?php echo $tpinsu; ?>></div>
                <div class="grid_3">Ventas<input type="checkbox" id="vent" <?php echo $tpven; ?>></div>
                <div class="grid_3"> Otros<input type="checkbox" id="otro" <?php echo $tpotr; ?>></div>
            </div>

        </div>
    </div>

    <div class="grid_20 espabajo10 fondo_plomo_claro_areas " style="background: #e0eafe;">
        <div class="grid_20 negrilla f12 centrartexto esparriba5 espabajo5 blanco_text" style="background: #002267">
            Configuracion de Seguimiento de Factura
        </div>
        <div class="grid_20  f12 ">
            <div class="grid_5 prefix_1 suffix_1" >

                <div class="grid_5 centrartexto" ><input id="fec_estimada_cobro" value="<?php echo $fecha_est_cob; ?>" type="text" class="input_redond_200 centrartexto " style="height: 40px;font-size: 18px;"></div>
                <script>$("#fec_estimada_cobro").datepicker();</script>
                <div class="grid_5 centrartexto" >Fecha estimada de Pago</div>
            </div>

            <div class="grid_12 esparriba10 " >
                <div class="grid_12 bordeado " style="border-color: #002267">

                    <div class="grid_12 centrartexto negrilla">
                        Comentarios de Seguimiento
                    </div>
                    <div class="grid_10 prefix_1 suffix_1"><?php echo str_ireplace("*", "<br>", $seguimiento_old); ?>

                        <input type="hidden" id="coment_old_seguiento" value="<?php echo $seguimiento_old; ?>">
                    </div>
                    <div class="grid_12 centrartexto espabajo10">
                        <textarea id="comentario_seguimiento_nuevo" style="width: 580px;height:40px;" placeholder="escribe un nuevo comentario"></textarea>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="grid_20" id="mensajes_respuestas"></div>
    <div id="ayuda_dialog" class="formulario_nuevo_menu ocultar" style="height: 300px; width: 400px;">cargando...</div>
</div>
<script>listar_contr_proy("id_proyecto", "contrato_div",<?php echo $id_contrato; ?>);</script>
<script> $('#save').button('enable');</script>
<script> $('#new_reg').button('enable');</script>
<?php if ($id_send != 0) { ?>
    <script> $('#print').button('enable');</script>

<?php } ?>
