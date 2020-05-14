
<?php if ($estado_vehi->num_rows() > 0) {?>

<?php

//$id_estado_vehi = "";
$asignado="";
$observaciones = "";
$fecha_hora_asig = "";
$fecha_hora_dev="";
$ciudad_asig="";

$estado_llantas="";
$estado_mecanico="";
$estado_carroceria="";
$id_estado_vehi="";
$observacion_estado="";

if($id_send!=0)
  {
    if($id_asignacion_dato==0)
     {
        $fecha_hora_asig="";
        $fecha_hora_dev="";
        $estado_mecanico= $estado_vehi->row(0)->estado_mecanico;
        $estado_llantas=$estado_vehi->row(0)->estado_llantas;
        $estado_carroceria=$estado_vehi->row(0)->estado_carroceria;
        $id_estado_vehi=$estado_vehi->row(0)->id_estado_vehi;
        
        $observacion_estado=$estado_vehi->row(0)->observacion_estado;
    }else{
        $fecha_hora_asig=$datos_vehi_asig->fecha_hora_asig;
        $fecha_hora_dev=$datos_vehi_asig->fecha_hora_devolucion;
        
        $estado_mecanico= $estado_vehi->row(0)->estado_mecanico;
        $estado_llantas=$estado_vehi->row(0)->estado_llantas;
        $estado_carroceria=$estado_vehi->row(0)->estado_carroceria;
        $id_estado_vehi=$estado_vehi->row(0)->id_estado_vehi;
       
        $observacion_estado=$datos_vehi_asig->observaciones;
        
    }
  }
      
?>
<div id="respuesta"></div>
<input type="hidden" id="id_vehiculo_resp" value="<?php echo $id_send; ?>">
<input type="hidden" id="id_estado" value="<?php echo $id_estado_vehi; ?>">
<input type="hidden" id="id_asig" value="<?php echo $id_asignacion_dato?>">


<div class="grid_10 espabajo10" style="height: 30px">
    <div class="grid_6  f10 negrilla">Personal a asignar:
        <select id="asignado" onchange=""> 

            <?php
            foreach ($per_a_asignar->result() as $usuario) {
                if ($usuario->cod_user == $asignado)
                    echo '<option selected="selected" value="' . $usuario->cod_user . '">' . $usuario->nombre .' '.$usuario->ap_paterno .' '.$usuario->ap_materno. '</option>';
                else
                    echo ' <option value="' . $usuario->cod_user . '">'. $usuario->ap_paterno .' '.$usuario->ap_materno.', ' . $usuario->nombre .'</option>';
            }
            ?>

        </select>
    </div>

    <div class="grid_4  f10 negrilla">Departamento:
        
     
        <select id="ciudad_asignar" >

            <?php
            foreach ($selec_ciudad->result() as $ciudad) {
                //echo 'elegido'.$ciudad;
                
                if ($ciudad->codciudad_pk == $ciudad_asig)
                    echo ' <option selected="selected" value="' . $ciudad->codciudad_pk . '">' . $ciudad->nombre . '</option>';

                else
                    echo ' <option value="' . $ciudad->codciudad_pk . '">' . $ciudad->nombre . '</option>';
            }
            ?>

        </select>
    </div>
</div>

<div class="grid_10 espabajo10 alin_cen fondo_plomo_claro_areas" style="">

    <div class="grid_5 espabajo10 " style="">
        <input class="input_redond_180" id="fecha_hora_asig" placeholder="Escriba la fecha de Adquisición" value="<?php echo $fecha_hora_asig; ?>">
        <div class="f10 negrilla">Fecha de asignación</div>
        <script>$("#fecha_hora_asig").datepicker();</script>
    </div>
    <div class="grid_5 espabajo10 " style="" >
        <input class="input_redond_180 " id="fecha_hora_dev" placeholder="Escriba la fecha de Adquisición" value="<?php echo $fecha_hora_dev; ?>">
        <div class="f10 negrilla">Fecha de devolución</div>
        <script>$("#fecha_hora_dev").datepicker();</script>
    </div>
</div>

<div class="grid_10 esparriba10 alin_cen  fondo_azul colorBlanco borde_arriba borde_der borde_izq borde_abajo">
    <div class="f10 negrilla grid_3 "> Estado Mecanico</div>
    <div class="f10 negrilla grid_3 alin_cen"> Estado Carroceria</div>
    <div class="f10 negrilla grid_3 alin_der"> Estado llantas</div>
</div>
<div class="grid_10 alin_cen esparriba10 borde_abajo borde_arriba borde_der borde_izq">
   
    <div id="est_mecanico" style="display: block;" class="grid_3 espizq10"><?php echo  $estado_mecanico; ?></div>
    <div id="est_carroceria" style="display: block;" class="grid_3 espizq10"><?php echo $estado_carroceria; ?></div>
    <div id="est_llantas" style="display: block;" class="grid_3 espizq10"><?php echo $estado_llantas; ?></div>
</div>

<div class="grid_10 espabajo10 esparriba10 fondo_amarillo borde_abajo borde_arriba borde_der borde_izq" >
    <div class=" grid_2 boton2 f10 negrilla alin_cen " style="width: 95px; " onclick="dialog_nuevo_estado_vehiculo('ayudita_estado','<?php echo base_url() . "vehiculo/nuevo_estado_vehiculo/$id_send"; ?>/0')"><?php echo "Nuevo estado"; ?></div>
</div>
<div class="grid_10 " >
    <textarea class="textarea_redond_502x62" type="text" id="observaciones" placeholder="Escriba observaciones"  ><?php echo $observacion_estado; ?></textarea>
    <div class="f10 negrilla"> Observaciones</div>
</div>
<div id="ayudita_estado"></div>


<?php } 

else{ ?>
    <div class="grid_10 fondo_rojo_claro">
        El vehiculo no tiene un estado!!! Usted debe actualizar el estado vehicular
    </div>
     <input type="hidden" id="id_vehiculo_resp" value="<?php echo $id_send; ?>">
    <div class="grid_10 espabajo10 esparriba10 fondo_amarillo borde_abajo borde_arriba borde_der borde_izq" >
    <div class=" grid_2 boton2 f10 negrilla alin_cen " style="width: 95px; " onclick="dialog_nuevo_estado_vehiculo('ayudita_estado','<?php echo base_url() . "vehiculo/nuevo_estado_vehiculo/$id_send"; ?>/0')"><?php echo "Nuevo estado"; ?></div>
    </div>
    <div id="ayudita_estado"></div>
    
 <?php }?>

