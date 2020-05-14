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
                    <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa; ?>); search_and_list_dosificacion(div_resultado);" style="float: left" > <?php echo $pa . " ,"; ?> </div>
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
            <div class=" fondo_azul alin_cen" style="display: block-inline;float: left ;width: 10%">Codigo</div>
           <!-- <div class=" fondo_azul alin_cen" style="display: block-inline;float: left ;width: 12%">Estado</div> -->
            <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 15%">Nro Autorizacion</div>
            <div  class=" fondo_azul alin_izq" style="display: block-inline; float: left;width: 10%">NIT</div>
            <div  class=" fondo_azul alin_izq" style="display: block-inline; float: left;width: 10%">Actividad</div>
            <!---<div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 20%">Llave de control</div>--->
            <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 10%">Fecha Limite de emision</div>
            <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 10%">Fecha Inicial</div>
            <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 10%">Fecha Final</div>
            <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 10%">Nro<br>Inicial/Actual</div>
            
        </div>

        <!-- aqui se muestra los registros con un foreach -->

        <?php foreach ($registros->result() as $reg) { ?>
            <div class="grid_20 borde_abajo  cambio_fondo esparriba10  " style="width: 100%">
                <div class="f14 alin_cen negrilla colorRojo" style="display: block-inline;float: left; width: 10%"> <?php echo $reg->id_dosificacion; ?></div>
               <!-- <div class="f12 alin_cen " style="display: block-inline;float: left; width: 12%"><?php //echo $reg->estado; ?></div> -->
                <div class="f12 colorAzul negrilla" style="display: block-inline;  float: left; width: 15%"><?php if($reg->nro_autorizacion!="") echo $reg->nro_autorizacion; else echo "&nbsp;"?></div>
                <div class="f12 alin_izq" style="display: block-inline;float: left; width: 10%"><?php if($reg->NIT!="") echo $reg->NIT; else echo "&nbsp;"?></div>  
                <div class="f12 alin_izq" style="display: block-inline;float: left; width: 10%"><?php if($reg->NIT!="") echo $reg->actividad; else echo "&nbsp;"?></div>  
                <!--<div class="f12 alin_izqS " style="display: block-inline; float: left; width: 20%"><?php //echo $reg->llave_cod_control; ?></div>--->
                <div class="f10 alin_cen" style="display: block-inline;float: left; width: 10%"><?php if($reg->fl_emision!="")  echo $reg->fl_emision; else echo "&nbsp;"?></div>
                <div class="f10 alin_cen" style="display: block-inline;float: left; width: 10%"><?php if($reg->fecha_inicial!="") echo $reg->fecha_inicial; else echo "&nbsp;" ?></div>
                <div class="f10 alin_cen  " style="display: block-inline;float: left; width: 10%"><?php if($reg->fecha_final!="") echo $reg->fecha_final; else echo "&nbsp;"?></div>
                <div class="f10 alin_izq f16 negrilla centrartexto colorAzul" style="display: block-inline;float: left; width: 10%"><?php if($reg->nro_actual!="") echo "<span class='colorverde'>".$reg->nro_inicial."</span>/".$reg->nro_actual; else echo "&nbsp;"?></div>
                <div  style="display: block-inline;  float: left; width: 9%">
                
                    <div class="boton_editar_usuario milink"  title="Editar Dosificacion"
                         onclick="dialog_nueva_dosificacion('div_formularios_dialog','<?php echo base_url() . "dosificaciones/nueva_dosificacion/".$reg->id_dosificacion; ?>')"></div>
                    
                    
                   
                </div>
             
            </div>

            <?php
        }
    }
    else
        echo '';
    ?>

</div>