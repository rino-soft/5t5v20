<?php

if ($resultado->num_rows() > 0) {
    ?> <div id="rs_cli_int">
        <?php 
    foreach ($resultado->result() as $reg) {
        ?>
<div class="borde_abajo milink" 
     onclick="asig_val('id_cliente','<?php echo $reg->id_cliente ?>');
         asig_val('nit','<?php echo $reg->nit ?>');
         asig_val('rs','<?php echo $reg->razon_social ?>'); $('#rs_cli_int').html('');">
         <?php echo $reg->nit.", ".$reg->razon_social ?>
</div>
            
<?php
    }
}
else
{
    echo "Lo sentimos no se encuentró el registro";
}
?>