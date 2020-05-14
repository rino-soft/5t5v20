

<?php
foreach ($dato_relacion_archivo_contrato->result() as $reg) {
    if ($reg->tipo != '.pdf') {
        ?>

        <div class="milink " id="imagen" style="float: left" title="<?php echo $reg->nombre_arch ?>">    
            <a onclick="ver_archivo('<?php echo $reg->ruta_arch; ?>');"> <img class="fondo_plomo" 
             style="border-radius: 10px ; margin: 10px" src='<?php echo base_url() . $reg->ruta_arch; ?>' height='90' >  </a>
            <div class="f10" style='width: 15px;'><?php echo $reg->nombre_arch ?>

            </div>
        </div>

    <?php } else {
        ?><div class=" milink " id="imagen" style="float: left" title="<?php echo $reg->nombre_arch ?>">    
            <a onclick="ver_archivo('<?php echo $reg->ruta_arch; ?>');"> <img class=""
                                                                              style="border-radius: 10px ; margin: 10px" src='<?php echo base_url() . "imagenesweb/icono/pdf_elegante.png" ?>' height='90' >  </a>
            <div class="f10"><?php echo $reg->nombre_arch ?>

            </div>
        </div>
    <?php
    }
}
?>

<div class=" milink" id="imagen" style="float: left" title="Adicionar Archivo">    
    <div class="add_archivo fondo_plomo_claro_areas" style="border-radius: 10px ; margin: 10px"  onclick="$('#form_load #userfile').trigger('click')">               
    </div>
</div>
