<?php
$nro_auto = "";
$num_nit = "";
$llave = "";
$f_emision = "";
$actividad = "";
$nro_inicial = "";
$nro_actual = "";
$f_inicial = "";
$f_final = "";
$estado = "";
$tipo_dosificacion = "FACTURA";
$leyenda = "";

if ($id_dosi != 0) {
    ///$id_dosi=$d_dosificacion->id_dosificacion;
    $nro_auto = $d_dosificacion->nro_autorizacion;
    $num_nit = $d_dosificacion->NIT;
    $llave = $d_dosificacion->llave_cod_control;
    $f_emision = $d_dosificacion->fl_emision;
    $actividad = $d_dosificacion->actividad;
    $nro_inicial = $d_dosificacion->nro_inicial;
    $nro_actual = $d_dosificacion->nro_actual;
    $f_inicial = $d_dosificacion->fecha_inicial;
    $f_final = $d_dosificacion->fecha_final;
    $estado = $d_dosificacion->estado;

    $tipo_dosificacion = $d_dosificacion->tipo_dosificacion;
    $leyenda = $d_dosificacion->leyenda_factura;
}
?>

<input id="id_dosificacion" type="hidden" value="<?php echo $id_dosi; ?>">



<div class="grid_9 ">


    <div class="grid_9 esparriba10">

        <div class="grid_7">
            <div class="grid_7"> Tipo de Dosificacion:</div>
            <div class="grid_7">
                <select id="tipo_dosificacion" style="font-size: 18px; font-weight: bold;" >
                    <option value="FACTURA" <?php if ($tipo_dosificacion == "FACTURA") echo "selected='selected'"; ?>>FACTURA</option>
                    <option value="NOTA DE CRÉDITO - DÉBITO" <?php if ($tipo_dosificacion == "NOTA DE CRÉDITO - DÉBITO") echo "selected='selected'"; ?>>NOTA DE CRÉDITO - DÉBITO</option>
                </select>
            </div>
        </div>
        <div class="grid_2">
            <div class="grid_2">Estado:</div>
            <div class="grid_2">
                <select id="estado" >
                    <option value="Activo" <?php if ($estado == "Activo") echo "selected='selected'"; ?>>Activo</option>
                    <option value="Inactivo" <?php if ($estado == "Inactivo") echo "selected='selected'"; ?>>Inactivo</option>
                </select>
            </div>
        </div>
    </div>

    <div class="grid_9">
        <div class="grid_4 suffix_1" style="">
            <input class="input_redond_180" id="nro_auto" placeholder="Ejemplo: 600400938666" value="<?php echo $nro_auto; ?>">

            <div class="f11 colorAzul">Numero de Autorización</div> 
        </div>

        <div class="grid_4">
            <input class="input_redond_180" id="num_nit" placeholder="Ejemplo: 706717" value="<?php echo $num_nit; ?>">
            <div class=" f11 colorAzul">Numero de NIT</div>
        </div>
    </div>

    <div class="grid_9">
        <input class="input_redond_370" style="width: 430px;" id="actividad" placeholder="Ejemplo: Telecomunicaciones" value="<?php echo $actividad; ?>">
        <div class=" f11 colorAzul">Actividad Económica</div>
    </div>
    <div class="grid_9">
        <textarea style="width: 430px; height: 80px;" id="llave" placeholder="Ejemplo: (r(gIs)D4MVe%f#KeYGA(fbwW_8PPmnLGbI5zWa7J9sVLnX-D)HF*_dKh{(fNcYI," ><?php echo $llave; ?></textarea>
        <div class=" f11 colorAzul">Llave para el Codigo de Control</div>
    </div>
    <div class="grid_9">
        <div class="grid_3 ">
            <input class="input_redond_150" id="f_emision" style="width: 140px;" placeholder="Ejemplo: 27/08/15" value="<?php echo $f_emision; ?>">
            <div class=" f11 colorAzul">fecha de emision</div>
            <script>$("#f_emision").datepicker();</script>
        </div>

        <div class="grid_3 centrartexto">
            <input class="input_redond_150" id="nro_inicial" style="width: 120px;" placeholder="Ejemplo: 000" value="<?php echo $nro_inicial; ?>">
            <div class=" f11 colorAzul">Nro inicial</div>
        </div>
        <div class="grid_3">
            <input class="input_redond_150" id="nro_actual" style="width: 120px;" placeholder="Ejemplo: 1239" value="<?php echo $nro_actual; ?>">
            <div class=" f11 colorAzul">Nro Actual</div>
        </div>
    </div>
    <div class="grid_9">
        <div class="grid_4 suffix_1">                      
            <input class="input_redond_180" id="f_inicial" placeholder="Ejemplo: 27/08/15" value="<?php echo $f_inicial; ?>">
            <div class=" f11 colorAzul">Fecha Inicial</div>
            <script>$("#f_inicial").datepicker();</script>
        </div>
        <div class="grid_4">
            <input class="input_redond_180" id="f_final" placeholder="Ejemplo: 27/08/15" value="<?php echo $f_final; ?>">
            <div class=" f11 colorAzul">Fecha final</div>
            <script>$("#f_final").datepicker();</script>
        </div>
    </div>
    <div class="grid_9">
        <textarea style="width: 430px; height: 80px;" id="leyenda" placeholder="Ejemplo: Ley N° 453: Los medios de comunicación deben promover el respeto de los derechos de los usuarios y consumidores." ><?php echo $leyenda; ?></textarea>
        <div class=" f11 colorAzul">Leyenda de Factura</div>
    </div>

</div>
<div id="respuesta"></div>


