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
<!-- aqui se muestra los registros con un foreach -->
<?php
    if ($total_registros != 0) {
        ?>
        <div class="grid_20 fondo_azul colorAmarillo borde_abajo borde_arriba  negrilla f14" style="width: 100%">            
            <div class=" negrilla alin_cen" style="display: block-inline;float: left; width: 10% ">ID</div>
            <div class="negrilla" style="display: block-inline;float: left; width: 15%">NOMBRE</div>
            <div class="negrilla"style="display: block-inline; float: left; width: 10%">CI</div>
            <div class="negrilla"style="display: block-inline; float: left; width: 10%">USUARIO</div>
          <!--  <div class="negrilla" style="display: block-inline; float: left; width: 10%">LOGIN</div>
            <div class="negrilla" style="display: block-inline; float: left; width: 10%">TELF</div>-->
            <div class="negrilla" style="display: block-inline; float: left; width: 10%">ESTADO</div>
        </div>

    <?php
    foreach ($registros as $usuario) {
        ?>
         <div class="grid_20 borde_abajo  cambio_fondo esparriba5  f12" style="width: 100%">
                    <div class=" negrilla alin_cen" style="display: block-inline;float: left; width: 10% "> <?php if ($usuario->cod_user != "") echo $usuario->cod_user;else echo " &nbsp;"?></div>
                    <div class="" style="display: block-inline; float: left; width: 15%"><?php if ($usuario->nombre != "") echo $usuario->nombre." ".$usuario->ap_paterno." ".$usuario->ap_materno; else echo " &nbsp;" ?></div>
                    <div class="" style="display: block-inline; float: left; width: 10%"><?php if ($usuario->ci != "") echo $usuario->ci;else echo " &nbsp;" ?></div>
                    <div class="" style="display: block-inline; float: left; width: 10%"><?php if ($usuario->username != "") echo $usuario->username;else echo " &nbsp;" ?></div>
                 <!--    <div class="" style="display: block-inline; float: left; width: 10%"><?php //if ($usuario->password != "") echo $usuario->password;else echo " &nbsp;"  ?></div>
                    <div class="" style="display: block-inline; float: left; width: 10%"> <?php //if ($usuario->telefono != "") echo $usuario->telefono;else echo " &nbsp;"  ?> </div>-->
                    <div class="" style="display: block-inline; float: left; width: 10%"><?php if ($usuario->estado != "") echo $usuario->estado;else echo " &nbsp;"?></div>
                   
                      <div class="controles f12">
                            <div class="boton_editar_usuario milink"  title="Editar Usuario"
                            onclick="dialog_contenidos_nuevo_usuario('div_formularios_dialog','<?php echo base_url() . "usuario/usuario_nuevo/".$usuario->cod_user; ?>')"></div>
                    </div>
                  <div class="controles f12">
                           <div class="boton_ver_usuario milink"  title="Ver Usuario"
                            onclick="dialog_ver_usuario('div_formularios_dialog','<?php echo base_url() . "usuario/ver_usuario/".$usuario->cod_user; ?>')"></div>
                    </div>
                     <div class="controles f12">
                           <div class="boton_imprimir_usuario milink"  title="Imprimir PDF" onclick="Imp_detalle_usuario('<?php echo $usuario->cod_user ?>')"></div> 
                   
                    </div>
                    <div class="boton_ver_usuario milink"
                         onclick="<?php echo base_url()."experiencia_laboral/index"?>">
                    </div>
					<div class="permisos_icono milink" style="display: block-inline; float: left;"  title="Permisos"
                            onclick="dialog_form_permisos('div_formularios_dialog','<?php echo base_url() . "perfiles/form_asigna_perfiles/".$usuario->cod_user; ?>')"></div>
                </div> 
        <?php
    }
    }
    else
        echo '';
    ?>
<div id="div_formularios_dialog" class="formulario_nuevo_menu ocultar container_20" style="height: 300px; width: 400px;">cargando...</div>

