<div class="titulo_contenido" style="padding-left: 35px; "><?php echo $titulo; ?></div>
<div style="display: table; width: 95%" class="container_20">
    <div style="display: table-row">
        <div  style="height: 35px ;display: table-cell; padding:5px 5% 5px 5px; float: left">
            <div class="boton milink negrilla" style="float: left; display: table-cell " 
                 onclick="dialog_registro_contratos_alquiler('div_formularios_dialog', '<?php echo base_url() . "linea_servicio/formulario_registro_contrato_alquiler/0"; ?> ')" >
                Registrar Nuevo Contrato
            </div>


        </div> 
        <div style="display: table-cell;">
            <div style="float:right; display: table-cell; " class="alin_der">
                <input class="fondobuscar300 " id="search_lin" placeholder="B U S C A R" onkeypress="search_contratos_alquiler(event);">
                <br> Paginacion :
                <select id="mostrarX" onchange="$('#pagina_registros').val(1); search_and_list_contrato_alquiler('lista_contratos');">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100" selected="selected">100</option>
                    <option value="200">200</option>
                    <option value="500">500</option>
                </select>
                <input type="hidden" value="1" id="pagina_registros">
            </div>
            <div style="float:right; display: table-cell; " class="alin_der">
                <select id="id_proyecto"  style=" width: 250px; height: 35px; font-size: 16px; font-weight: bold; margin: 0 10px 0 0;" onchange="$('#pagina_registros').val(1); search_and_list_contrato_alquiler('lista_contratos');">
                    <option value="0"  selected="selected">TODOS LOS PROYECTOS</option>                   
                    <?php
                    
                    foreach ($lista_proyectos->result() as $proy) {
                        ?>
                        <option  value="<?php echo $proy->id_proy; ?>"><?php echo $proy->nombre; ?></option>
                    <?php }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <div class="f12 espabajo10 esparriba10">
        
    </div>

</div>
<div id="lista_contratos" style="" class=""></div>

<div id="div_formularios_dialog" class="formulario_nuevo_menu ocultar container_20" style="height: 300px;">cargando...</div>
<script> search_and_list_contrato_alquiler('lista_contratos');</script>

