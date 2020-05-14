<div class="grid_10 prefix_1 suffix_1" ><h2> Formulario de Gasolina </h2></div>
<div class="grid_10 prefix_1 suffix_1">Vales disponibles</div>
<div class="grid_1 prefix_1 alinearDerecha esparriba">100 Bs >>> </div>
<div class="grid_9 suffix_1 esparriba">
    <?php
    $i = 0;
    foreach ($vale100 as $Registro) {
        echo " <label id='vale100_" . $i . "' >" . $Registro->reg . "</label> ,";
        $i++;
    }
    ?>
</div>
<div class="clear"></div>
<div class="grid_1 prefix_1 alinearDerecha esparriba">50 Bs >>> </div>
<div class="grid_9 suffix_1 esparriba">
    <?php
    $i = 0;
    foreach ($vale50 as $Registro) {
        echo " <label id='vale50_" . $i . "' >" . $Registro->reg . "</label> ,";
        $i++;
    }
    ?>
</div>

<div class="grid_6">
    <form class="sendemail">
        <ol>
            <li>
                <fieldset><legend class="espizq">Registro de emision de vales de gasolina</legend>
                    <div class="alpha grid_2 alinearDerecha esparriba"> Proyecto >> </div> <div class="grid_3 esparriba"><?php echo form_dropdown('proyecto', $proyectos, 0, "id='proyecto', onChange='listarAsignaciones()' "); ?></div><div class="clear"></div>
                    <div class="alpha grid_2 alinearDerecha esparriba"> CI >> </div><div class="grid_3  esparriba"><input type="text" class="textChico" id="cedula" onkeyup="javascript:BuscarUsuario()" > <input type="hidden" class="textChico" id="idsolicitante">
                        <input type="hidden" class="textChico" id="baseurl" value="<?php echo base_url(); ?>"></div><div class="clear"></div>
                    <div class="alpha grid_2 alinearDerecha esparriba"> Nombres y Apellidos >> </div><div class="grid_3 esparriba"><input type="text" class="textMedio" id="usuario" > </div><div class="clear"></div>
                    <div class="alpha grid_2 alinearDerecha esparriba"> Vehiculo >> </div><div class="grid_3 esparriba"><input type="text" class="textChico" id="placa"></div><div class="clear"></div>
                    <div class="alpha grid_2 alinearDerecha esparriba"> Observaciones >> </div><div class="grid_3 esparriba"><input type="text" class="textMedio" id="observaciones"></div><div class="clear"></div>
                    <div class="grid_5 prefix_1">
                        <div class="grid_5 esparriba negrilla">Indique cantidad de Vales</div>    
                        <div class="alpha grid_2 alinearDerecha esparriba"> vale Bs.-100 >> </div><div class="grid_2 esparriba"><input type="text" class="textMuyChico" value="0" id="vale100" onkeyup="javascript:calculamontosolicitudGasolina()"></div><div class="clear"></div>
                        <div class="alpha grid_2 alinearDerecha esparriba"> vale Bs.- 50 >> </div><div class="grid_2 esparriba"><input type="text" class="textMuyChico" value="0" id="vale50" onkeyup="javascript:calculamontosolicitudGasolina()"></div><div class="clear"></div>
                        <div class="alpha grid_2 alinearDerecha esparriba"> Total Bs.- >> </div><div class="grid_2 esparriba"><input type="text" class="textMuyChico" value="0" readonly id="total"></div><div class="clear"></div>
                    </div>
                    <div class="alpha grid_2 alinearDerecha esparriba"> </div><div class="grid_3 esparriba"> <input type="button" value="Registrar" onclick="javascript:validarCamposAsignarValesGasolina()"></div><div class="clear"></div>
                </fieldset>
                <!--<input name="proyecto" class="text" id="usuario" value="" size="30" title="Ingrese su Nombre de Usuario" maxlength="2048" />-->
            </li>
        </ol>
    </form>
</div>
<div id="asignadas" class=" grid_6"></div>
<div class="container_12 oculto" id="mensajeConfirmacion"> Cargando espere por favor...<br><br> Si el tiempo de espera supera los 10 Segundos cancele y presione otra vez en 'Registrar'.</div>

