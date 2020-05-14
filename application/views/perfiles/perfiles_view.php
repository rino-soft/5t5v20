<div class="titulo_contenido"><?php echo "PERFILES"; ?> </div>
<div style="display: table; width: 50%" class="grid_10">
    <script> search_perfiles('lista_perfiles')</script>
    <div id="lista_perfiles" style="display: block;"></div>     
    <input type="text" value="" title="ids_selec" id="ids_seleccionados">
    <input type="hidden" value="0" id="cant_item">

    <input type="text" value="" title="ids_selec" id="ids_seleccionados_perfiles">
    <input type="hidden" value="0" id="cant_item_perfiles">

    <div id="dialog_nuevo_perf" style="display: block;"> </div>
</div>   
<div style="display: table; width: 49%; float: left" class="grid_10">   
    <div style="display:table-cell; " class="grid_10 alin_der">
        <input class="fondobuscar300 " id="search_u" placeholder="B U S C A R  U S U A R I O" onkeypress="search_usuario(event);">
        <br> Paginacion :
        <select id="mostrar_u" onchange="$('#pagina_registros').val(1); search_and_list_user('lista_usuarios');">
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100">100</option>
            <option value="200">200</option>
            <option value="500">500</option>
        </select>
        <input type="hidden" value="1" id="pagina_registros">
        <input type="text" value="" title="ids_selec" id="ids_seleccionados_user">
        <input type="hidden" value="0" id="cant_item_user">
    </div> 
    <div id="lista_movimiento_usuarios" style="display: block; width: 97%" class="grid_10 fondo_amarillo">        
    </div> 
    <div id="lista_movimiento_usuarios" style="display: block; width: 97%" class="grid_10 fondo_amarillo alin_cen f12">        
        <div id="ver_permiso"style="display: block-inline;width:20%;float: left;" class="boton2 f12 ocultar negrilla" 
             onclick="setTimeout(function(){insertar_permisos('Asignacion');}, 100);">
            ASIGNAR PERMISO
        </div>   </div> 
    <div id="Asignacion" style="display: block; height: 60px; width: 400px;" class="ocultar container_20"> </div>
    <div id="lista_usuarios" style="display: block; width: 100%" class="grid_10"></div>
    <div class="" id="resultado_busqueda_user" > </div>
</div>









