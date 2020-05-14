
<div class="titulo_contenido"><?php
echo "$titulo";

?></div>
<div style="display: table; width: 95%">
        <div style="display: table-cell;">
            <div  style="height: 35px ;display: table-cell; padding:5px 5% 5px 5px; float: left">
            <div class="boton milink negrilla" style="float: left; display: table-cell;" 
                 onclick="dialog_nuevo_equipo_repuesto('div_formularios_dialog','<?php echo base_url() . "grupo_herramienta/nuevo_grupo/0"; ?> ')">
               Nuevo Equipo /Repuesto
            </div>
            </div>  
            
            <div style="float:right; display: table-cell; " class="alin_der">
                <input class="fondobuscar300" id="search_herra" placeholder="B U S C A R" onkeypress="search_he(event);">
                 <br> Nro de Registros :
                <select id="mostrarX" onchange="$('#pagina_registros').val(1); search_herramienta_list_serv_prod('lista_herra');">
                   
                    <option value="50">50</option>
                    <option value="100">100</option>
                   
                </select>
                <input type="hidden" value="1" id="pagina_registros">
            </div>
         </div>

</div>

<div id="lista_herra" style="display: block;"></div>


         


<div id="div_formularios_dialog" class="formulario_nuevo_menu ocultar " style="height: 300px; width: 400px;">cargando...</div>



<script> search_herramienta_list_serv_prod('lista_herra');</script>
