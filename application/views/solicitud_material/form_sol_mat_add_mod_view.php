<?php
$pro = "";
$tt = "";
$tit = "";
$comentario = "";
$ea = "";
$pers_resp = "";
$ids = "";
$cant_item = "";
$estado = "";
if ($id_send != 0) {


    $pro = $data_sol_mat->id_proy;
    $tt = $data_sol_mat->tipo_trabajo;
    $tit = $data_sol_mat->titulo;
    $comentario = $data_sol_mat->comentario_obs;
    $pers_resp = $data_sol_mat->id_user_encargado;
    $ea = $data_sol_mat->id_personal_destino;
    $estado = $data_sol_mat->estado;
    $ids = "";
    $cant_item = $detalle_sol_mat->num_rows();


    $vec_ids = array();
    $i = 0;
    $codigo_items = "";
    //echo "<br>antes del foreach";
    foreach ($detalle_sol_mat->result() as $item) {
        $items_cod = "";
        $vec[$i] = $item->id_producto_serv;
        $i++;
        $cont = 0;

        for ($c = 0; $c < count($vec); $c++) {
            if ($vec[$c] == $item->id_producto_serv)
                $cont++;
        }
        $ids.="," . $item->id_producto_serv . "-" . $cont;

        $items_cod = "<div class='grid_20 fondo_amarillo bordeado ' id='sel" . $item->id_producto_serv . "-" . $cont . "' >
                <div class='grid_2 negrilla'>-" . $item->cod_serv_prod . " <input type='hidden' id='cod_ps' value='" . $item->cod_serv_prod . "'></div>
                <div class='grid_8'>
                    <div class='grid_8'>" . $item->nombre_titulo . " <input type='hidden' id='tit_ps' value='" . $item->nombre_titulo . "'></div>
                    <div class='grid_8'>" . $item->descripcion . " <input type='hidden' id='desc_ps' value='" . $item->descripcion . "'></div>
                </div>
                <div class='grid_6'><textarea placeholder='Escriba su comentario aqui' id='coment' class='textarea_redond_300x45'>" . $item->comentario . " </textarea></div>
                <div class='grid_3'><input title='cantidad Solicitada' id='cantidad' type='text' class='input_redond_50 alin_cen margin_cero' placeholder='Cantidad' value='" . $item->cantidad_sol . "' >" . $item->unidad_medida . "</div>
                <div class='grid_1'>
                        <div style='float:rigth;' id='duplicar' class='duplicarItem milink' title='Duplicar Item' onclick='duplicar_iterm(\"sel" . $item->id_producto_serv . "-" . $cont . "\",\"detalle_sol_mat\",\"" . $item->id_producto_serv . "\",\"" . $cont . "\")'></div>
                        <div style='float:rigth;' id='quitar' class='quitarItem milink' title='Quitar Item' onclick='quitaritem(" . $item->id_producto_serv . "," . $cont . ");'></div>
                </div>
                </div>";
        $codigo_items.=$items_cod;
    }
}
?>
<div class="container_20">

    <div class="grid_20 ">    
        <div class="grid_20 esparriba5">

            <div class="grid_10"> 
                <div class=" grid_10"> 
                    <div class="f12 negrilla"> Proyecto : 
                        <select id="id_proyecto" onchange="select_personal_dep('id_proyecto','personal_dependiente','id_per_resp','')">
                            <option value="0"> Seleccione un Proyecto </option>
                            <?php
                            if ($proyectos_res->num_rows() > 0) {
                                foreach ($proyectos_res->result()as $p) {
                                    if ($pro == $p->id_proy)
                                        echo "<option value='$p->id_proy' selected='selected'>$p->nombre</option>";
                                    else
                                        echo "<option value='$p->id_proy'>$p->nombre</option>";
                                }
                            }
                            ?>
                        </select></div>
                    <input class="" type="hidden" id="id_sol_mat" value="<?php echo $id_send; ?>" placeholder="id_solicitud_material 0 para nuevo">


                </div>
                <div class="grid_10"><span class="negrilla">Personal Responsable del material:</span>
                    <div id="personal_dependiente" style="display: inline">Seleccione el Proyecto Primero</div>
                    <?php
                    if ($pers_resp != "")
                        echo "<script>select_personal_dep('id_proyecto','personal_dependiente','id_per_resp','$pers_resp');</script>";
                    ?>
                </div>
                <div class="grid_10"><span class="negrilla">Tipo de trabajo:</span>
                    <select id="ttrab">
                        <option value="Preventivo" <?php if ($tt == "Preventivo") echo "selected='selected'"; ?>>Preventivo</option> 
                        <option value="Correctivo" <?php if ($tt == "Correctivo") echo "selected='selected'"; ?>>Correctivo</option> 
                        <option value="Instalacion"<?php if ($tt == "Instalacion") echo "selected='selected'"; ?>>Instalacion</option> 
                        <option value="Extra Works"<?php if ($tt == "Extra Works") echo "selected='selected'"; ?>>Extra Works</option> 
                    </select>
                </div>

            </div>
         <div class="grid_10"><input class="fondobuscar500" id="in_search" placeholder="Introdusca los Materiales que necesita"
                                        onkeypress="search_tipo_grilla(event,'grilla_sol_mat');">
                <div class="grid_10 alin_der">
                    nro de registros :
                    <select id="mostrar_X" onchange="$('#pagina').val(1);busqueda_prod_serv_tipo_grilla('grilla_sol_mat');">
                        <option value ="5" selected="selected" >5</option>
                        <option value ="10" >10</option>
                        <option value ="20" >20</option>
                        <option value ="50" >50</option>
                        <option value ="100" >100</option>
                    </select> 

                </div>
                <input type="hidden" value="1" title="pagina" id="pagina">
                <input type="hidden" value="<?php echo $ids; ?>" title="ids_selec" id="ids_seleccionados">
                <input type="hidden" value="<?php echo $cant_item; ?>" title="cant Intem" id="cant_item" >
            </div>
        </div>
        <div class="grid_20">
            <span class="negrilla">Titulo:</span><input id="tit_sm" type="text" value="<?php echo $tit; ?>" placeholder="Introdusca el Titulo (max 100 caracteres)" class="input_redond_350" style="width: 940px" maxlength="100" >
        </div>
        <div class="clear esparriba5"></div>

        <div class="grid_20" id="resultado_busqueda" ></div>
        <div class="grid_20 fondo_azul colorAmarillo negrilla alin_cen">
            <div class="grid_2">Cod</div>
            <div class="grid_8">Descripcion / detalle</div>
            <div class="grid_6">Comentario</div>
            <div class="grid_3">Cantidad Solicitada</div>
            <div class="grid_1 colorAzul"> -</div>                        
        </div>
        <?php if ($id_send != 0) { ?>
            <div class="grid_20" id="detalle_sol_mat">
                <div class="grid_20 ">
                    <?php
                    if ($codigo_items == "")
                        echo "";
                    else
                        echo $codigo_items;
                    ?>
                </div>
            </div>

            <?php
        } else {
            ?>
            <div class="grid_20" id="detalle_sol_mat">

            </div>
        <?php } ?>

        <div class="grid_20 f12">
            Comentario :
            <textarea id="comentario_general" placeholder="puede escribir un comentario general" class="textarea_redond_990x50"><?php echo $comentario; ?></textarea>
        </div>
        <div>Enviar el formulario a : 
            <select id="id_personal_responsable">
                <option>seleccione al encargado</option>
                <?php
                if ($enviar_a->num_rows() > 0) {
                    foreach ($enviar_a->result()as $e_a) {
                        if ($ea == $e_a->id_usuario)
                            echo "<option value='$e_a->id_usuario' selected='selected'>$e_a->ap_paterno $e_a->ap_materno, $e_a->nombre</option>";
                        else
                            echo "<option value='$e_a->id_usuario'>$e_a->ap_paterno $e_a->ap_materno, $e_a->nombre
                                        </option>";
                    }
                }
                ?>
            </select>
        </div>
       <?php if ($id_send != 0){?>
        <div class="OK espaciado"> Ultimo estado : <?php echo $estado; ?>
        </div><?php }?>
    </div>
    <div class="grid_20" id="mensajes_respuestas"></div>
</div>
<?php
//echo $estado;
if ($estado == "Enviado a Almacen")
{
    echo "<script> $('#send').button('disable');$('#save').button('disable');</script>";
}
else {

    if ($estado == "Guardado") {
        echo "<script> $('#send').button('enable');
             $('#save').button('option', 'label', 'Editar');</script>";
    } else {
        echo "<script> $('#send').button('disable');</script>";
    }
}
?>
