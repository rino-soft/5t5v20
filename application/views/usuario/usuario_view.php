<div class="titulo_contenido"><?php
echo "$titulo";
?></div>
<div style="display: table; width: 100%" class="container_20">
    <div style="display: table-row">
        <div  style="height: 35px ;display: table-cell; padding:5px 5% 5px 5px; float: left">
            <div class="boton" style="float: right;" 
                    onclick="dialog_contenidos_nuevo_usuario('div_formularios_dialog','<?php echo base_url() . "usuario/usuario_nuevo/0"; ?>')">
                    Nuevo Usuario
            </div> 
        </div> 
        <div style="display: table-cell;">
            <div style="float:right; display: table-cell; " class="alin_der">
                <div class="excel_export milink " title="Descargar reporte de Usuarios" 
                     onclick="ver_archivo('excel_export/usuarios_vacacion', 'Exportar Excel')" ></div>
                <input class="fondobuscar300 " id="search_user" placeholder="Buscar Usuarios" onkeypress="search_user(event);">
                <br><span class=" fondoAmarillo_estado">Incluir Personal inactivo <input type="checkbox" id="conbajas" onclick="$('#pagina_registros').val(1); search_list_user('list_user_system');" > </span>
                <br> Paginacion :
                <select id="mostrarX" onchange="$('#pagina_registros').val(1); search_list_user('list_user_system');">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50" selected='selected'>50</option>
                    <option value="100">100</option>
                    <option value="200">200</option>
                    <option value="500">500</option>
                </select>
                <input type="hidden" value="1" id="pagina_registros">
                <input type="hidden" value="0" id="cant_reg">
            </div>
        </div>
    </div>
    <div class="">
        Lista, Busqueda de movimiento: 
    </div>
</div>
<div id="list_user_system" style="" class=""></div>

<script> search_list_user('list_user_system');</script> 
