<div class="fondo_azul colorBlanco negrilla f12" style="width: 95%; display: block; padding: 5px; ">
    <div style="display: inline-block">

        <?php
        if ($total_registros > 0)
            echo $total_registros . " registros cargados exitosamente.";
        else
            echo $total_registros . " registros cargados !  No se han encontrado Registros en la Base de Datos.";
        ?>

    </div>

    <div id="paginacion" style="float: right; padding-right: 25px">
        <?php
        for ($pa = 1; $pa <= ceil($total_registros / $mostrar_X); $pa++) {
            if ($pa != $pagina_actual) {
                ?>
                <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa; ?>); busca_lista_mi_sol_mat_enviada('lista_solicitud_material');" style="float: left" > <?php echo $pa . " ,"; ?> </div>
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


<!-- aqui se muestra los registros con un foreach -->
<div class="esparriba10">

    <div class="fondo_azul colorAmarillo f14 tam1200 negrilla espabajo esparriba">
        <div class="tam100 alin_cen">Id</div>
        <div class="tam100 alin_cen">Estado</div>
        <div class="tam200 alin_cen">Fecha registro</div>
        <div class="tam300">Personal Encargado del Material</div>
        <div class="tam400 alin_cen">Comentario / observaciones</div>
        <div class="tam100"></div>

    </div>
    <?php foreach ($registros->result() as $reg) { ?>
        <div class='tam1200 cambiar f12 borde_abajo espabajo5 esparriba5'>

            <div class="tam100 alin_cen negrilla f14" >
                <?php if ($reg->id_solicitud_mat != "") echo $reg->id_solicitud_mat; else echo "&nbsp;"?>
            </div>               
            <div class="tam100 alin_cen" >
                <?php if ($reg->estado != "") echo $reg->estado; else echo "&nbsp;"?>
            </div>   
            <div class="tam200 alin_cen" >
                <?php if ($reg->fh_registro != "") echo $reg->fh_registro; else echo "&nbsp;"?>
            </div>  

            <div class="tam300 colorAzul negrilla">
                <?php if ($reg->ap_paterno  != "" && $reg->nombre !="") echo $reg->ap_paterno . ", " . $reg->nombre; else echo "&nbsp;" ?>
            </div>               
            <div class="tam400 f11">
                <?php if ($reg->comentario_obs != "") echo $reg->comentario_obs; else echo "&nbsp;"?>
            </div>

            <div class="tam100">                
               <!-- <div class="boton2 alin_cen" onclick="show_ovpf('div_formularios_dialog','<?php // echo $reg->id_solicitud_mat; ?>')"><?php // echo "Ver detalles"; ?></div>-->
                <div class="boton2 alin_cen" onclick="dialog_nuevo_solicitud_mat('detalles_movimiento_entrega_material','<?php echo base_url() . "solicitud_material/entregar_sol_mat/".$reg->id_solicitud_mat."/".$ids_movs[$reg->id_solicitud_mat]; ?>')">
                    <?php echo "Entregar Material"; ?>
                </div>
               
            </div>




        </div> 
    <?php } ?>
</div>