<?php
$meses = Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
$mes = (int) date("n");
$ano = (int) date("o");
$cod_ano = "<option  value='" . ((int)$ano - 1) . "'>" . ((int)$ano - 1) . "</option> <option value='" . ((int)$ano ) . "' selected='selected'>" . ((int)$ano ). "</option>";

$cod = "";


for ($i = 1; $i <= count($meses); $i++) {
    //echo "<script> alert('".$mes."== ". $i ."');</script>";
    if ((int)$mes == $i ) {
        $cod.= "<option value='$i' selected='selected' >" . $meses[$i-1] . "</option>";
    }
    else
        $cod.= "<option  value='$i'>" . $meses[$i-1] . "</option>";
}
?><div class="container_12">
<input type="hidden" id="burl" value="<?php echo base_url(); ?>">
<div class="grid_12">
    <div class="grid_4"> <h3>Registro de Horas Extras</h3></div>
    <div class="grid_5 esparriba alinearDerecha"> 
        <select id="mes_actual" onchange="cargar_registro_horas_extras();"><?php echo $cod; ?> </select>
        <select id="ano_actual" onchange="cargar_registro_horas_extras();"><?php echo $cod_ano ?> </select>
    </div>
    <div class="grid_3 esparriba alinearDerecha">
        <input type="button" value="Nuevo registro de Hora Extra" onclick="Dialog_nueva_Hora_Extra();"> 
    </div>
</div>

<div class="grid_12 " id="BusquedaSolicitud"> 
    <div class="grid_12 fondoazul blanco_text">

        <div class=" grid_1 centrartexto negrilla omega blanco_text fondoazul"> Id  </div>
        <div class="grid_1 centrartexto negrilla" title="Fecha Registro"> fecha </div>
        <div class="grid_1 negrilla blanco_text fondoazul centrartexto" title="tiempo Extra"> Tiempo  </div>
        <div class="grid_5 negrilla blanco_text fondoazul centrartexto" title="descripcion de falla e intervencion" > Falla/Intervencion </div>
        <div class="grid_2 negrilla blanco_text fondoazul centrartexto" title="Proyecto"> Proyecto </div>
        <div class="grid_1 suffix_1 negrilla blanco_text fondoazul centrartexto" title="Estado"> Estado </div>

    </div>
    <div class="clear"></div>
    <div class="grid_12" id="cotenido_registros"></div>

    
</div>
<div class="grid_12">

        <div class="grid_11 suffix_1 esparriba alinearDerecha"><input type="button" value="Generar Informe Mensual" onclick="Dialog_nueva_Hora_Extra();"></div>
   </div>
<script>cargar_registro_horas_extras();</script>
<div id="ventana_ver" class="container_12 oculto" >cargando...</div>
<div id="ventana_modal_contenedor_contenidos" class="container_12 oculto">cargando...</div>


<div id="confirmacion_tomaraaciones" class="container_12 oculto">
    <div class="atencionimage"></div> <div class="grid_4 centrartexto mensaje">Esta Seguro que desea tomar accion de esta Solicitud que fue enviada a uno de sus Dependientes</div>
</div>
<div id="confirmacion_Aceptar" class="container_12 oculto">
    <div class="atencionimage"></div> <div class="grid_4 centrartexto mensaje">Esta Seguro que desea Aceptar esta Solicitud </div>
</div>
<div id="confirmacion_Rechazar" class="container_12 oculto">
    <div class="atencionimage"></div> <div class="grid_4 centrartexto mensaje">Esta Seguro que desea Rechazar esta Solicitud </div>
</div>
</div>


