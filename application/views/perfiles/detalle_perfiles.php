<div class="grid_20 borde_abajo borde_arriba ">
    <?php foreach ($detalle->result() as $item) { ?>
        <div class="grid_1">
            <input type="checkbox" id="check<?php echo $item->id_perfil; ?>" value="<?php echo $item->id_perfil; ?>"> 
        </div>
        <div class="f12"style="display: block-inline;  width: 150px; float: left">
            <div style="display: block; "><?php echo $item->titulo ?></div>
            <div style="display: block; "><?php echo $item->id_perfil ?></div>  
        </div>
    <?php } ?>     

</div>
<div id="np" >
    <?php
    $i = 0;
    foreach ($menu_superior as $ms) {
        ?>
        <div class="div500 borde_abajo   esparriba10" >                    
            <div class="f12  " style="display: block-inline;width: 500px;float: left; ">
                <div class="f14 espizq10 negrilla espabajo5">  <?php echo $ms->titulo; ?></div>      
                <?php
                $f = 0;
                $mdetalle = $menu_detallado[$i];
                foreach ($mdetalle as $mh) {
                    $chec = "";
                    /*
                      if (in_array($mh->id, ids_seleccionados)) {
                      $chec = 'checked="checked"';
                      } */
                    if ($mh->id != $detalle->row($f)->id_menu) {
                        
                        ?> 
                        <div class="f12 espizq10 cambio_fondo">
                            <input type="checkbox"   <?php echo $chec; ?> onclick="seleccionar_menu('<?php echo $mh->id; ?>')" 
                                   id="<?php echo "c" . $mh->id; ?>" value="<?php echo $mh->id ?>">
                                   <?php echo $mh->titulo; ?>
                        </div>
                        <?php
                    } else {
                        $chec = 'checked="checked"';
                        ?>
                        <div class="f12 espizq10 cambio_fondo resaltar">
                            <input type="checkbox"  <?php echo $chec; ?> onclick="seleccionar_menu('<?php echo $mh->id; ?>')" 
                                   id="<?php echo "c" . $mh->id; ?>" value="<?php echo $mh->id ?>">
                                   <?php echo $mh->titulo; ?>
                        </div>  
                    <?php } ?>
                    <input type="hidden" id="id_menu" value="<?php echo $mh->id; ?>"> 
                    <input type="hidden" id="id_perfil" value="<?php //echo $consulta1->row($i)->id_perfil; ?>">
                    <?php
                    $f++;
                } 
                $i++;
                ?> 
            </div>                               
        </div>
      <?php
    }
    ?> 
</div>