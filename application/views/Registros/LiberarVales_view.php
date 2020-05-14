<div class="grid_11 espizquierda"@><div class="grid_6"><h2>Formulario de Liberacion y anulacion de Solicitudes y Vales de Gasolina</h2></div>
    <div class=" grid_5 alinearDerecha esparriba"><input type="text" class="fondobuscar"><input type="button" class="botonbuscar" value="Buscar" onclick="javascript:nularvales('<?php echo base_url(); ?>');"></div>
    <div class="grid_5 prefix_6 alinearDerecha"> 
   <?php for ($m=1;$m<=ceil($cantidaddevales/100);$m++){
                    if($pagina==$m)
                        echo "<span class='negrocolor negrilla'>". $m . " </span>,";
                    else
                    {$a=$cantidaddevales-($m*100);
                        $b=$cantidaddevales-(($m-1)*100);
                        if($b<=0)
                              $b=1;
                        if($a<=0)
                                $a=1;
                            
                        echo "<a href='javascript:cambiarpaginaRegistrosVales();' title='de $b al $a'>".$m ."</a> , ";
                        
                        }}
                        echo "<br/><span class=negrilla negrocolor>".$cantidaddevales."</span> Registros Encontrados";
   ?>
    
    </div>
    
</div>
<div class="grid_12 centrartexto">
    <div class="grid_12 fondoazul blanco_text">
        <div class="prefix_2 grid_1"> Numero Asignacion</div>
        <div class="grid_1">Fecha de Registro</div>
        <div class="grid_3">Solicitado por</div>
        <div class="grid_1">Placa Vehiculo</div>
        <div class="grid_1">Proyecto</div>
        <div class="grid_1">Vales/monto</div>
        <div class="grid_1">Monto Total</div>
        <div class="grid_1">Estado</div>    
    </div>
    <?php 
    $i=0;
    foreach ($regAsigGas as $fila) { ?>
        <div id='resultado_de_busqueda''>
            <div class="grid_12 bordeArriba">
                <div class="grid_2">
                    <input type="button" value="Liberar" onclick="javascript:modalanularLiberarSolyvales('<?php echo base_url();?>',1,'<?php echo $fila->id; ?>');"> 
                    <input type="button" value="Anular" onclick="javascript:modalanularLiberarSolyvales('<?php echo base_url();?>',0,'<?php echo $fila->id; ?>');">
                </div>
                <div class="grid_1"><?php echo $fila->id; ?></div>
                <div class="grid_1"> <?php echo $fila->fecha; ?></div>
                <div class="grid_3 alinearIzquierda"><?php echo $fila->NomComp; ?></div>
                <div class="grid_1"><?php echo $fila->placa; ?></div>
                <div class="grid_1"><?php echo $fila->proyecto ?></div>
                <div class="grid_1 alinearIzquierda"><?php 
                if(count($listalavesregistros[$i])>0){
                for( $j=0;$j< count($listalavesregistros[$i]) ;$j++)
                {
                    echo  $listalavesregistros[$i][$j]."<br/>";
                   
                }}
 else {echo ".";}
                $i++;
                 ?></div>
                <div class="grid_1"><?php echo $fila->monto; ?></div>
                <div class="grid_1"><?php echo $fila->estado; ?></div>

            </div>
            <div class="clear"></div>

            <?php
        }
        ?>

    </div>

</div>

