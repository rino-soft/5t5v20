<div class="container_12 f12">
<div class="clear esparriba"></div>
<div class="grid_5 fondoazul blanco_text negrilla " >
    <div class="grid_5" >
        Resultado obtenido    
    </div>
    <div class="grid_1 centrartexto">
        CI
    </div>
    <div class="grid_3 centrartexto">
        Apellidos y Nombres
    </div>
    <div class="grid_1 centrartexto ">
        Estado
    </div>
     
</div>
<div class="clear"></div>

<div class="grid_6 ">
    <?php
    $sw = 0;
    $ii=0;
    if($permisos_usuario->num_rows()>0)
        {$permiso=$permisos_usuario->row(); $sw=true;}
    
    foreach ($tabla_resultado as $res) {
        $sw = 1;
        $clase='';
        $buton="<div class='menubotones_adicionar milink' title='Adicionar a dependientes' onclick='Dialog_altaPersonalProyecto(".$res->cod_user.");' ></div>";
        if($sw and $permiso->p_adicionar<1){
            $buton="";
         }
        if($tabla_estados[$ii]=="Ocupado")
        {$buton='';
        $clase=' fondoplomoclaro ';
        }
        echo '<div class="grid_1 bordeArriba centrartexto esparriba '.$clase.'"> <input type="hidden" id="CiResultado'.$res->cod_user.'" value="'.$res->ci .'" >' . $res->ci . ' </div>
    <div class="grid_3 bordeArriba esparriba '.$clase.' ">'.  $buton.' <input type="hidden" id="nombreResultado'.$res->cod_user.'" value="'.$res->nombre . ' ' . $res->ap_paterno. ' ' . $res->ap_materno.'">' . ucwords(strtolower( $res->ap_paterno. ' ' . $res->ap_materno.', '.$res->nombre  )). ' </div>
    <div class="grid_1 bordeArriba centrartexto esparriba '.$clase.'">'.$tabla_estados[$ii].' </div>
    <div class="clear"></div>';
        $ii++;
    }
    if ($sw == 0)
        echo "<div class='grid_6'>No se han encontrado RESULTADOS</div>";
    ?>
</div>
</div>




