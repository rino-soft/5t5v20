
<?php
$nro_reg = "0";
$itemsdetalle = "";

$nro_po = "";
$titulo_po = "";
$usuario = "";
$monto = 0;
$observaciones = "";
$backg = "#ffc800";


if ($id_po != 0) {
    $nro_reg = $id_po;
    $nro_po = $datos_po->row()->nroPO;
    $titulo_po = $datos_po->row()->titulo;
    $usuario = $datos_po->row()->usuario_asignado;
  //  $monto = $datos_po->row()->monto;
    $observaciones = $datos_po->row()->observaciones;
    $backg = "#00ff1e";
}
?>

<div class="col-md-12 col-sm-12 col-xs-12" >
    <div class="x_panel"style="border: #000 solid 5px ">
        <div class="x_title">
            <span class="f16 negrilla">Registro de PO </span>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>

        

           

            <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                <input type="text" class="form-control has-feedback-left" style="background:<?=$backg ?> ; font-size: 20px; font-weight: bold" placeholder="Registro" id="idpo" value="<?=$nro_reg?>" readonly="readonly">
                <span class="fa fa-file-o form-control-feedback left" aria-hidden="true"></span>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                <input type="text" class="form-control has-feedback-left" placeholder="Nro PO del Cliente" id="nropo" value="<?=$nro_po?>">
                <span class="fa fa-file-o form-control-feedback left" aria-hidden="true"></span>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                <input type="text" class="form-control has-feedback-left" placeholder="PO/Nombre/titulo" id="tituloPO" value="<?=$titulo_po?>" >
                <span class="fa fa-edit form-control-feedback left" aria-hidden="true"></span>
            </div>

           
            <div class="col-md-3 col-sm-3 col-xs-12 ">
                <select class=" form-control " tabindex="-1" id="id_personal">
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



            <div id="grilla_modelo" class="ocultar">
                <div class="col-md-12 col-sm-12 col-xs-12 form-group bordeArriba esparriba5">
                    <div class="col-md-1 col-sm-1 col-xs-12">
                        XX<input type="hidden" value="0" id="id_det_po" >
                    </div>
                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <textarea id="comentariodet" placeholder="Detalle Item" required="required" class="form-control" style="height: 45px;" name="message" data-parsley-trigger="keyup" data-parsley-minlength="0" data-parsley-maxlength="300" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.."
                                  data-parsley-validation-threshold="10"></textarea>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback">
                        <input type="number" class="form-control has-feedback-left" placeholder="Monto" id="montoItem" style="padding-right: 0px" onkeyup="sumadetalle();">
                        <span class="fa fa-file-o form-control-feedback left" aria-hidden="true"></span>
                    </div>
                    <div class="col-md-1 col-sm-1 col-xs-12 form-group has-feedback">
                        <button class="btn btn-danger" onclick="quitar_item_po('XX')">Quitar</button>
                    </div>

                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 x_title alin_cen negrilla f20 bg-green" style="padding: 0px; margin: 0px 5px 0px 0px">
                detalle items PO
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 form-group bordeado1" style="background: #F7FDFC">



                <div class="col-md-12 col-sm-12 hidden-xs  alin_cen negrilla f20">
                    <div class="col-md-1 col-sm-1 col-xs-12">
                        Item
                    </div>
                    <div class="col-md-7 col-sm-7 col-xs-12">
                        Detalle
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        Monto
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12 form-group" id="detalle_items_po">
                    <?php
                   
                    if ($id_po != 0) {
                        $c = 0;
                        foreach ($detalle_po->result() as $det) {
                            $c++;
                            ?>
                            <div id="detpo<?= $c ?>">
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group bordeArriba esparriba5">
                                    <div class="col-md-1 col-sm-1 col-xs-12">
                                        <?= $c ?><input type="hidden" value="<?= $det->idordencompra_detalle ?>" id="id_det_po" >
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-12">
                                        <textarea id="comentariodet" required="required" class="form-control" style="height: 45px;"  placeholder="Detalle Item"
                                                  name="message" data-parsley-trigger="keyup" data-parsley-minlength="0" data-parsley-maxlength="300" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.."
                                                  data-parsley-validation-threshold="10"><?= $det->descripcion ?></textarea>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback">
                                        <input type="number" class="form-control has-feedback-left" placeholder="Monto" id="montoItem" style="padding-right: 0px" onkeyup="sumadetalle();" value="<?= $det->monto ?>">
                                        <span class="fa fa-file-o form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-xs-12 form-group has-feedback">
                                        <button class="btn btn-danger" onclick="quitar_item_po('<?= $c ?>')">Quitar</button>
                                    </div>

                                </div>
                            </div>

                            <?php
                            $monto+=$det->monto;
                            $itemsdetalle.="," . $c;
                        }
                        $nro_reg = $c;
                    } else {
                        ?>
                        <script> //borrarcontenidoPO();
                            add_registroitem();</script>
                            <?php
                        }
                        ?>
                </div>
                <input type="hidden" id="itemsdetalle" value="<?= $itemsdetalle ?>">
                <input type="hidden" id="nro_reg" value="<?= $nro_reg ?>">
                <input type="hidden" id="ids_borrados" value="">



                <div class="col-md-12 col-sm-12 col-xs-12 form-group alin_der">
                    <div class="col-md-8 col-sm-8 col-xs-12 form-group alin_der">
                        TOTAL .- 
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-12 form-group alin_der has-feedbac">
                        <input type="number" id="monto"  placeholder="Monto" name="number" required="required" data-validate-minmax="0,1000000" class="form-control col-md-7 col-xs-12 has-feedback-left" 
                               style="padding-right: 0px;font-size: 18px;font-weight: bold;border:solid 4px #009900;" value="<?=$monto?>">
                        <span class="fa fa-money form-control-feedback left" aria-hidden="true"></span>
                    </div>

                    <div class="col-md-1 col-sm-1 col-xs-12 form-group alin_der">
                        <button class="btn btn-warning" onclick="add_registroitem()"> + addicionar Item</button>
                    </div>
                </div>


            </div>





            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                <label for="message">Observaciones Comentarios (100 max caracteres) :</label>
                <textarea id="comentario" required="required" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="0" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.."
                          data-parsley-validation-threshold="10"><?=$observaciones?></textarea>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 form-group alin_der">
                <button type="button" class="btn btn-danger" style="margin-right: 0;" onclick="ocultar_form_po()" >Cancelar</button>
                <button type="button" class="btn btn-dark" style="margin-right: 0;" onclick="mostrar_form_po(0)" >Borrar Datos</button>

                <button type="button" class="btn btn-success"style="margin-right: 0;" onclick="registrar_po()">Guardar Registro</button>

            </div>


    </div>
</div>
<script> //borrarcontenidoPO();
    //add_registroitem();</script>