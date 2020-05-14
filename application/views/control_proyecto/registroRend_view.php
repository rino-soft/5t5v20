
<link href="<?php echo base_url(); ?>CSS/botonesImages.css" type="text/css" rel="stylesheet" /> 

<?php
$sitio = $registros->row();
?>
<div class='row col-md-12 col-sm-12 col-xs-12 form-group alert-info alert'>

    <div class="col-md-4 col-sm-4 col-xs-12 form-group ">
        <span class="f14">Sitio:</span><span class="f20 negrilla"><?= $sitio->nombre ?></span>
    </div>
    <div class="col-md-2 col-sm-2 col-xs-12 form-group ">
        <span class="f14">DUID</span><span class="f20 negrilla"><?= $sitio->DIUD ?></span>
    </div>
    <div class="col-md-4 col-sm-4 col-xs-12 form-group ">
        <span class="f14">proyecto:</span><span class="f20 negrilla"><?= $sitio->nombreproy ?></span>
    </div>
    <div class="col-md-2 col-sm-2 alin_der col-xs-12 form-group">
        <a class="btn btn-warning" href="<?= base_url() . "control_proyecto/ordecompra/0/$padre" ?>">Volver a Sitios</a>
    </div>
 <input type="hidden" id="id_sitio" value="<?= $id_sitio ?>">
 <input type="hidden" id="id_proy_sitio" value="<?= $sitio->id_proyecto ?>">
</div> 

<div class="col-md-12 col-sm-12 col-xs-12  tile_count">
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top f16"><i class="fa fa-money"></i> Total Registrado</span>
        <div class="count green" id='sumareg'>0,00</div>

    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-money"></i> Rendiciones Registradas</span>
        <div class="count aero ">0,00</div>

    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-money"></i> Viaticos Registradoss</span>
        <div class="count blue">0,00</div>

    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-money"></i> Horas Extra registrados</span>
        <div class="count red">0,00</div>

    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-money"></i> utilidad</span>
        <div class="count dark" id='utilidad'>0,00</div>
        <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> del total Registrado</span>
    </div>


</div>
<div class="btn btn-primary " style="float: left; display: table-cell " 
     onclick="mostrar_fomrulario_nueva_rendicion(0);" >
    Nueva Rendicion (Rendicion)
</div>

<div id="recuperacion"></div>

<div class="row formulario_nuevo_menu" id="formulario_rendicion">

</div>


<div id="lista_rendiciones"class="f10 row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <spam class='f20 negrilla'>Lista de Rendiciones registradas al sitio <?= $sitio->nombre ?></spam> 
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <table id="datatable" data-order='[[0 , "desc" ]]' class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>

                        <tr>
                            <th>ID</th>
                            <th>-</th>
                            <th>proy</th>
                            <th>usuario</th>
                            <th>Fecha Registro</th>
                            <th>tipo_rend</th>
                            <th>Monto</th>
                            <th>estado</th>
                            <th>observaciones</th>

                        </tr>
                    </thead>


                    <tbody class ="f12">
                        <?php
                        $suma_registros = 0;
                        foreach ($registros_rend->result() as $reg) {
                            ?>

                            <tr>
                                <td><?php echo $reg->idreg_ren; ?></td>
                                <td> <a class='btn btn-warning btn-xs' onclick="mostrar_fomrulario_nueva_rendicion('<?= $reg->idreg_ren ?>')">editar</a><br>
                                <td><?php echo $reg->nombreproy; ?></td>
                                <td><?php echo $reg->nomcompleto; ?></td>
                                <td><?php echo $reg->fh_registro; ?></td>
                                <td><?php echo $reg->tipo_rend; ?></td>
                                <td class='f16 negrilla alin_der'><?php echo  number_format($reg->monto,2,",","."); ?></td>

                                <td><?php echo $reg->estado ?></td>
                                <td><?php echo $reg->observacion; ?></td>
                                
                            </tr>

                            <?php
                            $suma_registros+=$reg->monto;
                        }
                        ?>

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>




<div id="div_formularios_dialog" class="formulario_nuevo_menu ocultar container_20" style="height: 300px;">cargando...</div>
<!-- jQuery -->
<script src="<?php echo base_url(); ?>/vendors/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>utilidades/modForm/jquery-ui.js"></script>






<script type="text/javascript" src="<?php echo base_url(); ?>JS/control_proyecto.js"></script>

<script>
                                $("#sumareg").html("<?= number_format($suma_registros, 2, ",", ".") ?>");

                                $("#utilidad").html("<?= number_format(($suma_registros - 0), 2, ",", ".") ?>");


                                // cargarlistar_orden_compra("lista_ordenCompra");

</script>










