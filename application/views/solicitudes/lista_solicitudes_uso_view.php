
<div class="grid_12  "><h2>Solicitudes de uso vehicular </h2></div>
<!-- <input type="button" onclick="javascript:cargarMisSolicitudes();">-->
<div class="grid_12 " id="BusquedaSolicitud"> 
    <div class="grid_12 fondoazul blanco_text">
    <div class="prefix_1 grid_1 negrilla centrartexto"> Nro </div>
    <div class="grid_1 negrilla centrartexto omega blanco_text fondoazul"> Estado  </div>
    <div class="grid_1 negrilla centrartexto blanco_text fondoazul"> Proyecto  </div>
    <div class="grid_1 negrilla centrartexto blanco_text fondoazul"> Regional  </div>
    <div class="grid_1 negrilla centrartexto blanco_text fondoazul"> Tipo Trabajo  </div>
    <div class="grid_1 negrilla centrartexto blanco_text fondoazul"> Fecha Solicitud  </div>
    <div class="grid_1 negrilla centrartexto blanco_text fondoazul"> Fecha Salida  </div>
    <div class="grid_1 negrilla centrartexto blanco_text fondoazul"> Fecha Retorno  </div>
    <div class="grid_2 negrilla centrartexto blanco_text fondoazul"> Conductor </div>
    </div>
    <div class="clear"></div>
    <?php
    $i = 0;
    foreach ($mostrarDatos->result() as $Registro) {
        $i++;
        ?>
        <div class="grid_1 centrartexto bordeArriba">
            <img class="milink" src="<?php echo base_url(); ?>imagenesweb/icono/abajo.png" id="abajo<?php echo $i; ?>" title="mostrar" onclick="mostrarSolicitudSUV('<?php echo base_url(); ?>',<?php echo $i; ?>,'<?php echo $Registro->id; ?>',0,1)" >
            
       <!--     <img class="milink" src="<?php //echo base_url(); ?>imagenesweb/icono/pdf2.png" id="pdf<?php //echo $i; ?>" title="imprimir en PDF" > -->
            </div><div class="grid_1 negrilla letraGrande negrocolor bordeArriba"><?php echo $Registro->id; ?></div>
        <div id="contenidotitulo<?php echo $i; ?>" class="bordeArriba grid_10">    
            <div class="grid_1 centrartexto negrocolor <?php if($Registro->estado == "Parcialmente Asignado")echo "parcial";else echo strtolower($Registro->estado); ?>"><?php echo $Registro->estado; ?></div>
            <div class="grid_1"><?php echo $Registro->Proyecto; ?></div>
            <div class="grid_1"><?php echo $Registro->Regional; ?></div>
            <div class="grid_1"><?php echo $Registro->tipo_trabajo; ?></div>
            <div class="grid_1"><?php echo $Registro->fecha_elaboracion; ?></div>
            <div class="grid_1"><?php echo $Registro->fecha_salida; ?></div>
            <div class="grid_1"><?php echo $Registro->fecha_retorno; ?></div>
            <div class="grid_3"><?php echo $Registro->nombre_completo; ?></div>
        </div>
        <div class="grid_12 fondoplomoclaro oculto" id="contenido<?php echo $i; ?>"></div>
        
       <div class="clear"></div>

    <?php } ?>
</div>

