<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of subida_de_imagenes_vehiculo_view
 *
 * @author POMA RIVERO
 */
?>

<div id="respuesta"></div>
<div class="grid_15 ">   

    <div class="f10 negrilla ocultar" id="form_load">
        <form id='fileform' enctype='multipart/form-data' method='POST'>
            <input class="input_redond_180"   type="hidden" id="id_vehiculo" placeholder="" value="<?php echo $id_vehi ?>">
            <input type='hidden' id='dest'  value = 'doc_vehiculo'>
            <input type='hidden' id='direccion_load'  value = '<?php echo $dir_ayuda; ?>'>                           
            <input type='hidden' id='nombre_file'  value = 'doc_vehiculo1'>                           
            <input type='file' id='userfile'  name='userfile'  style='padding-left: 30px' title='Subir Archivo' onchange='subir_archivo_servidor_vehiculo("subida_imagen", "form_load");'>
        </form>
    </div>

<?php
foreach ($imagenes->result() as $reg) {
    if ($reg->tipo_archivo != '.pdf') {
        ?>

            <div class="milink " id="imagen" style="float: left" title="<?php echo $reg->nom_archivo ?>">    
                <a onclick="ver_archivo('<?php echo $reg->ruta; ?>');"> <img class="fondo_plomo" 
                                                                            style="border-radius: 10px ; margin: 10px" src='<?php echo base_url() . $reg->ruta; ?>' height='90' >  </a>
                <div class="f10"><?php echo $reg->nom_archivo ?>

                </div>
            </div>

    <?php } else {
        ?><div class=" milink " id="imagen" style="float: left" title="<?php echo $reg->nom_archivo ?>">    
                <a onclick="ver_archivo('<?php echo $reg->ruta; ?>');"> <img class="fondo_plomo"
                                                                            style="border-radius: 10px ; margin: 10px" src='<?php echo base_url() . "imagenesweb/icono/pdf_elegante.png" ?>' height='90' >  </a>
                <div class="f10"><?php echo $reg->nom_archivo ?>

                </div>
            </div>
    <?php }
} ?>

    <div class=" milink" id="imagen" style="float: left" title="Adicionar Archivo">    
        <div class="add_archivo fondo_plomo" style="border-radius: 10px ; margin: 10px"  onclick="$('#form_load #userfile').trigger('click')">               
        </div>
    </div>

    <div id="mostrar_imagen" class="" ></div>  

</div>  


