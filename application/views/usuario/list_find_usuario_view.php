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
<div style="clear:both;height: 10px;"></div>

<!-- aqui se muestra los registros con un foreach -->
<div>
    <?php foreach ($registros->result() as $reg) { ?>
        <div class='div1150 fondo_plomo'>
            <div class="f12"style="display: block-inline;  width: 100px; float: left">
                <div style="display: block; "><span class="negrilla  colorRojo">#Movimiento Almacen</span></div>  
                <div style="display: block; "><span class="negrilla" ><?php echo $reg->id_mov_alm; ?></span></div>
            </div>

            <div class="f12" style="display: block-inline;width: 300px;float: left ">
                <div style="display: block; ">
                    <span class="negrilla f16 colorRojo"><?php echo "cod_user : " . $reg->cod_user . "(" . $reg->nombre . ")"; ?></span>
                </div>               
                <div style="display: block; ">
                    <span class="negrilla"><?php echo "apellido paterno : </span><span>" . $reg->ap_paterno; ?></span>
                </div>  
            </div> 


            <div class="f12"style="display: block-inline;  width: 150px; float: left">
                <div style="display: block; "><span class="negrilla  colorRojo">Fecha/Hora Registro</span></div>  
                <div style="display: block; "><span class="negrilla"><?php echo $reg->fh_reg; ?></span></div>
            </div>

            <div class="f12" style="display: block-inline; width: 150px; float: left">
                <div style="display: block; "><span class="negrilla  colorRojo">Proyecto</span></div>               
                <div style="display: block; "><span class="negrilla"><?php echo $reg->proyecto; ?></span></div>
            </div>
            <div class="f12" style="display: block-inline; width: 200px; float: left">
                <div style="display: block; "><span class="negrilla  colorRojo">Comentario</span></div>               
                <div style="display: block; "><span class="negrilla"><?php echo $reg->comentario; ?></span></div>               
            </div>



            <div style="display: block-inline; width: 150px; float: left">
                <div style="display: block; ">
                    <div class="boton2 " onclick="search_add('area_adicionar','<?php echo $reg->id_mov_alm; ?>')"><?php echo "Add"; ?></div>          
                </div>               
                <div style="display: block; ">
                    <div class="boton2 " onclick="dialog_contenidos_nuevo_ingreso_detalle1('lista_oventa_prefacturas','<?php echo base_url() . "almacen/ver_lista_al_detalle/$reg->id_mov_alm"; ?> ')"><?php echo "Ver Detalles"; ?></div>
                </div>   
            </div>


        </div>

    <?php } ?>
</div>
