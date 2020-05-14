<?php
$instancia = "";
$planD = "";
$planV = "";
$win = "";
$tota = "";
$obs = "";
$cont = "";
$prov = "";
$serv = "";
$lugar = "";
$estado = "";
$id_proy = 0;
$id_user = 0;
$id_ciudad = 0;
$aclaracion = "";

if ($dato_form->num_rows() > 0) {
    $dat = $dato_form->row();
    $instancia = $dat->instancia;
    $planD = $dat->plan_datos;
    $planV = $dat->plan_voz;
    $win = $dat->win;
    $tota = $dat->monto_pago_linea;
    $obs = $dat->observaciones;
    $cont = $dat->contrato;
    $prov = $dat->proveedor;
    $serv = $dat->servicio;
    $lugar = $dat->lugar;
    $estado = $dat->estado;
    $id_proy = $dat->id_proyecto;
    $id_user = $dat->id_personal;
    $id_ciudad = $dat->id_ciudad;
    $aclaracion = $dat->aclaracion_user;
    //$obs=$dat->instancia;
}
?>







<div class="grid_10">
    <div class="grid_10 fondo_plomo_claro_areas_p">
        <div class="grid_10  negrilla f10 colorGuindo">Informacion de linea o Servicio</div>
        <div class="grid_10">
            <div class="grid_5">
                <div class="grid_5">
                    <input id="instancia" value="<?php echo $instancia; ?>" type="Text"  placeholder="Instancia / numero / linea" class="input_redond_250" style="font-size: 20px; margin-top: 5"
                           <?php if ($id_linea != 0) {
                               echo "readonly='readonly'";
                           } ?> > 

