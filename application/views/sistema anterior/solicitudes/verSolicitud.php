<?php
//tipo  = 0 solo ver sin opcion a nada
// tipo = 1 puede ver las opciones de buscar vehiculo,editar y rechazar
// tipo = 2 No definido
// tipo = 3 No definido
if($tipo==1){
?>
<div class="grid_2" id="menu de_solicitud">
    <?php if($solicitud->estado!="Asignado"){?>
    <div class="grid_2">
        <img class="milink" 
             src="<?php echo base_url(); ?>imagenesweb/recursos/buscarVehiculo1.png" 
             title="asignar Vehiculo" height="71,5" 
             onclick="javascript:cargaFormAsigVehSolUso('<?php echo base_url(); ?>',<?php echo $ii; ?>,'<?php echo $solicitud->id; ?>',0,1)"
             onmouseout="this.src='<?php echo base_url(); ?>imagenesweb/recursos/buscarVehiculo1.png' " 
             onmouseover="this.src='<?php echo base_url(); ?>imagenesweb/recursos/buscarVehiculo2.png' "
             >
    </div>
    <?php } ?>
    <div class="grid_2"> <img class="milink" 
                              src="<?php echo base_url(); ?>imagenesweb/recursos/PDFsav1.png" 
                              title="asignar Vehiculo" height="65" 
                              onmouseout="this.src='<?php echo base_url(); ?>imagenesweb/recursos/PDFsav1.png' " 
                              onmouseover="this.src='<?php echo base_url(); ?>imagenesweb/recursos/PDFsav2.png' "
                              ></div>
    <?php if($solicitud->estado!="Asignado"){ ?>
    <div class="grid_2"> <img class="milink" 
                              src="<?php echo base_url(); ?>imagenesweb/recursos/editarSav1.png" 
                              title="asignar Vehiculo" height="65"
                              onmouseout="this.src='<?php echo base_url(); ?>imagenesweb/recursos/editarSav1.png' " 
                              onmouseover="this.src='<?php echo base_url(); ?>imagenesweb/recursos/editarSav2.png' "
                              ></div>
    <div class="grid_2"> <img class="milink" 
                              src="<?php echo base_url(); ?>imagenesweb/recursos/reshazarSUV1.png" 
                              title="asignar Vehiculo" height="68,5" 
                              onmouseout="this.src='<?php echo base_url(); ?>imagenesweb/recursos/reshazarSUV1.png' " 
                              onmouseover="this.src='<?php echo base_url(); ?>imagenesweb/recursos/reshazarSUV2.png' "
                              onclick="javascript:modal_formulario_anulacion_de_solicitudUSOvehicular('<?php echo $solicitud->id; ?>')"
                              >
    </div>
    <?php } ?>
    <input type="text" value="<?php echo $solicitud->id; ?>" id="solicitudnro<?php echo $ii; ?>">
</div>
<?php 
}else{
    echo "<div class='grid_2' >.</div>";
   }
?>
<div id="asignar<?php echo $ii; ?>"></div>

