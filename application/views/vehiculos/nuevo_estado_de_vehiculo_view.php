

<?php
$est_mec = "";
$est_carr = "";
$kilom = "";
$est_llan = "";
$observacion = "";
//$placa="";

if ($id_esta!= 0) {

    
   $observacion = $estado_vehiculo->row(0)->observacion_estado;
   $est_carr=$estado_vehiculo->row(0)->estado_carroceria;
   $kilom=$estado_vehiculo->row(0)->kilometraje;
   $est_llan=$estado_vehiculo->row(0)->estado_llantas;
   $est_mec=$estado_vehiculo->row(0)->estado_mecanico;
}
?>
<div class="">
<div id="respuesta"></div>
<input class="input_redond_250" type="hidden" id="id_vehic" value="<?php echo $id_vehi ?>">
<input class="input_redond_250" type="hidden" id="id_esta" value="<?php echo $id_esta ?>">
<div class="grid_8" >
    <div class="grid_3 espder10">
        <input class="input_redond_150" type="text" readonly="readonly" id="id_vehi" placeholder=" Nro. de placa" value="<?php echo $dato_vehiculo->row(0)->placa;?>">

    </div>
    <div class="grid_3 ">
        <input class="input_redond_150" type="text" id="est_llan"  placeholder="" value="<?php echo $est_llan; ?>"> 
    </div>
</div>
<div class="grid_8 espabajo10 ">
    <div class="grid_3 " style="padding-right:  60px;" ><div class="f10 negrilla "> Placa del vehículo</div></div> 
    <div class="grid_3 " ><div class="f10 negrilla "> Estado llantas</div></div>
</div>
<?php
/*    foreach ($ultimo_est_vehi->result() as $reg) {
        if($id_esta != 0){
            $est_mec = $reg->estado_mecanico;
            $est_carr = $reg->estado_carroceria;
            $kilom = $reg->kilometraje;
            $est_llan = $reg->estado_llantas;
        }  
  */     
?>
   <div class="grid_8">

    <div class="grid_2 alin_cen" style="padding-right:  50px;">
        <input class="input_redond_50" type="text" id="kilom"  placeholder="" value="<?php echo $kilom; ?>"> 
    </div>
    <div class="grid_2 alin_cen" style="padding-right:  40px;">
        <input class="input_redond_50" type="text" id="est_mec" placeholder="" value="<?php echo $est_mec; ?>"> /10
    </div>
    <div class="grid_3 alin_cen" style="padding-right:  10px;">
        <input class="input_redond_50 " type="text" id="est_carr" placeholder="" value="<?php echo $est_carr; ?>"> /10
    </div>
</div>
<?php //}
?>
<div class="grid_8 espabajo10 alin_cen ">
    <div class="grid_2 " style="padding-right:  22px;">
        <div class="f10 negrilla "> Kilometraje</div>   
    </div>
    <div class="grid_2 " style="padding-right:  23px;" >
        <div class="f10 negrilla"> Estado mecanico</div>
    </div>
    <div class="grid_2 espder10" >
        <div class="f10 negrilla"> Estado carroceria</div>   
    </div>
</div>


<div class="grid_8">
    
    <textarea id="obser_estado" class="textarea_redond_250x37" type="text"  placeholder="Introduzca las observaciones"><?php echo $observacion; ?></textarea>
<div class="f10 negrilla"> Observaciones</div>
</div>

</div>


