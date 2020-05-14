<?php
///echo "jajaja";
$codigo_seleccionados = "";

$id_persona = "";
$proyecto = "";
$almacen = "";
$comentario = "";
$ids_selec = "";
$subregion = "";
$codigo_items = "";
$estado = "Copia sin guardar";
if ($id_send_copi != 0) {

    $codigo_seleccionados = "";
    $id_persona = $inf_retiro->id_user_er;
    $proyecto = $inf_retiro->id_proyecto;
    $almacen = $inf_retiro->id_almacen;
    $comentario = $inf_retiro->comentario;
    $estado = $inf_retiro->estado;
    $subregion = $inf_retiro->id_oficina_reg;
    $ids_selec = "";
    $vec_ids = array();
    $i = 0;

    foreach ($inf_detalle_retiro->result() as $item) {

        $vec[$i] = $item->id_articulo;
        $i++;
        $cont = 0;
        for ($c = 0; $c < count($vec); $c++) {
            if ($vec[$c] == $item->id_articulo)
                $cont++;
        }
        $ids_selec.="," . $item->id_articulo . "-" . $cont;
        $resp = "este articulo no necesita series";
        if ($item->respuesta == 1) {
            $resp = "<div id='serial_old" . $item->id_articulo . "-" . $cont . "'><span class='negrilla'>Codigo Propio : </span>" . $item->cod_prop_sts_equipo . "<br><span class='negrilla'> SN: </span>" . $item->SN . "</div>";
            //<script>seriales_registradas(" . $item->id_articulo . "," . $cont . ",'Salida',1,'" . $item->cod_prop_sts_equipo . "* SN: " . $item->SN . "');</script>";
        }

        $codigo = "<div class='grid_20 fondo_amarillo bordeado ' id='sel" . $item->id_articulo . "-" . $cont . "' >
                <div class='grid_1'>
                        <div style='float:rigth;' id='duplicar' class='duplicarItem milink' title='Duplicar Item' onclick='seleccionar_producto_salida_directa(" . $item->id_articulo . ");'></div>
                        <div style='float:rigth;' id='quitar' class='quitarItem milink' title='Quitar Item' onclick='quitaritem(" . $item->id_articulo . "," . $cont . ");'></div>
                        <div id='ver' class='comentario milink' title='Adicionar comentario' onclick='mostrar_quitar_coment(" . $item->id_articulo . "," . $cont . ",1)'></div>
                        <div id='oculta' class='nocomentario milink ocultar' title='Quitar comentario' onclick='mostrar_quitar_coment(" . $item->id_articulo . "," . $cont . ",0)'></div>
                </div>
                 <div class='grid_8'>
                    <span class='negrilla'>" . $item->cod_serv_prod . " </span><input type='hidden' id='cod_ps' value='" . $item->cod_serv_prod . "'>
                    <input type='hidden' id='id_ps' value='" . $item->id_serv_pro . "'>
                    <div class='grid_8'>" . $item->nombre_titulo . " <input type='hidden' id='tit_ps' value='" . $item->nombre_titulo . "'></div>
                    <div class='grid_8'>" . $item->descripcion . " <input type='hidden' id='desc_ps' value='" . $item->descripcion . "'></div>
                    <div class='grid_8'><textarea placeholder='Escriba su comentario aqui' id='coment' class='textarea_redond_450x50 ocultar'>$item->observaciones</textarea></div>
                </div>
                <div class='grid_2'><input title='cantidad' id='cantidad' type='text' value='" . $item->cantidad . "' class='input_redond_100 alin_cen margin_cero' placeholder='Cantidad'  ></div>
                <div class='grid_2 negrilla alin_cen' >" . $item->unidad_medida . " </div>
                <div class='grid_4'>" . $resp . "<div class='ocultar'><input type='text' id='sn' value='$item->SN'><input type='text' id='cp' value='$item->cod_prop_sts_equipo'></div></div>
                </div>";
        $codigo_items.=$codigo;
    }
} else {
    ?>

    <script>$('#save_retiro').button("enable");</script>
<?php } ?>

