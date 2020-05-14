<div class="container_20">
    <div class="grid_20">
        <div class="grid_20">Ingrese de <span class="negrilla">Material/ Insumos /Herramientas</span></div>
    </div>
<br>
    <div class="grid_20 fondo_plomo_claro_areas">    
        <div class="grid_20 esparriba5">
           
            <div class="grid_14 prefix_6"><input class="fondobuscar" id="in_search" placeholder="BUSCAR METERIAL" onkeypress="search_ingreso1(event);">
            </div>
             <div class="prefix_15 grid_5"> 
                <div class="grid_5 alin_der">
                    Mostrar Registros
                    <select id="mostrar_X" onchange="cambiarpagina(1)">
                        <option value ="5" selected="selected" >5</option>
                        <option value ="10" >10</option>
                        <option value ="20" >20</option>
                        <option value ="50" >50</option>
                        <option value ="100" >100</option>
                    </select> 
                    
                </div>
                 <input type="hidden" value="1" id="pagina">
                 <input type="hidden" value="" id="ids_seleccionados">
                <input type="hidden" value="0" id="cant_item" >
            </div>
            
            
           
        </div>
        <div class="clear"></div>
        <div class="grid_20" id="resultado_busqueda" >
          Area de cargo de detalles 
        </div>
        
        <div class="grid_20 negrilla  fondo_azul colorAmarillo f14 alin_cen ">
            Detalle de orden de venta o pre- factura
        </div>
        
        <div class="grid_20" id="detalle_ov_pf">
           Para agregar items debe realizar primero una busqueda del producto y/o servicio...
        </div>
        <div class="grid_20 fondo_azul f16 colorBlanco" id="calculos">
            <div class="prefix_14 grid_3 alin_der ">
                TOTAL .-
            </div>
            <div class="grid_2 suffix_1"><input class="input_redond_100 margin_cero alin_cen negrilla" id="total_calculo" readonly="readonly"></div>
                
        </div>
        <div class="grid_20 f16">
            Comentario :
            <textarea id="comentario_general" placeholder="puede escribir un comentario general" class="textarea_redond_990x50"></textarea>
        </div>
        
            
            
    </div>
</div>
<div id="mensaje" class="ocultar">otro div con otro mensaje !!!!!</div>



