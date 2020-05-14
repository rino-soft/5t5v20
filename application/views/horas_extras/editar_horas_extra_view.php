
<div class="grid_8">
    <input type="hidden" value="<?php echo base_url(); ?>" id="burl">




    <div class="grid_8">
        <div class="grid_7">
            <div class="grid_4">
                <?php
                $d = $datos_formulario->row();

                $dept = $depsel;

                $prov = $provsel;

// echo form_open_multipart(base_url() . "justificacion_marcado/do_upload"); 
                ?>
                <span class="negrilla">Solicitante :</span> <?php echo $d->nombrecompleto; ?>
                <br>
                <span class="negrilla">Proyecto :</span> <?php echo $d->proyecto; ?>

            </div>
            <div class="grid_3 fondo_amarillo_claro">
                <div class="grid_3 negrilla letraGrande centrartexto negrocolor">Nro: <?php echo $d->id_he; ?></div>
                <div class="grid_3 letramuyChica centrartexto">Id registro Hora Extra</div>
            </div>
        </div>

    </div>
    <div class="grid_7 suffix_05 espaciadochico espizquierda bordeado1 fondoplomoblanco">

        <div class="grid_7">
            <div class="grid_7 letramuyChica">tipo de trabajo en la hora extra:<span class="negrilla letraMediana verdecolor"><?php echo $d->tipo_trabajo; ?></span> </div>
            <div class="grid_7">
                <select id="tipo_trabajo" onchange="mostrarseguncambios();" name="tipo_trabajo">
                    <option value="0">Seleccione una opcion...</option>
                    <!--<option value="justificacion">Justificacion de marcado</option>-->
                    <option value="Preventivo" <?php if ($d->tipo_trabajo == "Preventivo") echo "selected='selected'"; ?>    >Preventivo</option>
                    <option value="Correctivo" <?php if ($d->tipo_trabajo == "Correctivo") echo "selected='selected'"; ?> >Correctivo</option>
                    <option value="ExtraWorks" <?php if ($d->tipo_trabajo == "ExtraWorks") echo "selected='selected'"; ?> >ExtraWorks</option>
                    <option value="Emergencia" <?php if ($d->tipo_trabajo == "Emergencia") echo "selected='selected'"; ?> >Emergencia</option>
                    <option value="Instalacion"<?php if ($d->tipo_trabajo == "Instalacion") echo "selected='selected'"; ?>  >Instalacion</option>
                </select>

            </div> 
        </div>
    </div>


    <!-- lugar de trabajo -->
    <div class="clear espaciadochico"></div>

    <div class="grid_8 letramuyChica negrilla azulmarino">Datos Lugar de desarrollo de la hora extra</div>
    <div class="grid_7 suffix_05 fondoplomoblanco bordeado1 espaciadochico espizquierda">
        <div class="grid_4 letramuyChica">
            Departamento:<span class="negrilla letraMediana verdecolor"><?php echo $dept->depto; ?></span></div>
        <div class="grid_2 letramuyChica">Area:<span class="negrilla letraMediana verdecolor"><?php if ($d->area == 1) echo "rural"; else echo "Urbano"; ?></span></div>
        <div class="grid_4 ">
            <select name="departamento" class="textMedio letrachica" id="departamento" onchange="javascript:devolverProvinciasOption();">
                <option value="0">seleccione un departamento</option>    
                <?php
                foreach ($deptos as $dep) {
                    ?><option value="<?php echo $dep->id; ?>" <?php if ($dept->depto == $dep->nombre) echo " selected='selected' "; ?>><?php echo $dep->nombre; ?></option><?php
            }
                ?>
            </select></div>
        <div class="grid_2">
            Rural <input type="radio" name="area_lugar" value="1" size="70" onclick="javascript:ruralurbano();" <?php if ($d->area == 1) echo 'checked="checked"'; ?> />
            Urbano <input type="radio" name="area_lugar" value="2" size="70" onclick="javascript:ruralurbano(); " <?php if ($d->area == 2) echo 'checked="checked"'; ?> /></div>
        <?php if ($d->area == 2) { ?>
            <div class="grid_6 rural oculto" id="provincia_Load">
                <div class="grid_6 letramuyChica " >Provincia:</div><div class="grid_6 ">Para cargar seleccione un Departamento<?php //echo form_dropdown('provincia', array(), NULL, "id='provincia'");   ?></div>
            </div>
        <?php } else { ?>
            <div class="grid_6 rural" id="provincia_Load">
                <div class="grid_6 letramuyChica " >Provincia:<span class="negrilla letraMediana verdecolor"><?php echo $prov->provincia; ?></span></div>
                <div class="grid_6 ">
                    <select name="provincia" class="textMedio letrachica" id="provincia">
                        <option value="0">seleccione una provincia...</option>    
                        <?php
                        foreach ($provincias as $p) {
                            ?><option value="<?php echo $p->id_lugar; ?>" 
                                    <?php if ($p->id_lugar == $d->provincia) echo " selected='selected' "; ?>>
                                        <?php echo $p->provincia; ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>


                </div>
            </div>

        <?php } ?>
        <div class="grid_6 letramuyChica  " >Especifique el sitio o estacion: <span class="negrilla letraMediana verdecolor"><?php echo $d->sitio; ?></span></div>
        <div class="grid_6   " ><input name="especifico" id="sitioEsp" type="text" class="text_grande" title="Sitio Especifico" value="<?php echo $d->sitio; ?>" ></div>

    </div>


    <!-- fin de lugar de trabajo---inicio de fechas y horas de inicio ----------------- -->
    <div class="clear espaciadochico"></div>
    <?php

    
    //$not=$this->option_hora($d->fhnotificacion);
  //  $via=$this->option_hora($d->fhviaje);
    //$sit=$this->option_hora($d->fhatencion);
    //$con=$this->option_hora($d->fhconclusion);
    ?>
    <div class="grid_8 letramuyChica azulmarino negrilla " >Datos de fechas y horas</div>
    <div class="grid_7 suffix_05 fondoplomoblanco bordeado1 espaciadochico espizquierda" id="divfechas">
        <div class="suffix_05 grid_3 centrartexto ">
            <div class="grid_3 letramuyChica">  NOTIFICACION  <span class="negrilla verdecolor"><?php echo $d->fhnotificacion; ?></span></div>
            <div class="calendario_image"></div>
            <input type="text" class="texfecha" id="notificacion" name="notificacion" readonly="true" value="<?php echo date_format(new DateTime($d->fhnotificacion), 'Y/m/d'); //H:i:s  ?>"  
                   onchange="cambiarfecha('notificacion','f')">
            <script>   $("#notificacion").datepicker({ maxDate: '+30d', minDate:'-30d'});  </script>
            <select id="notificacionH" class="sel "  onchange="" ><?php echo $not['hora']; ?></select>:
            <select id = "notificacionM" class = "sel" onchange = "" ><?php echo $not['minuto']; ?> </select> 
        </div>

        <div class=" suffix_05 grid_3  centrartexto " id="div_fecha_ini">
            <div class="grid_3 letramuyChica">VIAJE al sitio <span class="negrilla verdecolor"><?php echo $d->fhviaje; ?></span></div>
            <div class="calendario_image"></div>
            <input type="text" class="texfecha f" id="viaje" name="viaje" readonly="true" value="<?php echo date_format(new DateTime($d->fhviaje), 'Y/m/d'); //H:i:s  ?>" 
                   onchange="cambiarfecha('viaje','f1')">
            <script>   $("#viaje").datepicker({ maxDate: '+30d', minDate:'-30d'});  </script>
            <select id="viajeH" class="sel"  onchange="" ><?php echo $via['hora']; ?></select>:
            <select id = "viajeM" class = "sel" onchange = "" ><?php echo $via['minuto']; ?> </select> 
        </div>


        <div class="grid_3 suffix_05 centrartexto " id="div_fecha_ini">
            <div class="grid_3 letramuyChica">INGRESO al Sitio <span class="negrilla verdecolor"><?php echo $d->fhatencion; ?></span></div>
            <div class="calendario_image"></div>
            <input type="text" class="texfecha f f1" id="sitio" name="sitio" readonly="true" value="<?php echo date_format(new DateTime($d->fhatencion), 'Y/m/d'); //H:i:s  ?>" 
                   onchange="cambiarfecha('sitio','f2')">
            <script>   $("#sitio").datepicker({ maxDate: '+30d', minDate:'-30d'});  </script>
            <select id="sitioH" class="sel"  onchange="" ><?php echo $sit['hora']; ?></select>:
            <select id = "sitioM" class = "sel" onchange = "" ><?php echo $sit['minuto']; ?> </select> 
        </div>

        <div class="grid_3 suffix_05  centrartexto " id="div_fecha_ini">
            <div class="grid_3 letramuyChica">CONCLUSION del trabajo <span class="negrilla verdecolor"><?php echo $d->fhconclusion; ?></span></div>
            <div class="calendario_image"></div>
            <input type="text" class="texfecha f f1 f2 " id="conclusion" name="con clusion" readonly="true" value="<?php echo date_format(new DateTime($d->fhconclusion), 'Y/m/d'); //H:i:s  ?>" 
                   onchange="">
            <script>   $("#conclusion").datepicker({ maxDate: '+30d', minDate:'-30d'});  </script>
            <select id="conclusionH" class="sel"  onchange="" ><?php echo $fin['hora']; ?></select>:
            <select id = "conclusionM" class = "sel" onchange = "" ><?php echo $fin['minuto']; ?> </select> 
        </div>
    </div>

    <div class="grid_8">
        <div class="grid_8 letramuyChica">Descripcion de la Falla</div>
        <textarea id="falla" class="textarea_medio" name="comentario_justificacion"><?php echo $d->falla; ?></textarea>
    </div>
    <div class="grid_8">
        <div class="grid_8 letramuyChica ">Descripcion de la Intervencion</div>
        <textarea id="intervencion" class="textarea_medio" name="comentario_justificacion"><?php echo $d->intervencion; ?></textarea>
    </div>
    <div class="grid_8">
        <div class="grid_8 letramuyChica">Observaciones</div>
        <textarea id="observaciones" class="textarea_medio" name="comentario_justificacion"><?php echo $d->observaciones; ?></textarea>
    </div>





</div>
<div class="clear esparriba"></div>
<div class="grid_7 suffix_05 espizquierda NO letramuyChica oculto" id="error_de_formulario"></div>
<div class="grid_7 suffix_05 espizquierda OK centrartexto oculto" id="div_confirmacion"> He revisado toda la informacion antes de guardar <input id="confirmacion" type="checkbox"> </div>

</div>