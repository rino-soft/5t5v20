
<?php
$placa = "";
$mod = "";
$marca = "";
$anio = "";
$color = "";
$estado = "Inactivo";
$tipo_vehi = "";
$motor = "";
$chasis = "";
$cap_per = "";
$accesorios = "";
$fecha_ad = "";
$traccion = "";
$llanta = "";
$contrato = "";
$cilin = "";
$fecha_ini = "";
$fecha_fin = "";
$motivo = "";
$estado_mov = "";

if ($id_send != 0) {


    $placa = $vehiculo->placa;
    $mod = $vehiculo->modelo;
    $marca = $vehiculo->marca;
    $anio = $vehiculo->anio;
    $color = $vehiculo->color;
    $estado = $vehiculo->estado;
    $tipo_vehi = $vehiculo->tipo;
    $motor = $vehiculo->nro_motor;
    $chasis = $vehiculo->chasis;
    $traccion = $vehiculo->traccion;
    $cap_per = $vehiculo->capacidad;
    $accesorios = $vehiculo->accesorios;
    $fecha_ad = $vehiculo->fecha_adquirida;
    $llanta = $vehiculo->med_llanta;
    $contrato = $vehiculo->contrato;
    $cilin = $vehiculo->cilindrada;
}
?>


<input id="id_vehi" type="hidden" value="<?php echo $id_send; ?>">

<div class="grid_8 ">
    <div class="grid_4 "  style="padding-top: 0px">
        <input class="input_redond_180 " type="text" id="placa" placeholder="Ej.:ABC1234" value="<?php echo $placa; ?>">
        <div class="f10 negrilla"> Placa</div>
    </div>
    <div class="grid_4 " style="" >
        <input class="input_redond_180 " type="text" id="marca" placeholder="Ej.: Toyota" value="<?php echo $marca; ?>">
        <div class="f10 negrilla"> Marca</div>
    </div>

</div>
<div class="grid_8">
    <div class="grid_4 " >
        <input class="input_redond_180"  type="text" id="color" placeholder="Ej.: Blanco" value="<?php echo $color; ?>">
        <div class="f10  negrilla">Color del vehículo</div>
    </div>

    <div class="grid_4 "style="" >
        <input class="input_redond_180" type="text" id="mod" placeholder="Ej.:HILUX" value="<?php echo $mod; ?>">
        <div class="f10  negrilla"> Modelo</div>
    </div>

</div>
<div class="grid_8">

    <div class="grid_4 " style="">
        <input class="input_redond_180" type="text" id="motor" placeholder="Ej.:2F2993" value="<?php echo $motor; ?>">
        <div class="f10  negrilla">Nro de Motor</div>
    </div>
    <div class="grid_4 " style="">
        <input class="input_redond_180" type="text" id="chasis" placeholder="Ej.:GHB1254" value="<?php echo $chasis; ?>">
        <div class="f10  negrilla">Chasis</div>
    </div>
</div>
<div class="grid_8">
    <div class="grid_4 " style="">
        <input class="input_redond_100" type="text" id="llanta" placeholder="Ej.: 25/40" value="<?php echo $llanta; ?>">
        <div class="f10 negrilla"> Medida Llanta</div>
    </div>
    <div class="grid_4 " style="">
        <input class="input_redond_100" type="text" id="cilin" placeholder="Ej.:2600 c.c." value="<?php echo $cilin; ?>">
        <div class="f10 negrilla"> Cilindrada</div>
    </div>
</div>
<div class="grid_8">
    <div class="grid_4 " style="padding-top: 15px;">
        <select id="tipo_vehi" value="<?php echo $tipo_vehi; ?>">
            <option>Camioneta</option>
            <option>Vagoneta</option>
            <option>Furgoneta</option>
            <option>Minibus</option>
            <option>Jeep</option>
        </select>
      <!-- <input class="input_redond_180" type="text" id="tipo_vehi" placeholder="Ej.: Camioneta" value="<?php echo $tipo_vehi; ?>">--->
        <div class="f10  negrilla">Tipo de Vehículo</div>
    </div>
    <div class="grid_4 " style="">
        <input class="input_redond_180" id="fecha_ad" placeholder="Fecha.." value="<?php echo $fecha_ad; ?>">
        <div class="f10 negrilla">Fecha de Adquisición</div>
        <script>$("#fecha_ad").datepicker();</script>
    </div>
</div>

<div class="grid_8" style="padding-top: 10px">

    <div class="grid_2 " style="">

        <select id="traccion" >
            <option value="simple" <?php if ($traccion == "simple") echo "selected='selected'"; ?> >4X2</option>
            <option value="doble" <?php if ($traccion == "doble") echo "selected='selected'"; ?>> 4X4</option>
        </select>
        <div class="f10  negrilla">Tracción</div>
    </div>

    <div class="grid_2 " style="">
        <select id="cap_per" >
            <?php
            for ($i = 1; $i <= 14; $i++) {
                if ($cap_per == $i)
                    echo "<option selected='selected' value='$i'>$i</option>";
                echo "<option value='$i'>$i</option>";
            }
            ?>
        </select>
        <div class="f10  negrilla">Capacidad</div>
    </div>
    <div class="grid_2 "style="" >
        <select id="anio" >
