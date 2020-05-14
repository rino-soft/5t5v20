<?php
$id_cliente = "";
$rs = "";
$nit = "";
$ids = "";
$cant_item = 0;
$monto_total = 0;
$monto_total_dev = 0;
$comentario = "";
$codigo_items = "";
$nit_cliente = "";
$razon_social = "";
$id_proyecto = 0;
$id_contrato = 0;
$desactivado = '';
$fac_n_o = '';
$auto_n_o = '';
$fec_n_o = '';



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
    $monto_total_dev = $data_fac->monto_devolucion;
    $comentario = $data_fac->comentario;
    $vec_ids = array();
    $i = 0;
    $codigo_items = "";
    $desactivado = ' disabled="disabled "';
    $fac_n_o = $data_fac->factura_original;
    $auto_n_o = $data_fac->autorizacion_original;
    $fec_n_o = $data_fac->fecha_original;
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
                <option value="-1" onclick="$('#id_cliente').val(''); $('#nit').val(''); $('#rs').val('')" disabled="disabled" selected="selected">Seleccione el cliente</option>
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

            <div class="grid_20"><div class="grid_20 colorGuindo centrartexto">DETALLE TRANSACCION ORIGINAL</div></div>
            <div class="grid_20">
                <div class="grid_15 ">
                    <div class="grid_5"><div class="grid_5 centrartexto"><input id="nrofac_orig" value="<?php echo $fac_n_o;?>" type="text" class="centrartexto" style="width: 145px ;padding: 5px 0 5px 0;"></div><div class="grid_5 f12">Nro de Factura</div></div>
                    <div class="grid_5"><div class="grid_5 centrartexto"><input id="autorizacion_orig" value="<?php echo $auto_n_o;?>" type="text" class="centrartexto" style="width: 200px ;padding: 5px 0 5px 0;"></div><div class="grid_5 f12">Nro de Autorizacion</div></div>
                    <div class="grid_5"><div class="grid_5 centrartexto"><input id="fecha_orig" type="text" value="<?php echo $fec_n_o;?>" class="centrartexto" style="width: 145px ;padding: 5px 0 5px 0;"></div><div class="grid_5 f12">Fecha de Emision</div></div>
                    <script>$("#fecha_orig").datepicker({yearRange: '-5:+0'});</script>
                </div> 
                <div class="grid_3 prefix_1 suffix_1"> 
                    <?php if ($desactivado == "") { ?>
                        <div class="boton2 f12 espaciado5 milink" onclick="add_fila_devolucion()"> Adicionar Item</div>
                    <?php } else echo "<br>"; ?>
                </div>
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

            <div class="grid_2 prefix_1 centrartexto "> <input id="cantidad_f" onchange="calculo_fila_dev('XXX'); calcular_total_doble(); igualar_fila('XXX');"  type="number" min="0" value="1" class="centrartexto" style="width: 90px ; padding: 10px 0 10px 0;"></div>
            <div class="grid_10 centrartexto ">
                <textarea required="required" id="descripcion_f" onkeyup="limitar_glosa_factura('XXX'); igualar_fila('XXX');" style="width: 490px; height: 40px" placeholder="Escriba la descripcion del Item a facturar"></textarea>
                <div class="grid_10 f10 colorGuindo alin_der ">cantidad de caracteres disponibles <span class="contador_caracteres">2771</span></div>
            </div>
            <div class="grid_3 centrartexto "><input class="centrartexto" value="0" onchange="calculo_fila_dev('XXX'); calcular_total_doble();" onkeyup="val_numero('filaXXX #precio_unitario_f'); igualar_fila('XXX'); 2" id="precio_unitario_f" type="text" style="width: 145px ;padding: 10px 0 10px 0;" ></div>
            <div class="grid_3 centrartexto "><input class="centrartexto negrilla fondo_amarillo_claro" readonly="true" value="0" id="subtotal_f" type="text" style="width: 145px ;padding: 10px 0 10px 0;" ></div>
            <div class="grid_1 centrartexto esparriba10"><div class="delete_ico" onclick="del_fila_factura_venta_doble('XXX'); calcular_total_doble();"></div></div>
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
                foreach ($detalle_facOrg->result() as $det) {
                    $co++;
                    $ids.="," . $co;
                    ?>
                    <div class="grid_20" id="fila<?php echo $co; ?>">
                        <div class="grid_2 prefix_1 centrartexto "> <input id="cantidad_f" onchange="calculo_fila_dev('<?php echo $co; ?>'); calcular_total_dev();"  type="number" min="0" value="<?php echo $det->cantidad; ?>" class="centrartexto" style="width: 90px ; padding: 10px 0 10px 0;"></div>
                        <div class="grid_10 centrartexto ">
                            <textarea required="required" id="descripcion_f" onkeyup="limitar_glosa_factura('<?php echo $co; ?>')" style="width: 490px; height: 40px" placeholder="Escriba la descripcion del Item a facturar"><?php echo $det->detalle_ps; ?></textarea>
                            <div class="grid_10 f10 colorGuindo alin_der ">cantidad de caracteres disponibles <span class="contador_caracteres">2771</span></div>
                        </div>
                        <div class="grid_3 centrartexto "><input class="centrartexto" value="<?php echo $det->precio; ?>" onchange="calculo_fila_dev('<?php echo $co; ?>');
                                    calcular_total_dev();" onkeyup="val_numero('fila<?php echo $co; ?> #precio_unitario_f')" id="precio_unitario_f" <?php echo $desactivado; ?> type="text" style="width: 145px ;padding: 10px 0 10px 0;" ></div>
                        <div class="grid_3 centrartexto "><input class="centrartexto negrilla fondo_amarillo_claro" readonly="true" value="<?php echo $det->importe; ?>" id="subtotal_f" type="text" style="width: 145px ;padding: 10px 0 10px 0;" ></div>
                        <div class="grid_1 centrartexto esparriba10"><div class="delete_ico" onclick="del_fila_factura_venta_del('<?php echo $co; ?>'); calcular_total()_dev;"></div></div>
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

        <?php } ?>
        <input type="hidden" id="nro_reg" value="<?php echo $co; ?>"><input type="text" value="<?php echo $ids; ?>" id="items_select"> 
        <div class="grid_20" id="calculos">
            <div class="grid_12"><br></div>
            <div class="grid_8 negrilla fondo_azul f16 colorBlanco">
                <div class="grid_4 alin_der colorAmarillo esparriba5 f18">
                    TOTAL Bs.-
                </div>
                <div class="grid_3 suffix_1 centrartexto"><input class="OK negrilla centrartexto f16" style="color:#000 ; width: 145px ;padding: 10px 0 10px 0;" value="<?php echo $monto_total; ?>" id="total_factura" readonly="readonly"></div>

            </div>
        </div>




    </div>



    <div class="grid_20 fondo_plomo_claro_areas esparriba10 espabajo10" style="background: #FAFAFA">    

        <div class="grid_20 centrartexto negrilla f16 espaciado5" >

            <div class="grid_10 prefix_5 colorGuindo">

                DETALLE DEVOLUCION O RESCISION DE SERVICIO</div>
            <div class="grid_3 prefix_1 suffix_1"> 

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

        <div class="ocultar" id="modelo_fila_dev">

            <div class="grid_2 prefix_1 centrartexto "> <input id="cantidad_f" onchange="calculo_fila_dev('XXX'); calcular_total_dev();"  type="number" min="0" value="1" class="centrartexto" style="width: 90px ; padding: 10px 0 10px 0;"></div>
            <div class="grid_10 centrartexto ">
                <textarea required="required" id="descripcion_f" onkeyup="limitar_glosa_factura('XXX')" style="width: 490px; height: 40px" placeholder="Escriba la descripcion del Item a facturar"></textarea>
                <div class="grid_10 f10 colorGuindo alin_der ">cantidad de caracteres disponibles <span class="contador_caracteres">2771</span></div>
            </div>
            <div class="grid_3 centrartexto "><input class="centrartexto" value="0" onchange="calculo_fila_dev('XXX'); calcular_total_dev();" onkeyup="val_numero('filaXXX #precio_unitario_f')" id="precio_unitario_f" type="text" style="width: 145px ;padding: 10px 0 10px 0;" ></div>
            <div class="grid_3 centrartexto "><input class="centrartexto negrilla fondo_amarillo_claro" readonly="true" value="0" id="subtotal_f" type="text" style="width: 145px ;padding: 10px 0 10px 0;" ></div>
            <div class="grid_1 centrartexto esparriba10"><div class="delete_ico" onclick="del_fila_factura_venta_dev('XXX'); calcular_total_dev();"></div></div>
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



        <input type="text" id="total_filas_factura_dev" value="0">
        <?php
        $co = 0;
        $ids = "";
        if ($id_send != 0) {
            ?>
            <div class="grid_20" id="detalle_devolucion">
                <!-- aqui se muestra el detalle de la facrura_ venta  -->
                <?php
                foreach ($detalle_facDev->result() as $det) {
                    $co++;
                    $ids.="," . $co;
                    ?>
                    <div class="grid_20" id="fila<?php echo $co; ?>">
                        <div class="grid_2 prefix_1 centrartexto "> <input id="cantidad_f" onchange="calculo_fila_dev('<?php echo $co; ?>'); calcular_total_dev();"  type="number" min="0" value="<?php echo $det->cantidad; ?>" class="centrartexto" style="width: 90px ; padding: 10px 0 10px 0;"></div>
                        <div class="grid_10 centrartexto ">
                            <textarea required="required" id="descripcion_f" onkeyup="limitar_glosa_factura('<?php echo $co; ?>')" style="width: 490px; height: 40px" placeholder="Escriba la descripcion del Item a facturar"><?php echo $det->detalle_ps; ?></textarea>
                            <div class="grid_10 f10 colorGuindo alin_der ">cantidad de caracteres disponibles <span class="contador_caracteres">2771</span></div>
                        </div>
                        <div class="grid_3 centrartexto "><input class="centrartexto" value="<?php echo $det->precio; ?>" onchange="calculo_fila_dev('<?php echo $co; ?>');
                                    calcular_total_dev();" onkeyup="val_numero('fila<?php echo $co; ?> #precio_unitario_f')" id="precio_unitario_f" <?php echo $desactivado; ?> type="text" style="width: 145px ;padding: 10px 0 10px 0;" ></div>
                        <div class="grid_3 centrartexto "><input class="centrartexto negrilla fondo_amarillo_claro" readonly="true" value="<?php echo $det->importe; ?>" id="subtotal_f" type="text" style="width: 145px ;padding: 10px 0 10px 0;" ></div>
                        <div class="grid_1 centrartexto esparriba10"><div class="delete_ico" onclick="del_fila_factura_venta_del('<?php echo $co; ?>'); calcular_total()_dev;"></div></div>
                        <input type="hidden" id="filas_texto" value="0">
                        <input type="hidden" id="caracter_texto" value="0">
                    </div>
                <?php } ?>
            </div>

            <?php
        } else {
            ?>
            <div class="grid_20" id="detalle_devolucion">

            </div>
            <script>add_fila_devolucion();</script>
        <?php } ?>
        <input type="hidden" id="nro_reg_dev" value="<?php echo $co; ?>"><input type="text" value="<?php echo $ids; ?>" id="items_select_dev"> 
        <div class="grid_20" id="calculos">
            <div class="grid_12"><br></div>
            <div class="grid_8 negrilla fondo_azul f16 colorBlanco">
                <div class="grid_4 alin_der colorAmarillo esparriba5 f18">
                    TOTAL Bs.-
                </div>
                <div class="grid_3 suffix_1 centrartexto"><input class="OK negrilla centrartexto f16" style="color:#000 ; width: 145px ;padding: 10px 0 10px 0;" value="<?php echo $monto_total_dev; ?>" id="total_factura_dev" readonly="readonly"></div>

            </div>
        </div>




    </div>





    <div class="grid_20 f16 espabajo10 ">
        <div class="grid_11 ">
            Comentario :
            <textarea id="comentario_general" placeholder="puede escribir un comentario general" class="textarea_redond_990x50 f16" style="width: 540px;"><?php echo $comentario; ?></textarea>
        </div>
        <div class="grid_9 ">
            <br>

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
