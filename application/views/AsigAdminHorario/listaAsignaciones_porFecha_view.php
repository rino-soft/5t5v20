<div class="grid_6">
    <?php
    if ($imprimir != '')
    {
        for ($i = 0; $i < 7; $i++)
        {
            echo '<div class="grid_075 letramuyChica centrartexto">' . $imprimir[$i][0] . '</div>';

            for ($j = 1; $j < count($imprimir[0]); $j++)
            {

                echo '<div class="grid_1 letramuyChica bordeado1 centrartexto">' . $imprimir[$i][$j] . '</div>';
            }
            echo '<div class="clear"></div>';
        }
    }
    else
    {
        echo '<div class="prefix_1 grid_5 letramuyChica">No tiene Horarios Asignados</div>';
    }
    ?>
</div>