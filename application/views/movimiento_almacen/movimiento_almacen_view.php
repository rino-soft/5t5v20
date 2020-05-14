<div class="titulo_contenido" style="padding-left: 35px; "><?php echo "Ingresos y Salidas de Almacen	"; ?></div>
<div style="display: table; width: 95%" class="container_20">
    <div style="display: table-row">
        <div  style="height: 35px ;display: table-cell; padding:5px 5% 5px 5px; float: left">
            <div class="boton milink negrilla" style="float: left; display: table-cell " 
                 onclick="dialog_nuevo_mov_alm1('div_formularios_dialog','<?php echo base_url() . "movimiento_almacen/almacen_nuevo/0"; ?> ')" >
                Nuevo Ingreso
            </div>
            <div class="boton milink negrilla" style="float: left; " 
                 onclick="dialog_nuevo_mov_alm_retiro('div_formularios_dialog','<?php echo base_url() . "movimiento_almacen/almacen_retiro_directo/0"; ?> ')" >
                 Nuevo Retiro
            </div>
            
          
            
        </div> 
        <div style="display: table-cell;">
            <div style="float:right; display: table-cell; " class="alin_der">
                <input class="fondobuscar300 " id="search_mov" placeholder="B U S C A R" onkeypress="search_mov_alm1(event);">
                <br> Paginacion :
                <select id="mostrarX" onchange="$('#pagina_registros').val(1); search_and_list_ov_al('lista_movimiento_almacen');">
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
    <div class="f10">
        Lista, Busqueda de movimiento: 
    </div>
    
</div>
<div id="lista_movimiento_almacen" style="" class=""></div>
<div id="detalles_movimiento_almacen_art" style="display: block; height: 300px;" class="ocultar container_20"> </div>
<div id="div_formularios_dialog" class="formulario_nuevo_menu ocultar container_20" style="height: 300px;">cargando...</div>
<script> search_and_list_ov_al('lista_movimiento_almacen');</script>
<div id="detalles_movimiento_almacen_entrega" style="display: block; height: 300px; width: 400px;" class="ocultar container_20"> </div>








