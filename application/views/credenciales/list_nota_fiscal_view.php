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
          } */
        ?>
        <?php
////////para la Paginacion //////////////////////////////////////////////////////////////
//////// OOOOOOOOOJJJJJJJJOOOOOOOOO  //////////////////////////////////////////////

        $numPag = ceil($total_registros / $mostrar_X);
        if ($numPag <= 20) {
            for ($pa = 1; $pa <= ceil($total_registros / $mostrar_X); $pa++) {
                if ($pa != $pagina_actual) {
                    ?>
                    <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa; ?>);search_and_list_factura_venta('lista_oventa_prefacturas');" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                    <?php
                } else {
                    ?>
                    <div class="colorAmarillo" style="float: left"> <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                    <?php
                }
            }
        } else {
            switch ($pagina_actual) {
                case (($pagina_actual >= 1) && ($pagina_actual <= 10)):
                    for ($pa = 1; $pa <= 15; $pa++) {
                        if ($pa != $pagina_actual) {
                            ?>
                            <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa; ?>);search_and_list_factura_venta('lista_oventa_prefacturas');" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                            <?php
                        } else {
                            ?>
                            <div class="colorAmarillo" style="float: left"> <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                            <?php
                        }
                    }
                    ?>
                    <div class='milink link_blanco' style="float: left" > &nbsp;. . .&nbsp;&nbsp; </div>    
                    <?php
                    for ($pa = $numPag - 4; $pa <= $numPag; $pa++) {
                        if ($pa != $pagina_actual) {
                            ?>
                            <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa; ?>);search_and_list_factura_venta('lista_oventa_prefacturas');" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                            <?php
                        } else {
                            ?>
                            <div class="colorAmarillo" style="float: left"> <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                            <?php
                        }
                    }
                    break;

                case (($pagina_actual >= $numPag - 10) && ($pagina_actual <= $numPag)):
                    //echo "caso pagina actual >=10";
                    for ($pa = 1; $pa <= 5; $pa++) {
                        if ($pa != $pagina_actual) {
                            ?>
                            <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa; ?>);search_and_list_factura_venta('lista_oventa_prefacturas');" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                            <?php
                        } else {
                            ?>
                            <div class="colorAmarillo" style="float: left"> <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                            <?php
                        }
                    }
                    ?>
                    <div class='milink link_blanco' style="float: left" > &nbsp;. . .&nbsp;&nbsp; </div>    
                    <?php
                    for ($pa = $numPag - 15; $pa <= $numPag; $pa++) {
                        if ($pa != $pagina_actual) {
                            ?>
                            <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa; ?>);search_and_list_factura_venta('lista_oventa_prefacturas');" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                            <?php
                        } else {
                            ?>
                            <div class="colorAmarillo" style="float: left"> <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                            <?php
                        }
                    }
                    break;

                default:
                    for ($pa = 1; $pa <= 5; $pa++) {
                        if ($pa != $pagina_actual) {
                            ?>
                            <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa; ?>);search_and_list_factura_venta('lista_oventa_prefacturas');" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                            <?php
                        } else {
                            ?>
                            <div class="colorAmarillo" style="float: left"> <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                            <?php
                        }
                    }
                    ?>
                    <div class='milink link_blanco' style="float: left" >&nbsp;. . .&nbsp;&nbsp;</div>    
                    <?php
                    for ($pa = $pagina_actual - 4; $pa <= $pagina_actual + 5; $pa++) {
                        if ($pa != $pagina_actual) {
                            ?>
                            <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa; ?>);search_and_list_factura_venta('lista_oventa_prefacturas');" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                            <?php
                        } else {
                            ?>
                            <div class="colorAmarillo" style="float: left"> <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                            <?php
                        }
                    }
                    ?>
                    <div class='milink link_blanco' style="float: left" > &nbsp;. . .&nbsp;&nbsp; </div>    
                    <?php
                    for ($pa = $numPag - 4; $pa <= $numPag; $pa++) {
                        if ($pa != $pagina_actual) {
                            ?>
                            <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa; ?>);search_and_list_factura_venta('lista_oventa_prefacturas');" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                            <?php
                        } else {
                            ?>
                            <div class="colorAmarillo" style="float: left"> <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
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

        <!-- <div class=" fondo_azul alin_cen" style="display: block-inline;float: left ;width: 12%">Estado</div> -->
        <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 5%">Nro <br>Factura</div>
        <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 15%">Cliente / NIT</div>
        <!---<div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 20%">Llave de control</div>--->
        <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 5%">Fecha <br>Registro</div>
        <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 7%">Codigo de <br>Control</div>
        <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 13%">Proyecto / Contrato</div>

        <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 20%">Comentario</div>
        <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 10%">Monto Bs</div>
        <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 5%">Estado</div>
        <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 20%">
            <div class="botonResalta milink ocultar" id="botonbloqueimp"  style=" width: 80px;margin-top: 5px" onclick="imp_factura_venta_bloque()">Imprimir</div>
        </div>

    </div>

    <!-- aqui se muestra los registros con un foreach -->

    <?php
    foreach ($registros->result() as $reg) {
        $clase = "cambio_fondo";
        $cobro_estilo = " cobro_ico ";
//        if ($reg->est_factura == "Anulado") {
//            $clase = "fila_disabled";
//            $cobro_estilo = " cobroNO_ico ";
//        }
        ?>
        <div class="grid_20 borde_abajo <?php echo $clase; ?>  esparriba10  " style="width: 100%">
            <div  style="display: block-inline;  float: left; width: 5%">
                <div class=" negrilla alin_cen f20 colorRojo" >
                    <?php echo $reg->num_factura; ?>
                </div>
                <div class="alin_cen f8" >
                    <?php echo $reg->id_nf; ?>
                </div>
            </div>
            <div class="f12 alin_izq" style="display: block-inline;float: left; width: 15%"><span class="negrilla "><?php echo $reg->razon_social . "</span><br><span class='f14 colorAzul'>NIT: " . $reg->NIT_cliente; ?></span></div>  

            <div class="f12 alin_cen" style="display: block-inline;float: left; width: 5%"><?php echo $reg->fh_registro . "<br>"; ?></div>
            <div class="f9 negrilla colorRojo alin_cen " style="display: block-inline;float: left; width: 7%;<?php
            if (strlen($reg->codigo_control) > 14) {
                echo " background:yellow; ";
            }
            ?>"><?php echo $reg->codigo_control . "<br>"; ?></div>
            <div class="f10 " style="display: block-inline;float: left; width: 13%">
                <?php
                if ($proy_fac[$reg->id_nf]->num_rows() > 0)
                    echo "<span class='negrilla '>" . $proy_fac[$reg->id_nf]->row()->nombre . "<br></span>";
                else
                    echo "<span class='negrilla '>Sin proyecto<br></span>";
                if ($cont_fac[$reg->id_nf]->num_rows() > 0)
                    echo "<span class='colorAzul '>" . $cont_fac[$reg->id_nf]->row()->nro_contrato . " .- " . $cont_fac[$reg->id_nf]->row()->objeto . "<br></span>";
                else
                    echo "<span class='colorAzul '>Sin contrato<br></span>";
                ?>
            </div>

            <div class="f10 alin_izq" style="display: block-inline;float: left; width: 20%"><?php echo $reg->comentario . "<br>"; ?><input type="hidden" id="comentariooculto<?php echo $reg->id_nf; ?>" value="<?php echo $reg->comentario; ?>"></div>
            <div class="f14 negrilla alin_cen" style="display: block-inline;float: left; width: 10%"><?php echo $reg->monto_total_bs . "<br>"; ?></div>
<!--            <div class="f12 alin_cen" style="display: block-inline;float: left; width: 5%"><?php //echo $reg->est_factura . "<br>"; ?></div>-->
            <div  style="display: block-inline;  float: left; width: 20%">

                <div class="fondo_plomo_atras fondo_redondeado" style="float: left; background: #000000;margin: 0 10px 0 0;"  title="Seleccion para Imprimir Factura">
                    <input class="milink" id="imp<?php echo $reg->id_nf; ?>" type="checkbox" onclick="insert_input('input_bloque_impresion',<?php echo $reg->id_nf; ?>)" >
                </div>
                <div class="impresionDoc milink"  title="Imprimir Factura"
                     onclick="  if (confirm('Seguro que desea imprimir la factura? despues de ello no se podra hacer mas cambios !!')) {
                                 imp_nota_fiscal('<?php echo $reg->id_nf ?>');
                             }
                     ">
                </div>
                <div class="boton_editar_usuario milink"  title="editar Factura"
                     onclick="dialog_nueva_facventa('div_formularios_dialog', '<?php echo base_url() . "nota_fiscal/nota_fiscal_nuevo/" . $reg->id_nf; ?> ');">
                </div>

<!--                <div class="anular_ico milink"  title="ANULAR Factura"
                     onclick="anular_fac('anular_formulario',<?php //echo $reg->id_factura; ?>);">
                </div>-->
              



            </div>

        </div>

        <?php
    }
} else
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

<div id="formulario_pago" class="container_20 ocultar">
</div>  
