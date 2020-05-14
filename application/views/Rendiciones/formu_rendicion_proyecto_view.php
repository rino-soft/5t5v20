<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of registro_asiento_view
 *
 * @author POMA RIVERO
 */
//echo 'registro cuenta';
?>

<div class="titulo_contenido"><?php
echo "$titulo";

?></div>


<div style="display: table; width: 95%">
    <div style="display: table-row">
        <!--<div  style="height: 35px ;display: table-cell; padding:5px 5% 5px 5px; float: left">
             
            <div class="boton milink negrilla"  style="float: left; display: table-cell" 
                 onclick="dialog_nuevo_for_rendicion('div_formularios_dialog','<?php //echo base_url() . "contabilidad_plan_cuentas/nueva_rendicion/0"; ?>','Nueva Rendicion')">
               Nuevo registro rendicion
            </div>
            
            
           
            

        </div>-->
        <div style="display: table-cell;">
            <div style="float:right; display: table-cell; " class="alin_der">
                <input class="fondobuscar300" id="search_rendicion" placeholder="B U S C A R" onkeypress="search_ren_jp(event);">
                 <br> Nro de Registros :
                <select id="mostrarX" onchange="$('#pagina_registros').val(1);  search_and_list_rendicion_jefe_proy('lista_rendicion');">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="200">200</option>
                    <option value="500">500</option>
                </select>
                <input type="hidden" value="1" id="pagina_registros">
            </div>

        </div>
    </div>
   
    
</div>

<div id="lista_rendicion" style="display: block;"></div>
         


<div id="div_formularios_dialog" class="formulario_nuevo_menu ocultar container_20" style="height: 300px; width: 400px;">cargando...</div>




<script>  search_and_list_rendicion_jefe_proy('lista_rendicion');</script>




