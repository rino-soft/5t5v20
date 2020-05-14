
<?php ?>
<!---<div class="fondo_azul colorBlanco negrilla f12" style="width: 95%; display: block; padding: 5px; ">
    <div style="display: inline-block">

<?php
if ($total_registros > 0)
    echo $total_registros . " registros cargados exitosamente.";
else
    echo $total_registros . " registros cargados !  No se han encontrado Registros en la Base de Datos.";
?>

    </div>

    <div id="paginacion" style="float: right; padding-right: 25px">
<?php
/* for ($pa = 1; $pa <= ceil($total_registros / $mostrar_X); $pa++) {
  if ($pa != $pagina_actual) {
  ?>
  <div class='milink link_blanco' onclick="$('#pagina_registros').val(<?php echo $pa; ?>);search_and_list_vehiculo('lista_vehiculo');" style="float: left" > <?php echo $pa . " ,"; ?> </div>
  <?php
  } else {
  ?>
  <div class="colorAmarillo" style="float: left"> <?php echo $pa . " ,"; ?> </div>
  <?php
  }
  } */
?>

    </div>
</div>--->

<div id="subida_imagen" class="ocultar container_20"></div>
<div class='div1150  alin_cen colorAmarilloma fondo_azul espaciado5 ' >
    <div class="f12 negrilla" style="display: block-inline;width: 50px;float: left ">
        <div style="display: block; ">
            Id
        </div>               
    </div>
    <div class="f12 negrilla" style="display: block-inline; width: 80px; float: left;margin-left: 5px; margin-right: 5px">
        <div style="display: block; ">Placa</div>               

    </div>
    <div class="f12 negrilla alin_cen"style="display: block-inline;  width: 80px; float: left;margin-left: 1px; margin-right: 5px">
        <div style="display: block; ">Modelo</div>  

    </div>

    <div class="f12 negrilla alin_cen"style="display: block-inline;  width: 30px; float: left;margin-left: 5px; margin-right: 5px">
        <div style="display: block; ">Cap</div>  

    </div>
    <div class="f12 negrilla"style="display: block-inline;  width: 70px; float: left;margin-left: 5px; margin-right: 5px">
        <div style="display: block; ">Marca</div>  

    </div>

    <div class="f12 negrilla"style="display: block-inline;  width: 70px; float: left;margin-left: 5px; margin-right: 5px">
        <div style="display: block; ">Fecha Adquirida</div>  

    </div>
    <div class="f12 negrilla"style="display: block-inline;  width: 85px; float: left;margin-left: 5px; margin-right: 5px">
        <div class="milink" style="display: block;" onclick='
            if($("#mostrar_selec").is(":visible")){
                $("#mostrar_selec").css("display","none" );  
            }else{
                $("#mostrar_selec").css("display","block" );
            }
         
             '>Depto.</div>  
        <div style="display:none" id="mostrar_selec"> 
            <select id="ciudad_asig" onchange=" search_and_list_vehiculo('lista_vehiculo');">

                <?php
                // echo ' select';
                if ($selec_depar == "0")
                    echo '<option selected="selected" value="0">Todos</option>';
                else
                    echo ' <option value="0">Todos</option>';

                foreach ($selec_ciudad->result() as $ciudad) {
                    if ($ciudad->nombre == $selec_depar)
                        echo '<option selected="selected" value="' . $ciudad->nombre . '">' . $ciudad->nombre . '</option>';
                    else
                        echo ' <option value="' . $ciudad->nombre . '">' . $ciudad->nombre . '</option>';
                }
                if ($selec_depar == 'Sin asignacion')
                    echo '<option selected="selected" value="Sin asignacion">Sin asignacion</option>';
                else
                    echo ' <option value="Sin asignacion">Sin asignacion</option>';
                ?>

            </select>
        </div>
    </div>
    <div class="f12 negrilla"style="display: block-inline;  width: 130px; float: left;margin-left: 5px; margin-right: 5px">
        <div style="display: block; ">Accesorios</div>  

    </div>

    <div class="f10 negrilla"style="display: block-inline;  width: 100px; float: left;margin-left: 5px; margin-right: 5px">
        <div style="display: block; ">Estado Asignación Nacional</div>  

    </div>
    <div class="f10 negrilla"style="display: block-inline;  width: 100px; float: left;margin-left: 5px; margin-right: 5px">
        <div class="milink" style="display: block;" onclick='
            if($("#mostrar_selec").is(":visible")){
                $("#mostrar_selec2").css("display","none" );  
            }else{
                $("#mostrar_selec2").css("display","block" );
            }
         
             '>Estado Asignación Regional</div> 
        <div style="display:none" id="mostrar_selec2"> 
            <select id="proyecto_date" style="font-size: 10px;" onchange=" search_and_list_vehiculo('lista_vehiculo');">
                <?php
                if ($proyecto_selec == "0")
                    echo '<option selected="selected" value="0">Todos</option>';
                else
                    echo ' <option value="0">Todos</option>';

                if ($proyecto_selec == 'Taller')
                    echo '<option selected="selected" value="Taller">Taller</option>';
                else
                    echo ' <option value="Taller">Taller</option>';


                foreach ($selec_proyecto->result() as $dato) {
                    if ($dato->nombre == $proyecto_selec)
                        echo '<option selected="selected" title="' . $dato->nombre . '" value="' . $dato->nombre . '">' . substr($dato->nombre, 0, 13) . '</option>';
                    else
                        echo ' <option title="' . $dato->nombre . '" value="' . $dato->nombre . '">' . substr($dato->nombre, 0, 13) . '</option>';
                }
                if ($proyecto_selec == 'Libre')
                    echo '<option selected="selected" value="Libre">Libre</option>';
                else
                    echo ' <option value="Libre">Libre</option>';
                ?>

            </select>

        </div>
    </div>
    <div class="f10 negrilla"style="display: block-inline;  width: 50px; float: left;margin-left: 5px; margin-right: 5px">
        <div style="display: block; ">Subcentro</div>  

    </div>
    <div class="f12 negrilla"style="display: block-inline;  width: 130px; float: left;margin-left: 5px; margin-right: 5px">
        <div style="display: block; ">Estado vehicular</div>
        <div class="mecanico milink alin_der" title="Estado mecanico" ></div>
        <div class="carroceria milink alin_der" title="Estado carroceria"></div>
        <div class="llanta milink alin_der" title="Estado llantas"></div>

    </div>
    <div class="f12 negrilla alin_der"style="display: block-inline;  width: 50px; float: left;margin-left: 5px; margin-right: 5px">
        <div style="display: block; ">Est.Uso</div>  

    </div>


