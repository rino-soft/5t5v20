<?php 
$proye=$consul2->row()->nombre;
$id_proy=$consul2->row()->id_proy;
$almacen=0;
$id_resp_mat=$consul2->row()->id_user_encargado;
$com_gral=$consul2->row()->comentario_obs;
$estado_sm=$consul2->row()->estado;
$estado_ma="";
$cant_sol=$consul2->row();
if($id_ma!=0)
{   
    //$id_proy=$proy->id_proy;
   // $proye=$proy->nombre;
    $almacen=$mov_alm->id_almacen;
    $id_resp_mat=$mov_alm->id_user_er;
    $com_gral=$mov_alm->comentario;
    $estado_ma=$mov_alm->estado;
}

?>

<div class="container_20">
    <div class="grid_20">
        <div style="display: table-row" class="bordeado"> 
            <div class="grid_20 bordeado fondo_plomo_claro_areas" >
                <div class="grid_10  esparriba10 espabajo10" > 
                    <div  class=" f12 grid_2 negrilla">Proyecto:</div>  
                    <div  class=" f12 grid_2" id="n_proy"><?php echo $proye; ?></div> 
                    <div  class=" f12 grid_2 negrilla">Almacen:</div>                      
                    <div class=" f12 grid_4 f11 negrilla" >
                        <select id="id_almacen" onchange="">
                            <?php
                            foreach ($consul3->result() as $con) {
                                if($almacen==$con->id_almacen)
                                    echo ' <option  value="' . $con->id_almacen . '" selected="selected">' . $con->nombre . '</option>';
                                else
                                    echo ' <option  value="' . $con->id_almacen . '">' . $con->nombre . '</option>';
                            }
                            ?>
                        </select>
                    </div>               
                </div>
                <div class="grid_10 esparriba10 espabajo10 " >
                    <div  class=" f12 grid_5 negrilla">Personal encargado del material</div>
                    <div  class=" f12 grid_5" id="per_e"><?php echo $consul4->row(0)->nombre . " " . $consul4->row(0)->ap_paterno . " " . $consul4->row(0)->ap_materno ?></div>          
                </div>
            </div>
            <div class="grid_12" id="area_cargo_selecctivo" style="display: block;"> </div>         
            <div class="grid_4 suffix_1">
                <input type="hidden" value="1" id="pagina_art">
                <input type="hidden" value="" title="ids_selec" id="ids_seleccionados">
                <input type="hidden" value="0" id="cant_item">
            </div>
        </div>
        <input type="hidden" value="<?php echo $consul4->row(0)->cod_user; ?>" id="c_u" >
        <input type="hidden" value="<?php echo $id_proy; ?>" id="c_p" >
        
        <input type="hidden" value="<?php echo $consul4->row(0)->cod_operacional; ?>" id="co" >
        <input type="hidden" value="<?php echo $id_sm ?>" id="cod_s_m" >
        <input type="hidden" value="<?php echo $id_ma ?>" id="id_mov_alm" >
        <div class="grid_20 fondo_plomo_claro_areas"></div> 
        <div class="grid_18 " id="lista_movimiento_ver" style="display: block;"></div>
    </div> 
    <div class="grid_18" id="lista_movimiento_sol" style="display: block;">
        <div class="grid_20 f12 negrilla fondo_azul colorAmarillo ">
           <div class="grid_2 alin_cen"  > Codigo</div>
            <div class="grid_6 alin_cen">Producto</div>
            <div class="grid_7 alin_cen">Comentario</div>
            <div class="grid_1 alin_izq">Cantidad Solicitada</div>
            <div class="grid_1 alin_izq " style="padding-left: 25px">Cantidad Entregada</div>
            
        </div>
        
        <?php
        $cant_item = 0;
        $ids = "";
        $cant_item = $detalle->num_rows();

        $vec_ids = array();
        $i = 0;
        $codigo_items = "";
        // $id_mov_alm=0;
       // $id_sm=0;
        $k=0;
        foreach ($detalle->result() as $item) {
            if ($id_ma == 0) {
                $id_servicio_producto = $item->id_serv_pro;
                $id_solicitud_material = $item->id_solicitud_mat;
                $cantidad_e = $item->cantidad_sol;
                $coment = $item->comentario;
                $cant_sol=$item->cantidad_sol;
            } else {
                $cant_sol=$detallesm->row($k)->cantidad_sol;
                $id_servicio_producto = $item->id_articulo;
                $id_solicitud_material = $id_sm;
                $cantidad_e = $item->cantidad;
                $coment = $item->observaciones;
            }
            $k++;
            $items_cod = "";
            $vec[$i] = $id_servicio_producto;
            $i++;
            $cont = 0;
            for ($c = 0; $c < count($vec); $c++) {
                if ($vec[$c] == $id_servicio_producto)
                    $cont++;
            }
            $ids.="," . $id_servicio_producto . "-" . $cont;
            $ocultar = "";
            $ver_oculta_coment = "<div id = 'ver' class = 'comentario milink ocultar' title = 'Adicionar comentario' onclick = 'mostrar_quitar_coment(" . $id_servicio_producto . "," . $cont . ",1)'></div>
                            <div id = 'oculta' class = 'nocomentario milink ' title = 'Quitar comentario' onclick = 'mostrar_quitar_coment(" . $id_servicio_producto. "," . $cont . ",0)'></div>";
            if ($coment == "") {
                $ocultar = "ocultar";
                $ver_oculta_coment = "<div id = 'ver' class = 'comentario milink' title = 'Adicionar comentario' onclick = 'mostrar_quitar_coment(" . $id_servicio_producto . "," . $cont . ",1)'></div>
                            <div id = 'oculta' class = 'nocomentario milink ocultar' title = 'Quitar comentario' onclick = 'mostrar_quitar_coment(" . $id_servicio_producto . "," . $cont . ",0)'></div>";
            }

            $items_cod = "<div class = 'grid_20 fondo_amarillo bordeado f12' id = 'sel" .$id_servicio_producto . "-" . $cont . "' >
        

                        <div class = 'grid_2 negrilla alin_izq colorAzul'>-" . $item->cod_serv_prod . " <input type='hidden' id='cod_ps' value='" . $item->cod_serv_prod . "'></div>
                        <div class = 'grid_2'>" . " <input type='hidden' id='id_sm' value='" . $id_solicitud_material . "'></div>    
                        <div class = 'grid_2'>" . " <input type='hidden' id='id_sp' value='" . $id_servicio_producto . "'></div>   
                        
                        <div class = 'grid_6'>
                            <div class = 'grid_6'>" . $item->nombre_titulo . " <input type='hidden' id='tit_ps' value='" . $item->nombre_titulo . "'></div>
                            <div class = 'grid_6'>" . $item->descripcion . " <input type='hidden' id='desc_ps' value='" . $item->descripcion . "'></div>
                            
                        </div>  
                        <div class = 'grid_7 espder10'>
                            <div class = 'grid_6'><textarea placeholder = 'Escriba una observacion aqui' id = 'coment' class = 'textarea_redond_300x50'>" . $coment . "</textarea></div>
                         </div> 
                                            
                        <div class = 'grid_1 espder10'>
                       <div class = 'espabajo10 grid_2'><input title = 'cantidad solicitada' id = 'cant' type = 'text' class = ' grid_1 alin_cen margin_cero input_redond_50 ' placeholder='C' value='" .  $cant_sol . "' readonly='readonly' name='codigo_entregada'></input></div>    
                        </div> 
                        <div class = 'grid_1 espder10'>
                       <div class = 'espabajo10 grid_2'><input title = 'cantidad entregada' id = 'cant_e' type = 'text' class = ' grid_1 alin_cen margin_cero input_redond_50 ' placeholder='CE' value='" .  $cantidad_e . "'></input></div>    
                        </div> 
                        <div class = 'grid_1 f12 espabajo10 '>                       
                            <div style = 'float:rigth;' id = 'quitar' class = 'quitarItem milink' title = 'Quitar Item' onclick = 'quitaritem(" . $id_servicio_producto . "," . $cont . ");'></div>
                        </div>
                    </div>";
            $codigo_items.=$items_cod;
        }
        ?> 
    </div>
    <div class="grid_20 f12" id="detalle_ov_pf"></div>

    <div class="grid_18" id="sm">
        <?php
        if ($codigo_items == "")
            echo "Detalle de Ingreso de almacen";
        else
            echo $codigo_items;
        ?>
    </div>
    <script>
        $("#ids_seleccionados").val($("#ids_seleccionados").val()+"<?php echo $ids; ?>");
        cantidadItems=parseInt($("#cant_item").val());
        cantidadItemsadd=parseInt("<?php echo $i; ?>");

        canI=cantidadItems+cantidadItemsadd;
        $("#cant_item").val(canI);
    </script>
    <div class="f12" id="lista_movimiento"></div>
    <div class="grid_20 fondo_azul colorBlanco esparriba5 espabajo5">
        <div class="grid_6 "> <div class="milink link_blanco f12" onclick="$('#sm').html(''); $('#lista_movimiento$').html(''); $('#in_search').val('');">LIMPIAR LISTA</div></div>      
    </div>
    <div style="display: block-inline; width: 100px; float: left" class=' alin_cen' >

        <div class='boton2 f12'><div onclick="insertar_detalle_sol_mat('<?php echo $consul2->row(0)->id_solicitud_mat; ?>','detalle_ov_pf ')">Adicionar</div></div>

    </div>
    <div class="grid_20 f16">
        Comentario:
        <textarea id="comentario_general" placeholder="puede escribir un comentario general" class="textarea_redond_990x50"><?php echo $com_gral;?></textarea>
    </div>
    
    <div class="grid_20" id="respuesta"> </div>
</div>
<?php 
//echo "<script> alert('Material Entregado==".$estado_sm."');</script>";
if ($estado_ma == "Material Entregado")
{
   //echo "<script> alert('si');</script>";
   echo "<script> $('#buttonenviar').button('disable');
                $('#save_sm').button('disable');
        </script>";
}
else {
    //echo "<script> alert('Guardado==".$estado_sm." ');</script>";
    if ($estado_ma == "Guardado") {
        echo "<script> 
            
$(\"#buttonenviar\").button(\"enable\");
            $('#save_sm').button('option', 'label', 'Editar');</script>";
    } else {
        echo "<script> $('#buttonenviar').button('disable');</script>";
    }
}?>

<div id="c_op"></div>

