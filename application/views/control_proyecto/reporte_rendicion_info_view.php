

<div class="row tile_count">

    <div class="col-md-1 col-sm-2 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-archive"></i> Cantidad Sitios</span>
        <div class="count"></div>

    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top f16"><i class="fa fa-money"></i> Total Registrado</span>
        <div class="count green"  id="totalregsitio"><?= number_format(0, 2, ",", "."); ?></div>

    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-money"></i> Rendiciones Registradas</span>
        <div class="count aero "><?= number_format(0, 2, ",", "."); ?></div>

    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-money"></i> Utilidad</span>
        <div class="count blue"><?= number_format(0, 2, ",", "."); ?></div>

    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-money"></i> Horas Extra registrados</span>
        <div class="count red">0,00</div>

    </div>
</div>
<div class="x_panel">

    <div id="graficax" class="col-md-4 col-sm-4 col-xs-12">
        <?php
        $this->load->view("char/columnas_agrupadas_stack", $graf1);
        ?>

    </div>
    <div id="grafica2" class="col-md-8 col-sm-8 col-xs-12">
        <?php
        $this->load->view("char/columnas_agrupadas_stack", $graf2);
        ?>

    </div>
</div>


<div class="x_panel">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <table id="datatable" data-order='[[0 , "desc" ]]' class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>

                <tr>
                    <th>Descripcion</th>
                    <?php
                    $gran_suma = Array();
                    for ($f = 0; $f < count($meses_t); $f++) {
                        echo "<th class='alin_cen'>" . $meses_t[$f][0] . "/" . $meses_t[$f][2] . "</th> ";
                        $gran_suma[$f] = 0;
                    }
                    echo "<th class='alin_cen bg-blue-sky negrilla' style='color:black' > TOTAL BS</th> ";
                    ?>




                </tr>
            </thead>
            <tbody class='f14'>


                <?php
                // echo "count <br>" . count($items) . "<br>";

                $form = "";
                for ($i = 0; $i < count($items); $i++) {
                    $item = explode("*", $items[$i]);

                    if ($item[0] != $form) {
                        $form = $item[0];
                        ?>

                        <tr class='' style="background-color: #737373"> <th style='color: white' colspan="<?= count($meses_t) + 2 ?>"><?= "Formulario * " . $item[0] . " *" ?></th></tr>

                    <?php } ?>
                    <tr>
                        <th class='blue ' ><?= $item[1] ?></th>
                        <?php
                        //echo "cantidad de meses tabla".count($meses_t)."<br>";
                        $suma = 0;

                        for ($f = 0; $f < count($meses_t); $f++) {
                            // echo $meses_t[$f].'-';
                            //  echo count($mmes);
                            //echo($mmes[$meses_t[$f]][14]);
                            //echo $datos[$meses_t[$f][0]]."<br>";
                            $suma+=$datos[$meses_t[$f][0]][$i];
                            $gran_suma[$f]+=$datos[$meses_t[$f][0]][$i];
                            $estilo = "bg-warning";
                            if ($datos[$meses_t[$f][0]][$i] != 0)
                                $estilo = " bg-success negrilla green";
                            echo '<td class="alin_der ' . $estilo . '" >' . number_format($datos[$meses_t[$f][0]][$i], 2, ",", "") . '</td>';
                        }
                        $estilo = "";
                        if ($suma != 0)
                            $estilo = " bg-blue-sky negrilla ";
                        echo '<td class="alin_der ' . $estilo . '" style="color:black" >' . number_format($suma, 2, ",", "") . '</td>';
                        ?>


                    </tr>

                <?php } ?>
                <tr class='f16'>
                    <th class='alin_der negrilla '>TOTAL .- </th>
                    <?php
                    $super_gran_suma = 0;
                    for ($k = 0; $k < count($gran_suma); $k++) {
                        $super_gran_suma+=$gran_suma[$k];
                        ?>
                        <th class='alin_der negrilla '><?= number_format($gran_suma[$k], 2, ",", "") ?></th>
                        <?php
                    }
                    ?>
                    <th class='alin_der negrilla '><?= number_format($super_gran_suma, 2, ",", "") ?></th>   
                </tr>
            </tbody>
        </table>

    </div>
</div>

<div class="row formulario_nuevo_menu" id="formulario_rendicion"></div>



<div id="lista_rendiciones"class="f10 row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <spam class='f20 negrilla'>Lista de Rendiciones registradas al sitio </spam> 
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <table id="datatable" data-order='[[0 , "desc" ]]' class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>

                        <tr>
                            <th>ID</th>
                            <th>-</th>
                            <th>proy</th>
                            <th>usuario</th>
                            <th>Fecha Registro</th>
                            <th>tipo_rend</th>
                            <th>Monto</th>
                            <th>estado</th>
                            <th>observaciones</th>

                        </tr>
                    </thead>


                    <tbody class ="f12">
                        <?php
                        $suma_registros = 0;
                        foreach ($registros_rend->result() as $reg) {
                            ?>

                            <tr>
                                <td><?php echo $reg->idreg_ren; ?></td>
                                <td> <a class='btn btn-warning btn-xs' onclick="mostrar_fomrulario_nueva_rendicion_terceros('<?= $reg->idreg_ren ?>')">editar</a><br>
                                <td><?php echo $reg->nombreproy; ?></td>
                                <td><?php echo $reg->nomcompleto; ?></td>
                                <td><?php echo $reg->fh_registro; ?></td>
                                <td><?php echo $reg->tipo_rend; ?></td>
                                <td class='f16 negrilla alin_der'><?php echo number_format($reg->monto, 2, ",", "."); ?></td>

                                <td><?php echo $reg->estado ?></td>
                                <td><?php echo $reg->observacion; ?></td>

                            </tr>

                            <?php
                            $suma_registros+=$reg->monto;
                        }
                        ?>

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>


<!-- jQuery -->
<script src="<?php echo base_url(); ?>/vendors/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>utilidades/modForm/jquery-ui.js"></script>





<script type="text/javascript" src="<?php echo base_url(); ?>JS/control_proyecto.js"></script>


<script>cargar_proy_interno();</script>
<!--<script>alert ('estara graficando'); grafica_stack('graficax');</script>-->









