<div class="grid_12">
    <?php
    if ($sw == 0)
    {
        echo'<div class="grid_1 "> ' . $fecha . '</div>';
        echo'<div class="grid_1 ">' . $diaSemana . '</div>';

        if ($sw_esFeriado == 1)
        {
            echo'<div class="grid_1 centrartexto letrachica estilo_feriado">-</div>';
            echo'<div class="grid_1 centrartexto negrilla estilo_feriado">' . $marcado_inima . '</div>';
            echo'<div class="grid_1 centrartexto letrachica estilo_feriado">-</div>';
            echo'<div class="grid_1 centrartexto negrilla estilo_feriado"> ' . $marcado_finma . '</div>';
            echo'<div class="grid_1 centrartexto letrachica estilo_feriado">-</div>';
            echo'<div class="grid_1 centrartexto negrilla estilo_feriado"> ' . $marcado_inita . '</div>';
            echo'<div class="grid_1 centrartexto letrachica estilo_feriado">-</div>';
            echo'<div class="grid_1 centrartexto negrilla estilo_feriado"> ' . $marcado_finta . '</div>';
            //echo'<div class="grid_1 centrartexto estilo_feriado">-</div>';
            echo'<div class="grid_2 centrartexto letrachica estilo_feriado">' . strtoupper($nombre_feriado) . '</div>';
        }
        else
        {
            echo'<div class="grid_1 centrartexto letrachica color_fechasManiana">' . $hora_inima . '</div>';
            echo'<div class="grid_1 centrartexto negrilla color_fechasManiana">' . $marcado_inima . '</div>';
            echo'<div class="grid_1 centrartexto letrachica color_fechasManiana">' . $hora_finma . '</div>';
            echo'<div class="grid_1 centrartexto negrilla color_fechasManiana"> ' . $marcado_finma . '</div>';
            echo'<div class="grid_1 centrartexto letrachica color_fechasTarde">' . $hora_inita . '</div>';
            echo'<div class="grid_1 centrartexto negrilla color_fechasTarde"> ' . $marcado_inita . '</div>';
            echo'<div class="grid_1 centrartexto letrachica color_fechasTarde">' . $hora_finta . '</div>';
            echo'<div class="grid_1 centrartexto negrilla color_fechasTarde"> ' . $marcado_finta . '</div>';
            echo'<div class="grid_1 centrartexto">' . $retraso_dia . '</div>';
            echo'<div class="grid_1 centrartexto"></div>';
        }
        echo '<div class="clear"></div>';
    }
    else
    {
        echo'<div class="grid_10 alinear_a_la_derecha ">TOTAL RETRASOS MES</div>';
        echo'<div class="grid_1 fondoplomoclaro bordeado1">' . $retraso_mes . '</div>';
    }
    ?>
</div>