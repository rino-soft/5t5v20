<div class="grid_3">
<div class="grid_3 letraGrande azulmarino">Busca de Vehiculos aptos</div>
<div class="grid_3 fondoplomoclaro">
    <div class="grid_3">
        <div class="grid_3 fondoazul blanco_text" id="divdebusquedadevehiculo<?php echo $indice; ?>">
            <div class="grid_1 letrachica alinearDerecha esparriba negrilla">Traccion :</div> 
            <div class="grid_2 letrachica esparriba"> 
                <select class="letrachica" id="traccion<?php echo $indice; ?>">
                    <option value="Todos">Todos...</option>
                    <option value="Simple">Simple</option>
                    <option value="Doble">Doble</option>
                </select> </div>
             <div class="grid_1 letrachica alinearDerecha esparriba negrilla">Capacidad:</div> 
            <div class="grid_2 letrachica esparriba"> 
                <select class="letrachica" id="cantPasajeros<?php echo $indice; ?>">
                    <option value="0">Todos...</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="10">mas</option>
                </select> </div>
            <div class="grid_1 alinearDerecha letrachica esparriba negrilla"> Desde : </div>
            <div class="grid_2 esparriba"><input type="Text" size="10" id="desde<?php echo $indice; ?>" class="letrachica" value="<?php echo $solicitud->fecha_salida; ?>"></div>
            <div class="grid_1 alinearDerecha letrachica esparriba negrilla" >Hasta :</div> 
            <div class="grid_2 esparriba"><input type="Text" size="10" id="hasta<?php echo $indice; ?>" class="letrachica" value="<?php echo $solicitud->fecha_retorno; ?>"></div>
            <div class="grid_1 alinearDerecha esparriba letrachica negrilla"> Lugar :</div>
            <div class="grid_2  esparriba"><select id="lugar<?php echo $indice; ?>" class="letrachica">
                    <option value="Todos">Todos...</option>
                    <?php
                    foreach ($destinos as $Registro) {
                        $sel = "";
                        if ($Registro->id == $solicitud->id_regional)
                            $sel = 'selected';
                        echo "<option value='$Registro->id' $sel >$Registro->nombre</option>";
                    }
                    ?>
                </select></div>
            <div class="grid_1 alinearDerecha esparriba letrachica negrilla">Tipo :</div>
            <div class="grid_2 esparriba"><select class="letrachica" id="tipoVehiculo<?php echo $indice; ?>">
                    <option value="Todos">Todos...</option>
                    <?php
                    foreach ($tipovehiculo as $Registro) {
                        echo "<option value'$Registro->Tipo'>$Registro->Tipo</option>";
                    }
                    ?>
                </select></div>
            <div class="grid_3  esparriba centrartexto"><input type="button" value="BUSCAR" id="botonbuscarvehiculos<?php echo $indice;?>" onClick="buscarVehiculos('<?php echo base_url(); ?>','<?php echo $indice; ?>');"></div>
        </div>


    </div>

</div>
</div>
<!-- <div class="grid_9" id="divResultado_Busqeda<?php //echo $indice; ?>">
    resultados
</div>-->

<!--<div class="prefix_3 grid_8 suffix_1" id="divSolicitud_Alquiler<?php //echo $indice; ?>">
    Solicitud de alquiler
</div>//>

