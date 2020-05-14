

<div class="titulo_contenido"><?php
echo "$titulo";

?></div>



<div style="display: table; width: 95%">
    <div style="display: table-row">
       
        XXXXXXXXXXXXXXXXXX

         <div style="display: table-cell;">
            <div style="float:right; display: table-cell; " class="alin_der">
                <input class="fondobuscar300" id="search_rendicion" placeholder="B U S C A R" onkeypress="search_recep_rr(event);">
                 <br> Nro de Registros :
                <select id="mostrarX" onchange="$('#pagina_registros').val(1);  search_and_list_mis_rendiciones_recep_rr('lista_rendicion');">
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




<script> search_and_list_mis_rendiciones_recep_rr('lista_rendicion');</script>
