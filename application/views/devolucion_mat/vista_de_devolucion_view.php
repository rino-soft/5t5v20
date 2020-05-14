
<input type="hidden"  id="id_dev_mat" value="<?php echo $id_sol_dev; ?>">
<input type="hidden" id="id_mov" value=" <?php echo $id_mov ?>">


<?php if ($registros_prod_alma->num_rows() > 0) { ?>
    <div class="container_20 " style="">

        <input type="hidden" id="ids_selec">
        <div class="grid_20" id="respuestas_ayuda"> </div>
        <div class="grid_20">
            <div class="grid_10" style="height: 30px">
                <div class=" grid_2 f11 negrilla colorAzul"> Proyecto :
                </div> 
                <div class=" grid_2 f11 negrilla negrilla"><?php echo $registros1->row(0)->nombre_proy; ?> 
                </div>     
            </div>
            <div class="grid_10 f11 negrilla colorAzul" > Enviar a:
                <select id="alm" onchange="">

                    <?php
                    foreach ($encargado->result() as $encar) {
                        if ($encar->id_usuario == $alm)
                            echo ' <option selected="selected" value="' . $encar->id_usuario . '">' . $encar->nombre .' '.$encar->ap_paterno. '</option>';
                        else
                            echo ' <option value="' . $encar->id_usuario . '">' . $encar->nombre .' '.$encar->ap_paterno. '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>


        <div class="grid_20 fondo_plomo_claro_areas borde_abajo borde_arriba borde_der borde_izq colorAmarillo fondo_azul">
            <div class="grid_1 negrilla">Item</div>
            <div class="grid_2 negrilla">Codigo</div>
            <div class="grid_5 negrilla">Titulo /Descripción /Observación</div>
            <div class="grid_2 negrilla">Tipo</div>
            <div class="grid_2 negrilla alin_cen">Cantidad Asignada</div>
            <div class="grid_2 negrilla alin_cen">Cantidad Utilizada</div>
            <div class="grid_2 negrilla alin_cen">Cantidad devuelta</div>
            <div class="grid_4 negrilla alin_cen">Justificaciones</div>
        </div> 
        <div class="grid_20 borde_abajo ">   
            <?php
            $vec = array();
            $i = 0;
            $ids = "";
         
            foreach ($registros_prod_alma->result() as $reg) {
                if ($id_sol_dev == 0) {
                    $idarticulo = $reg->id_articulo;
                    $obs = $reg->observaciones;
                    $c_a = $reg->cantidad;
                    $c_u = 0;
                    $c_d = 0;
                    $justi = '';
                    $com = $reg->comentario;
                    $cn = $reg->cod_prop_sts_equipo;
                    $estado="";
                    // $id_mov=$reg->id_mov_alm;
                } else {
                    $idarticulo = $reg->id_serv_pro;
                    $obs = $reg->observacion_producto;
                    $c_a = $reg->cantidad_asignada;
                    $c_u = $reg->cantidad_utilizada;
                    $c_d = $reg->cantidad_devuelto;
                    $justi = $reg->justificacion_dev;
                    $com = $reg->comentario_dev;
                    $cn = $reg->CN;
                    $estado=$reg->estado_devolucion;
                    // $id_mov=$reg->id_movi_alm;
                }
                $vec[$i] = $idarticulo;
                $i++;

                $cont = 0;
                for ($c = 0; $c < count($vec); $c++) {
                    if ($vec[$c] == $idarticulo)
                        $cont++;
                }
                $ids.="," . $idarticulo . "-" . $cont;
                ?>

                <div  id="<?php echo $idarticulo . "-" . $cont; ?>" class="grid_20 borde_abajo cambiar">

                    <div class="f12 grid_1 alin_cen colorGuindo negrilla" style="display: block-inline; float: left">  
                        <div style="display: block; "><?php if ($reg->item != "") echo $reg->item; else echo "&nbsp;" ?></div>

                    </div>
                    <div class="f12 grid_2"style="display: block-inline; float: left"> 
                        <div style="display: block; "><?php if ($reg->cod_serv_prod != "") echo $reg->cod_serv_prod; else echo "&nbsp;" ?></div>

                    </div>
                    <div class="f12 grid_5 alin_izq"style="display: block-inline; float: left"> 
                        <div class="negrilla" style="display: block; "><?php if ($reg->nombre_titulo != "") echo $reg->nombre_titulo; else echo "&nbsp;" ?></div>
                        <div class="f10" style="display: block; "><?php if ($reg->descripcion != "") echo $reg->descripcion; else echo "&nbsp;" ?></div>
                        <div class="f10" style="display: block; "><?php if ($obs != "") echo $obs; else echo "&nbsp;" ?></div>

                    </div>

                    <div class="f12 grid_2 "style="display: block-inline;  float: left"> 
                        <div style="display: block; "><?php if ($reg->tipo != "") echo $reg->tipo; else echo "&nbsp;" ?></div>
                    </div> 

                    <div class="grid_2 alin_cen" style="">
                        <input class="input_redond_60" type="text" title="cantidad asignada" id="can_asig" placeholder="" value="<?php echo $c_a; ?>" onkeyup='calcular_cantidades()' readonly='readonly' >
                    </div>

                    <div class="grid_2 alin_cen" style="">
                        <input class="input_redond_60" type="text" title="cantidad utilizada"  id="can_uti" placeholder="" onkeyup='validarSiNumero("can_uti");calcular_cantidades();'  value="<?php echo $c_u; ?>">
                    </div>

                    <div class="grid_2 alin_cen" style="">
                        <input class="input_redond_60" type="text" title="cantidad total" id="cantidad_total"  placeholder="" value="<?php echo $c_d; ?>" readonly='readonly'>


                    </div>

                    <div class="grid_4 alin_cen">
                        <textarea id="just" class="textarea_redond_221x37" type="text"  placeholder="Justificación"><?php echo $justi; ?></textarea>




                        <input type="hidden"  id="id_pro" value="<?php echo $reg->id_serv_pro; ?>">
                        <input type="hidden" id="sn" value="<?php echo $reg->SN; ?>">
                        <input type="hidden" id="cn" value="<?php echo $cn; ?>">
                        <input type="hidden" id="obser" value="<?php echo $obs; ?>">

                    </div>


                </div>


            <?php }
            ?>
            <script> $("#ids_selec").val("<?php echo $ids; ?>")</script>
        </div>

        <div class="grid_8">
            <textarea class="textarea_redond_450x50" type="text" id="coment" placeholder="Comentario" ><?php echo $com; ?></textarea>
        </div>
        <input type="hidden" id="proy" value="<?php echo $registros1->row(0)->id_proyecto; ?>">
    </div>
    <div id="listado"></div>
    
    
    <?php
echo $estado;
if ($estado == "Enviado a Almacen")
{
    echo "<script> $('#button-enviar').button('disable');
        $('#save').button('disable');</script>";
}
else {

    if ($estado == "Guardado") {
        echo "<script> $('#button-enviar').button('enable');
             $('#save').button('option', 'label', 'Editar');</script>";
    } else {
        echo "<script> $('#button-enviar').button('disable');</script>";
    }
}
?>
    

    <?php
}
else {

    echo("el movimiento de almacen no tiene detalles");
}
?>

    

    












