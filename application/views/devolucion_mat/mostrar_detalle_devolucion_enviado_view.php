<?php if ($cant_registro->num_rows() > 0) { ?>
    <div class="bordeado  container_20" style="display: block;  float: left; width: 100%;">
        
       <div class="f12 esparriba5 espabajo5  grid_15 fondo_azul colorAmarillo" style="display: block-inline;  float: left; width: 100%;">
            <div style="display: block; " class="grid_2 negrilla espizq10">NOMBRE: </div>               
            <div style="display: block; " class="grid_13 mayusculas f14 borde_abajo negrilla"><?php echo $cant_registro->row(0)->nombre . " " . $cant_registro->row(0)->ap_paterno . " " . $cant_registro->row(0)->ap_materno; ?></div>               
        </div>
        <div  class="grid_15" style="">
            <div style="display: block-inline;float: left; " class="alin_izq  f12 grid_15"> 
                <div style="display: block; "  class="grid_2 negrilla espizq10">Codigo:</div>                
                <div style="display: block; "  class="grid_4 espizq10 alin_izq"><?php echo $cant_registro->row(0)->nombre_proy; ?></div> 
                <div style="display: block; " class="grid_2 negrilla espizq10">Fecha/Hora:</div>
                <div style="display: block; " class="grid_4 espizq10 alin_izq"><?php echo $cant_registro->row(0)->fh_registro_dev; ?></div>
            </div>
            
            <div style="display: block-inline;float: left; " class="alin_izq  f12 grid_15" >
                <div style="display: block;" class="grid_2 negrilla  espizq10">Comentario:</div> 
                <div style="display: block;" class="grid_12 espizq10"><?php echo  $cant_registro->row(0)->comentario_dev; ?></div>
            </div>
        </div>
        <div  class=" grid_15" style="width: 100%;"  >
            <div class="fondo_azul colorAmarillo negrilla f14 espabajo10 esparriba10 alin_cen" style="display: block;">DETALLES</div>
        </div>

        <div class="f12 negrilla fondo_plomo_atras borde_abajo fondo_azulm grid_15 espabajo5 esparriba5" style="width: 100%;" >
            <div class="colorAzul espizq10 grid_2"style="display: block-inline; float: left">Codigo</div>
            <div class="grid_3"style="display: block-inline; float: left">Producto</div>
            <div class="grid_3" style="display: block-inline; float: left;">Cantidad Asignada</div>
            <div class="grid_3" style="display: block-inline; float: left">Cantidad Devuelta</div>
            <div class="grid_2" style="display: block-inline; float: left">Cantidad Utilizada</div>
            <div class="grid_2" style="display: block-inline; float: left">Justificacion</div>
        </div>
        <?php foreach ($cant_registro->result() as $reg) { ?>

            <div  style="width: 100%;" class="f10 espabajo5 esparriba5  borde_abajo  cambio_fondo grid_15 fondo_amarillo" >
                <div  class="espizq10 grid_2 f10"style="display: block-inline; float: left"><?php echo $reg->cod_serv_prod; ?></div>
                <div  class="espizq10 grid_3 f10"style="display: block-inline; float: left"><?php echo $reg->nombre_titulo; ?></div>
                <div class="grid_3 f10"style="display: block-inline; float: left"><?php echo $reg->cantidad_asignada; ?></div>
                <div class="grid_3 f10"style="display: block-inline; float: left"><?php echo $reg->cantidad_devuelto; ?></div>
                <div class="grid_2 f10"style="display: block-inline; float: left"><?php echo $reg->cantidad_utilizada; ?></div>
                <div class="grid_2 f10"style="display: block-inline; float: left"><?php echo $reg->justificacion_dev; ?></div>
            </div>        
            <?php
        }
    } else {
        echo("");
    }
    ?>
</div>



