<div class="fondo_azul colorBlanco negrilla f12" style="width: 95%; display: block; padding: 5px; ">
    <div style="display: inline-block">

        <?php
        if ($total_registros > 0)
            echo $total_registros . " registros cargados exitosamente.";
        else
            echo $total_registros . " registros cargados !  No se han encontrado Registros en la Base de Datos.";
        ?>

    </div>

    <div id="paginacion" style="float: right; padding-right: 25px">
        <?php 
        for ($pa = 1; $pa <= ceil($total_registros / $mostrar_X); $pa++) {
            if ($pa != $pagina_actual) {
                ?>
                <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa; ?>);search_herramienta_list_serv_prod('lista_herra');" style="float: left" > <?php echo $pa . " ,"; ?> </div>
                <?php
            } else {
                ?>
                <div class="colorAmarillo" style="float: left"> <?php echo $pa . " ,"; ?> </div>
                <?php
            }
        }
        ?>

    </div>
</div>


<div class='div1150   alin_cen colorAmarillo fondo_azul espaciado' >

<div class="f14 negrilla" style="display: block-inline;width: 80px;float: left ">
    <div style="display: block; ">
        Id
    </div>               
</div>
<div class="f14 negrilla" style="display: block-inline; width: 150px; float: left;">
    <div style="display: block; ">Codigo</div>               

</div>
<div class="f14 negrilla"style="display: block-inline;  width: 250px; float: left">
    <div style="display: block; ">Nombre</div>  

</div>
<div class="f14 negrilla"style="display: block-inline;  width: 200px; float: left">
    <div style="display: block; ">Descripción</div>  

</div>

</div>

<!-- aqui se muestra los registros con un foreach -->

<div>
    <?php foreach ($registros_grupo->result() as $reg) { ?>
    <div class='div1150 borde_abajo espaciado5 cambiar2 ' style="margin: 0;" >
            <div class="f12 alin_cen " style="display: block-inline;width: 80px;float: left; ">
                <div style="display: block; "><?php echo $reg->id_grupo; ?></div>               
            </div>

            <div class="f12 alin_izq" style="display: block-inline;  width: 150px; float: left; margin-left: 15px;margin-right: 1px ">
                <div style="display: block; "><?php echo $reg->cod_propio; ?></div>
            </div>
            <div class="f12 alin_izq" style="display: block-inline;  width: 250px; float: left; margin-left: 15px;margin-right: 1px">
                <div style="display: block; "><?php echo $reg->nombre; ?></div>
            </div>
            <div class="f12 alin_izq" style="display: block-inline; width: 200px; float: left; margin-left: 15px;margin-right: 1px ">              
                <div style="display: block; "><?php echo $reg->descripcion_grupo; ?></div>
            </div>
            
            <div style="display: block-inline; width: 150px; float: right; " >               
                <div style="display: block; float: right">
                    <div class="boton2 f12 alin_cen" style="width: 40px" onclick="dialog_detalle_grupo('div_formularios_dialog','<?php echo base_url() . "grupo_herramienta/ver_detalle_grupo/$reg->id_grupo"; ?> ')"><?php echo "Ver"; ?></div>
                </div> 
            </div>
            


        </div>

         
    
    
    
</div>


   
<?php } ?>

