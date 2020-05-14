<div class="grid_20 fondo_blanco">
   <div class="grid_20 fondo_azul colorBlanco esparriba5 espabajo5">
       <div class="grid_6 "> Resultado de la busqueda <?php echo $no_reg ; ?> encontrados</div>
       <div class="grid_14 negrilla" >
           <div style="float:right">
               
               <?php 
           $pagina_actual=$pagina;
           $numPag = ceil($no_reg / $mostrar);
            if ($numPag <= 20) {
                for ($pa = 1; $pa <= ceil($no_reg / $mostrar); $pa++) {
                    if ($pa != $pagina_actual) {
                        ?>
                        <div class='milink link_blanco' onclick='$("#pagina").val("<?php echo $pa; ?>"); busqueda_prod_serv_tipo_grilla("grilla_sol_mat");' style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                        <?php
                    } else {
                        ?>
                        <div class="colorAmarillo" style="float: left"> <?php echo $pa . "&nbsp;&nbsp;&nbsp;";   ?> </div>
                        <?php
                    }
                }
            } else {
                switch ($pagina_actual) {
                    case (($pagina_actual >= 1) && ($pagina_actual <= 10)):
                        for ($pa = 1; $pa <= 15; $pa++) {
                            if ($pa != $pagina_actual) {
                                ?>
                                <div class='milink link_blanco' onclick='$("#pagina").val("<?php echo $pa; ?>"); busqueda_prod_serv_tipo_grilla("grilla_sol_mat");' style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                                <?php
                            } else {
                                ?>
                                <div class="colorAmarillo" style="float: left"> <?php echo $pa . "&nbsp;&nbsp;&nbsp;";   ?> </div>
                                <?php
                            }
                        }
                        ?>
                        <div class='milink link_blanco' style="float: left" > &nbsp;. . .&nbsp;&nbsp; </div>    
                        <?php
                        for ($pa = $numPag - 4; $pa <= $numPag; $pa++) {
                            if ($pa != $pagina_actual) {
                                ?>
                                <div class='milink link_blanco' onclick='$("#pagina").val("<?php echo $pa; ?>"); busqueda_prod_serv_tipo_grilla("grilla_sol_mat");' style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                                <?php
                            } else {
                                ?>
                                <div class="colorAmarillo" style="float: left"> <?php echo $pa . "&nbsp;&nbsp;&nbsp;";   ?> </div>
                                <?php
                            }
                        }
                        break;

                    case (($pagina_actual >= $numPag - 10) && ($pagina_actual <= $numPag)):
                        //echo "caso pagina actual >=10";
                        for ($pa = 1; $pa <= 5; $pa++) {
                            if ($pa != $pagina_actual) {
                                ?>
                                <div class='milink link_blanco' onclick='$("#pagina").val("<?php echo $pa; ?>"); busqueda_prod_serv_tipo_grilla("grilla_sol_mat");' style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                                <?php
                            } else {
                                ?>
                                <div class="colorAmarillo" style="float: left"> <?php echo $pa . "&nbsp;&nbsp;&nbsp;";   ?> </div>
                                <?php
                            }
                        }
                        ?>
                        <div class='milink link_blanco' style="float: left" > &nbsp;. . .&nbsp;&nbsp; </div>    
                        <?php
                        for ($pa = $numPag - 15; $pa <= $numPag; $pa++) {
                           if ($pa != $pagina_actual) {
                                ?>
                                <div class='milink link_blanco' onclick='$("#pagina").val("<?php echo $pa; ?>"); busqueda_prod_serv_tipo_grilla("grilla_sol_mat");' style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                                <?php
                            } else {
                                ?>
                                <div class="colorAmarillo" style="float: left"> <?php echo $pa . "&nbsp;&nbsp;&nbsp;";   ?> </div>
                                <?php
                            }
                        }
                        break;

                    default:
                        for ($pa = 1; $pa <= 5; $pa++) {
                            if ($pa != $pagina_actual) {
                                ?>
                                <div class='milink link_blanco' onclick='$("#pagina").val("<?php echo $pa; ?>"); busqueda_prod_serv_tipo_grilla("grilla_sol_mat");' style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                                <?php
                            } else {
                                ?>
                                <div class="colorAmarillo" style="float: left"> <?php echo $pa . "&nbsp;&nbsp;&nbsp;";   ?> </div>
                                <?php
                            }
                        }
                        ?>
                        <div class='milink link_blanco' style="float: left" >&nbsp;. . .&nbsp;&nbsp;</div>    
                        <?php
                        for ($pa = $pagina_actual - 4; $pa <= $pagina_actual + 5; $pa++) {
                            if ($pa != $pagina_actual) {
                                ?>
                                <div class='milink link_blanco' onclick='$("#pagina").val("<?php echo $pa; ?>"); busqueda_prod_serv_tipo_grilla("grilla_sol_mat");' style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                                <?php
                            } else {
                                ?>
                                <div class="colorAmarillo" style="float: left"> <?php echo $pa . "&nbsp;&nbsp;&nbsp;";   ?> </div>
                                <?php
                            }
                        }
                         ?>
                        <div class='milink link_blanco' style="float: left" > &nbsp;. . .&nbsp;&nbsp; </div>    
                        <?php
                        for ($pa = $numPag - 4; $pa <= $numPag; $pa++) {
                           if ($pa != $pagina_actual) {
                                ?>
                                <div class='milink link_blanco' onclick='$("#pagina").val("<?php echo $pa; ?>"); busqueda_prod_serv_tipo_grilla("grilla_sol_mat");' style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                                <?php
                            } else {
                                ?>
                                <div class="colorAmarillo" style="float: left"> <?php echo $pa . "&nbsp;&nbsp;&nbsp;";   ?> </div>
                                <?php
                            }
                        }
                }
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
                <input type="checkbox" <?php echo $chec;?> onchange="seleccionar_producto_sm('<?php echo $res->id_serv_pro; ?>')"
                id="check<?php echo $res->id_serv_pro; ?>" value="<?php echo $res->id_serv_pro; ?>"> <?php echo $i;?></div>
            
            <div class="grid_7" >
                <div class="grid_7 negrilla">
                    <input type="hidden" id="cod_p" value="<?php echo $res->cod_serv_prod;?>">
                    <input type="hidden" id="tit_p" value="<?php echo  $res->nombre_titulo;?>">
                    <input type="hidden" id="desc_p" value="<?php echo  $res->descripcion;?>">
                    <input type="hidden" id="prec_p" value="<?php echo  $res->precio_unitario;?>">
                    <input type="hidden" id="um_p" value="<?php echo  $res->unidad_medida;?>">
                    <?php echo str_replace($busqueda,"<span class='resaltar'>".$busqueda."</span>",$res->cod_serv_prod .".- ". $res->nombre_titulo);?>
                </div>
            <div class="grid_7 f10"><?php echo str_replace($busqueda,"<span class='resaltar'>".$busqueda."</span>",$res->descripcion);?></div>
            </div>
            <div class="grid_2 alin_cen"><?php echo $res->precio_unitario;?></div>
            <div class="grid_2 alin_cen"><?php echo $res->unidad_medida;?></div>
            <div class="grid_4 alin_cen " ><?php echo str_replace($busqueda,"<span class='resaltar'>".$busqueda."</span>",$res->palabras_clave);?></div>
              
           </div><?php
           $i++;
        }
         ?>
    <div class="grid_20 fondo_azul colorBlanco esparriba5 espabajo5">
        <div class="grid_6 "> <div class="milink link_blanco" onclick="$('#resultado_busqueda').html('');$('#in_search').val('');">LIMPIAR BUSQUEDA</div></div>
       <div class="grid_14 negrilla" >
           <div style="float:right">
               
               <?php 
           $pagina_actual=$pagina;
           $numPag = ceil($no_reg / $mostrar);
            if ($numPag <= 20) {
                for ($pa = 1; $pa <= ceil($no_reg / $mostrar); $pa++) {
                    if ($pa != $pagina_actual) {
                        ?>
                        <div class='milink link_blanco' onclick='$("#pagina").val("<?php echo $pa; ?>"); busqueda_prod_serv_tipo_grilla("grilla_sol_mat");' style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                        <?php
                    } else {
                        ?>
                        <div class="colorAmarillo" style="float: left"> <?php echo $pa . "&nbsp;&nbsp;&nbsp;";   ?> </div>
                        <?php
                    }
                }
            } else {
                switch ($pagina_actual) {
                    case (($pagina_actual >= 1) && ($pagina_actual <= 10)):
                        for ($pa = 1; $pa <= 15; $pa++) {
                            if ($pa != $pagina_actual) {
                                ?>
                                <div class='milink link_blanco' onclick='$("#pagina").val("<?php echo $pa; ?>"); busqueda_prod_serv_tipo_grilla("grilla_sol_mat");' style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                                <?php
                            } else {
                                ?>
                                <div class="colorAmarillo" style="float: left"> <?php echo $pa . "&nbsp;&nbsp;&nbsp;";   ?> </div>
                                <?php
                            }
                        }
                        ?>
                        <div class='milink link_blanco' style="float: left" > &nbsp;. . .&nbsp;&nbsp; </div>    
                        <?php
                        for ($pa = $numPag - 4; $pa <= $numPag; $pa++) {
                            if ($pa != $pagina_actual) {
                                ?>
                                <div class='milink link_blanco' onclick='$("#pagina").val("<?php echo $pa; ?>"); busqueda_prod_serv_tipo_grilla("grilla_sol_mat");' style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                                <?php
                            } else {
                                ?>
                                <div class="colorAmarillo" style="float: left"> <?php echo $pa . "&nbsp;&nbsp;&nbsp;";   ?> </div>
                                <?php
                            }
                        }
                        break;

                    case (($pagina_actual >= $numPag - 10) && ($pagina_actual <= $numPag)):
                        //echo "caso pagina actual >=10";
                        for ($pa = 1; $pa <= 5; $pa++) {
                            if ($pa != $pagina_actual) {
                                ?>
                                <div class='milink link_blanco' onclick='$("#pagina").val("<?php echo $pa; ?>"); busqueda_prod_serv_tipo_grilla("grilla_sol_mat");' style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                                <?php
                            } else {
                                ?>
                                <div class="colorAmarillo" style="float: left"> <?php echo $pa . "&nbsp;&nbsp;&nbsp;";   ?> </div>
                                <?php
                            }
                        }
                        ?>
                        <div class='milink link_blanco' style="float: left" > &nbsp;. . .&nbsp;&nbsp; </div>    
                        <?php
                        for ($pa = $numPag - 15; $pa <= $numPag; $pa++) {
                           if ($pa != $pagina_actual) {
                                ?>
                                <div class='milink link_blanco' onclick='$("#pagina").val("<?php echo $pa; ?>"); busqueda_prod_serv_tipo_grilla("grilla_sol_mat");' style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                                <?php
                            } else {
                                ?>
                                <div class="colorAmarillo" style="float: left"> <?php echo $pa . "&nbsp;&nbsp;&nbsp;";   ?> </div>
                                <?php
                            }
                        }
                        break;

                    default:
                        for ($pa = 1; $pa <= 5; $pa++) {
                            if ($pa != $pagina_actual) {
                                ?>
                                <div class='milink link_blanco' onclick='$("#pagina").val("<?php echo $pa; ?>"); busqueda_prod_serv_tipo_grilla("grilla_sol_mat");' style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                                <?php
                            } else {
                                ?>
                                <div class="colorAmarillo" style="float: left"> <?php echo $pa . "&nbsp;&nbsp;&nbsp;";   ?> </div>
                                <?php
                            }
                        }
                        ?>
                        <div class='milink link_blanco' style="float: left" >&nbsp;. . .&nbsp;&nbsp;</div>    
                        <?php
                        for ($pa = $pagina_actual - 4; $pa <= $pagina_actual + 5; $pa++) {
                            if ($pa != $pagina_actual) {
                                ?>
                                <div class='milink link_blanco' onclick='$("#pagina").val("<?php echo $pa; ?>"); busqueda_prod_serv_tipo_grilla("grilla_sol_mat");' style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                                <?php
                            } else {
                                ?>
                                <div class="colorAmarillo" style="float: left"> <?php echo $pa . "&nbsp;&nbsp;&nbsp;";   ?> </div>
                                <?php
                            }
                        }
                         ?>
                        <div class='milink link_blanco' style="float: left" > &nbsp;. . .&nbsp;&nbsp; </div>    
                        <?php
                        for ($pa = $numPag - 4; $pa <= $numPag; $pa++) {
                           if ($pa != $pagina_actual) {
                                ?>
                                <div class='milink link_blanco' onclick='$("#pagina").val("<?php echo $pa; ?>"); busqueda_prod_serv_tipo_grilla("grilla_sol_mat");' style="float: left" > <?php echo $pa . "&nbsp;&nbsp;&nbsp;"; ?> </div>
                                <?php
                            } else {
                                ?>
                                <div class="colorAmarillo" style="float: left"> <?php echo $pa . "&nbsp;&nbsp;&nbsp;";   ?> </div>
                                <?php
                            }
                        }
                }
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