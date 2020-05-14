<div class="container_12">
<ol>
    <li>
        <div class="grid_6">
            <div class="grid_2 esparriba alinearDerecha">CI:</div>
            <div class="grid_4 esparriba"> 
                <input id="id_empleado"  type="hidden" value=""> 
                <input id="ci_empleado" class="textChico" type="text" readonly="readonly" value="<?php echo $datos_registro->ci; ?>">
            </div>
            <div class="clear"></div>
            <div class="grid_2 esparriba alinearDerecha">Nombre Completo: </div>
            <div class="grid_4 esparriba"><input  id="nombre_empleado" class="textMedio letrachica" type="text" readonly="readonly" value="<?php echo $datos_registro->Nomcomp; ?>"></div>
           <!-- <div class="clear"></div>-->
            <div class="clear"></div>
            <div class="grid_6 esparriba negrilla">Permisos otorgados actualmente <span class="negrilla rojo letrachica">(valido solo si tiene Dependientes)</span>: </div>
            <div class="clear"></div>
            <?php //echo "da vacaciones=".$datos_registro->da_vac_per;?>
            <?php
            $llave = false;
            if ($permisos_usuario->num_rows() > 0) {
                $permiso = $permisos_usuario->row();
                $llave = true;
            }
            if ($llave) {
                ?>
                <div class="grid_5 prefix_05 suffix_05 esparriba letrachica ">
                    <div class="grid_5  negrilla azulmarino">Permisos en bandejas </div>
                    <div class="grid_4">Podra otorgar autorizaciones de Vacaciones/Permisos a cuenta de vacacion?</div>
                    <?php
                    $disabled = "";
                    $chec1 = "";
                    $chec2 = "checked=checked";
                    if ($datos_registro->p_vac_per > 0) {
                        $chec1 = "checked=checked"; //permisos del registro a modificar
                        $chec2 = "";
                    }

                    $codigo_genera = '<div class="grid_1 centrartexto negrilla ">SI<input type="radio" name="pbandeja_vacaciones" value="1" ' . $disabled . ' ' . $chec1 . '> NO<input type="radio" name="pbandeja_vacaciones" value="0" ' . $disabled . ' ' . $chec2 . '></div>';
                    if ($permiso->p_vac_per < 1) {
                        $disabled = "disabled='disabled'"; // permisos del due;o de la cuenta
                        $codigo_genera = '<div class="grid_1 centrartexto negrilla rojo">Sin Permiso</div>';
                    }
                    ?>    
                    <?php echo $codigo_genera; ?>
                    <div class="grid_4 bordeArriba">Podra otorgar autorizaciones de Justificacion de Marcado?</div>
                    <?php
                    $disabled = "";
                    $chec1 = "";
                    $chec2 = "checked=checked";
                    if ($datos_registro->p_jus > 0) {
                        $chec1 = "checked=checked"; //permisos del registro a modificar
                        $chec2 = "";
                    }
                    $codigo_genera = '<div class="grid_1 centrartexto negrilla bordeArriba ">SI<input type="radio" name="pbandeja_justificacion" value="1" ' . $disabled . ' ' . $chec1 . '> NO<input type="radio" name="pbandeja_justificacion" value="0" ' . $disabled . ' ' . $chec2 . '></div>';
                    if ($permiso->p_jus < 1) {
                        $disabled = "disabled='disabled'"; // permisos del due;o de la cuenta
                        $codigo_genera = '<div class="grid_1 centrartexto negrilla rojo bordeArriba">Sin Permiso</div>';
                    }
                    ?> 
                    <?php echo $codigo_genera; ?>                  
                    <div class="grid_4 bordeArriba">Podra otorgar autorizaciones de Bajas Medicas?</div>

                    <?php
                    $disabled = "";
                    $chec1 = "";
                    $chec2 = "checked=checked";
                    if ($datos_registro->p_baj_med > 0) {
                        $chec1 = "checked=checked"; //permisos del registro a modificar
                        $chec2 = "";
                    }

                    $codigo_genera = '<div class="grid_1 centrartexto negrilla bordeArriba ">SI<input type="radio" name="pbandeja_baja_medica" value="1" ' . $disabled . ' ' . $chec1 . '> NO<input type="radio" name="pbandeja_baja_medica" value="0" ' . $disabled . ' ' . $chec2 . '></div>';
                    if ($permiso->p_baj_med < 1) {
                        $disabled = "disabled='disabled'"; // permisos del due;o de la cuenta
                        $codigo_genera = '<div class="grid_1 centrartexto negrilla rojo bordeArriba">Sin Permiso</div>';
                    }
                    ?> 
                    
                    <?php echo $codigo_genera; ?>  
<!--                    //// mmmmmmmmmmmmmmmmmmmmnew-->
                    <div class="grid_4 bordeArriba">Podra Revisar/Autorizar rendiciones/reembolsos?</div>

                    <?php
                    $disabled = "";
                    $chec1 = "";
                    $chec2 = "checked=checked";
                    if ($datos_registro->p_rev_rend > 0) {
                        $chec1 = "checked=checked"; //permisos del registro a modificar
                        $chec2 = "";
                    }

                    $codigo_genera = '<div class="grid_1 centrartexto negrilla bordeArriba ">SI<input type="radio" name="prev_rend" value="1" ' . $disabled . ' ' . $chec1 . '> NO<input type="radio" name="prev_rend" value="0" ' . $disabled . ' ' . $chec2 . '></div>';
                    if ($permiso->p_rev_rend < 1) {
                        $disabled = "disabled='disabled'"; // permisos del due;o de la cuenta
                        $codigo_genera = '<div class="grid_1 centrartexto negrilla rojo bordeArriba">Sin Permiso</div>';
                    }
                    ?> 
                    <?php echo $codigo_genera; ?>
                    
                    <!--                    //// mmmmmmmmmmmmmmmmmmmmnew-->
                    <div class="grid_3 bordeArriba">Enviar los reembolsos/rendiciones a :</div>

                    <?php
                    $disabled = "";
                    $chec1 = "";
                    $chec2 = "checked=checked";
                    if ($datos_registro->env_rend == 'superior') {
                        $chec1 = "checked=checked"; //permisos del registro a modificar
                        $chec2 = "";
                    }

                    $codigo_genera = '<div class="grid_2 centrartexto negrilla bordeArriba alinearDerecha ">Responsable superior<input type="radio" name="env_rend" value="superior" ' . $disabled . ' ' . $chec1 . '>Contabilidad<input type="radio" name="env_rend" value="contabilidad" ' . $disabled . ' ' . $chec2 . '></div>';
                    if ($permiso->p_rev_rend < 1) {
                        $disabled = "disabled='disabled'"; // permisos del due;o de la cuenta
                        $codigo_genera = '<div class="grid_1 centrartexto negrilla rojo bordeArriba">Sin Permiso</div>';
                    }
                    ?> 
                    <?php echo $codigo_genera; ?> 
                    
                    
                    <div class="grid_5  negrilla azulmarino bordeArriba ">Permisos en arbol de dependientes</div>
                    <div class="grid_4 "><div class="menubotones_adicionar divIzq"></div>Adicionar personal dependiente?</div>
                    <?php
                    $disabled = "";
                    $chec1 = "";
                    $chec2 = "checked=checked";
                    if ($datos_registro->p_adicionar > 0) {
                        $chec1 = "checked=checked"; //permisos del registro a modificar
                        $chec2 = "";
                    }
                    $codigo_genera = '<div class="grid_1 centrartexto negrilla ">SI<input type="radio" name="parbol_adicionar" value="1" ' . $disabled . ' ' . $chec1 . '> NO<input type="radio" name="parbol_adicionar" value="0" ' . $disabled . ' ' . $chec2 . '></div>';
                    if ($permiso->p_adicionar < 1) {
                        $disabled = "disabled='disabled'"; // permisos del due;o de la cuenta
                        $codigo_genera = '<div class="grid_1 centrartexto negrilla rojo">Sin Permiso</div>';
                    }
                    ?> 

                    <?php echo $codigo_genera; ?>  
                    <div class="grid_4 bordeArriba"><div class="menubotones_eliminar divIzq"></div>Baja personal dependiente?</div>
                    <?php
                    $disabled = "";
                    $chec1 = "";
                    $chec2 = "checked=checked";
                    if ($datos_registro->p_baja > 0) {
                        $chec1 = "checked=checked"; //permisos del registro a modificar
                        $chec2 = "";
                    }

                    $codigo_genera = ' <div class="grid_1 centrartexto negrilla bordeArriba ">SI<input type="radio" name="parbol_baja" value="1" ' . $disabled . ' ' . $chec1 . '> NO<input type="radio" name="parbol_baja" value="0" <?php ech' . $disabled . ' ' . $chec2 . '></div>';
                    if ($permiso->p_baja < 1) {
                        $disabled = "disabled='disabled'"; // permisos del due;o de la cuenta
                        $codigo_genera = '<div class="grid_1 centrartexto negrilla rojo bordeArriba">Sin Permiso</div>';
                    }
                    ?> 
                    <?php echo $codigo_genera; ?>  
                    <div class="grid_4 bordeArriba"><div class="menubotones_editar divIzq"></div>Edicion personal dependiente?</div>
                    <?php
                    $disabled = "";
                    $chec1 = "";
                    $chec2 = "checked=checked";
                    if ($datos_registro->p_editar > 0) {
                        $chec1 = "checked=checked"; //permisos del registro a modificar
                        $chec2 = "";
                    }

                    $codigo_genera = '<div class="grid_1 centrartexto negrilla bordeArriba ">SI<input type="radio" name="parbol_editar" value="1" ' . $disabled . ' ' . $chec1 . '> NO<input type="radio" name="parbol_editar" value="0" ' . $disabled . ' ' . $chec2 . '></div>';
                    if ($permiso->p_editar < 1) {
                        $disabled = "disabled='disabled'"; // permisos del due;o de la cuenta
                        $codigo_genera = '<div class="grid_1 centrartexto negrilla rojo bordeArriba">Sin Permiso</div>';
                    }
                    ?> 
                    <?php echo $codigo_genera; ?>  
                    <div class="grid_4 bordeArriba"><div class="menubotones_historial divIzq"></div>Ver historial personal dependiente?</div>

                    <?php
                    $disabled = "";
                    $chec1 = "";
                    $chec2 = "checked=checked";
                    if ($datos_registro->p_ver_historial > 0) {
                        $chec1 = "checked=checked"; //permisos del registro a modificar
                        $chec2 = "";
                    }
                    $codigo_genera = '<div class="grid_1 centrartexto negrilla bordeArriba ">SI<input type="radio" name="parbol_historial" value="1" ' . $disabled . ' ' . $chec1 . '> NO<input type="radio" name="parbol_historial" value="0" ' . $disabled . ' ' . $chec2 . '></div>';
                    if ($permiso->p_ver_historial < 1) {
                        $disabled = "disabled='disabled'"; // permisos del due;o de la cuenta
                        $codigo_genera = '<div class="grid_1 centrartexto negrilla rojo bordeArriba">Sin Permiso</div>';
                    }
                    ?> 
                    <?php echo $codigo_genera; ?>   
                    <div class="grid_5 importante">
                        <div class="grid_5 rojo ">Importante</div>
                        <div class="grid_4 "><div class="menubotones_permiso divIzq"></div>Dar Permisos para que el Personal dependiente pueda otorgar permisos a sus dependientes?</div>
                        <?php
                        $disabled = "";
                        $chec1 = "";
                        $chec2 = "checked=checked";
                        $oculto = "oculto";
                        if ($datos_registro->p_otorgar_permisos > 0) {

                            $chec1 = "checked=checked"; //permisos del registro a modificar
                            $chec2 = "";
                            $oculto = "";
                        }
                        $codigo_genera = '<div class="grid_1 centrartexto negrilla ">SI<input type="radio" name="parbol_permisos" onclick="ver_permisos_a_otorgar(1);" value="1" ' . $disabled . ' ' . $chec1 . '>
                        NO<input type="radio" name="parbol_permisos" value="0" onclick="ver_permisos_a_otorgar(0);" ' . $disabled . ' ' . $chec2 . '></div>';
                        if ($permiso->p_otorgar_permisos < 1) {
                            $disabled = "disabled='disabled'"; // permisos del due;o de la cuenta
                            $codigo_genera = '<div class="grid_1 centrartexto negrilla rojo">Sin Permiso</div>';
                            $oculto = "oculto";
                        }
                        ?> 
                        <?php echo $codigo_genera; ?>  
                        <div class="grid_5 <?php echo $oculto; ?>" id="permisos_a_otorgar">
                            <?php
                            $chec1 = "";
                            $chec2 = "checked=checked";
                             $name='ppp_vac_per';
                            if ($datos_registro->pp_vac_per > 0) {
                                $chec1 = "checked=checked"; //permisos del registro a modificar
                                $chec2 = "";
                            }
                            $codigo_genera = '<div class="grid_2">SI<input type="radio" name="'.$name.'" value="1" ' . $chec1 . ' > NO<input type="radio" name="'.$name.'" value="0" ' . $chec2 . '></div>';
                            if ($permiso->pp_vac_per < 1) {
                                $disabled = "disabled='disabled'"; // permisos del due;o de la cuenta
                                $codigo_genera = '<div class="grid_2 rojo">Sin Permiso</div>';
                            }
                            ?>
                            <div class="grid_2 alinearDerecha espderecha ">Vacaciones / permisos</div>
                            <?php echo $codigo_genera; ?>

                           
                            <?php
                            $chec1 = "";
                            $chec2 = "checked=checked";
                            $name='ppp_jus';
                            if ($datos_registro->pp_jus > 0) {
                                $chec1 = "checked=checked"; //permisos del registro a modificar
                                $chec2 = "";
                            }
                          $codigo_genera = '<div class="grid_2">SI<input type="radio" name="'.$name.'" value="1" ' . $chec1 . ' > NO<input type="radio" name="'.$name.'" value="0" ' . $chec2 . '></div>';
                            if ($permiso->pp_jus < 1) {
                                $disabled = "disabled='disabled'"; // permisos del due;o de la cuenta
                                $codigo_genera = '<div class="grid_2 rojo">Sin Permiso</div>';
                            }
                            ?>
                            <div class="grid_2 alinearDerecha espderecha">Justificaiones</div>
                            <!--<div class="grid_2">SI<input type="radio" name="pbandejas" value="SI"> NO<input type="radio" name="pbandejas" value="NO"></div>-->
                             <?php echo $codigo_genera; ?>
                               
                            <?php
                            $chec1 = "";
                            $chec2 = "checked=checked";
                            $name='ppp_baj_med';
                            if ($datos_registro->pp_baj_med > 0) {
                                $chec1 = "checked=checked"; //permisos del registro a modificar
                                $chec2 = "";
                            }
                            $codigo_genera = '<div class="grid_2">SI<input type="radio" name="'.$name.'" value="1" ' . $chec1 . ' > NO<input type="radio" name="'.$name.'" value="0" ' . $chec2 . '></div>';
                            if ($permiso->pp_baj_med < 1) {
                                $disabled = "disabled='disabled'"; // permisos del due;o de la cuenta
                                $codigo_genera = '<div class="grid_2 rojo">Sin Permiso</div>';
                            }
                            ?>
                            <div class="grid_2 alinearDerecha espderecha">Bajas medicas</div>
                            <?php echo $codigo_genera; ?>
                            <?php
                            $chec1 = "";
                            $chec2 = "checked=checked";
                            $name='ppp_add';
                            if ($datos_registro->pp_baj_med > 0) {
                                $chec1 = "checked=checked"; //permisos del registro a modificar
                                $chec2 = "";
                            }
                            $codigo_genera = '<div class="grid_2">SI<input type="radio" name="'.$name.'" value="1" ' . $chec1 . ' > NO<input type="radio" name="'.$name.'" value="0" ' . $chec2 . '></div>';
                            if ($permiso->pp_baj_med < 1) {
                                $disabled = "disabled='disabled'"; // permisos del due;o de la cuenta
                                $codigo_genera = '<div class="grid_2 rojo">Sin Permiso</div>';
                            }
                            ?>
                            <div class="grid_2 alinearDerecha espderecha">Adicionar</div>
                            <?php echo $codigo_genera; ?>
                             <?php
                            $chec1 = "";
                            $chec2 = "checked=checked";
                            $name='ppp_baj';
                            if ($datos_registro->pp_baj_med > 0) {
                                $chec1 = "checked=checked"; //permisos del registro a modificar
                                $chec2 = "";
                            }
                            $codigo_genera = '<div class="grid_2">SI<input type="radio" name="'.$name.'" value="1" ' . $chec1 . ' > NO<input type="radio" name="'.$name.'" value="0" ' . $chec2 . '></div>';
                            if ($permiso->pp_baj_med < 1) {
                                $disabled = "disabled='disabled'"; // permisos del due;o de la cuenta
                                $codigo_genera = '<div class="grid_2 rojo">Sin Permiso</div>';
                            }
                            ?>
                            <div class="grid_2 alinearDerecha espderecha">Baja</div><?php echo $codigo_genera; ?>
                             <?php
                            $chec1 = "";
                            $chec2 = "checked=checked";
                            $name='ppp_edit';
                            if ($datos_registro->pp_edit > 0) {
                                $chec1 = "checked=checked"; //permisos del registro a modificar
                                $chec2 = "";
                            }
                            $codigo_genera = '<div class="grid_2">SI<input type="radio" name="'.$name.'" value="1" ' . $chec1 . ' > NO<input type="radio" name="'.$name.'" value="0" ' . $chec2 . '></div>';
                            if ($permiso->pp_edit< 1) {
                                $disabled = "disabled='disabled'"; // permisos del due;o de la cuenta
                                $codigo_genera = '<div class="grid_2 rojo">Sin Permiso</div>';
                            }
                            ?>
                            <div class="grid_2 alinearDerecha espderecha ">Edicion</div><?php echo $codigo_genera; ?>
                             <?php
                            $chec1 = "";
                            $chec2 = "checked=checked";
                            $name='ppp_hist';
                            if ($datos_registro->pp_hist > 0) {
                                $chec1 = "checked=checked"; //permisos del registro a modificar
                                $chec2 = "";
                            }
                            $codigo_genera = '<div class="grid_2">SI<input type="radio" name="'.$name.'" value="1" ' . $chec1 . ' > NO<input type="radio" name="'.$name.'" value="0" ' . $chec2 . '></div>';
                            if ($permiso->pp_hist < 1) {
                                $disabled = "disabled='disabled'"; // permisos del due;o de la cuenta
                                $codigo_genera = '<div class="grid_2 rojo">Sin Permiso</div>';
                            }
                            ?>
                            <div class="grid_2 alinearDerecha espderecha">Historial</div><?php echo $codigo_genera; ?>
                             <?php
                            $chec1 = "";
                            $chec2 = "checked=checked";
                            $name='ppp_perm';
                            if ($datos_registro->pp_perm > 0) {
                                $chec1 = "checked=checked"; //permisos del registro a modificar
                                $chec2 = "";
                            }
                            $codigo_genera = '<div class="grid_2">SI<input type="radio" name="'.$name.'" value="1" ' . $chec1 . ' > NO<input type="radio" name="'.$name.'" value="0" ' . $chec2 . '></div>';
                            if ($permiso->pp_perm < 1) {
                                $disabled = "disabled='disabled'"; // permisos del due;o de la cuenta
                                $codigo_genera = '<div class="grid_2 rojo">Sin Permiso</div>';
                            }
                            ?>
                            <div class="grid_2 alinearDerecha espderecha">Permiso</div><?php echo $codigo_genera; ?>
                        </div>

                    </div>

                </div>
            <?php } ?>
        </div>
    </li>
</ol>
    </div>