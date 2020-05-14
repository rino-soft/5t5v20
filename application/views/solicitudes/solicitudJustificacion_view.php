<div class="grid_12 "> 
    <?php
    $fila = $datos->row();
    $m = $f = "";
    if ($fila->tipo == "justificacion") {
        $m = "<span class='negrilla'>Justificacion de Marcado</span> ";
        $f = " ,del dia <span class='negrilla fondo_verdeclaro'>" . $fila->fecha_inicio . "</span>";
    }
    if ($fila->tipo == "Permiso Vacacion") {
        $m = "<span class='negrilla'>Permiso a cuenta de Vacacion</span> ";
        $f = " ,desde<span class='negrilla fondo_verdeclaro'> " . $fila->fecha_inicio . "</span> hasta <span class='negrilla fondo_verdeclaro'>" . $fila->fecha_fin . "</span>";
    }
    if ($fila->tipo == "Baja Medica") {
        $m = "<span class='negrilla'>Baja Medica</span>s ";
        $f = " ,desde <span class='negrilla fondo_verdeclaro'>" . $fila->fecha_inicio . "</span> hasta <span class='negrilla fondo_verdeclaro'>" . $fila->fecha_fin . "</span>";
    }
    if ($fila->tipo == "Licencia") {
        $m = "<span class='negrilla'>Licencia sin cargo a Vacacion</span> ";
        $f = " ,desde <span class='negrilla fondo_verdeclaro'>" . $fila->fecha_inicio . "</span> hasta <span class='negrilla fondo_verdeclaro'>" . $fila->fecha_fin . "</span>";
    }
    ?>
    <div class="grid_8 prefix_05 suffix_05">
        <div class="grid_8 negrilla fondoRojo blanco_text ">
            <div class="grid_6"><?php echo $m; ?></div><div class="grid_2 alinearDerecha">Codigo:<?php echo $fila->id_jus ?> </div></div>
        <div class="grid_8 fondoblanco bordecolorPlomo">
            <div class="grid_1 ">Solicitante : </div>   <div class=" grid_7 fondoplomoblanco"><span class="negrilla negrocolor"><?php echo $fila->nombre . ' ' . $fila->ap_paterno; ?></span><br>
                <span class="negrilla negrocolor letrachica"><?php echo $fila->cargo . ' ' . $fila->proyecto . '(' . $fila->ciudad . ')'; ?></span> </div></div><div class="clear"></div>
        <div class="grid_8 fondoblanco bordecolorPlomo">
            <div class="grid_1">Periodo : </div><div class="grid_7 negrocolor fondoplomoblanco"><?php echo $f; ?></div></div>
        <div class="grid_8 fondoblanco bordecolorPlomo">
            <div class="grid_1">Motivo : </div><div class="grid_7 negrocolor fondoplomoblanco"><?php echo "<span class='negrilla'>" . strtoupper($fila->titulo_jp) . "</span><br>" . ucfirst($fila->comentario_jp); ?> </div></div>
        <?php
        if ($fila->rutaficheroadjunto != "") {
            ?> 
            <div class="grid_8 fondoblanco">  
                <div class="grid_1">Respaldo:</div>
                <div class="grid_7 fondoplomoblanco"><div class="imagen_archivo"></div><a href="<?php echo base_url() . "uploads/" . $fila->rutaficheroadjunto; ?>" class="archivo_adjunto"><?php echo $fila->rutaficheroadjunto; ?></a></div>
            </div>
        <?php } ?>
        <div class="grid_8 fondoRojo" style="height: 5px"></div>
    </div>
    <div class="grid_2 centrartexto">
        <?php 
        if($fila->estado=="Enviado" or $fila->estado=="Leido"){
        ?>
        <input type="button" id="aceptar" value="ACEPTAR" onclick="aceptar_rechazar_solicitud(<?php echo $fila->id_jus?>,true,<?php echo $indice?>)"/>
        <input type="button" id="rechazar" value="RECHAZAR" onclick="aceptar_rechazar_solicitud(<?php echo $fila->id_jus?>,false,<?php echo $indice?>)" />
        <?php }?>
    </div>
</div>
