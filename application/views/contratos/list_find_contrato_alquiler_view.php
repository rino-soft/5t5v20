<div class="f12 container_20" style="width: 95% ">
    <div class="fondo_azul colorBlanco negrilla f12 grid_20" style=" display: block; height: 40px; width: 100%">
        <div style="display: inline-block">
            <?php
            if ($total_registros > 0)
                echo $total_registros . " registros cargados exitosamente.<br>"
                    . " Concepto de busqueda en Contratos de Alquiler :</span><span class='colorAmarillo'> Buscar en <span class='fondoAmarillo_estado colorAzul negrilla'>".$proyectoN."</span> con la palabra clave <span class='fondoAmarillo_estado colorAzul negrilla'>*".$busqueda."*</span></span>";
            else
                echo $total_registros . " registros cargados !  No se han encontrado Registros en la Base de Datos.";
            ?>
        </div>
        <div id="paginacion" style="float: right; padding-right: 25px">
            <?php
           
            
            ////////para la Paginacion //////////////////////////////////////////////////////////////
//////// OOOOOOOOOJJJJJJJJOOOOOOOOO  //////////////////////////////////////////////

            $numPag = ceil($total_registros / $mostrar_X);
            if ($numPag <= 20) {
                for ($pa = 1; $pa <= ceil($total_registros / $mostrar_X); $pa++) {
                    if ($pa != $pagina_actual) {
                        ?>
                        <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa;   ?>);search_and_list_contrato_alquiler('lista_contratos');" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
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
                                <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa;   ?>);search_and_list_contrato_alquiler('lista_contratos');" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
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
                                <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa;   ?>);search_and_list_contrato_alquiler('lista_contratos');" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
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
                                <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa;   ?>);search_and_list_contrato_alquiler('lista_contratos');" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
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
                                <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa;   ?>);search_and_list_contrato_alquiler('lista_contratos');" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
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
                                <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa;   ?>);search_and_list_contrato_alquiler('lista_contratos');" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
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
                                <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa;   ?>);search_and_list_contrato_alquiler('lista_contratos');" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
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
                                <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa;   ?>);search_and_list_contrato_alquiler('lista_contratos');" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
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




    <?php
    if ($total_registros != 0) {
        ?>
        <div class="fondo_azul colorAmarillo borde_abajo borde_arriba  negrilla f14" style="display: block-inline;float: left ; width: 100%; height: ">            
            <div class=" fondo_azul alin_cen" style="display: block-inline;float: left ;width: 7%">ID_contrato</div>
            <div class=" fondo_azul alin_cen" style="display: block-inline;float: left ;width: 10%">Departamento</div>
            <div  class=" fondo_azul alin_cen" style="display: block-inline;float: left ;width: 15%">Provincia</div>
            <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 15%">Propietario</div>
            <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 10%">Telefono / Celular</div>
            <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 25%">Proyectos</div>
            <div  class=" fondo_azul alin_cen edit_ico" style="display: block-inline; float: left;width: 4%" ></div>

        </div>

        <!-- aqui se muestra los registros con un foreach -->

        <?php
        $i = 1;
        $fila_parte_a = "";
        $fila_parte_b = "";
        $fila_parte_c = "";
        $id_anterior = 0;
        foreach ($registros->result() as $reg) {

            if ($id_anterior != $reg->id_contrato) {

                if ($id_anterior != 0) {
                    echo '<div class="  ' . $estilo_estado . '  " style="display: block-inline;float: left ; width: 100%; height: "> '
                    . $fila_parte_a . $fila_parte_b . $fila_parte_c."</div>";
                    $fila_parte_a = "";
                    $fila_parte_b = "";
                    $fila_parte_c = "";
                }

                $estilo_estado = "filas";
                if ($reg->estado == "Inactivo")
                    $estilo_estado = "fila_disabled";

                $fila_parte_a = '<div class="  alin_cen" style="display: block-inline;float: left ;width: 7%">' . $reg->id_contrato . '<br></div>
                            <div class="  alin_cen" style="display: block-inline;float: left ;width: 10%">' . $reg->departamento . '<br></div>
                            <div  class="  alin_cen" style="display: block-inline;float: left ;width: 15%">' . $reg->Provincia . '<br></div>
                            <div  class="  alin_cen" style="display: block-inline; float: left;width: 15%">' . $reg->nombre_c_prop . '<br></div>
                            <div  class="  alin_cen" style="display: block-inline; float: left;width: 10%">' . $reg->telefono . ' / cel: ' . $reg->celular . '<br></div>
                            
                            <div  class="  " style="display: block-inline; float: left;width: 25%">';

                $fila_parte_b = '<div class="filas_ama negrillas"><span class="negrilla f12 colorGuindo">(' . $reg->participacion . '%)</span>' . $reg->nombre . '</div>';

                $fila_parte_c = '</div> <div  class="  alin_cen" style="display: block-inline; float: left;width: 4%">'
                        . '<div class="edit_ico milink" style="padding: 0px; margin:5px;" '
                        . 'onclick="dialog_registro_contratos_alquiler(\'div_formularios_dialog\', \' '.base_url().'linea_servicio/formulario_registro_contrato_alquiler/'.$reg->id_contrato.'\')" >'
                        . '</div>'
                        . '</div>';
                
                $id_anterior = $reg->id_contrato;
            } else {

                $fila_parte_b.='<div class="filas_ama negrillas"><span class="negrilla f12 colorGuindo">(' . $reg->participacion . '%)</span>' . $reg->nombre . '</div>';
            }
            
        }
        echo '<div class="  ' . $estilo_estado . '  " style="display: block-inline;float: left ; width: 100%; height: "> '
                    . $fila_parte_a . $fila_parte_b . $fila_parte_c."</div>";
    } else
        echo 'No se encontraron Registros ...';
    ?>
