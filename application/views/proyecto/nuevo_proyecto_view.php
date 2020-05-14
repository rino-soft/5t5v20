<?php
$nombre="";
$descripcion="";
$estado="";
$fh_reg_proy="";
$cli_asignado="";
$asignado="";

  
if($id_proy!=0)
{
    
      $descripcion=$d_proyecto->row()->descripcion;
      $nombre=$d_proyecto->row()->nombre;
      $estado=$d_proyecto->row()->estado;
      $fh_reg_proy=$d_proyecto->row()->fh_reg_proy;
      $cli_asignado=$d_proyecto->row()->id_cliente;
      // $asignado=$d_contrato->row()->encargado_proy;
    
   
}
?>

<input id="id_proy" type="hidden" value="<?php echo $id_proy; ?>">
 <div id="respuesta"></div> 


    <div class="grid_20 espabajo10" style="">
                <div class="grid_20 fondo_azul colorAmarillo negrilla alin_cen f12">REGISTRAR PROYECTO</div>
                
                
                <div class="grid_20">

                    <div class="grid_5 f11 colorGuindo negrilla esparriba10"> Estado :
                        <select id="estado" value="">
                            <option value="Activo" <?php if($estado=="Activo") echo "selected='selected'";?>>Activo</option>
                            <option value="Inactivo" <?php if($estado=="Inactivo")  echo "selected='selected'";?>>Inactivo</option>
                        </select>
                    </div>
                    <div class="grid_8 esparriba10 colorGuindo negrilla"> Cliente :
                            <select id="id_cliente" onchange=""> 

                                                <?php
                                                foreach ($dato_cliente->result() as $cliente) {
                                                    if ($cliente->id_cliente == $cli_asignado)
                                                        echo '<option selected="selected" value="' . $cliente->id_cliente . '">' . $cliente->razon_social .  '</option>';
                                                    else
                                                        echo ' <option value="' . $cliente->id_cliente . '">' . $cliente->razon_social . '</option>';
                                                }
                                                ?>

                            </select>
                           <!-- <div class="f10 negrilla">Cliente</div>--->
                    </div>
                 
                </div>
        
        
                <div class="grid_20">
                    <div class=" grid_6 ">
                    
                        <input class="input_redond_250" type="text" id="nom_proy"   placeholder="Nombre del Proyecto" value="<?php  echo $nombre ;?>">
                        <div class="f11 colorAzul"> Nombre del Proyecto</div>
                    </div>
                     <div class=" grid_8">
                        <input class="input_redond_350" type="text" id="desc_proy"   placeholder="Descripcion del Proyecto" value="<?php  echo $descripcion ;?>">
                        <div class="f11 colorAzul"> Descripcion del Proyecto</div>
                    </div>
                    <div class="grid_5">
                        <div class="grid_5">
                           <input class="input_redond_180" id="fh_vigencia" placeholder="27/08/15" value="<?php echo $fh_reg_proy; ?>">
                           <div class=" f11 colorAzul">Fecha de vigencia</div>
                           <script>$("#fh_vigencia").datepicker();</script>
                        </div>
                    </div>
                </div>
        </div>
        
                    <div class=" grid_20 colorcel negrilla alin_cen espabajo10 esparriba10 ">REGISTRAR CONTRATO</div>           
                   
                        <div id="grilla_modelo" class="oculto fondo_plomo_claro_areas"  >
                            
                          <div class="fondo_amarillo_claro ">
                            <div class=" grid_20 espabajo5">
                                <div class="grid_4 f10 colorAzul">
                                     <div class="grid_2">Nro. Contrato:</div>
                                     <div class="grid_2">
                                         <input type="hidden" id="id_contrato" class="input_redond_100" value="0">
                                         <input type="text" id="nro_contrato" class="input_border_bottom tam100 " placeholder="5454">
                                     </div>
                                </div>
                                <div class="grid_4 f10 colorAzul">
                                    <div class="grid_2">Estado :</div>
                                    <div class="grid_2">
                                        <select id="estado_contrato" value="<?php //echo $estado;?>">
                                            <option>Activo</option>
                                            <option>Inactivo</option>
                                       </select>
                                    </div>
                                </div>
                                <div class="grid_8 f10 colorAzul">
                                    <div class="grid_4">Etapa</div>
                                    <div class="grid_4"><input type="text" id="etapa" class="input_border_bottom tam200 "  placeholder="" ></div>
                                </div>
                              
                            </div>  
                            <div class=" grid_20 espabajo5">
                                <div class="grid_4 f10 colorAzul">
                                   <div class="grid_2">Vigencia :</div>
                                   <div class="grid_2"><input type="text" id="vigencia" class="input_border_bottom tam100"  placeholder="90 dias"></div>
                                </div>
                                <div class="grid_4 f10 colorAzul">
                                    <div class="grid_2">Gestion :</div>
                                    <div class="grid_2">
                                    <select id="gestion">
                                    <?php
                                     $año=  date('Y');
                                     for ($i = $año; $i > $año-10; $i--) {
                                         if($fila->gestion_contrato==$i)
                                            echo '<option selected="selected" value="'.$i.'">'.$i.'</option>';
                                         else
                                             echo '<option  value="'.$i.'">'.$i.'</option>';
                                        // $año++;
                                     }
                                    ?></select>
                                    </div>
                                </div>
                               
                                <div class="grid_8 f10 colorAzul">
                                    <div class="grid_4">Descripción licitación :</div>
                                    <div class="grid_4"><input type="text" id="objeto" class="input_border_bottom tam200 "  placeholder="" ></div>  
                                </div>
                                <div class="grid_4 f10 colorAzul">
                                    <div class="grid_2 alin_cen">Nro. Licitación :</div>
                                    <div class="grid_2"><input type="text" id="nro_licitacion" class="input_border_bottom tam100 " placeholder="12/29"></div>
                                </div>
                            </div>
                            <div class=" grid_20 f10">
                                <div class="grid_4 colorAzul">
                                    <div class="grid_2">Importe :</div>
                                    <div class="grid_2"><input type="text" id="importe" class="input_border_bottom tam100" onkeyup="val_numero('drXX #importe')" placeholder="4545"></div>
                                   
                                </div>
                                <div class="grid_4 colorAzul"> 
                                    <div class="grid_2">T/M Importe :</div>
                                    <div class="grid_2">
                                    <select id="tmoneda_imp">
                                        <option>Bs</option>
                                        <option>Usd</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="grid_8 f10 esparriba5">
                                    <div class="grid_4 f11 colorAzul">Jefe de Proyecto:</div>
                                    <div class="grid_4 ">
                                    <select id="id_encargado" onchange=""> 

                                                <?php
                                              foreach ($per_a_asignar->result() as $usuario) {
                                                    /*  if ($usuario->cod_user == $asignado)
                                                        echo '<option selected="selected" value="' . $usuario->cod_user . '">' . $usuario->ap_paterno ." ". $usuario->ap_materno . $usuario->nombre . '</option>';
                                                    else*/
                                                        echo ' <option value="' . $usuario->cod_user . '">' . $usuario->ap_paterno ." ". $usuario->ap_materno .", ". $usuario->nombre . '</option>';
                                                }
                                                ?>

                                                </select>
                                    </div>
                                </div>
                                
                              
                            </div>
                            <div class=" grid_20 f10 colorAzul">
                                <div class="grid_4">
                                    <div class="grid_2">Provision :</div>
                                    <div class="grid_2"><input type="text" id="provision" class="input_border_bottom tam100" onkeyup="val_numero('drXX #provision')" placeholder="5454"></div>
                                </div>
                                <div class="grid_4">
                                    <div class="grid_2"> T/M Provision :</div>
                                    <div class="grid_2">
                                    <select id="tmoneda_pro">
                                        <option>Bs</option>
                                        <option>Usd</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="grid_8 esparriba5">
                                    <div class="grid_4 f11 colorAzul">Tipo de Contrato :</div>
                                    <div class="grid_4">
                                                <select id="t_contrato">
                                                    <option value="c_adjudicacion">Contrato por adjudicacion</option>
                                                    <option value="c_compra">Pedido de compra</option>
                                                </select>
                                     </div>           
                                </div>
                                
                                
                          
                            </div>
                            <div class="grid_20  espabajo20">
                                                       <textarea class="textarea_redond_324x40" type="text" id="observacion_contrato" placeholder="Escriba las observaciones de contratos" ></textarea>
                                                       <div class="f10 colorAzul">Observaciones Contrato</div>
                            </div>
                            
                           </div>
                        </div>
                    <input type="hidden" id="nro_reg" value="0">
                    <input type="hidden" id="items_select" value="">
                        
                    <div id="datos_contrato" >
                            <?php
                           // echo "ppppp". $d_contrato->num_rows();
                            if($d_contrato->num_rows()>0)
                            {
                                $cont=0;
                                $cadena="0";
                                foreach ($d_contrato->result() as $fila)
                                {
                                    $cont++;
                                    $cadena.=",".$cont;
                            ?>
                            <div class="grid_20 "  id="dr<?php echo $cont;?>">
                                <div class="">
                                <div class="grid_20 f10 espabajo5">
                                    <div class="grid_4 colorAzul">
                                        <div class="grid_2"> Nro. Contrato :</div>
                                        <div class="grid_2">
                                            <input type="hidden" id="id_contrato" class="input_redond_100" placeholder="5454" value="<?php echo $fila->id_contrato?>">
                                            <input type="text" id="nro_contrato" class="input_border_bottom tam100" placeholder="2321" value="<?php echo $fila->nro_contrato?>">
                                        </div>
                                    </div>
                                    <div class="grid_4 colorAzul">
                                        <div class="grid_2">Estado :</div>
                                        <div class="grid_2">
                                            <select id="estado_contrato" >
                                               <option value="Activo" <?php if($fila->estado=="Activo") echo "selected='selected'";?>>Activo</option>
                                               <option value="Inactivo" <?php if($fila->estado=="Inactivo") echo "selected='selected'";?>>Inactivo</option>
                                           </select>
                                        </div>
                                    </div>
                                    <div class="grid_8 colorAzul">
                                        <div class="grid_4">Etapa :</div>
                                        <div class="grid_4"><input type="text" id="etapa" class="input_border_bottom tam200 "  placeholder="" style="padding: 0px ;" value="<?php echo $fila->etapa_proyecto?>"></div>  
                                          
                                    </div>
                                   
                                </div>
                                <div class=" grid_20 f10 espabajo5">
                                    <div class="grid_4 colorAzul">
                                        <div class="grid_2">Vigencia :</div>
                                        <div class="grid_2"> <input type="text" id="vigencia" class="input_border_bottom tam100 "  placeholder="90 dias"  style="padding: 0px ;"value="<?php echo $fila->vigencia?>"></div>    
                                    </div>
                                    <div class="grid_4 colorAzul">
                                        <div class="grid_2">Gestion :</div>
                                        <div class="grid_2">
                                         <select id="gestion">
                                        <?php
                                         $año=  date('Y');
                                         for ($i = $año; $i > $año-10; $i--) {
                                             if($fila->gestion_contrato==$i)
                                                echo '<option selected="selected" value="'.$i.'">'.$i.'</option>';
                                             else
                                                 echo '<option  value="'.$i.'">'.$i.'</option>';
                                            // $año++;
                                         }
                                        ?></select>
                                        </div>
                                    </div>
                                    <div class="grid_8 colorAzul">
                                         <div class="grid_4">Descripción licitación :</div>
                                         <div class="grid_4"><input type="text" id="objeto" class="input_border_bottom tam200 "  placeholder="" style="padding: 0px ;" value="<?php echo $fila->objeto?>"></div>
                                    </div>
                                     <div class="grid_4 f10 colorAzul">
                                         <div class="grid_2 alin_cen">Nro. Licitación :</div>
                                         <div class="grid_2"><input type="text" id="nro_licitacion" class="input_border_bottom tam100 " placeholder="12/29" style="padding: 0px ;" value="<?php echo $fila->nro_licitacion;?>"></div>
                                    </div>
                                    
                                    
                                </div>
                                <div class=" grid_20 f10">
                                    <div class="grid_4 colorAzul">
                                        <div class="grid_2">Importe :</div>
                                        <div class="grid_2"><input type="text" id="importe" class="input_border_bottom tam100 " onkeyup="val_numero('dr<?php echo $cont;?> #importe')"  placeholder="4545" style="padding: 0px ;" value="<?php echo $fila->importe?>"></div>
                                       
                                    </div>
                                    <div class="grid_4 colorAzul">
                                        <div class="grid_2">T/M Importe: </div>
                                        <div class="grid_2">
                                        <select id="tmoneda_imp" >
                                            <option value="Bs" <?php if($fila->tmoneda_imp=="Bs") echo "selected='selected'";?>>Bs</option>
                                            <option value="Usd" <?php if($fila->tmoneda_imp=="Usd") echo "selected='selected'";?>>Usd</option>
                                        </select>
                                        </div>
                                    </div>
                                    <div class="grid_8 esparriba5">
                                          <div class=" grid_4 f11 colorAzul">Jefe de Proyecto:</div>
                                          <div class=" grid_4 ">
                                          
                                         <select id="id_encargado" onchange=""> 

                                                    <?php
                                                    foreach ($per_a_asignar->result() as $usuario) {
                                                        if ($usuario->cod_user == $fila->encargado_proy)
                                                            echo '<option selected="selected" value="' . $usuario->cod_user . '">' . $usuario->ap_paterno ." ". $usuario->ap_materno . $usuario->nombre . '</option>';
                                                        else
                                                            echo ' <option value="' . $usuario->cod_user . '">' . $usuario->ap_paterno ." ". $usuario->ap_materno .", ". $usuario->nombre . '</option>';
                                                    }
                                                    ?>

                                                    </select>
                                          </div>
                                      
                                    </div>
                                   

                                </div>
                                <div class=" grid_20 colorAzul f10">
                                    <div class="grid_4">
                                        <div class="grid_2">Provision :</div>
                                        <div class="grid_2"><input type="text" id="provision"  class="input_border_bottom tam100 " onkeyup="val_numero('dr<?php echo $cont;?> #provision')" placeholder="5454" style="padding: 0px ;" value="<?php echo $fila->provision?>"></div>
                                        
                                    </div>
                                    <div class="grid_4">
                                        <div class="grid_2"> T/M Provision :</div>
                                        <div class="grid_2">
                                        <select id="tmoneda_pro">
                                            <option value="Bs" <?php if($fila->tmoneda_imp=="Bs") echo "selected='selected'";?>>Bs</option>
                                            <option value="Usd" <?php if($fila->tmoneda_imp=="Usd") echo "selected='selected'";?>>Usd</option>
                                         </select>
                                        </div> 
                                    </div>
                                     <div class="grid_8  esparriba5">
                                          <div class="grid_4 f11 colorAzul">Tipo de Contrato</div>
                                          <div class="grid_4 ">
                                                    <select id="t_contrato" >
                                                        <option value="c_adjudicacion" <?php if($fila->tipo_contrato=="c_adjudicacion") echo "selected='selected'";?>>Contrato por adjudicacion</option>
                                                        <option value="c_compra" <?php if($fila->tipo_contrato=="c_compra") echo "selected='selected'";?>>Pedido de compra</option>
                                                    </select>
                                          </div>     
                                    </div>

                                    
                                </div>
                                <div class="grid_20 colorAzul f10 espabajo10">
                                           <textarea class="textarea_redond_324x40" type="text" id="observacion_contrato" placeholder="Escriba las observaciones de contratos" ><?php echo $fila->observacion_contrato; ?></textarea>
                                           <div class="f10 ">Observaciones Contrato</div>
                                </div> 
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
                            /*else
                            { ?><script>add_registro_contrato();</script> <?php }*/
                            ?>
                                            
                        </div>
                    <div class="grid_1 esparriba10"><div class="boton centrartexto f10 colorGuindo negrilla milink" style="padding:0px; " onclick="add_registro_contrato()">Añadir</div></div>
                   <!--- </div>--->

    
    
    
   



