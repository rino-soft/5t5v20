<div class="container_12">
<input type="hidden" value="<?php echo base_url(); ?>" id="burl">
<div class="grid_12 prefix_05 esparriba "><h4>Listado de los Registros de Marcado Biometrico</h4></div>
<!-- <input type="button" onclick="javascript:cargarMisSolicitudes();">-->
<div class=" grid_11 prefix_05 suffix_025 espabajo">
    <div class="grid_11 negrilla espabajo">Informacion Personal</div>
    <div class="grid_1"><div class="fotografia"></div></div>
    <div class="grid_5">
        <fieldset>
            <legend>DATOS DEL USUARIO</legend>
            <div class="grid_025" style="height:60px"></div>
            <?php $registro = $datos_modelo_usuario->row(); ?>
            <div class="grid_1 negrilla">Nombre: </div><div class="grid_3"><?php echo $registro->nombre . ' ' . $registro->ap_paterno. ' ' .$registro->ap_materno; ?></div>
            <div class="grid_1 negrilla">C.I.: </div><div class="grid_3"><?php echo $registro->ci . ' ' . $registro->exp; ?></div>
            <div class="grid_1 negrilla">Cargo: </div><div class="grid_3"><?php echo $registro->cargo; ?></div>
            <div class="grid_1 negrilla">Fecha de Inicio: </div><div class="grid_3"><?php echo $registro->fecha_inicio; ?></div>
        </fieldset>
    </div>
    <div class="prefix_1 grid_5 ">
        <?php
        $vector_meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Novimbre', 'Dicimebre');


        $registro = $meses->result();
        echo '<div class="grid_2 listas_meses centrartexto"><SELECT id="lista_mes" onchange="muestra_calendario_marcado()">';
        foreach ($registro as $fila)
        {
            if ($fila->mes == date("m"))
                echo'<option selected="selected" value=' . $fila->mes . '>' . $vector_meses[($fila->mes) - 1];
            else
                echo'<option value=' . $fila->mes . '>' . $vector_meses[($fila->mes) - 1];
        }
        echo '</select></div>';

        $registro = $años->result();
        echo '<div class="grid_2 listas_meses centrartexto"><SELECT id="lista_anio" onchange="muestra_calendario_marcado()">';
        foreach ($registro as $fila)
        {
            if ($fila->año == date("Y"))
                echo'<option selected="selected" value=' . $fila->año . '>' . $fila->año;
            else
                echo'<option value=' . $fila->año . '>' . $fila->año;
        }
        echo '</select></div>';
        ?>
    </div>
</div>
<div class="grid_12" >
    <div class="grid_12 fondoazul blanco_text">
        <div class="grid_1 negrilla centrartexto omega blanco_text fondoazul"> Fecha  </div>
        <div class="grid_1 negrilla centrartexto blanco_text fondoazul"> Dia  </div>
        <div class="grid_1 negrilla centrartexto blanco_text fondoazul"> Hora Ingreso</div>
        <div class="grid_1 negrilla centrartexto blanco_text fondoazul"> Marcado Ingreso</div>
        <div class="grid_1 negrilla centrartexto blanco_text fondoazul"> Hora Salida  </div>
        <div class="grid_1 negrilla centrartexto blanco_text fondoazul"> Marcado Salida  </div>
        <div class="grid_1 negrilla centrartexto blanco_text fondoazul"> Hora Ingreso</div>
        <div class="grid_1 negrilla centrartexto blanco_text fondoazul"> Marcado Ingreso  </div>
        <div class="grid_1 negrilla centrartexto blanco_text fondoazul"> Hora Salida  </div>
        <div class="grid_1 negrilla centrartexto blanco_text fondoazul"> Marcado Salida  </div>
        <div class="grid_1 negrilla centrartexto blanco_text fondoazul"> Minutos Fuera de Horario</div>
        <div class="grid_1 negrilla centrartexto blanco_text fondoazul"> </div>
    </div>
</div>
<div class="grid_12" id="div_registro_marcados">
</div>
<div class="clear altofecha">

</div>
<script>
    muestra_calendario_marcado();
</script>
</div>