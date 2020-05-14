<?php
if ($mostrar_datos->num_rows() > 0) {
    foreach ($mostrar_datos->result() as $fila) {
        ?>
<div class="grid_6 filas_ss">
        <div class="grid_5_5 suffix_025 prefix_025  negrocolor esparriba">
            <div class="grid_2_5 prefix_025">
                <div class=" grid_2_5 letraGrande negrilla" title="id de solicitud"><?php echo $fila->id_he; ?>  </div>
                <div class=" grid_2_5 " title="solicitante">Solicitante :<?php echo $fila->apellidos . ", " . $fila->nombre; ?>  </div>
                <div class=" grid_2_5"  title="Proyecto"> Proyecto:<?php echo $fila->proy; ?> </div>
                <div class="grid_2_5 letramuyChica "  title="fecha y hora de registro"> Registrado : <?php echo $fila->fh_registro; ?>  </div>

            </div>
            <div class="grid_2_5 suffix_025">

                <div class="grid_2_5  centrartexto"  title="tiempo extra"> Tiempo de Viaje <?php echo $fila->cantidad_horas_v_s; ?> hrs</div>    
                <div class="grid_2_5  centrartexto letramuyChica negrilla"  title="tiempo extra">
                    <?php echo "<span class='rojoText'>" . $fila->fhviaje . "</span>-<span class='azulmarino'>" . $fila->fhatencion . "</span>"; ?> </div>
                <div class="grid_2_5  centrartexto"  title="tiempo extra"> Tiempo de trabajo <?php echo $fila->cantidad_horas_s_c; ?> hrs</div>    
                <div class="grid_2_5  centrartexto letramuyChica negrilla"  title="tiempo extra">
                    <?php echo "<span class='rojoText'>" . $fila->fhatencion . "</span>-<span class='azulmarino'>" . $fila->fhconclusion . "</span>"; ?> </div>
                <div class="grid_2_5  centrartexto"  title="tiempo extra"> Tiempo de Total <?php echo $fila->cantidad_horas_v_c; ?> hrs</div>    
                <div class="grid_2_5  centrartexto letramuyChica negrilla"  title="tiempo extra">
                    <?php echo "<span class='rojoText'>" . $fila->fhviaje . "</span>-<span class='azulmarino'>" . $fila->fhconclusion . "</span>"; ?> </div>
            </div>
            <div class="grid_5 suffix_025 prefix_025">
                <div class="grid_5  alinearIzquierda letramuyChica" title="descripcion Falla e intervencion"> <?php
            echo '<span class="negrilla rojoText">Falla :</span>' . substr($fila->falla, 0, 50) .
            '...<br> <span class="negrilla rojoText">Intervencion :</span>' . substr($fila->intervencion, 0, 50.) .
            '...<br> <span class="negrilla rojoText">Observacion :</span>' . substr($fila->observaciones, 0, 50) . '...';
                    ?> </div>
            </div>
            

        </div>
    <div class="grid_6 <?php echo $fila->estado;?>">
                <div class="grid_1_5 prefix_05"  title="Estado de la Solicitud"> Estado: <?php echo $fila->estado; ?> </div>
                <div class="grid_4 letraChica">
                    <div class="milink link negrilla azulmarino espizquierda espderecha" style="float: right" title="ver solicitud" 
                         
                             <?php if($fila->estado=="solicitado")
                                {?>
                                    onclick="Dialog_ver_he_controles(<?php echo $fila->id_he; ?>)"
                                        <?php }
                                        else{
                                            ?> onclick="Dialog_ver_he( <?php echo $fila->id_he; ?>)"
                                      <?php }?> >ver</div>
                    <?php if($fila->estado=="solicitado"){?>
                    <div class="milink link negrilla azulmarino espizquierda" style="float: right" title="Aceptar solicitud" onclick="cambiar_estado_he(true,<?php echo $fila->id_he; ?>)" >Aceptar</div>
                    <div class="milink link negrilla azulmarino espizquierda" style="float: right" title="Rechazar solicitud" onclick="cambiar_estado_he(false,<?php echo $fila->id_he; ?>)" >Rechazar</div>
                    <div class="milink link negrilla azulmarino espizquierda "  style="float: right" title="Editar solicitud" onclick="editar_he_dialog(<?php echo $fila->id_he; ?>);" >Editar</div>
                     <?php } ?>   
                </div>


            </div>
    </div>

        <?php
    }
} else {
    ?>
    <div class="grid_12 filas negrocolor">
        <div class=" grid_12 centrartexto NO">Lo sentimos,  No se ha encontrado ningun registro!! </div>

        <div class="clear"></div>
    </div>
<?php } ?>