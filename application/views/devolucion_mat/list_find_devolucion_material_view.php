<div class="f12 container_20" style="width: 95% ">
   <div class="fondo_azul colorBlanco negrilla f12 grid_20" style=" display: block; height: 20px; width: 100%">
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
                <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa; ?>);busca_lista_devolucion_material('lista_devolucion_material');" style="float: left" > <?php echo $pa . " ,"; ?> </div>
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
    <div class="fondo_azul colorAmarillo borde_abajo borde_arriba  negrilla f11" style="display: block-inline;float: left ; width: 100%; height: ">   

        <div class=" negrilla "  style="display: block-inline;float: left ;width: 20%">Personal Tecnico</div>   
        <div class=" negrilla "  style="display: block-inline;float: left ;width: 15%">Proyecto</div>  
        <div class="negrilla "  style="display: block-inline;float: left ;width: 30%">Comentario General</div>  
        <div class=" negrilla "  style="display: block-inline;float: left ;width: 10%">Fecha Hora</div>  
        <div class="negrilla "  style="display: block-inline;float: left ;width: 5%">Estado</div>  
    </div>



    <!-- aqui se muestra los registros con un foreach -->
    <div class="" >
        <?php foreach ($registros->result() as $reg) { ?>
            <div class="grid_20 borde_abajo  cambio_fondo esparriba10  " style="width: 100%">
                <div class="f12 " style="display: block-inline;float: left; width: 20%"><?php if ($reg->nombre != "") echo $reg->nombre . " " . $reg->ap_paterno . " " . $reg->ap_materno; else echo "&nbsp;" ?></div>               
                 <div class="f12" style="display: block-inline;  float: left; width: 15%"><?php if ($reg->nombre_proy != "") echo $reg->nombre_proy; else echo "&nbsp;" ?></div>
                 <div class="f12" style="display: block-inline;  float: left; width: 30%"><?php if ($reg->comentario_dev != "") echo $reg->comentario_dev; else echo "&nbsp;" ?></div>
                 <div class="f12" style="display: block-inline;  float: left; width: 10%"><?php if ($reg->fh_registro_dev != "") echo $reg->fh_registro_dev; else echo "&nbsp;" ?></div>
                 <div class="f12" style="display: block-inline;  float: left; width: 5%"><?php if ($reg->estado_devolucion != "") echo $reg->estado_devolucion; else echo "&nbsp;" ?></div>
                <div  style="display: block-inline;  float: left; width: 19%">
                    <div style=" width: 110px; float: right; margin:0px 10px 0px 10px;">
                         <div class="boton2 f10 negrilla " title="Ingresar material" onclick="dialog_nuevo_mov_alm_ingreso('div_formularios_dialog','<?php echo base_url() . "movimiento_almacen/almacen_nuevo_dev/$reg->id_solicitud_dev"; ?> ')"><?php echo "Ingresar material"; ?></div>
                    </div>
                    <div style="width: 110px; float: right;">
                        <div class="boton2 f10 negrilla alin_cen" title="Ver registro" onclick="dialog_detalle_solicitud_devolucion('div_formularios_dialog','<?php echo base_url() . "devolucion_material/ver_devolucion_material_enviado/$reg->id_solicitud_dev"; ?>')"><?php echo"Ver registro"; ?></div>
                   </div>
                </div>
            </div>
        <?php } ?>
    </div>

