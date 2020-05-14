<div class="titulo_contenido"><?php
    echo "$titulo";
    ?></div>
<div style="display: table; width: 95%">
    <div style="display: table-row">
        <div  style="height: 35px ;display: table-cell; padding:5px 5% 5px 5px; float: left">
            <div class="boton milink" style="float: right;" 
                 onclick="dialog_contenidos_nuevo_cliente('div_formularios_dialog', '<?php echo base_url() . "cliente/cliente_nuevo/0"; ?>')">
                Registrar Cliente
            </div>
        </div>
        <div style="display: table-cell;">
            <div style="float:right; display: table-cell; " class="alin_der">
                <input class="fondobuscar300" id="search" placeholder="B U S C A R" onkeypress="search_client(event);">
                <br> Nro de Registros :
                <select id="mostrarX" onchange="$('#pagina_registros').val(1); busca_lista_cliente('lista_clientes');">
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
<div id="lista_clientes" style="display: block;"></div>

<script> busca_lista_cliente('lista_clientes');</script>












