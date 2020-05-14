<div class="grid_6">
    <div class="grid_6">Los Vales que se le asignara son :</div>
    <div class="clear"></div>
    <?php if ($cantV100 > 0) { ?>
        <div class="grid_6 <?php echo $mensaje100; ?>">    <div class="grid_1">100 Bs</div><div class="grid_4 negrilla letraGrande">
                <?php
                foreach ($vale100->result() as $va100) {
                    echo $va100->reg . ' ,';
                }
                ?></div><div class="grid_1"><?php echo $total100 ." (". $mensaje100.")"; ?></div>
        </div><?php } ?>
    <div class="clear"></div>
    <?php if ($cantV50 > 0) {?>
    <div class="grid_6 <?php echo $mensaje50; ?>"> <div class="grid_1">50 Bs</div><div class="grid_4 negrilla letraGrande">  
<?php

    foreach ($vale50->result() as $va50) {
        echo $va50->reg . ' ,';
    }


?></div><div class="grid_1"><?php echo $total50. "  (". $mensaje50.")"; ?></div></div><?php } ?>

    <div class="grid_5 negrilla alinearDerecha bordeArriba">Monto Total:</div><div class="negrilla grid_1 bordeArriba"><?php echo $total; ?></div>
    <div class="grid_2 alinearDerecha">Proyecto :</div><div class="grid_4"><?php echo $Proyecto; ?></div>
    <div class="grid_2 alinearDerecha">Solicitado por :</div><div class="grid_4"><?php echo $solicitante; ?></div>
    <div class="grid_2 alinearDerecha">Vehiculo:</div><div class="grid_4"><?php echo $vehiculo; ?></div>
    <div class="grid_2 alinearDerecha">Motivo :</div><div class="grid_4"><?php echo $comentario; ?></div>
    <div class="grid_6 negrilla letra25 centrartexto"> Compare la asignacion con los vales reales !! </div>
   
</div>