



<?php
if($mostrar_datos->num_rows()>0){
foreach ($mostrar_datos->result() as $fila){ ?>
<div class="grid_12 filas negrocolor">
     <div class=" grid_1 centrartexto " title="id de solicitud"><?php echo $fila->id_he;?>  </div>
    <div class="grid_1 centrartexto letramuyChica "  title="fecha y hora de registro"> <?php echo $fila->fh_registro;?>  </div>
    <div class="grid_1  centrartexto"  title="tiempo extra"> <?php //echo $fila->cantidad_horas_v_c;
       
$segundos= strtotime($fila->fhconclusion)-strtotime($fila->fhatencion);
$diferencia_dias=intval($segundos/60);
echo ($diferencia_dias/60)." Hrs";?>   </div>
    <div class="grid_5  alinearIzquierda letramuyChica" title="descripcion Falla e intervencion"> <?php echo '<span class="negrilla rojo">Falla :</span>'.$fila->falla.'<br> <span class="negrilla rojo">Intervencion :</span>'.$fila->intervencion;?> </div>
    <div class="grid_2  centrartexto"  title="Proyecto"> <?php echo $fila->proy;?> </div>
    <div class="grid_1 centrartexto"  title="Estado de la Solicitud"> <?php echo $fila->estado;?> </div>
    <div class="grid_05 letramuyChica">
        <div class="milink link negrilla azulmarino" title="ver solicitud" onclick="Dialog_ver_he(<?php echo $fila->id_he;?>)" >ver</div>  
    </div>
    <div class="clear"></div>
</div>
<?php }}
else
{
    ?>
<div class="grid_12 filas negrocolor">
     <div class=" grid_12 centrartexto NO">Lo sentimos,  No se ha encontrado ningun registro!! </div>

    <div class="clear"></div>
</div>
<?php } ?>

