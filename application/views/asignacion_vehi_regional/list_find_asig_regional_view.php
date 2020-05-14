<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of list_find_asig_regional_view
 *
 * @author POMA RIVERO
 */


?>
<?php if ($asignaciones->num_rows() > 0) { ?>
    <div style="display: table; width: 100%" class="container_20">
        <div class="alin_cen  NO_reg espabajo5"><span class="f14 negrilla">MIS ASIGNACIONES!!!...</span></div>

       <!-- <div style="display: block; width: 100%" class="bordeado grid_4 fondo_azul  mayusculas f12 colorBlanco alin_cen"> <?php //echo $datos_usuario->nombre . " " . $datos_usuario->ap_paterno . " " . $datos_usuario->ap_materno; ?></div>-->
        <div class='grid_20 fondo_azul colorAmarillo negrilla borde_abajo borde_arriba borde_der borde_izq espabajo5 esparriba5 alin_cen ' style="width: 100%">         
            
            <div class="f14 negrilla" style="display: block-inline;width: 50px;float: left ">ID_V</div>
            <div class="f14 negrilla" style="display: block-inline;width: 70px;float: left ">Placa</div>
            <div class="f14 negrilla" style="display: block-inline;width: 80px;float: left ">Fecha asignada</div>
            <div class="f14 negrilla" style="display: block-inline;width: 80px;float: left ">Fecha devolucion</div>
            <div class="f14 negrilla" style="display: block-inline;width: 150px;float: left ">Obs.de Entrega</div>
            
            <div class="f14 negrilla" style="display: block-inline;width: 80px;float: left ">
                
                <div class="f14 negrilla milink" style="display: block-inline;" onclick='
                    if($("#mostrar_selec").is(":visible"))
                     {
                               $("#mostrar_selec").css("display","none" );  
                     }else{
                              $("#mostrar_selec").css("display","block" );
                          }
                '>Depto.</div>
                <div style="display:none" id="mostrar_selec">
                    <select id="ciudad_asig" style="font-size: 10px;" onchange="search_and_asignaciones_regional('lista_asig_regional');">
                    <?php 
                        if($selec_depar=="0")
                            echo '<option selected="selected" value="0">Todos</option>';
                       else
                           echo '<option value="0">Todos</option>';
                       foreach ($selec_ciudad->result() as $ciudad)
                           {
                          
                           if($ciudad->nombre==$selec_depar)
                               echo '<option selected="selected" value="' . $ciudad->nombre . '">' . $ciudad->nombre . '</option>';
                           else 
                               echo ' <option value="' . $ciudad->nombre . '">' . $ciudad->nombre . '</option>';
                           }
                           if($selec_depar=='Sin asignacion')
                               echo '<option selected="selected" value="Sin asignacion">Sin asignacion</option>';
                           else
                               echo '<option value="Sin asignacion">Sin asignacion</option>';
                    ?>
                    </select>            
                </div>
                
            </div>
            
            
            
            <div class="f14 negrilla" style="display: block-inline;width: 80px;float: left ">Subcentro</div>
            <div class="f14 negrilla" style="display: block-inline;width: 150px;float: left ">Asignado a:</div>
            
            <div class="f14 negrilla" style="display: block-inline;width: 150px;float: left ">
                    <div class="milink" style="display: block;" onclick='
                    if($("#mostrar_selec").is(":visible")){
                        $("#mostrar_selec2").css("display","none" );  
                    }else{
                        $("#mostrar_selec2").css("display","block" );
                    }

                     '>Proyecto/Taller</div> 
                
                    <div style="display:none" id="mostrar_selec2"> 
                    <select id="proyecto_date" style="font-size: 10px;" onchange="search_and_asignaciones_regional('lista_asig_regional');">
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
            
            
            <div class="f12 negrilla"style="display: block-inline;  width: 150px; float: left">
            <div style="display: block; ">Estado vehicular</div>
                <div class="mecanico milink" title="Estado mecanico" ></div>
                <div class="carroceria milink" title="Estado carroceria"></div>
                <div class="llanta milink alin_der" title="Estado llantas"></div>
            </div>
            <div class="f14 negrilla" style="display: block-inline;width: 80px;float: left ">Est. Uso</div>
       
      
    

        </div>

        <?php foreach ($asignaciones->result() as $reg) {  //echo $selec_depar. '=='. $dato_asig_proy_ta[$reg->id_vehiculo_resp][4];
            if($selec_depar == $dato_asig_proy_ta[$reg->id_vehiculo_resp][4] or $selec_depar == '0'){
            
                    if ($dato_asig_proy_ta[$reg->id_vehiculo_resp][7] == 'Proyecto') {

                        $llave = ($proyecto_selec == $dato_asig_proy_ta[$reg->id_vehiculo_resp][1]);
                    } else {

                        if ($dato_asig_proy_ta[$reg->id_vehiculo_resp][7] == 'Taller') {

                            $llave = ($proyecto_selec == $dato_asig_proy_ta[$reg->id_vehiculo_resp][7]);
                        } else {
                            $llave = ($proyecto_selec == $dato_asig_proy_ta[$reg->id_vehiculo_resp][1]);
                        }
                    }

                    //echo 'llave'.$llave.'<br>';
                    if ($llave or $proyecto_selec == '0') {
                        $cambiar_f='cambio_fondo';
                        $asig_res="<br>";
                        if($reg->estado=="Activo")
                         {
                                if ($dato_asig_proy_ta[$reg->id_vehiculo_resp][1] == "Libre") 
                             {
                            

                                  $asig_res="<div title='Asignar a Responsable' class='asig_vehiculo milink' 
                                 onclick='dialog_asignar_vehiculo_taller_proyecto(\"div_formularios_dialog\",\"". base_url() . "asignacion_vehiculo_regional/asignar_vehiculo_proy_ta/".$reg->id_vehiculo_resp."/0\",\"Asignar vehiculo\")'>
                                   </div>";  

                                     
                             } else { 
                               $asig_res="<div title='editar y/o devolver' class='edit_devolucion milink' 
                                 onclick='dialog_edita_devolucion_asignar_vehiculo(\"div_formularios_dialog\",\"". base_url() . "asignacion_vehiculo_regional/edita_devolucion_asignado_vehiculo/".$reg->id_vehiculo_resp."/".$dato_asig_proy_ta[$reg->id_vehiculo_resp][0]."\",\"Editar asignacion vehiculo\")'>
                                 </div>"; 
                                }
                
                           }
                
                
            ?>
            <div class='grid_20  borde_abajo  cambio_fondo esparriba10 alin_cen' style="width: 100%" >
                <div class="f12 colorGuindo negrilla" style="display: block-inline;width: 50px;float: left; ">
                    <?php if ($reg->id_vehiculo_resp != "") echo $reg->id_vehiculo_resp;else echo " &nbsp;" ?>
                </div>
                <div class="f14 colorcel negrilla" style="display: block-inline;  width: 70px; float: left;margin-left: 5px; margin-right: 5px">
                     <?php if ($datos_vehiculo[$reg->id_vehiculo_resp][0]!="") echo $datos_vehiculo[$reg->id_vehiculo_resp][0];else echo " &nbsp;" ?>
                </div>

                <div class="f12 " style="display: block-inline;width: 80px;float: left; ">
                    <?php if ($reg->fecha_hora_asig != "") echo $reg->fecha_hora_asig;else echo " &nbsp;" ?>
                </div>
                <div class="f12 fondoAzul_regional" style="display: block-inline;width: 80px;float: left;">
                    <?php if($dato_asig_proy_ta[$reg->id_vehiculo_resp][5]!="") echo $dato_asig_proy_ta[$reg->id_vehiculo_resp][5]; else echo "&nbsp;" ?>
                </div>
                <div class="f12 alin_izq " style="display: block-inline;width: 150px;float: left;  ">
                    <?php if($dato_asig_proy_ta[$reg->id_vehiculo_resp][6]!="") echo $dato_asig_proy_ta[$reg->id_vehiculo_resp][6]; else echo "&nbsp;" ?>
                </div>
                <div class="f12 alin_izq negrilla" style="display: block-inline;  width: 80px; float: left;">              
                    <?php if($dato_asig_proy_ta[$reg->id_vehiculo_resp][4]!="") echo $dato_asig_proy_ta[$reg->id_vehiculo_resp][4]; else echo "&nbsp;" ?>
                </div>
                <div class="f12 alin_cen negrilla" style="display: block-inline;  width: 80px; float: left;">              
                    <?php if($dato_asig_proy_ta[$reg->id_vehiculo_resp][3]!="") echo $dato_asig_proy_ta[$reg->id_vehiculo_resp][3]; else echo "&nbsp;" ?>
                </div>
                <div class="f12 alin_cen" style="display: block-inline;  width: 150px; float: left;">              
                    <?php if($dato_asig_proy_ta[$reg->id_vehiculo_resp][2]!="") echo $dato_asig_proy_ta[$reg->id_vehiculo_resp][2]; else echo "&nbsp;" ?>
                </div>
                <div class="f12 alin_izq negrilla "style="display: block-inline;  width: 150px; float: left;">              
                    <?php if($dato_asig_proy_ta[$reg->id_vehiculo_resp][1]!="") echo $dato_asig_proy_ta[$reg->id_vehiculo_resp][1]; else echo "&nbsp;" ?>
                </div>
                <?php 
                    if($estado_vehi[$reg->id_vehiculo_resp][0]!="" && $estado_vehi[$reg->id_vehiculo_resp][1] != "")
                     $promedio=  round(($estado_vehi[$reg->id_vehiculo_resp][0]+$estado_vehi[$reg->id_vehiculo_resp][1])/2);
                     $estado_stilo="fondoRojo_estado";
                     if($promedio>3)
                          $estado_stilo="fondoAmarillo_estado";
                     if($promedio>6)
                          $estado_stilo="fondo_verde";
                
                ?>
                
                
               <div class=" alin_cen <?php echo $estado_stilo;?>" style="width:80px;display: block-inline;float: left"> 
                    <div class="f12 alin_izq " style="display: block-inline;  width: 30px; float: left;margin-left: 5px; margin-right: 5px">              
                            <?php if($estado_vehi[$reg->id_vehiculo_resp][0]!="") echo $estado_vehi[$reg->id_vehiculo_resp][0]; else echo "&nbsp;"?>
                    </div>
                    <div class="f12 alin_izq"style="display: block-inline;  width: 30px; float: left;margin-left: 5px; margin-right: 5px">              
                            <?php if($estado_vehi[$reg->id_vehiculo_resp][1]!="") echo $estado_vehi[$reg->id_vehiculo_resp][1]; else echo "&nbsp;"?>
                    </div>
               </div>
                <div class="f10 alin_izq colorAzul"style="display: block-inline;  width: 80px; float: left;margin-left: 5px; margin-right: 5px">              
                         <?php if($estado_vehi[$reg->id_vehiculo_resp][3]!="") echo $estado_vehi[$reg->id_vehiculo_resp][3]; else echo "&nbsp;" ?>
                </div>
               
                
            
                <input type="hidden" value="<?php echo $reg->id_asig_reponsable?>">

                <?php ///error que es esto????????????????
              echo $asig_res;
                ?> 
              
               
                    </div>
        </div>         
      
    <?php } 
        }
        }?>
    
    <?php
}else {
    echo 'No se encontro ninguna asignación!!!';
}
?>
<script>
    $("#t_vehi_asig").html(<?php echo $t_vehi_asig?>);
    $("#t_bueno").html(<?php echo $t_veh_bue; ?>);
    $("#t_reg").html(<?php echo $t_veh_reg; ?>);
    $("#t_pesi").html(<?php echo $t_veh_pes;?>);
</script>