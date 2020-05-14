<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of vista_vehiculo_regional_view
 *
 * @author POMA RIVERO
 */
echo "";

?>

<div class="titulo_contenido "><?php
echo "$titulo";

?></div>
        <!--  <div class="alin_izq  NO_reg f12 esparriba10 espabajo5"><span class="f16 negrilla">MIS ASIGNACIONES!!!...</span></div>--->

<div class="espabajo10" style="display: table; width: 95%">
     <div style="display: table-row">
        <div style="display: table-cell;">
            <div style="float:right; display: table-cell; " class="alin_der">
                <input class="fondobuscar300" id="search_ov_pf" placeholder="B U S C A R  V E H I C U L O" onkeypress="search_vr(event);">

            </div>
        </div>
     </div>
</div>

<div class="f12 espabajo10" style="width: 1150px; margin-left: 15px">
    <div class="fondo_verde_cla OK" style="display: table-cell;width: 575px">
         <div class="negrilla colorAzul">Cantidad de vehiculos asignados : <span class="colorGuindo" id="t_vehi_asig"></span></div> 
         <div class="negrilla colorAzul">Cantidad de vehiculos buenos : <span class="colorGuindo" id="t_bueno"></span></div> 
         <div class="negrilla colorAzul">Cantidad de vehiculos regulares : <span class="colorGuindo" id="t_reg"></span></div> 
         <div class="negrilla colorAzul">Cantidad de vehiculos pesimos : <span class="colorGuindo" id="t_pesi"></span></div> 
    </div>
</div>

<div id="lista_asig_regional" style="display: block;"></div>

<div id="asignar_vehi" style="display: block; height: 300px; width: 400px;" class="ocultar container_20"> </div>

<div id="div_formularios_dialog" class="formulario_nuevo_menu ocultar container_20" style="height: 300px; width: 400px;">cargando...</div>



<script> search_and_asignaciones_regional('lista_asig_regional');</script>

