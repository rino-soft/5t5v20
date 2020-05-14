
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
    $descripcion = $datos_po->row()->descripcion;
    $monto = $datos_po->row()->monto;
    $usuario = $datos_po->row()->user_asignado;
    //  $monto = $datos_po->row()->monto;

    $backg = "#00ff1e";
}
?>

<div class="col-md-12 col-sm-12 col-xs-12" >
    <div class="x_panel"style="border: #000 solid 5px ">
        <div class="x_title">

            <div class="col-md-12 col-sm-12 col-xs-12 form-group ">
                <div class="col-md-8 col-sm-8 col-xs-12 f16 negrilla  "><br>
                    Registro de item de PO
                </div>
                <div class="col-md-2 col-sm-2 col-xs-12 f16 negrilla alin_der  ">
                    corresponde al mes: 
                    <select id="mes_registro" class="form-control">
                        <?php
                        $fecha_actual = date("d-m-Y");
                        $arraymes = Array("Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic");
                        $mesesg = "";
                        $me = "";
                        for ($i = 0; $i < 6; $i++) {
                            $fa = strtotime($fecha_actual);
                            $me = $arraymes[date("m", $fa) - 1];
                            $mesesg.= "<option value='". date("Y", $fa)."-".date("m", $fa)  ."'>".$me . "/" . date("Y", $fa) . "</option>" ;
                            //$aniog=date("Y", $fa).",".$mesesg;
                            $fecha_actual = date("d-m-Y", strtotime($fecha_actual . "- 1 month"));
                        }
                        echo $mesesg;
                        ?>
                        
                    </select>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-12  alin_der"><br>
                    <button class="btn btn-primary" onclick="add_registroitem()"> + addicionar Item</button>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>








        <div id="grilla_modelo" class="ocultar">
            <div class="col-md-12 col-sm-12 col-xs-12 form-group bordeArriba esparriba5">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="col-md-2 col-sm-2 col-xs-2">
                        XX<input type="hidden" value="0" id="id_det_po" >
                    </div>
                    <div class="col-md-10 col-sm-10 col-xs-10 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" placeholder="Nro PO del Cliente" id="nropo" value="<?= $nro_po ?>">
                        <span class="fa fa-file-o form-control-feedback left" aria-hidden="true"></span>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <textarea id="comentariodet" placeholder="Detalle Item" required="required" class="form-control" style="height: 45px;" name="message" data-parsley-trigger="keyup" data-parsley-minlength="0" data-parsley-maxlength="300" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.."
                              data-parsley-validation-threshold="10"></textarea>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback">
                    <input type="number" class="form-control has-feedback-left" placeholder="Monto" id="montoItem" style="padding-right: 0px" onkeyup="sumadetalle();">
                    <span class="fa fa-file-o form-control-feedback left" aria-hidden="true"></span>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-12 ">
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
                <div class="col-md-1 col-sm-1 col-xs-12 form-group has-feedback">
                    <button class="btn btn-danger" onclick="quitar_item_po('XX')">Quitar</button>
                </div>

            </div>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12 form-group bordeado1" style="background: #F7FDFC">



            <div class="col-md-12 col-sm-12 hidden-xs  alin_cen negrilla f20">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        Item
                    </div>
                    <div class="col-md-10 col-sm-10 col-xs-10">
                        Nro de PO Cliente
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    Detalle
                </div>
                <div class="col-md-2 col-sm-2 col-xs-12">
                    Monto
                </div>
                <div class="col-md-2 col-sm-2 col-xs-12">
                    Personal asignado
                </div>

            </div>


            <div class="col-md-12 col-sm-12 col-xs-12 form-group" id="detalle_items_po">
<?php
if ($id_po != 0) {
    $c = 1;
    ?>
                    <div id="detpo<?= $c ?>">
                        <div class="col-md-12 col-sm-12 col-xs-12 form-group bordeArriba esparriba5">
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="col-md-1 col-sm-1 col-xs-12">
    <?= $c ?><input type="hidden" value="<?= $id_po ?>" id="id_det_po" >
                                </div>
                                <div class="col-md-10 col-sm-10 col-xs-10 form-group has-feedback">
                                    <input type="text" class="form-control has-feedback-left" placeholder="Nro PO del Cliente" id="nropo" value="<?= $nro_po ?>">
                                    <span class="fa fa-file-o form-control-feedback left" aria-hidden="true"></span>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <textarea id="comentariodet" required="required" class="form-control" style="height: 45px;"  placeholder="Detalle Item"
                                          name="message" data-parsley-trigger="keyup" data-parsley-minlength="0" data-parsley-maxlength="300" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.."
                                          data-parsley-validation-threshold="10"><?= $descripcion ?></textarea>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback">
                                <input type="number" class="form-control has-feedback-left" placeholder="Monto" id="montoItem" style="padding-right: 0px" onkeyup="sumadetalle();" value="<?= $monto ?>">
                                <span class="fa fa-file-o form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-12 ">
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
                            <div class="col-md-1 col-sm-1 col-xs-12 form-group has-feedback">
                                <button class="btn btn-danger" onclick="quitar_item_po('<?= $c ?>')">Quitar</button>
                            </div>

                        </div>
                    </div>

    <?php
    $itemsdetalle.="," . $c;

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