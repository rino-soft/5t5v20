<div class="grid_12 letraMediana fondo_tituloAsigna">
    <?php
    $i = 0;
    foreach ($registro->result() as $fila) {
        echo '<div class="grid_12 filas negrocolor">';
        echo'<div class="grid_05 ">' . $fila->id_jus . '</div>';
        echo'<div class="grid_1_5 negrilla letrachica">' . $fila->tipo . '</div>';
        echo'<div class="grid_1 letrachica">' . $fila->fecha_elaborado . '</div>';

        echo'<div class="grid_3 letrachica"><span class="negrilla azulmarino">' . $fila->titulo_jp . '</span><br>' . $fila->comentario_jp;
        if ($fila->rutaficheroadjunto != "")
            echo '<br> <div class="imagen_archivo"></div><a href="' . base_url() . 'uploads/' . $fila->rutaficheroadjunto . '" class="archivo_adjunto">' . $fila->rutaficheroadjunto . '</a>';
        echo '</div>';
        echo'<div class="grid_1 letrachica">' . $fila->fecha_inicio . '</div>';
        echo'<div class="grid_1 letrachica">' . $fila->fecha_fin . '</div>';
        echo'<div class="grid_1 ">' . $fila->estado . '</div>';
        echo'<div class="grid_05 ">' . $fila->tiempo_d .' d</div>';
        echo'<div class="grid_05 ">' .$fila->tiempo_h .' h</div>';
        echo '<div class="grid_1_5 "><div class="historialboton milink" onclick="Imp_boleta_permiso_vacacion('.$fila->id_jus.')"></div>
                    <div class="impresionboton milink" onclick="Imp_boleta_permiso_vacacion('.$fila->id_jus.')"></div>            
              </div>';
        echo '<div class="clear"></div>';
        echo '</div>';
        //<a href="'.  base_url().'impresiones_pdf/imprimir_boleta_Permiso_vacaciones/'.$fila->id_jus.'" target="imprimirPDF"><div class="impresionboton milink"></div></a>
    }
    ?>
</div>
