<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mostrar_historial_vehiculo_view
 *
 * @author POMA RIVERO
 */

?>


<?php if($ver_registros->num_rows() > 0){?>

<div class="bordeado  container_20" style="display: block;  float: left; width: 100%;">
    <div class="grid_15 f10 negrilla fondo_azul colorBlanco borde_abajo espabajo5 esparriba5" style="width: 100%;" >
        <div class="grid_1 colorBlanco alin_cen" style="display: block-inline; float: left">Codigo</div>
        <div class="grid_2"style="display: block-inline; float: left">Nro. placa</div>
        <div class="grid_3"style="display: block-inline; float: left">Responsable Asignado</div>
        <div class="grid_2"style="display: block-inline; float: left">Departamento</div>
        <div class="grid_2 alin_cen" style="display: block-inline; float: left">Fecha de Asig.</div>
        <div class="grid_2 alin_cen"style="display: block-inline; float: left">Fecha de Dev.</div>
        <div class="grid_3"style="display: block-inline; float: left">Estado vehicular</div>
        <div class="grid_3"style="display: block-inline; float: left">Observaciones de Entr.:</div>
    </div>






    <!-- aqui se muestra los registros con un foreach -->

    <?php foreach ($ver_registros->result() as $reg) { 
        
       // echo "view - ".$reg->id_asig_reponsable."=".$obtener_depar[$reg->id_asig_reponsable]."<br>";
        ?>
        <div  style="width: 100%;" class="f10 espabajo5 esparriba5  borde_abajo  cambio_fondo grid_15 fondo_amarillo" >
            <div class="grid_1 f10 colorGuindo negrilla alin_cen" style="display: block-inline; float: left"><?php if ($reg->id_asig_reponsable != "") echo $reg->id_asig_reponsable; else echo "&nbsp;" ?></div>
            <div class="grid_2 f10 colorcel negrilla"style="display: block-inline; float: left"><?php if ($reg->placa != "") echo $reg->placa; else echo "&nbsp;" ?></div>
            <div class="grid_3 f10"style="display: block-inline; float: left"><?php if ($responsa[$reg->id_asig_reponsable]!= "") echo $responsa[$reg->id_asig_reponsable]; else echo "&nbsp;" ?></div>
            <div class="grid_2 f10"style="display: block-inline; float: left"><?php if($obtener_depar[$reg->id_asig_reponsable]!="") echo $obtener_depar[$reg->id_asig_reponsable]; else echo "&nbsp;"?></div>
            <div class="grid_2 f10 alin_cen"style="display: block-inline; float: left"><?php if ($reg->fecha_hora_asig!= "") echo $reg->fecha_hora_asig; else echo "&nbsp;" ?></div>
            <div class="grid_2 f10 alin_cen fondo_verde_cla"style="display: block-inline; float: left"><?php if ($reg->fecha_hora_devolucion != "") echo $reg->fecha_hora_devolucion; else echo "&nbsp;" ?></div>
            <div class="grid_1 f10"style="display: block-inline; float: left"><?php if ($reg->estado_mecanico != "") echo $reg->estado_mecanico; else echo "&nbsp;" ?></div>
            <div class="grid_1 f10"style="display: block-inline; float: left"><?php if ($reg->estado_carroceria != "") echo $reg->estado_carroceria; else echo "&nbsp;" ?></div>
            <div class="grid_1 f10"style="display: block-inline; float: left"><?php if ($reg->estado_llantas != "") echo $reg->estado_llantas; else echo "&nbsp;" ?></div>
            <div class="grid_3 f10"style="display: block-inline; float: left"><?php if ($reg->observaciones != "") echo $reg->observaciones; else echo "&nbsp;" ?></div>
                
        </div>

    <?php } ?>
    

    
    
    
    
</div>
<?php }

else echo"No existe ningun registro";?>




<?php 





?>