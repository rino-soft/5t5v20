<div class="fondo_azul colorBlanco negrilla f12 container_20" style="width: 100%; display: block; padding: 2px; ">
    <div style="display: block ; float: left;" class="grid_16 fondo_azul colorBlanco negrilla f12 ">

        <?php
        if ($total_registros > 0)
            echo $total_registros . " registros cargados exitosamente.";
        else
            echo $total_registros . " registros cargados !  No se han encontrado Registros en la Base de Datos.";
        ?>
    </div>
    <div id="paginacion" style="display: block ; float: left; " class="grid_2 fondo_azul colorBlanco negrilla f12 ">
        <?php
        for ($pa = 1; $pa <= ceil($total_registros / $mostrar_X); $pa++) {
            if ($pa != $pagina_actual) {
                ?>
                <div class='milink link_blanco' onclick="$('#pagina_reg_mov_alm_usuario').val(<?php echo $pa; ?>);lista_mov_usuario();" style="float: left" > <?php echo $pa . " ,"; ?> </div>
                <?php
            } else {
                ?>
                <div class="colorAmarillo" style="float: left"> <?php echo $pa . " ,"; ?> </div>
                <?php
            }
        }
        ?>
    </div> 
</div>

<div class='div1150 fondo_plomo_claro_areas fondo_plomo alin_cen' style="display: block; width: 100%">
    <div class="f12"style="display: block-inline;  width: 100px; float: left">
        <div style="display: block; "><span class="negrilla  colorAzul">#Movimiento Almacen</span></div>  
    </div>
    <div class="f12"style="display: block-inline;  width: 100px; float: left">
        <div style="display: block; "><span class="negrilla  colorAzul">Usuario</span></div>  
    </div>
    <div class="f12"style="display: block-inline;  width: 150px; float: left">
        <div style="display: block; "><span class="negrilla  colorAzul">Fecha/Hora Registro</span></div>  
    </div>

    <div class="f12" style="display: block-inline; width: 200px; float: left">
        <div style="display: block; "><span class="negrilla  colorAzul">Proyecto</span></div>              
    </div>
    <div class="f12" style="display: block-inline; width: 245px; float: left">
        <div style="display: block; "><span class="negrilla  colorAzul">Comentario</span></div>                           
    </div>
</div>
<div class='bordeado'>
    <?php
//echo "llega a la vista ------> numrows" . $movimiento->num_rows();


    foreach ($movimiento->result() as $reg) {
        ?>

        <div class='div1150 borde_abajo cambio_fondo' style="display: block; width: 100%">
            <div class="f12 alin_cen"style="display: block-inline;  width: 100px; float: left"> 
                <div style="display: block; "><span class="alin_cen" ><?php echo $reg->id_mov_alm; ?></span></div>
            </div>
            <div class="f12" style="display: block-inline;width: 100px;float: left ">              
                <div style="display: block; ">
                    <span class="negrilla"><?php echo "</span><span>" . $reg->nombre . " " . $reg->ap_paterno; ?></span>
                </div>  
            </div> 
            <div class="f12"style="display: block-inline;  width: 150px; float: left"> 
                <div style="display: block; "><span class=""><?php echo $reg->fh_reg; ?></span></div>
            </div>

            <div class="f12" style="display: block-inline; width: 200px; float: left">              
                <div style="display: block; "><span class=""><?php echo $reg->proyecto; ?></span></div>
            </div>
            <div class="f12 " style="display: block-inline; width: 245px; float: left">              
                <div style="display: block; "><span class=""><?php if ($reg->comentario != "") echo $reg->comentario;else echo " &nbsp;" ?></span></div>               
            </div>

            <div >
                <input type="hidden" value="1" id="pagina">    
                <input type="hidden" value="0" id="cant_item" >
                <input type="hidden" value="<?php echo $reg->cod_user; ?>" id="c_u" >
                <input type="hidden" value="<?php echo $reg->tipo_movimiento; ?>" id="t_m" >
                 <input type="hidden" value="<?php echo $reg->proyecto; ?>" id="pro" >
            </div>

            <div style="display: block-inline; width: 100px; float: left">
                <div class='boton2 f10'><div onclick="insertar_detalle_movimiento('<?php echo $reg->id_mov_alm ?>','detalle_ov_pf ')">Adicionar</div></div>
                <div class="boton2 f10" onclick="dialog_contenidos_nuevo_ingreso_detalle('lista_movimiento_ver','<?php echo base_url() . "movimiento_almacen/ver_lista_al_detalle/$reg->id_mov_alm"; ?> ')"><?php echo "Detalles"; ?></div>
            </div>






        </div>





    <?php }
    ?>
</div>
<div class="grid_18 fondo_azul colorBlanco esparriba5 espabajo5">
    <div class="grid_6 "> <div class="milink link_blanco" onclick="$('#lista_movimiento').html('');$('#in_search').val('');">LIMPIAR LISTA</div></div>
    <div class="grid_12 negrilla" >
        <div style="float:right"><?php
    ?>
        </div>
    </div>
</div>
