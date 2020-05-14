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
       /* for ($pa = 1; $pa <= ceil($total_registros / $mostrar_X); $pa++) {
            if ($pa != $pagina_actual) {
                ?>
                <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa; ?>);search_and_list_factura_venta('lista_oventa_prefacturas');" style="float: left" > <?php echo $pa . " ,"; ?> </div>
                <?php
            } else {
                ?>
                <div class="colorAmarillo" style="float: left"> <?php echo $pa . " ,"; ?> </div>
                <?php
            }
        }*/
		
		
		
        ?>
		<?php


////////para la Paginacion //////////////////////////////////////////////////////////////
//////// OOOOOOOOOJJJJJJJJOOOOOOOOO  //////////////////////////////////////////////

            $numPag = ceil($total_registros / $mostrar_X);
            if ($numPag <= 20) {
                for ($pa = 1; $pa <= ceil($total_registros / $mostrar_X); $pa++) {
                    if ($pa != $pagina_actual) {
                        ?>
                        <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa;   ?>);search_and_list_factura_venta('lista_oventa_prefacturas');" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
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
                                <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa;   ?>);search_and_list_factura_venta('lista_oventa_prefacturas');" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
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
                                <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa;   ?>);search_and_list_factura_venta('lista_oventa_prefacturas');" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
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
                                <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa;   ?>);search_and_list_factura_venta('lista_oventa_prefacturas');" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
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
                                <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa;   ?>);search_and_list_factura_venta('lista_oventa_prefacturas');" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
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
                                <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa;   ?>);search_and_list_factura_venta('lista_oventa_prefacturas');" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
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
                                <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa;   ?>);search_and_list_factura_venta('lista_oventa_prefacturas');" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
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
                                <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa;   ?>);search_and_list_factura_venta('lista_oventa_prefacturas');" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
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
<div style="clear:both;height: 10px;"></div>

<!-- aqui se muestra los registros con un foreach -->

<?php
if ($total_registros != 0) {
    ?>
    <div class="fondo_azul colorAmarillo borde_abajo borde_arriba  negrilla f14" style="display: block-inline;float: left ; width: 100%; height: ">            
        <div class=" fondo_azul alin_cen f8" style="display: block-inline;float: left ;width: 2%">id</div>
        <!-- <div class=" fondo_azul alin_cen" style="display: block-inline;float: left ;width: 12%">Estado</div> -->
        <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 5%">Nro <br>Factura</div>
        <div  class=" fondo_azul alin_izq" style="display: block-inline; float: left;width: 10%">Cliente / NIT</div>
        <!---<div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 20%">Llave de control</div>--->
        <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 5%">Fecha <br>elaboracion</div>
        <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 5%">Codigo de <br>Control</div>
        <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 10%">proyecto</div>
        <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 10%">Contrato</div>
        <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 20%">Comentario</div>
        <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 10%">Monto Bs</div>
        <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 10%">Estado</div>
        <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 10%"><div class="fondo_plomo_atras fondo_redondeado colorAzul f12 negrilla" style="float: left; background:#ffa900; padding: 0 5px 0 0;  margin: 5px 5px 0 0;"  title="Imprimir Factura"><input type="checkbox" > Marcar Todo</div></div>

    </div>

    <!-- aqui se muestra los registros con un foreach -->

    <?php
     
 foreach ($registros->result() as $reg) {
        $clase = "cambio_fondo";
        if ($reg->est_factura == "Anulado")
            $clase = "fila_disabled";
            ?>
        <div class="grid_20 borde_abajo <?php echo $clase; ?>  esparriba10  " style="width: 100%">
            <div class="f8 alin_cen " style="display: block-inline;float: left; width: 2%"> <?php echo $reg->id_factura; ?></div>

            <div class="f12 negrilla alin_cen f18 colorRojo" style="display: block-inline;  float: left; width: 5%"><?php echo $reg->num_factura; ?></div>
            <div class="f12 alin_izq" style="display: block-inline;float: left; width: 10%"><?php echo $reg->razon_social . "<br>NIT: " . $reg->NIT_cliente; ?></div>  

            <div class="f12 alin_cen" style="display: block-inline;float: left; width: 5%"><?php echo $reg->fec_reg . "<br>"; ?></div>
            <div class="f9 negrilla colorRojo alin_cen" style="display: block-inline;float: left; width: 5%"><?php echo $reg->codigo_control . "<br>"; ?></div>
            <div class="f10 alin_cen" style="display: block-inline;float: left; width: 10%"><?php if($proy_fac[$reg->id_factura]->num_rows()>0) echo $proy_fac[$reg->id_factura]->row()->nombre."<br>"; else echo "Sin proyecto"; ?></div>
            <div class="f10 alin_cen" style="display: block-inline;float: left; width: 10%"><?php if($cont_fac[$reg->id_factura]->num_rows()>0) echo $cont_fac[$reg->id_factura]->row()->nro_contrato." .- ".$cont_fac[$reg->id_factura]->row()->objeto."<br>"; else echo "Sin contrato"; ?></div>
            <div class="f10 alin_izq" style="display: block-inline;float: left; width: 20%"><?php echo $reg->comentario . "<br>"; ?><input type="hidden" id="comentariooculto<?php echo $reg->id_factura; ?>" value="<?php echo $reg->comentario; ?>"></div>
            <div class="f14 negrilla alin_cen" style="display: block-inline;float: left; width: 10%"><?php echo $reg->monto_total_bs . "<br>"; ?></div>
            <div class="f12 alin_cen" style="display: block-inline;float: left; width: 10%"><?php echo $reg->est_factura . "<br>"; ?></div>
            <div  style="display: block-inline;  float: left; width: 10%">

                <div class="fondo_plomo_atras fondo_redondeado" style="float: left; background: #000000;margin: 0 10px 0 0;"  title="Imprimir Factura"><input type="checkbox" >
                </div>
                <div class="impresionDoc milink"  title="Imprimir Factura"
                     onclick="  if (confirm('Seguro que desea imprimir la factura? despues de ello no se podra hacer mas cambios !!')) {
                         imp_factura_venta('<?php echo $reg->id_factura ?>') ;
                     }
                     ">
                </div>
                <div class="boton_editar_usuario"  title="editar Factura"
                     onclick="dialog_nueva_facventa('div_formularios_dialog','<?php echo base_url() . "factura_venta/factura_venta_nuevo/" . $reg->id_factura; ?> ');">
                </div>

                <div class="delete_ico"  title="editar Factura"
                     onclick="anular_fac('anular_formulario',<?php echo $reg->id_factura; ?> );">
                </div>



            </div>

        </div>

        <?php
    }
}
else
    echo 'No se Encontraron Registros';
?>

<div id="anular_formulario" class="ocultar container_20">

    <div class="grid_10 NO">
        <div class="grid_10 f30 centrartexto">
            ATENCIÓN
        </div>
        <div class="grid_10 centrartexto">
            Esta usted seguro que desea ANULAR esta factura..!!
        </div>

        <div class="grid_10 negrilla f10">
            Comentario de la Anulación.-
        </div>

        <div class="grid_10 centrartexto espabajo5">
            <textarea id="comentario" style="width: 480px;height: 60px;"></textarea> 
        </div>

    </div>  
   
</div>  


