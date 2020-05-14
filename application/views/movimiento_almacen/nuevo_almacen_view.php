<?php
//echo "jajajajajaj";

$codigo_seleccionados = "";
$id_persona = "";
$proyecto = "";
$almacen = "";
$comentario = "";
$ids_selec = "";
$codigo_items = "";
$estado = "";
if ($id_send != 0) {
    $codigo_seleccionados = "";
    $id_persona = $inf_ingreso->id_user_er;
    $proyecto = $inf_ingreso->id_proyecto;
    $almacen = $inf_ingreso->id_almacen;
    $comentario = $inf_ingreso->comentario;
    $estado = $inf_ingreso->estado;
    $ids_selec = "";
    $vec_ids = array();
    $i = 0;

    foreach ($inf_detalle_ingreso->result() as $item) {

        $vec[$i] = $item->id_articulo;
        $i++;
        $cont = 0;
        for ($c = 0; $c < count($vec); $c++) {
            if ($vec[$c] == $item->id_articulo)
                $cont++;
        }
        $ids_selec.="," . $item->id_articulo . "-" . $cont;

        $resp = "este articulo no necesita series";
        if ($item->respuesta == 1)
            $resp = "<div id='serial_old" . $item->id_articulo . "-" . $cont . "'><span class='negrilla'>Codigo Propio :</span> " . $item->cod_prop_sts_equipo . "<br><span class='negrilla'> SN:</span> " . $item->SN . "</div>";
        //<script>seriales_registradas_in(" . $item->id_articulo . "," . $cont . ",'Ingreso'," . $almacen . "); seriales_obtenidos_max(" . $item->id_articulo . "," . $cont . ",'Ingreso'," . $almacen . ");</script>";


        $codigo = "<div class='grid_20 fondo_amarillo bordeado ' id='sel" . $item->id_articulo . "-" . $cont . "' >
                <div class='grid_1'>
                        <div style='float:rigth;' id='duplicar' class='duplicarItem milink' title='Duplicar Item' onclick='seleccionar_producto2(" . $item->id_articulo . ");'></div>
                        <div style='float:rigth;' id='quitar' class='quitarItem milink' title='Quitar Item' onclick='quitaritem(" . $item->id_articulo . "," . $cont . ");'></div>
                        <div id='ver' class='comentario milink' title='Adicionar comentario' onclick='mostrar_quitar_coment(" . $item->id_articulo . "," . $cont . ",1)'></div>
                        <div id='oculta' class='nocomentario milink ocultar' title='Quitar comentario' onclick='mostrar_quitar_coment(" . $item->id_articulo . "," . $cont . ",0)'></div>
                        
                </div>
                 <div class='grid_8'>
                    <span class='negrilla'>" . $item->cod_serv_prod . " </span><input type='hidden' id='cod_ps' value='" . $item->cod_serv_prod . "'>
                    <input type='hidden' id='id_ps' value='" . $item->id_serv_pro . "'>
                    <div class='grid_8'>" . $item->nombre_titulo . " <input type='hidden' id='tit_ps' value='" . $item->nombre_titulo . "'></div>
                    <div class='grid_8'>" . $item->descripcion . " <input type='hidden' id='desc_ps' value='" . $item->descripcion . "'></div>
                    <div class='grid_8'><textarea placeholder='Escriba su comentario aqui' id='coment' class='textarea_redond_450x50 ocultar'>$item->observaciones </textarea></div>
                </div>
                <div class='grid_5'>
                    <div class='grid_2'><input title='cantidad' id='cant' type='text' value='" . $item->cantidad . "' class='input_redond_100 alin_cen margin_cero' placeholder='Cantidad'  ></div>
                    <div class='grid_2 negrilla alin_cen' >" . $item->unidad_medida . " </div>
                </div>
                 <div class='grid_6'>" . $resp . "
                        <div id='otra_opcion" . $item->id_articulo . "-" . $cont . "' class='ocultar'>
                            <div class='grid_5'>
                                <div class='grid_2 espizq10'><input title='codigo propio' id='cp' type='text' value='" . $item->cod_prop_sts_equipo . "' class='grid_2 alin_cen margin_cero input_redond_20' placeholder='Codigo Propio'></div>
                                <div class='grid_2 espizq10 espder10'><input title='serial number' id='sn' value='".$item->SN."' type='text' class='grid_2 alin_cen margin_cero input_redond_20' placeholder='Serial Number'></div>
                            </div>
                            <div class='grid_1'>
                                <div id='verlist' class='comentario milink' title='Ver Lista Seleccion' onclick='seriales_registradas_in(" . $item->id_articulo . "," . $cont . ", 'Ingreso'," . $almacen . ");genera_otra_opcion(otra_opcion" . $item->id_articulo . "-" . $cont . " , " . $item->id_articulo . ",0," . $cont . "); mostrar_quitar_list_sel(" . $item->id_articulo . "," . $cont . ",1)'></div>
                            </div>
                            <div class='grid_6'>
                                    <div class='espizq10 f10'id='serial_last" . $item->id_articulo . "-" . $cont . "'></div>
                            </div>
                         </div>
                    </div>
                </div>";
        $codigo_items.=$codigo;
    }
}

