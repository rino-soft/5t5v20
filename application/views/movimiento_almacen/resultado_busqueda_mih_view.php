<div class="grid_20 fondo_blanco">
   <div class="grid_20 fondo_azul colorBlanco esparriba5 espabajo5">
       <div class="grid_6 "> Resultado de la busqueda <?php echo $no_reg ; ?> encontrados</div>
       <div class="grid_14 negrilla" >
           <div style="float:right"><?php 
           
           for($c=1;$c<=ceil($no_reg/$mostrar);$c++)
            {   if($c==$pagina)
                    echo "<div class='colorAmarillo' style='float:left;'>$c,</div>";
                else
                    echo "<div class='milink link_blanco' onclick='cambiarpagina($c)' style='float:left;'>$c,</div>";
            }?>
               </div>
       </div>
   </div>
<?php 
    if($consulta->num_rows()>0)
    {
            $i=$ind+1;
            //echo $ids;
            $selec=explode(",", $ids);
            $seleccionado=  array();
            for($ii=1;$ii<count($selec);$ii++)
            {   
                $s=explode("-", $selec[$ii]);
                $seleccionado[$ii]=$s[0];
            }
            
           //echo "count seleccionado".count($seleccionado);
            //echo $seleccionado[0];
            
        foreach ($consulta->result() as $res)
        {
            $clase="";
            $chec="";
            if(in_array($res->id_mov_alm, $seleccionado))
            {
                 $clase="seleccionado";
                 $chec='checked="checked"';
            }
        ?> <div class="grid_20 borde_abajo borde_arriba <?php echo $clase ;?>" id="<?php echo $res->id_mov_alm; ?>">
            <div class="grid_1">
                <input type="checkbox" <?php echo $chec;?> onchange="seleccionar_producto('<?php echo $res->id_mov_alm; ?>')"
                id="check<?php echo $res->id_mov_alm; ?>" value="<?php echo $res->id_mov_alm; ?>"> <?php echo $i;?></div>
            
            <div class="grid_7" >
                <div class="grid_7 negrilla">
                    <input type="hidden" id="cod_p" value="<?php echo $res->proyecto;?>">
                    <input type="hidden" id="tit_p" value="<?php echo  $res->fh_reg;?>">
                    <input type="hidden" id="desc_p" value="<?php echo  $res->tipo_movimiento;?>">
                    <input type="hidden" id="prec_p" value="<?php echo  $res->proyecto;?>">
                    <input type="hidden" id="um_p" value="<?php echo  $res->comentario;?>">
                    
                    
                    <div style="display: block; ">
                    <span class="negrilla  colorRojo">Proyecto</span>
                    </div>   
                    
                    <div style="display: block;">
                        <span class="negrilla"><?php echo str_replace($busqueda,"<span class='resaltar'>".$busqueda."</span>",$res->id_mov_alm .".- ". $res->proyecto);?></span>
                    </div>
                </div>
            <div style="display: block; ">
                <span class="negrilla  colorRojo">Tipo Movimiento</span>
            </div>      
            <div style="display: block;">
                 <span class="negrilla"><?php echo str_replace($busqueda,"<span class='resaltar'>".$busqueda."</span>",$res->tipo_movimiento);?></span>
            </div>
            
            
           </div>
            
            <div class="f12" style="display: block-inline; width: 300px; float: left">
                <div style="display: block; ">
                    <span class="negrilla  colorRojo">Proyecto</span>
                </div>
                <div style="display: block; ">
                    <span class="negrilla"> <?php echo $res->proyecto;?></span>
                </div>
            </div>
            
            <div class="f12" style="display: block-inline; width: 300px; float: left">
                <div style="display: block; ">
                    <span class="negrilla  colorRojo">Fecha/Hora registro</span>
                </div>
                <div style="display: block;">
                    <span class="negrilla"><?php echo $res->fh_reg;?></span>
                </div>
            </div>
            <div class="f12" style="display: block-inline; width: 300px; float: left">
                <div style="display: block; ">
                    <span class="negrilla  colorRojo">Comentario</span>
                </div>
            
                <div style="display: block;">
                    <span class="negrilla"><?php echo str_replace($busqueda,"<span class='resaltar'>".$busqueda."</span>",$res->comentario);?></span>
                </div>
             </div>   
            
            <div style="display: block-inline; width: 150px; float: left">
                  <div class="espaciado10 negrilla"><div style="display: block; ">
                        <div class="boton milink" style="float: left; display: table-cell "onclick="dialog_contenidos_nuevo_ingreso('div_formularios_dialog','<?php echo base_url() . "movimiento_almacen/ingreso_ver/0"; ?> ')" >
                            INGRESO/alta
                        </div>
                        </div>
                    </div>
            </div> 
             <div style="display: block-inline; width: 150px; float: left">
                  <div class="espaciado10 negrilla"><div style="display: block; ">
                        <div class="boton milink" style="float: left; display: table-cell "onclick="dialog_contenidos_baja_ingreso('div_formularios_dialog','<?php echo base_url() . "movimiento_almacen/ingreso_baja/0"; ?> ')" >
                            Baja
                        </div>
                        </div>
                    </div>
            </div> 
            <div style="display: block-inline; width: 150px; float: left">
                  <div class="espaciado10 negrilla"><div style="display: block; ">
                        <div class="boton milink" style="float: left; display: table-cell "onclick="dialog_contenidos_nuevo_ingreso('div_formularios_dialog','<?php echo base_url() . "movimiento_almacen/ingreso_editar/0"; ?> ')" >
                            EDITAR
                        </div>
                        </div>
                    </div>
            </div> 
            
            </div>
                
               <?php
           $i++;
        }
         ?>
    <div class="grid_20 fondo_azul colorBlanco esparriba5 espabajo5">
        <div class="grid_6 "> <div class="milink link_blanco" onclick="$('#resultado_busqueda').html('');$('#in_search').val('');">LIMPIAR BUSQUEDA</div></div>
       <div class="grid_14 negrilla" >
           <div style="float:right"><?php 
           
           for($c=1;$c<=ceil($no_reg/$mostrar);$c++)
            {   if($c==$pagina)
                    echo "<div class='colorAmarillo' style='float:left;'>$c,</div>";
                else
                    echo "<div class='milink link_blanco' onclick='cambiarpagina($c)' style='float:left;'>$c,</div>";
            }?>
               </div>
       </div>
        
        
       
    </div>
             <?php
       
    }
    
    else
    {echo "no se han encontrado registros de este producto y/o servicio";}
?>
</div>