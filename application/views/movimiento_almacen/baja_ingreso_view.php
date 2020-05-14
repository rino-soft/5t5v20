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
$resm=$consulta->result();
?>

    
<div>
        <div >Elimine los Datos del <span class="negrilla">Movimiento de Almacen</span></div>
        <hr>
    
    <div style="display: block-inline; width: 300px; float: left">
        <div style="display: block; "> <span class="negrilla  colorRojo">Fecha/Hora registro</span> </div>
            <div style="display: block; "><span class="negrilla"> <?php echo "holsss";?></span></div>
    </div>
    <div class="f12" style="display: block-inline; width: 300px; float: left">
        <div style="display: block; "> <span class="negrilla  colorRojo">Tipo Movimiento</span> </div>
            <div style="display: block; "><span class="negrilla"> <?php echo $tm->tipo_movimiento;?></span></div>
    </div>
    <div class="f12" style="display: block-inline; width: 300px; float: left">
        <div style="display: block; "> <span class="negrilla  colorRojo">Proyecto</span> </div>
            <div style="display: block; "><span class="negrilla"> <?php echo $proy->proyecto;?></span></div>
    </div>
    <div class="f12" style="display: block-inline; width: 300px; float: left">
        <div style="display: block; "> <span class="negrilla  colorRojo">Comentario</span> </div>
            <div style="display: block; "><span class="negrilla"> <?php echo $com->comentario;?></span></div>
    </div>
    <div class="f12" style="display: block-inline; width: 300px; float: left">
        <div style="display: block; "> <span class="negrilla  colorRojo">Tipo Documento Origen</span> </div>
            <div style="display: block; "><span class="negrilla"> <?php echo $tdo->tipo_doc_origen;?></span></div>
    </div>
    <div class="f12" style="display: block-inline; width: 300px; float: left">
        <div style="display: block; "> <span class="negrilla  colorRojo">Documento Respaldo</span> </div>
            <div style="display: block; "><span class="negrilla"> <?php echo $dr->doc_respaldo;?></span></div>
    </div>
        
    
   
</div>


<script>cambios_form();</script>