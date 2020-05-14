<?php
//echo 'entra';
if ($informacion_reg->num_rows() > 0) {
    ?>
    <div class="tam1200">
        <div class="tam1200 fondo_azul colorBlanco negrilla f12 centrartexto esparriba5 espabajo5">
            <div class="tam100"><br></div>
            <div class="tam100">Inicio y Conclusion</div>
            <div class="tam200">Nombre de la Institución</div>
            <div class="tam200">Area y Cargo</div>
            <div class="tam300">Funcion Principal desempeñada</div>
            <div class="tam200 alin_der">Doc. de Respaldo</div>
         
        </div>
        <?php 
            foreach ($informacion_reg->result() as $reg)
            {
                ?>
                
                <div class="tam1200 f12 esparriba5 espabajo5 bordeAbajo filas">
                    <div class="tam100">
                       
                        <div class="editvehiculo milink" style="float:right" title="Editar Registro" onclick="dialog_adicionar_experiencia_laboral('div_formularios_dialog','<?php echo base_url() . "experiencia_laboral/adicionar_nueva_experiencia_laboral/".$reg->id_experiencia_lab; ?>','Editar experiencia laboral');">
                            
                        </div>
                         <div class="delete_ico milink" style="float:right" title="Borrar Registro" onclick="del_reg_experiencia('pregunta','<?php echo $reg->id_experiencia_lab?>');"></div>
                    </div>
            <div class="tam100"><?php echo "<span class='colorAzul'>Ini:".$reg->fecha_inicio."</span><br><span class='colorRojo'>fin:".$reg->fecha_fin."</span>";?></div>
            <div class="tam200 espder20"><?php echo "<span class='negrilla colorAzul'>".$reg->institucion."</span><br>".$reg->rubro_institucion."<br><span class='colorRojo'> Ref.: </span>".$reg->persona_referencia."<br><span class='colorRojo'> Nro.Ref.: </span>".$reg->numero_referencia;?></div>
            <div class="tam200 espder20"><?php echo $reg->area."<br>".$reg->cargo."<br><span class='colorRojo'> Personas a cargo: </span>".$reg->nro_personas_dependientes;?></div>
            <div class="tam300 espder10"><?php echo $reg->actividades."<br>";?></div>
            <div class="tam100 alin_der"><?php 
                $archtumb= str_replace("respaldo_experiencia_laboral", "respaldo_experiencia_laboral/thumbs", $reg->documento_adjunto);
                  
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
