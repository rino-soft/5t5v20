<?php
$inf = $datos_horaE->row();

?><div class="grid_5 letrachica azulmarino">
    <div class="grid_3"><div class="grid_3"> <span class="negrilla">Solicitante :</span>  <?php echo $inf->nombrecompleto; ?></div> 
    <div class="grid_3"> <span class="negrilla">Proyecto :</span> <?php echo $inf->proyecto; ?> </div> </div>
    <div class="grid_2 fondo_amarillo_claro">
        <div class="grid_2 negrilla letraGrande centrartexto negrocolor">Nro: <?php echo $inf->id_he; ?></div>
        <div class="grid_2 letramuyChica centrartexto">Id registro Hora Extra</div>
    </div>
    <div class=" grid_5 bordeado1">
        <div class="grid_2_5 letraChica fondoplomoclaro negrocolor">

            <div class="grid_1 "> Notificacion: </div> <div class="grid_1_5 "> <?php echo $inf->fhnotificacion; ?> </div>
            <div class="grid_1 "> Viaje: </div> <div class="grid_1_5 esparria"> <?php echo $inf->fhviaje; ?> </div>
            <div class="grid_1 "> Ingreso Sitio: </div> <div class="grid_1_5 "> <?php echo $inf->fhatencion; ?> </div>
            <div class="grid_1 "> Conclusion : </div> <div class="grid_1_5 "> <?php echo $inf->fhconclusion; ?> </div>

        </div>
        <div class="grid_2_5 fondoplomoblanco">
            <div class="grid_2_5 letramuyChica centrartexto">Tiempo de viaje</div>
            <div class="grid_2_5 letragrande negrocolor negrilla centrartexto"><?php echo $inf->cantidad_horas_v_s; ?> Hrs</div>
            <div class="grid_2_5 letramuyChica centrartexto">Tiempo de Trabajo</div>
            <div class="grid_2_5 centrartexto negrilla negrocolor letragrande"><?php echo $inf->cantidad_horas_s_c; ?> Hrs</div>
            <div class="grid_2_5 letramuyChica centrartexto">Tiempo Total</div>
            <div class="grid_2_5 letragrande negrocolor negrilla centrartexto"><?php echo $inf->cantidad_horas_v_c; ?> Hrs</div>


        </div>
    </div>
    
    <div class=" grid_5 bordeado1">
        <div class="grid_2_5 letraChica negrocolor">

            <div class="grid_5 "> Area :  <?php if($inf->area==1) echo "Rural"; else echo "Urbana";?> </div>
            <div class="grid_5 "> Departamento:  <?php 
            //echo $lugar;
            echo $lugar['dep']; ?> </div>
            <?php if($inf->area==1){?>
            <div class="grid_5 "> Provincia: <?php echo $lugar['prov']; ?> </div>
            <?php } ?>
            <div class="grid_5 "> Sitio: <?php echo $inf->sitio; ?> </div>
            

        </div>
        
    </div>
    
    
    <div class="grid_5"> <span class="negrilla">Falla :</span><?php echo $inf->falla; ?> </div> 
    <div class="grid_5"> <span class="negrilla">Intervencion :</span><?php echo $inf->intervencion; ?> </div> 
    <div class="grid_5"> <span class="negrilla">Observacion :</span><?php echo $inf->observaciones; ?> </div> 
    <div class="grid_2"> <span class="negrilla">estado :</span><?php echo $inf->estado; ?> </div> 
</div>