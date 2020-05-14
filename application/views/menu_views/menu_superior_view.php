<?php // muetra los menus padres encima en el div menu  ?>

<ul>
    <?php
    foreach ($datos_menu_superior as $reg) {
        if (isset($datos_item_padre) and $datos_item_padre == $reg->id) {
            echo "<li><span class='mayusculas f10 milink' onclick='redirigir(\"".base_url().$reg->controlador."/".$reg->metodo."/".$datos_item_padre."/".$reg->id."\");'>$reg->titulo</span></li>";
            //echo "<li><span class='mayusculas f10 nolink'>$reg->titulo</span></li>";
        } else {
            echo "<li><a class='mayusculas f10' href='" . base_url() . "$reg->controlador/$reg->metodo/$reg->id'>$reg->titulo</a></li>";
        }
    }
    ?>
</ul>
