<?php $usuarios_resumen = explode("|", $resumen_usuario); ?>
<div class="fondo_boton_blanco_cc milink"> 
    <div style="width: 50px; display: inline-block ;float: left" class="boton_usuarios"></div> 
    <div class="negrilla f14" style="display: inline-block;float: left ; margin: 0 10px 0 0;"> PERSONAL </div> 
    <div style="display: inline-block;float: right">
        <?php
        if ($proyecto_seleccionado == 0)
            echo $usuarios_resumen[0] . " trabajan solo en 1 proyecto    <br>" . $usuarios_resumen[1] . " Trabajan en dos o mas proyectos";
        else
            echo $usuarios_resumen[0] . " Trabajadores Dedicados    <br>" . $usuarios_resumen[1] . " Trabajadores Compartidos";
        ?>
    </div>
</div>

<div class="fondo_boton_blanco_cc milink"> 
    <div style="width: 50px; display: inline-block ;float: left" class="boton_vehiculos"></div>
    <div class="negrilla f14" style="display: inline-block;float: left ; margin: 0 10px 0 0;"> VEHICULOS </div> 
    <div style="display: inline-block;float: right">
        <?php
        if ($resumen_transportes->num_rows() > 0) {
            foreach ($resumen_transportes->result() as $vehiculo_resumen) {
                echo $vehiculo_resumen->cantidad . " : Vehiculos " . $vehiculo_resumen->contrato . "<br>";
            }
        } else {
            echo 'No re registran Vehiculos en este Proyecto';
        }
        ?>
    </div>
</div>

<div class="fondo_boton_blanco_cc milink"> 
    <div style="width: 50px; display: inline-block ;float: left" class="boton_compras"></div> 
    <div class="negrilla f14" style="display: inline-block;float: left ; margin: 0 10px 0 0;"> COMPRAS </div> 
    <div style="display: inline-block;float: right"> 1,542,154.00</div>
</div>

<div class="fondo_boton_blanco_cc milink"> 
    <div style="width: 50px; display: inline-block ;float: left" class="boton_pagos"></div> 
    <div class="negrilla f14" style="display: inline-block;float: left ; margin: 0 10px 0 0;"> VENTAS </div> 
    <div style="display: inline-block;float: right">1,542,154.00 pagado <br> 3,545,440.44 saldo</div>
</div>
<div class="fondo_boton_blanco_cc milink"> 
    
    <div style="width: 50px; display: inline-block ;float: left" class="boton_contratos"></div>
    <div class="negrilla f14" style="display: inline-block;float: left ; margin: 0 10px 0 0;"> CONTRATISTAS </div> 
    <div style="display: inline-block;float: right">5 Contratos <br> 1,542,166.84</div>
</div>
<div class="fondo_boton_blanco_cc milink"> 
   
    <div style="width: 50px; display: inline-block ;float: left" class="boton_ubicacion"></div>
    <div class="negrilla f14" style="display: inline-block;float: left ; margin: 0 10px 0 0;"> OFICINAS </div> 
    <div style="display: inline-block;float: right">5 Contratos <br> 1,542,166.84</div>
</div>

<div class="fondo_boton_blanco_cc milink"> 
    
    <div style="width: 50px; display: inline-block ;float: left" class="boton_lineas"></div> 
     <div class="negrilla f14" style="display: inline-block;float: left ; margin: 0 10px 0 0;"> LINEAS y SERCVICIOS </div> 
     <div style="display: inline-block;float: right">35 lineas ENTEL 1.422.00 Julio<br>5 lineas TIGO 422.00 Julio</div>
</div>

<div class="fondo_boton_blanco_cc milink"> 
    <div style="width: 50px; display: inline-block ;float: left" class="boton_inventario"></div>
     <div class="negrilla f14" style="display: inline-block;float: left ; margin: 0 10px 0 0;"> INVENTARIO </div> 
    <div style="display: inline-block;float: right">45 computadoras<br>5 Equipos A<br>6 Equipos B<br>8 Equipos C<br>16 Equipos D</div>
</div>