</div>

<!-- aqui se muestra los registros con un foreach -->


<?php
/*$t_vehi=0;
$t_alq=0;
$t_pro=0;
$t_pro_inac=0;
$t_pro_act=0;
$t_veh_bue=0;
$t_veh_reg=0;
$t_veh_pes=0;
$t_veh_tall=0;*/
foreach ($registros->result() as $reg) {

    

    //  $b=($proyecto==$asig_regional[$reg->id_vehiculo][1] or $proyecto=='0');
    //echo '*****'.$proyecto.'=='.$asig_regional[$reg->id_vehiculo][1] .' or '. $proyecto.'==0 <br>';

    if ($selec_depar == $asig_departamento[$reg->id_vehiculo] or $selec_depar == '0') {
        // echo 'pregunta '.$asig_regional[$reg->id_vehiculo][1].'==Proyecto';
        if ($asig_regional[$reg->id_vehiculo][1] == 'Proyecto') {
            //echo 'proy*';
            //echo 'verdad.....'.$proyecto_selec.'='.$asig_regional[$reg->id_vehiculo][0];
            $llave = ($proyecto_selec == $asig_regional[$reg->id_vehiculo][0]);
        } else {

            // echo 'tipo ***';
            if ($asig_regional[$reg->id_vehiculo][1] == 'Taller') {
                
                // echo 'falso........'.$proyecto_selec.'='.$asig_regional[$reg->id_vehiculo][0];
                $llave = ($proyecto_selec == $asig_regional[$reg->id_vehiculo][1]);
            } else {
                $llave = ($proyecto_selec == $asig_regional[$reg->id_vehiculo][0]);
            }
        }

        //echo 'llave'.$llave.'<br>';
        if ($llave or $proyecto_selec == '0') {
            $cambiar_f='cambio_fondo';
            if ($reg->estado == "Activo") {
                if ($asig_nacional[$reg->id_vehiculo][1] == "Libre") {
                       

                    $asig_res="<div  title='Asignar a Responsable' class='asig_vehiculo milink' 
                          onclick='dialog_asignar_responsable_vehiculo(\"div_formularios_dialog\",\"". base_url() . "vehiculo/asignar_responsable_vehiculo/".$reg->id_vehiculo."/0\",\"Asignar a Responsable\")'>
                    </div>";
                 } else {
                      $asig_res="<div  title='editar y/o devolver' class='edit_devolucion milink' 
                          onclick='dialog_edita_devolucion_asignar_responsable_vehiculo(\"div_formularios_dialog\",\"". base_url() . "vehiculo/edita_devolucion_asignado_responsable/".$reg->id_vehiculo."/". $asig_nacional[$reg->id_vehiculo][0]."\",\"Editar asignacion a Responsable\")'>
                    </div>";
                    
                     
                     
                   
                }
            } else if ($reg->estado == "Inactivo") {
                
                   $asig_res= '<div class="novehiculo" title="Inactivo"></div>';
                    $cambiar_f='fila_disabled';
        }
        
        
        
            
        
            ?>
               
                    
                    
        <div class='div1150 borde_abajo espaciado5 <?php echo $cambiar_f?>' style="margin: 0;" >
                    <div class="f12 alin_cen colorGuindo negrilla" style="display: block-inline;width: 30px;float: left; ">
                        <div style="display: block; ">
                     <?php if ($reg->id_vehiculo != "") echo $reg->id_vehiculo; else echo "&nbsp;" ?></div>               
                    </div>
                    <div class="f12 alin_cen colorAzul negrilla" style="display: block-inline;  width: 20px; float: left;margin-left: 5px; margin-right: 5px">
                        <div class="editvehiculo " title="Editar datos vehiculo" onclick="dialog_nuevo_vehiculo_adicionar('div_formularios_dialog','<?php echo base_url() . "vehiculo/adicionar_nuevo_vehiculo/$reg->id_vehiculo"; ?>','Editar Vehiculo')"></div>
                    </div>
            <?php if($reg->contrato=="Alquilado")
                    $es="colorAzul";
                else
                    $es="colorcel";    ?>
                    <div class="f14 alin_cen  <?php echo $es;?>  negrilla mayusculas milinktext" style="display: block-inline;  width: 60px; float: left;margin-left: 5px; margin-right: 5px" 
                         onclick="dialog_subir_archivos_vehiculo('subida_imagen','<?php echo base_url() . 'vehiculo/nuevo_imagen_vehiculo/' . $reg->id_vehiculo; ?>')">
                        <div style="display: block; "><?php if ($reg->placa != "") echo $reg->placa; else echo "&nbsp;" ?></div>
                    </div>
                    <div  title="Ver historial" class="ver_historial milink" 
                          onclick="dialog_historial_de_asignaciones_vehiculo('div_formularios_dialog','<?php echo base_url() . "vehiculo/ver_historial_de_asig_vehiculos/$reg->id_vehiculo"; ?>','Ver historial')">
                    </div>

                    <div class="f10 alin_izq" style="display: block-inline;  width: 80px; float: left;margin-left: 5px; margin-right: 5px">
                        <div style="display: block; "><?php if ($reg->modelo != "") echo $reg->modelo; else echo "&nbsp;" ?></div>
                    </div>

                    <div class="f12 alin_cen" style="display: block-inline;  width: 20px; float: left;margin-left: 5px; margin-right: 5px">              
                        <div style="display: block; "><?php if ($reg->capacidad != "") echo $reg->capacidad; else echo "&nbsp;" ?></div>
                    </div>
                    <div class="f10 alin_izq" style="display: block-inline;  width: 70px; float: left;margin-left: 5px; margin-right: 5px">              
                        <div style="display: block; "><?php if ($reg->marca != "") echo $reg->marca; else echo "&nbsp;" ?></div>
                    </div>

                    <div class="f12 alin_cen"style="display: block-inline;  width: 70px; float: left;margin-left: 5px; margin-right: 5px">              
                        <div style="display: block; "><?php if ($reg->fecha_adquirida != "") echo $reg->fecha_adquirida; else echo "&nbsp;" ?></div>
                    </div>
                    <div class="f12 alin_izq negrilla"style="display: block-inline;  width: 85px; float: left;margin-left: 5px; margin-right: 5px">              
                        <div style="display: block; "><?php echo $asig_departamento[$reg->id_vehiculo]; ?></div>
                    </div>

                    <div class="f12 alin_izq"style="display: block-inline;  width: 130px; float: left;margin-left: 5px; margin-right: 5px">              
                        <div style="display: block; "><?php if ($reg->accesorios != "") echo $reg->accesorios; else echo "&nbsp;" ?></div>
                    </div>

                    <div class="f12 alin_izq mayusculas" style="display: block-inline;  width: 100px; float: left;margin-left: 5px; margin-right: 5px">              
                        <div style="display: block; "><?php echo $asig_nacional[$reg->id_vehiculo][1]; ?></div>
                    </div>
                    <div class="f12 alin_izq negrilla mayusculas" style="display: block-inline;  width: 100px; float: left;margin-left: 5px; margin-right: 5px">              
                        <div style="display: block; "><?php if ($asig_regional[$reg->id_vehiculo][0] != "") echo $asig_regional[$reg->id_vehiculo][0]; else echo "&nbsp;" ?></div>
                    </div>
                    <div class="f12 alin_izq " style="display: block-inline;  width: 50px; float: left;margin-left: 5px; margin-right: 5px">              
                        <div style="display: block; "><?php if ($asig_regional[$reg->id_vehiculo][2] != "") echo $asig_regional[$reg->id_vehiculo][2]; else echo "&nbsp;" ?></div>
                    </div>
            <?php
            if($estado_vehi[$reg->id_vehiculo][0] != "" && $estado_vehi[$reg->id_vehiculo][1] != "")
             $promedio=  round(($estado_vehi[$reg->id_vehiculo][0]+$estado_vehi[$reg->id_vehiculo][1])/2);
             $estado_stilo="fondoRojo_estado";
             if($promedio>3)
                  $estado_stilo="fondoAmarillo_estado";
             if($promedio>6)
                  $estado_stilo="fondo_verde";
             
                 
            ?>
            <div class=" alin_cen <?php echo $estado_stilo;?>" style="width:80px;display: block-inline;float: left">
                        <div class="f12 " style="display: block-inline;  width: 30px; float: left;margin-left: 5px; margin-right: 5px">              
                            <div style="display: block; "><?php if ($estado_vehi[$reg->id_vehiculo][0] != "") echo $estado_vehi[$reg->id_vehiculo][0]; else echo "&nbsp;" ?></div>
                        </div>
                        <div class="f12"style="display: block-inline;  width: 30px; float: left;margin-left: 5px; margin-right: 5px">              
                            <div style="display: block; " ><?php if ($estado_vehi[$reg->id_vehiculo][1] != "") echo $estado_vehi[$reg->id_vehiculo][1]; else echo "&nbsp;" ?></div>
                        </div>
                    </div>
                    <div class="f10 alin_izq colorAzul "style="display: block-inline;  width: 50px; float: left;margin-left: 5px; margin-right: 5px">              
                        <div style="display: block; "><?php if ($estado_vehi[$reg->id_vehiculo][3] != "") echo $estado_vehi[$reg->id_vehiculo][3]; else echo "&nbsp;" ?></div>
                    </div>


<?php echo $asig_res;?>

                </div>





            </div>


        <?php
        }
    }
}

?> 
<script>
$("#t_vehi").html(<?php echo $t_vehi; ?>);
$("#t_alq").html(<?php echo $t_alq; ?>);
$("#t_pro").html(<?php echo $t_prop; ?>);
$("#t_act_pro").html(<?php echo $t_act_pro; ?>);
$("#t_inac_pro").html(<?php echo $t_inac_pro; ?>);
$("#t_bueno").html(<?php echo $t_veh_bue; ?>);
$("#t_reg").html(<?php echo $t_veh_reg; ?>);
$("#t_pesi").html(<?php echo $t_veh_pes;?>);

</script>
