<div class="grid_12">
    <div class="grid_10 prefix_1 suffix_1"><h2>Gestion de menus</h2></div>
    <div class="grid_12">
        <div class="grid_6 ">
            <!--<img src='<?php echo base_url(); ?>/imagenesweb/icono/file-edit.png' height='20' class='milink' title='editar'>-->
            <input type="button" value="Adicionar Nuevo Menu"  onclick="javascript:formulario_nuevo_menu(0);">
            <input type="hidden" value="<?php echo base_url();?>" id="burl">
            <?php
            foreach ($menu_padres as $mp) {
                echo "<div class='grid_6 negrilla'> 
                            <img src='".base_url()."/imagenesweb/icono/file-edit.png' height='20' class='milink' title='editar'
                                onclick='javascript:formulario_nuevo_menu(".$mp->id.");'>
                             " . strtoupper($mp->titulo) . "
                         </div>";

                $hijos = $menu_hijos[$mp->id];
                for ($j = 0; $j < count($hijos); $j++) {
                    $stl= ' fondoplomoblanco bordeado1 ';
                    if($hijos[$j]['estado']=="Inactivo")
                            $stl='NO';
                    echo "<div class='grid_6'>
                                <div class='grid_5 prefix_1 negrilla negrocolor' title='Titulo'>
                                    <img src='".base_url()."/imagenesweb/icono/edit.png' height='20' class='milink' title='editar' 
                                        onclick='javascript:formulario_nuevo_menu(".$hijos[$j]['id'].");' > " . $hijos[$j]['titulo'] . " </div>
                                <div class='grid_4 prefix_2 letrachica' >
                                  <div class='grid_4 $stl '>
                                        <div class='grid_4' title='Controlador'><strong class='negrilla azulmarino'> Controlador :</strong>". $hijos[$j]['controlador'] ."</div>
                                        <div class='grid_4' title='Metodo'> <strong class='negrilla azulmarino'>Metodo:</strong>" . $hijos[$j]['metodo'] . "</div> 
                                  </div>
                                </div>
                              </div>";
                }
            }
            ?>
        </div>
        <div class="grid_4 prefix_1 suffix_1 " id="div_form_adicion_edicion"></div>
    </div>
</div>

<?php
?>
