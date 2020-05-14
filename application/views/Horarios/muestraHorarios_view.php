<script src="<?php echo base_url(); ?>utilidades/jqueryScrollBar/plugins.js"></script>
<script src="<?php echo base_url(); ?>utilidades/jqueryScrollBar/sly.js"></script>
<script src="<?php echo base_url(); ?>utilidades/jqueryScrollBar/horizontal.js"></script>

<?php

foreach ($datosHorarios as $fila)
{
    $him = $fila->hora_ing_ma;
    $mim = $fila->min_ing_ma;
    $hsm = $fila->hora_sal_ma;
    $msm = $fila->min_sal_ma;
    $hit = $fila->hora_ing_ta;
    $mit = $fila->min_ing_ta;
    $hst = $fila->hora_sal_ta;
    $mst = $fila->min_sal_ta;

    if ($hsm == $hit)
    {
        $hsm = $hst;
        $msm = $mst;
        $hst = 0;
        $mst = 0;
    }
    
    ?>
    <div class="grid_8">
<!--        <div class="prefix_05 grid_1" style="padding-top:5px;">
            <?php // echo($fila->NOMBRE); ?>
        </div>-->

        <div class="grid_6 container_scroll">
            <div class="wrap">
                <div style="overflow: hidden;" class="frames <?php if($idSeleccionado!=$fila->PK_HORARIO) echo 'oculto'; if($idSeleccionado==0) echo 'oculto';?>" id="basic_<?php echo $fila->PK_HORARIO; ?>">
                    <ul style="transform: translateZ(0px) translateX(-684px); width: 6840px;" >
                        <?php
                        for ($i = 6; $i <= 21; $i++)
                        {
                            if ($i > $him && $i < $hsm || $i > $hit && $i < $hst)
                            {
                                ?>
                                <li><div class = "tamHora alinearIzquierda enhora"><?php echo $i . ':00'; ?></div></li>
                                <li><div class = "tamHora alinearIzquierda enhora"><?php echo $i . ':30'; ?></div></li>
                                <?php
                            } else if ($i == $him)
                            {
                                if ($mim == 0)
                                {
                                    ?>
                                    <li><div class = "tamHora alinearIzquierda fondo_hora_ini"><?php echo $i . ':00'; ?></div></li>
                                    <li><div class = "tamHora alinearIzquierda enhora"><?php echo $i . ':30'; ?></div></li>
                                    <?php
                                } else
                                {
                                    ?>
                                    <li><div class = "tamHora alinearIzquierda "><?php echo $i . ':00'; ?></div></li>
                                    <li><div class = "tamHora alinearIzquierda fondo_hora_ini"><?php echo $i . ':30'; ?></div></li>
                                    <?php
                                }
                            } else if ($i == $hit)
                            {
                                if ($mit == 0)
                                {
                                    ?>
                                    <li><div class = "tamHora alinearIzquierda fondo_hora_ini"><?php echo $i . ':00'; ?></div></li>
                                    <li><div class = "tamHora alinearIzquierda enhora"><?php echo $i . ':30'; ?></div></li>
                                    <?php
                                } else
                                {
                                    ?>
                                    <li><div class = "tamHora alinearIzquierda "><?php echo $i . ':00'; ?></div></li>
                                    <li><div class = "tamHora alinearIzquierda fondo_hora_ini"><?php echo $i . ':30'; ?></div></li>
                                    <?php
                                }
                            } else if ($i == $hsm)
                            {
                                if ($msm == 0)
                                {
                                    ?>
                                    <li><div class = "tamHora alinearIzquierda fondo_hora_fin"><?php echo $i . ':00'; ?></div></li>
                                    <li><div class = "tamHora alinearIzquierda "><?php echo $i . ':30'; ?></div></li>
                                    <?php
                                } else
                                {
                                    ?>
                                    <li><div class = "tamHora alinearIzquierda enhora"><?php echo $i . ':00'; ?></div></li>
                                    <li><div class = "tamHora alinearIzquierda fondo_hora_fin"><?php echo $i . ':30'; ?></div></li>
                                    <?php
                                }
                            } else if ($i == $hst)
                            {
                                if ($mst == 0)
                                {
                                    ?>
                                    <li><div class = "tamHora alinearIzquierda fondo_hora_fin"><?php echo $i . ':00'; ?></div></li>
                                    <li><div class = "tamHora alinearIzquierda "><?php echo $i . ':30'; ?></div></li>
                                    <?php
                                } else
                                {
                                    ?>
                                    <li><div class = "tamHora alinearIzquierda enhora"><?php echo $i . ':00'; ?></div></li>
                                    <li><div class = "tamHora alinearIzquierda fondo_hora_fin"><?php echo $i . ':30'; ?></div></li>
                                    <?php
                                }
                            } else
                            {
                                ?>
                                <li><div class = "tamHora alinearIzquierda "><?php echo $i . ':00'; ?></div></li>
                                <li><div class = "tamHora alinearIzquierda "><?php echo $i . ':30'; ?></div></li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <script> horarioScroll("<?php echo 'basic_' . $fila->PK_HORARIO; ?>");</script>
<?php } ?>
