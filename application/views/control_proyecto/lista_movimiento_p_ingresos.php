<?php
//echo 'id_proy'.$idp;

if ($consulta_proy_sel->num_rows() > 0) {
    ?>  
    <div class="grid_20 fondo_plomo_claro_areas espabajo10" >
        <div  class="grid_2 negrilla"><br>Proyecto:</div> 
        <div class=" grid_4 f11 negrilla colorAzul"><br>  
            <select id="select_proyecto" onchange="lista_mov_usuario()">
                <option value="0" >Seleccione un proyecto</option>
                <?php
                foreach ($consulta_proy_sel->result() as $reg1) {
                    if ($idp == $reg1->id_proy) {
                        $sel = 'selected="selected"';
                    } else {
                        $sel = '';
                    }
                    echo '<option value="' . $reg1->id_proy . '" ' . $sel . '>' . $reg1->nombre . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="grid_6 f11 negrilla colorAzul"> <br>Almacen: 
            <select id="select_almacen">
                <option value="0" selected="selected">Seleccione un almacen</option>
                <?php
                foreach ($consulta_almacen_sel->result() as $reg1) {
                    echo '<option value="' . $reg1->id_almacen . '">' . $reg1->nombre . '</option>';
                }
                ?>
            </select> 
        </div><br>
    </div> 
    <div class='bordeado' id="lista_movimiento_almacen_usuario_sel"></div>
    <div class="grid_20 fondo_azul colorBlanco esparriba5 espabajo5">
        <div class="grid_6 "> <div class="milink link_blanco" onclick="$('#lista_movimiento').html('');$('#in_search').val('');">LIMPIAR LISTA</div></div>
    </div>
    <script>$('#save1_mov').button("enable");</script>
    <?php } else { ?>
    <div style="display: block; width: 100%; float: left;" class="grid_20 colorBlanco negrilla f12 fondoRojo">
    <?php
        echo " 0 registros cargados !  No se han encontrado Registros de proyecto en la Base de Datos defina con Recursos Humanos."; 
        ?>
         <script>$('#save1_mov').button("disable");</script>
    </div>
    <?php
}
?>
