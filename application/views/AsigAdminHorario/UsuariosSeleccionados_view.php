<?php
$sw = 0;
$ii = 0;
foreach ($datospersonal as $res)
{
    $sw = 1;
    $boton = "<div class='boton_deseleccionar milink' title='¿Quitar?'
                        onclick='de_seleccionar(" . $res->cod_user . ");' ></div>";

    echo '<div class="prefix_025 grid_4" id="selec' . $res->cod_user . '">
            <div class="grid_05 milink ver_AsigHorario" onclick="verAsigHorario(' . $res->cod_user . ')" title="Ver asignaciones de Horario"></div>
            <div class="grid_3">' . ucwords(strtolower($res->nombre . ' ' . $res->ap_paterno)) . ' </div>
            <div class="grid_05 centrartexto "> ' . $boton . '  </div>';
    echo '<div class="prefix_05 grid_6" style="display:none;" id="AsigAdminHorario_' . $res->cod_user . '"></div></div>';
    $ii++;
}
if ($sw == 0)
    echo "<div class='grid_6'>No se han encontrado RESULTADOS</div>";
?>