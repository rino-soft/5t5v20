<div class="row">

    <div style="width: 100%; float: left; height: 50px;" >
        <div class="titulo_contenido" style="float: left;"><?php echo $titulo; ?></div>

    </div>
    <div class=" row col-md-8 col-sm-8 col-xs-12">
        <div class="btn btn-primary " style="float: left; display: table-cell " 
             onclick="mostrar_fomrulario_cheques_sp(0);" >
            Solicitud de Pago
        </div>
        <div class="btn btn-success " style="float: left; display: table-cell " 
             onclick="mostrar_fomrulario_cheques_rend(0);" >
            Rendiciones / Reembolsos
        </div>
        <div class="btn btn-dark " style="float: left; display: table-cell " 
             onclick="mostrar_fomrulario_nueva_rendicion(0);" >
            Viaticos
        </div>
        <div class="btn btn-warning " style="float: left; display: table-cell " 
             onclick="mostrar_fomrulario_fondos_rendir_cheque(0);" >
            Fondos a Rendir
        </div>
        <div class="btn btn-default " style="float: left; display: table-cell " 
             onclick="mostrar_fomrulario_nueva_rendicion(0);" >
            Alquileres
        </div>



    </div>
    <div class="col-md-4 col-sm-4 col-xs-12" >
        <div class="col-md-7 col-sm-7 col-xs-12" >

            <div class="btn btn-primary " style="float: left; display: table-cell " 
                 onclick="imp_resumen_dia()" >
                Imp Resumen de cheques del dia :
            </div>
        </div>
        <div class="col-md5 col-sm-5 col-xs-12  has-feedback" >
            <?php date_default_timezone_set("Etc/GMT-4"); ?>
            <div class="form-group" >
                <div class='input-group date' id='myDatepickerresumen'>
                    <input type='text' class="form-control" readonly="readonly"  value="<?php date_default_timezone_set("Etc/GMT+4"); echo date('Y-m-d') ?>" id="fecha_resumen" placeholder="fecha cheques"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>



    </div>
    <div class="col-md-12 col-sm-12 col-xs-12" id="formcheques">

    </div>

    <div id="lista_ordenCompra"class="f10 ">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <spam class='f20 negrilla'>Lista de cheques </spam>
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
                                <th><br></th>
                                <th>cheque</th>
                                <th>Monto</th>
                                <th>elaborado por:</th>
                                <th>Para</th>
                                <th>dirigido a:</th>

                                <th>fecha:</th>
                                <th>comentario</th>
       <!--                           <th>Fecha Registro</th>
                                 <th>duracion</th>
                                 <th>observaciones</th>
                                 <th>Monto</th>
                                 <th>Personal</th>-->
     <!--                            <th> </th>-->
                            </tr>
                        </thead>


                        <tbody class ="f12">
                            <?php
                            $suma_registros = 0;
                            foreach ($registros_ch->result() as $reg) {
                                ?>

                                <tr>
                                    <td><?php echo $reg->id_cheque; ?></td>

                                    <td>
                                        <div class="impresionDoc milink"  title="Imprimir cheque" onclick="imprimir_cheque('<?php echo $reg->id_cheque ?>');">
                                        </div>
                                    </td>
                                    <td><?php echo $reg->nro_cheque; ?></td>
                                    <td class="f20 negrilla"><?php echo $reg->monto; ?></td>
                                    <td class="negrilla"><?php echo $reg->nombre . ' ' . $reg->ap_paterno . "<br>"; ?></td>
                                    <td><?php echo $reg->detalle_dirigido_a; ?></td>
                                    <td><?php echo $reg->dirigido; ?></td>

                                    <td><?php echo $reg->fecha_cheque; ?></td>
                                    <td><?php echo $reg->comentario; ?></td>
     <!--                               <td><?php //echo $reg->fecha_creacion;              ?></td>
                                    <td><?php //echo $reg->duracion              ?></td>
                                    <td><?php //echo $reg->observaciones;              ?></td>
                                    <td><?php //echo $reg->monto;              ?></td>
                                    <td><?php //echo $reg->usuario_asignado;              ?></td>


                                    -->

                                </tr>
                                <?php
                                //$suma_registros+=$reg->monto;
                            }
                            ?>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

</div>


