
<div class="row ">


    <div class="col-md-12 col-sm-12 col-xs-12  f20 negrilla">
        Reporte de Rendiciones
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12 ">
        <div class="col-md-2 col-sm-2 col-xs-12  ">
            Seleccione el Proyecto a filtrar: <select class="form-control " id="id_proy_sitio" onchange="cargar_sitiosproyecto();">
                <option value="0" >Todos los Proyectos</option>
                <?php
                foreach ($proyectos->result() as $pr) {
                    $sel = '';
                    if ($proyectosel == $pr->id_proy)
                        $sel = 'selected="selected"';
                    echo "<option value='$pr->id_proy' $sel >$pr->nombre </option>";
                }
                ?>

            </select>

        </div>

        <div class="col-md-2 col-sm-2 col-xs-12">
            Seleccione el Personal
            <select id="tecnico_seleccionado" class="form-control" onchange="obtener_estado_cuentas('div_caja_chica', 'div_fRendir')" >
                <option value="0" > Seleccione un usuario</option>
                <?php
                foreach ($personal_datos->result() as $user) {
                    $sel = "";
                    if ($user->cod_user == $personal)
                        $sel = "selected='selected'";
                    ?>
                    <option <?= $sel ?> value="<?= $user->cod_user ?>" ><?= $user->ap_paterno . " " . $user->ap_materno . "," . $user->nombre ?></option>
                    <?php
                }
                ?>

            </select>

        </div>



        <div class="col-md-2 col-sm-2 col-xs-12  ">
            Seleccione el sitio: 
            <div class="sitioselect_carga">

                <?php
                echo $sitio_sel;
                ?>



            </div>
        </div>
        <div class="col-md-2 col-sm-2 col-xs-12  ">
            Rango: <select class="form-control " id="rango" onchange="">
                <option value="1" <?php if ($rango == 1) echo " selected='selected' " ?> >mes</option>
                <option value="3" <?php if ($rango == 3) echo " selected='selected' " ?> >Tres Meses</option>
                <option value="6" <?php if ($rango == 6) echo " selected='selected' " ?> >Seis Meses</option>
                <option value="12" <?php if ($rango == 12) echo " selected='selected' " ?> >Año</option>
                <option value="0" <?php if ($rango == 0) echo " selected='selected' " ?> >personalizado</option>


            </select>

        </div>
        <div class="col-md-2 col-sm-2 col-xs-12  alin_der ">
            <br><button class="btn btn-primary" id="act" onclick="filtrar_proyecto_sitio_reporte_rendicion()">Actualizar Datos</button>

        </div>
    </div>


    <div class='col-md-12 col-sm-12 col-xs-12' >
        <div id='informacion_consulta'>

        </div>

    </div>
</div>






<script>cargar_proy_interno();
filtrar_proyecto_sitio_reporte_rendicion();
</script>

<script>
    //Cuando la página esté cargada completamente
    $(document).ready(function () {
        //Cada 10 segundos (10000 milisegundos) se ejecutará la función refrescar
        setTimeout(refrescar, 300000);
    });
    function refrescar() {
        //Actualiza la página

        $("#act").click();
    }
</script>







