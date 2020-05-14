

<!-- aqui se muestra los registros con un foreach -->

<?php foreach ($cant_registro->result() as $reg) { ?>

    <div class='fondo_azul colorBlanco colorAmarillo f12 alin_cen negrilla'>
        <div class="f14" style="display: block-inline;width: 100px;float: left ">
            <div style="display: block; "><?php echo "Id : " . $reg->id_serv_pro; ?></div>               
        </div>
        <br>
        <br>
    </div>    

    <div class="f12 grid_8"style="display: block-inline;float: left; height: 45px">
        <div class="negrilla  colorAzul">Codigo:</div>  
        <div style="display: block; "><?php echo $reg->cod_serv_prod; ?></div>
    </div>
    <div class="f12 grid_8"style="display: block-inline; float: left;height: 45px">
        <div class="negrilla  colorAzul">Nombre:</div>  
        <div style="display: block; "><?php echo $reg->nombre_titulo; ?></div>
    </div>

    <div class="f12 grid_8" style="display: block-inline;float: left;height: 45px">
        <div class="negrilla colorAzul ">Precio:</div>               
        <div style="display: block; "><?php echo $reg->precio_unitario; ?></div>               
    </div>

    
    <div class="f12 grid_8" style="display: block-inline;  float: left;height: 45px">
        <div class="negrilla colorAzul ">Unidad de Medida:</div>               
        <div style="display: block; "><?php echo $reg->unidad_medida; ?></div>               
    </div>
    <div class="f12 grid_8" style="display: block-inline;float: left;height: 45px">
        <div  class="negrilla colorAzul ">Tipo:</div>               
        <div style="display: block; "><?php echo $reg->tipo; ?></div>               
    </div>
<div class="f12 grid_8 " style="display: block-inline; float: left;height: 45px">
        <div class="negrilla  colorAzul">Palabras Clave:</div>               
        <div style="display: block; "><?php echo $reg->palabras_clave; ?></div>               
    </div>
    <div class="f12 grid_8" style="display: block-inline;float: left; height: 45px">
        <div class="negrilla  colorAzul">Descripción:</div>               
        <div style="display: block; "><?php echo $reg->descripcion; ?></div>
    </div>




<?php } ?>


