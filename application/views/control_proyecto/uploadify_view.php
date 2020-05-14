<html xmlns="http://www.w3.org/1999/xhtml">
    
<body>
        <div class="container_12">
           
            <?= form_open(base_url() . 'uploadify/subir_fotos') ?>
            <div class="grid_8" id="formulario_album_fotos">
                //el botón más importante y el que hace posible todo
                <a href="javascript:$('#subir_imagen').uploadifyUpload();" id="subir">Subir imágenes</a>
                <div class="well" style="padding: 14px 19px;">
                    <input id="subir_imagen" value="Subir imagen" name="subir_imagen" type="file" />
                    //campo oculto con la url de la página      
                    <input type="hidden" value="<?= base_url() ?>" id="hiddenBaseUrl"/>
                    //campo oculto con el nombre de la carpeta donde irán las imágenes
                    <input type="hidden" value="<?= base_url() . 'uploads' ?>" id="uploadfolder"/>
                    //aquí se mostrarán las miniaturas    
                    <div id="displayFiles"></div>
                </div>    
                <?= form_close() ?>
             </div>
            <!--fin del formulario para poder subir sus imágenes-->
        </div>
        <!--fin de la página-->
</body>
