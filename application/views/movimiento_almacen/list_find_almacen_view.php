<div class="f12 container_20" style="width: 95% ">
    
     <div class="fondo_azul colorBlanco negrilla f12 grid_20" style="  width: 100%">
        <div style="display: inline-block">
            <?php
            if ($total_registros > 0)
                echo $total_registros . " registros cargados exitosamente.";
            else
                echo $total_registros . " registros cargados !  No se han encontrado Registros en la Base de Datos.";
            ?>
        </div>

        <div id="paginacion" class="f14" style=" padding-right: 25px;float:right ">

<?php


////////para la Paginacion //////////////////////////////////////////////////////////////
//////// OOOOOOOOOJJJJJJJJOOOOOOOOO  //////////////////////////////////////////////

            $numPag = ceil($total_registros / $mostrar_X);
            if ($numPag <= 20) {
                for ($pa = 1; $pa <= ceil($total_registros / $mostrar_X); $pa++) {
                    if ($pa != $pagina_actual) {
                        ?>
                        <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa;   ?>);search_and_list_ov_al('lista_movimiento_almacen');" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                        <?php
                    } else {
                        ?>
                        <div class="colorAmarillo" style="float: left"> <?php echo $pa . "&nbsp;&nbsp;&nbsp;";   ?> </div>
                        <?php
                    }
                }
            } else {
                switch ($pagina_actual) {
                    case (($pagina_actual >= 1) && ($pagina_actual <= 10)):
                        for ($pa = 1; $pa <= 15; $pa++) {
                            if ($pa != $pagina_actual) {
                                ?>
                                <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa;   ?>);search_and_list_ov_al('lista_movimiento_almacen');" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                                <?php
                            } else {
                                ?>
                                <div class="colorAmarillo" style="float: left"> <?php echo $pa . "&nbsp;&nbsp;&nbsp;";   ?> </div>
                                <?php
                            }
                        }
                        ?>
                        <div class='milink link_blanco' style="float: left" > &nbsp;. . .&nbsp;&nbsp; </div>    
                        <?php
                        for ($pa = $numPag - 4; $pa <= $numPag; $pa++) {
                            if ($pa != $pagina_actual) {
                                ?>
                                <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa;   ?>);search_and_list_ov_al('lista_movimiento_almacen');" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                                <?php
                            } else {
                                ?>
                                <div class="colorAmarillo" style="float: left"> <?php echo $pa . "&nbsp;&nbsp;&nbsp;";   ?> </div>
                                <?php
                            }
                        }
                        break;

                    case (($pagina_actual >= $numPag - 10) && ($pagina_actual <= $numPag)):
                        //echo "caso pagina actual >=10";
                        for ($pa = 1; $pa <= 5; $pa++) {
                            if ($pa != $pagina_actual) {
                                ?>
                                <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa;   ?>);search_and_list_ov_al('lista_movimiento_almacen');" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                                <?php
                            } else {
                                ?>
                                <div class="colorAmarillo" style="float: left"> <?php echo $pa . "&nbsp;&nbsp;&nbsp;";   ?> </div>
                                <?php
                            }
                        }
                        ?>
                        <div class='milink link_blanco' style="float: left" > &nbsp;. . .&nbsp;&nbsp; </div>    
                        <?php
                        for ($pa = $numPag - 15; $pa <= $numPag; $pa++) {
                           if ($pa != $pagina_actual) {
                                ?>
                                <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa;   ?>);search_and_list_ov_al('lista_movimiento_almacen');" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                                <?php
                            } else {
                                ?>
                                <div class="colorAmarillo" style="float: left"> <?php echo $pa . "&nbsp;&nbsp;&nbsp;";   ?> </div>
                                <?php
                            }
                        }
                        break;

                    default:
                        for ($pa = 1; $pa <= 5; $pa++) {
                            if ($pa != $pagina_actual) {
                                ?>
                                <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa;   ?>);search_and_list_ov_al('lista_movimiento_almacen');" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                                <?php
                            } else {
                                ?>
                                <div class="colorAmarillo" style="float: left"> <?php echo $pa . "&nbsp;&nbsp;&nbsp;";   ?> </div>
                                <?php
                            }
                        }
                        ?>
                        <div class='milink link_blanco' style="float: left" >&nbsp;. . .&nbsp;&nbsp;</div>    
                        <?php
                        for ($pa = $pagina_actual - 4; $pa <= $pagina_actual + 5; $pa++) {
                            if ($pa != $pagina_actual) {
                                ?>
                                <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa;   ?>);search_and_list_ov_al('lista_movimiento_almacen');" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                                <?php
                            } else {
                                ?>
                                <div class="colorAmarillo" style="float: left"> <?php echo $pa . "&nbsp;&nbsp;&nbsp;";   ?> </div>
                                <?php
                            }
                        }
                         ?>
                        <div class='milink link_blanco' style="float: left" > &nbsp;. . .&nbsp;&nbsp; </div>    
                        <?php
                        for ($pa = $numPag - 4; $pa <= $numPag; $pa++) {
                           if ($pa != $pagina_actual) {
                                ?>
                                <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa;   ?>);search_and_list_ov_al('lista_movimiento_almacen');" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                                <?php
                            } else {
                                ?>
                                <div class="colorAmarillo" style="float: left"> <?php echo $pa . "&nbsp;&nbsp;&nbsp;";   ?> </div>
                                <?php
                            }
                        }
                }
            }
            
            ////////para la Paginacion //////////////////////////////////////////////////////////////
