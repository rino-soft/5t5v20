<div style="display: block ; float: left;" class="grid_20 fondo_azul colorBlanco negrilla f12 ">
        <?php
        if ($no_reg > 0)
            echo $no_reg . " registros cargados exitosamente.";
        else
            echo $no_reg . " registros cargados !  No se han encontrado Registros en la Base de Datos.";
        ?>
                <div style="float:right"><?php
    for ($c = 1; $c <= ceil($no_reg / $mostrar); $c++) {
        if ($c == $pagina)
            echo "<div class='colorAmarillo' style='float:left;'>$c,</div>";
        else
            echo "<div class='milink link_blanco' onclick='cambiarpagina_art($c)' style='float:left;'>$c,</div>";
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

        //echo "count seleccionado".count($seleccionado);
        //echo $seleccionado[0];

        foreach ($consulta_art->result() as $res) {
            $clase = "";
            $chec = "";
            if (in_array($res->id_serv_pro, $seleccionado)) {
                $clase = "seleccionado";
                $chec = 'checked="checked"';
            }
            ?> 
            <div class="grid_20 borde_abajo borde_arriba <?php echo $clase; ?>" id="<?php echo $res->id_serv_pro; ?>">
                <div class="grid_1">
                    <input type="checkbox" <?php echo $chec; ?> onchange="seleccionar_producto_solicitud('<?php echo $res->id_serv_pro; ?>')"
                           id="check<?php echo $res->id_serv_pro; ?>" value="<?php echo $res->id_serv_pro; ?>"> <?php echo $i; ?></div>

                <div class="grid_7" >
                    <div class="grid_7 negrilla">
                        <input type="hidden" id="id_sp1" value="<?php echo $res->id_serv_pro; ?>">
                         <input type="hidden" id="id_sp" value="<?php echo $res->id_serv_pro; ?>">
                        <input type="hidden" id="cod_p" value="<?php echo $res->cod_serv_prod; ?>">
                        <input type="hidden" id="tit_p" value="<?php echo $res->nombre_titulo; ?>">
                        <input type="hidden" id="desc_p" value="<?php echo $res->descripcion; ?>">
                        <input type="hidden" id="prec_p" value="<?php echo $res->precio_unitario; ?>">
                        <input type="hidden" id="um_p" value="<?php echo $res->unidad_medida; ?>">
                        <?php echo str_replace($busqueda, "<span class='resaltar'>" . $busqueda . "</span>", $res->cod_serv_prod . ".- " . $res->nombre_titulo); ?>
                    </div>
                    <div class="grid_7 f10"><?php echo str_replace($busqueda, "<span class='resaltar'>" . $busqueda . "</span>", $res->descripcion); ?></div>
                </div>
                <div class="grid_2 alin_cen"><?php echo $res->precio_unitario; ?></div>
                <div class="grid_2 alin_cen"><?php echo $res->unidad_medida; ?></div>
                <div class="grid_4 alin_cen " ><?php echo str_replace($busqueda, "<span class='resaltar'>" . $busqueda . "</span>", $res->palabras_clave); ?></div>

            </div><?php
                $i++; 
            }
                    ?>
        <div class="grid_20 fondo_azul colorBlanco esparriba5 espabajo5">
            <div class="grid_6 "> <div class="milink link_blanco" onclick="$('#resultado_busqueda').html('');$('#in_search').val('');">LIMPIAR BUSQUEDA</div></div>
            
        </div>
        <?php
    }

    else {
        echo "no se han encontrado registros de este producto y/o servicio";
    }
    ?>