<?php if ($id_linea == 0) { ?>
                        <script>
                            $('#instancia').autocomplete({source: [
    <?php
    $flag = 0;
    foreach ($lista_numeros->result() as $ya_registrado) {
        if ($flag > 0)
            echo ",";
        echo " '$ya_registrado->instancia' ";
        $flag++;
    }
    ?>
                                ], change: function (event, ui) {
                                    $.post(burl + "linea_servicio/verifica_linea", {
                                        "instancia": $("#instancia").val() 
                                    }
                                    , function (data) {
                                       if(data!=0)
                                       {
                                           cargar_contenido_html('div_formularios_dialog', '<?php echo base_url(); ?>linea_servicio/formulario_registro_linea_servicio_telecom/'+data , 0);
                                            alert('Te informamos que la linea YA FUE REGISTRADA,\npor lo que hemos Cargado los datos en el Formulario para su edicion.\n \n \t \t \t \t \t \t \t Gracias...  : )');
                                       }

                                    });
                                    //alert('La Linea ya esta REGISTRADA para modificar realiza la busqueda y edita.\n \n \t \t \t \t \t \t \t Gracias...  : )');
                                   // $('#div_formularios_dialog').dialog("close");
                                }})
                        </script>
<?php } ?>
                </div>
                <div class="grid_5 f11 negrilla" >
                    Instancia / Numero / linea 
                </div>
            </div>
            <div class="grid_3 alin_cen " style="margin-top: 10px;">
                <select class="" id="estado">
                    <option <?php if ($estado == "Activo") echo " selected='selected' "; ?> value="Activo" >Activo</option>
                    <option <?php if ($estado == "Inactivo") echo " selected='selected' "; ?> value="Inactivo" >Inactivo</option>
                </select>
            </div>
            <div class="grid_2 alin_cen " >
                <div class="grid_2 f18 fondo_amarillo_claro negrilla colorGuindo">
                    <input type="hidden" value="<?php echo $id_linea; ?>" id="id_linea"><?php echo $id_linea; ?></div>
                <div class="grid_2 f10 negrilla">ID linea</div>
            </div>
        </div>
        <div class="grid_10">
            <div class="grid_2">
                <div class="grid_2">
                    <input type="text" value="<?php echo $planV; ?>" class="input_redond_100 centrartexto" id="pvoz">
                </div>
                <div class="grid_2 centrartexto">
                    Monto Plan Voz
                </div>
            </div>
            <div class="grid_3" >
                <div class="grid_3 centrartexto" >
                    <input type="text" value="<?php echo $planD; ?>" class="input_redond_100 centrartexto" id="pdatos">
                </div>
                <div class="grid_3 centrartexto" >
                    Monto Plan Datos
                </div>
            </div>
            <div class="grid_3">
                <div class="grid_3 centrartexto">
                    <input type="text" value="<?php echo $win; ?>" class="input_redond_100 centrartexto" id="win">
                </div>
                <div class="grid_3 centrartexto">
                    Monto plan WIN
                </div>
            </div>
            <div class="grid_2">
                <div class="grid_2">
                    <input type="text" class="input_redond_100 centrartexto" value="<?php echo $tota; ?>" id="pagols">
                </div>
                <div class="grid_2 centrartexto">
                    Monto Pago
                </div>
            </div>
        </div>
        <div class="grid_10">
            <div class="grid_3">
                <div class="grid_3">
                    <input type="text" class="input_redond_150" id="no_contrato" value="<?php echo $cont; ?>">
                </div>
                <div class="grid_3 centrartexto">
                    Nro de Contrato
                </div>
            </div>
            <div class="grid_4">
                <div class="grid_4 centrartexto " style="margin-top: 20px;">
                    <select id="proveedor">
                        <option value="ENTEL" <?php if ($prov == "ENTEL") echo "selected='selected' "; ?>> ENTEL </option>
                        <option value="VIVA"  <?php if ($prov == "VIVA") echo "selected='selected' "; ?>> VIVA </option>
                        <option value="TIGO" <?php if ($prov == "TIGO") echo "selected='selected' "; ?>> TIGO </option>
                        <option value="COTAS" <?php if ($prov == "COTAS") echo "selected='selected' "; ?>> COTAS </option>
                        <option value="COTEL" <?php if ($prov == "COTEL") echo "selected='selected' "; ?>> COTEL </option>
                        <option value="AXES" <?php if ($prov == "AXES") echo "selected='selected' "; ?>> AXES </option>
                    </select>
                </div>
                <div class="grid_4 centrartexto">
                    Proveedor
                </div>
            </div>
            <div class="grid_3">
                <div class="grid_3 centrartexto" style="margin-top: 20px;">
                    <select id="tipo_servicio">
                        <option value="Telefonia Celular" <?php if ($serv == "Telefonia Celular") echo "selected='selected' "; ?>> Telefonia Celular </option>
                        <option value="Telefonia Fija" <?php if ($serv == "Telefonia Fija") echo "selected='selected' "; ?>> Telefonia Fija </option>
                        <option value="Internet movil" <?php if ($serv == "Internet movil") echo "selected='selected' "; ?>> Internet movil </option>
                        <option value="Internet Fijo" <?php if ($serv == "Internet Fijo") echo "selected='selected' "; ?>> Internet Fijo </option>


                    </select>
                </div>
                <div class="grid_3 centrartexto">
                    Tipo Servicio
                </div>
            </div>

        </div>
        <div class="grid_10" style="margin: 10px 0 0 10px;">
            <div class="grid_10 " >Observaciones/ comentarios </div><div class="grid_5">
                <textarea id="observaciones" class="textarea_redond_221x37" style="width: 480px;height: 49px;"><?php echo $obs; ?></textarea>
            </div>
        </div>
    </div>
    <div class="grid_10 esparriba10"></div>

    <div class="grid_10 fondo_amarillo_claro_rend bordeado1 ">
        <div class="grid_10  negrilla f10 colorGuindo">Informacion de Asignacion de linea o Servicio</div>
        <div class="grid_10">


            <div class="grid_10  esparriba10">
                <div class="grid_10 espabajo10" >
                    <div class="grid_10 centrartexto negrilla">
                        personal : <select id="id_personal" style="width: 400;" <?php if ($id_user == 0) echo "disabled='disabled'"; ?>>
                            <option value="0">Seleccione por favor..</option>
                            <?php
                            foreach ($lista_usuarios->result() as $user) {
                                ?>
                                <option value="<?php echo $user->cod_user; ?>" <?php if ($id_user == $user->cod_user) echo " selected='selected' "; ?>><?php echo $user->ap_paterno . " " . $user->ap_materno . ", " . $user->nombre; ?></option>
                            <?php }
                            ?>
                        </select>
                    </div>


                </div>
                <div class="grid_10">
                    <div class="grid_2 centrartexto">
                        otro <input <?php if ($id_user == 0) echo "checked='checked'"; ?> type="checkbox" id="otro" onclick="
                                        if ($(this).is(':checked')) {
                                            $('#otro_name').prop('disabled', false);
                                            $('#id_personal').prop('disabled', true);
                                        } else {
                                            $('#otro_name').prop('disabled', true);
                                            $('#id_personal').prop('disabled', false);
                                        }">
                    </div>
                    <div class="grid_8">
                        <input id="otro_name" type="text" class="input_redond_370" value="<?php echo $aclaracion; ?>" placeholder="otro Personal" style="margin: 0 0 0 0;" <?php if ($id_user != 0) echo "disabled='disabled'"; ?>>
                    </div>



                </div>
            </div>

            <div class="grid_10">
                <div class="grid_5 centrartexto" style="margin-top: 20px;"> Ciudad <select id="ciudad_id">
                        <option value="0">Seleccione Ciudad..</option>
                        <?php
                        foreach ($selec_ciudad->result() as $ciudad) {
                            ?>
                            <option <?php if ($id_ciudad == $ciudad->codciudad_pk) echo " selected='selected' "; ?> value="<?php echo $ciudad->codciudad_pk; ?>"><?php echo $ciudad->nombre; ?></option>
                        <?php }
                        ?>
                    </select></div>
                <div class="grid_5">Lugar <input class="input_redond_200" id="lugar" value="<?php echo $lugar; ?>"></div>
            </div>

            <div class=" f18 grid_10 espabajo10 esparriba10 centrartexto">
                Proyecto: <select id="id_proyecto"  style=" width: 350px; font-size: 18px;">
                    <option value="0">Seleccione proyecto ..</option>                   
                    <?php
                    foreach ($lista_proyectos->result() as $proy) {
                        ?>
                        <option <?php if ($id_proy == $proy->id_proy) echo " selected='selected' "; ?> value="<?php echo $proy->id_proy; ?>"><?php echo $proy->nombre; ?></option>
                    <?php }
                    ?>
                </select>
            </div>

        </div>
    </div>

    <div id="respuesta" class="grid_10"></div>

</div>
