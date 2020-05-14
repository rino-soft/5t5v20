
<div class="titulo_contenido"><?php
echo "$titulo";

?></div>


<div style="display: table; width: 95%">
    <div style="display: table-row">
        <div style="display: table-cell;">
            <div style="float:right; display: table-cell; " class="alin_der">
                <input class="fondobuscar300" id="search_ov_pf" placeholder="B U S C A R   A R T I C U L O" onkeypress="search_af(event);">
                 <br> Nro de Registros :
                <select id="mostrarX" onchange="$('#pagina_registros').val(1); search_and_list_act_fijo('lista_act_fijo');">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100" selected='selected'>100</option>
                    <option value="200">200</option>
                    <option value="500">500</option>
                </select>
                <input type="hidden" value="1" id="pagina_registros">
            </div>

        </div>
    </div>
</div>

<!--<div class="milink " title="DESCARGAR" style="margin: 0 10 0 10" onclick="ver_archivo('excel_export/movimientos_articulos_serial_codigos','Expor_Excel')">bueno</div>
<div class="milink " title="DESCARGAR" style="margin: 0 10 0 10" onclick="ver_archivo('excel_export/libroVentasFacilito/' + '2016-10-01' + '/' +'2016-12-01' + '/' + '_','Expor_Excel')">copia</div>-->
<div style="margin: 0 10 0 10" ><div class="link_azul milink " style="display: inline" onclick="ver_archivo('excel_export/mov_art_serial_codigos' ,'Expor_Excel')">Descargar reporte</div></div>

<div id="lista_act_fijo" style="display: block;"></div>
         

<div id="div_formularios_dialog" class="formulario_nuevo_menu ocultar container_20" style="height: 300px; width: 400px;">cargando...</div>




<script> search_and_list_act_fijo('lista_act_fijo');</script>

