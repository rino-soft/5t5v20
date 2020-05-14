<div class="grid_8">
    <input type="hidden" value="<?php echo base_url(); ?>" id="burl">


    <div class="grid_8 oculto" id="error_de_formulario_justif"></div>
    <?php // echo form_open_multipart(base_url() . "justificacion_marcado/do_upload"); ?>
    <div class="grid_8">
        <div class="grid_3">Usted realizara una solicitud de : </div>
        <div class="grid_3">
            <select id="tipo_jp" onchange="mostrarseguncambios();" name="tipo_jp">
                <option value="0">Seleccione una opcion...</option>
                <option value="justificacion">Justificacion de marcado</option>
                <option value="Permiso Vacacion">Permiso/Vacacion</option>
                <option value="Baja Medica">Baja Medica</option>
                <option value="Licencia">Licencia</option>
            </select>
        </div> 
        <div class="grid_3">Proyectos : </div>
        <div class="grid_3">
            <?php echo form_dropdown('proyecto', $proyectos_usuario, 0, "id='proyecto' , onchange='javascript:obtener_jefes_proyectos();muestra_arbol_dependientes_de_proyecto_seleccionado();'");
            ?>
        </div> 

    </div>
    <div class="grid_8"><HR width=100% align="center"></div>
    <?php ?>

    <div class="grid_8 esparriba" id="div_licencia">
        <div class="grid_4"> 
            <div class="grid_3 negrilla letraMediana">Ingresa las fechas de salida y retorno</div>
            <br>
            <div class="grid_3 prefix_05" id="div_radiosLicencia">
                <input type="radio" name="radioLicencia" id="radio_naci" onclick='javascript:selecLicencia();' value="Nacimiento">Nacimiento <br>
                <input type="radio" name="radioLicencia" id="radio_defu" onclick='javascript:selecLicencia();' value="Defuncion">Defuncion <br>
                <input type="radio" name="radioLicencia" id="radio_matr" onclick='javascript:selecLicencia();' value="Matrimonio">Matrimonio <br>
            </div>
        </div>
        <div class=" grid_4"> 
            <div class="grid_4 negrilla letraMediana">Fecha inicio Licencia (3 dias)</div><br>
            <div class="grid_3">
                <div class="calendario_image"></div>
                <input type="text" class="textChico" id="fechaLicencia" onchange="" name="fechaLicencia"> 
                <script>   $("#fechaLicencia").datepicker({ maxDate: '+1m', minDate:'-1m'});  </script>
            </div>

            <div class="clear"></div>
        </div>
    </div>
    <div class="grid_4" id="fecha_div">
        <div class="grid_4 esparriba negrilla letraMediana">Fecha a Justificar</div>
        <br>
        <div class="grid_3">
            <div class="calendario_image"></div>
            <input type="text" class="textChico" id="fechaJustificacion" onchange="obtiene_datos_fecha_especifica();" name="fechaJustificacion"> 
            <script>   $("#fechaJustificacion").datepicker({ beforeShowDay: $.datepicker.noWeekends, maxDate: '-1d'});  </script>
        </div>
        <div class="grid_3 prefix_05 suffix_05 letrachica esparriba" id="datos_fecha_especifica"></div>
        <div class="clear"></div>
    </div>

    <div class="grid_8 " id="rangoFechas_div">
        <div class="grid_8 negrilla letraMediana ">Ingresa las fechas de salida y retorno</div>
        <div class="ocultar" id="fechas_boqueadas"> </div>
        <div class="grid_4 esparriba centrartexto fondoplomoclaro" id="div_fecha_ini">
            <div class="calendario_image"></div>

            <input type="text" class="texfecha" id="fecha_inicio_p" name="fecha_inicio" readonly="true"
                   onchange="enableTime('horainicio','fecha_inicio_p');calcular_horas_de_justificacion();">-
            <select id="horainicioH" class="sel" disabled="disabled" onchange="enable_hora('horainicioH','horafinH');calcular_horas_de_justificacion();" >
                <?php
                for ($i = 0; $i < 24; $i++) {
                    $sel = "";
                    $cerp = "";
                    if ($i == 8)
                        $sel = "selected='selected'"; if ($i < 10)
                        $cerp = "0";
                    echo "<option value='$cerp$i' $sel>$cerp$i</option>";
                }
                ?>
            </select>:
            <select id="horainicioM" class="sel" disabled="true" onchange="calcular_horas_de_justificacion();" >
                <?php
                for ($i = 0; $i < 60; $i = $i + 15) {
                    $sel = "";
                    $cerp = "";
                    if ($i == 30)
                        $sel = "selected='selected'"; if ($i < 10)
                        $cerp = "0"; echo "<option value='$cerp$i' $sel>$cerp$i</option>";
                }
                ?>
            </select> 
            <script>
                // alert('se genera el calendario');
                obtener_fechas_de_bloqueo();
                
                $("#fecha_inicio_p").datepicker({
                    minDate: -2000,maxDate: "+3M +10D" ,yearRange: '-5:+0',
                    beforeShowDay: function(date){ 
                        //alert('ingresa a la funcion con' +fecha);
                        var vacaciones=$("#jusfec").val().split(',');
                        var viaticos=$("#viaticosfec").val().split(',');
                        var feriado=$("#feriadofec").val().split(',');              
    
                        estilo="";
                        titulo="";                                
                        var current = $.datepicker.formatDate('yy-mm-dd', date);
                        var fec = new Date(current);
                        //current=fec;
                        //alert(fec);
                        if(fec.getDay()==5 || fec.getDay()==6)
                        {
                            estilo="ui-state-disabled ui-datepicker-unselectable";
                            titulo="fin de Semana"
                        }
                            
                        if( $.inArray(current, vacaciones) != -1) {
                            estilo="ui-state-vacacion ui-datepicker-unselectable";
                            titulo=vacaciones[$.inArray(current, vacaciones)+1];
                        }
   
                        if($.inArray(current, feriado)!= -1) {
                            estilo="ui-state-hover ui-datepicker-unselectable";
                            titulo=feriado[$.inArray(current, feriado)+1];
                        }
                        if($.inArray(current, viaticos) != -1) {
                            estilo="ui-state-viatico ui-datepicker-unselectable";
                            titulo+=viaticos[$.inArray(current, viaticos)+1];
                        }
                        return([true, estilo,titulo]);
                    }});
            </script>
        </div>
        <div class="grid_4 esparriba centrartexto fondoplomoblanco" id="div_fecha_fin">
            <div class="calendario_image"></div>
            <input type="text" class="texfecha" id="fecha_fin_p" name="fecha_fin"
                   readonly="true" disabled="true" 
                   onchange="enableTime('horafin','fecha_fin_p');calcular_horas_de_justificacion();">-
            <select id="horafinH" class="sel" disabled="disabled" onchange="calcular_horas_de_justificacion();">
                <?php
                for ($i = 0; $i < 24; $i++) {
                    $sel = "";
                    $cerp = "";
                    if ($i == 8)
                        $sel = "selected='selected'"; if ($i < 10)
                        $cerp = "0"; echo "<option value='$cerp$i' $sel>$cerp$i</option>";
                }
                ?>
            </select>:
            <select id="horafinM" class="sel" disabled="true" onchange="calcular_horas_de_justificacion();" >
                <?php
                for ($i = 0; $i < 60; $i = $i + 15) {
                    $sel = "";
                    $cerp = "";
                    if ($i == 30)
                        $sel = "selected='selected'"; if ($i < 10)
                        $cerp = "0"; echo "<option value='$cerp$i' $sel>$cerp$i</option>";
                }
                ?>
            </select>
            <script>
                $("#fecha_fin_p").datepicker({yearRange: '-5:+0',beforeShowDay: function(date){ 
                        //alert('ingresa a la funcion con' +fecha);
                        var vacaciones=$("#jusfec").val().split(',');
                        var viaticos=$("#viaticosfec").val().split(',');
                        var feriado=$("#feriadofec").val().split(',');              
    
                        estilo="";
                        titulo="";                                
                        var current = $.datepicker.formatDate('yy-mm-dd', date);
                        var fec = new Date(current);
                        //current=fec;
                        //alert(fec);
                        if(fec.getDay()==5 || fec.getDay()==6)
                        {
                            estilo="ui-state-disabled ui-datepicker-unselectable";
                            titulo="fin de Semana"
                        }
                            
                        if( $.inArray(current, vacaciones) != -1) {
                            estilo="ui-state-vacacion ui-datepicker-unselectable";
                            titulo=vacaciones[$.inArray(current, vacaciones)+1];
                        }
   
                        if($.inArray(current, feriado)!= -1) {
                            estilo="ui-state-hover ui-datepicker-unselectable";
                            titulo=feriado[$.inArray(current, feriado)+1];
                        }
                        if($.inArray(current, viaticos) != -1) {
                            estilo="ui-state-viatico ui-datepicker-unselectable";
                            titulo+=viaticos[$.inArray(current, viaticos)+1];
                        }
                        return([true, estilo,titulo]);
                    }});</script>
        </div>
        <div class="grid_4 centrartexto fondoplomoclaro letrachica negrilla">Fecha de Inicio</div>
        <div class="grid_4 letrachica negrilla centrartexto fondoplomoblanco">Fecha de finalizacion </div>
    </div>
    <div class="grid_8" id="div_datosVacacion"> 
        <div class="grid_8 negrilla"> Dias Disponibles Vacacion: <span id="span_horas" class="rojo letraMediana milink"><?php echo number_format(($horasVacacion / 8), 2, ".", ",") . ' dias'; ?><span class="span_dias azulmarino oculto"><?php echo '(' . $horasVacacion . 'horas)'; ?></span></span></div>
        <div class="grid_8" id="mensaje_calculo_dias">
           
        </div>
    </div>
    <div class="grid_8 esparriba" id="respaldo_div">
        <div class="grid_8 negrilla letraMediana">Adjunte el respaldo de su justificacion</div>
        <?php // echo @$error;  ?><!--$ERROR MUESTRA LOS ERRORES QUE PUEDAN HABER AL SUBIR LA IMAGEN-->
        <div id="formulario_imagenes">
            <span><?php //echo validation_errors();                        ?></span>
