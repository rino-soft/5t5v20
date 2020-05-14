
    <!-- aqui se muestra los registros con un foreach -->
    <div class='grid_20 fondo_amarillo bordeado'>

        <?php
        if ($registros2->num_rows() > 0) {
        
       // echo $ids;
        $selec = explode(",", $ids);
        $seleccionado = array();
        for ($ii = 1;$ii < count($selec);$ii++) {
        $s = explode("-", $selec[$ii]);
        $seleccionado[$ii] = $s[0];
        }
        

        foreach ($registros2->result() as $reg) {

        $clase = "";
        $chec = "";
        if (in_array($reg->id_serv_pro, $seleccionado)) {
        $clase = "seleccionado";
        $chec = 'checked="checked"';
        }
        ?>
        <div class='div1150 fondo_plomo'>
            <div class="f12" style="display: block-inline;width: 300px;float: left ">
                <div style="display: block;" id="id_articulo">
                    <?php echo "Id : " . $reg->id_serv_pro . "(" . $reg->id_serv_pro . ")"; ?>
                </div> 
                <div style="display: block; ">
                    <span class="negrilla f16 colorRojo"><?php echo "Item : " . $reg->item . "(" . $reg->cod_serv_prod . ")"; ?></span>
                </div>               
                <div style="display: block; ">
                    <span class="negrilla"><?php echo "Nombre : </span><span>" . $reg->nombre_titulo; ?></span>
                </div>  
            </div> 


            <div class="f12"style="display: block-inline;  width: 150px; float: left">
                <div style="display: block; "><span class="negrilla  colorRojo">Descripcion</span></div>  
                <div style="display: block; "><span class="negrilla"><?php echo $reg->descripcion; ?></span></div>
            </div>

            <div class="f12" style="display: block-inline; width: 150px; float: left">
                <div style="display: block; "><span class="negrilla  colorRojo">Cantidad</span></div>               
                <div style="display: block; "><span class="negrilla"><?php echo $reg->cantidad; ?></span></div>
            </div>
            <div class="f12" style="display: block-inline; width: 200px; float: left">
                <div style="display: block; "><span class="negrilla  colorRojo">Observaciones</span></div>               
                <div style="display: block; "><span class="negrilla"><?php echo $reg->observaciones; ?></span></div>
            </div>

          

        

    
<?php
    $ids = $ids_seleccionados;
    $vec = $ids . split(",");
    $cont = 1;
    for($i = 1;$i < $vec . length;$i++) {
    $inf = $vec[i] . split("-");

    if($inf[0]==$id_serv_pro) {
    $cont = parseInt($inf[1])+1;
    }
    }
    ("#".$id_serv_pro) . addClass("seleccionado");
    ("ids_seleccionados").val(("ids_seleccionados").val().','.$id_serv_pro."-".$cont);
    $c = parseInt(("cant_item").val())+1;
    ("cant_item") . val($c);?>

    <div class='grid_20 fondo_amarillo bordeado ' id='sel.$id_serv_pro.$cont' >
        <div class='grid_2 negrilla'><?php ("#".$id_serv_pro." #cod_p").val() ?><input type='hidden' id='cod_ps' value=<?php ("#".$id_serv_pro." #cod_p").val() ?>></div>
        <div class='grid_8'>
            <div class='grid_8'><?php ("#".$id_serv_pro." #tit_p").val() ?> <input type='hidden' id='tit_ps' value=<?php ("#".$id_serv_pro." #tit_p").val() ?>></div>
            <div class='grid_8'><?php ("#".$id_serv_pro." #desc_p").val() ?><input type='hidden' id='desc_ps' value=<?php ("#".$id_serv_pro." #desc_p").val() ?>></div>
            <div class='grid_8'><textarea placeholder='Escriba su comentario aqui' id='coment' class='textarea_redond_450x50 ocultar'></textarea></div>
        </div>
        <div class='grid_1'>
            <div id='ver' class='comentario milink' title='Adicionar comentario' onclick='mostrar_quitar_coment($id_serv_pro,$cont,1)'></div>
            <div id='oculta' class='nocomentario milink ocultar' title='Quitar comentario' onclick='mostrar_quitar_coment($id_serv_pro, $cont, 0)'></div>
        </div>
        <div class='grid_2'><input title='cantidad' id='cantidad' type='text' class='input_redond_100 alin_cen margin_cero' placeholder='Cantidad' onkeyup='calcular_importe()' ></div>
        <div class='grid_2'><input title='Unidad Medida' id='um' type='text' class='input_redond_100 alin_cen margin_cero' placeholder='Unidad Medida' value=<?php ("#".$id_serv_pro." #um_p").val() ?>></div>
        <div class='grid_2'><input title='Precio Unitario' id='pu' type='text' class='input_redond_100 alin_cen margin_cero' placeholder='Precio Unitario' onkeyup='calcular_importe()' value=<?php ("#".$id_serv_pro." #prec_p") . val() ?>></div>
        <div class='grid_2'><input title='Subtotal' id='subtotal' type='text' class='input_redond_100 alin_cen margin_cero' placeholder='subtotal' readonly='readonly'></div>
        <div class='grid_1'>
            <div style='float:rigth;' id='duplicar' class='duplicarItem milink' title='Duplicar Item' onclick='seleccionar_producto2(<?php $id_serv_pro ?>);calcular_importe();'></div>
            <div style='float:rigth;' id='quitar' class='quitarItem milink' title='Quitar Item' onclick='quitaritem($id_serv_pro, $cont );calcular_importe();'></div>
        </div>
    </div>
    
     
        
      
        
       <?php
    }
    }?>
    
   </div>    </div>
    
    
    
    
    
  