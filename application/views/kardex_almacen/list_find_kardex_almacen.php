<div class="" style="width: 95% ">
    <div class="fondo_azul colorBlanco negrilla f12 grid_20" style=" display: block; width: 100%">
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
          // $pagina_actual=$pagina;
           $numPag = ceil($total_registros / $mostrar_X);
            if ($numPag <= 20) {
                for ($pa = 1; $pa <= ceil($total_registros / $mostrar_X); $pa++) {
                    if ($pa != $pagina_actual) {
                        ?>
                        <div class='milink link_blanco' onclick='$("#pagina_registros").val("<?php echo $pa ?>"); search_and_list_prod_kardex("lista_serv_prod");' style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                        <?php
                    } else {
                        ?>
                        <div class="colorAmarillo" style="float: left"> <?php echo $pa . "&nbsp;&nbsp;&nbsp;";   ?> </div>
                        <?php
                    }
                }
            } else {
                switch ($pagina_actual) {
                    case (($pagina_actual >= 1) && ($pagina_actual <= 10)):
                        for ($pa = 1; $pa <= 15; $pa++) {
                            if ($pa != $pagina_actual) {
                                ?>
                                <div class='milink link_blanco' onclick='$("#pagina_registros").val("<?php echo $pa ?>"); search_and_list_prod_kardex("lista_serv_prod");' style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                                <?php
                            } else {
                                ?>
                                <div class="colorAmarillo" style="float: left"> <?php echo $pa . "&nbsp;&nbsp;&nbsp;";   ?> </div>
                                <?php
                            }
                        }
                        ?>
                        <div class='milink link_blanco' style="float: left" > &nbsp;. . .&nbsp;&nbsp; </div>    
                        <?php
                        for ($pa = $numPag - 4; $pa <= $numPag; $pa++) {
                            if ($pa != $pagina_actual) {
                                ?>
                                <div class='milink link_blanco' onclick='$("#pagina_registros").val("<?php echo $pa ?>"); search_and_list_prod_kardex("lista_serv_prod");' style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                                <?php
                            } else {
                                ?>
                                <div class="colorAmarillo" style="float: left"> <?php echo $pa . "&nbsp;&nbsp;&nbsp;";   ?> </div>
                                <?php
                            }
                        }
                        break;

                    case (($pagina_actual >= $numPag - 10) && ($pagina_actual <= $numPag)):
                        //echo "caso pagina actual >=10";
                        for ($pa = 1; $pa <= 5; $pa++) {
                            if ($pa != $pagina_actual) {
                                ?>
                                <div class='milink link_blanco' onclick='$("#pagina_registros").val("<?php echo $pa ?>"); search_and_list_prod_kardex("lista_serv_prod");' style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                                <?php
                            } else {
                                ?>
                                <div class="colorAmarillo" style="float: left"> <?php echo $pa . "&nbsp;&nbsp;&nbsp;";   ?> </div>
                                <?php
                            }
                        }
                        ?>
                        <div class='milink link_blanco' style="float: left" > &nbsp;. . .&nbsp;&nbsp; </div>    
                        <?php
                        for ($pa = $numPag - 15; $pa <= $numPag; $pa++) {
                           if ($pa != $pagina_actual) {
                                ?>
                                <div class='milink link_blanco' onclick='$("#pagina_registros").val("<?php echo $pa ?>"); search_and_list_prod_kardex("lista_serv_prod");' style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                                <?php
                            } else {
                                ?>
                                <div class="colorAmarillo" style="float: left"> <?php echo $pa . "&nbsp;&nbsp;&nbsp;";   ?> </div>
                                <?php
                            }
                        }
                        break;

                    default:
                        for ($pa = 1; $pa <= 5; $pa++) {
                            if ($pa != $pagina_actual) {
                                ?>
                                <div class='milink link_blanco' onclick='$("#pagina_registros").val("<?php echo $pa ?>"); search_and_list_prod_kardex("lista_serv_prod");' style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                                <?php
                            } else {
                                ?>
                                <div class="colorAmarillo" style="float: left"> <?php echo $pa . "&nbsp;&nbsp;&nbsp;";   ?> </div>
                                <?php
                            }
                        }
                        ?>
                        <div class='milink link_blanco' style="float: left" >&nbsp;. . .&nbsp;&nbsp;</div>    
                        <?php
                        for ($pa = $pagina_actual - 4; $pa <= $pagina_actual + 5; $pa++) {
                            if ($pa != $pagina_actual) {
                                ?>
                                <div class='milink link_blanco' onclick='$("#pagina_registros").val("<?php echo $pa ?>"); search_and_list_prod_kardex("lista_serv_prod");' style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                                <?php
                            } else {
                                ?>
                                <div class="colorAmarillo" style="float: left"> <?php echo $pa . "&nbsp;&nbsp;&nbsp;";   ?> </div>
                                <?php
                            }
                        }
                         ?>
                        <div class='milink link_blanco' style="float: left" > &nbsp;. . .&nbsp;&nbsp; </div>    
                        <?php
                        for ($pa = $numPag - 4; $pa <= $numPag; $pa++) {
                           if ($pa != $pagina_actual) {
                                ?>
                                <div class='milink link_blanco' onclick='$("#pagina_registros").val("<?php echo $pa ?>"); search_and_list_prod_kardex("lista_serv_prod");' style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                                <?php
                            } else {
                                ?>
                                <div class="colorAmarillo" style="float: left"> <?php echo $pa . "&nbsp;&nbsp;&nbsp;";   ?> </div>
                                <?php
                            }
                        }
                }
            }?>
            
            

        </div>

    </div>



    <div class="grid_20 fondo_azul colorAmarillo borde_abajo borde_arriba  negrilla f14" style="width: 100%" >
        <div class="f14 alin_cen negrilla tam100" style="width: 5%" ><div style="display: block; ">Id</div></div>
        <div class="f14 alin_cen negrilla tam100  " style="width: 35%"><div style="display: block; ">Codigo/Nombre/descripcion</div></div>
        <div class="f14 negrilla alin_cen tam100" style="width: 7%"><div style="display: block; ">Precio Referencial</div></div>
        <div class="f14 negrilla alin_cen tam100" style="width: 20%"><div style="display: block; ">almacen</div></div>
        <div class="f14 negrilla alin_cen tam100" style="width: 10%"><div style="display: block; ">Stock Actual</div></div>
    </div>



    <!-- aqui se muestra los registros con un foreach -->
    <div class="" style="width: 100%" >
        <?php $indice=1;
        foreach ($registros->result() as $reg) { ?>
            <div class='borde_abajo espaciado5 tam1200 cambiar ' style="margin: 0; width: 100%" >
                <div class="f12 alin_cen tam100"  style="display: block-inline;float: left; width: 5% "><?php echo $indice;$indice++; ?>
                    <div style="display: block; ">
                        <?php if ($reg->id_serv_pro != "") echo $reg->id_serv_pro; else echo "&nbsp;" ?>
                    </div>               
                </div>
                <div class="f12 alin_izq colorAzul tam100 " style=" width: 35% ">
                    <span class="negrilla colorGuindo"><?php if ($reg->cod_serv_prod != "") echo $reg->cod_serv_prod; else echo "&nbsp;" ?> / </span><span class="negrilla"><?php if ($reg->nombre_titulo != "") echo $reg->nombre_titulo; else echo "&nbsp;" ?></span><br>
                    <?php if ($reg->descripcion != "") echo $reg->descripcion; else echo "&nbsp;" ?>
                </div>

                <div class="f12 alin_cen tam100 link_azul" style="width: 7%" >              
                    <div style="display: block; "><?php if ($reg->precio_unitario != "") echo $reg->precio_unitario; else echo "&nbsp;" ?></div>
                </div>

                <?php
                if ($almacen_sel != 0) {
                    echo '<div class=" alin_cen tam500" style="width: 30%" >';
                    echo '<div class="f12 alin_cen tam200" >' . $datos_almacen->row()->nombre . '</div><div class="f12 alin_cen tam100" >' . $saldos[$reg->id_serv_pro] . '</div>
                        <div class="f12 alin_cen tam200" ><div class="link_azul milink milinktext" onclick="ver_kardex_almacen('.$reg->id_serv_pro.','. $almacen_sel.')" >ver kardex</div></div>';
                    echo '</div>'; 
                } else {
                    echo '<div class="f12 alin_cen tam400" style="width: 30%">';
                    if($datos_almacen->num_rows()>0)
                    {
                    foreach ($datos_almacen->result() as $almdat) {
                        $vec = $saldos[$reg->id_serv_pro];

                        echo '<div class="tam500 filas" ><div class="f12 alin_cen tam200" >' . $almdat->nombre . '</div><div class="f12 alin_cen tam100" >' . $vec[$almdat->id_almacen] . '</div>
                            <div class="f12 alin_cen tam200" >
                                <div class="link_azul milink milinktext" onclick="ver_kardex_almacen('.$reg->id_serv_pro.','. $almdat->id_almacen.')" >ver kardex</div>
                            </div></div>';
                    }
                    }else{echo "no tiene almacenes asignados";}
                    echo '</div>';
                }
                ?>

                <div class="tam100 " style="width: 10%">               
                    <div class=""style="display: block;float: right ">
                        <div class="verDocumento " title="detalle Articulo" style="width: 32px" onclick="dialog_detalle_servicio_producto('div_formularios_dialog','<?php echo base_url() . "producto_servicio/ver_serv_prod/$reg->id_serv_pro"; ?>')"><?php echo""; ?> </div>
                    </div> 
                </div>


            </div>


        



<?php } ?>
    </div>
</div>







