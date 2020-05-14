   
<div class="grid_2 alpha">
    <img src="<?php echo base_url(); ?>imagenesweb/recursos/logooksts3.png"  height="100">
</div>

<div class="grid_7 omega alinearDerecha">
    <?php
    if ($user != '')
        echo "<div class='fuentegrandelog'>" . $user . "</div><a href=" . base_url() . "usuario/logout> Salir del Sistema</a>";
    else
        echo "-";
    ?>
</div>
<div class="grid_3 alinearDerecha"><img src="<?php echo base_url(); ?>imagenesweb/recursos/logoRRHH.png"  height="190"></div>

















