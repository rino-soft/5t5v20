
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


    <div class="col-md-12 col-sm-12 col-xs-12  f20 negrilla">
        Control Proyecto (SITIOS)
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12 ">
        <div class="col-md-3 col-sm-3 col-xs-12  ">
            Seleccione el Proyecto a filtrar: <select class="form-control " id="id_proy_sitio" onchange="cargar_sitiosproyecto();">
                <option value="0" >Todos los Proyectos</option>
                <?php
                foreach ($proyectos->result() as $pr) {
                    $sel = '';
                    if ($proyectosel == $pr->id_proy)
                        $sel = 'selected="selected"';
                    echo "<option value='$pr->id_proy' $sel >$pr->nombre </option>";
                }
                ?>

            </select>

        </div>
        <div class="col-md-3 col-sm-3 col-xs-12  ">
            Seleccione el sitio: 
            <div class="sitioselect_carga">

                <?php
                echo $sitio_sel;
                ?>



            </div>
        </div>
        <div class="col-md-2 col-sm-2 col-xs-12  ">
            Rango: <select class="form-control " id="rango" onchange="">
                <option value="1" <?php if ($rango == 1) echo " selected='selected' " ?> >mes</option>
                <option value="3" <?php if ($rango == 3) echo " selected='selected' " ?> >Tres Meses</option>
                <option value="6" <?php if ($rango == 6) echo " selected='selected' " ?> >Seis Meses</option>
                <option value="12" <?php if ($rango == 12) echo " selected='selected' " ?> >Año</option>
                <option value="0" <?php if ($rango == 0) echo " selected='selected' " ?> >personalizado</option>


            </select>

        </div>
        <div class="col-md-2 col-sm-2 col-xs-12  alin_der ">
            <br><button class="btn btn-primary" id="act" onclick="filtrar_proyecto_sitio_reporte('<?= $padre ?>')">Actualizar Datos</button>

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

<div id="recuperacion" class=""></div>
<div class="x_panel">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_title">
            <spam class="f16 negrilla">..... </spam>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12">
            <table id="" data-order='[[0 , "desc" ]]' class="table " cellspacing="0" width="100%">
                <thead>

                    <tr>
                        <th>mes</th>
                        <th>PO</th>
                        <th>Redn</th>

                        <th>utilidad</th>

                    </tr>
                </thead>
                <tbody>
                <input type="hidden" id="gmeses" value="<?= $meses ?>">
                <input type="hidden" id="gposm" value="<?= $pos_monto ?>">
                <input type="hidden" id="grendm" value="<?= $rend_monto ?>">
                <input type="hidden" id="gutim" value="<?= $uti_monto ?>">

                <?php
               
                $mes = explode(",", $meses);
                $montoPO = explode(",", $pos_monto);
                $montoRend = explode(",", $rend_monto);
                $montoUti = explode(",", $uti_monto);

                for ($i = 0; $i < count($mes); $i++) {
                    ?>
                    <tr>
                        <td class="negrilla" style="color: blue"><?= $mes[$i] ?></td>

                        <td><?= $montoPO[$i] ?></td>
                        <td><?= $montoRend[$i] ?></td>
                        <?php
                        $color = "red";
                        if ($montoUti[$i] > 0)
                            $color = "green";
                        ?>
                        <td class="negrilla" style="color:<?= $color ?> "><?= $montoUti[$i] ?></td>


                    </tr>        
                    <?php
                }
                ?>
                <tr>
                    <td>TOTAL</td>
                    <td><?= "0" ?></td>
                    <td><?= "0" ?></td>
                    <td><?= "0" ?></td>

                </tr>        
                </tbody>
            </table>
        </div>
        <div class="col-md-8 col-sm-8 col-xs-12">
            <div class="x_content" id="grafica">
                
            </div>
        </div>




    </div>
</div>

<div class="row ocultar" id="formuarioSitio">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel"  style="border:solid 5px #000">
            <div class="x_title">
                <spam class="f16 negrilla">Registro de Sitio </spam>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>


            <input type="hidden" id="id_sitio">
            <div class="col-md-3 col-sm-3 col-xs-12 form-group">
                <select class="select2_single form-control col-md-3 col-xs-12 proyecto_selec"  id="id_proyecto" onchange="cargar_proy_interno(0)">
                    <option  value="0">seleccione un Proyecto</option>
                    <?php
                    foreach ($proyectos->result() as $pr) {
                        $sel = '';
                        if ($proyectosel == $pr->id_proy)
                            $sel = 'selected="selected"';
                        echo "<option value='$pr->id_proy' $sel >$pr->nombre </option>";
                    }
                    ?>

                </select>
                <?= "proyecto:$proyectosel" ?>
            </div> 
            <div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback">
                <input type="text" class="form-control has-feedback-left" placeholder="DUID del cliente" id="duid" value="<?= $duid ?>" onchange="verificar_duid()">
                <input type="hidden" id="duplicadoDUID" value="0" >
                <span class="fa fa-file-o form-control-feedback left" aria-hidden="true"></span>
            </div>
            <div class="col-md-1 col-sm-1 col-xs-12 form-group" style="color_red">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" class="fla t" checked="checked" id="duplicidad"> registrar Duplicidad
                    </label>
                </div>

            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                <input type="text" class="form-control has-feedback-left" placeholder="Sitio/Nombre/titulo" id="titulo" value="<?= $titulo ?>">
                <span class="fa fa-globe form-control-feedback left" aria-hidden="true"></span>
            </div>

            <div class="col-md-3 col-sm-3 col-xs-12 form-group ">
