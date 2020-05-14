<?php
$nom = "";
$cod = "";
$descr = "";


if ($id_send != 0) {
    $nom = $d_grupo->nombre;
    $cod = $d_grupo->cod_propio;
    $descr = $d_grupo->descripcion;
}
?><div class="container_20">

    <div class="grid_20">
        <div class="negrilla  fondo_azul colorAmarillo f14 alin_cen ">
            Nuevo Grupo de Equipos, Repuestos, Herramientas
        </div>
  
    </div>


    <div class="grid_13"  style="height:70px">
        <input class="input_redond_350" type="text" id="nom" <?php //echo $rs_llave;     ?>  placeholder="" value="<?php echo $nom; ?>">
        <div class="f11 negrilla"> Nombre</div>
    </div>

    <div class="grid_7" style="height:70px">
        <input class="input_redond_250" type="text" id="cod" <?php //echo $rs_llave;     ?>  placeholder="" value="<?php echo $cod; ?>">
        <div class="f11 negrilla"> Codigo propio</div>
    </div>
    <!-- <div class="grid_15"> 
     <div class="grid_8" style="height:80px" >
          <textarea class="textarea_redond_450x50" type="text" id="descr" <?php //echo $rs_llave;     ?>  placeholder="Escriba una descripción del nuevo grupo" ><?php echo $descr; ?></textarea>
          <div class="f11 negrilla"> Descripción</div>
     </div></div> -->   




    <div class="grid_20 fondo_plomo_claro_areas "> 

        <div class="grid_20 esparriba5">

            <div class="grid_14 prefix_6"><input class="fondobuscar" id="in_search" placeholder="B U S C A R  A R T I C U L O" onkeypress="search_para_grupo(event);">

            </div>
            <div class="prefix_15 grid_5"> 
                <div class="grid_5 alin_der">
                    mostrar
                    <select id="mostrar_J" onchange="cambiarpaginacion(1)">
                        <option value ="5" selected="selected" >5</option>
                        <option value ="10" >10</option>
                        <option value ="20" >20</option>
                        <option value ="50" >50</option>
                        <option value ="100" >100</option>
                    </select> registros

                </div>
                <input type="hidden" value="1" id="pagina">
                <input type="hidden" value="" id="ids_seleccionados">
                <input type="hidden" value="0" id="cant_item" >
            </div>
        </div>
        <div class="clear"></div>
        <div class="grid_20" id="resultado_busqueda" >

        </div>
        <div class="grid_20" id="detalle_ov_pf">

        </div>

        <div id="div_formularios_dialog" class="formulario_nuevo_menu ocultar" style="height: 300px; width: 400px;">cargando...</div>


    </div>

    <br>
    <br>
    <br>
</div>

<script>cambios();</script>