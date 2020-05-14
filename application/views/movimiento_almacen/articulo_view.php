<?php
$id_ma = "";

if ($idma != 0) {
    $id_ma = $consulta_ma->id_mov_alm;
}
?>


<div style="display: block ; float: left;" class="grid_20 fondo_azul colorBlanco negrilla f12 ">
    <?php
    if ($no_reg > 0)
        echo $no_reg . " registros cargados exitosamente.";
    else
        echo $no_reg . " registros cargados !  No se han encontrado Registros en la Base de Datos.";
    ?>

    <div style="float:right">
        <?php
////////para la Paginacion //////////////////////////////////////////////////////////////
//////// OOOOOOOOOJJJJJJJJOOOOOOOOO  //////////////////////////////////////////////

        $numPag = ceil($no_reg / $mostrar);
        $pagina_actual = $pagina;
        if ($numPag <= 20) {
            for ($pa = 1; $pa <= ceil($no_reg / $mostrar); $pa++) {
                if ($pa != $pagina_actual) {
                    ?>
                    <div class='milink link_blanco' onclick="cambiarpagina_art(<?php echo $pa; ?>);" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                    <?php
                } else {
                    ?>
                    <div class="colorAmarillo" style="float: left"> <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                    <?php
                }
            }
        } else {
            switch ($pagina_actual) {
                case (($pagina_actual >= 1) && ($pagina_actual <= 10)):
                    for ($pa = 1; $pa <= 15; $pa++) {
                        if ($pa != $pagina_actual) {
                            ?>
                            <div class='milink link_blanco' onclick="cambiarpagina_art(<?php echo $pa; ?>);" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                            <?php
                        } else {
                            ?>
                            <div class="colorAmarillo" style="float: left"> <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                            <?php
                        }
                    }
                    ?>
                    <div class='milink link_blanco' style="float: left" > &nbsp;. . .&nbsp;&nbsp; </div>    
                    <?php
                    for ($pa = $numPag - 4; $pa <= $numPag; $pa++) {
                        if ($pa != $pagina_actual) {
                            ?>
                            <div class='milink link_blanco' onclick="cambiarpagina_art(<?php echo $pa; ?>);" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                            <?php
                        } else {
                            ?>
                            <div class="colorAmarillo" style="float: left"> <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                            <?php
                        }
                    }
                    break;

                case (($pagina_actual >= $numPag - 10) && ($pagina_actual <= $numPag)):
                    //echo "caso pagina actual >=10";
                    for ($pa = 1; $pa <= 5; $pa++) {
                        if ($pa != $pagina_actual) {
                            ?>
                            <div class='milink link_blanco' onclick="cambiarpagina_art(<?php echo $pa; ?>);" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                            <?php
                        } else {
                            ?>
                            <div class="colorAmarillo" style="float: left"> <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                            <?php
                        }
                    }
                    ?>
                    <div class='milink link_blanco' style="float: left" > &nbsp;. . .&nbsp;&nbsp; </div>    
                    <?php
                    for ($pa = $numPag - 15; $pa <= $numPag; $pa++) {
                        if ($pa != $pagina_actual) {
                            ?>
                            <div class='milink link_blanco' onclick="cambiarpagina_art(<?php echo $pa; ?>);" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                            <?php
                        } else {
                            ?>
                            <div class="colorAmarillo" style="float: left"> <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                            <?php
                        }
                    }
                    break;

                default:
                    for ($pa = 1; $pa <= 5; $pa++) {
                        if ($pa != $pagina_actual) {
                            ?>
                            <div class='milink link_blanco' onclick="cambiarpagina_art(<?php echo $pa; ?>);" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                            <?php
                        } else {
                            ?>
                            <div class="colorAmarillo" style="float: left"> <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                            <?php
                        }
                    }
                    ?>
                    <div class='milink link_blanco' style="float: left" >&nbsp;. . .&nbsp;&nbsp;</div>    
                    <?php
                    for ($pa = $pagina_actual - 4; $pa <= $pagina_actual + 5; $pa++) {
                        if ($pa != $pagina_actual) {
                            ?>
                            <div class='milink link_blanco' onclick="cambiarpagina_art(<?php echo $pa; ?>);" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                            <?php
                        } else {
                            ?>
                            <div class="colorAmarillo" style="float: left"> <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                            <?php
                        }
                    }
                    ?>
                    <div class='milink link_blanco' style="float: left" > &nbsp;. . .&nbsp;&nbsp; </div>    
                    <?php
                    for ($pa = $numPag - 4; $pa <= $numPag; $pa++) {
                        if ($pa != $pagina_actual) {
                            ?>
                            <div class='milink link_blanco' onclick="cambiarpagina_art(<?php echo $pa; ?>);" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                            <?php
                        } else {
                            ?>
                            <div class="colorAmarillo " style="float: left"> <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                            <?php
                        }
                    }
            }
        


        ////////para la Paginacion //////////////////////////////////////////////////////////////
//////// OOOOOOOOOJJJJJJJJOOOOOOOOO  //////////////////////////////////////////////
       
//    for ($c = 1; $c <= ceil($no_reg / $mostrar); $c++) {
//        if ($c == $pagina)
//            echo "<div class='colorAmarillo' style='float:left;'>$c,</div>";
//        else
//            echo "<div class='milink link_blanco' onclick='cambiarpagina_art($c)' style='float:left;'>$c,</div>";
        }
        ?>
    </div>
