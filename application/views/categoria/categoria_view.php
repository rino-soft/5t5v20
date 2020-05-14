
<div class="titulo_contenido" style="padding-left: 35px;"><?php echo "$titulo";?></div>
<div style="display: table; width: 95%" class="container_20">
        <div style="display: table-cell;">
            <div  style="height: 35px ;display: table-cell; padding:5px 5% 5px 5px; float: left">
            <div class="boton milink negrilla" style="float: left; display: table-cell;" 
                 onclick="dialog_cat_serv_prod('div_formularios_dialog','<?php echo base_url() . "categoria/nueva_categoria/0";?>','Nuevo categoria')">
               Nueva Categoria
            </div>
            </div>  
            
            <div style="float:right; display: table-cell; " class="alin_der">
                <input class="fondobuscar300" id="search_cate" placeholder="B U S C A R" onkeypress="search_ca(event);">
                 <br> Nro de Registros :
                <select id="mostrarX" onchange="$('#pagina_registros').val(1); search_categoria_list_serv_prod('lista_cate');">
                   
                    <option value="50">50</option>
                    <option value="100">100</option>
                   
                </select>
                <input type="hidden" value="1" id="pagina_registros">
            </div>
         </div>

</div>

<div id="lista_cate" style="display: block;"></div>


         


<div id="div_formularios_dialog" class="formulario_nuevo_menu ocultar container_20 " style="height: 300px; width: 400px;">cargando...</div>



<script> search_categoria_list_serv_prod('lista_cate');</script>
