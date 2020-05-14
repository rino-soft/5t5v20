<?php
echo '';
?>


<div style="display: table-cell;">
    <div class="" style="float:right; display: table-cell; " class="alin_der">
<!--- En este input se esta retirando JS onkeypress><--->
        <input class="fondobuscar300" id="search_soli" placeholder="B U S C A R" onkeypress="(event);">


        <div class="f14"> <br>Nro de Registros :</div>
        <select id="mostrarX" onchange="$('#pagina_registros').val(1); search_solicitud_listado('lista_solicitud');">
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100">100</option>
            <option value="200">200</option>
            <option value="500">500</option>
        </select>
        <input type="hidden" value="1" id="pagina_registros">

    </div>

</div>
<div id="lista_solicitud" style="display: block;"></div>

    <div class=" div1000 f12 grid_8  ">
        <div class="grid_3 alin_der" >Personal</div>
        <div class="grid_3 alin_der">Proyecto</div>
        <div class="grid_2 alin_der">Titulo /Descripción /Comentario</div>

    </div>


<div>
    <?php foreach ($usuario->result() as $reg) { ?>
        <div class='div1000 borde_abajo borde_arriba cambiar2' style="margin: 0;" >
            <div class="f12 alin_cen" style="display: block-inline;float: left; ">
                <div style="display: block; ">
                    <?php echo $reg->nombre; ?></div>               
            </div>
           

            <div style="display: block-inline; float: right; " >               
                <div style="display: block;float: right ">
                    <div class="boton2 alin_cen f12" style="width: 60px" onclick="('div_formularios_dialog','<?php echo base_url() . "/"; ?> ')"><?php echo "Ver"; ?></div>
                </div> 
            </div>
<br>
            <div style="display: block-inline; float: right; " >               
                <div style="display: block;float: right ">
                    <div class="boton2 alin_cen f12" style="width: 60px" onclick="('div_formularios_dialog','<?php echo base_url() . "/"; ?> ')"><?php echo "Devolución"; ?></div>
                </div> 
            </div>
        </div>






    </div>



<?php } ?>
