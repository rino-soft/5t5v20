<div class="grid_7">
       

    <div class="grid_7 " id="sidetree">
        <ul id="browser" class="filetree">
       <script> $("#browser").treeview();</script>
            <li class="collapsable"><div class="hitarea expandable-hitarea"></div>
                <span class='folder'> 
                    <div class="blanco_text fondoazul">  
                        <?php
                        if($permisos_usuario->num_rows()>0)
                             $permiso=$permisos_usuario->row();
                        if($permiso->p_adicionar>0 and $permiso->es_padre>0)
                        {?>
                            <div class='menubotones_adicionar milink' style="margin-top: 10px; margin-right: 10px;" title="Adicionar dependiente directo del personal"
                                 onclick="Dialog_altaPersonalProyecto_jefeDirecto(<?php echo $id_user; ?>);"></div>   
                        <?php }?>
                        <div class='negrilla letraGrande'><?php echo $datos_usuario_inicial->nomComp ;?></div>
                        <div class='letrachica'><?php echo strtoupper($datos_usuario_inicial->cargo).' - '.$datos_usuario_inicial->proy.'(Regional :'.$datos_usuario_inicial->reg.')' ;?></div></span>
                </div>
                <?php echo $mi_propio_arbol; ?>
            </li>
            </ul>
        
    </div>
</div>