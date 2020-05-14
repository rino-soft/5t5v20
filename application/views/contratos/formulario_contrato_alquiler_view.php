<?php
$depto = "";
$prov = "";
$lat = "";
$log = "";
$dir_obj = "";
$comen_obj = "";
$prop = "";
$ci_pro = "";
$tel = "";
$cel = "";
$dir_prop = "";
$f_ini = "";
$dur = 0;
$f_fin = "";
$gar = 0.00;
$mensual = 0.00;
$previsto = 0.00;
$estado = "Activo";
$agua = "";
$luz = "";
$telfo = "";
$inter = "";
$pago_a = "";
$estado = "Activo";

if ($dato_form->num_rows() > 0) {
    $dat = $dato_form->row();
    $depto = $dat->departamento;
    $prov = $dat->Provincia;
    $lat = $dat->latitud;
    $log = $dat->longitud;
    $dir_obj = $dat->direccion_objeto;
    $comen_obj = $dat->descripcion_obj;
    $prop = $dat->nombre_c_prop;
    $ci_pro = $dat->ci_prop;
    $tel = $dat->telefono;
    $cel = $dat->celular;
    $dir_prop = $dat->direccion_prop;
    $f_ini = $dat->fec_inicio;
    $dur = $dat->duracion;
    $f_fin = $dat->fec_final;
    $gar = $dat->monto_garantia;
    $mensual = $dat->pago_mensual;
    $previsto = $dat->monto_previsto;
    $estado = $dat->estado_contrato;
    
    if($dat->agua=='si')
       $agua='checked="checked"';   
    if($dat->luz=='si')
       $luz='checked="checked"';   
    if($dat->tel=='si')
       $telfo='checked="checked"';   
    if($dat->inter=='si')
       $inter='checked="checked"';   
        
    $pago_a = $dat->chequeinfo;
    //$obs=$dat->instancia;
}
?>







