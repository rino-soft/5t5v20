
<div class="fondo_azul colorBlanco negrilla f12" style="width: 100%; display: block; padding: 5px; ">
    <div style="display: inline-block">

        <?php
        if ($total_registros > 0)
            echo $total_registros . " registros cargados exitosamente.";
        else
            echo $total_registros . " registros cargados !  No se han encontrado Registros en la Base de Datos.";
        ?>
    </div>
    <div id="paginacion" style="float: right; padding-right: 25px">
        <?php
        for ($pa = 1; $pa <= ceil($total_registros / $mostrar_X); $pa++) {
            if ($pa != $pagina_actual) {
                ?>
                <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa; ?>); list_personal('area_cargo_selecctivo');" style="float: left" > <?php echo $pa . " ,"; ?> </div>
                <?php
            } else {
                ?>
                <div class="colorAmarillo" style="float: left"> <?php echo $pa . " ,"; ?> </div>
                <?php
            }
        }
        ?>
    </div>
</div>

<div style="width: 1000px; background: red; display: inline-block;">
    <div style="width:200px; float: left;">nombre</div>
    <div style="width:150px; float: left;">proyecto</div>
    <div style="width:650px; float: left;">Fechas</div>

</div>



<?php
if ($total_registros != 0) {
    ?>
    <div style="display: block; padding: 0px;">
        <?php
        foreach ($registros as $usuario) {
            //echo $usuario->cod_user . "--" . $usuario->nombre . " " . $usuario->ap_paterno . " " . $usuario->ap_materno . " " . $usuario->ci . "<br>" . $apropi[$usuario->cod_user]
            ?>

            <div style="" class="espabajo10">
                <div style="width: 1260px; background: silver; display: inline-block;" class="espabajo10">
                    <div style="width:300px; float: left;display: inline-block;"><?php echo $usuario->nombre . " " . $usuario->ap_paterno . " " . $usuario->ap_materno . "<br>" . $usuario->ci . "<br>"; ?></div>
                    <div style="width: 902px; float: left; display: inline-block">
                        <?php
                        if ($proy[$usuario->cod_user]->num_rows() > 0) {
                            $inf_apro_user = $apropi[$usuario->cod_user];
                            
                            foreach ($proy[$usuario->cod_user]->result()as $proyecto) {
                                $numero = cal_days_in_month(CAL_GREGORIAN, date('m'), date("Y"));
                               // echo "cantidad dias ____ ". "-" . $inf_apro_user[$proyecto->id_proy][0] . "-" . $inf_apro_user[$proyecto->id_proy][1]."--".$inf_apro_user[$proyecto->id_proy][2] ;
                                if ($inf_apro_user[$proyecto->id_proy][2] > 0) {
                                    ?>
                                    <div style="width:902px; float: left; display: inline-block;" class="f12 negrilla centrartexto bordeAbajo">
                                        <div style="width: 250px;float: left;" class="alin_izq"><?php echo substr($proyecto->nombre, 0, 33); ?></div>
                                        <?php  $estilo="";
                                        for ($i = 1; $i <= $numero; $i++) {
                                            $fechai=date('Y-m-'.$i);
                                            if ($i < 10) 
                                                $fechai=date('Y-m-0'.$i);
                                           // echo $fechai."-----".$inf_apro_user[$proyecto->id_proy][0]."<br>";
                                           
                                            if($fechai>=$inf_apro_user[$proyecto->id_proy][0])
                                            {
                                                $estilo=' color:red; ';
                                             //   echo "si";
                                            }
                                            else
                                                   echo "";
                                            if($fechai>$inf_apro_user[$proyecto->id_proy][1])
                                            {
                                                $estilo=' color:black; ';
                                               // echo "si2";
                                            }
                                            else
                                                echo "";
                                            ?>
                                            <div style="width:20px; float: left;<?php echo $estilo; ?>" >
                                          <?php if ($i < 10) echo 0;
                                             echo $i; ?></div>
                                    <?php } ?>
                                    </div>
                                <?php
                                }
                            }
                        }
                        else
                        { echo "el personal no ha sido apropiado en ningun proyecto..!";}
                        ?>
                        <div style="width: 802px; float: left; display: inline-block">
        <?php //echo 1; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>

    </div>

    <?php
} else
    echo '';
?>

<div id="div_formularios_dialog" class="formulario_nuevo_menu ocultar" style="height: 300px; width: 400px;">cargando...</div>
