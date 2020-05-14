<?php
$nom="";$desc="";$cod_pro="";
 

if($id_send!=0)
{
    $nom=$d_categoria->nombre;
    $desc=$d_categoria->descripcion;
    $cod_pro=$d_categoria->cod_propio;
   
}
?>
    
     <div class="grid_20"> 
        
        <div id="respuesta"></div>
        
        <div class="grid_50" style="height: 70px">
            <input type="hidden" id="id_cate" value="<?php echo $id_send;?>">
            <input class="input_redond_350" type="text" id="nom" <?php //echo $rs_llave;    ?>  placeholder="Introduzca el nombre" value="<?php echo $nom ;?>">
            <div class="f11 negrilla colorAzul"> Nombre de Categoria</div>
        </div>
        <div class="grid_20" style="height: 70px">
            <input class="input_redond_350" type="text" id="desc" <?php //echo $rs_llave;    ?>  placeholder="Introduzca la descripción" value="<?php echo $desc ;?>">
            <div class="f11 negrilla colorAzul"> Descripción</div>
        </div>
            
        <div class="grid_20" style="height: 70px">
            <?php
            
            ?>
            
            <input onkeyup="$('#cod_pro').val($('#cod_pro').val().substr(0, 4).toUpperCase());" class="input_redond_350" type="text" id="cod_pro" <?php //echo $rs_llave;    ?>  placeholder="introduzca un codigo de 4 letras" value="<?php echo $cod_pro ;?>">
            <div class="f11 negrilla colorAzul"> Codigo de Categoria</div>
        </div>
        <div class="grid_20" style="height: 100px"></div>
     </div>


