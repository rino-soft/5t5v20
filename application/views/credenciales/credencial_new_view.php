<?php
$id_cliente = "";
$rs = "";
$nit = "";
$ids = "";
$cant_item = 0;
$monto_total = 0;
$monto_total_dev = 0;
$comentario = "";
$codigo_items = "";
$nit_cliente = "";
$razon_social = "";
$id_proyecto = 0;
$id_contrato = 0;
$desactivado = '';
$fac_n_o = '';
$auto_n_o = '';
$fec_n_o = '';



if ($id_send != 0) {

    $num_fac = $data_fac->num_factura;
    $id_disificacion = $data_fac->id_dosificacion;
    $fecha_hora_registro = $data_fac->fh_registro;
    $id_cliente = $data_fac->id_cliente;
    $subtotal_bs = $data_fac->subtotal_bs;
    $nit_cliente = $data_fac->NIT_cliente;
    $razon_social = $data_fac->razon_social;

    $id_proyecto = $data_fac->id_proyecto;
    $id_contrato = $data_fac->id_contrato;

    //$cant_item = $data_fac->num_rows();
    $monto_total = $data_fac->monto_total_bs;
    $monto_total_dev = $data_fac->monto_devolucion;
    $comentario = $data_fac->comentario;
    $vec_ids = array();
    $i = 0;
    $codigo_items = "";
    $desactivado = ' disabled="disabled "';
    $fac_n_o = $data_fac->factura_original;
    $auto_n_o = $data_fac->autorizacion_original;
    $fec_n_o = $data_fac->fecha_original;
}
?>







<div class="container_20">

    <div class="grid_20">
        <div class="grid_10 titulo_contenido">
            Generacion de Credenciales
        </div>
        <div class="grid_5 bordeado" style="width: 246px;">
            <div class="grid_5 alin_cen f20 negrilla">
                Nuevo
            </div>
            <div class="grid_5 alin_cen f10">
                Estado
            </div>
        </div>
        <div class="grid_5 bordeado">
            <div class="grid_5 alin_cen f20 negrilla">
                100100
            </div>
            <div class="grid_5 alin_cen f10">
                Codigo de credencial
            </div>
        </div>
    </div>
    <div class="grid_20">
        <div class="grid_20">
            <select style="padding: 5px;width: 250px"> <option >asdasd asdhkgasdk s</option></select>
        </div>
        <div class="grid_20 f10" style="color: #555555">
            Tipo de Credencial
        </div>
    </div>
    <div class="grid_20">
        <div class="grid_20">
            <input type="text" class="fondobuscar300" style="padding: 5px,5px,5px,20px;width: 550px">
        </div>
        <div class="grid_20 f10" style="color: #555555">
            personal a asignar
        </div>
    </div>
    <div class=" grid_20 bordeado fondo_plomo_claro_areas" >
        <div class="grid_4">
            <div class="grid_4">
                <div class="bordeado fondo_blanco " style="width: 150px; height: 150px;margin: 5px 23px 5px 23px">imagen

                </div>
                <div class=" boton2 centrartexto" style=" color:#555555 ;width: 125px;margin: 0px 23px 0px 23px">Cambiar Foto</div>
            </div>

        </div>
        <div class="grid_15 prefix_1">
        <div class="grid_14">
            <input type="text">
        </div> 
        <div class="grid_14">
            Nombre Completo
        </div> 
        </div> 

    </div>



</div>

