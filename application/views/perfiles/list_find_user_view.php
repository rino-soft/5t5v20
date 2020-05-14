<div class="fondo_azul colorBlanco negrilla f12" style="width: 95%; display: block; padding: 5px; ">
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
        for ($pa = 1; $pa <= ceil($total_registros / $mostrar_u); $pa++) {
            if ($pa != $pagina_actual) {
                ?>
                <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa; ?>);search_and_list_user('lista_usuarios');" style="float: left" > <?php echo $pa . " ,"; ?> </div>
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
<?php
if ($total_registros != 0) {
    ?>
    <div class="div500 fondo_plomo borde_abajo borde_arriba borde_der borde_izq espabajo  negrilla fondo_azul colorAmarillo f12" >
        <div style="display: block; width: 80px; float: left ">Codigo</div>               
        <div style="display: block; width: 295px; float: left">Nombre</div> 
        <div style="display: block; width: 100px; float: left">Estado</div> 
    </div>
    <!-- aqui se muestra los registros con un foreach -->

    <?php
    $i = 0;
    $c=0;
    $llave = null;
    $selec = explode(",", $ids_u);
    $seleccionado = array();
    for ($ii = 1; $ii < count($selec); $ii++) {
        $s = $selec[$ii];
        $seleccionado[$ii] = $s[0];
        //echo 'lll' + $seleccionado[$ii];
    }
    foreach ($registros_usuarios->result() as $reg) {
        $clase = "";
        $chec = "";
        if (in_array($reg->cod_user, $seleccionado)) {
                $clase = "seleccionado";
                $chec = 'checked="checked"';
            }

        foreach ($registros_asignacion_usuarios->result() as $reg_user) {
            if ($reg->cod_user == $reg_user->id_user) {
                $llave = true;
                break;
            } else {
                $llave = false;
            }
        }
        if ($llave != true) {
            /*for ($k = 1; $k < count($seleccionado); $k++) {
               
                if($seleccionado[$k]=$reg->cod_user)
                {
                    $c++;
                    echo "contador"+$c;
                }
            }*/
            ?>
            <div class=" grid_7 borde_abajo  cambio_fondo esparriba10"  style="width: 95%;" id="div<?php echo $reg->cod_user; ?>" >
                <div class="grid_1  " style="display: block-inline; width: 10px; float:left;">
                    <input type="checkbox" <?php echo $chec; ?> onchange="seleccionar_usuarios('<?php echo $reg->cod_user; ?>');"  onclick="mostrar_asignacion_perfil_usuarios('<?php echo $reg->cod_user; ?>'); "
                           id="percheck<?php echo $reg->cod_user; ?>" value="<?php echo $reg->cod_user; ?>">
                </div>
                <div class="grid_7 negrilla ">
                    <input type="hidden" id="id_us" value="<?php echo $reg->cod_user; ?>">
                    <input type="hidden" id="nom" value="<?php echo $reg->nombre; ?>">
                    <input type="hidden" id="pat" value="<?php echo $reg->ap_paterno; ?>">
                    <input type="hidden" id="mat" value="<?php echo $reg->ap_materno; ?>">

                    <div class="f12 alin_der espder20 " style="display: block-inline;width:40px;float: left; ">
                        <div style="display: block; "  class="alin_der espder10 esparriba10">
                            <?php echo str_replace($busqueda, "<span class='resaltar'>" . $busqueda . "</span>", $reg->cod_user); ?>
                        </div>               
                    </div>
                    <div class="f12  "style="display: block-inline;  width: 310px; float: left; ">
                        <div style="display: block; "  class="espizq10 esparriba10">
                            <?php echo str_replace($busqueda, "<span class='resaltar'>" . $busqueda . "</span>", $reg->nombre . " " . $reg->ap_paterno . " " . $reg->ap_materno); ?>
                        </div>
                    </div> 
                    <div class="f12 "style="display: block-inline;  width: 250px; float: left; ">
                        <div style="display: block; "><?php echo 'libre para asignar'; ?></div>
                    </div>
                </div>
            </div>



            <?php
        } else {
            ?>
            <div class="grid_7 negrilla borde_abajo  cambio_fondo esparriba10 " style="width: 95%;"> 
                <div class="f12 alin_cen grid_1 espder20 " style="display: block-inline;width: 55px;float: left; ">
                    <div style="display: block; " class="alin_der espder10"><?php echo str_replace($busqueda, "<span class='resaltar'>" . $busqueda . "</span>", $reg->cod_user); ?></div>               
                </div>

                <div class="f12"style="display: block-inline;  width: 305px; float: left; ">
                    <div style="display: block;" class="espizq10 "><?php echo str_replace($busqueda, "<span class='resaltar'>" . $busqueda . "</span>", $reg->nombre . " " . $reg->ap_paterno . " " . $reg->ap_materno); ?></div>
                </div> 
                <div class="f12 "style="display: block-inline;  width: 100px; float: left; ">
                    <div style="display: block; "><?php echo 'Menus Asignados'; ?></div>
                </div>
            </div>

            <?php
        }
    }
}
else
    echo "no se han encontrado registros de usuarios";
?>