<div class="grid_20">

    <div class="grid_20">
        <div class="grid_5 prefix_15">
            <div class="grid_3 alin_cen " style="margin-top: 10px;">
                <select class="" id="estado_contrato">
                    <option <?php if ($estado == "Activo") echo " selected='selected' "; ?> value="Activo" >Activo</option>
                    <option <?php if ($estado == "Inactivo") echo " selected='selected' "; ?> value="Inactivo" >Inactivo</option>
                </select>
            </div>
            <div class="grid_2 alin_cen " >
                <div class="grid_2 f18 fondo_amarillo_claro negrilla colorGuindo">
                    <input type="hidden" value="<?php echo $id_contrato; ?>" id="id_contrato"><?php echo $id_contrato; ?></div>
                <div class="grid_2 f10 negrilla">ID de contrato</div>
            </div>
        </div>
    </div>
    <div id="respuesta" class="grid_20"></div>

    <div class="grid_20 fondo_plomo_claro_areas_p">
        <div class="grid_20  negrilla f10 colorGuindo">Informacion del inmueble</div>
        <div class="grid_20">
            <div class="grid_5">
                <div class="grid_5">
                    <input id="departamento" value="<?php echo $depto; ?>" type="Text"  placeholder="Departamento" class="input_redond_250" style=" margin-top: 5"> 
                    <script>
                        $('#departamento').autocomplete({source: ['La Paz', 'Cochabamba', 'Santa Cruz', 'Pando', 'Beni', 'Oruro', 'Potosí', 'Chuquisaca', 'Tarija']})
                    </script>
                </div>
                <div class="grid_5 f11 negrilla" >Departamento</div>
            </div>
            <div class="grid_5 prefix_1">
                <div class="grid_5">
                    <input id="provincia" value="<?php echo $prov; ?>" type="Text"  placeholder="Provincia" class="input_redond_250" style="margin-top: 5"> 
                </div>
                <div class="grid_5 f11 negrilla" >Provincia</div>
            </div>
            <div class="grid_4 prefix_1">
                <div class="grid_4">
                    <input id="Latitud" value="<?php echo $lat; ?>" type="Text"  placeholder="Latitud" class="input_redond_150" style="margin-top: 5"> 
                </div>
                <div class="grid_4 f11 negrilla" >Latitud</div>
            </div>
            <div class="grid_4 ">
                <div class="grid_4">
                    <input id="Longitud" value="<?php echo $log; ?>" type="Text"  placeholder="Longitud" class="input_redond_150" style="margin-top: 5"> 
                </div>
                <div class="grid_4 f11 negrilla" >Longitud</div>
            </div>

        </div>
        <div class="grid_20">
            <div class="grid_10">
                <div class="grid_10">
                    <textarea id="direccion" class="textarea_redond_221x37" style="width: 480px;height: 49px;" placeholder="Descripcion del inmueble"><?php echo $dir_obj; ?></textarea>
                </div>
                <div class="grid_10 f11 negrilla" >Direccion del Inmueble</div>
            </div>

            <div class="grid_10">
                <div class="grid_10">
                    <textarea id="descripcion" class="textarea_redond_221x37" style="width: 480px;height: 49px;" placeholder="Descripcion del inmueble"><?php echo $comen_obj; ?></textarea>
                </div>
                <div class="grid_10 f11 negrilla" >Descripcion del inmueble</div>
            </div>
        </div>
    </div>




    <div class="grid_10 esparriba10"></div>

    <div class="grid_20 fondo_plomo_claro_areas_p" style="background: #dae4fd">
        <div class="grid_20  negrilla f10 colorGuindo">Informacion del PROPIETARIO</div>
        <div class="grid_20">
            <div class="grid_7">
                <div class="grid_7">
                    <input id="Nombre_completo" value="<?php echo $prop; ?>" type="Text"  placeholder="Nombre Completo" class="input_redond_250" style=" margin-top: 5; width: 350px"> 
                </div>
                <div class="grid_7 f11 negrilla" >Nombre Completo del propietario</div>
            </div>
            <div class="grid_3 prefix_1">
                <div class="grid_3">
                    <input id="ci_propietario" value="<?php echo $ci_pro; ?>" type="Text"  placeholder="Cedula de identidad" class="input_redond_150" style="margin-top: 5"> 
                </div>
                <div class="grid_3 f11 negrilla" >CI</div>
            </div>


            <div class="grid_4 prefix_1">
                <div class="grid_4">
                    <input id="Telefono" value="<?php echo $tel; ?>" type="Text"  placeholder="Telefono" class="input_redond_150" style="margin-top: 5"> 
                </div>
                <div class="grid_4 f11 negrilla" >Telefono</div>
            </div>
            <div class="grid_4 ">
                <div class="grid_4">
                    <input id="Celular" value="<?php echo $cel; ?>" type="Text"  placeholder="Celular" class="input_redond_150" style="margin-top: 5"> 
                </div>
                <div class="grid_4 f11 negrilla" >Celular</div>
            </div>

        </div>


        <div class="grid_20">
            <div class="grid_20">
                <div class="grid_20">
                    <input id="direccionProp" value="<?php echo $dir_prop; ?>" type="Text"  placeholder="Direccion del Propietario" class="input_redond_150" style="margin-top: 5; width: 950px"> 
                </div>
                <div class="grid_10 f11 negrilla" >Direccion del Propietario</div>
            </div>
        </div>
    </div>
    <div class="grid_10 esparriba10"></div>

    <div class="grid_20 fondo_plomo_claro_areas_p" style="background: #fdfdda">
        <div class="grid_20  negrilla f10 colorGuindo">Informacion del CONTRATO</div>
        <div class="grid_20">
            <div class="grid_6">
                <div class="grid_2 ">
                    <input id="fecini" value="<?php echo $f_ini; ?>" type="Text"  placeholder="Fecha de inicio" class="input_redond_100 centrartexto" style=" margin-top: 5; "
                           onchange="calcula_fecha('fecini', 'fecfin', 'duracion');"> 
                    <script>$("#fecini").datepicker();</script>
                </div>


                <div class="grid_1" style="margin: 0 25px 0 25px;">
                    <input id="duracion" value="<?php echo $dur; ?>" type="Text"  placeholder="meses" class="input_redond_50 centrartexto" style=" margin-top: 5;"
                           onchange="calcula_fecha('fecini', 'fecfin', 'duracion'); calcular_monto_previsto_contrato();" > 
                </div>
                <div class="grid_2 ">
                    <input id="fecfin" value="<?php echo $f_fin; ?>" type="Text"  placeholder="Fecha de fin"
                           class="input_redond_100 centrartexto" style=" margin-top: 5;" readonly="readonly"> 
                </div>
                <div class="grid_7 f11 negrilla" >
                    <div class="grid_2 centrartexto">Inicio</div>
                    <div class="grid_1 centrartexto" style="margin: 0 25px 0 25px;">meses</div>
                    <div class="grid_2 centrartexto">Final</div>
                    <div class="grid_7 f11 negrilla centrartexto" >
                        Duracion de Contrato
                    </div>
                </div>
            </div>
            <div class="grid_3 prefix_1">
                <div class="grid_3">
                    <input id="garantia" value="<?php echo $gar; ?>" type="Text"  placeholder="Monto de garantia" class="input_redond_150" style="margin-top: 5"> 
                </div>
                <div class="grid_3 f11 negrilla" >Monto de garantia</div>
            </div>


            <div class="grid_4 prefix_1">
                <div class="grid_4">
                    <input id="pago_mes" onchange="calculo_prorrateo_contrato();calcular_monto_previsto_contrato();" value="<?php echo $mensual; ?>" type="Text"  placeholder="Pago por Mes" class="input_redond_150" style="margin-top: 5"> 
                </div>
                <div class="grid_4 f11 negrilla" >Pago por mes</div>
            </div>
            <div class="grid_4 ">
                <div class="grid_4">
                    <input id="total_previsto" value="<?php echo $previsto; ?>" type="Text"  placeholder="Monto Total" class="input_redond_150" style="margin-top: 5"> 
                </div>
                <div class="grid_4 f11 negrilla" >Monto Total previsto</div>
            </div>

        </div>
        <div class="grid_18 prefix_1 suffix_1">
            <div class="grid_18 ">
                <div class="grid_9 fondo_amarillo_claro espabajo10 esparriba10" style="padding-top: 17px;padding-bottom: 16px">
                    <div class="grid_9">
                        <span class="negrilla"> El alquiler Incluye:</span> 
                        Agua<input type="checkbox" value="" id="agua" <?php echo $agua; ?>>    
                        Energia<input type="checkbox" value="" id="luz" <?php echo $luz; ?> >    
                        Internet<input type="checkbox" value="" id="inter" <?php echo $inter; ?>>    
                        Telefono<input type="checkbox" value="" id="telfo" <?php echo $telfo; ?>>    
                    </div>

                </div>

                <div class="grid_9 fondo_naranja_rend espabajo10 ">
                    <div class="grid_9">
                        cheque dirigido a: <input type="text" id="pagoa" class="input_redond_100" value="<?php echo $pago_a; ?>" style="width: 300px" placeholder="ej.Banco Union S.A. Cta No:123456">
                    </div>

                </div>

            </div>
        </div>


        <div class="grid_18 prefix_1 suffix_1 esparriba10 espabajo10">
            <div class="grid_16 prefix_1 suffix_1 bordeado">
                <div class="grid_16 ">

                    <div class="grid_5 colorGuindo negrilla espabajo10 esparriba10">
                        Proyectos Asociados al Contrato   
                    </div>
                    <?php
                    $codigo_proyectos = "";
                    $cantidad = 0;
                    $ids = "";
                    foreach ($dato_relacion_proyecto_contrato->result() as $proyecto) {

                        $ids.="," . $proyecto->id_proyecto_fk;
                        $cantidad ++;
                        $codigo_proyectos.= "<div class = 'grid_16 negrilla centrartexto filas_ama' id = 'prorrateo" . $proyecto->id_proyecto_fk . "'>
                            <div class = 'grid_6 alin_izq esparriba5'>" . $proyecto->nombre . "</div>
                            <div class = 'grid_3'><input type = 'text' style = 'width: 100px;' value = '$proyecto->participacion' id = 'porce_prorrateo' onchange = 'calculo_prorrateo_contrato()'></div>
                            <div class = 'grid_3'><input type = 'text' style = 'width: 100px;' value = '$proyecto->costo_participacion' id = 'costo_prorrateo'></div>
                            <div class = 'grid_2'><span class = 'milinktext' onclick = 'quitar_proyecto_contrato(\"id_proyecto_select\"," . $proyecto->id_proyecto_fk . ");'>Quitar</span></div>
                            </div>";
                    }
                    ?>

                    <div class="grid_11 esparriba5 alin_der fondo_amarillo_claro">
                        <input  type="hidden" id="c_proy" value="<?php echo $cantidad; ?>">
                        <input  type="hidden" id="id_proys" value="<?php echo $ids; ?> ">
                        <div class="grid_7">
                            Proyecto: <select id="id_proyecto_select"  style=" width: 200px;">
                                <option value="0" disabled="disabled" selected="selected">Seleccione proyectos ..</option>                   
                                <?php
                                $ids_array = explode(",", $ids);
                                foreach ($lista_proyectos->result() as $proy) {
                                    ?>
                                    <option <?php if (in_array($proy->id_proy, $ids_array)) echo " disabled='disabled' "; ?> value="<?php echo $proy->id_proy; ?>"><?php echo $proy->nombre; ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                        <div class="grid_4">
                            <input type="button" value="Adicionar Proyecto" onclick="adicionar_proyecto_prorrateo('id_proyecto_select');">
                        </div>

                    </div>
                </div>
                <div class="grid_16 esparriba10 espabajo10">
                    <div class="grid_16 negrilla centrartexto fondo_azul colorBlanco">
                        <div class="grid_6"> Proyecto </div>
                        <div class="grid_3"> % de pago</div>
                        <div class="grid_3"> Costo </div>
                        <div class="grid_2" >  </div>
                    </div>
                    <div class="grid_16 colorcel" id="prorrateo_proy">

                        <?php echo $codigo_proyectos; ?>
                        <script>calculo_prorrateo_contrato()</script>


                    </div>
                    <div class="grid_16 centrartexto fondo_azul colorBlanco borde_arribam negrilla f16">
                        <div class="grid_6 alin_der "> TOTAL  .- </div>
                        <div class="grid_3"> <span id="porcent_total">0.00</span>% </div>
                        <div class="grid_3"> <span id="costo_total">0.00</span> </div>
                        <div class="grid_3" id="validacion">  </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="grid_20 esparriba10"></div>
    <?php if ($id_contrato != 0) { ?>
        <div class="grid_20 fondo_plomo_claro_areas_p">
            <div class="grid_20  negrilla f10 colorGuindo">Archivos Relacionados al CONTRATOS</div>



            <div class="grid_18 prefix_1 suffix_1">
                <div class=" ocultar" id="form_load" >
                    <form id='fileform' enctype='multipart/form-data' method='POST'>
                        <input class="input_redond_180"   type="hidden" id="id_contrato_alquiler" placeholder="" value="<?php echo $id_contrato; ?>">
                        <input type='hidden' id='dest'  value = 'doc_contratos_alquiler'>
                        <input type='hidden' id='direccion_load'  value = 'area_archivos_contratos'>                           
                        <input type='hidden' id='nombre_file' value='archivo' >                           
                        <input type='file' id='userfile'  name='userfile'  style='padding-left: 30px' title='Subir Archivo' onchange='subir_archivo_contrato_alquiler("area_archivos_contratos", "form_load");'><!--div dialog, div destino-->
                    </form>
                </div>
                <div class="grid_18 esparriba10"></div>

                <div class="grid_18 fondo_blanco bordeado espabajo10 esparriba10" id="area_archivos_contratos" >
                    <div class=" milink" id="imagen" style="float: left" title="Adicionar Archivo">    
                        <div class="add_archivo fondo_plomo_claro_areas" style="border-radius: 10px ; margin: 10px"  onclick="$('#form_load #userfile').trigger('click')">               
                        </div>
                    </div>
                </div>
                <script> buscar_archivos_relacionados('area_archivos_contratos',<?php echo $id_contrato; ?>);</script>

                <div class="grid_18 esparriba10"></div>
            </div>



        </div>
        <div class="grid_20 esparriba10"></div>


        <div class="grid_20 fondo_plomo_claro_areas_p">
            <div class="grid_20 negrilla f10 colorGuindo">Pagos Relacionados</div>

        </div>
    <?php } ?>
    <div class="grid_20 esparriba10"></div>



</div>
