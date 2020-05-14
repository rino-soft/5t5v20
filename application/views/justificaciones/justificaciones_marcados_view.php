<input type="hidden" id="burl" value="<?php echo base_url(); ?>">
<div class="container_12">
<div class="grid_12">
    <div class="grid_10"> <h3>Permisos, vacaciones, Bajas medicas Licencias</h3></div>
    <div class="grid_2 esparriba"><div class="boton centrartexto negrilla" onclick="Dialog_nueva_justificacion();">Nuevo registro</div></div>
</div>
<div class="grid_12 ">
Dias de Vacaciones disponibles <span id="dias_disponibles"></span>
</div>
<div class="grid_12">
    <div class="grid_12 fondoazul negrilla ">
        <div class="grid_05 blanco_text "> Cod</div>
        <div class="grid_1_5 blanco_text "> Tipo </div>
        <div class="grid_1 blanco_text "> Fec Solic.</div>
        <div class="grid_3 blanco_text "> Motivo</div>
       
        <div class="grid_1 blanco_text "> Fec. Ini.</div>
        <div class="grid_1 blanco_text "> Fec. Fin</div>
        <div class="grid_1 blanco_text "> Estado</div>
        <div class="grid_1 blanco_text "> Dias/horas</div>
        
    </div>
</div>

<div class="grid_12" id="div_registro_justificacion"></div>
<div class="clear altofecha"></div>
<script>muestra_justificaciones_realizadas();</script>

<div id="ventana_modal_contenedor_contenidos" class="container_12 oculto">Cargando...</div>
</div>
<!--<div id="imprimirPDF" class="grid_12 oculto" name="imprimirPDF">
    <object width="900" height="800" type="application/pdf" data="\\192.168.1.145\gestion\viewer\doc.pdf"><p>N o PDF available</p></object>
    
    <iframe src="" height="300%" width="100%" type='application/pdf' style="border:none" name="imprimirPDF" id="imprimirPDF"></iframe>
</div>-->
