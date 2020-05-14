<div class="container_12">
<input type="hidden" value="<?php echo base_url(); ?>" id="burl">
<div class="grid_12 prefix_025 esparriba espabajo negrilla letraGrande"> SELECCION DIAS ESPECIALES Y FERIADOS</div>
<div class="grid_4 prefix_05 textChico" id="div_fecha">

</div>

<div class=""><input type="text" id="ids_fechas" autocomplete="off" class="grid_7"></div>
<div class="grid_7 espabajo">
    <div class=" grid_6 negrilla " style="padding-right:26px;">FERIADOS Y DIAS ESPECIALES AÑO ACTUAL</div>
    <div class="prefix_025 letraMediana" id="dias_feriados_bd_actuales"></div>
    <script type="text/javascript"> mostrar_diasFeriados();</script>
</div>
<div class="grid_7 bordeado_seleccionados"> 
    <div class="grid_6"id="titulo_selec">          
        <div class=" grid_6 fondo_tituloAsigna negrilla centrartexto" style="padding-left:58px; padding-right:26px;">ASIGNAR FERIADOS Y DIAS ESPECIALES</div>
        <div class="prefix_025 letraMediana negrilla ">DIAS SELECCIONADOS
            <span class="letrachica" style="float:left;">(Se esta seleccionando los siguientes dias para asignarles como feriados o dias especiales)</span>
        </div>
    </div>
    <div class="grid_7" id="div_fechas_seleccionados">

    </div>  
</div>
<div class="grid_11 alinearDerecha oculto prefix_05 esparriba" id="div_guardarFeriados"><input type="button" value="Guardar" onclick="guardar_diasFeriados();"></div>
<script>
$(function() {
    bloquear_diasDatepicker_bd();
    $( "#div_fecha" ).datepicker({
        
        onSelect: function (date) {
            //alert(date)
            adiciona_div_diasEspeciales(date)
            desabilitar_dia_datepicker(date)
        },
        beforeShowDay: DisableDays
    });
});
</script>
</div>