

<ol><li>
        <div class="grid_6">
            <div class="grid_5_5 prefix_025 suffix_025 esparriba" ><div id="error_de_formulario" class=" grid_5_5 NO oculto"></div></div>

            <!-- 
            //apc.idpk , a.codadm_pk ,a.ci, CONCAT(a.nombre,' ' ,a.apellidos) as Nomcomp,
        // d.nombre as proy, d.id as id_proy , apc.id_padre ,apc.regional,apc.cargo, apc.es_padre, apc.fecha_asignacion
            -->

            <input id="id_registro" type="hidden" value="<?php echo $datos_registro['idpk']; ?>">   
            <div class="grid_2 esparriba alinearDerecha">CI:</div>
            <div class="grid_3 esparriba"> 
                <input id="id_empleado"  type="hidden" value="<?php echo $datos_personal['cod_user']; ?>" > 
                <input id="ci_empleado" class="textChico" type="text" <?php echo $bloqueo; ?>  value="<?php echo $datos_personal['ci']; ?>" >
            </div>
            <div class="grid_1 alin_cen negrilla">Id Reg : <?php echo $datos_registro['idpk']; ?></div>
            <div class="clear"></div>
            <div class="grid_2 esparriba alinearDerecha">Nombre Completo: </div>
            <div class="grid_4 esparriba"><input  id="nombre_empleado" class="textMedio letrachica" type="text" readonly="readonly" value="<?php echo $datos_personal['comComp']; ?>"></div>
            <div class="clear"></div>
            <div class="clear"></div>
            <div class="grid_2 esparriba alinearDerecha">Proyecto: </div>
            <div class="grid_4 esparriba"><input  id="proyecto_empleado" class="textMedio" type="text" readonly="readonly" value="<?php echo $proy_nom; ?>"></div>
            <div class="clear"></div>
            <div class="clear"></div>


            <div class="grid_2 esparriba alinearDerecha">Inmediato Superior :</div>
            <div class="grid_4 esparriba"><div id="div_jefesProyecto"><?php echo $listajefes; ?></div> </div>
            <div class="clear"></div>
            <div class="grid_2 esparriba alinearDerecha">Regional: </div>
            <div class="grid_4 esparriba">
                <?php echo $depto_seleccionado; ?>
                <select name="regional" class="textMedio" id="regional">
                    <option value="0">seleccione su Regional</option>    
                    <?php
                    foreach ($deptos as $dep) {
                        $sel = '';
                        if ($depto_seleccionado == $dep->id)
                            $sel = ' selected="selected" ';
                        ?>
                        <option value="<?php echo $dep->id; ?>" <?php echo $sel; ?> ><?php echo $dep->nombre; ?></option><?php
                    }
                    ?>
                </select>
            </div>
            <div class="clear"></div>
            <div class="grid_2 esparriba alinearDerecha">Cargo :</div>
            <div class="grid_4 esparriba"> 
                <select id="cargos" onchange="mostrar_nuevo_cargo();">
                    <?php
                    foreach ($cargo_empleado as $cargo) {
                        $sel = '';
                        if ($cargo_seleccionado == $cargo->cargo)
                            $sel = ' selected="selected" ';
                        echo "<option value='$cargo->cargo' $sel >$cargo->cargo</option>";
                    }
                    ?>
                    <option value="0otro0" class="blanco_text negrilla fondoazul " >Nuevo Cargo</option>
                </select>

            </div>
            <div class="grid_4 prefix_2 esparriba"  >
                <div id="cargo_empleado_otro" class="oculto">
                    <input   id="cargo_empleado_otro_campo" value="" class="textMedio" type="text" placeholder="Escriba el nuevo Cargo"></div>
            </div>
            <div class="clear"></div>
            <div class="grid_2 esparriba alinearDerecha">Tiene Dependientes ? </div> 
            <div class="grid_3 esparriba centrartexto" id="depend">
                SI<input type="radio" name="dependiente" id="dependiente1" value="1" <?php if ($espadre == 1) echo ' checked="checked" '; ?> <?php echo $event_edit_es_padre; ?> > 
                NO <input type="radio" name="dependiente" id="dependiente0" value="0" <?php if ($espadre == 0) echo ' checked="checked" '; ?> <?php echo $event_edit_es_padre; ?>>
            </div>
            <div class="clear"></div>
            <div class='grid_6' id='tiene_dependientes'> <input type='hidden' id='tieneDependientes' value='no'></div>
            <div class="grid_2 esparriba alinearDerecha">Fecha de Alta :</div>
            <div class="grid_4 esparriba" > <input id="Fecha_alta" name="Fecha_alta" maxlength="10" value="<?php echo $fecha_asig; ?>" class="textChico" type="text"> 
                <script>  $(function () {
                            $("#Fecha_alta").datepicker({});
                        });</script>(en el Proyecto)
            </div>
            <div class="grid_2 esparriba alinearDerecha letrachica">Descripcion de las actividades que realizara el personal:</div>
            <div class="grid_4 esparriba"> 
                <div class="grid_4"><textarea id="comentario" class="" onkeyup="javascript:limitecaracter('comentario', 100)"></textarea></div>
                <div class="grid_4 letrachica alinearDerecha" id="comentarioref">disponibles ,100 caracteres</div><!--Importante colocar el mismo nombre del textarea>> nombre + ref aqui-->


            </div>
            <div class="clear"></div>

        </div>

    </li></ol>
