
<!--<script src="<?php echo base_url(); ?>JS/rendiciones_r.js"></script>-->
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

?>

<div class="titulo_contenido"><?php
echo "$titulo";

?></div>


<div style="display: table; width: 95%">
    <div style="display: table-row">
       
         <div  style="height: 35px ;display: table-cell; padding:5px 5% 5px 5px; float: left">
             
            <div class="boton milink negrilla"  style="float: left; display: table-cell" 
                 onclick="dialog_nuevo_for_rendicion('div_formularios_dialog','<?php echo base_url() . "rendiciones/nueva_rendicion/0"; ?>','Nuevo registro de Rendicion/reembolso')">
               Nuevo registro rendicion
            </div>
             <div class="help_rend milink fondo_help" title="Ayuda" style="height: 32px;width: 32px"
                  onclick="ver_archivo('imagenesweb/recursos/mrr_tec.pdf','Información')">
                 
             </div>
             <div class="help_foto milink link f10 negrilla botonResalta" style="height: 30px;width: 150px; float: left; margin: 0 0 0 30px;" title="Ayuda para Reducir fotografias e imagenes" 
                  onclick="ver_archivo('imagenesweb/recursos/FOTOSIZER.rar','Información')"> Programa para reducir imagenes y fotografias
                 
             </div>
         </div>
        
        <div style="display: table-cell;">
            <div style="float:right; display: table-cell; " class="alin_der">
                <input class="fondobuscar300" id="search_rendicion" placeholder="B U S C A R" onkeypress="search_te(event);">
                 <br> Nro de Registros :
                <select id="mostrarX" onchange="$('#pagina_registros').val(1);  search_and_list_mis_rendiciones_te('lista_rendicion');">
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




<script> search_and_list_mis_rendiciones_te('lista_rendicion');</script>
