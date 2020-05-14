<div class="fondo_azul colorBlanco negrilla f12" style="width: 95%; display: block; padding: 5px; ">
    <div style="display: inline-block">
        <?php
        if ($total_registros > 0)
            echo $total_registros . " registros cargados exitosamente.";
        else
            echo $total_registros . " registros cargados !  No se han encontrado Registros en la Base de Datos.";
        ?>
    </div>
</div>
<?php
if ($total_registros != 0) {
    ?>
    <div class="f12  alin_cen  negrilla fondo_azul colorAmarillo" style="display: block-inline;width: 95%; padding: 5px;  ">
        PERFILES                    
    </div>  
    <!-- aqui se muestra los registros con un foreach -->
    <div>
        <?php foreach ($registros->result() as $reg) { ?>
            <div class="div500 borde_abajo  cambio_fondo " >
                <div class="f12 espizq10 " style="display: block-inline;width:595px;float: left; ">
                    <input name="restringir_sel" type="radio" onchange="seleccionar_perfiles_user('<?php echo $reg->id_perfil; ?>'); insertar_detalle_perfiles_menu('<?php echo $reg->id_perfil ?>','ids_seleccionados');"
                           id="<?php echo "selc_perfiles" . $reg->id_perfil; ?>" value="<?php echo $reg->id_perfil; ?>"> 
                           <?php echo $reg->nombre; ?>
                </div>
                <div style="display: block-inline;width: 50px;float: left;" class='boton2 f10 alin_cen' 
                     onclick="insertar_detalle_perfiles('<?php echo $reg->id_perfil ?>','ids_seleccionados'); setTimeout(function(){seleccionar_perfiles(); mostrar_perfil();
                             }, 100);">
                    Ver
                </div>
            </div>

            <input type="hidden" id="id_perfil_asignar" value="<?php echo $reg->id_perfil; ?>">
            <?php
        }
    }
    else
        echo '';
    ?>
    </div>
<div class='div500  alin_cen fondo_azul borde_abajo borde_arriba borde_der borde_izq espabajo alin_cen colorAmarillo f12 negrilla' >
    DETALLES DE PERFIL                       
</div>

<div id="oculta" style="display: block-inline;width: 100px;float: left;" class="boton2 f12 negrilla alin_cen" onclick="mostrar_nuevo_perfil();" >NUEVO PERFIL</div>
<!-- aqui se muestra los registros con un foreach -->
<div id="np" class="ocultar">
    <?php
    $i = 0;
    foreach ($menu_superior as $ms) {
        ?>
        <div class="div500 borde_abajo   esparriba10" >                    
            <div class="f12 " style="display: block-inline;width: 500px;float: left;">
                <div class="f14 espizq10 negrilla espabajo5">  <?php echo $ms->titulo; ?></div>      
                <?php
                $mdetalle = $menu_detallado[$i];
                foreach ($mdetalle as $mh) {
                    ?>
                    <div class="f12 espizq10 cambio_fondo nocheckdiv" id="menu<?php echo $mh->id; ?>" style="display: block-inline;width: 670px;float: left; ">
                        <input type="checkbox" onclick="seleccionar_menu('<?php echo $mh->id; ?>')" 
                               id="<?php echo "c" . $mh->id; ?>" class="nocheck" value="<?php echo $mh->id ?>">
                               <?php echo $mh->titulo; ?>
                    </div>
                    <input type="hidden" id="id_menu" value="<?php echo $mh->id; ?>"> 
                    <input type="hidden" id="id_perfil" value="<?php //echo $consulta1->row($i)->id_perfil;     ?>">
                <?php } $i++; ?> 

            </div>                               
        </div>
        <?php
    }
    ?>  
</div>
<div style="display: block-inline; width: 150px; float: right;" id="gp" class="ocultar">               
    <div style="display: block; "> 
        <div class="boton2 f12 negrilla alin_cen" onclick="dialog_nuevo_perfiles('dialog_nuevo_perf','<?php echo base_url() . "perfiles/guardar_nuevo_perfiles/0"; ?> ')"><?php echo "GUARDAR PERFIL"; ?></div>
    </div> 
</div>
<div id="nuevo_perfil"></div>











