
<div class="grid_10 prefix_1 suffix_1"><h2> Formulario de Uso de vehiculo </h2></div>
<div class="grid_10 prefix_1 suffix_1"> Haga su solicitud llenando el siguiente formulario

</div>
<form class="sendemail">
    <ol>
        <li>
            <fieldset><legend class="espizq">Proyecto</legend>
                <div class="prefix_1 alpha grid_5"> Seleccione el Proyecto:
                    <?php
                    echo form_dropdown('proyecto', $proyectos,null,"id='proyecto'");
                    ?>    
                </div>
                <div class="grid_5 omega"> regional : <select name="regional" class="textMedio" id="regional">
                            <option value="0">seleccione su Regional</option>    
                            <?php
                            foreach ($deptos as $dep) {
                                ?><option value="<?php echo $dep->id; ?>"><?php echo $dep->nombre; ?></option><?php
                        }
                            ?>
                        </select></div>
            </fieldset>
            <!--<input name="proyecto" class="text" id="usuario" value="" size="30" title="Ingrese su Nombre de Usuario" maxlength="2048" />-->
        </li>
        <li>
            <fieldset>
                <legend>Fechas de uso del vehiculo</legend>
                <div class="grid_2 prefix_2">Fecha de salida</div>
                <div class="grid_2">
                    <input type="hidden" value="<?php echo date('Y/m/d')?>" id="fechaElaborado" name="fechaElaborado">
                    <input id="fechaSalida" name="fechaSalida" type="text" maxlength="10" class="textChico" value=""/>
                    <script>  $(function() { $( "#fechaSalida" ).datepicker({}); }); </script>

                </div>
                <div class="grid_2">Hora de Salida</div>
                <div class="grid_2 suffix_1">00:00:00</div>
                <div class="clear"></div>
                <div class="grid_2 prefix_2 esparriba">Fecha de Retorno</div>
                <div class="grid_2 esparriba">
                <input name="fechaRetorno" type="text" class="textChico" title="fecha de retorno" id="fechaRetorno" value="" size="10" value="<?php echo date('d/m/y')?>"/>
                </div>
                <script>  $(function() { $( "#fechaRetorno" ).datepicker({}); }); </script>
                <div class="grid_2 esparriba">Hora de Retorno</div>
                <div class="grid_2 suffix_1 esparriba">00:00:00</div>
            </fieldset>
        </li>

        <li><fieldset>
                <legend>tipo de trabajo a realizar</legend>

                <div class="prefix_2 grid_1">(Preventivo) </div>
                <div class="grid_1"><input type="radio" name="tipo_trabajo" value="Preventivo" size="70"/> </div>
                <div class="prefix_1 grid_1">(Correctivo) </div>
                <div class="grid_1"><input type="radio" name="tipo_trabajo" value="Correctivo" size="70"/> </div>
                <div class="prefix_1 grid_1">(Instalacion)</div> 
                <div class="grid_1"><input type="radio" name="tipo_trabajo" value="Instalacion" size="70"/> </div>
                <div class="clear"></div>

                <div class="prefix_2 grid_1 esparriba">   (extra works) </div>
                <div class="grid_1 esparriba"><input type="radio" name="tipo_trabajo" value="ExtraWorks" size="70"/> </div>
                <div class="prefix_1 grid_1 esparriba">(Comision) </div>
                <div class="grid_1 esparriba"><input type="radio" name="tipo_trabajo" value="Comision" size="70"/> </div>
                <div class="prefix_1 grid_1 esparriba">(supervision) </div>
                <div class="grid_1 esparriba"><input type="radio" name="tipo_trabajo" value="Supervision" size="70"/> </div>
                <div class="clear"></div>
            </fieldset>
        </li>
        <li><fieldset id="lugtra">
                <legend>Lugar de trabajo :</legend>
                <div class="prefix_2 grid_1">(Area Rural)</div>
                <div class="grid_1"><input type="radio" name="lugar_trabajo" value="1" size="70" onclick="javascript:ruralurbano();" checked="checked"/></div>
                <div class="prefix_2 grid_2">(Area Urbana)</div>
                <div class="grid_1 suffix_2"><input type="radio" name="lugar_trabajo" value="2" size="70" onclick="javascript:ruralurbano();"/>
                <input type="hidden" id="llave_lugartrabajo" value="0"></div>
                <div class="clear"></div>
                <div class="grid_5 push_6 alpha omega">
                    <div class="grid_4 suffix_1 alpha omega" id="destinosAlmacenados"> .</div>
                </div>
                <div class="grid_6 pull_5 alpha omega">
                    <div class="grid_2 esparriba">Departamento:</div>
                    <div class="grid_3 suffix_1 omega esparriba">
                        <select name="departamento" class="textMedio" id="departamento" onchange="javascript:devolverProvincias();">
                            <option value="0">seleccione un departamento</option>    
                            <?php
                            foreach ($deptos as $dep) {
                                ?><option value="<?php echo $dep->id; ?>"><?php echo $dep->nombre; ?></option><?php
                        }
                            ?>
                        </select></div>
                    <div class="grid_5 suffix_1 alpha esparriba rural">Provincia:<?php echo form_dropdown('provincia', array(), NULL, "id='provincia'"); ?></div>
                    <div class="grid_2 alpha esparriba rural" >Especifique el sitio : </div>
                    <div class="grid_4 omega esparriba rural" ><input name="especifico" id="sitioEsp" type="text" class="textMedio" title="Sitio Especifico" ></div>
                    <div class="grid_2 alpha esparriba">Actividad que se realizara en el Sitio</div>
                    <div class="grid_4 omega esparriba"><textarea class="textarea" id="actividadSitio"></textarea></div>
                    <div class="grid_3 alpha centrartexto esparriba"><input type="button" value="Adicionar Sitio" name="AddSit" onclick="javascript:registrarLugares('<?php echo base_url(); ?>');" /></div>
                </div>

            </fieldset>
        </li>
        <li><fieldset>
                <legend>Informacion de Personal</legend>
                <div class="grid_5 push_6 alpha omega">
                    <div class="prefix_1 alpha grid_2">cantidad de pasajeros :</div>
                    <div class="grid_1 omega"><select name="nropasajeros" id="nropasajeros" class="textMuyChico" onchange="javascript:nroPasajero()">
                            <option value="0" selected >0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select></div>
                    <div class=" prefix_1 grid_4 alpha omega">Nombres de los pasajeros:</div>
                    <div class="prefix_1 grid_4 alpha omega">
                        <input type="text" id="pasajero1" class="oculto textMedio esparriba" placeholder="1.-nombre del pasajero">
                        <input type="text" id="pasajero2" class="oculto textMedio esparriba" placeholder="2.-nombre del pasajero">
                        <input type="text" id="pasajero3" class="oculto textMedio esparriba" placeholder="3.-nombre del pasajero">
                        <input type="text" id="pasajero4" class="oculto textMedio esparriba" placeholder="4.-nombre del pasajero">
                    </div>

                </div>
                <div class="grid_6 pull_5 alpha">
                    <fieldset><legend> Datos del Conductor:</legend>
                        <div class="clear"></div>
                        <div class="grid_2 ">Nombre Completo:</div>
                        <div class="grid_3 "><input name="NombreConductor" type="text" class="textMedio" title="Nombre del conductor" id="NombreConductor" >
                            <input id="urlbase" type="hidden" value="<?php echo base_url(); ?>">
                        </div>
                        <div class="grid_2 esparriba">Nro de Licencia :</div>
                        <div class="grid_2 esparriba suffix_1"><input name="NoLicencia" type="text" class="textChico" title="Nro de Licencia" id="NoLicencia" ></div>
                        <div class="grid_2 esparriba">Cat :</div>
                        <div class="grid_3 esparriba">
                            <select name="categoria" class="textChico" id="categoriaConductor">
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="P">P</option>
                            </select>
                        </div>
                        <div class="clear esparriba"></div>
                        <div class="grid_2 esparriba"> Nro de Celular :</div>
                        <div class="grid_3 esparriba"><input name="TelefonoCelular" type="text" class="textChico" title="Telefono Celular" id="celular" ></div>
                    </fieldset>
                </div>

            </fieldset></li>

        <li>
            <input type="button" value="Registrar Solicitud" class="enviar" onclick="javascript : validar_modal();"/>
            <div class="clr" class=""></div>
        </li>
    </ol> 

</form>