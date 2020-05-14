<div class="grid_6 <?php echo $respuesta; ?>" >
    <div class="grid_6">
        <div class="grid_6 letra35 negrilla centrartexto">ATENCION</div>
        <div class="grid_6"><?php echo $mensaje; ?><br></div>
        <div class="clear"></div>
        <?php
        if ($sw == 1)
        {
            for ($c = 0; $c < count($vector_ids); $c++)
            {
                ?>
                <div class=" prefix_05 grid_4"><?php echo ($c + 1) . '.-' . $vector_ids[$c]; ?></div>
                <?php
            }
            ?>
            <div class="grid_6">
                <div class="grid_5"><?php echo 'los siguientes horarios: '; ?></div>

                <div class="prefix_05 grid_1 negrilla" style="float: left">
                    <div class="grid_1 letramuyChica ">HORA\DIA</div>
                    <div class="grid_1 letramuyChica "><br></div>
                    <div class="grid_1 letramuyChica ">HoraIniMañana</div>
                    <div class="grid_1 letramuyChica ">HoraFinMañana</div>
                    <div class="grid_1 letramuyChica ">HoraIniTarde</div>
                    <div class="grid_1 letramuyChica ">HoraFinTarde</div>
                </div>
                <?php
                for ($dia = 0; $dia < count($vector_dias); $dia++)
                {
                    ?>
                    <div class="grid_075 centrartexto" style="float: left">
                        <div class="grid_075 letramuyChica negrilla"><?php echo $vector_dias[$dia][0]; ?></div>
                        <div class="grid_075 letramuyChica negrilla"><?php if ($vector_dias2[$dia][1] != 0) echo '(' . $vector_dias[$dia][1]->NOMBRE . ')'; ?></div>
                        <div class="grid_075 letrachica">
                            <?php
                            if ($vector_dias2[$dia][1] != 0)
                            {
                                if ($vector_dias[$dia][1]->Hora_ingreso_ma != '00:00:00')
                                    echo $vector_dias[$dia][1]->Hora_ingreso_ma;else
                                    echo '-';
                            }
                            ?></div>
                        <div class="grid_075 letrachica"><?php
                    if ($vector_dias2[$dia][1] != 0)
                    {
                        if ($vector_dias[$dia][1]->hora_salida_ma != '00:00:00')
                            echo $vector_dias[$dia][1]->hora_salida_ma;else
                            echo '-';
                    }
                            ?></div>
                        <div class="grid_075 letrachica"><?php
                    if ($vector_dias2[$dia][1] != 0)
                    {
                        if ($vector_dias[$dia][1]->hora_ingreso_ta != '00:00:00')
                            echo $vector_dias[$dia][1]->hora_ingreso_ta; else
                            echo '-';
                    }
                            ?></div>
                        <div class="grid_075 letrachica"><?php
                    if ($vector_dias2[$dia][1] != 0)
                    {
                        if ($vector_dias[$dia][1]->hora_salida_ta != '00:00:00')
                            echo $vector_dias[$dia][1]->hora_salida_ta;else
                            echo '-';
                    }
                            ?></div>
                    </div>
                    <?php
                }
                ?>
            </div>
            <?php
            if ($fecha_ini == '' && $fecha_fin == '')
                echo '<div class="grid_5">de forma permanente.</div>';
            else
                echo '<div class="grid_5">desde el"  ' . $fecha_ini . ' " al " ' . $fecha_fin . '; </div>';
        }
        ?>
    </div>
    <div class="grid_6 letra50"><?php echo $respuesta; ?></div>
</div>