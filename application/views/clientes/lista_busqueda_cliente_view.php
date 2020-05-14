    <div class="fondo_azul colorBlanco negrilla f12 grid_20" style=" display: block; height: 20px; width: 100%">
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
                    <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa; ?>); search_and_list_dosificacion(div_resultado);" style="float: left" > <?php echo $pa . " ,"; ?> </div>
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
        <div style="display: block; padding: 5px;">
    <?php
    foreach ($datos_cliente->result() as $cliente) {
        ?>
        <div class="div450x300 fondo_plomo" >
            <div class="interno" >
                <div class="colorGuindo f30 negrilla" style="width: 100px; float: left"><?php echo $cliente->id_cliente;?></div>
                <div class="tit colorAzul alin_der">
                    <?php echo $cliente->razon_social; ?><br>
                    <span class="negrilla colorRojo f14">NIT : <?php echo $cliente->nit; ?></span>
                </div>
                <div class="datos colorAzul">
                    <span class="negrilla">Telefonos : </span><?php echo $cliente->telefonos; ?><br>
                    <span class="negrilla">Direccion : </span><?php echo $cliente->direccion; ?><br>
                </div>

                <div class="lista_contactos "><div class="alin_der "><span class="colorRojo f10 negrilla">Lista de Contactos</span></div>
                    <div class="espaciado5">
                        <?php
                        $contac = $contactos_cliente[$cliente->id_cliente];
                        for ($i = 0; $i < count($contac); $i++) {
                            if ($i == 2) {
                                ?>
                                <div class="item_contactos milink">
                                    <span class="negrilla"> Ver mas contactos............</span>                                                 
                                </div>
                                <?php
                                break;
                            } else {
                                ?>
                                <div class="item_contactos milink" title="Cargo : <?php echo $contac[$i]['cargo']; ?>">
                                    <span class="negrilla">-<?php echo $contac[$i]['nombre_c']; ?></span>
                                    <span class="">(<?php echo $contac[$i]['tel']; ?>)</span>

                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>

            </div>
            <div class="controles f12">
                <div class="boton_editar milink"  title="Editar cliente"
                     onclick="dialog_contenidos_nuevo_cliente('div_formularios_dialog', '<?php echo base_url() . "cliente/cliente_nuevo/" . $cliente->id_cliente; ?>')">Editar Cliente</div>
                <div class="boton_nuevo_menu milink" title="Adicionar contacto" 
                     onclick="dialog_contenidos_nuevo_contacto('div_formularios_dialog', '<?php echo base_url() . "cliente/contacto_nuevo/" . $cliente->id_cliente . "/0"; ?>');" >Adicionar Contacto</div>
            </div>

        </div>    
        <?php
    }
    ?>

</div>

            <?php
        
    }
    else
        echo '';
    ?>

<div id="div_formularios_dialog" class="formulario_nuevo_menu ocultar" style="height: 300px; width: 400px;">cargando...</div>