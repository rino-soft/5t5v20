<div class="titulo_contenido" style="padding-left: 35px;"><?php
echo "$titulo";

?></div>


<div style="display: table; width: 95% "  class="container_20">
    <div style="display: table-row">
        <div  style="height: 35px ;display: table-cell; padding:5px 5% 5px 5px; float: left">
             
            <div class="boton milink negrilla"  style="float: left; display: table-cell" 
                 onclick="dialog_nueva_prod_serv('div_formularios_dialog','<?php echo base_url() . "producto_servicio/nuevo_serv_prod/0"; ?>','Nuevo Producto/Servicio')">
               Nuevo Producto / Servicio
            </div>
            
            
           
            

        </div>
        <div style="display: table-cell;">
            <div style="float:right; display: table-cell; " class="alin_der">
                <input class="fondobuscar300" id="search_ov_pf" placeholder="B U S C A R" onkeypress="search_sp(event);">
                 <br> Nro de Registros :
                <select id="mostrarX" onchange="$('#pagina_registros').val(1); search_and_list_serv_prod('lista_serv_prod');">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100" selected="selected">100</option>
                    <option value="200">200</option>
                    <option value="500">500</option>
                </select>
                <input type="hidden" value="1" id="pagina_registros">
            </div>

        </div>
    </div>
   
    
</div>

<div id="lista_serv_prod" style="display: block;"></div>
         


<div id="div_formularios_dialog" class="formulario_nuevo_menu ocultar container_20" style="height: 300px; width: 400px;">cargando...</div>




<script> search_and_list_serv_prod('lista_serv_prod');</script>