//////// OOOOOOOOOJJJJJJJJOOOOOOOOO  //////////////////////////////////////////////
            ?>
                                
                                

        </div>

    </div>
    <?php
    if ($total_registros != 0) {
        ?>
        <div class="fondo_azul colorAmarillo borde_abajo borde_arriba  negrilla f14" style="display: block-inline;float: left ; width: 100%; height: ">            
            <div class=" fondo_azul alin_cen" style="display: block-inline;float: left ;width: 5%">Codigo</div>
            <div class=" fondo_azul alin_cen" style="display: block-inline;float: left ;width: 12%">Estado</div>
            <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 15%">Asignado a</div>
            <div  class=" fondo_azul alin_cen" style="display: block-inline;float: left ;width: 10%">Almacen</div>
            <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 7%">Fecha<br>Hora</div>
            <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 5%">Tipo de Mov</div>
            <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 11%">Proyecto</div>
            <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 25%">Comentario</div>
            
        </div>

        <!-- aqui se muestra los registros con un foreach -->

        <?php foreach ($registros->result() as $reg) { ?>
            <div class="grid_20 borde_abajo  cambio_fondo esparriba10  " style="width: 100%">
                <div class="f12 alin_cen negrilla" style="display: block-inline;float: left; width: 5%"><?php echo $reg->id_mov_alm; ?></div>
                <?php
                    $estilo_estado="";
                    if($reg->estado=="Guardado")
                        $estilo_estado="fondo_amarillo_claro";
                                                
                    if($reg->estado=="Material Entregado") 
                        $estilo_estado="fondo_verde_claro";
                    
                    if($reg->estado=="Material Recepcionado")
                        $estilo_estado="fondo_celeste_estado_inv";
   
                ?>
                <div class="f12 alin_cen  <?php echo $estilo_estado;?>" style="display: block-inline;float: left; width: 12%"><?php echo $reg->estado; ?></div>
                <div class="f12" style="display: block-inline;  float: left; width: 15%"><?php echo $reg->nombre_user . " " . $reg->ap_paterno . " " . $reg->ap_materno."<br>"; ?></div>
                <div class="f12 alin_cen" style="display: block-inline;float: left; width: 10%"><?php echo $reg->nombre."<br>"; ?></div>  
                <div class="f12 alin_cen"style="display: block-inline;  float: left; width: 7%"><?php echo $reg->fh_reg."<br>"; ?></div>
                <?php
                $estilo_tipo="";
                
                 if($reg->tipo_movimiento=="Salida")
                 
                        $estilo_tipo="fondoUp colorRojo ";
                                                
                    if($reg->tipo_movimiento=="Ingreso")
                        $estilo_tipo="fondoDown colorverde ";
                
                ?>
                <div class="f12 alin_cen negrilla  <?php echo $estilo_tipo;?>" style="display: block-inline; float: left; width: 5%"><?php echo $reg->tipo_movimiento."<br>"; ?></div>
                <div class="f10 alin_cen negrilla  colorAzul" style="display: block-inline;  float: left; width: 11%"><?php echo $reg->nombre_proy."<br>"; ?></div>
                <div class="f10 espizq10" style="display: block-inline;float: left; width: 25%"><?php if ($reg->comentario != "") echo $reg->comentario;else echo " &nbsp;" ?></div>
                <div  style="display: block-inline;  float: left; width: 9%">
                    <!-- SE ESTA AUMENTADO LAS SIG. DOS LINEAS --> 
                    <div class="impresionDoc milink" title="Imprimir PDF" onclick="Imp_detalle_movimiento_almacen('<?php echo $reg->id_mov_alm ?>')"></div> 
                    <div class="verDocumento f12 negrilla" title="Ver Detalle" onclick="dialog_contenidos_nuevo_ingreso_detalle('detalles_movimiento_almacen_art','<?php echo base_url() . "movimiento_almacen/ver_lista_al_detalle/$reg->id_mov_alm"; ?> ')"></div>
                    <?php if($reg->tipo_movimiento=="Salida"){
                        ?>
                    <div class="editarDocumento f12 negrilla" title="Editar Movimiento" onclick="dialog_nuevo_mov_alm_retiro_editar('div_formularios_dialog','<?php echo base_url() . "movimiento_almacen/almacen_retiro_directo/" . $reg->id_mov_alm; ?> ')"></div>
                    <?php }else{ ?>
                    <div class="editarDocumento f12 negrilla" title="Editar Movimiento" onclick="dialog_nuevo_mov_alm1('div_formularios_dialog','<?php echo base_url() . "movimiento_almacen/almacen_nuevo/" . $reg->id_mov_alm; ?> ')"></div>
                    <?php }?>
                </div>
            </div>

            <?php
        }
    }
    else
        echo '';
    ?>

</div>