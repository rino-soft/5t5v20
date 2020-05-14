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
       /* for ($pa = 1; $pa <= ceil($total_registros / $mostrar_X); $pa++) {
            if ($pa != $pagina_actual) {
                ?>
                <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa; ?>);search_and_list_factura_venta('lista_oventa_prefacturas');" style="float: left" > <?php echo $pa . " ,"; ?> </div>
                <?php
            } else {
                ?>
                <div class="colorAmarillo" style="float: left"> <?php echo $pa . " ,"; ?> </div>
                <?php
            }
        }*/
		
		
		
        ?>
		<?php


////////para la Paginacion //////////////////////////////////////////////////////////////
//////// OOOOOOOOOJJJJJJJJOOOOOOOOO  //////////////////////////////////////////////

            $numPag = ceil($total_registros / $mostrar_X);
            if ($numPag <= 20) {
                for ($pa = 1; $pa <= ceil($total_registros / $mostrar_X); $pa++) {
                    if ($pa != $pagina_actual) {
                        ?>
                        <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa;   ?>);search_and_list_cheques('lista_cheques');" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
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
                                <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa;   ?>);search_and_list_cheques('lista_cheques');" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
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
                                <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa;   ?>);search_and_list_cheques('lista_cheques');" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
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
                                <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa;   ?>);search_and_list_cheques('lista_cheques');" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
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
                                <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa;   ?>);search_and_list_cheques('lista_cheques');" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
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
                                <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa;   ?>);search_and_list_cheques('lista_cheques');" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
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
                                <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa;   ?>);search_and_list_cheques('lista_cheques');" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
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
                                <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa;   ?>);search_and_list_cheques('lista_cheques');" style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
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
<div style="clear:both;height: 10px;"></div>

<!-- aqui se muestra los registros con un foreach -->

<?php
if ($total_registros != 0) {
    ?>
    <div class="fondo_azul colorAmarillo borde_abajo borde_arriba  negrilla f14" style="display: block-inline;float: left ; width: 100%; height: ">            
        <div class=" fondo_azul alin_cen f8" style="display: block-inline;float: left ;width: 2%"><br></div>
        <div class=" fondo_azul alin_cen f10" style="display: block-inline;float: left ;width: 5%">codigo</div>
        <!-- <div class=" fondo_azul alin_cen" style="display: block-inline;float: left ;width: 12%">Estado</div> -->
        <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 20%">Nombre Completo</div>
        <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 5%">CI</div>
        <!---<div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 20%">Llave de control</div>--->
        <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 20%">Banco </div>
        <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 10%">Cuenta </div>
        <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 7%">Telefono</div>
        
        <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 20%">Comentario</div>

        <div  class=" fondo_azul alin_cen" style="display: block-inline; float: left;width: 10%">
                           
        </div>

    </div>

    <!-- aqui se muestra los registros con un foreach -->

    <?php
     
 foreach ($registros->result() as $reg) {
        $clase = "cambio_fondo";
        //if ($reg->est_factura == "Anulado")
          //  $clase = "fila_disabled";
            ?>
        <div class="grid_20 borde_abajo <?php echo $clase; ?>  esparriba10  " style="width: 100%">
            <div class="f20 alin_cen negrilla colorAmarillo " style="display: block-inline;float: left; width: 2%"> <?php echo substr($reg->ap_paterno, 0,1)."<br>"; ?></div>
            <div class="f12 alin_cen negrilla " style="display: block-inline;float: left; width: 5%"> <?php 
                    echo substr("0000",strlen($reg->cod_user)).$reg->cod_user;
                            
                           
             ?></div>

            <div class="f12 negrilla alin_izq azulmarino" style="display: block-inline;  float: left; width: 20%"><?php echo $reg->ap_paterno." ".$reg->ap_materno.", ".$reg->nombre."<br>"; ?></div>
            <div class="f12 alin_izq" style="display: block-inline;float: left; width: 5%"><?php echo $reg->ci."<br>"; ?></div>  

            <div class="f14 alin_cen negrilla" style="display: block-inline;float: left; width: 20%"><?php echo $reg->Banco . "<br>"; ?></div>
            <div class="f16 negrilla colorRojo alin_cen" style="display: block-inline;float: left; width: 10%;"><?php echo $reg->cuenta . "<br>"; ?></div>
            <div class="f10 alin_cen" style="display: block-inline;float: left; width: 7%"><?php echo "celular "."<br>"; ?></div>
            
            <div class="f10 alin_izq" style="display: block-inline;float: left; width: 20%"><?php echo $reg->comentario . "<br>"; ?></div>
            
            <div  style="display: block-inline;  float: left; width: 10%">

                
                <div class="add_cuenta milink"  title="adicionar/editar_cuentas" onclick="dialog_adicionar_cuenta_empresa_personal('div_formularios_dialog','<?php echo base_url()."e_chequera/form_add_cuenta_banco/".$reg->cod_user; ?>') ;">
                </div>
                


            </div>

        </div>

        <?php
    }
}
else
    echo 'No se Encontraron Registros';
?>



