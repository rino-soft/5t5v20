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
                    <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa; ?>);search_and_list_act_fijo('lista_act_fijo');" style="float: left" > <?php echo $pa . " ,"; ?> </div>
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
            <div class=" fondo_azul alin_cen" style="display: block-inline;float: left ;width: 30%">Producto / Servicio</div>
            <div class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 15%">Serial / Codigo Propio</div>

            <div class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 20%">Asignado a:</div>
            <div class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 10%">Detalle movimiento</div>
            <div class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 10%">Adjuntos</div>
        </div>

        <!-- aqui se muestra los registros con un foreach -->

        <?php foreach ($registros->result() as $reg) { ?>
            <div class="grid_20 borde_abajo  cambio_fondo esparriba10  " style="width: 100%">
                <div class="f12 alin_izq " style="display: block-inline;float: left; width: 30%">
                    <span class=" negrilla colorRojo"><?php echo $reg->id_serv_pro." - "; ?></span><span class="color_cod negrilla"><?php echo  $reg->cod_serv_prod; ?></span>
                    <span class="colorAzul "><?php if ($reg->nombre_titulo != "") echo $reg->nombre_titulo; else echo "&nbsp;"?>
                    <br><span class="colorverde"> <?php echo $reg->descripcion;?></span>
                    <br><span class="colorAzul f14 fondo_amarillo_claro"> <?php  echo $reg->observaciones; ?></span>
                </div>
                
                <div class="f11 alin_izq colorcel" style="display: block-inline;float: left; width: 15%">
                    <span class="colorAzul negrilla f16"> <?php if ($reg->SN != "") echo "SN:".$reg->SN."<br>"; ?></span>
                    <span class="negrocolor negrilla f16"><?php if ($reg->cod_prop_sts_equipo != "") echo "CP:".$reg->cod_prop_sts_equipo; else echo "&nbsp;" ?></span>
                </div>
                
                <div class="f10" style="display: block-inline;  float: left; width: 20%"><?php if ($reg->ap_paterno != "") echo $reg->ap_paterno . " " . $reg->ap_materno . " " . $reg->nombre; else echo "&nbsp;"?>
                   <br>
                   <span class="colorGuindo f10">Proyecto:</span><span class="colorcel f12"><?php echo $reg->nombre_proyecto?></span>
                </div>
                <div class="f11" style="display: block-inline;  float: left; width: 10%"><?php if ($reg->tipo_movimiento != "") echo $reg->tipo_movimiento; else echo "&nbsp;"?>
                   <br><span class="colorGuindo f10">Id.mov. </span><span class="f11"><?php echo $reg->id_mov_alm; ?></span>
                </div>          
                <div class="f11" style="display: block-inline;  float: left; width: 10%"><?php if ($reg->tipo_movimiento != "") echo 'enlace adjunto'; else echo "&nbsp;"?></div>          
                <div class="" style="display: block-inline; float: left;width: 7%">
                    <div class="" style="display: block;float:right">
                        <?php if($reg->tipo_movimiento!="Ingreso"){?>
                            <div title="Imprimir ticket" class="barcode milink " onclick="Imp_ticket_activo_fijo(<?php echo $reg->id_mov_alm.",".$reg->id_det_mov_alm; ?>)"></div>
                        <?php }
                        ?>
                    </div>
                </div>
            </div>

            <?php
        }
    }
    else
        echo '';
    ?>

