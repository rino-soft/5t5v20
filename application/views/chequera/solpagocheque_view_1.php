<?php
$nro_cheque = 1;
$res_busqueda = "";
$sw = 0;
if ($inicial != 0) {
    $nro_cheque = $inicial;
}
echo $inicial . "<br>";

foreach ($d_solpago->result() as $sp) {
    // $sp = $d_solpago->row();
    ?>
<div class=" x_panel col-md-12 col-sm-12 col-xs-12" id="cheque<?= $sp->id ?>" style="background: #ebffeb;">
        <?php
        if ($sw == 1)
            $res_busqueda.=",";
        $res_busqueda.=$sp->id;
        $sw = 1;

        $estado_sp = "";
        $estado_class = "btn-dark";

        if ($sp->estado == 1) {
            $estado_sp = "(Pagado)";
            $estado_class = " btn-warning";
        }
        if ($sp->estado == -1) {
            $estado_sp = "(Solicitud Anulada)";
            $estado_class = " btn-danger";
        }
        ?>

        <div class="   col-md-12 col-sm-12 col-xs-12 ">
            <div class="   col-md-9 col-sm-9 col-xs-9 ">
                <spam class="f20 negrilla">  Proveedor <?= $sp->nombre ?> <?= $estado_sp ?></spam>
                <input type="hidden" value="<?= $sp->nombre ?>" id="det_dirigido">
            </div>
            <div class="   col-md-2 col-sm-2 col-xs-2 btn-round alin_cen  <?= $estado_class ?> ">
                <spam class="f20 negrilla"> <?= $estado_sp ?></spam>
            </div>
            <div class="   col-md-1 col-sm-1 col-xs-1 alin_der ">
                <button class="btn btn-danger btn-round fa fa-times " onclick="quitar_cheque('<?= $sp->id ?>')"></button>
            </div>
        </div>

        <div class="  col-md-4 col-sm-4 col-xs-12">

            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                
                <label for="message">Nro Solicitud Pago</label>
                <input type="text" class="form-control has-feedback-left" placeholder="PO/Nombre/titulo" id="id_docu" value="<?= $sp->id ?>" >
                <span class="fa fa-edit form-control-feedback left" aria-hidden="true"></span>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                <label for="message">Monto</label>
                <input type="text" class="form-control has-feedback-left f20 negrilla" placeholder="Monto" id="tituloPO" value="<?= $sp->monto ?>" >
                <span class="fa fa-money form-control-feedback left" aria-hidden="true"></span>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                <label for="message">Comentarios</label>
                <textarea id="comentario" required="required" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="0" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.."
                          data-parsley-validation-threshold="10"><?= $sp->concepto ?></textarea>
            </div>

        </div>
        <div class="  col-md-8 col-sm-8 col-xs-12">
            <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback ">
                <label for="message">Nro de Cheque</label>
                <input type="text" class="form-control has-feedback-left f20 negrilla bg-warning" placeholder="Nro Cheque" id="nro_cheque" value="<?= $nro_cheque ?>"  >
                <span class="fa fa-money form-control-feedback left" aria-hidden="true"></span>
            </div>
            
            <?php 
            $comp="";
            if(isset($comprobantes[$sp->id]))
            {
                $comp=$comprobantes[$sp->id];
            }
            ?>
            <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                <label for="message">comprobante</label>
                <input type="text" class="form-control has-feedback-left f20 negrilla" placeholder="Monto" id="comprobante" onchange="comprobantesHist('<?=$sp->id?>')" value="<?=$comp?>" >
                <span class="fa fa-money form-control-feedback left" aria-hidden="true"></span>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">

                <div class="form-group">
                    <label for="message">fecha Cheque</label>
                    <div class='input-group date' id='myDatepicker<?=$sp->id?>'>
                        <input type='text' class="form-control" readonly="readonly" id="fec_cheque"  value="<?=$fecha_cheque?>"/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>

              
                <script>
                    
                    $('#myDatepicker<?=$sp->id?>').datetimepicker({
                        ignoreReadonly: true,
                        allowInputToggle: true,
                         format: 'YYYY-MM-DD'
                    });
                </script>

                <!--                <label for="message">fecha Cheque</label>
                                <input type="text" class="form-control has-feedback-left f20 negrilla" placeholder="Fecha cheque" id="fecha_cheque"  >
                                <span class="fa fa-money form-control-feedback left" aria-hidden="true"></span>-->
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                <label for="message">Monto Cheque</label>
                <input type="text" class="form-control has-feedback-left negrilla btn-success" style="font-size: 16px;" placeholder="Monto" id="monto" value="<?= $sp->monto ?>"  >
                <span class="fa fa-money form-control-feedback left" aria-hidden="true"></span>
            </div>
            <?php
            $nro_cheque++;
            if ($sp->tipo_pago_prov == 1) {
                $dirigido = $sp->nombre_para_cheque;
            } else {
                $dirigido = $sp->nombre_banco . " Cta nro:" . $sp->cuenta_bancaria;
            }
            ?>
            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                <label for="message">Dirigido a:</label>
                <input type="text" class="form-control has-feedback-left f20 negrilla" placeholder="Monto" id="dirigido_a"  value="<?= $dirigido ?>">
                <span class="fa fa-money form-control-feedback left" aria-hidden="true"></span>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 form-group alin_der">

            </div>
        </div>

    </div>


<?php } ?>


<div class="row col-md-12 col-sm-12 col-xs-12 alin_der">
    <input type="text" id="sp_encontrados" value="<?= $res_busqueda ?>">
    <button class="btn btn-round btn-lg btn-success " onclick="guardar_imprimir_cheque()">Guardar e Imprimir</button>
    <button class="btn btn-round btn-lg btn-danger">Cancelar</button>

</div>