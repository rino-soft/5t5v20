
<div class="grid_8">
    <input type="hidden" value="<?php echo base_url(); ?>" id="burl">


   
    <?php // echo form_open_multipart(base_url() . "justificacion_marcado/do_upload"); ?>
    <div class="grid_8">
        <div class="grid_7 suffix_05 espaciadochico espizquierda bordeado1 fondoplomoblanco">
            <div class="grid_3"><div class="grid_3 letramuyChica">Proyecto : </div>
                <div class="grid_3">
                    <?php echo form_dropdown('proyecto', $proyectos_usuario, 0, "id='proyecto' , onchange='javascript:obtener_jefes_proyectos();muestra_arbol_dependientes_de_proyecto_seleccionado();'");
                    ?>
                </div>
            </div>
            <div class="grid_4">
                <div class="grid_4 letramuyChica">tipo de trabajo en la hora extra: </div>
                <div class="grid_4">
                    <select id="tipo_trabajo" onchange="mostrarseguncambios();" name="tipo_trabajo">
                        <option value="0">Seleccione una opcion...</option>
                        <!--<option value="justificacion">Justificacion de marcado</option>-->
                        <option value="Preventivo">Preventivo</option>
                        <option value="Correctivo">Correctivo</option>
                        <option value="ExtraWorks">ExtraWorks</option>
                        <option value="Emergencia">Emergencia</option>
                        <option value="Instalacion">Instalacion</option>
                    </select>
                </div> 
            </div>
        </div>


        <!-- lugar de trabajo -->
        <div class="clear espaciadochico"></div>

  <div class="grid_8 letramuyChica negrilla azulmarino">Datos Lugar de desarrollo de la hora extra</div>
        <div class="grid_7 suffix_05 fondoplomoblanco bordeado1 espaciadochico espizquierda">
            <div class="grid_4 letramuyChica">Departamento:</div><div class="grid_2 letramuyChica">Area:</div>
            <div class="grid_4 ">
                <select name="departamento" class="textMedio letrachica" id="departamento" onchange="javascript:devolverProvinciasOption();">
                    <option value="0">seleccione un departamento</option>    
                    <?php
                    foreach ($deptos as $dep) {
                        ?><option value="<?php echo $dep->id; ?>"><?php echo $dep->nombre; ?></option><?php
                }
                    ?>
                </select></div>
            <div class="grid_2">Rural <input type="radio" name="area_lugar" value="1" size="70" onclick="javascript:ruralurbano();" />
                Urbano <input type="radio" name="area_lugar" value="2" size="70" onclick="javascript:ruralurbano(); " checked="checked"/></div>
            <div class="grid_6 rural oculto" id="provincia_Load">
            <div class="grid_6 letramuyChica " >Provincia:</div><div class="grid_6 ">Para cargar seleccione un Departamento<?php //echo form_dropdown('provincia', array(), NULL, "id='provincia'"); ?></div>
            </div>
            <div class="grid_6 letramuyChica  " >Especifique el sitio o estacion: </div>
            <div class="grid_6   " ><input name="especifico" id="sitioEsp" type="text" class="text_grande" title="Sitio Especifico" ></div>

        </div>


        <!-- fin de lugar de trabajo---inicio de fechas y horas de inicio ----------------- -->
        <div class="clear espaciadochico"></div>
        <?php
        $option_hora = "";
        $option_min = "";
        for ($i = 0; $i < 24; $i++) {
            $sel = "";
            $cerp = "";

            if ($i == 19)
                $sel = "selected='selected'";
            if ($i < 10)
                $cerp = "0";
            $option_hora.= "<option value='$cerp$i' $sel>$cerp$i</option>";
        }
        for ($i = 0; $i < 60; $i = $i + 15) {
            $sel = "";
            $cerp = "";
            if ($i == 30)
                $sel = "selected='selected'";
            if ($i < 10)
                $cerp = "0";
            $option_min.="<option value='$cerp$i' $sel>$cerp$i</option>";
        }
        ?>
        <div class="grid_8 letramuyChica azulmarino negrilla " >Datos de fechas y horas</div>
        <div class="grid_7 suffix_05 fondoplomoblanco bordeado1 espaciadochico espizquierda" id="divfechas">
            <div class="suffix_05 grid_3 centrartexto ">
                <div class="grid_3 letramuyChica"> fecha y hora de NOTIFICACION</div>
                <div class="calendario_image"></div>
                <input type="text" class="texfecha" id="notificacion" name="notificacion" readonly="true"
                       onchange="cambiarfecha('notificacion','f')">
                <script>   $("#notificacion").datepicker({ maxDate: '+0d', minDate:'-2d'});  </script>
                <select id="notificacionH" class="sel "  onchange="" ><?php echo $option_hora; ?></select>:
                <select id = "notificacionM" class = "sel" onchange = "" ><?php echo $option_min; ?> </select> 
            </div>

            <div class=" suffix_05 grid_3  centrartexto " id="div_fecha_ini">
                <div class="grid_3 letramuyChica">Inicio de viaje al sitio</div>
                <div class="calendario_image"></div>
                <input type="text" class="texfecha f" id="viaje" name="viaje" readonly="true"
                       onchange="cambiarfecha('viaje','f1')">
                <script>   $("#viaje").datepicker({ maxDate: '+0d', minDate:'-2d'});  </script>
                <select id="viajeH" class="sel"  onchange="" ><?php echo $option_hora; ?></select>:
                <select id = "viajeM" class = "sel" onchange = "" ><?php echo $option_min; ?> </select> 
            </div>


            <div class="grid_3 suffix_05 centrartexto " id="div_fecha_ini">
                <div class="grid_3 letramuyChica">INGRESO al Sitio</div>
                <div class="calendario_image"></div>
                <input type="text" class="texfecha f f1" id="sitio" name="sitio" readonly="true"
                       onchange="cambiarfecha('sitio','f2')">
                <script>   $("#sitio").datepicker({ maxDate: '+0d', minDate:'-2d'});  </script>
                <select id="sitioH" class="sel"  onchange="" ><?php echo $option_hora; ?></select>:
                <select id = "sitioM" class = "sel" onchange = "" ><?php echo $option_min; ?> </select> 
            </div>

            <div class="grid_3 suffix_05  centrartexto " id="div_fecha_ini">
                <div class="grid_3 letramuyChica">Conclusion del trabajo</div>
                <div class="calendario_image"></div>
                <input type="text" class="texfecha f f1 f2 " id="conclusion" name="con clusion" readonly="true"
                       onchange="">
                <script>   $("#conclusion").datepicker({ maxDate: '+0d', minDate:'-2d'});  </script>
                <select id="conclusionH" class="sel"  onchange="" ><?php echo $option_hora; ?></select>:
                <select id = "conclusionM" class = "sel" onchange = "" ><?php echo $option_min; ?> </select> 
            </div>
        </div>
        
        <div class="grid_8">
            <div class="grid_8 letramuyChica">Descripcion de la Falla</div>
            <textarea id="falla" class="textarea_medio" name="comentario_justificacion"></textarea>
        </div>
        <div class="grid_8">
            <div class="grid_8 letramuyChica ">Descripcion de la Intervencion</div>
            <textarea id="intervencion" class="textarea_medio" name="comentario_justificacion"></textarea>
        </div>
        <div class="grid_8">
            <div class="grid_8 letramuyChica">Observaciones</div>
            <textarea id="observaciones" class="textarea_medio" name="comentario_justificacion"></textarea>
        </div>





    </div>
    <div class="clear esparriba"></div>
     <div class="grid_7 suffix_05 espizquierda NO letramuyChica oculto" id="error_de_formulario"></div>
    <div class="grid_7 suffix_05 espizquierda OK centrartexto oculto" id="div_confirmacion"> He revisado toda la informacion antes de guardar <input id="confirmacion" type="checkbox"> </div>

</div>