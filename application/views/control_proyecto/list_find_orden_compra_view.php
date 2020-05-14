<!-- Datatables -->
<link href="<?php echo base_url(); ?>vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">




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


<!-- Datatables -->
<script src="<?php echo base_url(); ?>vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url(); ?>vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url(); ?>vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="<?php echo base_url(); ?>vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="<?php echo base_url(); ?>vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="<?php echo base_url(); ?>vendors/jszip/dist/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>vendors/pdfmake/build/vfs_fonts.js"></script>



<script>

</script>