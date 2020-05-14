<?php ?>

<div class="container_20">
    <div class="grid_20 fondo_plomo_claro_areas bordeado">
        <div class="grid_16">
            <div class="grid_14 prefix_1 suffix_1 fondoVerdeFuerte centrartexto letraMediana colorBlanco bordeAbajo">Informacion Personal</div>
            <div class="grid_16 f12 colorAzul">Complete la informacion faltante, ademas de corregir la información erronea.</div>
            <div class="grid_16  esparriba10">
                <div class="grid_4">
                    <input class="input_redond_200" type="text" id="ap_pat"  value="<?php echo $datos_usuario->ap_paterno; ?>" placeholder="Paterno">
                </div>
                <div class="grid_4">
                    <input class="input_redond_200" type="text" id="ap_mat" value="<?php echo $datos_usuario->ap_materno; ?>" placeholder="Materno">
                </div>
                <div class="grid_4"><input class="input_redond_200" id="nom"  type="text" value="<?php echo $datos_usuario->nombre; ?>" placeholder="Nombres">
                </div>

            </div>
            <div class="grid_16 letraChica">
                <div class="grid_4 centrartexto">Apellido Paterno</div>
                <div class="grid_4 centrartexto">Apellido Materno</div>
                <div class="grid_4 centrartexto">Nombre(s)</div>

            </div>

            <div class="grid_16  ">
                <div class="grid_4"><input class="input_redond_100" id="ci"  type="text" value="<?php echo $datos_usuario->ci; ?>" placeholder="Nro CI">
                    <select id="exp" >
                        <option value="0" <?php if ($datos_usuario->exp == "0") echo " selected='selected' "; ?>>Exp</option>
                        <option value="PN" <?php if ($datos_usuario->exp == "PN") echo " selected='selected' "; ?>>PN</option>
                        <option value="BN" <?php if ($datos_usuario->exp == "BN") echo " selected='selected' "; ?>>BN</option>
                        <option value="LP" <?php if ($datos_usuario->exp == "LP") echo " selected='selected' "; ?>>LP</option>
                        <option value="CCB" <?php if ($datos_usuario->exp == "CCB") echo " selected='selected' "; ?>>CB</option>
                        <option value="SCZ" <?php if ($datos_usuario->exp == "SCZ") echo " selected='selected' "; ?>>SC</option>
                        <option value="OR" <?php if ($datos_usuario->exp == "OR") echo " selected='selected' "; ?>>OR</option>
                        <option value="PT" <?php if ($datos_usuario->exp == "PT") echo " selected='selected' "; ?>>PT</option>
                        <option value="CHU" <?php if ($datos_usuario->exp == "CHU") echo " selected='selected' "; ?> >CH</option>
                        <option value="TJ"<?php if ($datos_usuario->exp == "TJ") echo " selected='selected' "; ?> >TJ</option>

                    </select>
                </div>    
                <div class="grid_4">
                    <input id="fec_nac" class="input_redond_200" type="text" value="<?php echo $datos_usuario->fecha_nacimiento; ?>" placeholder="fecha de Nacimiento">
                    <script>$("#fec_nac").datepicker({yearRange:"-80:-18"});  </script>
                </div>

                <div class="grid_4"><input id="nacionalidad" class="input_redond_200" type="text" value="<?php echo $datos_usuario->nacionalidad; ?>" placeholder="Nacionalidad"></div>    

            </div>
            <div class="grid_16 letraChica">
                <div class="grid_4 centrartexto">Cedula de Identidad</div>
                <div class="grid_4 centrartexto">Fecha de Nacimiento</div>
                <div class="grid_4 centrartexto">Nacionalidad</div>

            </div>

            <!-- aqui inicia la segunda fila de datos-->
            <div class="grid_16 f10  ">
                <div class="grid_2">
                    <div class="grid_2  centrartexto">
                        <select id="gen" style="margin-top: 20px">
                            <option value="Masculino " <?php if($datos_usuario->sexo=="Masculino")echo " selected='selected' ";?>>Masculino</option>
                            <option value="Femenino" <?php if($datos_usuario->sexo=="Femenino")echo " selected='selected' ";?>>Femenino</option>
                        </select>
                    </div>
                    <div class="grid_2 centrartexto">Genero</div>
                </div>
                <div class="grid_2">
                    <div class="grid_2 centrartexto">
                        <select id="estado_civil" style="margin-top: 20px">
                            <option value="Soltero" <?php if($datos_usuario->estado_civil=="Soltero")echo " selected='selected' ";?>>Solter@</option>
                            <option value="Casado" <?php if($datos_usuario->estado_civil=="Casado")echo " selected='selected' ";?>>Casad@</option>
                            <option value="Divorciado" <?php if($datos_usuario->estado_civil=="Divorciado")echo " selected='selected' ";?>>Divorciad@</option>
                            <option value="Viudo" <?php if($datos_usuario->estado_civil=="Viudo")echo " selected='selected' ";?>>Viudo@</option>
                        </select>
                    </div>
                    <div class="grid_2 centrartexto">Estado Civil</div>
                </div>



            </div>

            <!-- aqui inicia la segunda fila de datos-->

            <div class=" grid_16 letraChica">

                <div class="grid_3"><div class="grid_3 centrartexto">
                        <?php 
                        if($datos_usuario->telefonos!="")
                        $telf=  explode(";",$datos_usuario->telefonos);
                            else
                            {$telf[0]="";
                        $telf[1]="";}
                            
                        ?>
                        <input required="required" id="telf_dom" class="input_redond_150" type="text" value="<?php echo str_replace("domicilio :","",$telf[0]); ?>" placeholder="Telefono Domicilio"></div>
                    <div class="grid_3 centrartexto">Telefono Domicilio</div>
                </div>
                <div class="grid_6 prefix_1"><div class="grid_6 centrartexto">
                        <input id="telf_pers" class="input_redond_300" type="text" value="<?php echo str_replace(" Personal:","",$telf[1]); ?>" placeholder="Telefonos personales"></div>
                    <div class="grid_6 centrartexto">Telefonos Personales</div>
                </div>

            </div>
            <div class="grid_16 letraChica">
                <div class="grid_6"><div class="grid_6 centrartexto">
                        <input id="email_pers" class="input_redond_300" type="email" value="<?php echo $datos_usuario->correo_per;?>" placeholder="Correo electronico personal"></div>
                    <div class="grid_6 centrartexto">Correo Electronico Personal</div>
                </div> 
                <div class="grid_6 prefix_1"><div class="grid_6 centrartexto">
                        <input id="email_corp" class="input_redond_300" type="email" value="<?php echo $datos_usuario->correo_corp;?>" placeholder="Correo electronico corporativo"></div>
                    <div class="grid_6 centrartexto">Correo Electronico Corporativo</div>
                </div> 
            </div>
            <div class="grid_16 letraChica">
                <div class="grid_4"><div class="grid_4 centrartexto">
                        <select id="afp_emp" style="margin-top: 15px"> 
                            <option value="AFP FUTURO">AFP FUTURO</option>
                            <option value="AFP PREVISION">AFP PREVISION</option>
                            <option value="0">seleccione..</option>
                        </select></div>
                    <div class="grid_4 centrartexto">Aportes de AFP</div>
                </div> 
                <div class="grid_2 prefix_1"><div class="grid_2 centrartexto">
                        <input id="nuacua" class="input_redond_100" type="text" value="<?php echo $datos_usuario->nua_cua;?>" placeholder="N.U.A / C.U.A"></div>
                    <div class="grid_2 centrartexto">Nro de N.U.A./C.U.A.</div>
                </div> 
            </div>

            <div class="grid_16  ">
                <div class="grid_3 centrartexto"> 
                    <select id="departamento" style="margin-top: 20px">
                        
                        <option value="Pando" <?php if( $datos_usuario->departamento=="Pando")echo " selected='selected' "?>>Pando</option>
                        <option value="Bani" <?php if( $datos_usuario->departamento=="Beni")echo " selected='selected' "?>>Beni</option>
                        <option value="La Paz"<?php if( $datos_usuario->departamento=="La Paz")echo " selected='selected' "?>>La Paz</option>
                        <option value="Cochabamba"<?php if( $datos_usuario->departamento=="Cochabamba")echo " selected='selected' "?>>cochabamba</option>
                        <option value="Santa Cruz"<?php if( $datos_usuario->departamento=="Santa Cruz")echo " selected='selected' "?>>Santa Cruz</option>
                        <option value="Oruro"<?php if( $datos_usuario->departamento=="Oruro")echo " selected='selected' "?>>Oruro</option>
                        <option value="Potosi"<?php if( $datos_usuario->departamento=="Potosi")echo " selected='selected' "?>>Potosí</option>
                        <option value="Chuquisaca"<?php if( $datos_usuario->departamento=="Chuquisaca")echo " selected='selected' "?>>Chusuisaca</option>
                        <option value="Tarija"<?php if( $datos_usuario->departamento=="Tarija")echo " selected='selected' "?>>Tarija</option>
                        <option value="El Alto"<?php if( $datos_usuario->departamento=="El Alto")echo " selected='selected' "?>>El Alto</option>
                    </select></div> 
                <div class="grid_9">
                    <input id="direccion" class="input_redond_100" style="width: 445px" type="text" value="<?php echo $datos_usuario->direccion_domicilio;?>" placeholder="Direcion Domicilio : Zona, Calle/Avenida , Edificio, Piso, Nro">
                </div>

            </div>
            <div class="grid_16 letraChica">
                <div class="grid_3 centrartexto">Departamento</div>
                <div class="grid_9 centrartexto">Direcion Domicilio : Zona, Calle/Avenida , Edificio, Piso, Nro</div>
            </div>
            <div class="grid_16 letraChica esparriba10 centrartexto background fondo_verde_claro">
                <div class="grid_14 prefix_1 suffix_1 fondoVerdeFuerte centrartexto letraMediana colorBlanco bordeAbajo">Informacion de los dependientes</div>
                <div class="grid_12 f12 negrilla">
                    <?php echo str_replace("|","<br>",$datos_usuario->dependientes);?>
                </div>
                    <div class="grid_12" id ="dependientes">
                        <div id="grilla_modelo" class="oculto">
                            <div class="grid_12">
                                <div class="grid_5 suffix_1"><input type="text" id="nomdep" class="input_redond_250 margin_cero" placeholder="Nombre dependiente"></div>
                                <div class="grid_2"><input type="text" id="teldep" class="input_redond_100 " style="margin: 0;" placeholder="Telefono"></div>
                                <div class="grid_2">
                                    <select id="tipdep" style="margin-top: 5px"> 
                                        <option val="esposo">esposo</option>
                                        <option val="esposa">esposa</option>
                                        <option val="hijo">hijo </option>
                                        <option val="hija">hija </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="nrodep" value="1">
                        <div id="datos_dep1">
                            <div class="grid_12">
                                <div class="grid_5 suffix_1"><input type="text" id="nomdep" class="input_redond_250 margin_cero" placeholder="Nombre dependiente"></div>
                                <div class="grid_2"><input type="text" id="teldep" class="input_redond_100 " style="margin: 0;" placeholder="Telefono"></div>
                                <div class="grid_2">
                                    <select id="tipdep" style="margin-top: 5px"> 
                                        <option val="esposo">esposo</option>
                                        <option val="esposa">esposa</option>
                                        <option val="hijo">hijo </option>
                                        <option val="hija">hija </option>
                                    </select>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class=" grid_1"><div class="boton centrartexto" onclick="add_dep()">+</div></div>
                


            </div>
            <div class="grid_16 letraChica esparriba10 centrartexto background fondo_rojo_claro">
                <div class="grid_14 prefix_1 suffix_1 fondo_Rojo centrartexto letraMediana colorBlanco bordeAbajo">Informacion en caso de Emergencia</div>
                <div class="grid_10">
                    <div class="grid_10">
                        <?php  
                        if($datos_usuario->emergencia!="")
                        $emergencia=  explode(";", $datos_usuario->emergencia);
                        else
                        {   $emergencia[0]="";
                            $emergencia[1]="";}
                        
                            ?>
                        
                        <input id="contacto_p_emergencia" type="text" class="input_redond_50" value="<?php echo $emergencia[0];?>"
                               style="width: 500px" placeholder="Persona de contacto para Emergencias">
                    </div>
                    <div class="grid_10">
                        Persona de Emergencia
                    </div>

                </div>
                <div class="grid_3 prefix_1">
                    <div class="grid_3">
                        <input id="telefono_pers_emergencia" type="text" class="input_redond_150" placeholder="Telefono" value="<?php echo str_replace("Telefono: ", "", $emergencia[1]);?>">
                    </div>
                    <div class="grid_3">
                        Telefono 
                    </div>

                </div>

            </div>
            <div class="grid_16 letraChica esparriba10 centrartexto">
                <div class="grid_14 prefix_1 suffix_1 fondo_azul centrartexto letraMediana colorBlanco bordeAbajo">Informacion para el sistema</div>
                <div class="grid_3">
                    <div class="grid_3">
                        <input type="text" id="user_name" value="<?php echo $datos_usuario->username ?>" class="input_redond_150" placeholder="Nombre de usuario">
                    </div>
                    <div class="grid_3">
                        Nombre de usuario
                    </div>

                </div>
                <div class="grid_4 ">
                    <div class="grid_4 centrartexto">
                        <input id="contrasenia" type="password" class="input_redond_150" placeholder="contraseña">
                    </div>
                    <div class="grid_4 centrartexto">
                        Contraseña<br><span class="colorGuindo">(solo escriba si modificara su contraseña)</span> 
                    </div>

                </div>
                <div class="grid_4 ">
                    <div class="grid_4 centrartexto">
                        <input type="password" id="clave_operacional" class="input_redond_150" placeholder="clave_operacional">
                    </div>
                    <div class="grid_4 centrartexto">
                        Clave operacional<br> <span class="colorGuindo">(solo escriba si modificara su codigo operacional)</span>
                    </div>

                </div>
                 <div class="grid_16 esparriba10">
                <div class="grid_8 f14 colorGuindo negrilla" >
                   Proyecto actual en el que desempeña sus funciones
                </div>
                <div class="grid_4 centrartexto" >
                    
                    <?php 
                    
                    echo form_dropdown("", $proyecto_seleccion,  $datos_usuario->id_proyecto_actual, " id='proy_actual' "); ?>   
                       
                </div>
                
            </div>
                <div class="grid_16 esparriba10">
                <div class="grid_5" >
                   <div class="grid_5"> <input class="input_redond_250" type="text" id="cargo_actual" value="<?php echo $datos_usuario->cargo_actual;?>" placeholder="Cargo actual"></div>
                   <div class="grid_5"> Cargo actual que desempeña</div>
                </div>
                    <div class="grid_8 prefix_1" >
                        <div class="grid_8"> <textarea id="funcion_actual" class="textarea_redond_221x37" style="width: 390px;" placeholder="funciones que desempeña"><?php echo $datos_usuario->funcion_actual;?></textarea></div>
                   <div class="grid_8"> tareas que realiza</div>
                </div>
                
                
            </div>
            </div>



            <div class="grid_16 letraChica esparriba10">
                
                <div class="grid_14 prefix_1 suffix_1 fondo_azul centrartexto letraMediana colorBlanco bordeAbajo">Informacion de Tallas en Ropa de Trabajo</div>
                
                <div class="grid_14 prefix_1 suffix_1 esparriba10">
                    <div class="grid_4">Categoria de licencia de conducir :</div >
                    <select id="cate_cond">
                        <option value="0" <?php if($datos_usuario->cat_licencia_conducir=="0") echo " selected='selected' ";?>>no Conduce</option>
                        <option value="P" <?php if($datos_usuario->cat_licencia_conducir=="P") echo " selected='selected' ";?>>P</option>
                        <option value="A" <?php if($datos_usuario->cat_licencia_conducir=="A") echo " selected='selected' ";?>>A</option>
                        <option value="B" <?php if($datos_usuario->cat_licencia_conducir=="B") echo " selected='selected' ";?>>B</option>
                        <option value="C" <?php if($datos_usuario->cat_licencia_conducir=="C") echo " selected='selected' ";?>>C</option>
                    </select>
                </div>
                    
                
                
                
                <div class="grid_2 esparriba10 centrartexto">
                    <div class="grid_2">Camisa</div>
                    <div class="grid_2">
                        <select id="camisa">
                            <option value="S" <?php if($datos_usuario->camisa=="S") echo " selected='selected' ";?>>S</option>
                            <option value="M"  <?php if($datos_usuario->camisa=="M") echo " selected='selected' ";?>>M</option>
                            <option value="L"  <?php if($datos_usuario->camisa=="L") echo " selected='selected' ";?>>L</option>
                            <option value="XL"  <?php if($datos_usuario->camisa=="XL") echo " selected='selected' ";?>>XL</option>
                            <option value="XXL"  <?php if($datos_usuario->camisa=="XXL") echo " selected='selected' ";?>>XXL</option>
                            <option value="XXXL" <?php if($datos_usuario->camisa=="XXXL") echo " selected='selected' ";?>>XXXL</option>
                        </select>
                    </div>


                </div>
                <div class="grid_2 esparriba10 centrartexto">
                    <div class="grid_2">Pantalon</div>
                    <div class="grid_2">
                        <select id="pantalon">
                            <?php
                            for ($i = 38; $i <= 52; $i = $i + 2)
                            {
                                $s="";
                                if($datos_usuario->pantalon==$i)
                                    $s=" selected='selected' ";
                                echo "<option value='$i' $s>$i</option>";
                                
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="grid_2 esparriba10 centrartexto">
                    <div class="grid_2">Botin</div>
                    <div class="grid_2">
                        <select id="botin">

                            <?php
                            for ($i = 35; $i <= 44; $i++){
                            $s="";
                                if($datos_usuario->botin==$i)
                                    $s=" selected='selected' ";
                                echo "<option value='$i' $s>$i</option>";}
                            ?>

                        </select>
                    </div>


                </div>
                <div class="grid_2 esparriba10 centrartexto">
                    <div class="grid_2">Chaleco</div>
                    <div class="grid_2">
                        <select id="chaleco">
                            <option value="S" <?php if($datos_usuario->chaleco=="S") echo " selected='selected' ";?>>S</option>
                            <option value="M" <?php if($datos_usuario->chaleco=="M") echo " selected='selected' ";?>>M</option>
                            <option value="L" <?php if($datos_usuario->chaleco=="L") echo " selected='selected' ";?>>L</option>
                            <option value="XL" <?php if($datos_usuario->chaleco=="XL") echo " selected='selected' ";?>>XL</option>
                            <option value="XXL" <?php if($datos_usuario->chaleco=="XXL") echo " selected='selected' ";?>>XXL</option>
                            <option value="XXXL" <?php if($datos_usuario->chaleco=="XXXL") echo " selected='selected' ";?>>XXXL</option>
                        </select>
                    </div>


                </div>
                <div class="grid_2 esparriba10 centrartexto">
                    <div class="grid_2">Overol Tipo piloto</div>
                    <div class="grid_2">
                        <select id="overol_piloto">
                           <option value="S" <?php if($datos_usuario->overol_p=="S") echo " selected='selected' ";?>>S</option>
                            <option value="M" <?php if($datos_usuario->overol_p=="M") echo " selected='selected' ";?>>M</option>
                            <option value="L" <?php if($datos_usuario->overol_p=="L") echo " selected='selected' ";?>>L</option>
                            <option value="XL" <?php if($datos_usuario->overol_p=="XL") echo " selected='selected' ";?>>XL</option>
                            <option value="XXL" <?php if($datos_usuario->overol_p=="XXL") echo " selected='selected' ";?>>XXL</option>
                            <option value="XXXL" <?php if($datos_usuario->overol_p=="XXXL") echo " selected='selected' ";?>>XXXL</option>
                        </select>
                    </div>
                    <div class="grid_2">Overol Termico</div>
                    <div class="grid_2">
                        <select id="overol_termico">
                            <option value="S" <?php if($datos_usuario->overol_t=="S") echo " selected='selected' ";?>>S</option>
                            <option value="M" <?php if($datos_usuario->overol_t=="M") echo " selected='selected' ";?>>M</option>
                            <option value="L" <?php if($datos_usuario->overol_t=="L") echo " selected='selected' ";?>>L</option>
                            <option value="XL" <?php if($datos_usuario->overol_t=="XL") echo " selected='selected' ";?>>XL</option>
                            <option value="XXL" <?php if($datos_usuario->overol_t=="XXL") echo " selected='selected' ";?>>XXL</option>
                            <option value="XXXL" <?php if($datos_usuario->overol_t=="XXXL") echo " selected='selected' ";?>>XXXL</option>
                        </select>
                    </div>


                </div>
                <div class="grid_2 esparriba10 centrartexto">
                    <div class="grid_2">Parka</div>
                    <div class="grid_2">
                        <select id="parka">
                               <option value="S" <?php if($datos_usuario->parka=="S") echo " selected='selected' ";?>>S</option>
                            <option value="M" <?php if($datos_usuario->parka=="M") echo " selected='selected' ";?>>M</option>
                            <option value="L" <?php if($datos_usuario->parka=="L") echo " selected='selected' ";?>>L</option>
                            <option value="XL" <?php if($datos_usuario->parka=="XL") echo " selected='selected' ";?>>XL</option>
                            <option value="XXL" <?php if($datos_usuario->parka=="XXL") echo " selected='selected' ";?>>XXL</option>
                            <option value="XXXL" <?php if($datos_usuario->parka=="XXXL") echo " selected='selected' ";?>>XXXL</option>
                        </select>
                    </div>


                </div>
                <div class="grid_2 esparriba10 centrartexto">
                    <div class="grid_2">Ropa de Agua</div>
                    <div class="grid_2">
                        <select id="ropa_agua">
                           
                            <option value="M" <?php if($datos_usuario->ropa_agua=="M") echo " selected='selected' ";?>>M</option>
                            <option value="L" <?php if($datos_usuario->ropa_agua=="L") echo " selected='selected' ";?>>L</option>
                            <option value="L" <?php if($datos_usuario->ropa_agua=="L") echo " selected='selected' ";?>>XL</option>
                           
                        </select>
                    </div>


                </div>


            </div>
            
           
            
            <div class="grid_16 esparriba10 espabajo20">
                <div class="grid_3 centrartexto" >
                    <div class="boton milink" onclick="guardar_informacion_personal()">
                        Guardar Datos
                    </div>
                </div>
            </div>



        </div>
        <div class="grid_4" style="background-color:#999999;height: 100%  ">
            
            <div class="grid_4 f12 centrartexto"><img src="<?php echo base_url()."/imagenesweb/icono/alerta.png"?>" width="200px"></div>
            <div class="grid_4 f12 centrartexto">Adjuntar Archivos solicitados</div>


            <div class="grid_3"><?php echo $up_foto_user; ?></div>
            <div class="grid_4 f12 centrartexto">Foto Actualizada</div>
            <div class="grid_3 " ><?php echo $up_firma; ?></div>
            <div class="grid_4 f12 centrartexto">Firma Electronica</div>
            <div class="grid_3 " ><?php echo $up_ci_frontal; ?></div>
            <div class="grid_4 f12 centrartexto">Cedula de Identidad Frontal</div>
            <div class="grid_3 " ><?php echo $up_ci_trasero; ?></div>
            <div class="grid_4 f12 centrartexto">Cedula de Identidad Trasera</div>
            <div class="grid_3 " ><?php echo $up_licencia; ?></div>
            <div class="grid_4 f12 centrartexto">Licencia de Conducir</div>
            



        </div>



    </div> 
</div>

