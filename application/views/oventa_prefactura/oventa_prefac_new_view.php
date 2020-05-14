<?php
$id_cliente = "";
$rs = "";
$nit = "";
$ids = "";
$cant_item = 0;
$monto_total = 0;
$comentario = "";
$codigo_items="";
if ($id_send != 0) {

    $id_cliente = $data_ov_pf->id_cliente;
    $rs = $data_ov_pf->razon_social;
    $nit = $data_ov_pf->nit;
    $ids = "";
    $cant_item = $detalle_ov_pf->num_rows();
    $monto_total = $data_ov_pf->monto_total;
    $comentario = $data_ov_pf->comentario;
    $vec_ids=  array();
    $i=0;
    $codigo_items="";
    echo "<br>antes del foreach";
    foreach ($detalle_ov_pf->result() as $item) {
        $items_cod="";
        $vec[$i]=$item->id_prod_serv;
        $i++;
        $cont=0;
        for($c=0;$c<count($vec);$c++)
        {
            if($vec[$c]==$item->id_prod_serv)
                $cont++;
        }
        $ids.=",".$item->id_prod_serv."-".$cont;
        $ocultar="";
        $ver_oculta_coment="<div id = 'ver' class = 'comentario milink ocultar' title = 'Adicionar comentario' onclick = 'mostrar_quitar_coment(".$item->id_prod_serv.",".$cont.",1)'></div>
                            <div id = 'oculta' class = 'nocomentario milink ' title = 'Quitar comentario' onclick = 'mostrar_quitar_coment(".$item->id_prod_serv.",".$cont.",0)'></div>";
        if($item->comentario=="")
        {           $ocultar="ocultar";
                    $ver_oculta_coment="<div id = 'ver' class = 'comentario milink' title = 'Adicionar comentario' onclick = 'mostrar_quitar_coment(".$item->id_prod_serv.",".$cont.",1)'></div>
                            <div id = 'oculta' class = 'nocomentario milink ocultar' title = 'Quitar comentario' onclick = 'mostrar_quitar_coment(".$item->id_prod_serv.",".$cont.",0)'></div>";
        }
        
        $items_cod="<div class = 'grid_20 fondo_amarillo bordeado ' id = 'sel".$item->id_prod_serv."-".$cont."' >
                        <div class = 'grid_2 negrilla alin_izq colorAzul'>-".$item->cod_ps." <input type='hidden' id='cod_ps' value='".$item->cod_ps."'></div>
                        <div class = 'grid_8'>
                            <div class = 'grid_8'>".$item->titulo_ps." <input type='hidden' id='tit_ps' value='".$item->titulo_ps."'></div>
                            <div class = 'grid_8'>".$item->desc_ps." <input type='hidden' id='desc_ps' value='".$item->desc_ps."'></div>
                            <div class = 'grid_8'><textarea placeholder = 'Escriba su comentario aqui' id = 'coment' class = 'textarea_redond_450x50 $ocultar'> ".$item->comentario." </textarea></div>
                        </div>
                        <div class = 'grid_1'>".$ver_oculta_coment."</div>
                        <div class = 'grid_2'><input title = 'cantidad' id = 'cantidad' value='".$item->cantidad_ps."' type = 'text' class = 'input_redond_100 alin_cen margin_cero' placeholder = 'Cantidad' onkeyup = 'calcular_importe()' ></div>
                        <div class = 'grid_2'><input title = 'Unidad Medida' id = 'um'  type = 'text' class = 'input_redond_100 alin_cen margin_cero' placeholder = 'Unidad Medida' value = '".$item->unidad_med_ps."'></div>
                        <div class = 'grid_2'><input title = 'Precio Unitario' id = 'pu' type = 'text' class = 'input_redond_100 alin_cen margin_cero' placeholder = 'Precio Unitario' onkeyup = 'calcular_importe()' value = '".$item->precio_u_ps."'></div>
                        <div class = 'grid_2'><input title = 'Subtotal' id = 'subtotal' type = 'text' class = 'input_redond_100 alin_cen margin_cero' placeholder = 'subtotal' readonly = 'readonly' value='".$item->importe_bs."'></div>
                        <div class = 'grid_1'>
                            <div style = 'float:rigth;' id = 'duplicar' class = 'duplicarItem milink' title = 'Duplicar Item' onclick = 'seleccionar_producto(".$item->id_prod_serv.");calcular_importe();'></div>
                            <div style = 'float:rigth;' id = 'quitar' class = 'quitarItem milink' title = 'Quitar Item' onclick = 'quitaritem(".$item->id_prod_serv.",".$cont.");calcular_importe();'></div>
                        </div>
                    </div>";
        $codigo_items.=$items_cod;
    }
}
?>







