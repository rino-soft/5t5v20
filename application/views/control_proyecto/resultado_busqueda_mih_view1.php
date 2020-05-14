<div class="grid_20 fondo_blanco">
    <div class="prefix_15 grid_5"> 
                <div class="grid_5 alin_der">
                  Mostrar Registros
                    <select id="mostrar_X" onchange="cambiarpagina(1)">
                        <option value ="5" selected="selected" >5</option>
                        <option value ="10" >10</option>
                        <option value ="20" >20</option>
                        <option value ="50" >50</option>
                        <option value ="100" >100</option>
                    </select> 
                    
                </div>
                 <input type="hidden" value="1" id="pagina">
                 <input type="hidden" value="" id="ids_seleccionados">
                <input type="hidden" value="0" id="cant_item" >
        </div>
        
        <div class="clear"></div>
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
            if(in_array($res->id_serv_pro, $seleccionado))
            {
                 $clase="seleccionado";
                 $chec='checked="checked"';
            }
        ?> <div class="grid_20 borde_abajo borde_arriba <?php echo $clase ;?>" id="<?php echo $res->id_serv_pro; ?>">
            <div class="grid_1">
                <input type="checkbox" <?php echo $chec;?> 
                       
                id="check<?php echo $res->id_serv_pro; ?>" value="<?php echo $res->id_serv_pro; ?>"> <?php echo $i;?></div>
            
            <div class="grid_7" >
                <div class="grid_7 negrilla">
                    <input type="hidden" id="cod_p" value="<?php echo $res->cod_serv_prod;?>">
                    <input type="hidden" id="tit_p" value="<?php echo  $res->nombre_titulo;?>">
                    <input type="hidden" id="desc_p" value="<?php echo  $res->descripcion;?>">
                   
               
                    <div style="display: block; ">
                    <span class="negrilla  colorRojo">articulos</span>
                    </div>   
                    
                    <div style="display: block;">
                        <span class="negrilla"><?php echo str_replace($busqueda,"<span class='resaltar'>".$busqueda."</span>",$res->id_serv_pro .".- ". $res->cod_serv_prod);?></span>
                    </div>
                </div>
            <div style="display: block; ">
                <span class="negrilla  colorRojo">Tipo Articulo</span>
            </div>      
            <div style="display: block;">
                 <span class="negrilla"><?php echo str_replace($busqueda,"<span class='resaltar'>".$busqueda."</span>",$res->nombre_titulo);?></span>
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
        <div class="grid_14 prefix_6"><input class="fondobuscar" id="in_search" placeholder="Buscar material" onkeypress="search_ingreso1(event);">
        
                </div>
        
        
       
    </div>
             <?php
       
    }
    
    else
    {echo "no se han encontrado registros de este producto y/o servicio";}
?>
</div>