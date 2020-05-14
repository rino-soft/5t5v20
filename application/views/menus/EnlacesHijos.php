
    <?php
    foreach ($enlaces as $file) {
        ?> <a href='#' onclick="javascript:cargarCuerpo('<?php echo base_url().$file->controlador.'/'.$file->metodo;?>','<?php echo $file->id;?>')">
            <?php 
        echo $file->titulo;
        ?>
        </a><br>
<?php    }
    ?>