<?php
$aniof = date("Y");
for ($i = $aniof; $i >= $aniof - 30; $i--) {
    if ($aniof == $i)
        echo "<option selected='selected' value='$i'>$i</option>";
    echo "<option value='$i'>$i</option>";
}
?>
        </select>
        <div class="f10 negrilla"> Año</div>
    </div> 

    <div class="grid_2 " style="">
        <select id="contrato" value="">
            <option value="Alquilado" <?php if ($contrato == "Alquilado") echo "selected='selected' " ?>>Alquilado</option>
            <option value="Propio" <?php if ($contrato == "Propio") echo "selected='selected' " ?>>Propio</option>
        </select>
        <div class="f10  negrilla">Tipo de Contrato</div>
    </div>
</div>

<div class="grid_8 fondo_plomo_claro_areas" style="padding-top: 10px">
    <div class="grid_2">
        <select id="esta_general" onchange="cambiar_estado_vehiculo('esta_general','opcion_inactiva','opcion_activa','<?php echo $estado; ?>')">
            <option value="Inactivo" <?php if ($estado == "Inactivo") echo "selected='selected' " ?>>Inactivo</option>
            <option value="Activo"<?php if ($estado == "Activo") echo "selected='selected' " ?>>Activo</option>
        </select>
        <div class="f10 negrilla colorRojo"> Estado General </div>
    </div>
    <script>cambiar_estado_vehiculo('esta_general','opcion_inactiva','opcion_activa','<?php echo $estado; ?>');</script>

</div>

<div class="" id="opcion_activa">
    <div class="grid_8 fondo_amarillo bordeAbajo bordeArriba bordeadoDerecha bordeadoIzquierda">
        <input id="id_vehi" type="hidden" value="">
        <div class="grid_4">
            <input class="input_redond_180" id="fecha_ini" placeholder="Fecha Inicio act." value="">
            <div class="f10  negrilla"> Fecha Inicio Actividades</div>
            <script>$("#fecha_ini").datepicker();</script>
        </div>
        <textarea class="textarea_redond_382x65" type="text" placeholder="Escriba una descripcion" id="motivo" value=""></textarea>
        <div class="f10  negrilla"> Motivos de inicio de actividad</div>
        <input id="id_estado" type="hidden" value="">
    </div>
</div>
<div class="" id="opcion_inactiva">
    <div class="grid_8 fondo_amarillo bordeAbajo bordeArriba bordeadoDerecha bordeadoIzquierda">
        <input id="id_vehi" type="hidden" value="">
        <div class="grid_4">
            <input class="input_redond_180" id="fecha_cie" placeholder="Fecha devolucion" value="">
            <div class="f10  negrilla"> Fecha de cierre de actividad</div>
            <script>$("#fecha_cie").datepicker();</script>
        </div>
        <textarea class="textarea_redond_382x65" type="text" placeholder="Escriba una descripcion" id="motivo" value=""></textarea>
        <div class="f10  negrilla"> Motivos de cierre de actividad</div>
        <input id="id_estado" type="hidden" value="">
    </div>
</div>

<div class="grid_8 "style="" >
    <div class="grid_8 "style="padding-top: 10px" >
        <div class="f10  negrilla"> Accesorios</div>
        <textarea class="textarea_redond_382x65" type="text" id="accesorios" placeholder="Escriba los accesorios vehiculo" ><?php echo $accesorios; ?></textarea>
    </div>

    <div class="grid_8 " >

<?php if ($id_send != 0) {
    ?>

            <div class=" espabajo5 milink estadoVehiculo milink" onclick="dialog_nuevo_estado_vehiculo('ayudita_estado','<?php echo base_url() . 'vehiculo/nuevo_estado_vehiculo/' . $id_send . '/0'; ?>')" title="Asignar Estado al Vehiculo"></div>
            <div class=" espabajo5 milink adjuntaDoc" onclick="dialog_subir_archivos_vehiculo('subida_imagen','<?php echo base_url() . 'vehiculo/nuevo_imagen_vehiculo/' . $id_send; ?>')" title="Adjuntar archivos al vehiculo" ></div>
            <!---<div class=" espabajo5 milink asignaVehiculo " title="asignar vehiculo a responsable" ></div>--->

<?php } ?>
    </div>


</div>


<div id="respuesta"></div>
<div id="ayudita_estado"></div>
<div id="subida_imagen" class="container_20"></div>


