<div class="container_20">
    <div class="grid_20">
        <div style="display: table-row"> 
            <div class="grid_4 suffix_1">
                <input type="hidden" value="1" id="pagina_art">
                <input type="hidden" value="" title="ids_selec" id="ids_seleccionados">
                <input type="hidden" value="0" id="cant_item">
            </div>
            <div class="grid_20 fondo_plomo_claro_areas"> 
                <div class="grid_20 negrilla  fondo_azul colorAmarillo f14 alin_cen">
                    Area de cargos de detalles:
                </div>
                <div style="display: table-cell; " class="esparriba5 alin_der grid_20">
                    <div style="float:right; display: table-cell; " class="alin_der esparriba10">
                        <input class="fondobuscar300 alin_der" id="a_search_sm" placeholder="B U S C A R   A R T I C U L Oo" onkeypress="search_alm2_art(event);">
                        <br> Nro de Registros :
                        <select id="mostrar_X" onchange="cambiarpagina_art(1)">
                            <option value ="5" selected="selected" >5</option>
                            <option value ="10" >10</option>
                            <option value ="20" >20</option>
                            <option value ="50" >50</option>
                            <option value ="100" >100</option>
                        </select>
                        <input type="hidden" value="1" id="pagina_registros">
                    </div>
                </div>
            </div>
            <div class="grid_20" id="resultado_busqueda" > </div>
        </div>
    </div> 
</div>
