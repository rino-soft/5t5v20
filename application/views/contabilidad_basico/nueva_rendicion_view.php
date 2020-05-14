<?php 
    $monto="";
   /// $nro_fact="";
    $desc="";
    $asignado="";
    $personal="";
    
    if($id_rend!=0){
        $monto=$datos_rendicion->row()->monto;
       // $nro_fac=$datos_rendicion->row()->monto;
        $desc=$datos_rendicion->row()->observacion;
        $asignado=$datos_rendicion->row()->id_proy;
        $personal=$datos_rendicion->row()->id_tecnico_asignado;
    }
?>

<div class="">


    <input id="id_rend" type="hidden" value="<?php echo $id_rend; ?>">

    <div class=" grid_15 colorcel negrilla alin_cen">REGISTRAR FORMULARIO</div>
    <div class="grid_15">
            <div class="letraChica grid_3" style="">Fecha del Registro</div>
            <input class="input_redond_200" type="text" id="fechaS" readonly="readonly" value=" <?php echo date("Y-m-d H:i:s");?>" placeholder="">  
   </div>
    <div class="grid_16" style="padding-top: 17px;">
        <div class="grid_7 " >
            <div class="letraChica "> <br>Proyecto :
                <select id="proyecto_seleccionado">
                    <?php
                   foreach ($selec_proyecto->result() as $dato) {
                       if ($dato->id_proy == $asignado)
                           echo '<option selected="selected" value="' . $dato->id_proy . '">' . $dato->nombre . '</option>';
                       else
                           echo ' <option value="' . $dato->id_proy . '">' . $dato->nombre . '</option>';
                   }
                   ?>

                </select> 
            </div>
        </div>
        <div class="grid_9 " >
            <div class="letraChica "> <br> Tecnico :
                <select id="tecnico_seleccionado">
                    <?php
                   foreach ($selec_tecnico->result() as $dato) {
                       if ($dato->cod_user == $personal)
                           echo '<option selected="selected" value="' . $dato->cod_user . '">' . $dato->ap_paterno .' '.$dato->ap_materno .', '.$dato->nombre.'</option>';
                       else
                           echo ' <option value="' . $dato->cod_user . '">' . $dato->ap_paterno .' '.$dato->ap_materno .', '.$dato->nombre.'s</option>';
                   }
                   ?>

                </select> 
            </div>
        </div>
        
        
    </div>
    
  
    <div class="grid_16 esparriba10">
        
         <div id="grilla_modelo" class="oculto">
             
            <div class="grid_3">
                        <div class="letraChica ">
                            XX Tipo de Formulario
                        </div>
                        <div class="esparriba5">
                            <select id="tipo_gasto_for" onchange="carga_tipo_gasto('drXX #tipo_gasto_for','selec_tipo_servg','drXX #gasto_bloque',0);">
                                <option value="-1">seleccione...</option>
                                <option value="1"> Transporte </option>
                                <option value="2"> S.Generales </option>
                                <option value="3"> Telefonia </option>
                            </select> 
                        </div>
            </div>
            <div class="grid_6" id="gasto_bloque">
                    <div class="letraChica">
                        Tipo de Gasto
                    </div>
                    <div class="esparriba5">
                        <select id="selec_tipo_servg">
                           <option value="0">seleccione tipo...</option>
                        </select>
                        <script>carga_tipo_gasto('tipo_gasto_for','selec_tipo_servg','gasto_bloque',0);</script>
                    </div>
            </div>


            <div class="grid_2">
                <div class="f11 letraChica">Monto (bs)</div>
                <input class="input_redond_100_c" type="text" id="monto" onkeyup="val_numero('drXX #monto')"   placeholder="Ej. 500.50" value="<?php //echo $monto ?>">
              
            </div>
            <div class="grid_1 ">
                <div class="f11 letraChica esparriba5">Factura</div>
                SI <input type="checkbox" name="resp"  value="1" id="fac" >
            </div>
             <div class="grid_2">
                <div class="f11 letraChica">Nro Factura</div>
                <input class="input_redond_100_c" type="text" id="nro_fact" placeholder="Ej. 2121" value="<?php //echo nro_fact; ?>">
            </div>
             <div class=" grid_1 esparriba15">
                 <div class="delete_ico" onclick="del_registro_rendicion('XX')"></div>
             </div>
             
        </div>
        
        <input type="hidden" id="nro_reg" value="0">
        <input type="hidden" id="items_select" value="0">
        
   
        <div class="grid_15 esparriba10" id="add_nuevo_rendicion">    
        <?php
        if($id_rend!=0)
        {
            $cont=0;
            $cadena="0";
        
            foreach ($datos_rendicion_detalle->result() as $fila)
            {   
                $cont++;
                $cadena.=",".$cont;
              //  echo $cont.'--->'.$cadena.'<br>';
                ?>
                <div id="dr<?php echo $cont; ?>" class="">
            <div class="grid_3">
                        <div class="letraChica ">
                           <?php echo $cont; ?> Tipo de Formulario
                        </div>
                        <div class="esparriba5">
                            <select id="tipo_gasto_for" onchange="carga_tipo_gasto('dr<?php echo $cont.'';?> #tipo_gasto_for','selec_tipo_servg','dr<?php echo $cont;?> #gasto_bloque',0);">
                                <option value="-1"  >seleccione...</option>
                                <option value="1" <?php if($fila->tipo=="tra") echo "selected='selected' "; ?> > Transporte </option>
                                <option value="2" <?php if($fila->tipo=="sgr") echo "selected='selected' "; ?> > S.Generales </option>
                                <option value="3" <?php if($fila->tipo=="tel") echo "selected='selected' "; ?> > Telefonia </option>
                            </select> 
                        </div>
                       
            </div>
            <div class="grid_6" id="gasto_bloque">
                    <div class="letraChica">
                        Tipo de Gasto
                    </div>
                    <div class="esparriba5">
                        <select id="selec_tipo_servg">
                           <option value="0">seleccione tipo...</option>
                        </select>
                        <script>carga_tipo_gasto('tipo_gasto_for','selec_tipo_servg','gasto_bloque',0);</script>
                    </div>
            </div>
<script> carga_tipo_gasto('dr<?php echo $cont;?> #tipo_gasto_for','selec_tipo_servg','dr<?php echo $cont;?> #gasto_bloque',<?php echo $fila->id_tipo_gasto; ?>);</script>

            <div class="grid_2">
                <div class="f11 letraChica">Monto (bs)</div>
                <input class="input_redond_100_c" type="text" id="monto" onkeyup="val_numero('dr<?php echo $cont;?> #monto')" placeholder="Ej. 500" value="<?php echo $fila->monto ?>">
            </div>
            <div class="grid_1 ">
                <div class="f11 letraChica esparriba5">Factura</div>
                SI <input type="checkbox" name="resp" <?php if($fila->c_s_factura==1) echo'checked="checked"'; ?>  value="1" id="fac" >
            </div>
             <div class="grid_2">
                <div class="f11 letraChica">Nro Factura</div>
                <input class="input_redond_100_c" type="text" id="nro_fact" placeholder="Ej. 2121" value="<?php echo $fila->nro_fac; ?>">
            </div>
             <div class=" grid_1 esparriba15">
                 <div class="delete_ico" onclick="del_registro_rendicion('<?php echo $cont; ?>')"></div>
             </div>
             
        </div>
             <?php   
           
             
            }
            ?>
            <script>
                $("#nro_reg").val('<?php echo $cont ?>');
                $("#items_select").val('<?php echo $cadena ?>');
            </script>
            <?php
            
            
            
            
        }
        else
        { ?><script>add_registro();</script> <?php }
        ?>
        </div>
             
        <div class=" grid_1 esparriba20"><div class="boton centrartexto" onclick="add_registro()">+</div></div>
      
    
    </div>
    
    
    <div class="grid_15 "style="padding-top: 20px" >
        <textarea class="textarea_redond_382x65" type="text" id="desc" placeholder=""   placeholder="Escriba una descripción" ><?php echo $desc; ?></textarea>
        <div class="f11 letraChica"> Descripción</div>
    </div>

    <div id="respuesta"></div>
    <script>cambios();</script>


</div>







