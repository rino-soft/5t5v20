

<div style="width: 100%; float: left" >
    <div class="titulo_contenido" style="float: left;"><?php echo $titulo; ?></div>

</div>

<div style=" ">
    <div style="">
        <div  style="height: 35px ;padding:5px 5% 5px 5px; float: left">
            <div class="boton milink" style="float: left;" 
                 onclick="dialog_nueva_facventa('div_formularios_dialog', '<?php echo base_url() . "factura_venta/factura_venta_nuevo/0"; ?> ')">
                Nueva Factura Venta
            </div>

        </div>




        <div style="float:right;" class="alin_der espder20">
            <input class="fondobuscar300" id="search_ov_pf" placeholder="B U S C A R" onkeypress="search_factura_venta(event);"><br>
            <div class="f10">desde <input onchange="$('#pagina_registros').val(1); search_and_list_factura_venta('lista_oventa_prefacturas');" type="text"  style="width: 75px;" id="desdeb" value="<?php echo date('Y/01/01'); ?>"> 
                hasta <input onchange="$('#pagina_registros').val(1); search_and_list_factura_venta('lista_oventa_prefacturas');" type="text" style="width: 75px;" value="<?php echo date('Y/m/d'); ?>" id="hastab"><script>$("#desdeb").datepicker();$("#hastab").datepicker();</script>
                Nro de Registros :
                <select id="mostrarX" onchange="$('#pagina_registros').val(1); search_and_list_factura_venta('lista_oventa_prefacturas');"><!--cambiar esta parte por el nuevo-->

                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50" selected="selected">50</option>
                    <option value="100">100</option>
                    <option value="200">200</option>
                    <option value="500">500</option>
                    <option value="1000">1000</option>

                </select>
                <div class="milink facilito" title="Descargar Libro de ventas para Facilito" style="margin: 0 10 0 10" onclick="ver_archivo('excel_export/libroVentasFacilito/' + $('#desdeb').val().replace(/\//gi, '-') + '/' + $('#hastab').val().replace(/\//gi, '-') + '/' + $('#search_ov_pf').val() + '_', 'Exportar Excel')">
                </div>
                <div class="milink excel_export" title="Descargar reporte Interno" style="margin: 0 10 0 10"  onclick="ver_archivo('excel_export/libroVentas_interno/' + $('#desdeb').val().replace(/\//gi, '-') + '/' + $('#hastab').val().replace(/\//gi, '-') + '/' + $('#search_ov_pf').val() + '_', 'Exportar Excel')">
                </div>
                <input type="hidden" value="1" id="pagina_registros">
                
            </div>


        </div>



    </div>



</div>


<div id="lista_oventa_prefacturas" style="display: inline-block;"  >

</div>



<div id="div_formularios_dialog" class="formulario_nuevo_menu ocultar" style="height: 300px; width: 400px;">cargando...</div>


<script> search_and_list_factura_venta('lista_oventa_prefacturas');</script>