<div_ id='respuesta'></div>
<input type="hidden" value="<?php echo $id_send; ?>" id="id_send">
<div class="container_20">
    <div class="grid_20 fondo_verde_claro">
        <div class="grid_5">
            <div class="grid_4 f10 alin_cen ">Id Movimiento:</div><div class="grid_4 f16  negrilla alin_cen"><?php echo $id_send; ?></div></div>
        <div class="grid_10 ">
            <div class="grid_10 f10 negrilla alin_cen">
                Tipo Movimiento
            </div><div class="grid_10 negrilla f16 alin_cen">
                Retiro
            </div>
        </div>
        <div class="grid_5">
            <div class="grid_5 alin_der f10 alin_cen ">Estado Actual: </div><div class="grid_5  negrilla f12 alin_cen"><?php echo $estado; ?></div>
        </div>
        <br>
        <div class="grid_20 fondo_plomo_claro_areas">    
            <div class="grid_20 esparriba5">
                <div class='grid_20'>
                    <div class='grid_10 negrilla'>
                        <div class="grid_10 "><!-- jalar informacion del controlador movimeitno almacen lista del personal, -->
                            Personal a asignar:<select id="id_personal" onchange="proy_generar('id_personal', 'id_proyecto', 'proy_bloque', 0);" style="width: 250px;" >
                                <option value="0">seleccione personal...</option>
                                <?php
                                foreach ($personal_datos->result() as $reg) {
                                    if ($reg->cod_user == $id_persona)
                                        echo "<option selected ='selected' value='$reg->cod_user'>$reg->ap_paterno $reg->ap_materno, $reg->nombre </option>";
                                    else
                                        echo "<option value='$reg->cod_user'>$reg->ap_paterno $reg->ap_materno, $reg->nombre </option>";
                                }
                                ?></select>
                        </div>

                        <div class="grid_10">
                            <div class="grid_8">
                            Proyecto:<span id="proy_bloque">
                                <select id="id_proyecto">
                                    <option value="0">seleccione proyecto...</option>
                                </select>
                                <!-- </span>Mostrar todos lo proyectos<br> mostrar al seleccionar el personal , listar los proyectos en el cual trabaja el personal -->
                                <?php
                                if ($proyecto != "") {
                                    ?><script>proy_generar('id_personal', 'id_proyecto', 'proy_bloque',<?php echo $proyecto ?>);</script>
                                    <?php
                                }
                                ?>
                            </span>
                            </div> 
                           <div class='grid_4'>
                                <div class='f10 colorRojo '>Forzar Proyecto ?</div>
                                 <input type='checkbox' id="forzar" name=''  value='1'  onclick="forzar_proy()">
                           </div>
                            
                        </div>
                        <div class="grid_10">
                            Almacen:<select id="id_almacen" ><option value="0">seleccione almacen...</option>
                                <?php
                                foreach ($almacen_datos->result() as $reg) {
                                    if ($reg->id_almacen == $almacen)
                                        echo "<option value='$reg->id_almacen' selected='selected'>$reg->nombre </option>";
                                    else
                                        echo "<option value='$reg->id_almacen'>$reg->nombre </option>";
                                }
                                ?>
                            </select><!-- jalar informacion del controlador mostrar los almacenes asignados a este personal de la sesion --> 
                        </div>


                    </div>
                    <div class='grid_8 prefix_1 suffix_1'>
                        <div class='grid_8 bordeado NO'>
                            <div class='grid_8'>Importante para la salida de Activos Fijos</div>
                            <div class='grid_8'>
                                <div class='grid_7 espaciado5 centrartexto'>    Sub centro/ocifina:
                                    <select id="id_oficina" class='mayusculas' style='width: 200px;' ><option value="0">seleccione la region u oficina...</option>
                                        <?php
                                        foreach ($oficinas_datos->result() as $reg) {
                                            if ($reg->id_subregion == $subregion)
                                                echo "<option value='$reg->id_subregion' selected='selected'>$reg->nombre_region - $reg->nombre_subregion </option>";
                                            else
                                                echo "<option value='$reg->id_subregion'>$reg->nombre_region - $reg->nombre_subregion </option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="prefix_10 ">  <div class="grid_10 esparriba10">

                        <input class="fondobuscar500" style="float: right" id="in_search" placeholder="BUSCAR MATERIAL" onkeypress="search_buscar_retiro(event);">
                    </div>
                    <div class="grid_5 prefix_5 alin_der">
                        Mostrar Registros
                        <select id="mostrar_X" onchange='$("#pagina").val(1); busqueda_material_activo();'>
                            <option value ="5" selected="selected" >5</option>
                            <option value ="10" >10</option>
                            <option value ="20" >20</option>
                            <option value ="50" >50</option>
                            <option value ="100" >100</option>
                        </select>                     
                    </div>
                    <input type="hidden" value="1" id="pagina">
                    <input type="hidden" value="<?php echo $ids_selec; ?>" id="ids_seleccionados">
                    <input type="hidden" value="0" id="cant_item" >
                </div>
            </div>
            <div class="clear"></div>
            <div class="grid_20 negrilla" id="resultado_busqueda" >
            </div>

            <div class="grid_20 negrilla  fondo_azul colorAmarillo f14 alin_cen ">
                DETALLE SALIDA DE ALMACEN
            </div>

            <div class="grid_20" id="detalle_mov_alm_salida">
                <?php
                if ($codigo_items != "")
                    echo $codigo_items;
                else
                    echo "Para agregar items debe realizar primero una busqueda del articulo";
                ?>
            </div>

            <div class="grid_20 f16">
                Comentario :
                <textarea id="comentario_general" placeholder="puede escribir un comentario general" class="textarea_redond_990x50"><?php echo $comentario; ?></textarea>
            </div>



        </div>
    </div>
    <div id="mensaje" class="ocultar">otro div con otro mensaje !!!!!</div>
    <div id="c_ope" class="container_20"><!--aqui codope--></div>
    <?php
//echo $estado;

    if ($estado == "Material Entregado") {

        echo "<script> $('#entregar').button('disable');
        $('#save_retiro').button('disable');</script>";
    } else {
        //echo "<script> alert('" . $estado . " == Material Entregado NO " . $estado . " == Guardado');</script>";
        if ($estado == "Guardado") {
            echo "<script> $('#entregar').button('enable');
             $('#save_retiro').button('option', 'label', 'Guardar Modificaciones');</script>";
        } else {
            echo "<script> $('#entregar').button('disable');</script>";
        }
    }
    ?>
