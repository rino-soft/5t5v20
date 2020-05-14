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
                    <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa; ?>); search_and_list_rendiciones_rt('lista_rendicion');" style="float: left" > <?php echo $pa . " ,"; ?> </div>
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
            <div class=" fondo_azul alin_cen" style="display: block-inline;float: left ;width: 5%">Codigo</div>
            <!-- <div class=" fondo_azul alin_cen" style="display: block-inline;float: left ;width: 12%">Estado</div> -->
            <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 10%">Proyecto</div>
            <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 15%">Personal</div>
            <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 5%">fecha de Envio</div>
            <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 10%">Monto</div>
            <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 10%">tipo </div>

            <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 15%">Observaciones</div>
            <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 15%">Estado</div>

        </div>

        <!-- aqui se muestra los registros con un foreach -->

        <?php
        foreach ($registros->result() as $reg) {
            $ids_vobos = explode("|", $reg->ids_vobos);
            
            $estilo = 'cambio_fondo';
            if($reg->estado=='Rechazado')
                $estilo =' NO ';
            if (in_array($this->session->userdata('id_admin'), $ids_vobos))
                $estilo = 'fondoCel_estado';
            ?>




            <div class="grid_20 borde_abajo  <?php echo $estilo; ?> esparriba10  " style="width: 100%">
                <div class="f12 alin_cen negrilla colorRojo" style="display: block-inline;float: left; width: 5%"> <?php echo $reg->idreg_ren; ?></div>
                <div class="f10 alin_izq " style="display: block-inline; float: left; width: 10%"><?php echo $reg->nombre_proyecto; ?></div>
               <!-- <div class="f12 alin_cen " style="display: block-inline;float: left; width: 12%"><?php //echo $reg->estado;   ?></div> -->
                <div class="f10 negrocolor" style="display: block-inline;  float: left; width: 15%"><?php echo $reg->nombre . " " . $reg->ap_paterno . " " . $reg->ap_materno . '<br><span class="colorcel negrilla">CI.: </span> <span class=" colorGuindo negrilla"> ' . $reg->ci . '</span>'; ?></div>
                <div class="f10 alin_cen" style="display: block-inline;float: left; width: 5%"><?php echo $reg->fh_registro; ?></div>  
                <div class="f10 alin_cen" style="display: block-inline;float: left; width: 10%"><?php echo $reg->monto; ?></div> 
                <?php
                //$c_rendicion=' fondoVerde_estado';
                $c_tipo = '';
                if ($reg->tipo_rend == "Rendicion") {
                    $c_tipo = 'fondoAmar_estado';
                } else {
                    $c_tipo = 'fondoCel_estado';
                }
                ?>

                <div class="f12 alin_cen <?php echo $c_tipo; ?>" style="display: block-inline;float: left; width: 10%"><?php echo $reg->tipo_rend; ?></div>
                <div class="f10 espizq10" style="display: block-inline;float: left; width: 15%"><?php if ($reg->observacion != "")
            echo $reg->observacion;
        else
            echo " &nbsp;"
                    ?></div>
                <div class="f10 espizq10" style="display: block-inline;float: left; width: 15%"><?php if ($reg->estado != "")
            echo $reg->estado;
        else
            echo " &nbsp;"
            ?></div>
                <div  style="display: block-inline;  float: left; width: 10%">

                    <div class="editar_rendicion milink " style="margin: 0px 2px 0px 2px;" title="Revisar y Editar"
                         onclick="dialog_rendicion_revision_regional('div_formularios_dialog', '<?php echo base_url() . "rendiciones/abrir_rendicion/" . $reg->idreg_ren; ?>', 'Editar Rendicion')">
                    </div>
                    
                    <?php if($rechazados[$reg->idreg_ren]->num_rows()>0) {?>
                    <div class="baul_rechazado milink " style="margin: 0px 2px 0px 2px;" title="registros rechazados"
                         onclick="dialog_rendicion_revision_regional('div_formularios_dialog', '<?php echo base_url() . "rendiciones/abrir_rendicion_baul/" . $reg->idreg_ren; ?>', 'Baul de Rechazados')"></div>
                    <?php }
                    else {
                        ?>
                    <div class="baul_rechazado_bloqueado " style="margin: 0px 2px 0px 2px;"title="registros rechazados"></div>
                            <?php
                    }
                        ?>

        <?php if (in_array($this->session->userdata('id_admin'), $ids_vobos)) { ?>
                                                
                        <div class="impresionDoc milink " style="margin: 0px 2px 0px 2px;" title="Imprimir PDF" 
                         onclick="Imp_reporte_de_rendicion('<?php echo $reg->idreg_ren ?>')">
                        </div> 
                    <div class="okimage " style="padding: 0 ;margin: 0 2 2 0;"></div> 

        <?php } ?> 

                    <!--                    <div class="enviar_rendicion milink" title="Aceptar y Enviar" onclick="">
                                            
                                            
                                        </div> -->

                    <!--<div class="impresionDoc milink" title="Imprimir PDF" 
                         onclick="Imp_reporte_de_rendicion('<?php // echo $reg->idreg_ren   ?>')"></div>   
                    <div class="boton_editar_usuario milink"  title="Editar Usuario"
                         onclick="dialog_nuevo_for_rendicion('div_formularios_dialog','<?php //echo base_url() . "contabilidad_plan_cuentas/nueva_rendicion/".$reg->idreg_ren;   ?>')"></div>
                    
                    <div class="ver_historial" title="Ver asiento"
                         onclick="Imp_reporte_de_rendicion_asiento('<?php // echo $reg->idreg_ren   ?>')"></div>
                    
                     SE ESTA AUMENTADO LAS SIG. DOS LINEAS 
                    <div class="impresionDoc milink" title="Imprimir PDF" onclick="Imp_detalle_movimiento_almacen('<?php //echo $reg->id_mov_alm   ?>')"></div> 
                    <div class="verDocumento f12 negrilla" title="Ver Detalle" onclick="dialog_contenidos_nuevo_ingreso_detalle('detalles_movimiento_almacen_art','<?php //echo base_url() . "movimiento_almacen/ver_lista_al_detalle/$reg->id_mov_alm";   ?> ')"></div>--> 

                </div>

            </div>

            <?php
        }
    } else
        echo '';
    ?>

