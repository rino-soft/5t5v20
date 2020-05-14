<?php
$fhr="";$tm="";$proy="";$com="";$tdo="";$dr="";
$rs_llave=""; 
echo $id_send;
if($id_send!=0)
{
    $fhr=$d_i->fh_reg;
    $rs_llave="readonly='readonly'";
    $tm=$d_i->tipo_movimiento;
    $proy=$d_i->proyecto;
    $com=$d_i->comentario;
    $tdo=$d_i->tipo_doc_origen;
    $dr=$d_i->doc_respaldo;
}
?>


<div>
        <div >Ingrese los Datos del <span class="negrilla">Movimiento de Almacen</span></div>
        <hr>
    <div ><input class="input_redond_350" type="hidden" id="id_i" value="<?php echo $id_send;?>"></div>
    <div class="f10 negrilla"> Fecha/Hora registro</div>
    <div ><input class="input_redond_350" type="text" id="fhr" <?php echo $rs_llave; ?>  placeholder="Fecha/Hora registro" value="<?php echo $fhr ;?>"></div>
    <div class="f10 negrilla"> Tipo Movimiento</div>
    <div > <input class="input_redond_350" type="text" id="tm" <?php echo $rs_llave; ?> placeholder="Tipo Movimiento" value="<?php echo $tm ;?>"></div>
    <div class="f10 negrilla"> Proyecto</div>
    <div > <input  class="input_redond_350"type="text" id="proy" placeholder="Proyecto" value="<?php echo $proy ;?>"></div>
    <div class="f10 negrilla"> Comentario</div>
    <div > <input class="input_redond_350" type="text" id="com" placeholder="Comentario" value="<?php echo $com ;?>"></div>
    <div class="f10 negrilla"> Tipo Documento Origen</div>
    <div > <input class="input_redond_350" type="text" id="tdo" placeholder="tipo Documento Origen" value="<?php echo $tdo ;?>" ></div>
    <div class="f10 negrilla"> Documento Respaldo</div>
    <div > <input class="input_redond_350" type="text" id="tdo" placeholder="Documento Respaldo" value="<?php echo $dr ;?>" ></div>
    
   
</div>


<script>cambios_form();</script>