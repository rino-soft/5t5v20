
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
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
        <div class="count">2500</div>
        <span class="count_bottom"><i class="green">4% </i> From last Week</span>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-clock-o"></i> Average Time</span>
        <div class="count">123.50</div>
        <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Males</span>
        <div class="count green">2,500</div>
        <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Females</span>
        <div class="count">4,567</div>
        <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Collections</span>
        <div class="count">2,315</div>
        <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Connections</span>
        <div class="count">7,325</div>
        <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
    </div>

    <div class="btn btn-primary " style="float: left; display: table-cell " 
         onclick="dialog_nuevo_orden_compra('div_formularios_dialog', '<?php echo base_url() . "control_proyecto/reg_orden_compra_form/0"; ?> ')" >
        Nuevo Registro (orden de compra)
    </div>
</div>




<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">

                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>

            <form class="form-horizontal form-label-left input_mask">

                <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                    <input type="text" class="form-control has-feedback-left" placeholder="DUID" id="duid" value="<?= $duid ?>">
                    <span class="fa fa-file-o form-control-feedback left" aria-hidden="true"></span>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                    <input type="text" class="form-control has-feedback-left" placeholder="Sitio/Nombre/titulo" id="titulo" value="<?= $titulo ?>">
                    <span class="fa fa-globe form-control-feedback left" aria-hidden="true"></span>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                    <input type="text" id="proyinterno" class="form-control col-md-3 col-xs-12 has-feedback-left" placeholder="Nombre Proyecto Interno"/>
                    <span class="fa fa-cubes form-control-feedback left" aria-hidden="true"></span>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 form-group">
                    <select class="select2_single form-control col-md-3 col-xs-12" tabindex="0" id="id_proyecto">
                        <option>seleccione un Proyecto</option>

                    </select>
                </div> 


                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                    <label for="message">Observaciones Comentarios (100 max caracteres) :</label>
                    <textarea id="comentario" required="required" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="0" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.."
                              data-parsley-validation-threshold="10"></textarea>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                    <button type="button" class="btn btn-dark col-md-3 col-sm-3 col-xs-12 has-feedback" style="margin-right: 0;" onclick="borrarcontenidositio()" >Borrar Datos</button>

                    <button type="button" class="btn btn-success col-md-6 col-sm-6 col-xs-12 has-feedback"style="margin-right: 0;" onclick="registrar_sitio()">Guardar Registro</button>

                    <button type="button" class="btn btn-warning col-md-3 col-sm-3 col-xs-12 has-feedback" style="margin-right: 0;">Cancelar</button>
                </div>


            </form>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">

                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>

            <form class="form-horizontal form-label-left input_mask">
                <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">    
                    <input type="text" class="form-control has-feedback-left" placeholder="nro PO" id="nropo" value="<?= $nropo ?>" >
                    <span class="fa fa-file-o form-control-feedback left" aria-hidden="true"></span>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                    <input type="text" class="form-control has-feedback-left" placeholder="DUID" id="duid" value="<?= $duid ?>">
                    <span class="fa fa-file-o form-control-feedback left" aria-hidden="true"></span>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                    <input type="text" class="form-control has-feedback-left" placeholder="Sitio/Nombre/titulo" id="titulo" value="<?= $titulo ?>">
                    <span class="fa fa-globe form-control-feedback left" aria-hidden="true"></span>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                    <input type="number" id="monto" value="<?= $monto ?>" placeholder="Monto" name="number" required="required" data-validate-minmax="0,1000000" class="form-control col-md-7 col-xs-12 has-feedback-left" style="padding-right: 0px">
                    <span class="fa fa-money form-control-feedback left" aria-hidden="true"></span>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                    <input type="number" id="duracion" value="<?= $duracion ?>" placeholder="duracion(dias)" required="required" data-validate-minmax="0,365" class="form-control col-md-7 col-xs-12 has-feedback-left" style="padding-right: 0px">

                    <span class="fa fa-clock-o form-control-feedback left" aria-hidden="true"></span>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                    <select class="select2_single form-control col-md-6 col-xs-12" tabindex="0" id="id_proyecto">
                        <option>seleccione un Proyecto</option>

                    </select>
                </div> 
                <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                    <input type="text" id="proyinterno" class="form-control col-md-3 col-xs-12 has-feedback-left" placeholder="Nombre Proyecto Interno"/>
                    <span class="fa fa-cubes form-control-feedback left" aria-hidden="true"></span>
                </div>






                <div class="col-md-4 col-sm-4 col-xs-12 form-group">
                    <select class="select2_single form-control col-md-4 col-xs-12" tabindex="-1" id="id_personal">
                        <option value="0">Personal a asignar</option>
                        <?php
                        foreach ($personal_datos->result() as $reg) {
                            if ($reg->cod_user == $usuario)
                                echo "<option selected ='selected' value='$reg->cod_user'>$reg->ap_paterno $reg->ap_materno, $reg->nombre </option>";
                            else
                                echo "<option value='$reg->cod_user'>$reg->ap_paterno $reg->ap_materno, $reg->nombre </option>";
                        }
                        ?>
                    </select>
                </div> 





                <div class='col-md-3 col-sm-3 col-xs-12 input-group date' id='myDatepicker4'>
                    <input type='text' class="form-control col-md-7 col-xs-12 " id="fechainicial" value="<?php echo $fecha_ini; ?>" readonly="readonly"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>

                <div class="form-group">
                    <label for="message">Observaciones Comentarios (100 max caracteres) :</label>
                    <textarea id="message" required="required" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="0" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.."
                              data-parsley-validation-threshold="10"></textarea>
                </div>







            </form>
        </div>
    </div>
</div>


<div id="lista_ordenCompra"class="f10 row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">

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
                            <th>Nro PO</th>
                            <th>DUID</th>
                            <th>Titulo</th>
                            <th>Duracion</th>
                            <th>Fecha</th>
                            <th>Monto</th>
                            <th>proyecto</th>
                            <th>observaciones</th>
                            <th>control</th>
                        </tr>
                    </thead>


                    <tbody class ="f12">
                        <?php foreach ($registros->result() as $reg) { ?>

                            <tr>
                                <td><?php echo $reg->idordenCompra; ?></td>
                                <td><?php echo $reg->nroPO; ?></td>
                                <td><?php echo $reg->DUID; ?></td>
                                <td><?php echo $reg->titulo; ?></td>

                                <td><?php echo $reg->duracion . "<br>"; ?></td>
                                <td><?php echo $reg->posible_fecha . "<br>"; ?></td>
                                <td><?php echo $reg->monto . "<br>"; ?></td>
                                <td><?php echo "<br>"; ?></td>
                                <td><?php echo $reg->observaciones; ?></td>
                                <td> <div class="editarDocumento f12 negrilla" title="Editar Movimiento" onclick="dialog_nuevo_orden_compra('div_formularios_dialog', '<?php echo base_url() . 'control_proyecto/reg_orden_compra_form/' . $reg->idordenCompra; ?> ')"></div></td>

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






<script type="text/javascript" src="<?php echo base_url(); ?>JS/control_proyecto.js"></script>

<script>
                                    // cargarlistar_orden_compra("lista_ordenCompra");
</script>










