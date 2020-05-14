<?php
$rs="";$nit="";$tel="";$dir="";$rub="";
$rs_llave=""; 
//echo $id_send;
if($id_send!=0)
{
    $rs=$d_cliente->razon_social;
    $rs_llave="readonly='readonly'";
    $nit=$d_cliente->nit;
    $tel=$d_cliente->telefonos;
    $dir=$d_cliente->direccion;
    $rub=$d_cliente->rubro;
}
?>


<div>
        <div >Ingrese los Datos del <span class="negrilla">CLIENTE</span></div>
        <hr>
    <div > 
        
        <input class="input_redond_350" type="hidden" id="id_cli" value="<?php echo $id_send;?>"></div>
        <input class="input_redond_350" type="text" id="rs" <?php echo $rs_llave; ?>  placeholder="Nombre o Razon Social" value="<?php echo $rs ;?>"></div>
    <div class="f10 negrilla"> Nombre o Razon Social</div>
    
    
    <div > <input class="input_redond_350" type="text" id="nit" <?php echo $rs_llave; ?> placeholder="NIT" value="<?php echo $nit ;?>"></div>
    <div class="f10 negrilla"> Numero de NIT o CI</div>
    <div > <input  class="input_redond_350"type="text" id="tel" placeholder="Telefonos" value="<?php echo $tel ;?>"></div>
    <div class="f10 negrilla"> Telefonos</div>
    <div > <input class="input_redond_350" type="text" id="dir" placeholder="Direccion" value="<?php echo $dir ;?>"></div>
    <div class="f10 negrilla"> Direccion</div>
    <div > <input class="input_redond_350" type="text" id="rub" placeholder="Rubro del cliente" value="<?php echo $rub ;?>" ></div>
    <div class="f10 negrilla"> Rubro del cliente</div>
    <div id="respuesta"></div>
</div>
