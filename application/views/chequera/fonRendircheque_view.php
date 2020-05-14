<?php
$nro_cheque = 1;
$res_busqueda = "";
$sw = 0;
if ($inicial != 0) {
    $nro_cheque = $inicial;
}
//echo $inicial . "<br>";
//echo "solpago ".$solpagos."<br>";
$sps = explode("*", $solpagos);
//echo "------".count($sps)."<br>";
for ($j = 0; $j < count($sps)-1; $j++) {
    //  echo  "--*****".$sps[$j]."<br>";
    $sp = $datos_cheques[$sps[$j]];
    // $sp = $d_solpago->row();
    
      $estado_sp = "";
        $estado_class = "btn-dark";
        $background="#CCCCCC;";
       // echo $sp[4] . "*************<br>";
        if ($sp[4] == 1) {
            $estado_sp = "(Pagado)";
            $estado_class = " btn-warning";
        $background="#ffff99;";    
        }
        if ($sp[4] == -1) {
            $estado_sp = "(Solicitud Anulada)";
            $estado_class = " btn-danger";
            $background="#ff9999;";
        }
    
    ?>
<div class=" x_panel col-md-12 col-sm-12 col-xs-12" id="cheque<?= $sps[$j] ?>" style="background: <?=$background?>;">
        <?php
        if ($sw == 1)
            $res_busqueda.=",";
        $res_busqueda.=$sp[0]; //0=id
        $sw = 1;

      
        ?>

        <div class="   col-md-12 col-sm-12 col-xs-12 ">
            <div class="   col-md-9 col-sm-9 col-xs-9 ">
                <spam class="f20 negrilla">  Proveedor <?= $sp[5] ?> <?= $estado_sp ?></spam>
                <input type="hidden" value="<?= $sp[5] ?>" id="det_dirigido">
            </div>
            <div class="   col-md-2 col-sm-2 col-xs-2 btn-round alin_cen  <?= $estado_class ?> ">
                <spam class="f20 negrilla"> <?= $estado_sp ?></spam>
            </div>
            <div class="   col-md-1 col-sm-1 col-xs-1 alin_der ">
                <button class="btn btn-danger btn-round fa fa-times " onclick="quitar_cheque('<?= $sp[0] ?>')"></button>
            </div>
        </div>

        <div class="  col-md-4 col-sm-4 col-xs-12">


            <?php
            $swsp = 0;
            // echo "***********************".$sp[0]."<br>";
            $solicitudes = explode("_", $sp[0]);
            $montosolicitudes = explode("|", $sp[1]);
            $estadosolicitudes = explode("|", $sp[4]);
            for ($k = 0; $k < count($solicitudes) ; $k++) {
                $estado_sps = "";
                $estado_classs = "btn-dark";

                if ($estadosolicitudes[$k] == 1) {
                    $estado_sps = "(P)";
                    $estado_classs = " btn-warning";
                }
                if ($estadosolicitudes[$k] == -1) {
                    $estado_sps = "(A)";
                    $estado_classs = " btn-danger";
                }

                if ($swsp == 0) {
                    ?>
                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">

                        <label for="message">Nro Solicitud Pago</label>
                        <input type="text" class="form-control has-feedback-left" placeholder="PO/Nombre/titulo" style="font-size: 22;font-weight: bold"  value="<?= $solicitudes[$k] ?>" >
                        <span class="fa fa-edit form-control-feedback left" aria-hidden="true"></span>
                    </div>

                    <div class="col-md-5 col-sm-5 col-xs-12 form-group has-feedback">
                        <label for="message">Monto</label>
                        <input type="text" class="form-control has-feedback-left f20 negrilla" placeholder="Monto" i value="<?= $montosolicitudes[$k] ?>" >
                        <span class="fa fa-money form-control-feedback left" aria-hidden="true"></span>
                    </div>
                    <div class="col-md-1 col-sm-1 col-xs-12 form-group has-feedback">
                        <label for="message"><br></label>
                        <div class=" <?= $estado_classs; ?> btn-round">
                        <label for="message"><?=$estado_sps?></label></div>
                    </div>
                    <?php
                    $swsp = 1;
                } else {
                    ?>
                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">

                        <input type="text" class="form-control has-feedback-left" placeholder="PO/Nombre/titulo"  value="<?= $solicitudes[$k] ?>" >
                        <span class="fa fa-edit form-control-feedback left" aria-hidden="true"></span>
                    </div>

                    <div class="col-md-5 col-sm-5 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left f20 negrilla" placeholder="Monto"  value="<?= $montosolicitudes[$k] ?>" >
                        <span class="fa fa-money form-control-feedback left" aria-hidden="true"></span>
                    </div> 
                    <div class="col-md-1 col-sm-1 col-xs-12 form-group has-feedback">
                        
                        <div class=" <?= $estado_classs; ?> btn-round">
                        <label for="message"><?=$estado_sps?></label></div>
                    </div>
                    <?php
                }
            }
            ?> 
            <input type="hidden" id="id_docu" value="<?= $sp[0] ?>" >

            <input type="hidden" id="montosp" value="<?= $sp[1] ?>" >
            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                <label for="message">Comentarios</label>
                <textarea id="comentario" required="required" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="0" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.."
                          data-parsley-validation-threshold="10"><?= $sp[3] ?></textarea>
            </div>

        </div>
        <div class="  col-md-8 col-sm-8 col-xs-12">
            <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback ">
                <label for="message">Nro de Cheque</label>
                <input type="text" class="form-control has-feedback-left f20 negrilla bg-warning" placeholder="Nro Cheque" id="nro_cheque" value="<?= $nro_cheque ?>"  >
                <span class="fa fa-money form-control-feedback left" aria-hidden="true"></span>
            </div>

            <?php
            $comp = "";
            if (isset($comprobantes[$sp[0]])) {
                $comp = $comprobantes[$sp[0]];
            }
            ?>
            <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                <label for="message">comprobante</label>
                <input type="text" class="form-control has-feedback-left f20 negrilla" placeholder="Comprobante" id="comprobante" onchange="comprobantesHist('<?= $sp[0] ?>')" value="<?= $comp ?>" >
                <span class="fa fa-money form-control-feedback left" aria-hidden="true"></span>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">

                <div class="form-group">
                    <label for="message">fecha Cheque</label>
                    <div class='input-group date' id='myDatepicker<?= $sp[0] ?>'>
                        <input type='text' class="form-control" readonly="readonly" id="fec_cheque"  value="<?= $fecha_cheque ?>"/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>


                <script>

                    $('#myDatepicker<?= $sp[0] ?>').datetimepicker({
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
                <input type="text" class="form-control has-feedback-left negrilla " style="font-size: 22px; background:#99ff99 " placeholder="Monto" id="monto" value="<?= number_format( $sp[2],2,".","") ?>"  >
                <span class="fa fa-money form-control-feedback left" aria-hidden="true"></span>
            </div>
            <?php
            $nro_cheque++;

            //if ($sp->tipo_pago_prov == 1) {
            //  $dirigido = $sp->nombre_para_cheque;
            //} else {
            $dirigido = $sp[6]
            //}
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
    <input type="hidden" id="sp_encontrados" value="<?= $res_busqueda ?>">
    <button class="btn btn-round btn-lg btn-success " onclick="guardar_imprimir_cheque()">Guardar e Imprimir</button>
    <button class="btn btn-round btn-lg btn-danger">Cancelar</button>

</div>