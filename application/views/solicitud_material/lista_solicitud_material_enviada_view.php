
<div class="titulo_contenido"><?php
echo "$titulo";

?></div>

<div style="display: table; width: 95%">
    <div style="display: table-row">
        
        <div style="display: table-cell;">
            <div style="float:right; display: table-cell; " class="alin_der">
                <input class="fondobuscar300" id="campo_busqueda" placeholder="B U S C A R" onkeypress="search_sol_mat_env(event,'lista_solicitud_material');">
                <br> Nro de Registros :
                <select id="mostrarX" onchange="$('#pagina_registros').val(1);  busca_lista_mi_sol_mat_enviada('lista_solicitud_material');">
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

      
 <div id="lista_solicitud_material" style="display: block;"></div>
         
<div id="lista_movimiento_sm" style="display: block;"></div>

<div id="detalles_movimiento_entrega_material" style="display: block; height: 300px; width: 400px;" class="ocultar container_20"> </div>

<div id="div_formularios_dialog" class="formulario_nuevo_menu ocultar container_20" style="height: 300px; width: 400px;">cargando...</div>


<script> busca_lista_mi_sol_mat_enviada('lista_solicitud_material');</script>


