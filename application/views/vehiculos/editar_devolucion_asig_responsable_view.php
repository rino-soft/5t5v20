
<?php if ($estado_vehi->num_rows() > 0) {?>


<?php
if($id_asignado!=0){

//$depar="";
$fe_asig="";
$fecha_hora_dev="";
$estado_mecanico=$estado_vehi->row(0)->estado_mecanico;
$estado_carroceria=$estado_vehi->row(0)->estado_carroceria;
$estado_llantas=$estado_vehi->row(0)->estado_llantas;
$id_estado_vehi=$estado_vehi->row(0)->id_estado_vehi;
//$selec_ciudad="";

$observaciones="";


?>

<div id="respuesta"></div>
      <input type="hidden" id="id_asig" value="<?php echo $id_asignacion_dato;?>">
      <input type="hidden" id="id_estado" value="<?php echo $estado_vehi->row(0)->id_estado_vehi; ?>">
       <input type="hidden" id="id_vehiculo_resp" value="<?php echo $dato_asignado->id_vehiculo_resp; ?>">
       <input type="hidden" id="asignado" value="<?php echo $dato_asignado->id_responsable; ?>">


    <div class="grid_12 f10 fondo_plomo_claro_areas ">
        <div class="grid_12">
            
            <div style="" class="bordeado mayusculas f12 colorBlanco fondo_azul alin_cen"> Persona asignada:
             <?php echo $per_a_asignar->nombre." ".$per_a_asignar->ap_paterno." ".$per_a_asignar->ap_materno;?></div>

            
        </div>
        <div class="grid_12" style="padding-top: 10px">
            <div class="grid_3 f11 negrilla" style="">Departamento:</div>  

            <div class="grid_3 mayusculas"> 
                <?php if($selec_ciudad->nombre !="") echo $selec_ciudad->nombre; else echo "&nbsp;" ?> </div>
            </div>
        </div>  
    <div class="grid_12 f10 fondo_plomo_claro_areas " style="padding-top: 10px">
        <div class="grid_3 f11 negrilla">Fecha de asignacion:</div>
        <div class="grid_2">
          <?php if($dato_asignado->fecha_hora_asig !="") echo $dato_asignado->fecha_hora_asig; else echo "&nbsp;"?> 
        </div>  
        <div class=" grid_3 f10 negrilla">Fecha de devolución</div>
        <div class="grid_4 alin_cen fondo_verde_claro" style="" >
            <input class="input_redond_180 " id="fecha_hora_dev" title="Editar fecha devolucion" value="<?php echo $dato_asignado->fecha_hora_devolucion; ?>">
            <script>$("#fecha_hora_dev").datepicker();</script>
        </div>
    </div>
    <div class="grid_12 mayusculas negrilla f12 esparriba10 espabajo10">Estado vehicular asignado:</div>
    <div class="grid_12 esparriba10 alin_cen borde_abajo borde_arriba borde_der fondo_amarillo">
        <div class="f10 negrilla grid_4 "> Estado Mecanico</div>
        <div class="f10 negrilla grid_4 alin_cen"> Estado Carroceria</div>
        <div class="f10 negrilla grid_4 alin_cen"> Estado llantas</div>
    </div>
    <div class="grid_12 alin_cen esparriba10 borde_abajo borde_arriba borde_der borde_izq">

        <div id="est_mecanico" style="display: block;" class="grid_4 espizq10"><?php if($estado_mecanico!="") echo $estado_mecanico; else echo "&nbsp;"?></div>
        <div id="est_carroceria" style="display: block;" class="grid_3 espizq10"><?php if($estado_carroceria !="") echo  $estado_carroceria; else echo "&nbsp;"?></div>
        <div id="est_llantas" style="display: block;" class="grid_4 espizq10"><?php if($estado_llantas !="") echo  $estado_llantas; else echo "&nbsp;"?></div>
    </div>
    <div class="grid_12 esparriba10 " >
         <textarea class="textarea_redond_356x100" type="text" title="Editar Observaciones" id="observaciones" placeholder="Observaciones del vehiculo"  ><?php echo $dato_asignado->observaciones; ?></textarea>
         <div class="f10 negrilla"> Observaciones</div>
    </div>

     <div class="grid_12 negrilla colorGuindo mayusculas esparriba10  borde_arriba">Devoluciones</div>

<div class="grid_12 espabajo10 esparriba10" >
    <input type="hidden" value="<?php echo $id_vehiculo?>">
    <div class=" grid_2 boton2 f10 negrilla alin_cen " style="width: 95px; " onclick="dialog_nuevo_estado_vehiculo('ayudita_estado','<?php echo base_url() . "vehiculo/nuevo_estado_vehiculo/$id_vehiculo"; ?>/0')"><?php echo "Nuevo estado"; ?></div>
</div>



<div id="ayudita_estado"></div>
<?php } ?>

<?php
if(($dato_asignado->estado_registro)=="Activo"){
    echo "<script> $('#editar').button('enable');
        $('#devolucion').button('enable');</script>";   
}else{
    echo "<script> $('#editar').button('disable');
        $('#devolucion').button('disable');</script>";
}


?>







<?php } 

else{ ?>
    <div class="grid_10 fondo_rojo_claro borde_abajo borde_arriba borde_der borde_izq">
        El vehiculo no tiene un estado!!! 
    </div>

    <div class="grid_10 espabajo10 esparriba10 fondo_amarillo borde_abajo borde_arriba borde_der borde_izq" >
    <div class=" grid_2 boton2 f10 negrilla alin_cen " style="width: 95px; " onclick="dialog_nuevo_estado_vehiculo('ayudita_estado','<?php echo base_url() . "vehiculo/nuevo_estado_vehiculo/$id_vehiculo"; ?>/0')"><?php echo "Nuevo estado"; ?></div>
    </div>
    <div id="ayudita_estado"></div>
    <div id="respuesta"></div>
 <?php }?>