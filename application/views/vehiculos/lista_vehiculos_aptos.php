
<div class="grid_12">
    <?php
    $i = 0;
    foreach ($aptos as $reg) {
        ?>
        <div class="grid_2 bordeArriba" id="imagen">    
            <img src='<?php echo base_url(); ?>imagenesweb/fotosvehiculos/fotos_vehiculos_sts_320x200/<?php echo $reg->placa; ?>.jpg' 
                 title=' <?php echo $reg->placa; ?>' height='120' >  
            <input type="text"  value="<?php echo $reg->placa; ?>" id="placa<?php echo $i; ?>">
        </div>
        <div class="grid_2 bordeArriba" >
            <div class=" grid_2  letra25 negrilla azulmarino"> <?php echo $reg->placa; ?></div>
            <div class=" grid_2  negrocolor negrilla letragrande"> <?php echo $reg->marca . " , " . $reg->modelo . " , " . $reg->color; ?></div>
            <div class="clear"> </div>
            <div class=" grid_1 rojo negrilla letrachica"> TRACCION : </div> <div class=" grid_1  letrachica azulmarino"> <?php echo $reg->traccion; ?></div>
            <div class=" grid_1 rojo negrilla letrachica "> TIPO : </div> <div class=" grid_1 letrachica azulmarino"> <?php echo $reg->tipo; ?></div>
            <div class=" grid_1 rojo negrilla letrachica"> CAPACIDAD : </div> <div class=" grid_1  letrachica azulmarino"> <?php echo $reg->nro_pasajeros; ?></div>
            <div class=" grid_1 rojo negrilla letrachica "> ESTADO : </div> <div class=" grid_1  letrachica azulmarino"> <?php echo $libertad[$i]; ?></div>
        </div>
        <div class="grid_7 bordeArriba" id="conograma<?php echo $reg->placa; ?>">
            <div class="grid_7">
                <?php
                for ($k = 0; $k < 30; $k++) {
                    $estiloverde = '';
                    if ($estiloFechas[$k] == 1)
                        $estiloverde = 'fondoVerde';
                    ?>

                    <div class="grid_calendario altofecha bordeadoDerecha <?php echo $estiloverde; ?>">
                        <div class="texto90grados negrilla azulmarino to20">
                            <?php
                            echo $Fechas_Calendario[$k];
                            ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div><div class="clear"></div>
            <div class="grid_7">
                <?php
                for ($k = 0; $k < 30; $k++) {
                    $estiloverde = '';
                    if ($estiloFechas[$k] == 1)
                        $estiloverde = 'fondoVerde';
                    $estilo = '';
                    if ($calendario[$i][$k] != 0)
                        $estilo = "fondoRojo blanco_text ";
                    ?>
                    <div class='grid_calendario altofechaDescripcion bordeadoDerecha <?php echo $estilo . " " . $estiloverde; ?>'>
                        <div class='texto90grados to70 '>
        <?php
        if ($calendario[$i][$k] != 0)
            echo "Solicitud.-" . $calendario[$i][$k];
        else
            echo " ";
        ?>
                        </div></div>
                            <?php
                        }
                        ?>
            </div>
        </div>
        <div class="grid_1 bordeArriba ">
    <?php if ($libertad[$i] == 'Libre') { ?>
                <div class="grid_1 alinearDerecha"> <img class="milink" 
                                                         src="<?php echo base_url(); ?>imagenesweb/recursos/asignaVehiculo1.png" 
                                                         title="asignar Vehiculo a solicitud de Uso" height="50"
                                                         onmouseout="this.src='<?php echo base_url(); ?>imagenesweb/recursos/asignaVehiculo1.png' " 
                                                         onmouseover="this.src='<?php echo base_url(); ?>imagenesweb/recursos/asignaVehiculo2.png' "
                                                         onclick="javascript:modalFormularioAsignarSolicitud('<?php echo base_url();?>','<?php echo $i; ?>','<?php echo $indicePadre; ?>',0 );"
                                                         ></div>
        <?php
    } else {
        echo 'Ocupado';
    }
    ?>
            <div class="grid_1 alinearDerecha"> <img class="milink" 
                                                     src="<?php echo base_url(); ?>imagenesweb/recursos/cronograma1.png" 
                                                     title="asignar Vehiculo" height="48"
                                                     onmouseout="this.src='<?php echo base_url(); ?>imagenesweb/recursos/cronograma1.png' " 
                                                     onmouseover="this.src='<?php echo base_url(); ?>imagenesweb/recursos/cronograma2.png' "
                                                    
                                                    ></div>


        </div>
        <div class="clear"> </div>
    <?php
    $i++;
}
?>
</div>