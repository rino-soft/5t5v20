<div style="width: 1000px;">
    <div class="f30 negrilla alin_cen" style="color: #999999; width: 100%"><input type="hidden" id="id_user" value="<?php echo $usuario->cod_user; ?>" >
        <input type="hidden" id="id_cuenta" value="0" >
        <?php echo $usuario->nombre . " " . $usuario->ap_paterno . " " . $usuario->ap_materno; ?></div>
    <div class="f20 alin_cen" style="color: #002166; width: 100%"> CI : <?php echo $usuario->ci . " " . $usuario->exp; ?></div>
    <div style="width: 70%;margin:10px 15% 10px 15%;"  >
        <div style="width: 100%; "  >
            <div class="fondo_plomo_claro_areas" style="padding: 10px;display: inline-block; ">

                <div style="width: 80%; float: left; display: inline-block"><div style="width: 100%;display: inline-block; float: left;">
                        <div class="" style="float: left; display: inline-block;margin: 5px 0 0 0; width: 150px;">Nombre de Banco :</div>
                        <div class="" style="float: left; display: inline-block"><input type="text" class="input_redond_100" id="bank" style="width: 350px; margin: 0;"></div>
                    </div>
                    <div style="width: 100%;display: inline-block; float: left;">
                        <div class="" style="float: left; display: inline-block;margin: 5px 0 0 0;width: 150px;">Numero de Cuenta :</div>
                        <div class="" style="float: left; display: inline-block"><input type="text" id="cuenta" class="input_redond_100" style="width: 350px; margin: 0;"></div>
                    </div>
                    <div style="width: 100%;display: inline-block; float: left;">
                        <div class="" style="float: left; display: inline-block;margin: 5px 0 0 0;width: 150px;">Estado</div>
                        <div class="" style="float: left; display: inline-block">
                            Activo <input type="radio" name="estado" value="Activo" >
                            Inactivo<input type="radio" name="estado" value="Inactivo">
                        </div>
                    </div>
                    <div style="width: 100%;display: inline-block; float: left;">
                        <div class="" style="float: left; display: inline-block;margin: 5px 0 0 0;width: 150px;">Comentario de la Cuenta</div>
                        <div class="" style="float: left; display: inline-block"><textarea class="textarea_redond_300x45" id="comentario"></textarea></div>
                    </div>
                </div>
                <div class="alin_cen " style="width: 17%;float: left; display: inline-block"> 
                    <br><br>
                    <input type="button" id="guardar" class="milink" value=" Guardar Registro" onclick="guardar_registro_cuenta_personal()">
                    <br><br>
                    <input type="button" id="cancelar" class="milink" value="Cancelar Registro">

                </div>


            </div>

        </div>
    </div>

    <div class="espabajo5" ></div>
    <div style="width: 95%;margin:10px 2.5% 10px 2.5%;" >
        <div class="fondo_plomo_claro_areas" style="f12">
            <div style="width: 100%; display: inline-block; border-bottom: solid 5px #000080 " class=" negrilla f12">
                <div class="alin_cen" style="width: 30%;display: inline-block; float: left;">Banco</div>
                <div class="alin_cen" style="width: 10%;display: inline-block; float: left;">Cuenta</div>
                <div class="alin_cen" style="width: 25%;display: inline-block; float: left;">Comentario</div>
                <div class="alin_cen" style="width: 10%;display: inline-block; float: left;">Registro</div>
                <div class="alin_cen" style="width: 15%;display: inline-block; float: left;">Estado</div>
            </div>

            <?php foreach ($cuenta->result() as $cb) { ?>
                <div style="width: 100%; display: inline-block;" class="f12 filas_cu">
                    <div class="alin_cen f7" style="width: 3%;display: inline-block; float: left;"><?php echo $cb->id_cuenta."<br>"; ?></div>
                    <div class="alin_cen" style="width: 27%;display: inline-block; float: left;"><?php echo $cb->Banco . "<br>"; ?></div>
                    <div class="alin_cen colorGuindo negrilla" style="width: 10%;display: inline-block; float: left;"><?php echo $cb->cuenta . "<br>"; ?></div>
                    <div class="alin_cen f10" style="width: 28%;display: inline-block; float: left;"><?php echo $cb->comentario . "<br>"; ?></div>
                    <div class="alin_cen f10" style="width: 10%;display: inline-block; float: left;"><?php echo $cb->fecha_registrer . "<br>"; ?></div>
                    <div class="alin_cen" style="width: 10%;display: inline-block; float: left;"><?php echo $cb->estado . "<br>"; ?></div>
                    <div class="alin_cen" style="width: 12%;display: inline-block; float: left;">
                        <div class="link_azul f10 milinktext" style="float: left; margin: 2px;" 
                             onclick="cargar_datos_editar('<?php echo $cb->id_cuenta;?>','<?php echo $cb->Banco;?>','<?php echo $cb->cuenta;?>', '<?php echo $cb->estado;?>', '<?php echo $cb->comentario;?>')">Editar</div>
                        <div class="link_azul colorGuindo milinktext f10" style="float: left; margin: 2px;"
                             onclick="eliminar_registro_cuenta_empresa(<?php echo $cb->id_cuenta; ?>)" >Eliminar</div>

                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

</div>