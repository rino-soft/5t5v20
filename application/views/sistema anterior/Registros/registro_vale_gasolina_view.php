<div class="grid_10 prefix_1 suffix_1"><h2> Formulario de Registro de Vales de Gasolina </h2></div>
<div class="grid_6 " id="fomulariovalegasolina">
    <form class="sendemail">
        <fieldset><legend class="espizq">Registro talonario de gasolina</legend>
            <div class="grid_2 alinearDerecha esparriba"> Nro de inicio: </div>
            <div class="grid_2 esparriba"><input type="text" class="textChico" id="minimo" value="0"></div>
            <div class="clear"></div>

            <div class="grid_2 alinearDerecha esparriba"> Nro de final:  </div>
            <div class="grid_2 esparriba"><input type="text" class="textChico" id="maximo" value="0"> </div>
            <div class="clear"></div>

            <div class="grid_2 alinearDerecha esparriba"> monto Bs:  </div> 
            <div class="grid_3 esparriba">
            <select name="valor" id="valor">
                <option value="050" selected>50</option>
                <option value="100">100</option>
            </select>
               </div>
            <div class="clear"></div>

            <div class="grid_5 centrartexto esparriba" id="boton"> 
                <input type="button" value="Registrar" onclick="javascript:registrarvalesGasolina('<?php echo base_url(); ?>');">
            </div>
            
        </fieldset>


    </form>
</div>
<div class="grid_4 centrartexto oculto " id="mensajes">
 <div class="grid_4"> Se está procediendo a almacenar los vales, el tiempo de espera depende de la cantidad de vales que se registren,<br/> Espere por favor...</div>
    <div class="grid_4"> <img src="<?php echo base_url(); ?>/imagenesweb/recursos/progress_bar.gif" ></div>

</div>


<div class="grid_10 prefix_1 suffix_1"><h2> Vales libres registrados </h2></div>
<div id="vales50" class=" prefix_1 grid_4 suffix_1  alpha omega">
<div class="grid_4 negrilla centrartexto"> vales LIBRES de 50 Bs </div>    
<div class="grid_1"> Nro Vale</div><div class="grid_1">Nro Vale</div><div class="grid_1">Nro Vale</div><div class="grid_1">Nro Vale</div>

<?php 
foreach ($vale50 as $Registro) {
?>
  <div class="grid_1">  <?php echo $Registro->reg;?> </div>
<?php }
?>
</div>

<div id="vales100" class="grid_4 prefix_1  suffix_1 alpha omega">
    <div class="grid_4 negrilla centrartexto"> vales LIBRES de 100 Bs </div>
    <div class="grid_1"> Nro Vale</div><div class="grid_1">Nro Vale</div><div class="grid_1">Nro Vale</div><div class="grid_1">Nro Vale</div>
<?php 
foreach ($vale100 as $Registro) {
?>
  <div class="grid_1">  <?php echo $Registro->reg;?> </div>
<?php }
?>
</div>
<div class="clear"></div>