else {
    ?>
    <script>$('#save1_mov').button("enable");</script>
<?php } ?>
<div id='respuesta'></div>
<input type="hidden" value="<?php echo $id_send; ?>" id="id_send">
<div class="container_20">
    <div class="grid_4 suffix_1" >
        <input type="hidden" value="1" id="pagina_art">
        <input type="hidden" value="<?php echo $ids_selec; ?>" title="ids_selec" id="ids_seleccionados">
        <input type="hidden" value="0" id="cant_item">


    </div>
    <div class="grid_20">
        <div class="grid_20 fondo_verde_claro">
            <div class="grid_5">
                <div class="grid_4 f10 alin_cen ">Id Movimiento:</div><div class="grid_4 f16  negrilla alin_cen"><?php echo $id_send; ?></div></div>
            <div class="grid_10 ">
                <div class="grid_10 f10 negrilla alin_cen">
                    Tipo Movimiento
                </div><div class="grid_10 negrilla f16 alin_cen">
                    Ingreso
                </div>
            </div>
            <div class="grid_5">
                <div class="grid_5 alin_der f10 alin_cen ">Estado Actual: </div><div class="grid_5  negrilla f12 alin_cen"><?php echo $estado; ?></div>
            </div>
        </div>
        <br>
        <div class="grid_20 fondo_plomo_claro_areas">    
            <div class="grid_20 esparriba5">
                <div class=" grid_4 bordeado fondo_amarillo_claro" style="margin: 5px 5px 5px 5px;">
                    <input type="radio" name="tipo_ing" value="Personal Tecnico" checked="checked" onclick="directo_o_personal('personal');"> Personal Tecnico<br> 
                    <input type="radio" name="tipo_ing" value="Proveedor" disabled="disabled"> Proveedor<br> 
                    <input type="radio" name="tipo_ing" value="Directo" onclick="directo_o_personal('directo');"> Ingreso Directo 
                </div>


                <div class="grid_7">
                    <div class="grid_7 "><!-- jalar informacion del controlador movimeitno almacen lista del personal, -->
                        Personal a seleccionar:<select id="id_personal" onchange="proy_generar('id_personal', 'id_proyecto', 'proy_bloque', 0);" >
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
                    <div class="grid_7">
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
                    </div>
                </div>
                <div class="grid_5">
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
            <div class="grid_20 fondo_plomo_claro_areas"> 
                <div class="grid_20 negrilla  fondo_azul colorAmarillo f14 alin_cen">
                    AREA DE DETALLES
                </div>
                <div style="display: table-cell; " class="esparriba5 alin_der grid_20">
                    <div style="float:right; display: table-cell; " class="alin_der esparriba10">
                        <input class="fondobuscar300 alin_der" id="a_search" placeholder="B U S C A R   A R T I C U L O" onkeypress="search_alm(event);">
                        <br> Nro de Registros :
                        <select id="mostrar_X" onchange="cambiarpagina_art(1);busqueda_material_activo();">
                            <option value ="5" selected="selected" >5</option>
                            <option value ="10" >10</option>
                            <option value ="20" >20</option>
                            <option value ="50" >50</option>
                            <option value ="100" >100</option>
                        </select>
                        <input type="hidden" value="1" id="pagina_registros">
                    </div>
                </div>
            </div>
            <div class="" id="resultado_busqueda"> </div>
            <div class=" fondo_plomo_claro_areas"> 
                <div class="ocultar" id="detalle_ov_pf">
                    <div class="grid_20 fondo_azul colorAmarillo borde_abajo borde_arriba  negrilla f12" style="width: 100%">            
                        <div class="grid_1 alin_cen" style="display: block-inline;float: left "></div>
                        <div class="grid_6 espizq10  prefix_1" style="display: block-inline;float: left; width:32%">Articulo</div>
                        <div class="grid_2"style="display: block-inline; float: left">Cantidad</div>
                        <div class="grid_3"style="display: block-inline; float: left; width:15%">Unidad Medida</div>
                        <div class="grid_2" style="display: block-inline; float: left; width:11%">Codigo Propio</div>
                        <div class="grid_2" style="display: block-inline; float: left">Serial Number</div>
                    </div>
                </div>
            </div> 
            <?php
            if ($codigo_items != "")
                echo $codigo_items;
            else
                echo "Para agregar items debe realizar primero una busqueda del articulo";
            ?>
            <div class="grid_20 f16">
                Comentario:
                <textarea id="comentario_general" placeholder="puede escribir un comentario general" class="textarea_redond_990x50"><?php echo $comentario; ?></textarea>
            </div>
        </div>

        <div class="grid_18" id="lista_movimiento_ver" style="display: block;"></div>
        <div id="respuesta"></div>
    </div>
</div>
<div id="mensaje" class="ocultar">otro div con otro mensaje !!!!!</div>
<div id="c_ope"></div>


