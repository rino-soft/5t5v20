<?php
$cant_item = 0;
$ids = "";
$cant_item = $detalle->num_rows();

$vec_ids = array();
$i = 0;
$codigo_items = "";
foreach ($detalle->result() as $item) {
    $items_cod = "";
    $vec[$i] = $item->id_serv_pro;
    $i++;
    $cont = 0;
    for ($c = 0; $c < count($vec); $c++) {
        if ($vec[$c] == $item->id_serv_pro)
            $cont++;
    }
    
    $ids.="," . $item->id_serv_pro . "-" . $cont;
    $ocultar = "";
    $ver_oculta_coment = "<div id = 'ver' class = 'comentario milink ocultar' title = 'Adicionar comentario' onclick = 'mostrar_quitar_coment(" . $item->id_serv_pro . "," . $cont . ",1)'></div>
                            <div id = 'oculta' class = 'nocomentario milink ' title = 'Quitar comentario' onclick = 'mostrar_quitar_coment(" . $item->id_serv_pro . "," . $cont . ",0)'></div>";
    if ($item->observaciones != "") {
        $ocultar = "ocultar";
        $ver_oculta_coment = "<div id = 'ver' class = 'comentario milink' title = 'Adicionar comentario' onclick = 'mostrar_quitar_coment(" . $item->id_serv_pro . "," . $cont . ",1)'></div>
                            <div id = 'oculta' class = 'nocomentario milink ocultar' title = 'Quitar comentario' onclick = 'mostrar_quitar_coment(" . $item->id_serv_pro . "," . $cont . ",0)'></div>";
    }

    $items_cod = "<div class = 'grid_20 fondo_verde bordeado ' id = 'sel" . $item->id_serv_pro . "-" . $cont . "' >
                        <div class = 'grid_1 f12 espabajo10 '>
                            <div style = 'float:rigth;' id = 'quitar' class = 'quitarItem milink' title = 'Quitar Item' onclick = 'quitaritem(" . $item->id_serv_pro . "," . $cont . ");'></div>
                            <div style = 'float:rigth;' >$ver_oculta_coment</div> 
                        </div>
                        <div class = 'grid_2'>" . " <input type='text' id='id_ma' value='" . $item->id_mov_alm . "'></div>    
                        <div class = 'grid_2'>" . " <input type='hidden' id='id_sp' value='" . $item->id_serv_pro . "'></div>   
                        <div class = 'grid_2'>" . " <input type='hidden' id='res' value='" . $item->respuesta . "'></div> 
                        <div class = 'grid_2'>" . " <input type='hidden' id='cp' value='" . $item->cod_prop_sts_equipo . "'></div>   
                        <div class = 'grid_2'>" . " <input type='hidden' id='sn' value='" . $item->SN . "'></div>   
                                
                        <div class = 'grid_6'>
                            <div class = 'grid_6 negrilla alin_izq'>-" . $item->cod_serv_prod . " <input type='hidden' id='cod_ps' value='" . $item->cod_serv_prod . "'></div>
                            <div class = 'grid_6 f10'>" . $item->nombre_titulo . " <input type='hidden' id='tit_ps' value='" . $item->nombre_titulo . "'></div>
                            <div class = 'grid_6 f10'>" . $item->descripcion . " <input type='hidden' id='desc_ps' value='" . $item->descripcion . "'></div>
                            <div class = 'grid_6'><textarea placeholder = 'Escriba una observacion aqui' id = 'coment' class = 'textarea_redond_300x50 ocultar'>" . $item->observaciones . "</textarea></div>
                        </div>                     
                        <div class = 'grid_5 espizq10'>
                            <div class = 'espabajo10 grid_2'><input title = 'cantidad' id = 'cant' type = 'text' class = ' grid_2 alin_cen margin_cero input_redond_20 ' onkeyup='validarSiNumero(\"cant\") placeholder='Cantidad' value='" . $item->cantidad . "'></input></div>    
                            <div class = 'espabajo10 grid_2 espizq10 espder10 negrilla espabajo10' style='margin-top:15px'>$item->unidad_medida</div>    
                        </div>
                        <div class='grid_5'>
                            <div class='espabajo10 grid_2 espizq10 negrilla espabajo10' id='' style='margin-top:15px'>$item->cod_prop_sts_equipo</div>
                            <div class='espabajo10 grid_2 espizq10 espder10 negrilla espabajo10' id='' style='margin-top:15px'>$item->SN</div>
                        </div>
                        
                    </div>";
    $codigo_items.=$items_cod;
}
?>  
<div class="grid_20 ">
    <?php
    if ($codigo_items == "") {?>
        <div style="display: block; width: 100%; float: left;" class="grid_20 colorBlanco negrilla f12 fondoRojo" id="reg_sel_det" class = 'grid_6 ocultar'>
            <?php echo " 0 registros cargados !  No se han encontrado Registros en la Base de Datos."; ?>
        </div>
    <?php
    }else
        echo $codigo_items;
    ?>
</div>
<script>
    $("#ids_seleccionados").val($("#ids_seleccionados").val()+"<?php echo $ids; ?>");
    cantidadItems=parseInt($("#cant_item").val());
    cantidadItemsadd=parseInt("<?php echo $i; ?>");

    canI=cantidadItems+cantidadItemsadd;
    $("#cant_item").val(canI);
</script>





