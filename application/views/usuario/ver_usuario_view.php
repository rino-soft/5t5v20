    <div >Datos del <span class="negrilla">Usuario</span></div>
    <div class="fondo container_20">
    <div class="ver_usuario grid_13">
        <hr>
        <div>
            <div class="f12 grid_13" style=""> 
            <div class="grid_2 " style=""><?php echo $d_usuario->ci." "; if($d_usuario->exp!="0" ) echo $d_usuario->exp."<br>"; ?></div>
            <div class="grid_3 espizquierda" style=""> <?php echo $d_usuario->ap_paterno."<br>"; ?></div>
            <div class="grid_3 espizquierda" style=""><?php echo $d_usuario->ap_materno."<br>"; ?></div>
            <div class="grid_3 espizquierda" style=""><?php echo $d_usuario->nombre."<br>"; ?></div> </div>
            <br>
            <div class="f12  colorcel negrilla  grid_13 borde_abajo" style="" >
            <div class=" grid_2 " style=""> CI</div>
            <div class=" grid_3 espizquierda" style=""> Apellido Paterno</div>
            <div class=" grid_3 espizquierda" style=""> Apellido Materno</div>
            <div class=" grid_3 espizquierda" style=""> Nombre Usuario</div></div> 
        </div> 
         <div>
             <div class="f12 grid_13 esparriba5" style=""> 
             <div class="grid_3 " style=""><?php $timestamp = strtotime($d_usuario->fecha_nacimiento);$f =date('d/m/Y', $timestamp); echo $f."<br>"; ?></div> 
             <div class="grid_2 espizquierda" style=""><?php echo $d_usuario->sexo."<br>"; ?></div>
             <div class="grid_6 espizquierda" style=""><?php echo ucfirst($d_usuario->direccion_domicilio)."<br>"; ?></div></div>
            <br>
            <div class="f12   colorcel negrilla  grid_13 borde_abajo" style="">
            <div class="grid_3 " style=""> Fecha de Nacimiento</div>
            <div class=" grid_2 espizquierda" style=""> Sexo</div>
            <div class=" grid_6 espizquierda" style=""> Domicilio</div></div>
         </div>
         <br><br>
         <div>
            <div class="f12 grid_13 esparriba5" style=""> 
            <div class="grid_2 " style=""><?php echo $d_usuario->estado_civil."<br>"; ?></div>
            <div class="grid_3 espizquierda" style=""><?php echo $d_usuario->nacionalidad."<br>"; ?></div>
            <div class="grid_3 " style=""><?php echo $d_usuario->departamento."<br>"; ?></div>
            <div class="grid_3 espizquierda" style=""><?php if ($d_usuario->telefonos != ""){$telef= explode(";", $d_usuario->telefonos); echo $telef[0]."<br>"; echo $telef[1]."<br>";}?></div></div>
            <br>
            <div class="f12 colorcel negrilla  grid_13 borde_abajo" style="">
            <div class="  grid_2 " style=""> Estado Civil</div>
            <div class=" grid_3 espizquierda" style=""> Nacionalidad</div>
            <div class=" grid_3" style=""> Departamento</div>
            <div class=" grid_3 espizquierda" style=""> Telefonos</div></div>
        </div>
        <br><br><br>
        <div>
            <div class="f12 grid_13 esparriba5" style=""> 
            <div class="grid_2 " style=""><?php echo $d_usuario->username."<br>"; ?></div>
            <div class="grid_2 espizquierda" style=""><?php echo $d_usuario->estado."<br>"; ?></div>
            <div class="grid_3 espizquierda" style=""><?php  $timestamp = strtotime($d_usuario->fh_registro); $f =date('d/m/Y', $timestamp);echo $f."<br>"; ?></div>
            <div class="grid_2 espizquierda" style=""><?php  $timestamp = strtotime($d_usuario->fecha_inicio); $f =date('d/m/Y', $timestamp); echo $f."<br>";?></div>
            <div class="grid_2 espizquierda" style=""><?php echo $d_usuario->cat_licencia_conducir."<br>"; ?></div></div>
            <br>
            <div class="f12  colorcel negrilla  grid_13 borde_abajo" style="">
            <div class=" grid_2 " style="">Usuario</div>
            <div class=" grid_2 espizquierda" style="">Estado</div>  
            <div class="grid_3 espizquierda" style="">Fecha Registro</div>
            <div class="grid_2 espizquierda" style="">Fecha Inicio</div>
            <div class="  grid_2 espizquierda" style="">Licencia</div></div>
        </div>
        <br><br>
        <div>
            <div class="f12 grid_13 esparriba5" style="">               
            <div class="grid_4 " style=""><?php echo $d_usuario->correo_per."<br>"; ?></div>
            <div class="grid_4 espizquierda" style=""><?php echo $d_usuario->correo_corp."<br>"; ?></div>
            <div class="grid_3 espizquierda" style=""><?php echo $d_usuario->no_lib_militar."<br>"; ?></div></div>
            <br>
            <div class="f12  colorcel negrilla  grid_13 borde_abajo" style="">
            <div class="  grid_4" style=""> Correo Personal</div>
            <div class="  grid_4 espizquierda" style=""> Correo Corporativo</div>
            <div class="  grid_3 espizquierda" style=""> Nro. de Lib. Militar</div></div>
        </div>
        <br><br>
        <div>
            <div class="f12 grid_13 esparriba5" style=""> 
            <div class="grid_7 " style=""><?php echo $d_usuario->cargo_actual."<br>"; ?></div></div>
            <br>
            <div class="f12  colorcel negrilla  grid_13  " style="">            
            <div class="grid_7 " style=""> Cargo Actual</div></div>
        </div>
        <div>
            <div class="f12 grid_13 esparriba5" style=""> 
            <div class="grid_13 " style=""><?php echo $d_usuario->funcion_actual."<br>"; ?></div> </div>
            <br>
            <div class="f12  colorcel negrilla  grid_13 borde_abajo espabajo " style="">
            <div class=" grid_13 " style=""> Funcion Actual</div></div>
        </div>
        <br><br><br><br>
        <div >
            <div class=" f12  colorcel negrilla  grid_13 " style=""> Dependientes</div>
            <div class="bordeado1 grid_13  " style="">
             <div class="f12  colorcel negrilla  grid_13 esparriba5 " style="">
            <div class="  grid_6 " style=""> Nombre</div>
            <div class="  grid_3 " style=""> Parentesco</div>
            <div class="  grid_3 " style=""> Numero</div>
             </div>
            <div class="f12 grid_13 esparriba5 espabajo " style=""> 
                <div class="grid_9 " style="">
                    <?php if($d_usuario->dependientes!=""){ 
                    $dep= explode("|", $d_usuario->dependientes);  
                    for($i=0;$i<count($dep)-1;$i++) {
                    if ($dep[$i]!=" undefined(undefined) telefono : undefined ") {
                        $nom=explode("(", $dep[$i]);
                        $par=explode(")", $dep[$i]);
                        $parents= substr($par[0],strlen($nom[0])+1); 
                        $num=explode(":", $dep[$i]);?>
                 <div class="f12 grid_13 " style="">
                 <div class="  grid_6 " style=""> <?php echo $nom[0]."<br>";?></div>
                 <div class="  grid_3 " style=""><?php  echo $parents."<br>";?></div>
                 <div class="  grid_3 " style=""><?php  echo $num[1]."<br>";  ?></div></div>
                 <?php } }}?>
                </div></div></div>
        </div> 
        <div class="grid_13 espabajo borde_abajo ">
                <div class=" grid_13 colorRojo  negrilla" style="">En caso de emergencia llamar a:</div>
                 <div class="grid_13 NO " style="color: black"><?php if ($d_usuario->emergencia != ""){$emer= explode(";",$d_usuario->emergencia);echo $emer[0]."";echo $emer[1]."<br>";}?></div>
        </div>
    </div>
    <div class="ver_foto_usuario alin_cen">
       <br>
       <br>
    <?php 
    if ($d_usuario->fotografia_actual!="") {
        $archtumb= str_replace("fotouser", "fotouser/thumbs", $d_usuario->fotografia_actual);
                  
                $extencion=  substr($d_usuario->fotografia_actual, strlen($d_usuario->fotografia_actual)-4);
                $archtumb=  str_replace($extencion, "_thumb".$extencion, $archtumb);
                $archtumb=  substr($archtumb,2);
                $arch=  substr($d_usuario->fotografia_actual,2);
                echo "<img src='".  base_url().$archtumb."' width='250' onclick='ver_archivo(\"".$arch."\",\"Adjunto\")' class='milink'>";
                }
                else echo"<img src='".  base_url().'imagenesweb/recursos/perfil.jpg'."' width='200' class='milink'>";

                    
                ?>   
       <div  class=" f30 grid_6 alin_cen" style="">
           <span class="colorcel"> ID  </span> <?php for($i=strlen($d_usuario->cod_user);$i<5;$i++){$d_usuario->cod_user='0'.$d_usuario->cod_user;} echo $d_usuario->cod_user."<br>"; ?> 
           <?php if( $proyecto !='0') {?>
                 <span class="f14"> <?php echo $proyecto->descripcion."<br>"; ?></span>
            <?php } ?>
       </div>
    </div>
    </div>
