<div  class=" f12 grid_6 mayusculas alin_cen" style="">
    Sr.-<span class="negrilla"><?php echo $consul5->row(0)->nombre . " " . $consul5->row(0)->ap_paterno . " " . $consul5->row(0)->ap_materno; ?></span>
    <br>Introduzca su Codigo Operacional.
</div> 
<div class="grid_6">
    <div >
    <input type="hidden" value="<?php echo $consul5->row(0)->id_user_er; ?>" id="cod_u" >
    <input type="hidden" value="<?php echo $consul5->row(0)->cod_operacional; ?>" id="cod_operacional" >
    
    <input title = "Clave Operacional" id = "cod_ope" type = "password" class ="alin_cen margin_cero input_redond_300" 
           placeholder="Introduzca Codigo operacional" value="">
           
    </input>
    </div>
</div>

<div class="grid_6 alin_cen f12" id="ayuda_menaje"></div>
    