<!--                    <input type="text" id="proyinterno" class="form-control col-md-3 col-xs-12 has-feedback-left" placeholder="Nombre Proyecto Interno"/>
                <span class="fa fa-cubes form-control-feedback left" aria-hidden="true"></span>-->
                <select class="select2_single form-control col-md-3 col-xs-12" tabindex="0" id="proyinterno" onchange="consultar_proyint()">
                    <option value="seleccione">seleccione un Proyecto interno</option>
                    <?php
//                        foreach ($proyectos->result() as $pr) {
//                            echo "<option value=$pr->id_proy>$pr->nombre ($pr->nombre_contable) </option>";
//                        }
                    ?>

                    <option style="color:red" value="otro_nuevo">Nuevo Proyecto</option>


                </select>
                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback ocultar" id="otropint">
                    <input type="text" id="proyinternoinput" class="form-control col-md-3 col-xs-12 has-feedback-left" placeholder="Nombre Proyecto Interno"/>
                    <span class="fa fa-cubes form-control-feedback left" aria-hidden="true"></span>

                </div>
            </div>



            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                <label for="message">Observaciones Comentarios (100 max caracteres) :</label>
                <textarea id="comentario" required="required" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="0" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.."
                          data-parsley-validation-threshold="10"></textarea>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 form-group alin_der">
                <button type="button" class="btn btn-dark " style="margin-right: 0;" onclick="borrarcontenidositio()" >Borrar Datos</button>

                <button type="button" class="btn btn-success "style="margin-right: 0;" onclick="registrar_sitio()">Guardar Registro</button>

                <button type="button" class="btn btn-warning " style="margin-right: 0;" onclick="ocultar_fomrulario()">Cancelar</button>
            </div>



        </div>
    </div>
</div>


<div id="lista_ordenCompra"class="f10 row">
    <div class="col-md-12 col-sm-12 col-xs-12 ">
        <div class="x_panel">
            <div class="x_title">
                <span class="f16 negrilla">Lista de Sitios Registrados</span>   
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
                            <th>DUID</th>
                            <th>Titulo</th>

                            <th>proyecto</th>

                            <th>Monto</th>
                            <th>Monto rend</th>
                            <th>utilidad</th>

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
                                <td><?php echo $reg->idSitioTrabajo; ?></td>
                                <td><a class='btn btn-success btn-xs' onclick="editar_sitio('<?= $reg->idSitioTrabajo ?>')">editar</a>
                                    <a class='btn btn-primary btn-xs' href='<?= base_url() . "control_proyecto/reg_ordecompra/" . $padre . "/" . $reg->idSitioTrabajo; ?>'>Reg. PO</a>


                                    <!--<a class='btn btn-dark btn-xs'>Reg. Viat</a>-->
                                </td>


                                <td><?php echo $reg->DIUD; ?></td>
                                <td><?php echo $reg->nombre; ?></td>
                                <td><?php echo $reg->nompreproy; ?></td>

                                <td class="negrilla f16 alin_der"><?php echo number_format($montos[$reg->idSitioTrabajo], 2, ",", "."); ?></td>
                                <td class="negrilla f16 alin_der"><?php echo number_format($rendiciones[$reg->idSitioTrabajo], 2, ",", "."); ?></td>
                                <?php
                                $util = "color:green";
                                if ($utilidad[$reg->idSitioTrabajo] < 0)
                                    $util = "color:red";
                                ?>
                                <td class="negrilla f16 alin_der" style='<?= $util ?>'><?php echo number_format($utilidad[$reg->idSitioTrabajo], 2, ",", "."); ?></td>


                                <td><?php echo $reg->comentario; ?></td>
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


<script>cargar_proy_interno();</script>
<script>cargar_grafica('grafica');</script>

<script>
  //Cuando la página esté cargada completamente
  $(document).ready(function(){
    //Cada 10 segundos (10000 milisegundos) se ejecutará la función refrescar
    setTimeout(refrescar, 300000);
  });
  function refrescar(){
    //Actualiza la página
    
    $("#act").click();
  }
</script>