<br><br>
<div>
    <?php
    if ($est_usuario->num_rows()>0) {
        ?>
    <br><br>
    <div ><span class="negrilla grid_20 esparriba5">ESTUDIOS PERSONALES</span></div>
            
        <div class="grid_20 fondo_azul colorAmarillo borde_abajo borde_arriba  negrilla f12" style="width: 100%">            
            <div class="negrilla" style="display: block-inline;float: left; width: 10%">FECHA </div>
            <div class="negrilla"style="display: block-inline; float: left; width: 25%">INSTITUCIÓN</div>
            <div class="negrilla" style="display: block-inline; float: left; width: 25%">CARRERA</div>
            <div class="negrilla" style="display: block-inline; float: left; width: 20%">DESCRIPCIÓN</div>
            <div class="negrilla alin_cen" style="display: block-inline; float: left; width: 20%">DOCUMENTO ADJ.</div>
        </div>
        <?php
        
        foreach ($est_usuario->result() as $usuario) {
        ?>
    <div class="grid_20 borde_abajo borde_arriba esparriba5  f12" style="width: 100%">

                    <div class="" style="display: block-inline; float: left; width: 10%"><?php if ($usuario->fecha_inicio != "" || $usuario->fecha_fin != "") echo $usuario->fecha_inicio."<br>".$usuario->fecha_fin; else echo " &nbsp;" ?></div>
                    <div class="" style="display: block-inline; float: left; width: 25%"><?php if ($usuario->institucion != ""||$usuario->nivel_formacion != "") echo $usuario->institucion."<br>".$usuario->nivel_formacion;else echo " &nbsp;" ?></div>
                    <div class="" style="display: block-inline; float: left; width: 25%"><?php if ($usuario->carrera != ""||$usuario->Mension != "") echo $usuario->carrera."<br>".$usuario->Mension;else echo " &nbsp;"  ?> </div>
                    <div class="" style="display: block-inline; float: left; width: 20%"><?php if ($usuario->descripcion_estudio != "") echo $usuario->descripcion_estudio;else echo " &nbsp;"?></div>
                    <div class="alin_cen" style="display: block-inline; float: left; width: 20%"><?php 
                    if($usuario->documento_adjunto!="")
                    {
                $archtumb= str_replace("respaldo_academico_personal", "respaldo_academico_personal/thumbs", $usuario->documento_adjunto);
                  
                $extencion=  substr($usuario->documento_adjunto, strlen($usuario->documento_adjunto)-4);
                $archtumb=  str_replace($extencion, "_thumb".$extencion, $archtumb);
                $archtumb=  substr($archtumb,2);
                $arch=  substr($usuario->documento_adjunto,2);
                echo "<img src='".  base_url().$archtumb."' width='65' onclick='ver_archivo(\"".$arch."\",\"Adjunto\")' class='milink'>";
                } else  {  echo"SIN DOC. ADJ."; }    ?>
       </div>          
  <?php }  } ?>
