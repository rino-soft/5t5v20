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
                <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa; ?>);search_and_list_ov_pf('lista_oventa_prefacturas');" style="float: left" > <?php echo $pa . " ,"; ?> </div>
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
<div style="clear:both;height: 10px;"></div>

<!-- aqui se muestra los registros con un foreach -->
<div>
    <?php foreach ($registros->result() as $reg) { ?>
        <div class='div1150 fondo_plomo'>
            <div class="f12" style="display: block-inline;width: 300px;float: left ">
                <div style="display: block; ">
                    <span class="negrilla f16 colorRojo"><?php echo "id : " . $reg->id_ovpf . "(" . $reg->estado . ")"; ?></span>
                </div>               
                <div style="display: block; ">
                    <span class="negrilla"><?php echo "cliente : </span><span>" . $reg->razon_social; ?></span>
                </div>               
                <div style="display: block; ">
                    <span class="negrilla"><?php echo "Propietario : </span><span>" . $reg->ap_paterno.", ".$reg->nombre; ?></span>
                </div>               
                <div style="display: block; ">
                    <span class="negrilla colorRojo f14 "><?php echo "Monto Total : </span><span class='colorAzul negrilla f14' >" . $reg->monto_total; ?></span>
                </div>
                <div style="display: block; ">
                    <span class="negrilla"><?php echo "Fecha : </span><span>" . $reg->razon_social; ?></span>
                </div>
            </div>
            <div class="f12"style="display: block-inline;  width: 500px; float: left">
                <div style="display: block; ">
                    <span class="negrilla  colorRojo">Detalle</span>
                </div>               
                <div style="display: block; ">
                    <?php
                    $i = 0;
                    foreach ($detalle_registros[$reg->id_ovpf]->result() as $detalle_registro) {
                        $i++;
                        ?>
                    <div style="display: block">
                            <div style="float: left; width: 400px"><?php echo $i . "- " . $detalle_registro->cod_ps . " / " . $detalle_registro->cantidad_ps . " " . $detalle_registro->titulo_ps . " ,<span class='f10 colorAzul'> " . $detalle_registro->desc_ps . "</span>" ?></div>
                            <div class="alin_cen negrilla" style="width: 100px;float: left"><?php echo $detalle_registro->importe_bs; ?></div>
                        </div>    

                        <?php
                    }
                    ?> 
                </div> 
            </div>
            <div class="f12" style="display: block-inline; width: 200px; float: left">
                <div style="display: block; ">
                    <span class="negrilla  colorRojo">Comentario</span>
                </div>               
                <div style="display: block; ">
                    <span class="negrilla"><?php echo $reg->comentario; ?></span>
                </div>               
                
            </div>
            <div style="display: block-inline; width: 150px; float: left">
                <div class="espaciado10 negrilla"><div style="display: block; ">
                        <div class="boton2 " onclick="show_ovpf('div_formularios_dialog','<?php echo $reg->id_ovpf;?>')"><?php echo "ver"; ?></div>
                    </div>               
                    <div style="display: block; ">
                        <!--- modificando esta parte --->
                        <div class="boton2" title="Facturar"
                             onclick="Imp_factura_oventa_prefactura('<?php echo $reg->id_ovpf ; ?>')">Facturar
                        </div>
                        <!--- hasa aqui--->
                        <div style="display: block; ">
                            <div class="boton2"><?php echo "Anular"; ?></div>
                        </div> 
                        
                     </div>
                </div>
            </div>




        </div> 
    <?php } ?>
</div>