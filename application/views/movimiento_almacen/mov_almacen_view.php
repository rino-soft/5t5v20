<?php
$id_ma="";$fhr="";$tm="";$proy="";$com="";$rub="";
$id_ma_llave=""; 
echo $id_send;
if($id_send!=0)
{
    $id_ma->id_mov_alm;
    $id_ma_llave="readonly='readonly'";
    $fhr=$d_almacen->fh_reg;
    $tm=$d_almacen->tipo_movimiento;
    
//$proy=$d_almacen->proyecto;
    //$com=$d_almacen->comentario;
    //$rub=$d_almacen->comentario;
}
?>


<div>
        <div >Ingrese los Datos del <span class="negrilla">Movimiento Almacen</span></div>
        <hr>
    <div > 
        
        <input class="input_redond_350" type="hidden" id="id_ov_pf" value="<?php echo $id_send;?>"></div>
        <input class="input_redond_350" type="text" id="rs" <?php echo $id_ma_llave; ?>  placeholder="ID" value="<?php echo $id_ma ;?>"></div>
    <div class="f10 negrilla"> Id</div>
    
    
    <div > <input class="input_redond_350" type="text" id="nit" <?php echo $id_ma_llave; ?> placeholder="tm" value="<?php echo $fhr ;?>"></div>
    <div class="f10 negrilla"> Tipo Movimiento</div>
    <div > <input  class="input_redond_350"type="text" id="tel" placeholder="proyecto" value="<?php echo $tm ;?>"></div>
    <div class="f10 negrilla"> Proyecto</div>
    <div > <input class="input_redond_350" type="text" id="dir" placeholder="comentario" value="<?php echo $tm ;?>"></div>
    <div class="f10 negrilla"> Comentario</div>
    <div > <input class="input_redond_350" type="text" id="rub" placeholder="comentario" value="<?php echo $tm ;?>" ></div>
    <div class="f10 negrilla"> Comentario</div>
    <input type="text" value="no" id="cambios"> 
</div>
<script>cambios_form();</script>