</div>

        <?php
        if ($consulta_art->num_rows() > 0) {
            $i = $ind + 1;
            //echo $ids;
            $selec = explode(",", $ids);
            $seleccionado = array();
            for ($ii = 1; $ii < count($selec); $ii++) {
                $s = explode("-", $selec[$ii]);
                $seleccionado[$ii] = $s[0];
            }
            ?>  

    <div class='grid_20 fondo_azul borde_abajo borde_arriba borde_der borde_izq espabajo alin_cen ' >     
        <div class="f12" style="display: block-inline;width: 40px;float: left ">
            <div style="display: block; " class="negrilla colorAmarillo ">ID</div>               
        </div>
        <div class="f12"style="display: block-inline;  width: 350px; float: left">
            <div style="display: block; " class="negrilla  colorAmarillo ">Articulo</div>  

        </div>
        <div class="f12"style="display: block-inline;  width: 100px; float: left">
            <div style="display: block; " class="negrilla  colorAmarillo ">Precio Unitario</div>  

        </div>
        <div class="f12" style="display: block-inline; width: 150px; float: left;">
            <div style="display: block; " class="negrilla  colorAmarillo ">Unidad Medida</div>               

        </div>
        <div class="f12" style="display: block-inline; width: 150px; float: left">
            <div style="display: block; " class="negrilla  colorAmarillo ">Palabras Claves</div>               
        </div>      
    </div>

    <?php
    //echo "count seleccionado".count($seleccionado);
    //echo $seleccionado[0];


    foreach ($consulta_art->result() as $res) {
        $clase = "";
        $chec = "";
        if (in_array($res->id_serv_pro, $seleccionado)) {
            $clase = "seleccionado";
            $chec = 'checked="checked"';
        }
        ?> <div class="grid_20 borde_abajo borde_arriba <?php echo $clase; ?>" id="<?php echo $res->id_serv_pro; ?>">
            <div class="grid_1">
                <input type="checkbox" <?php echo $chec; ?> onchange="seleccionar_producto2('<?php echo $res->id_serv_pro; ?>',0)"
                       id="check<?php echo $res->id_serv_pro; ?>" value="<?php echo $res->id_serv_pro; ?>"> <?php echo $i; ?></div>

            <div class="grid_7" >
                <div class="grid_7 negrilla">
                    <input type="hidden" id="id_sp" value="<?php echo $res->id_serv_pro; ?>">
                    <input type="hidden" id="cod_p" value="<?php echo $res->cod_serv_prod; ?>">
                    <input type="hidden" id="tit_p" value="<?php echo $res->nombre_titulo; ?>">
                    <input type="hidden" id="desc_p" value="<?php echo $res->descripcion; ?>">
                    <input type="hidden" id="prec_p" value="<?php echo $res->precio_unitario; ?>">
                    <input type="hidden" id="um_p" value="<?php echo $res->unidad_medida; ?>">
                    <input type="hidden" id="res" value="<?php echo $res->respuesta; ?>">


        <?php echo str_replace($busqueda, "<span class='resaltar'>" . $busqueda . "</span>", $res->cod_serv_prod . ".- " . $res->nombre_titulo); ?>
                </div>
                <div class="grid_7 f10"><?php echo str_replace($busqueda, "<span class='resaltar'>" . $busqueda . "</span>", $res->descripcion); ?></div>
            </div>
            <div class="grid_2 alin_cen "><?php echo $res->precio_unitario; ?></div>
            <div class="grid_2 alin_cen"><?php echo $res->unidad_medida; ?></div>
            <div class="grid_4 alin_cen " ><?php echo str_replace($busqueda, "<span class='resaltar'>" . $busqueda . "</span>", $res->palabras_clave); ?></div>

        </div><?php
            $i++;
        }
        ?>
    <input type="hidden" id="idmovalm" value="<?php echo $id_ma; ?>">
    <div class="grid_20 fondo_azul colorBlanco esparriba5 espabajo5">
        <div class="grid_6 "> <div class="milink link_blanco" onclick="$('#resultado_busqueda').html('');$('#in_search').val('');">LIMPIAR BUSQUEDA</div></div>

    </div>
    <?php
} else {
    echo "no se han encontrado registros de este producto y/o servicio";
}
?>