</div>
</div>
<br><br>
<div class="grid_19">
    <?php
    if ($exp_usuario->num_rows()>0) {
        ?>
    <br><br>
    <div><span class="negrilla espabajo">EXPERIENCIA LABORAL</span></div>
            <hr>
        <div class="grid_20 fondo_azul colorAmarillo borde_abajo borde_arriba  negrilla f12" style="width: 100%">            
            <div class="negrilla" style="display: block-inline;float: left; width: 15%">FECHA </div>
            <div class="negrilla"style="display: block-inline; float: left; width: 30%">INSTITUCIÓN</div>
            <div class="negrilla" style="display: block-inline; float: left; width: 35%">CARGO / ÁREA / ACTIVIDAD </div>
            <div class="negrilla alin_cen" style="display: block-inline; float: left; width: 15%"> DOCUMENTO ADJ.</div>
        </div>
        <?php
        
        foreach ($exp_usuario->result() as $usuario) {
        ?>
           <div class="grid_20  borde_abajo borde_arriba esparriba5  f12" style="width: 100%">  
                    <div class="" style="display: block-inline; float: left; width: 15%"><?php if ($usuario->fecha_inicio != ""||$usuario->fecha_fin != "") echo $usuario->fecha_inicio."<br>".$usuario->fecha_fin; else echo " &nbsp;" ?></div>
                    <div class="" style="display: block-inline; float: left; width: 30%"><?php if ($usuario->institucion != ""||$usuario->rubro_institucion != ""||$usuario->persona_referencia != ""||$usuario->numero_referencia != "") echo $usuario->institucion."<br>".$usuario->rubro_institucion."<br>".$usuario->persona_referencia."<br>".$usuario->numero_referencia;else echo " &nbsp;" ?></div>
                    <div class="" style="display: block-inline; float: left; width: 35%"><?php if ($usuario->area != ""||$usuario->cargo != ""||$usuario->actividades != "") echo $usuario->cargo." (".$usuario->area.")<br>".$usuario->actividades;else echo " &nbsp;"  ?> </div>
                    <div class="alin_cen" style="display: block-inline; float: left; width: 20%"><?php 
                    if($usuario->documento_adjunto!="")
                    {
                         $archtumb= str_replace("respaldo_experiencia_laboral", "respaldo_experiencia_laboral/thumbs", $usuario->documento_adjunto);
                         $extencion=  substr($usuario->documento_adjunto, strlen($usuario->documento_adjunto)-4);
                         $archtumb=  str_replace($extencion, "_thumb".$extencion, $archtumb);
                         $archtumb=  substr($archtumb,2);
                         $arch=  substr($usuario->documento_adjunto,2);
                         echo "<img src='".  base_url().$archtumb."' width='65' onclick='ver_archivo(\"".$arch."\",\"Adjunto\")' class='milink'>";
                   }
                   else echo"SIN DOC. ADJ.";
                ?>
                    </div>
            <?php
            }
            }
        ?>
</div>
</div>
    <div class="grid_8">
        <div id="respuesta"></div>
    </div>
    <script>cambios_form();</script>
    