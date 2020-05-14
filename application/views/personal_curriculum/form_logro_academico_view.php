<?php
$nivel = "";
$inst = "";
$carrera = "";
$mencion = "";
$reg_prof = "";
$f_i = "";
$f_f = "";
$descrip = "";
$arch = "";

if ($informacion_reg->num_rows() > 0) {
    $nivel = $informacion_reg->row()->nivel_formacion;
    $inst = $informacion_reg->row()->institucion;
    $carrera = $informacion_reg->row()->carrera;
    $mencion = $informacion_reg->row()->Mension;
    $reg_prof = $informacion_reg->row()->registro_profesional;
    $f_i = $informacion_reg->row()->fecha_inicio;
    $f_f = $informacion_reg->row()->fecha_fin;
    $descrip = $informacion_reg->row()->descripcion_estudio;
    $arch = $informacion_reg->row()->documento_adjunto;
}
/*$niveles=array("seleccionar...","Bachiller","Curso de Actualizacio","Seminario","Taller","1er Año Univerdidad","2do Año Universidad",
    "3er Año de Universidad","4to Año de Universidad","5to Año de universidad","Egresado Universitario","Egresado Tecnico Medio","Egresado Tecnico Superior",
    "Tecnico Medio","Tecnico Superior","Licenciado","Masterado","Doctorado")*/
?>
<div > 
    <input type="hidden" value="<?php echo $id_enviado; ?>" id="id_logro">
    <div> <input class="input_redond_350" type="hidden" id="id_user" value="<?php //echo $id_send;    ?>"></div>
    <div class=" grid_8" style="">  
        <!--<div class="grid_8">
          <select id="nivel_acad" onchange="">
                <?php /*for($i=0;$i<count($niveles);$i++)
                {   $sel="";
                    if($nivel==$niveles[$i])
                        $sel="selected='selected'";              
                    echo '<option value="'.$niveles[$i].'" '.$sel.'>'.$niveles[$i].'</option>';
                }*/
                ?>
                
                

            </select>  
        </div>--->
        
        
        
         <div class="grid_8"><input class="input_redond_370" type="text" id="nivel_acad" placeholder="Ej: Bachillerato/Licenciatura/Maestria/Seminario..etc" value="<?php echo $nivel;    ?>"></div>

        <div class="grid_8 f10 negrilla" >
           Obtención de grado académico
        </div>
    </div>
    <div class="f10 negrilla grid_8" style="">
        <div class="grid_8"><input class="input_redond_370" type="text" id="nom_institucion" placeholder="Ej: Colegio Ave Maria" value="<?php echo $inst;    ?>"></div>
        <div class="grid_8">Nombre de la Institución</div>
    </div>
    <div class="f10 negrilla grid_8" style="">
        <div class="grid_8"><input class="input_redond_370" type="text" id="carrera" placeholder="Ej: Ingenieria" value="<?php echo $carrera;    ?>"></div>
        <div class="grid_8">Carrera <span class="colorRojo negrilla f10">(Si corresponde)</span></div>
    </div>
    <div class="f10 negrilla grid_8" style="">
        <div class="grid_8"><input class="input_redond_370" type="text" id="mencion" placeholder="Ej: Electronica y Telecomunicaciones" value="<?php  echo $mencion;    ?>"></div>
        <div class="grid_8">Mención<span class="colorRojo negrilla f10"> (Si corresponde)</span></div>
    </div>

    <div class="f10 grid_8" style="">  
        <div class="grid_8 "> <input class="input_redond_200" type="text" id="reg_prof" placeholder="Ej: 75456" value="<?php echo $reg_prof;    ?>"></div>
        <div class="grid_8 negrilla"> Nro de registro Profesional <span class="colorRojo negrilla f10">(Si corresponde)</span></div>

    </div>

    <div class="f10 negrilla grid_8 alin_cen" style="">
        <div class="grid_4">
            <div class="f10 negrilla grid_4" style=""><input type="text" class="input_redond_150" id="fec_ini" value="<?php echo $f_i; ?>">
                <script>$("#fec_ini").datepicker({yearRange:"-100:+0"});</script></div>  
            <div class="f10 negrilla grid_4" style="">fecha inicio</div>  
        </div>
        <div class="grid_4">
            <div class="f10 negrilla grid_4" style=""><input type="text" class="input_redond_150" id="fec_fin" value="<?php echo $f_f; ?>">
                <script>$("#fec_fin").datepicker({yearRange:"-100:+0"});</script></div>  
            <div class="f10 negrilla grid_4" style="">Fecha de Egreso</div>  
        </div>
    </div>


    <div class="f10 grid_8 esparriba5" style="">  
        <div class="grid_8 f10 negrilla alin_cen ">
            <textarea id="des_logro" class="textarea_redond_382x65" placeholder="Cursos especializados sobre...."><?php echo $descrip;?></textarea>
        </div>
        <div class="grid_8  negrilla">
           Observaciones
        </div>

    </div>

    <div class="f10 negrilla grid_8" style="">
        <form id="fileform" enctype="multipart/form-data" method="POST" >
            <div class="grid_8"> <input type="file" id="userfile" name="userfile"> </div>
        </form>
        <div class="grid_6">Adjuntar Archivo de respaldo<br><span class="colorRojo">(Atención !!, el archivo a adjuntar debe ser de tipo imagen JPG,PNG ,las dimensiones no deben superar los 5000px y el peso maximo de 5MB )</span></div>
        <div class="grid_2">
            <?php if($arch!="")
            {   
                $archtumb= str_replace("respaldo_academico_personal", "respaldo_academico_personal/thumbs", $arch);
                  
                $extencion=  substr($arch, strlen($arch)-4);
               
                   
                $archtumb=  str_replace($extencion, "_thumb".$extencion, $archtumb);
                $archtumb=  substr($archtumb,2);
                $arch=  substr($arch,2);
                
                 
                echo "<img src='".  base_url().$archtumb."' width='80' onclick='ver_archivo(\"".$arch."\",\"Adjunto\")'>";
                
            }
             ?>
        </div>
        
    </div>
    

</div> 
<div class="grid_8">
    <div id="respuesta"></div>
</div>