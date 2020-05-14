<?php
//echo 'id_proy'.$idp;
if ($movimiento_ingreso->num_rows() > 0) {
    ?>  
    <div class="grid_20 fondo_plomo_claro_areas espabajo10" >
        <div  class="grid_2 negrilla"><br>Nombre:</div> 
        <div  class="grid_4 negrilla mayusculas" style="margin-top:15px"><?php echo $movimiento_ingreso->row(0)->nombre_user . " " . $movimiento_ingreso->row(0)->ap_paterno . " " . $movimiento_ingreso->row(0)->ap_materno; ?></div>
        <div  class="grid_2 negrilla"><br> Proyecto:</div> 
        <div  class="grid_4 negrilla" style="margin-top:15px" ><?php echo $movimiento_ingreso->row(0)->nombre_proyecto ?></div>
        <div class="grid_6 f11 negrilla colorAzul"> <br>Almacen: 
            <select id="select_almacen">
                <option value="0" selected="selected">Seleccione un almacen</option>
                <?php
                foreach ($movimiento_alm->result() as $reg1) {
                    echo '<option value="' . $reg1->id_almacen . '">' . $reg1->nombre_alm . '</option>';
                }
                ?>
            </select> 
        </div><br>
    </div> 
    <input type="hidden" value="" title="ids_selec" id="ids_seleccionados_en">
    <div class="grid_20 fondo_azul colorAmarillo negrilla bordeado" style="display: block;">
        <div class="f12 prefix_1" style="display: block-inline;  width: 310px; float: left">Articulo</div>
        <div class="f12" style="display: block-inline;  width: 250px; float: left">SN/CP</div>
        <div class="f12" style="display: block-inline; width: 120px; float: left">Cant Devuelta</div>
        <div class="f12" style="display: block-inline; width: 100px; float: left">Unidad Medida</div>
    </div>

        <?php
        $cant_item = 0;
        $ids = "";
        $cant_item = $movimiento_detalle->num_rows();

        $vec_ids = array();
        $i = 0;
        $codigo_items = "";
        foreach ($movimiento_detalle->result() as $reg) {
            $items_cod = "";
            $vec[$i] = $reg->id_serv_pro;
            $i++;
            $cont = 0;
            for ($c = 0; $c < count($vec); $c++) {
                if ($vec[$c] == $reg->id_serv_pro)
                    $cont++;
            }
            $ids.="," . $reg->id_serv_pro . "-" . $cont;
            $ocultar = "";
            $ver_oculta_coment = "<div id = 'ver' class = 'comentario milink ocultar' title = 'Adicionar comentario' onclick = 'mostrar_quitar_coment(" . $reg->id_serv_pro . "," . $cont . ",1)'></div>
                            <div id = 'oculta' class = 'nocomentario milink ' title = 'Quitar comentario' onclick = 'mostrar_quitar_coment(" . $reg->id_serv_pro . "," . $cont . ",0)'></div>";
            if ($reg->observaciones == "") {
                $ocultar = "ocultar";
                $ver_oculta_coment = "<div id = 'ver' class = 'comentario milink' title = 'Adicionar comentario' onclick = 'mostrar_quitar_coment(" . $reg->id_serv_pro . "," . $cont . ",1)'></div>
                            <div id = 'oculta' class = 'nocomentario milink ocultar' title = 'Quitar comentario' onclick = 'mostrar_quitar_coment(" . $reg->id_serv_pro . "," . $cont . ",0)'></div>";
            }
                      
            $items_cod = "<div class = 'grid_20 fondo_amarillo bordeado' style=''  id = 'sel" . $reg->id_serv_pro . "-" . $cont . "' >
                                <div class = 'grid_2'>" . " <input type='hidden' id='id_ma' value='" . $reg->id_mov_alm . "'></div>    
                                <div class = 'grid_2'>" . " <input type='hidden' id='id_sp' value='" . $reg->id_serv_pro . "'></div>   
                                <div class = 'grid_2'>" . " <input type='hidden' id='cp' value='" . $reg->cod_prop_sts_equipo . "'></div>   
                                <div class = 'grid_2'>" . " <input type='hidden' id='sn' value='" . $reg->SN . "'></div>   
                        <div class = 'grid_1 f12 espabajo10 '>
                            <div style = 'float:rigth;' id = 'quitar' class = 'quitarItem milink' title = 'Quitar Item' onclick = 'quitaritem(" . $reg->id_serv_pro . "," . $cont . ");'></div>
                            <div style = 'float:rigth;' >$ver_oculta_coment</div> 
                        </div>        
                        <div class = 'grid_6' >
                            <div class = 'grid_6 negrilla alin_izq'>-" . $reg->cod_serv_prod . " <input type='hidden' id='cod_ps' value='" . $reg->cod_serv_prod . "'></div>
                            <div class = 'grid_6 f10'>" . $reg->nombre_titulo . " <input type='hidden' id='tit_ps' value='" . $reg->nombre_titulo . "'></div>
                            <div class = 'grid_6 f10'>" . $reg->descripcion . " <input type='hidden' id='desc_ps' value='" . $reg->descripcion . "'></div>
                            <div class = 'grid_6'><textarea placeholder = 'Escriba una observacion aqui' id = 'coment' class = 'textarea_redond_300x50 ocultar'>" . $reg->observaciones . "</textarea></div>
                        </div> 
                        <div class='grid_5'>
                            <div class='espabajo10 grid_5 espizq10 negrilla espabajo10' id='' style=''>CP:$reg->cod_prop_sts_equipo</div>
                            <div class='espabajo10 grid_5 espizq10 espder10 negrilla espabajo10' id='' style=''>SN:$reg->SN</div>
                        </div>
                        <div class = 'grid_6 espizq10'>
                            <div class = 'espabajo10 grid_2'><input title = 'Cantidad Devuelta' readonly='readonly' id = 'cant_dev' type = 'text' class = ' grid_2 alin_cen margin_cero input_redond_20 ' onkeyup='validarSiNumero(\"cant\") placeholder='Cantidad Devuelto' value='" . $reg->cantidad_devuelto . "'></input></div>    
                            <div class = 'espabajo10 grid_2 espizq10 espder10 negrilla espabajo10' style='margin-top:15px'>"."[".$reg->unidad_medida ."]". "</div>    
                        </div>       
                    </div>";
            $codigo_items.=$items_cod;
            ?>

        <?php }
        ?>
    <div>
        <input type="hidden" value="<?php echo $movimiento_ingreso->row(0)->cod_user; ?>" id="c_u" >
        <input type="hidden" value="<?php echo $movimiento_ingreso->row(0)->id_proy; ?>" id="c_p" >
    </div>
    <div class="grid_20 ">
        <?php if ($codigo_items == "") { ?>
            <div style="display: block; width: 100%; float: left;" class="grid_20 colorBlanco negrilla f12 fondoRojo" id="reg_sel_det">
                <?php echo " 0 registros cargados !  No se han encontrado Registros en la Base de Datos."; ?>
            </div>
            <?php
        }else
            echo $codigo_items;
        ?>
    </div>
    <script>
        $("#ids_seleccionados_en").val($("#ids_seleccionados_en").val()+"<?php echo $ids; ?>");
        cantidadItems=parseInt($("#cant_item").val());
        cantidadItemsadd=parseInt("<?php echo $i; ?>");

        canI=cantidadItems+cantidadItemsadd;
        $("#cant_item").val(canI);
    </script>

    <div class="grid_20 f16">
        Comentario:
        <textarea id="comentario_general" placeholder="puede escribir un comentario general" class="textarea_redond_990x50"></textarea>
    </div>

    <?php
} else {
    ?>
    <div style="display: block; width: 100%; float: left;" class="grid_20 colorBlanco negrilla f12 fondoRojo">
        <?php echo " 0 registros cargados !  No se han encontrado Registros de proyecto en la Base de Datos defina con Recursos Humanos."; ?>
    </div>
    <?php
    // echo 'no tiene proyectos disponibles la persona seleccionada';
}
?>

