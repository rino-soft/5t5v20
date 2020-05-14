<!--inicio plugin scrollbar jquery-->
<div class="container_12">
<script src="<?php echo base_url(); ?>utilidades/jqueryScrollBar/plugins.js"></script>
<script src="<?php echo base_url(); ?>utilidades/jqueryScrollBar/sly.js"></script>
<script src="<?php echo base_url(); ?>utilidades/jqueryScrollBar/horizontal.js"></script>
<!--Fin plugin scrollbar jquery-->

<div>CONFIGURACION DE HORARIOS</div>
<DIV >HORARIOS</DIV>
<input type="hidden" value="<?php echo base_url(); ?>" id="burl">
<?php
$cadena_enlace = '';
$cadena_contenidos = '';
$registro = $tiposHorarios->result();
foreach ($registro as $fila)
{
    $cadena_enlace.='<div id="enlace_' . $fila->PK_HORARIO . '" class="grid_2 milink asparriba" 
            onclick="mostrar_datosHorario(' . $fila->PK_HORARIO . ')">
                <div class="horario_edita" onclick="javascript:editarHorarios(' . $fila->PK_HORARIO . ')" ></div>' . $fila->NOMBRE . '</div>';
    $cadena_contenidos.='
            <div class="grid_6 visible" id="datosHorario_' . $fila->PK_HORARIO . '">
                <fieldset>
                <legend>Datos Horario ' . $fila->NOMBRE . '</legend>
                    <div class="grid_5 texto_gris">' . $fila->COMENTARIO . '</div>
                    <div class="grid_2">Hora Ingreso Mañana</div><div class="grid_2">' . $fila->Hora_ingreso_ma . '</div>
                    <div class="grid_2">Hora Salida Mañana</div><div class="grid_2">' . $fila->hora_salida_ma . '</div>
                    <div class="grid_2">Hora Ingreso Tarde</div><div class="grid_2">' . $fila->hora_ingreso_ta . '</div>
                    <div class="grid_2">Hora Salida Tarde</div><div class="grid_2">' . $fila->hora_salida_ta . '</div>
                    <div class="grid_2">Tolerancia</div><div class="grid_2">' . $fila->TOLERANCIA . '</div>
                </fielset>
            </div>                
        ';
}
?>
<div class="prefix_1 grid_11">
    <div class="grid_2" ><?php echo $cadena_enlace; ?>
        <div class="grid_2 milink asparriba" onclick="javascript:editarHorarios(0)" >
            <div class="horario_nuevo"></div>Nuevo Horario
        </div>
    </div>

    <div class="grid_8 " id="div_horario"></div>
    <script> muestraDivHorarios()</script>

    <div class="grid_6 visible" id="con"></div>
    <div class="grid_5 oculto"><?php echo $cadena_contenidos; ?> </div>
    <div class="grid_8 sufix_1" id="div_edicion_horarios"></div>
</div>
</div>




