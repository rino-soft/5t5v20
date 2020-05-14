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
                    <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa; ?>); search_and_list_proyecto('lista_proyecto');" style="float: left" > <?php echo $pa . " ,"; ?> </div>
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
            <div class=" fondo_azul alin_cen" style="display: block-inline;float: left ;width: 10%">ID</div>
            <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 10%">Proyecto</div>
            <div  class=" fondo_azul alin_izq" style="display: block-inline; float: left;width: 30%">Descripcion</div>
            <div  class=" fondo_azul alin_izq" style="display: block-inline; float: left;width: 10%">Fecha Hora Reg.</div>
            <div  class=" fondo_azul alin_izq" style="display: block-inline; float: left;width: 10%">Estado</div>
         
            
        </div>

        <!-- aqui se muestra los registros con un foreach -->

        <?php foreach ($registros->result() as $reg) { 
            $fondo_act="";
            if($reg->estado=='Inactivo')
                $fondo_act='fondo_desactivado';
            
            
            ?>
            <div class="grid_20 borde_abajo   cambio_fondo esparriba10 <?php echo $fondo_act;?>" style="width: 100%">
                <div class="f16 alin_cen negrilla colorRojo" style="display: block-inline;float: left; width: 10%"> <?php echo $reg->id_proy; ?></div>
               <!-- <div class="f12 alin_cen " style="display: block-inline;float: left; width: 12%"><?php //echo $reg->estado; ?></div> -->
                <div class="f12 colorAzul negrilla" style="display: block-inline;  float: left; width: 10%"><?php if($reg->nombre!="") echo $reg->nombre; else echo "&nbsp;"?></div>
                <div class="f12 alin_izq" style="display: block-inline;float: left; width: 30%"><?php if($reg->descripcion!="") echo $reg->descripcion; else echo "&nbsp;"?></div>  
                <div class="f12 alin_izq" style="display: block-inline;float: left; width: 10%"><?php if($reg->fh_reg_proy!="") echo $reg->fh_reg_proy; else echo "&nbsp;"?></div>  
                <div class="f12 alin_izq" style="display: block-inline;float: left; width: 10%"><?php if($reg->estado!="") echo $reg->estado; else echo "&nbsp;"?></div>  

                <div  style="display: block-inline;  float: left; width: 9%">
                
                    <div class="boton_editar_usuario milink"  title="Editar Proyecto"
                         onclick="dialog_contenidos_nuevo_proyecto('div_formularios_dialog','<?php echo base_url() . "proyecto/nueva_proyecto/".$reg->id_proy; ?>')"></div>
                    
                    
                   
                </div>
             
            </div>

            <?php
        }
    }
    else
        echo '';
    ?>

