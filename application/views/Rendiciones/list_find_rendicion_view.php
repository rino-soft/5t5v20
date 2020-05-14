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
                    <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa; ?>); search_and_list_rendicion('lista_rendicion');" style="float: left" > <?php echo $pa . " ,"; ?> </div>
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
    <?php
    if ($total_registros != 0) {
        ?>
        <div class="fondo_azul colorAmarillo borde_abajo borde_arriba  negrilla f12" style="display: block-inline;float: left ; width: 100%; height: ">            
            <div class=" fondo_azul alin_cen" style="display: block-inline;float: left ;width: 5%">ID</div>
            <div class=" fondo_azul alin_cen" style="display: block-inline;float: left ;width: 15%">Perteneciente a:</div> 
            <div class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 7%">Fecha de envio</div>
            <div class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 15%">Proyecto</div>
            <div class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 7%">Monto Total</div>
            <div class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 6%">Tipo</div>
            <div class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 10%">Estado</div>
            <div class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 20%">Observaciones</div>
            
        </div>

        <!-- aqui se muestra los registros con un foreach -->

        <?php foreach ($registros->result() as $reg) { ?>
            <div class="grid_20 borde_abajo  cambio_fondo esparriba10  " style="width: 100%">
                <div class="f14 alin_cen negrilla colorGuindo" style="display: block-inline;float: left; width: 5%"> <?php echo $reg->idreg_ren; ?></div>
                <div class="f10 " style="display: block-inline;  float: left; width: 15%"><?php echo $reg->nombre . " " . $reg->ap_paterno . " " . $reg->ap_materno . '<br><span class="colorcel negrilla">CI.: </span> <span class=" colorGuindo negrilla"> '.$reg->ci.'</span>'; ?></div>
                <div class="f10 alin_cen" style="display: block-inline;float: left; width: 7%"><?php echo $reg->fh_registro; ?></div>  
                <div class="f10 alin_izq colorcel " style="display: block-inline; float: left; width: 15%"><?php echo $reg->nombre_proyecto .'<br><span class=" colorAzul negrilla">'.$reg->descripcion.'</span>'; ?></div>
                <div class="f12 alin_izq negrilla" style="display: block-inline;float: left; width: 7%"><span class="colorGuindo negrilla alin_izq">Bs.- </span><?php echo $reg->monto; ?></div>  
                 <?php
                $c_tipo='';
                if($reg->tipo_rend=="Rendicion")
                {
                    $c_tipo='fondoAmar_estado';
                }else{
                    $c_tipo='fondoCel_estado';
                }
                
                ?>
                <div class="f10 alin_cen <?php echo $c_tipo;?>" style="display: block-inline;float: left; width: 6%"><?php echo $reg->tipo_rend; ?></div>  
                <div class="f10 alin_cen" style="display: block-inline;float: left; width: 10%"><?php echo $reg->estado; ?></div>
                <div class="f10"  style=""></div>
                <div class="f10 espizq10" style="display: block-inline;float: left; width: 20%"><?php if ($reg->observacion != "") echo $reg->observacion;else echo " &nbsp;" ?></div>
                <div  style="display: block-inline;  float: left; width: 9%">
                    <div class="impresionDoc milink" title="Imprimir PDF" 
                         onclick="Imp_reporte_de_rendicion('<?php echo $reg->idreg_ren ?>')">
                    </div>   
                    <div class="boton_editar_usuario milink"  title="Editar Usuario"
                         onclick="dialog_nuevo_for_rendicion('div_formularios_dialog','<?php echo base_url() . "rendiciones/nueva_rendicion/".$reg->idreg_ren; ?>')">
                    </div>
                    <div class="ver_historial" title="Ver asiento"
                         onclick="Imp_reporte_de_rendicion_asiento('<?php echo $reg->idreg_ren ?>')">
                    </div>
                </div>
             
            </div>

            <?php
        }
    }
    else
        echo '';
    ?>

