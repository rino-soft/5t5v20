<div class="f12 container_20" style="width: 95%">
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
                <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa; ?>);busca_lista_mi_sol_mat('lista_solicitud_material');" style="float: left" > <?php echo $pa . " ,"; ?> </div>
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


<!-- aqui se muestra los registros con un foreach -->


<div class="fondo_azul colorAmarillo borde_abajo borde_arriba  negrilla f12" style="display: block-inline;float: left ; width: 100%; height: ">   
        <div class=" alin_cen" style="display: block-inline;width: 5%;float: left ">ID</div>
        <div class=" alin_cen" style="display: block-inline;width: 10%;float: left ">Estado</div>
        <div class=" alin_cen" style="display: block-inline;width: 10%;float: left ">Fecha registro</div>
        <div class="" style="display: block-inline;width: 20%;float: left ">Personal Encargado del Material</div>
        <div class=" alin_cen" style="display: block-inline;width: 30%;float: left ">Comentario / observaciones</div>
        

    </div>
	
    <?php foreach ($registros->result() as $reg) { ?>
        <div class='grid_20 cambio_fondo f12 borde_abajo esparriba10' style="width: 100%;">

            <div class=" alin_cen negrilla f14 colorRojo" style="display: block-inline;width: 5%;float: left"  >
                <?php if ($reg->id_solicitud_mat != "") echo $reg->id_solicitud_mat; else echo "&nbsp;"?>
            </div>               
            <div class=" alin_cen colorVerde_claro" style="display: block-inline;width: 10%;float: left"  >
                <?php if ($reg->estado != "") echo $reg->estado; else echo "&nbsp;"?>
            </div>   
            <div class=" alin_cen" style="display: block-inline;width: 10%;float: left"  >
                <?php if ($reg->fh_registro != "") echo $reg->fh_registro; else echo "&nbsp;"?>
            </div>  

            <div class=" colorAzul " style="display: block-inline;width: 20%;float: left">
                <?php if ($reg->ap_paterno  != "" && $reg->nombre !="") echo $reg->ap_paterno . ", " . $reg->nombre; else echo "&nbsp;" ?>
            </div>               
            <div class=" f11" style="display: block-inline;width: 45%;float: left">
                <?php if ($reg->comentario_obs != "") echo $reg->comentario_obs; else echo "&nbsp;"?>
            </div>

            <div class="" style="display: block-inline;width: 10%;float: left">
                
               <!-- <div class="boton2 alin_cen" onclick="show_ovpf('div_formularios_dialog','<?php // echo $reg->id_solicitud_mat; ?>')"><?php // echo "Ver detalles"; ?></div>-->
                <div style="width:100px; float:right;" class="boton2 alin_cen" onclick="dialog_nueva_sol_mat('div_formularios_dialog','<?php echo base_url() . "solicitud_material/sol_mat_add_mod/".$reg->id_solicitud_mat;; ?> ')"><?php echo "Editar"; ?></div>
               
            </div>




        </div>
	
    <?php } ?>
</div>