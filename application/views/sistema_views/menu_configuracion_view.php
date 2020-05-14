<div class="titulo_contenido"><?php
echo "$titulo";
?></div>
<div  style=" height: 35px ;display: block; padding:5px 5% 0px 0px;">
    <div class="boton" style="float: right;" onclick="alert('nuevo modulo');">
        Nuevo modulo
    </div>

</div>
<div style="display: block; padding: 5px;">
    <?php
    foreach ($datos_menu_pantalla as $modulos) {
        ?>
        <div class="div200x300 fondo_plomo" >
            <div class="interno" >
               
                <div class="tit">
                    <?php echo $modulos->titulo; ?>
                </div>
                
                <?php
                $menus = $menu_modulos[$modulos->id];
                for ($i = 0; $i < count($menus); $i++) {
                    ?>
                    <div class="item_modulos milink">
                        <?php echo $menus[$i]['titulo']; ?>
                    </div>
                    <?php
                }
                ?>
                
            </div>
            <div class="controles f12">
                 <div class="boton_editar milink"  title="Editar Modulo" onclick="alert('editar modulo');">Editar Modulo</div>
                 <div class="boton_nuevo_menu milink" title="Nuevo menu del modulo" 
                      onclick="dialog_contenidos_nuevo_menu('div_formularios_dialog','<?php echo base_url() ?>sistema/formulario_nuevo_menu',' <?php echo $modulos->titulo; ?>',<?php echo $modulos->id;?>);" >Nuevo Menu</div>
            </div>
             
        </div>    
    <?php
}
?>
   
</div>
<div id="div_formularios_dialog" class="formulario_nuevo_menu ocultar" style="height: 300px; width: 400px;">cargando...</div>

