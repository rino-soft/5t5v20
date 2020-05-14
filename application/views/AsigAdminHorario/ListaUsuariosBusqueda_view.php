<div class="container_12">
<input type="hidden" value="<?php echo base_url(); ?>" id="burl">
<div class="clear esparriba"></div>
<div class="grid_4 fondoazul blanco_text negrilla " >
    <div class="grid_1 centrartexto">
        CI
    </div>
    <div class="grid_3 centrartexto">
        NOMBRE COMPLETO
    </div>
</div>

<div class="grid_4 ">
    <?php
    $sw = 0;
    $ii = 0;
    foreach ($tabla_resultado as $res)
    {
        $sw = 1;
        //$boton = "<div class='boton_seleccionar milink' onclick='seleccionar_usuario(" . $res->codadm_pk . ");' ></div>";
        $boton="<div class='boton_seleccionar'><INPUT TYPE='checkbox' id='chk_".$res->cod_user."'  onclick='javascript:seleccionar_usuario(" . $res->cod_user . ")'></div>";
        
        echo '<div class="grid_1 bordeArriba centrartexto esparriba "> <input type="hidden" id="CiResultado' . $res->cod_user . '" value="' . $res->ci . '" >' . $res->ci . ' </div>
    <div class="grid_3 bordeArriba esparriba  ">' . $boton . ' <input type="hidden" id="nombreResultado' . $res->cod_user . '" value="' . $res->nombre . ' ' . $res->ap_paterno . ' ' . $res->ap_materno . '">' . ucwords(strtolower($res->nombre . ' ' . $res->ap_paterno).''.$res->ap_materno) . ' </div>
    <div class="clear"></div>';
        $ii++;
    }
    if ($sw == 0)
        echo "<div class='grid_6'>No se han encontrado RESULTADOS</div>";
    ?>
</div>
</div>