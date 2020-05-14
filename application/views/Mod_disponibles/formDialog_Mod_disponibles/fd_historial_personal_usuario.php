
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
            <div class="clear"></div>
            <div class="clear"></div>
            <div class="grid_2 esparriba alinearDerecha">Proyecto atual: </div>
            <div class="grid_4 esparriba"><input  id="proyecto_empleado" class="textChico" type="text" readonly="readonly" value="<?php echo $datos_registro->proy; ?>"></div>
            <div class="clear"></div>
            <div class="grid_5 prefix_05 suffix_05 esparriba ">
                <div class="grid_5 " id="historialUsuario">
                    <?php
                    $fest="fondoplomoblanco";
                    if ($Historial->num_rows() > 0) {
                        foreach ($Historial->result() as $fila) {
                            if($fest!="fondoplomoblanco")
                                $fest="fondoplomoblanco";
                            else
                                $fest="";
                                
                            echo "<div class='grid_5 bordeArriba $fest '>
                                             <div class='grid_5 negrilla'><span class='letrachica rojo'>$fila->fecha_registro</span> -- " . $fila->tipo_registro . " --</div>   
                                             <div class='grid_1 prefix_05 negrilla azulmarino letrachica'>proyecto.-</div><div class='grid_3 letrachica suffix_05'>" . $fila->proyecto . "</div> 
                                             <div class='grid_1 prefix_05 negrilla azulmarino letrachica'>cargo.-</div><div class='grid_3 letrachica suffix_05 '>" . $fila->cargo. "</div> 
                                             <div class='grid_1 prefix_05 negrilla azulmarino letrachica'>Comentario.-</div><div class='grid_3 letrachica suffix_05'>" . $fila->comentario . "</div> 
                                     </div>";
                        }
                    }
                    else
                        echo "<span class='rojo'>No se han encontrado registros de historial</span>";
                    ?>                                     
                </div>
            </div>
        </div>
    </li>
</ol>