<div class="container_20">
    <div class="grid_20 ">
        
        <div class="grid_20">Ingrese los Datos del <span class="negrilla">Orden de Venta / Pre- Factura</span></div>

        <div class="grid_4 suffix_1"> 
            <input class="" type="text" id="id_ov_pf" value="<?php echo $id_send; ?>" placeholder="id_ov_pf">
            <input class="" type="text" id="id_cliente" value="<?php echo $id_cliente; ?>" placeholder="id_cliente">
            <input class="input_redond_200" type="text" id="nit" <?php //echo $rs_llave;    ?> placeholder="NIT" onkeyup="$('#rs').val('');search_client_mini('busqueda_cliente');calcular_importe();" value="<?php echo $nit; ?>">

            <div class="f10 negrilla"> Numero de NIT o CI</div>
        </div>
        <div class="grid_8">
            <input class="input_redond_350" type="text" id="rs" onkeyup="$('#nit').val('');search_client_mini('busqueda_cliente');calcular_importe();" <?php //echo $rs_llave;        ?>  placeholder="Nombre o Razon Social" value="<?php echo $rs; ?>">
            <div class="f10 negrilla"> Nombre o Razon Social</div>
        </div>
        <div class=" prefix_1 grid_6" id="busqueda_cliente"></div>
    </div>

    <br>
    <div class="grid_20 fondo_plomo_claro_areas">    
        <div class="grid_20 esparriba5">

            <div class="grid_10"> 
                <div class="grid_5 alin_der">
                    mostrar
                    <select id="mostrar_X" onchange="cambiarpagina(1)">
                        <option value ="5" selected="selected" >5</option>
                        <option value ="10" >10</option>
                        <option value ="20" >20</option>
                        <option value ="50" >50</option>
                        <option value ="100" >100</option>
                    </select> 

                </div>
                <input type="text" value="1" title="pagina" id="pagina">
                <input type="text" value="<?php echo $ids; ?>" title="ids_selec" id="ids_seleccionados">
                <input type="text" value="<?php echo $cant_item; ?>" title="cant Intem" id="cant_item" >
            </div>


            <div class="grid_10"><input class="fondobuscar500" id="in_search" placeholder="Escriba el servicio o producto a buscar"
                                        onkeypress="search(event);">
            </div>



        </div>
        <div class="clear"></div>
        <div class="grid_20" id="resultado_busqueda" >

        </div>

        <div class="grid_20 ">
            <?php if($codigo_items=="")
                echo "Detalle de orden de venta o pre- factura";
                else
                    echo $codigo_items;?>
        </div>

<?php if ($id_send != 0) { ?>
            <div class="grid_20" id="detalle_ov_pf">

            </div>

    <?php
} else {
    ?>
            <div class="grid_20" id="detalle_ov_pf">
                Para agregar items debe realizar primero una busqueda del producto y/o servicio...
            </div>
<?php } ?>
        <div class="grid_20 fondo_azul f16 colorBlanco" id="calculos">
            <div class="prefix_14 grid_3 alin_der ">
                TOTAL .-
            </div>
            <div class="grid_2 suffix_1"><input class="input_redond_100 margin_cero alin_cen negrilla" value="<?php echo $monto_total;?>" id="total_calculo" readonly="readonly"></div>

        </div>
        <div class="grid_20 f16">
            Comentario :
            <textarea id="comentario_general" placeholder="puede escribir un comentario general" class="textarea_redond_990x50"><?php echo $comentario; ?></textarea>
        </div>



    </div>
    <div class="grid_20" id="mensajes_respuestas"></div>
</div>
