<?php if($cant_registro->num_rows() > 0){?>

<div class="bordeado  container_20" style="display: block;  float: left; width: 100%;">
    <div class="grid_15 f12 negrilla fondo_azul colorAmarillo borde_abajo espabajo5 esparriba5" style="width: 100%;" >
        <div class="grid_2"style="display: block-inline; float: left">Codigo</div>
        <div class="grid_3"style="display: block-inline; float: left">Nombre</div>
        <div class="grid_2"style="display: block-inline; float: left">Tipo</div>
        <div class="grid_3"style="display: block-inline; float: left">Cantidad Agignada</div>
        <div class="grid_3"style="display: block-inline; float: left">Cantidad Devuelta</div>
        <div class="grid_3"style="display: block-inline; float: left">Cantidad Total</div>
    </div>






    <!-- aqui se muestra los registros con un foreach -->

    <?php foreach ($cant_registro->result() as $reg) { ?>
        <div  style="width: 100%;" class="f10 espabajo5 esparriba5  borde_abajo  cambio_fondo grid_15 fondo_amarillo" >
            <div class="grid_2 f10"style="display: block-inline; float: left"><?php if ($reg->cod_serv_prod != "") echo $reg->cod_serv_prod; else echo "&nbsp;" ?></div>
            <div class="grid_3 f10"style="display: block-inline; float: left"><?php if ($reg->nombre_titulo != "") echo $reg->nombre_titulo; else echo "&nbsp;" ?></div>
            <div class="grid_2 f10"style="display: block-inline; float: left"><?php if ($reg->tipo != "") echo $reg->tipo; else echo "&nbsp;" ?></div>
            <div class="grid_3 f10"style="display: block-inline; float: left"><?php if ($reg->cantidad_asignada != "") echo $reg->cantidad_asignada; else echo "&nbsp;" ?></div>
            <div class="grid_3 f10"style="display: block-inline; float: left"><?php if ($reg->cantidad_utilizada != "") echo $reg->cantidad_utilizada; else echo "&nbsp;" ?></div>
            <div class="grid_3 f10"style="display: block-inline; float: left"><?php if ($reg->cantidad_devuelto != "") echo $reg->cantidad_devuelto; else echo "&nbsp;" ?></div>

        </div>

    <?php } ?> 
</div>
<?php }
else echo"No existe ningun registro";?>
