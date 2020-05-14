<link  href=" <?php echo base_url(); ?>utilidades/JqueryArboles/jquery.treeview.css" rel="stylesheet"/>
<script src="<?php echo base_url(); ?>utilidades/JqueryArboles/jquery.treeview.js" type="text/javascript"></script>

<div class="container_12 f12 ">
<input type="hidden" value="<?php echo $id_user; ?>" id="id_user">
<input type="hidden" value="<?php echo base_url(); ?>" id="burl">
<div class="grid_7">
    <div class="grid_7"><h2>Listado de Dependientes</h2></div>
    <div class ="grid_7">
        Elija uno de sus Proyectos : 
        <?php
        echo form_dropdown('proyecto', $proyectos_usuario, 0, "id='proyecto' , onchange='javascript:obtener_jefes_proyectos();muestra_arbol_dependientes_de_proyecto_seleccionado();'");
        ?>
        <div class="grid_6 " id="arbol_dependientes_div_treeView">
            div reservado para albol de dependientes, segun proyecto
        </div>


    </div>
</div>

<!-- grid que almacena el resultado de la busqueda realizada -->
<div class="grid_5" id="div_de_busqueda_Personal">
    <div class="grid_5 alinearDerecha"> <div class="grid_5 esparriba espderecha">
            <input type="text" class="fondobuscar" style="width: 300px" id="quebuscar" >
            <input type="button" class="botonbuscar" value="Buscar" onclick="javascript:buscar_personal_en_todo()">
        </div>
    </div>
    <div class="clear"></div>
    <div class="grid_5" id="resultado_busqueda_personal">
        
    </div>
</div>
<!-- grid que almacena el resultado de la busqueda realizada -->




<!-- desde aqui es para la pantalla Modal que da alta a los usuarios libres-->
<div class="container_12 oculto" id="dialog-form">
    Cargando . . .   
</div>

<script>muestra_arbol_dependientes_de_proyecto_seleccionado();</script>

</div>

