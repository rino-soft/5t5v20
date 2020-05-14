
    <ol>
        <li>
            <div class="grid_6">
                <div class="grid_5_5 prefix_025 suffix_025 esparriba"><div id="error_de_formulario" class=" grid_5_5 NO oculto"></div></div>

                <input id="id_registro" type="hidden" value="<?php echo  $datos_registro->idpk;?>">   
                <div class="grid_2 esparriba alinearDerecha">CI:</div>
                <div class="grid_4 esparriba"> 
                    <input id="id_empleado"  type="hidden" value="<?php echo $datos_registro->cod_user;?>"> 
                    <input id="ci_empleado" class="textChico" type="text" readonly="readonly" value="<?php echo $datos_registro->ci;?>">
                </div>
                <div class="clear"></div>
                <div class="grid_2 esparriba alinearDerecha">Nombre Completo: </div>
                <div class="grid_4 esparriba"><input  id="nombre_empleado" class="textMedio letrachica" type="text" readonly="readonly" value="<?php echo $datos_registro->Nomcomp; ?>" ></div>
                <div class="clear"></div>
                <div class="clear"></div>
                <div class="grid_2 esparriba alinearDerecha">Proyecto: </div>
                <div class="grid_4 esparriba"><input  id="proyecto_empleado" class="textChico" type="text" readonly="readonly" value="<?php echo $datos_registro->proy;?>"></div>
                <div class="clear"></div>
                <div class="grid_2 esparriba alinearDerecha">Fecha de Baja :</div>
                <div class="grid_4 esparriba" > <input id="Fecha_baja" name="Fecha_alta" maxlength="10" value="" class="textChico" type="text"> 
                    <script>  $(function() { $( "#Fecha_baja" ).datepicker({}); }); </script>(en el Proyecto)
                </div>

                <div class='grid_6 esparriba'> Que hacer con los dependientes de este personal : </div>
                <div class='grid_6 esparriba' id='accion_dependientes'>
                    <div class='grid_5  alinearDerecha '>Mover los dependientes al inmediato superior</div>
                    <div class='grid_1'><input type='radio' name='acciondependientes' value='1' > </div>
                    <div class='grid_5  alinearDerecha '>Dar de baja en el proyecto a los dependietes y sus dependientes </div>
                    <div class='grid_1 '> <input type='radio' name='acciondependientes' value='0' > </div> 
                </div>

                <div class="grid_2 esparriba alinearDerecha letrachica">Motivo de Baja:</div>
                <div class="grid_4 esparriba"> 
                    <div class="grid_4"><textarea id="comentario" class="" onkeyup="javascript:limitecaracter('comentario',100)"></textarea></div>
                    <div class="grid_4 letrachica alinearDerecha" id="comentarioref">disponibles ,100 caracteres</div><!--Importante colocar el mismo nombre del textarea>> nombre + ref aqui-->


                </div>
                <div class="clear"></div>
            </div>
        </li>
    </ol>