<!--            <div class="grid_8"><input type="file" id="respaldo" name="userfile"></div>-->
<!--            <input type='file' name='archivoImage' id='archivoImage' />-->
<!--            <input type='button' id='botonSubidor' value="guardar" onclick='uploadAjax()' />-->
            <div id="respaldo_div">
                <input id="archivos" type="file" name="archivos" onchange="seleccionado();" />
<!--                <input type="text" id="texto">-->
            </div>
            <div id="cargados">
                <!-- Aqui van los archivos cargados -->
            </div>
        </div>
    </div>
    <div class="grid_8 esparriba" id="justificacion_div">
        <div class="grid_2 esparriba negrilla letraMediana">Titulo Justificacion : </div>
        <div class="grid_4 esparriba" id="div_tituloComent"><input type="text" class="text" style="width: 350px;" id="titulo_comentario" name="titulo_comentario"></div>
        <div class="grid_8 negrilla letraMediana">Comentario Justificacion : </div>
        <div class="grid_8" id="div_comentario"><textarea id="comentario_justificacion" class="textarea_grande" name="comentario_justificacion"></textarea></div>
        <div class="oculto"><input type="text" value="" id="tiempoDias">
        <input type="text" value="" id="tiempoHoras">
        <input type="text" value="" id="contenidoFechas">
        <input type="text" value="" id="llave"></div>
        
    </div>
<!--    <div class="grid_8 alinearDerecha oculto" id="boton_guardar"> <input type="submit" value="GUARDAR" id="subir_archivo" onclick="validar_justificacion();"></div>-->
    <?php //echo form_close();  ?>
</div>
<script>mostrarseguncambios();</script>