<input type="hidden" value="<?php echo base_url(); ?>" id="burl">
<div class="grid_4">
    <div class="grid_4" id="div_de_busqueda_Personal">
        <div class="clear esparriba"></div> 
        <div class="grid_4 alinearIzquierda">
            <input type="text" class="fondobuscar" id="quebuscar" placeholder="BUSCAR">
            <input type="button" class="botonbuscar" value="Buscar" onclick="javascript:buscar_personalHorario_en_todo()">
        </div>
        <div class="grid_4" id="resultado_busqueda_personal"></div>
    </div>
    <div class="clear esparriba"></div>    
    <div class="grid_4 esparriba fondoplomoclaro centrartexto">
        <input type="text" id="ids" autocomplete="off" class="grid_8">
    </div>

</div>
<div class="grid_8">
    <div class="clear esparriba"></div>    
    <div class="prefix_05 grid_7">
        <br>
        <div class="grid_7 bordeado_seleccionados">
            <div class="grid_6 oculto"id="titulo_selec">          
                <div class=" grid_6 fondo_tituloAsigna negrilla centrartexto" style="padding-left:58px; padding-right:26px;">ASIGNAR HORARIOS</div>
                <div class="grid_5_5 prefix_025 suffix_025 esparriba" ><div id="error_de_formulario" class=" grid_5_5 NO oculto"></div></div>
                <div class="prefix_025 letraMediana negrilla ">PERSONAL SELECCIONADO<span class="letrachica" style="float:left;">(Se esta seleccionando el siguiente personal para asignarles los siguientes horarios)</span></div>
            </div>
            <p/><p/>
            <div class="grid_4" id="div_usuarios_seleccionados"></div>
        </div>
        <div class="grid_7 fondo_asignaHorario" id="Div_asignaHorario" style="padding-right:2px;"></div>
    </div>
</div>

