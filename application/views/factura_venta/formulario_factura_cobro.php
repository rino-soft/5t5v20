

<div class="grid_13 bordeado sombravengadora" style="min-height: 700px;">
    <div class="grid_13">
        <div class="grid_2 f16 negrilla centrartexto espabajo10"><div class="grid_2 negrilla f12" id="ifa"><?php echo $info_fac->id_factura; ?></div><div class="grid_2 f10">Id_factura</div></div>
        <div class="grid_9 f16 negrilla centrartexto espabajo10">Registro de Cobro</div>
        <div class="grid_2 f16 negrilla centrartexto espabajo10"><div class="grid_2 negrilla f20 rojoText" id="ifa"><?php echo $info_fac->num_factura; ?></div><div class="grid_2 f10">No Factura</div></div>
    </div>
    <div class="grid_13">
        <div class="grid_6">
            <div class="grid_6 centrartexto negrilla">
                <?php echo $info_fac->razon_social; ?>
            </div>
            <div class="grid_6 f10 centrartexto">
                Señor(es)
            </div>
        </div>
        <div class="grid_3">
            <div class="grid_3 centrartexto negrilla">
                <?php echo $info_fac->NIT_cliente; ?>
            </div>
            <div class="grid_3 f10 centrartexto">
                NIT
            </div>
        </div>
        <div class="grid_4">
            <div class="grid_4 centrartexto negrilla">
                <?php echo $info_fac->fh_registro; ?>
            </div>
            <div class="grid_4 f10 centrartexto">
                Fecha
            </div>
        </div>

    </div>
    <div class="grid_13 espabajo20"></div>

    <div class="grid_13">
        <div class="grid_13 centrartexto negrilla fondo_plomo_claro_areas_p">
            <div class="grid_13 f16">D E T A L L E  - F A C T U R A </div>
            <div class="grid_1 centrartexto f12">Cant</div>
            <div class="grid_8 centrartexto f12">Descripcion</div>
            <div class="grid_2 centrartexto f12">Unitario</div>
            <div class="grid_2 centrartexto f12">Subtotal</div></div>

        <?php foreach ($detalle_fac->result() as $det) { ?>
            <div class="grid_13 f10 bordeAbajo">

                <div class="grid_1 centrartexto f12"><?php echo $det->cantidad; ?></div>
                <div class="grid_8 f14"><?php echo $det->detalle_ps; ?></div>
                <div class="grid_2 alin_der f12"><?php echo $det->precio; ?></div>
                <div class="grid_2 alin_der negrilla f12"><?php echo $det->importe; ?></div>

            </div>
        <?php } ?>
        <div class="grid_13 bordeArriba azulmarino f16 negrilla">
            <div class="grid_5 alin_der prefix_5">TOTAL</div>
            <div class="grid_3 alin_der"><?php echo $info_fac->monto_total_bs; ?></div>
        </div>
        <div class="grid_13 espabajo20"></div>
        <div class="grid_11 prefix_1 suffix_1 f12">
            <div class="grid_9 f12">
                <span class="guindotext f14">Comentario General:</span><?php echo $info_fac->comentario; ?> 
            </div>
            <div class="grid_2"><img src="<?php echo base_url() . 'imagenesweb/factura_venta_QR/' . $info_fac->codigo_qr_name . '.png'; ?>"></div>
        </div>

        <div class="grid_11 prefix_1 suffix_1 f12 esparriba10">
            <div class="grid_5 f12 ">
                <div class="grid_5 f12 ">Nombre de Proyecto</div>
                <div class="grid_5 f12 ">Proyecto</div>
            </div>
            <div class="grid_5 f12 ">
                <div class="grid_5 f12 ">contrtato</div>
                <div class="grid_5 f12 ">Contrato</div>
            </div>
        </div>

        <div class="grid_11 prefix_1 suffix_1 f12 esparriba10">
            <div class="grid_5">
                <div class="grid_5 f30 negrilla "><?php echo $info_fac->estado_cobro; ?></div>               
                <div class="grid_5 f12 ">Estado de Cobro</div>               
            </div>               
            <div class="grid_5">
                <div class="grid_5 f20 negrilla "><?php echo $info_fac->fecha_prevista_cobro; ?></div>               
                <div class="grid_5 f10 ">5 dias de retraso</div>               
                <div class="grid_5 f12 ">Fecha prevista de pago</div>               
            </div>               
        </div>
        <div class="grid_11 prefix_1 suffix_1 f12">
            <span class="guindotext f14">Historial de Seguimiento:</span><br><?php echo str_replace("*", "<br>", $info_fac->comentarios_seguimiento); ?> 
        </div>

    </div>





</div> 
<div class="grid_6 prefix_1 ">
    <div class="grid_6" >
        <div class="grid_6 OK esparriba10 espabajo10 f16 alin_cen negrilla"> REGISTRO DE COBRO</div>
        <div class="grid_6 esparriba10"></div>
        <div class="grid_6 OK esparriba10 espabajo10 f12 alin_cen negrilla" style="background:#EAF3EC"> 
            <input type="hidden" id="id_cobro" value="<?php echo 0; ?>">
            <input type="hidden" id="id_factura" value="<?php echo $info_fac->id_factura; ?>">
            <input type="hidden" id="id_cliente" value="<?php echo $info_fac->id_cliente; ?>">
            <input type="hidden" id="id_proyecto" value="<?php echo $info_fac->id_proyecto; ?>">
            <input type="hidden" id="id_contrato" value="<?php echo $info_fac->id_contrato; ?>">
            <input type="hidden" id="num_oc" value="<?php echo $info_fac->pedido_compra; ?>">
            
            <div class="grid_5" style="padding: 0 25px 0 25px"><input type="text" id="monto_fac" value="<?php echo number_format($info_fac->monto_total_bs,2,".",""); ?>" class="input_redond_250 alin_der" style="font-size: 20px; padding: 10px;margin: 0;"></div>
            <div class="grid_5" style="padding: 0 25px 0 25px">Monto Facturado</div>
            <div class="grid_5" style="padding: 0 25px 0 25px"><input type="text" id="monto_pen" value="<?php echo  number_format($info_fac->penalidad,2,".",""); ?>" class="input_redond_250 alin_der colorGuindo NO" style="font-size: 20px; padding: 10px;margin: 0;"></div>
            <div class="grid_5 colorGuindo" style="padding: 0 25px 0 25px">Monto Penalidad</div>
            <div class="grid_5" style="padding: 0 25px 0 25px"><input type="text" id="monto_cob" value="<?php echo  number_format(($info_fac->monto_total_bs - $info_fac->penalidad),2,".",""); ?>" class="input_redond_250 alin_der" style="font-size: 20px; padding: 10px;margin: 0;"></div>
            <div class="grid_5" style="padding: 0 25px 0 25px">Monto Cobrado</div>
            <div class="grid_5 esparriba20"></div>
            <div class="grid_5" style="padding: 0 25px 0 25px"><input type="text" id="fecha_cobro" value="<?php echo $info_fac->fecha_prevista_cobro; ?>" class="input_redond_250 alin_cen" style="font-size: 20px; padding: 10px;margin: 0;"></div>
            <div class="grid_5" style="padding: 0 25px 0 25px">Fecha Cobro</div>
            <div class="grid_5" style="padding: 0 25px 0 25px"><textarea placeholder="comentario de Cobro" style="max-width: 250px;min-width: 250px; height: 100px;"></textarea></div>
            <div class="grid_5" style="padding: 0 25px 0 25px">comentario de cobro</div>
        </div>
    </div>
</div>

