<?php
$nom = "";
$cod = "";
$descr = "";
$total = "";
$sn = "";



if ($id_send2 != 0) {
    $nom = $d_grupo->Nombre_grupo;
    $cod = $d_grupo->codigo_grupo;
    $sn = $d_grupo->SN;
    $total = $d_grupo->cant_total_pieza;
    $descr = $d_grupo->Descripcion;
}
?>

    <div class="" id="respuesta"></div>
    <input type="hidden" id="id_grup" value="<?php echo $id_send2;?>">
        
   
        <div class="grid_9" >
            <input class="input_redond_300" type="text" id="nom"  placeholder="Ingrese el nombre del grupo" value="<?php echo $nom; ?>">
            <div class="f11 negrilla"> Nombre</div>
        </div>

        <div class="grid_9">
            <input class="input_redond_300" type="text" id="cod"  placeholder="Ingrese el codigo del grupo" value="<?php echo $cod; ?>">
            <div class="f11 negrilla"> Codigo propio</div>
        </div>
        <div class="grid_9" >
            <input class="input_redond_300" type="text" id="sn" placeholder="Ingrese el numero de serie del grupo" value="<?php echo $sn; ?>">
            <div class="f11 negrilla"> Número de Serie</div>
        </div>
   
        
        <div class="grid_9">
            <textarea class="textarea_redond_463x151" style="margin:15px 0 0 0;" type="text" id="descr"   placeholder="Escriba cada uno de los elementos que contiene este grupo" ><?php echo $descr; ?></textarea>
            <div class="f11 negrilla"> Descripción</div>
        </div>
         <div class="grid_9">
             
            <div class="f11 negrilla alin_der"> Total de Piezas</div>
            <div>
            <input class="input_redond_150 alin_der" style="float:right; margin: 0" type="text" id="total" placeholder="Cantidad" value="<?php echo $total; ?>">
            </div>
        </div>


<script>cambios();</script> 