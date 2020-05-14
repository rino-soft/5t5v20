<div class="tam400 fondo_amarillo_claro">
    <div style="padding-left: 30px;">
        <?php
         echo "Controles para el menu";
         foreach ($controles as $mh) {
                    ?>
                    <div class="f10 cambio_fondo nocheckdiv tam400" id="menu<?php echo $mh->id_control; ?>" >
                        <div title="<?php echo  $mh->descripcion_control;?>">
                            <input type="checkbox" onclick="seleccionar_menu('<?php echo $mh->id_control; ?>','control_selec','control')" 
                               id="<?php echo "c" . $mh->id_control; ?>" class="nocheck" value="<?php echo $mh->id_control ?>">
                               <?php echo $mh->descripcion_control; ?>
                            <input type="hidden" id="id_menu" value="<?php echo $mh->id_control; ?>"> 
                        </div>
                        
                    </div>
                    

                <?php } ?>
    </div>
</div>
    
