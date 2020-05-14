<?php
$nom = "";
$app = "";
$apm = "";
$ci = "";
$user = "";
$pass = "";
$est = "";
$fhr = "";
$telf = "";
$exp = "";
$dir = "";
$sex = "";
$co = "";
$rs_llave = "";
$fecha_u = "";
$sw = 0;
//echo $id_send;
if ($id_send != 0 && $id_send != $this->session->userdata('id_admin')) {
    $nom = $d_usuario->nombre;
    $rs_llave = "readonly='readonly'";
    $app = $d_usuario->ap_paterno;
    $apm = $d_usuario->ap_materno;
    $ci = $d_usuario->ci;
    $user = $d_usuario->username;
    $pass = $d_usuario->password;
    $est = $d_usuario->estado;
    $fhr = $d_usuario->fh_registro;
    $telf = $d_usuario->telefono;
    $exp = $d_usuario->exp;
    $dir = $d_usuario->direccion;
    $sex = $d_usuario->sexo;
    $co = $d_usuario->cod_operacional;
    $fecha_u = $d_usuario->fecha_inicio;
    $sw = 0;
} else {
    if ($id_send != 0) {
        $nom = $d_usuario->nombre;
        $rs_llave = "readonly='readonly'";
        $app = $d_usuario->ap_paterno;
        $apm = $d_usuario->ap_materno;
        $ci = $d_usuario->ci;
        $user = $d_usuario->username;
        $pass = $d_usuario->password;
        $est = $d_usuario->estado;
        $fhr = $d_usuario->fh_registro;
        $telf = $d_usuario->telefono;
        $exp = $d_usuario->exp;
        $dir = $d_usuario->direccion;
        $sex = $d_usuario->sexo;
        $co = $d_usuario->cod_operacional;
        $fecha_u = $d_usuario->fecha_inicio;
        $sw = 1;
    }
}
if ($sw != 1) {
    ?>
    <div>
        <div>
            <div >Ingrese los Datos del <span class="negrilla">Usuario</span></div>
            <hr>
            <div> <input class="input_redond_350" type="hidden" id="id_user" value="<?php echo $id_send; ?>"></div>
        </div>
        <div class="f10 grid_8" style="">  
            <div class="grid_2" style=""> <input class="input_redond_100" type="text" id="app"  placeholder="Apellido Paterno" value="<?php echo $app; ?>"></div>
            <div class="grid_2 espizquierda" style=""> <input  class="input_redond_100"type="text" id="apm" placeholder="Apellido Materno" value="<?php echo $apm; ?>"></div>
            <div class="grid_2 espizquierda" style=""> <input class="input_redond_100" type="text" id="nom"  placeholder="Nombre Usuario" value="<?php echo $nom; ?>"></div>
        </div>
        <div class="f10 negrilla grid_8" style="">
            <div class="f10 negrilla grid_2" style=""> Apellido Paterno</div>
            <div class="f10 negrilla grid_2 espizquierda" style=""> Apellido Materno</div>
            <div class="f10 negrilla grid_2 espizquierda" style=""> Nombre Usuario</div>
        </div>
        <div class="f10 grid_8" style="">  
            <div class="grid_4 "> <input class="input_redond_200" type="text" id="ci" placeholder="Carnet Identidad" value="<?php echo $ci; ?>"></div>
            <div class="grid_3 f11 negrilla colorAzul esparriba10 espizq10" STYLE="margin-top: 10px" >
                <select id="exp" onchange="">
                  <option value="0">Exp</option>
                        <option value="PN">PN</option>
                        <option value="BN">BN</option>
                        <option value="LP">LP</option>
                        <option value="CCB">CB</option>
                        <option value="SCZ">SC</option>
                        <option value="OR">OR</option>
                        <option value="PT">PT</option>
                        <option value="CHU">CH</option>
                        <option value="TJ">TJ</option>
                </select>  
            </div>
        </div>
        <div class="f10 negrilla grid_8" style="">
            <div class="f10 negrilla grid_4" style="">Cedula de Identidad</div>  
        </div>
        
       <!--  desde aqui
        <div class="f10 grid_8" style="">  
            <div class="grid_8 "> <input class="input_redond_200" type="text" id="tel" placeholder="Telefono/Celular" value="<?php echo $telf; ?>" ></div>
        </div>
        <div class="f10 negrilla grid_8" style="">
            <div class="f10 negrilla grid_8"> Telefono</div>
        </div>
        <div class="f10 grid_8" style="">  
            <div class="grid_4 "> <input class="input_redond_200" type="text" id="dir" placeholder="Direccion" value="<?php echo $dir; ?>" ></div>
            <div class="grid_3 f11 negrilla colorAzul esparriba10 espizq10" >Sexo:
                <select id="gen" onchange="">
                    <?php
                    //echo ' <option selected="selected" value="Masculino">' . "Masculino" . '</option>';
                    //echo ' <option value="Femenino">' . "Femenino" . '</option>';
                    ?>
                </select>  
            </div>
        </div>
        <div class="f10 negrilla grid_8" style="">
            <div class="f10 negrilla grid_8"> Direccion</div>
        </div>
        <br>-->
        <div class="f10 grid_8" style="">  
            <div class="grid_3"> <input class="input_redond_150" type="text" id="user" <?php echo $rs_llave; ?>  placeholder="Username" value="<?php echo $user; ?>"></div>
            <div class="grid_3 espizquierda "> <input class="input_redond_150 " type="password" id="pass" placeholder="Password" value="<?php echo $pass; ?>"></div>
        </div>
       
        <div class="f10 negrilla grid_8" style="">
            <div class="f10 negrilla grid_3" style="">Username</div>
            <div class="f10 negrilla grid_3 espizquierda" style="">Password</div>
        </div><!--
        <div class="f10 grid_8" style="">  
            <div class="grid_4 "> <input class="input_redond_200" type="password" id="co" placeholder="Codigo Operacional" value="<?php //echo $co; ?>"></div>
        </div>
        <div class="f10 negrilla grid_8" style="">
            <div class="f10 negrilla grid_4" style="">Codigo Operacional</div>
        </div>-->
        <input type="hidden" value="no" id="cambios"> 
        <div class="grid_8 " style="">
            <input class="input_redond_180" id="fecha_u" placeholder="Escriba la fecha" value="<?php echo $fecha_u; ?>">
            <div class="f10 negrilla">Fecha Ingreso a la Empresa</div>
            <script>$("#fecha_u").datepicker({yearRange: '-25:+0'});</script>
        </div>
    </div>

    <div class="grid_8">
        <div id="respuesta"></div>
    </div>
    <script>cambios_form();</script>
    <?php
} else {
    $sw = 0;
    ?>
    <div>
        <div>
            <div >Ingrese los Datos del <span class="negrilla">Usuario</span></div>
            <hr>
            <div> <input class="input_redond_350" type="hidden" id="id_user" value="<?php echo $id_send; ?>"></div>
        </div>
        <div class="f10 grid_8" style="">  
            <div class="grid_2" style=""> <input class="input_redond_100" type="text" id="app" <?php echo $rs_llave; ?>  placeholder="Apellido Paterno" value="<?php echo $app; ?>"></div>
            <div class="grid_2 espizquierda" style=""> <input  class="input_redond_100"type="text" id="apm" <?php echo $rs_llave; ?>  placeholder="Apellido Materno" value="<?php echo $apm; ?>"></div>
            <div class="grid_2 espizquierda" style=""> <input class="input_redond_100" type="text" id="nom" <?php echo $rs_llave; ?>  placeholder="Nombre Usuario" value="<?php echo $nom; ?>"></div>
        </div>
        <div class="f10 negrilla grid_8" style="">
            <div class="f10 negrilla grid_2" style=""> Apellido Paterno</div>
            <div class="f10 negrilla grid_2 espizquierda" style=""> Apellido Materno</div>
            <div class="f10 negrilla grid_2 espizquierda" style=""> Nombre Usuario</div>
        </div>
        <div class="f10 grid_8" style="">  
            <div class="grid_4 "> <input class="input_redond_200" type="text" id="ci" <?php echo $rs_llave; ?> placeholder="Carnet Identidad" value="<?php echo $ci; ?>"></div>
            <div class="grid_3 f11 negrilla colorAzul esparriba10 espizq10" > Expedido:
                <select id="exp" onchange="">
                    <?php
                    echo ' <option selected="selected" value="Masculino">' . "LP" . '</option>';
                    echo ' <option value="Femenino">' . "SCZ" . '</option>';
                    echo ' <option value="Femenino">' . "CB" . '</option>';
                    echo ' <option value="Femenino">' . "TJ" . '</option>';
                    echo ' <option value="Femenino">' . "PT" . '</option>';
                    echo ' <option value="Femenino">' . "BN" . '</option>';
                    echo ' <option value="Femenino">' . "SR" . '</option>';
                    echo ' <option value="Femenino">' . "PD" . '</option>';
                    echo ' <option value="Femenino">' . "CH" . '</option>';
                    echo ' <option value="Femenino">' . "AT" . '</option>';
                    ?>
                </select>  
            </div>
        </div>
        <div class="f10 negrilla grid_8" style="">
            <div class="f10 negrilla grid_4" style="">CI</div>  
        </div>
        <div class="f10 grid_8" style="">  
            <div class="grid_8 "> <input class="input_redond_200" type="text" id="tel" placeholder="Telefono/Celular" value="<?php echo $telf; ?>" ></div>
        </div>
        <div class="f10 negrilla grid_8" style="">
            <div class="f10 negrilla grid_8"> Telefono</div>
        </div>
        <div class="f10 grid_8" style="">  
            <div class="grid_4 "> <input class="input_redond_200" type="text" id="dir" placeholder="Direccion" value="<?php echo $dir; ?>" ></div>
            <div class="grid_3 f11 negrilla colorAzul esparriba10 espizq10" >Sexo:
                <select id="gen" onchange="">
                    <?php
                    echo ' <option selected="selected" value="Masculino">' . "Masculino" . '</option>';
                    echo ' <option value="Femenino">' . "Femenino" . '</option>';
                    ?>
                </select>  
            </div>
        </div>
        <div class="f10 negrilla grid_8" style="">
            <div class="f10 negrilla grid_8"> Direccion</div>
        </div>
        <br>
        
        <div class="f10 grid_8" style="">  
            <div class="grid_3"> <input class="input_redond_150" type="text" id="user" <?php echo $rs_llave; ?>  placeholder="Username" value="<?php echo $user; ?>"></div>
            <div class="grid_3 espizquierda "> <input class="input_redond_150 " type="password" id="pass" placeholder="Password" value="<?php echo $pass; ?>"></div>
        </div>
        <div class="f10 negrilla grid_8" style="">
            <div class="f10 negrilla grid_3" style="">Username</div>
            <div class="f10 negrilla grid_3 espizquierda" style="">Password</div>
        </div><!--
        <div class="f10 grid_8" style="">  
            <div class="grid_4 "> <input class="input_redond_200" type="password" id="co" placeholder="Codigo Operacional" value="<?php echo $co; ?>"></div>
        </div>
        <div class="f10 negrilla grid_8" style="">
            <div class="f10 negrilla grid_4" style="">Codigo Operacional</div>
        </div>-->
        <input type="hidden" value="no" id="cambios"> 
        <div class="grid_8 " style="">
            <input class="input_redond_180" id="fecha_u" placeholder="Escriba la fecha" value="<?php echo $fecha_u; ?>">
            <div class="f10 negrilla">Fecha Ingreso</div>
            <script>$("#fecha_u").datepicker();</script>
        </div>
    </div>

    <div class="grid_8">
        <div id="respuesta"></div>
    </div>
    <script>cambios_form();</script>
    <?php
}
?>
