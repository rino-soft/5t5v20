<div class="container_20" style="width: 95% ">
    <div class="fondo_azul colorBlanco negrilla f12 grid_20" style="  width: 100%">
        <div style="display: inline-block">
            <?php
            if ($total_registros > 0)
                echo $total_registros . " registros cargados exitosamente.";
            else
                echo $total_registros . " registros cargados !  No se han encontrado Registros en la Base de Datos.";
            ?>
        </div>

        <div id="paginacion" class="f14" style=" padding-right: 25px;float:right ">

<?php


////////para la Paginacion //////////////////////////////////////////////////////////////
//////// OOOOOOOOOJJJJJJJJOOOOOOOOO  //////////////////////////////////////////////

            $numPag = ceil($total_registros / $mostrar_X);
            if ($numPag <= 20) {
                for ($pa = 1; $pa <= ceil($total_registros / $mostrar_X); $pa++) {
                    if ($pa != $pagina_actual) {
                        ?>
                        <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa;   ?>);search_and_list_serv_prod('lista_serv_prod');" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
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
                                <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa;   ?>);search_and_list_serv_prod('lista_serv_prod');" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
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
                                <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa;   ?>);search_and_list_serv_prod('lista_serv_prod');" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
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
                                <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa;   ?>);search_and_list_serv_prod('lista_serv_prod');" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
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
                                <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa;   ?>);search_and_list_serv_prod('lista_serv_prod');" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
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
                                <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa;   ?>);search_and_list_serv_prod('lista_serv_prod');" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
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
                                <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa;   ?>);search_and_list_serv_prod('lista_serv_prod');" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
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
                                <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa;   ?>);search_and_list_serv_prod('lista_serv_prod');" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                                <?php
                            } else {
                                ?>
                                <div class="colorAmarillo" style="float: left"> <?php echo $pa . "&nbsp;&nbsp;&nbsp;";   ?> </div>
                                <?php
                            }
                        }
                }
            }
            
            ////////para la Paginacion //////////////////////////////////////////////////////////////
//////// OOOOOOOOOJJJJJJJJOOOOOOOOO  //////////////////////////////////////////////
            ?>
                                
                                

        </div>

    </div>



    <div class="fondo_azul colorAmarillo borde_abajo borde_arriba  negrilla f14" style="display: block-inline;float: left ; width: 100%; height: " >
        <div class="f14 alin_cen negrilla" style="display:block-inline; float: left; width: 9%" >Id</div>
        <div class="f14 alin_cen negrilla" style="display:block-inline; float: left;width:10%">Codigo</div>               
        <div class="f14 negrilla alin_cen" style="display:block-inline; float: left;width: 25%">Nombre del Producto</div>
        <div class="f14 negrilla alin_cen" style="display:block-inline; float: left;width:10%">Precio Referencial</div>
        <div class="f14 negrilla alin_cen" style="display:block-inline; float: left;width:30%">Descripción</div>  
    </div>



    <!-- aqui se muestra los registros con un foreach -->

    <?php foreach ($registros->result() as $reg) { ?>
        <div class="grid_20 borde_abajo  cambio_fondo esparriba10  " style="width: 100%">

            <div class="f12 alin_cen "style="display: block-inline;  float: left; width: 9%">

                <?php if ($reg->id_serv_pro != "") echo $reg->id_serv_pro; else echo "&nbsp;" ?>               
            </div>

            <div class="f12 alin_izq colorAzul negrilla " style="display: block-inline;  float: left; width: 10%">
                <?php if ($reg->cod_serv_prod != "") echo $reg->cod_serv_prod; else echo "&nbsp;" ?>
            </div>
            <div class="f12 alin_izq " style="display: block-inline;  float: left; width: 25%">
                <?php if ($reg->nombre_titulo != "") echo $reg->nombre_titulo; else echo "&nbsp;" ?>
            </div>
            <div class="f12 alin_cen " style="display: block-inline;  float: left; width: 10%" >              
                <?php if ($reg->precio_unitario != "") echo $reg->precio_unitario; else echo "&nbsp;" ?>
            </div>
            <div class="f12 alin_izq " style="display: block-inline;  float: left; width: 30%">              
                <?php if ($reg->descripcion != "") echo $reg->descripcion; else echo "&nbsp;" ?>
            </div>
            <div class="" style="display: block-inline;  float: left; width: 7%" >               
                <div class=""style="display: block;float: right ">
                    <div title="Ver registro" class="ver_historial milink" style="" onclick="dialog_detalle_servicio_producto('div_formularios_dialog','<?php echo base_url() . "producto_servicio/ver_serv_prod/$reg->id_serv_pro"; ?>')"><?php echo""; ?></div>
                </div> 
                <div style="display: block;float: right ">
                    <div title="Editar registro"  class="editvehiculo" style="" onclick="dialog_nueva_prod_serv('div_formularios_dialog','<?php echo base_url() . "producto_servicio/nuevo_serv_prod/$reg->id_serv_pro"; ?> ','Editar producto - servicio')"><?php echo""; ?></div>
                </div>
            </div>
        </div>

    <?php } ?>
</div>







