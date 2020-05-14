<div class="container_20" style="width: 95% ">
<div class=" grid_20 fondo_azul colorBlanco negrilla f12" style="width: 100%">
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
                <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa; ?>);search_categoria_list_serv_prod('lista_cate');" style="float: left" > <?php echo $pa . " ,"; ?> </div>
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


<div class='fondo_azul colorAmarillo borde_abajo borde_arriba negrilla f14 alin_cen' style="display: block-inline;float: left ; width: 100%; height: " >
    <div class="f14 negrilla" style="display:block-inline; float: left; width: 9%" > Id </div>
    <div class="f14 negrilla" style="display: block-inline; float: left;width: 15%; "> Codigo </div>
    <div class="f14 negrilla alin_cen"style="display: block-inline; float: left; width: 20%; ">Nombre</div>
    <div class="f14 negrilla"style="display: block-inline; float: left; width: 40%; ">Descripción</div>
</div>

<!-- aqui se muestra los registros con un foreach -->


    <?php foreach ($registros1->result() as $reg) { ?>
        <div class='grid_20 borde_abajo cambiar esparriba10' style="width:100%" >
            <div class="f12 alin_cen" style="display: block-inline;  float: left; width: 9%">
                
                   <?php if($reg->id_categoria!="") echo $reg->id_categoria; else echo "&nbsp;"?>               
            </div>

            <div class="f12 alin_cen colorAzul negrilla" style="display: block-inline;  float: left; width: 15%">
              <?php if($reg->cod_propio!="") echo $reg->cod_propio; else echo "&nbsp;" ?>
            </div>
            <div class="f12 alin_izq" style="display: block-inline;  float: left; width: 20%">
                <?php if($reg->nombre!="") echo $reg->nombre; else echo "&nbsp;" ?>
            </div>
            <div class="f12 alin_izq" style="display: block-inline;  float: left; width: 40%">              
                <?php if($reg->descripcion!="") echo $reg->descripcion; else echo "&nbsp;"?>
            </div>
            
            <div style="display: block-inline;  float: left; width: 9%" >               
                
                    <div class="editvehiculo" title="Editar registro" style="width: 40px" onclick="dialog_cat_serv_prod('div_formularios_dialog','<?php echo base_url() . "categoria/nueva_categoria/$reg->id_categoria"; ?> ','Editar')"><?php echo ""; ?></div>
                
            </div>


        </div>

         
    
  
    



   
<?php } ?>
</div>
