<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of nueva_experiencia_laboral_view
 *
 * @author POMA RIVERO
 */
//echo 'entra'
?>

<?php
$fecha_ini="";$fecha_fin="";$inst="";$rubro="";$area="";$cargo="";$cant="";$act="";$per_ref="";$num_ref="";$arch= "";

//echo $id_send;
if($experiencia->num_rows()>0)
{
    $fecha_ini=$experiencia->row()->fecha_inicio;
    $fecha_fin=$experiencia->row()->fecha_fin;
    $inst=$experiencia->row()->institucion;
    $rubro=$experiencia->row()->rubro_institucion;
    $area=$experiencia->row()->area;
    $cargo=$experiencia->row()->cargo;
    $cant=$experiencia->row()->nro_personas_dependientes;
    $act=$experiencia->row()->actividades;
    $per_ref=$experiencia->row()->persona_referencia;
    $num_ref=$experiencia->row()->numero_referencia;
    $arch=$experiencia->row()->documento_adjunto;
    
   
}
?>



<div>
        <div>Ingrese los Datos de <span class="negrilla">EXPERIENCIA</span></div>
        <hr>
 
        
    <input class="input_redond_350" type="hidden" id="id_expe" value="<?php echo $id_exp;?>">
    <input class="input_redond_350" type="text" id="nom_inst" <?php //echo $rs_llave; ?>  placeholder="Nombre de la Institución" value="<?php echo $inst ;?>"></div>
    <div class="f10 negrilla"> Nombre de la institución</div>
    
    
    <div class="grid_7"> <input class="input_redond_350" type="text" id="rubro" <?php //echo $rs_llave; ?> placeholder="Ej.:Servicio de Telecomunicaciones" value="<?php  echo  $rubro ;?>"></div>
    <div class=" grid_7 f10 negrilla"> Rubro de la Institución</div>
    <div class="grid_7"> <input  class="input_redond_350"type="text" id="area" placeholder="Ej.: Administración" value="<?php  echo $area ;?>"></div>
    <div class="grid_7 f10 negrilla"> Área</div>
    <div class="grid_7"> <input  class="input_redond_350"type="text" id="nom_puesto" placeholder="Ej.: Personal administrativo" value="<?php  echo $cargo ;?>"></div>
    <div class="grid_7 f10 negrilla"> Nombre del puesto</div>
    <div class="grid_7">
       <div class="grid_3 espder10">
        <div > <input class="input_redond_150" type="text" id="fe_ini" placeholder="27/07/2005" value="<?php echo  $fecha_ini ;?>"></div>
        <div class="f10 negrilla"> Fecha inicio</div>
        <script>$("#fe_ini").datepicker({yearRange:"-100:+0"});</script>
       </div>
       <div class="grid_3">
        <div > <input class="input_redond_150" type="text" id="fe_fin" placeholder="12/09/2015" value="<?php echo $fecha_fin ;?>" ></div>
        <div class="f10 negrilla"> Fecha Finalización</div>
        <script>$("#fe_fin").datepicker({yearRange:"-100:+0"});</script>
       </div>

    </div>
    <div class="grid_7 esparriba5">
         <select id="cant_pe">
             <?php for($i=0;$i<=20;$i++){
                 $sel="";
                 if($i==$cant){
                     $sel="selected='selected'";
                 }
                 echo "<option value='$i' $sel>$i</option>"; }?>
             
          
           
         </select>  
       <div class="f10 negrilla"> Nro.de personas a cargo</div>
    </div>
 <div class="grid_7"> <input  class="input_redond_350"type="text" id="nomb_ref" placeholder="Ej.: Ing.Carlos Vasquez" value="<?php  echo $per_ref ;?>"></div>
  <div class="grid_7 10 negrilla">Referencia laboral</div>
 <div class="grid_7"> <input  class="input_redond_350"type="text" id="num_ref" placeholder="Ej.:2406667 / 7778889 " value="<?php  echo $num_ref ;?>"></div>
  <div class="grid_7 f10 negrilla">Número de referencia</div>   
 <div class="esparriba10">   
 <div class="grid_7"><textarea class="textarea_redond_352x77" type="text" id="actividades" placeholder="Describa las actividades realizadas" ></textarea></div>
 <div class="f10 negrilla">Actividades realizadas</div>
 </div> 
 
  
   <div class="f10 negrilla grid_7" style="">
        <form id="fileform" enctype="multipart/form-data" method="POST" >
            <div class="grid_7"> <input type="file" id="userfile" name="userfile"> </div>
        </form>
        <div class="grid_5">Adjuntar Archivo de respaldo<br><span class="colorRojo">(Atención !!, el archivo a adjuntar debe ser de tipo imagen JPG,PNG ,las dimensiones no deben superar los 5000px y el peso maximo de 5MB )</span></div>
        <div class="grid_2 ">
            <?php if($arch!="")
            {   
                $archtumb= str_replace("respaldo_experiencia_laboral", "respaldo_experiencia_laboral/thumbs", $arch);
                  
                $extencion=  substr($arch, strlen($arch)-4);
               
                   
                $archtumb=  str_replace($extencion, "_thumb".$extencion, $archtumb);
                $archtumb=  substr($archtumb,2);
                $arch=  substr($arch,2);
                
                 
                echo "<img src='".  base_url().$archtumb."' width='80' onclick='ver_archivo(\"".$arch."\",\"Adjunto\")'>";
                
            }
             ?>
        </div>
        
    </div>
    
    

<script>cambios_form();</script>