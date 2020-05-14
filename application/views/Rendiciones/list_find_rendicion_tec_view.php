
<!--
    <div class="espabajo5" style="display: block; height: 20px; width: 100%;height: ">
        <div class="f10 negrilla colorcel milink milinktext" style="display: block-inline; float: left; width: 10%;"  onclick="seleccionar_rendiciones(1);" >MARCAR TODOS</div>
        <div class="boton2 f10 alin_cen" style="display: block-inline; float: left; width: 7%" onclick="Imp_reporte_de_rendicion_proy()">Imprimir PDF</div>
    </div>
    <div class="" style="display: block; height: 20px; width: 100%;height: ">
        <div class="f10 negrilla colorcel milink milinktext" style="display: block-inline; float: left; width: 10%"  onclick="seleccionar_rendiciones(0);" >DESMARCAR TODOS</div>
    </div>
     

<div class="alin_der espder20 NO_RENDICION f12 esparriba10 espabajo10">
    <span class="f14 negrilla">Listado de Rendiciones Realizadas - Area Técnica</span>
</div>-->


<div class="f12 container_20" style="width: 95% ">
    <div class="NO_RENDICION f12 grid_20 esparriba5 espabajo5" style=" display: block; float: right;  width: 100%">
        <div style="display: block;" class="negrilla alin_der ">
            Listado de Rendiciones y reembolsos Realizados

        </div>


        <!--         <div  class="f10 negrilla colorcel alin_izq" style="float: left; padding-right: 25px">
                 <span class="milink milinktext" onclick="seleccionar_rendiciones(1);"> MARCAR TODOS</span><br>
                   <span class="milink milinktext" onclick="seleccionar_rendiciones(0);">DESMARCAR TODOS</span><br>
                   <span class="boton2 f10 alin_cen milink" style="display: block-inline; float: left;" onclick="Imp_reporte_de_rendicion_proy()">Imprimir PDF</span>
               </div>-->
    </div>

</div>



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
                    <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa; ?>); search_and_list_mis_rendiciones_jp('lista_rendicion');" style="float: left" > <?php echo $pa . " ,"; ?> </div>
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
            <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 10%">Fecha de Registro</div>
            <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 20%">Proyecto</div>
            <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 10%">Tipo rendicion</div>
            <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 10%">Monto</div>
            <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 10%">Estado</div>
            <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 20%">Observaciones</div>
        </div>

        <!-- aqui se muestra los registros con un foreach -->

        <?php foreach ($registros->result() as $reg) { ?>
            <div class="grid_20 borde_abajo  cambio_fondo esparriba10  " style="width: 100%" id="div<?php echo $reg->idreg_ren; ?>">
                <div class="f12 alin_cen negrilla colorRojo" style="display: block-inline;float: left; width: 5%"> <?php echo $reg->idreg_ren; ?></div>
                <div class="f12 alin_cen " style="display: block-inline;float: left; width: 10%"> <?php echo $reg->fh_registro; ?></div>
                <div class="f10 alin_cen colorAzul negrilla " style="display: block-inline;float: left; width: 20%"><?php echo $reg->nombre_proyecto . '<br><span class=" colorcel negrilla">' . $reg->descripcion . '</span>'; ?></div>
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
                <div class="f12 alin_cen " style="display: block-inline;float: left; width: 10%"><span class="colorGuindo negrilla alin_izq">Bs.- </span><?php echo $reg->monto; ?></div> 
                <div class="f12 alin_cen " style="display: block-inline;float: left; width: 10%"><?php
                    if ($reg->estado != "")
                        echo $reg->estado;
                    else
                        echo " &nbsp;"
                        ?></div>
                <div class="f10 alin_cen " style="display: block-inline;float: left; width: 20%"><?php
                    if ($reg->observacion != "")
                        echo $reg->observacion;
                    else
                        echo " &nbsp;"
                        ?></div>
                <div class="" style="display:block-inline;float: left;width: 15%">
                    <div class="editar_rendicion milink" title="Editar "
                         onclick="dialog_nuevo_for_rendicion('div_formularios_dialog', '<?php echo base_url() . "rendiciones/nueva_rendicion/" . $reg->idreg_ren; ?>', 'Editar Rendicion')"
                         >


                    </div>

                    <!---<div class="enviar_rendicion milink" title="Enviar" onclick=""></div>--->
                    <div class="impresionDoc milink" title="Imprimir PDF" onclick="Imp_reporte_de_rendicion_tecnico('<?php echo $reg->idreg_ren; ?>')"></div>
        <?php if ($reg->id_responsable_proy=="|-1|") { ?>
                        
                        <div class="impresionDocVerde milink" title="Imprimir PDF" 
                             onclick="Imp_reporte_de_rendicion('<?php echo $reg->idreg_ren ?>')">
                        </div> 

        <?php } ?>
                    <!--                    <div>
                                            <input  class="select_and_unselect" type="checkbox" name="check" onclick="acumula_rend('<?php echo $reg->idreg_ren; ?>')" value="<?php echo $reg->idreg_ren; ?>" id="check_rend" title="Seleccionar">
                                        </div>-->
                </div>    
            </div>

            <?php
        }
    } else
        echo '';
    ?>

