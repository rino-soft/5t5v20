
<div class="titulo_contenido"><?php
echo "$titulo";
?></div>
<div style="display: table; width: 95%">
    <div style="display: table-row">
        <div  style="height: 35px ;display: table-cell; padding:5px 5% 5px 5px; float: left">
            <div class="boton milink" style="float: left; display: table-cell " 
                 onclick="dialog_nueva_dosificacion('div_formularios_dialog','<?php echo base_url() . "dosificaciones/nueva_dosificacion/0"; ?> ')">
                Nueva dosificacion
            </div>

        </div>
        <div style="display: table-cell;">
            <div style="float:right; display: table-cell; " class="alin_der">
                <input class="fondobuscar300" id="search_dosificacion" placeholder="B U S C A R" onkeypress="search_dosificacion(event);">
                <br> Nro de Registros :
                <select id="mostrarX" onchange="$('#pagina_registros').val(1); search_and_list_dosificacion('lista_dosificaciones');">
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
 <div id="lista_dosificaciones" style="display: block;"></div>
         


<div id="div_formularios_dialog" class="container_20 formulario_nuevo_menu ocultar" style="height: 300px; width: 400px;">cargando...</div>
    

<script> search_and_list_dosificacion('lista_dosificaciones');</script>
