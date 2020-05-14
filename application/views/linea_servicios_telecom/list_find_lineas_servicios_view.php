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
                    <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa; ?>);search_and_list_lineas_servicios('lista_lineas');" style="float: left" > <?php echo $pa . " ,"; ?> </div>
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
        <div class="fondo_azul colorAmarillo borde_abajo borde_arriba  negrilla f14" style="display: block-inline;float: left ; width: 100%; height: ">            
            <div class=" fondo_azul alin_cen" style="display: block-inline;float: left ;width: 3%">Id</div>
            <div class=" fondo_azul alin_cen" style="display: block-inline;float: left ;width: 10%">Instancia</div>
            <div  class=" fondo_azul alin_cen" style="display: block-inline;float: left ;width: 7%">Operadora</div>
            <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 15%">Costos</div>
            <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 17%">Comentario</div>
            <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 18%">Asignado a</div>
            <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 10%">Proyecto</div>
            <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 7%">Lugar</div>
            <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 7%">Ciudad</div>
            <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 4%"></div>

        </div>

        <!-- aqui se muestra los registros con un foreach -->

        <?php
        foreach ($registros->result() as $reg) {

            $estilo_estado = "filas";
            if ($reg->estado == "Inactivo")
                $estilo_estado = "fila_disabled";
            ?>

            <div class="f12 <?php echo $estilo_estado; ?> espabajo5 esparriba5" style="display: block-inline;float: left ; width: 100%; height: ">            
                <div class="  alin_cen" style="display: block-inline;float: left ;width: 3%"><?php echo $reg->id_lin_serv; ?></div>
                <div class="  alin_cen f16 negrilla colorcel fondo_Celeste_claro" style="display: block-inline;float: left ;width: 10%"><?php echo $reg->instancia . "<br>"; ?></div>
                <div  class="  alin_cen" style="display: block-inline;float: left ;width: 7%"><?php echo $reg->proveedor . "<br>"; ?></div>
                <div  class="  alin_cen fondo_plomo_claro_areas_p f10 negrilla" style="display: block-inline; float: left;width: 15%">
                    <div class="alin_cen" style="display: block-inline;float: left; width:25% "><span class="colorGuindo">Win</span><br><?php echo $reg->win . "<br>"; ?></div>
                    <div class="alin_cen" style="display: block-inline;float: left; width:25% "><span class="colorGuindo">Voz</span><br><?php echo $reg->plan_voz . "<br>"; ?></div>
                    <div class="alin_cen" style="display: block-inline;float: left; width:25% "><span class="colorGuindo">Datos</span><br><?php echo $reg->plan_datos . "<br>"; ?></div>
                    <div class="alin_cen" style="display: block-inline;float: left; width:25% "><span class="colorGuindo">Total</span><br><?php echo $reg->monto_pago_linea . "<br>"; ?></div>
                </div>
                <div  class="  alin_cen" style="display: block-inline; float: left;width: 17%"><?php echo $reg->observaciones . "<br>"; ?></div>
                <div  class="  alin_cen" style="display: block-inline; float: left;width: 18%"><?php echo $reg->ap_paterno . " " . $reg->ap_materno . ", " . $reg->nombre . "<br> <span class='f8 negrilla '>Aclaracion: </span><span class='colorcel f8 negrilla'>".$reg->aclaracion_user."</span>"; ?></div>
                <div  class="  alin_cen" style="display: block-inline; float: left;width: 10%"><?php echo $reg->proyecto . "<br>"; ?></div>
                <div  class="  alin_cen" style="display: block-inline; float: left;width: 7%"><?php echo $reg->lugar . "<br>"; ?></div>
                <div  class="  alin_cen" style="display: block-inline; float: left;width: 7%"><?php echo $reg->ciudad . "<br>"; ?></div>
                <div  class=" " style="display: block-inline; float: left;width: 4%">
                    <div class="edit_ico" onclick="dialog_registro_lineas('div_formularios_dialog','<?php echo base_url() . "linea_servicio/formulario_registro_linea_servicio_telecom/".$reg->id_lin_serv; ?> ')" title="Editar"></div></div>
            </div>




            <?php
        }
    } else
        echo 'No se encontraron Registros ...';
    ?>
