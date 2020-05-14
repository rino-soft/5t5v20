
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
<!--- Desde aqui el nuevo listado usuario -->
<?php
if ($total_registros != 0) {
    ?>
    <div style="display: block; padding: 5px;">
        <?php
        foreach ($registros as $usuario) {
            $estilos_estado = "background: #0B3156;";
            $estilos_inactivo = "";
            $Codigo_inactivo = "";
            
            if ($usuario->estado == "Inactivo") {
//                $estilos_estado = "background: #FE8D8C;";
//                $estilos_inactivo = "background: #FED5D4;";
                $Codigo_inactivo = '<div style="position: absolute; left: 0px;top:0px; width: 440px;height: 250px" class="fondo_inactivo"></div>';
            }
            ?>
            <div class="div450x170 fondo_celeste_usuario" style="position: relative;z-index:-1; <?php echo $estilos_inactivo; ?>">
                <div class="" >

                    <div class="fondo_cabecera_usuario" style="width: 100%;height: 45px;position: absolute; <?php echo $estilos_estado; ?>">
                        <div class="f14 negrilla colorBlanco mayusculas alin_der" style=" float: right; margin: 5px 5px 0 150px;width: 250px ;text-shadow: 0 0 1px rgba(0, 0, 0, 1);">
                            <?php
                            if ($usuario->cargo_actual != "")
                                echo $usuario->cargo_actual;
                            else
                                echo "&nbsp;"
                                ?><br>
                        </div>

                    </div>
                    <div style="position: absolute;left: 5px;top:2px;width: 140px;" class='blanco_text'>
                        <div class="alin_cen f10"><?php echo date("d/m/Y", strtotime($usuario->fecha_inicio)); ?></div>
                        <div class="alin_cen"><?php
                            $date1 = new DateTime();
                            $date2 = new DateTime($usuario->fecha_inicio);
                            $diff = $date1->diff($date2);
                            $dias = $diff->days;
                            $anio = floor($diff->days / 365);
                            $meses = floor((($diff->days - ($anio * 365)) / 365) * 12);
// will output 2 days       
                            echo $anio . ' Años ' . $meses . " meses";
                            ?></div>
                    </div>
                    <div style="position: absolute;background: #F7FAFF;box-shadow: 1px 1px 3px #555 ;left: 20px;top:35px;width: 110px;height: 110px;">

                        <?php
                        if ($usuario->fotografia_actual != "") {
                            $archtumb = str_replace("fotouser", "fotouser/thumbs", $usuario->fotografia_actual);

                            $extencion = substr($usuario->fotografia_actual, strlen($usuario->fotografia_actual) - 4);
                            $archtumb = str_replace($extencion, "_thumb" . $extencion, $archtumb);
                            $archtumb = substr($archtumb, 2);
                            $arch = substr($usuario->fotografia_actual, 2);
                            echo "<div><center><img src='" . base_url() . $archtumb . "' height='110px' onclick='ver_archivo(\"" . $arch . "\",\"Adjunto\")' class='milink'></center></div>";
                        } else
                            echo"<div><center><img src='" . base_url() . 'imagenesweb/recursos/foto_user.jpg' . "' height='110' class='milink'></center></div>";
                        ?>

                        <div class="guindotext alin_cen f16 negrilla" style="width: 120px; float: left;display: inline-block"><?php
                            if ($usuario->cod_user != "") {
                                $cero = substr("00000", 0, (5 - strlen($usuario->cod_user)));
                                echo "ID:" . $cero . $usuario->cod_user;
                            } else
                                echo "&nbsp;"
                                ?>
                        </div>
                        <div class="f12 negrilla alin_cen" style="width: 120px; float: left;display: inline-block">
                            <span class="colorGuindo">Login:</span> <span class=""><?php echo $usuario->username . "<br>"; ?></span>
                        </div>




                    </div>

                    <div class="colorAzul f12" style="position: absolute; top:50px;left: 140px;" >

                        <span class="negrilla colorAzul">Apellidos : </span><?php echo $usuario->ap_paterno . " " . $usuario->ap_materno . "<br>"; ?>

                        <span class="negrilla colorAzul">Nombre(s) : </span><?php echo $usuario->nombre . "<br>"; ?>

                        <span class="negrilla colorAzul">Nro.CI. : </span><span class='negrilla'><?php echo $usuario->ci . ' ' . $usuario->exp . "<br>"; ?></span>



                    </div>

                    <div style="position: absolute; left: 5px;top:180px; width: 160px" class="" id="div_dias_vacacion<?php echo $usuario->cod_user; ?>">

                        <div class="f10 negrilla alin_cen" style="width: 100%;float: left; display: inline-block">Vacación</div>
                        <div class=" bordeado" style="width: 31%;float: left; display: inline-block;  ">
                            <div class="alin_cen f10">Utilizadas</div><div class="alin_cen">0</div>
                        </div>
                        <div class="bordeado" style="width: 33%;float: left; display: inline-block;">
                            <div class="alin_cen f10">Sobrantes</div><div class="alin_cen">0</div>
                        </div>
                        <div class="bordeado" style="width: 31%;float: left; display: inline-block;">
                            <div class="alin_cen f10">Calculado</div><div class="alin_cen">0</div>
                        </div>
                    </div>
                    <script> mostrar_cuadro_dias_vacacion('div_dias_vacacion<?php echo $usuario->cod_user; ?>',<?php echo $usuario->cod_user; ?>);</script>

                    <div style="position: absolute; left:170px;top:100px; width: 250px;max-height: 125px; overflow-y: scroll;" class="f10">
                        <?php
                        echo "<span class='colorGuindo f12 negrilla'>Trabaja en proyectos :</span><br>";
                        foreach ($proy[$usuario->cod_user]->result() as $p_user) {
                            echo "<span class='milinktext'>- " . $p_user->nombre . "</span><br>";
                        }
                        ?>
                    </div>


                    <div style="position: absolute; left:410px;top:40px;" class="boton_menu milink" title="menu de opciones" 
                         onclick=" if ($('#muestra<?php echo $usuario->cod_user; ?>').val() == 0) {
                                     $('#muestra<?php echo $usuario->cod_user; ?>').val(1);
                                     $('#botones<?php echo $usuario->cod_user; ?>').removeClass('ocultar');
                                 } else {
                                     $('#muestra<?php echo $usuario->cod_user; ?>').val(0);
                                     $('#botones<?php echo $usuario->cod_user; ?>').addClass('ocultar');
                                 }">
                        <input id='muestra<?php echo $usuario->cod_user; ?>' type="hidden" value='0'>

                    </div>
                    <div style="position: absolute; left: 375px;top:65px; width: 60px;height: 155px" class="fondo_plomo_claro_areas ocultar" id='botones<?php echo $usuario->cod_user; ?>'>
                        <!--                        <div class="boton_editar_usuario_credencial milink" style="display: block-inline; float: left;" title="datos personales Uuario"
                                                     onclick="dialog_contenidos_nuevo_usuario('div_formularios_dialog', '<?php echo base_url() . "usuario/usuario_nuevo/" . $usuario->cod_user; ?>')"></div>-->
                        <div class="boton_editar_usuario_credencial milink" style="display: block-inline; float: left;" title="datos personales Uuario"
                             onclick="dialog_curriculum('div_formularios_dialog', '<?php echo base_url() . "usuario/file_personal_form_tercero/" . $usuario->cod_user; ?>')"></div>

                        <div class="boton_editar_usuario_logros milink" style="display: block-inline; float: left;" title="Add Formacion"
                             onclick="dialog_curriculum('div_formularios_dialog', '<?php echo base_url() . "experiencia_laboral/experiencia_tercero/" . $usuario->cod_user; ?>')">  
                        </div>
                        <div class="boton_editar_usuario_academico milink" style="display: block-inline; float: left;" title="Add Formacion"
                             onclick="dialog_curriculum('div_formularios_dialog', '<?php echo base_url() . "estudios_personal/logros_academicos_terceros/" . $usuario->cod_user; ?>')">  
                        </div>
                        <div class="boton_editar_usuario_attach milink" style="display: block-inline; float: left;" title="Add Formacion"
                             onclick="">  
                        </div>

                        <div class="boton_editar_usuario milink" style="display: block-inline; float: left;" title="Editar Usuario"
                             onclick="dialog_contenidos_nuevo_usuario('div_formularios_dialog', '<?php echo base_url() . "usuario/usuario_nuevo/" . $usuario->cod_user; ?>')"></div>

                        <div class="boton_ver_usuario milink" style="display: block-inline; float: left;" title="Ver Usuario"
                             onclick="dialog_ver_usuario('div_formularios_dialog', '<?php echo base_url() . "usuario/ver_usuario/" . $usuario->cod_user; ?>')"></div>

                        <div class="permisos_icono milink" style="display: block-inline; float: left;"  title="Permisos"
                             onclick="dialog_form_permisos('div_formularios_dialog', '<?php echo base_url() . "perfiles/form_asigna_perfiles/" . $usuario->cod_user; ?>')"></div> 

                    </div>

                    <?php echo $Codigo_inactivo; ?>


                </div>   

            </div>




            <?php
        }
        ?>

    </div>

    <?php
} else
    echo '';
?>

<div id="div_formularios_dialog" class="formulario_nuevo_menu ocultar" style="height: 300px; width: 400px;">cargando...</div>

<!--->






<!-- aqui se muestra los registros con un foreach -->
<!---
<?php
//  if ($total_registros != 0) {
?>
        <div class="grid_20 fondo_azul colorAmarillo borde_abajo borde_arriba  negrilla f14" style="width: 100%">            
            <div class=" negrilla alin_cen" style="display: block-inline;float: left; width: 10% ">ID</div>
            <div class="negrilla" style="display: block-inline;float: left; width: 15%">NOMBRE</div>
            <div class="negrilla"style="display: block-inline; float: left; width: 10%">CI</div>
            <div class="negrilla"style="display: block-inline; float: left; width: 10%">USUARIO</div>
<!--  <div class="negrilla" style="display: block-inline; float: left; width: 10%">LOGIN</div>
  <div class="negrilla" style="display: block-inline; float: left; width: 10%">TELF</div>
  <div class="negrilla" style="display: block-inline; float: left; width: 10%">ESTADO</div>
</div>
-->
    <?php /*
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
---!>
