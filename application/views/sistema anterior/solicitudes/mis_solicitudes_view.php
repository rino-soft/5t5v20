
<div class="grid_10 suffix_1 prefix_1"><h2>Mis Solicitudes de uso vehicular</h2></div>
<input type="button" onclick="javascript:cargarMisSolicitudes();">
<div class="grid_10 prefix_1 suffix_1" id="BusquedaSolicitud"> 
    <div class="grid_1 negrilla"> Nro </div>
    <div class="grid_1 negrilla"> Proyecto  </div>
    <div class="grid_1 negrilla"> Regional  </div>
    <div class="grid_1 negrilla"> Tipo Trabajo  </div>
    <div class="grid_1 negrilla"> Fecha Solicitud  </div>
    <div class="grid_1 negrilla"> Fecha Salida  </div>
    <div class="grid_1 negrilla"> Fecha Retorno  </div>
    <div class="grid_2 negrilla"> Conductor </div>
    <div class="grid_1 negrilla omega"> Estado  </div>
    <div class="clear"></div>
    <?php
    $i = 0;
    foreach ($mostrarDatos->result() as $Registro) {
        $i++;
        ?>
        <div class="grid_1 ">
            <img class="milink" src="<?php echo base_url();?>imagenesweb/icono/abajo.png" id="abajo<?php echo $i; ?>" title="mostrar" onclick="mostrarSolicitudSUV('<?php echo base_url();?>',<?php echo $i; ?>,'<?php echo $Registro->id; ?>',0)" >
            <img class="milink" src="<?php echo base_url();?>imagenesweb/icono/pdf2.png" id="pdf<?php echo $i; ?>" title="imprimir en PDF" >
            <?php echo $Registro->id; ?></div>
    <div id="contenidotitulo<?php echo $i; ?>"> 
        <div class="grid_1"><?php echo $Registro->Proyecto; ?></div>
        <div class="grid_1"><?php echo $Registro->Regional; ?></div>
        <div class="grid_1"><?php echo $Registro->tipo_trabajo; ?></div>
        <div class="grid_1"><?php echo $Registro->fecha_elaboracion; ?></div>
        <div class="grid_1"><?php echo $Registro->fecha_salida; ?></div>
        <div class="grid_1"><?php echo $Registro->fecha_retorno; ?></div>
        <div class="grid_2"><?php echo $Registro->nombre_completo; ?></div>
        <div class="grid_1"><?php echo $Registro->estado; ?></div>
        <div class="clear"></div></div>
        <div class="grid_10 fondoplomoclaro oculto" id="contenido<?php echo $i;?>"></div>
<?php } ?>
</div>
