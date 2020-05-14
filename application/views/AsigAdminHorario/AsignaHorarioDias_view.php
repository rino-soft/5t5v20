<div class="clear esparriba"></div>        
<div class="prefix_1 grid_7">
    <div class="grid_4"> 
        <span>Esta asignacion de horario es?</span>
        <div class="clear esparriba"></div> 
        <div id="div_radio_duracion">
            <input type="radio" name="radioDuracion" id="radio_fijo" onclick='javascript:duracion_fija();'>Fijo 
            <input id="txt_fecha_fijo_ini" type="hidden" size="10"><br>
            <input type="radio" name="radioDuracion" id="radio_intervalo" onclick='javascript:habilitarFecha();'>Con un rango de tiempo
        </div>
        <div class="clear esparriba"></div> 
        <div class="prefix_05 grid_3 oculto" id="fechaIntervalo">
            <input id="txt_fecha_ini" type="text" size="10"  onchange="mostrar_div_dias(0);"> a <input id="txt_fecha_fin" type="text" size="10" onchange="mostrar_div_dias(1);">
            <script type="text/javascript">
                hoy= new Date ();
                fecha_maniana= new Date(hoy.getFullYear(),hoy.getMonth(),hoy.getDate()+1);
                $(function() { $( "#txt_fecha_ini").datepicker({minDate:fecha_maniana}); });
                $(function() { $( "#txt_fecha_fin").datepicker({minDate:fecha_maniana}); 
            });
            </script>
        </div>
    </div>
</div>
<br>
<?php
$cadenaHorarios = '<select id = "horarios" disabled="disabled">';
$cadenaHorarios .='<option value="0">Ninguno</option>';
foreach ($datosHorarios as $fila)
{
    $cadenaHorarios .='<option value="' . $fila->PK_HORARIO . '">' . $fila->NOMBRE . '</option>';
}
$cadenaHorarios.='</select>';
?>
<div class="prefix_1 grid_4 esparriba" >
    <fieldset class="grid_4" id="dias_select">
        <legend> Seleccionar Horario por Dia</legend>
        <div class="prefix_05 grid_2 esparriba">
            <div class="grid_1">Lunes</div> 
            <div class="grid_1" id="lunes"><?php echo $cadenaHorarios; ?> </div>
        </div>
        <div class="prefix_05 grid_2 esparriba">
            <div class="grid_1">Martes</div>
            <div class="grid_1" id="martes"><?php echo $cadenaHorarios; ?> </div>
        </div>
        <div class="prefix_05 grid_2 esparriba">
            <div class="grid_1">Miercoles</div>
            <div class="grid_1" id="miercoles"><?php echo $cadenaHorarios; ?> </div>
        </div>
        <div class="prefix_05 grid_2 esparriba">
            <div class="grid_1">Jueves </div>
            <div class="grid_1" id="jueves"><?php echo $cadenaHorarios; ?> </div>
        </div>
        <div class="prefix_05 grid_2 esparriba">
            <div class="grid_1">Viernes </div> 
            <div class="grid_1" id="viernes"><?php echo $cadenaHorarios; ?> </div>
        </div>
        <div class="prefix_05 grid_2 esparriba">
            <div class="grid_1">Sabado</div> 
            <div class="grid_1" id="sabado"><?php echo $cadenaHorarios; ?> </div>
        </div>
    </fieldset>
</div>
<div class="clear esparriba"></div> 
<div class=" prefix_05 grid_1"> 
    <input type="button" class="" value="Guardar Datos" onclick="guardarDatosAsigna()" >
</div>
<div class="grid_8 container_12" id="mensajeConflicto"></div>
<div class="container_12" id="mensajeGuardar"></div>
<div class="clear esparriba"></div> 