<div class="grid_7" style="border:3px #000">
    <div class="grid_3 letra25 negrilla azulmarino "><?php echo "SOLICITUD No " . $solicitud->id; ?> </div>
    <div class="grid_3 letraGrande negrilla alinearDerecha"><?php echo "Estado :" . $solicitud->estado; ?></div>
    <div class="clear"></div>
    <div class="grid_4">


    </div>
    <div class="grid_7">
        <div class="grid_2 negrilla alinearDerecha rojo"> proyecto : </div><div class="grid_1 "> <?php echo $solicitud->Proyecto; ?> </div>
        <div class="grid_2 negrilla alinearDerecha rojo">Regional : </div><div class="grid_1 "> <?php echo $solicitud->Regional; ?> </div>
        <div class="clear"></div>
        <div class="grid_2 rojo alinearDerecha negrilla"> Tipo Trabajo : </div><div class="grid_1 "> <?php echo $solicitud->tipo_trabajo; ?> </div>
        <div class="grid_2 rojo alinearDerecha negrilla"> Fecha de Solicitud : </div><div class="grid_1 "> <?php echo $solicitud->fecha_elaboracion; ?> </div>
        <div class="clear"></div>
        <div class="grid_2 rojo negrilla alinearDerecha"> Desde : </div><div class="grid_1 "> <?php echo $solicitud->fecha_salida; ?> <input type="text" id="desdem<?php echo $ii; ?>" value="<?php echo $solicitud->fecha_salida; ?>"></div>
        <div class="grid_2 rojo negrilla alinearDerecha"> hasta : </div><div class=" grid_1"> <?php echo $solicitud->fecha_retorno; ?><input type="text" id="hastam<?php echo $ii; ?>" value="<?php echo $solicitud->fecha_retorno; ?>"></div>
        <div class="clear"></div>
        <div class="negrilla rojo textMedio grid_6">Destinos</div>
        <div class="clear"></div>
        <?php
        $i = 0;
        foreach ($destinos as $fila) {
            $i++;
            ?>
            <div class="letrachica grid_7" ><?php echo "$i.- " . $fila->Dep . " , " . $fila->prov . ' , ' . $fila->esp . ' ; ' . $fila->act; ?></div>
<?php } ?>
        <div class="negrilla rojo textMedio grid_6">Personal</div>
        <div class="clear"></div>
        <div class="letragrande grid_7 negrilla negrocolor" ><?php echo "1.-  $conductor->nombre_completo (Conductor), Nro Lic :$conductor->nro_licencia , Cat : ' $conductor->categoria ' ,Telf : $conductor->telefono_conductor "; ?></div>

        <?php
        $i = 1;
        foreach ($pasajeros as $fila) {
            $i++;
            ?>
            <div class="letrachica grid_7 negrocolor" ><?php echo "$i.- " . $fila->nombre_completo; ?></div>
<?php } ?>

        <div class="grid_7 fondoplomoclaro " id="VehiculosAsignados<?php echo $ii; ?>">
            <?php
            if ($vehiculos_asignados->num_rows() > 0) {
                ?><div class="grid_7 fondoVerde ">
                    <div class="grid_7 negrilla negrocolor letragrande"> VEHICULOS ASIGNADOS A LA SOLICITUD</div>
                    <?php
                foreach ($vehiculos_asignados->result() as $asig) {
                    ?>
                    
                    <div class="grid_1 negrilla letraGrande"><?php echo $asig->placa_vehiculo; ?></div>
                    <div class="grid_4 negrocolor"><?php echo ' Desde ' . $asig->fecha_inicio . ",  hasta " . $asig->fecha_fin; ?></div><div class="clear"></div>

                    <?php
                }
            } else {
                echo "No se hn encontrado vehiculos asignados a esta solicitud";
            }
            ?>
                </div>
    </div>

</div> 
    </div>

<div class="grid_12 fondoplomoclaro " id="divResultado_Busqeda<?php echo $ii; ?>"></div>
<?php if($tipo==1){?>
<div class="grid_12  ocultar_barraInf centrartexto" id="ocultar<?php echo $ii; ?>">
    <img class="milink" src="<?php echo base_url(); ?>imagenesweb/icono/ariba.png" id="abajo<?php echo $ii; ?>" title="ocultar" onclick="ocultarSolicitudSUV('<?php echo base_url(); ?>',<?php echo $ii; ?>)" height="30" >
</div> <?php }
if($tipo==0)
{
    ?>
        <div class="grid_10  ocultar_barraInf centrartexto" id="ocultar<?php echo $ii; ?>">
    <img class="milink" src="<?php echo base_url(); ?>imagenesweb/icono/ariba.png" id="abajo<?php echo $ii; ?>" title="ocultar" onclick="ocultarSolicitudSUV('<?php echo base_url(); ?>',<?php echo $ii; ?>)" height="30" >
</div>
        <?php
}?>