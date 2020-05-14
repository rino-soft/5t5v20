<div  class=" f12 grid_8 mayusculas alin_cen" style=""><?php echo $consul5->row(0)->nombre . " " . $consul5->row(0)->ap_paterno . " " . $consul5->row(0)->ap_materno; ?></div> 
<div class="grid_8 suffix_1 alin_cen" >
    <input type="hidden" value="<?php echo $consul5->row(0)->id_user_encargado; ?>" id="cod_u" >
    <input title = "Clave Operacional" id = "cod_ope" type = "password" class ="grid_3 alin_cen margin_cero input_redond_200" placeholder="Codigo Operacional" value="<?php echo $consul5->row(0)->cod_operacional; ?>">     
    </input>
</div>
<div class="grid_8 suffix_1 alin_cen" id="ayuda">mensaje:</div>
    





