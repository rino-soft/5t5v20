<?php
if ($informacion_reg->num_rows() > 0) {
    ?>
    <div class="tam1200">
        <div class="tam1200 fondo_azul colorBlanco negrilla f12 centrartexto esparriba5 espabajo5">
            <div class="tam100"><br></div>
            <div class="tam100">Inicio y Conclusion</div>
            <div class="tam300">Institucion/Carrera/Mension</div>
            <div class="tam200">Nivel</div>
            <div class="tam100">Nro Registro</div>
            <div class="tam300">Descripcion</div>
            <div class="tam100">Respaldo</div>
        </div>
        <?php 
            foreach ($informacion_reg->result() as $reg)
            {
                ?>
                
                <div class="tam1200 f12 esparriba5 espabajo5 bordeAbajo filas">
                    <div class="tam100">
                       
                        <div class="editvehiculo milink" style="float:right" title="Editar Registro" onclick="dialog_form_logro_academico('formulario_logro','<?php echo base_url()."estudios_personal/form_logro_acad/".$reg->id_estudios_personal?>');">
                            
                        </div>
                         <div class="delete_ico milink" style="float:right" title="Borrar Registro" onclick="del_reg_estu('pregunta','<?php echo $reg->id_estudios_personal?>');"></div>
                    </div>
            <div class="tam100"><?php echo "<span class='colorAzul'>Ini:".$reg->fecha_inicio."</span><br><span class='colorRojo'>fin:".$reg->fecha_fin."</span>";?></div>
            <div class="tam300"><?php echo $reg->institucion."<br>".$reg->carrera."<br>".$reg->Mension;?></div>
            <div class="tam200"><?php echo $reg->nivel_formacion."<br>";?></div>
            <div class="tam100"><?php echo $reg->registro_profesional."<br>";?></div>
            <div class="tam300"><?php echo $reg->descripcion_estudio."<br>";?></div>
            <div class="tam100 alin_cen"><?php 
                $archtumb= str_replace("respaldo_academico_personal", "respaldo_academico_personal/thumbs", $reg->documento_adjunto);
                  
                $extencion=  substr($reg->documento_adjunto, strlen($reg->documento_adjunto)-4);
               
                   
                $archtumb=  str_replace($extencion, "_thumb".$extencion, $archtumb);
                $archtumb=  substr($archtumb,2);
                $arch=  substr($reg->documento_adjunto,2);
                
                 
                echo "<img src='".  base_url().$archtumb."' width='65' onclick='ver_archivo(\"".$arch."\",\"Adjunto\")' class='milink'>";?>
            </div>
            
        </div>
        
                <?php
            }
        
        ?>
    </div>




    <?php
} else {
    echo "No se encontraron registros!!!...";
}
?>
