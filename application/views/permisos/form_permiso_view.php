<input type="hidden" id="id_usuario_selec" value="<?php echo $d_usuario->cod_user?>">
<div class="tam400 f10">
    Asignacion de permisos a:<span class="negrilla"><?php echo $d_usuario->nombre." ".$d_usuario->ap_paterno." ".$d_usuario->ap_materno?></span> 
</div>
<div class="tam400 f10">
    Asignar configuracion guardada ? 
    <select id="perfil" onchange="cargar_config_perfil('perfil')">
        <option value="0" selected="selected"> No Gracias !</option>
        <?php
        foreach ($lista_perfiles->result() as $perf)
        {
            echo "<option value='$perf->id_perfil'>$perf->nombre</option>";
        }
        ?>
    </select>
</div>
   


<?php
$i = 0;


foreach ($menu_superior as $ms) {
    ?>
    <div class="tam400 borde_abajo   esparriba10" >                    
        <div class="f12 tam400">
            <div class="f10 negrilla espabajo5 colorGuindo">  <?php echo $ms->titulo; ?></div>      
            <?php
            $mdetalle = $menu_detallado[$i][0];
            $controles = $menu_detallado[$i][1];
            foreach ($mdetalle as $mh) {
                ?>
                <div class="f10 cambio_fondo nocheckdiv tam400" id="menu<?php echo $mh->id; ?>" >
                    <div>
                        <input type="hidden" id="id_menu" value="<?php echo $mh->id; ?>"> 
                        <input type="checkbox" onclick="seleccionar_menu('<?php echo $mh->id; ?>','menus_selec','menu')" id="<?php echo "c" . $mh->id; ?>" class="nocheck" 
                               value="<?php echo $mh->id ?>">
                               <?php echo $mh->titulo; ?>
                    </div>
                </div>
                <?php $cont = $controles[$mh->id]; ?>

                <div class="f10 tam400">
                    <div class="tam400 colorverde">
                        <div style="padding-left: 30px;">
                            <?php
                            foreach ($cont as $cd) {
                                ?>
                                <div class="f10 cambio_fondo nocheckdiv tam350 " id="menu<?php echo $cd->id_control; ?>" >
                                    <div title="controles de <?php echo $mh->titulo; ?>">
                                        <input type="checkbox" onclick="seleccionar_menu('<?php echo $cd->id_control; ?>','control_selec','control')" 
                                               id="<?php echo "co" . $cd->id_control; ?>" class="nocheck" value="<?php echo $cd->id_control ?>">
                                               <?php echo $cd->descripcion_control; ?>
                                        <input type="hidden" id="id_menu" value="<?php echo $cd->id_control; ?>"> 
                                    </div>

                                </div>


                            <?php } ?>
                        </div>
                    </div>

                </div>


            <?php } $i++; ?> 

        </div>                               
    </div>
    <?php
}
?> 
<div class="tam350 espaciado10 fondo_amarillo_claro">
    <input type="checkbox" id="guardar_perfil" onclick="mostrar_ocultar('guardar_perfil','perfil_form')">
    ¿Desea guardar la configuración actual de permisos?
    <div class="ocultar" id="perfil_form">
                <div><input type="text" class="input_redond_250 f10" placeholder="Nombre de la configuración" id="nomperfil"></div>
                <div class="f10">Nombre de la configuración</div>
    </div>
</div>
<input type="hidden" id="menus_selec" value="<?php echo $men_con_sel[0];?>">
<input type="hidden" id="control_selec" value="<?php echo $men_con_sel[1];?>">
<script>seleccionar_items_seleccionados("menus_selec","control_selec");</script>