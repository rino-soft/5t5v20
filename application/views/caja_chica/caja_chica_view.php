
<link href="<?php echo base_url(); ?>CSS/botonesImages.css" type="text/css" rel="stylesheet" /> 



<?php
$nropo = "";
$duid = "";
$titulo = "";
$monto = "";
$duracion = "";
$fecha_ini = "";
$usuario = "";
?>



<div class="row tile_count">


    <div class="col-md-12 col-sm-12 col-xs-12  ">
        <div class="col-md-9 col-sm-9 col-xs-12 f20 negrilla ">
            Solicitudes de Apertura de Cajas Chicas
        </div>

        <div class="col-md-3 col-sm-3 col-xs-12 alin_der ">
            Seleccione el Proyecto a filtrar: 
            <select class="form-control alin_der " tabindex="0" id="id_proyectototal" onchange="filtrar_proyecto_sfr('<?= $padre ?>')">
                <option value="0">Todos los Proyectos</option>
                <?php
                foreach ($proyectos->result() as $pr) {
                    $sel = "";
                    if ($pr->id_proy == $proyecto)
                        $sel = " selected='selected' ";

                    echo "<option value='$pr->id_proy' $sel >$pr->nombre  </option>";
                }
                ?>

            </select>
        </div>
    </div>
    <div class="col-md-1 col-sm-2 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-archive"></i> Cantidad Sitios</span>
        <div class="count"><?= $registros->num_rows() ?></div>

    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top f16"><i class="fa fa-money"></i> Total Registrado</span>
        <div class="count green"  id="totalregsitio"><?= number_format($suma, 2, ",", "."); ?></div>

    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-money"></i> Rendiciones Registradas</span>
        <div class="count aero "><?= number_format($sumaRend, 2, ",", "."); ?></div>

    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-money"></i> Utilidad</span>
        <div class="count blue"><?= number_format($sumaUtilidad, 2, ",", "."); ?></div>

    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-money"></i> Horas Extra registrados</span>
        <div class="count red">0,00</div>

    </div>
</div>

<div id="recuperacion" class="ocultar"></div>
<div class="row col-md-12 col-sm-12 col-xs-12">
    <div class="btn btn-primary " style="float: left; display: table-cell " 
         onclick="mostrar_fomrulario_cc(0);" >
        Nuevo Solicitud de Caja Chica
    </div>
</div>

<div class="row" id="formuarioSolFR">

</div>


<div id="lista_ordenCompra"class="f10 row">
    <div class="col-md-12 col-sm-12 col-xs-12 ">
        <div class="x_panel">
            <div class="x_title">
                <span class="f16 negrilla">Lista de Cajas Chicas</span>   
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
                            <th></th>

                            <th>Estado</th>


                            <th>asignado a </th>
                            <th>fecha de creacion</th>
                            <th>Proyecto</th>
                            <th>Monto</th>
                            <th>registrado por:</th>

                            <th>observaciones</th>
                        </tr>
                    </thead>


                    <tbody class ="f12">
                        <?php
                        // $suma=10;
                        foreach ($registros->result() as $reg) {
                            //   $suma+=$montos[$reg->idSitioTrabajo];
                            ?>

                            <tr>
                                <td><?php echo $reg->idcaja_chica; ?></td>
                                <td><a class='btn btn-success btn-xs bordeado filas' onclick="mostrar_fomrulario_cc('<?= $reg->idcaja_chica ?>')">editar</a>
                                    <a class='btn btn-primary btn-xs ' href='<?= base_url() . "control_proyecto/reg_ordecompra/" . $padre . "/" . $reg->idcaja_chica; ?>'>Print</a>


                                    <!--<a class='btn btn-dark btn-xs'>Reg. Viat</a>-->
                                </td>


                                <td ><?php echo $reg->estado; ?></td>

                                <td><?php echo $reg->username; //$reg->nombre;         ?></td>
                                <td><?php echo $reg->fh_registro; //$reg->nombre;         ?></td>
                                <td><?php echo $reg->proyecto; //$reg->nombre;         ?></td>
                              

                                <td class="negrilla f16 alin_der" style="color: #1c961f"><?php echo number_format($reg->monto, 2, ",", "."); ?></td>
                              

                                <td><?php echo $reg->usercreated; //$reg->nompreproy;         ?></td>

                                <td><?php echo $reg->comentario_global; ?></td>
                            </tr>


                        <?php } ?>

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













