<div class="grid_10 prefix_1 suffix_1"@><h2>Formulario de Anulacion de Vales de Gasolina</h2></div>
<div class="grid_12 " id="fomularioAnularValeGasolina">
    <form class="sendemail">
        <ol><li>
        <fieldset><legend class="espizq">Anular Vales de Gasolina</legend>
            
           <div class="grid_8 prefix_1 suffix_1">
                       Utilice solo los simbolos * , * y * - *, para separar los nro de vales no use espacio ni otro simbolo
                 
            </div>
            <div class="clear"></div>
            <div class="grid_2 alinearDerecha esparriba"> Vales a anular: </div>
            <div class="grid_8 esparriba"><input type="text" class="text" id="valesanular" value="0" maxlength="1048" onclick="javascript:listabalesanulado('<?php echo base_url();?>')"></div>
            <div class="clear"></div>
            <div class="grid_2 alinearDerecha esparriba"> Monto: </div>
            <div class="grid_8 esparriba">
                <select name="monto" id="monto">
                    <option value="100">100</option>
                    <option value="050"> 50</option>
                </select></div>
            <div class="clear"></div>
            <div class="grid_8 prefix_1 suffix_1">
                <div class="negrilla letrachica">Ejemplos:</div>
                <div class="letrachica">
                    se puede realizar las siguientes conbinaciones para anular los vales:<br/>
                    uso del simbolo * - * para realizar rangos ej. 123-126 => 123,124,125,126<br/>
                    uso del simbolo * , * para realizar unicos ej. 124,128 => 124 y 128<br/>
                    uso de ambos simbolos ej. 121,125-128,130 => 121,125,126,127,128,130 <br/>
                </div>  
            </div>
            <div class="clear"></div>

            <div class="grid_5 centrartexto esparriba" id="boton"> 
                <input type="button" value="Anular" onclick="javascript:anularvales('<?php echo base_url(); ?>');">
            </div>
            
        </fieldset>
        </li>
        </ol>
            
    </form>
</div>
<div class="grid_10 suffix_1 prefix_1">
    <div class="grid_10 negrilla azultext"> Vales de Gasolina Anulado de 100Bs</div>
    <div class="grid_10" id="valesanuladoslista100"> </div>
    <div class="grid_10 negrilla azultext" > Vales de Gasolina Anulados de 50Bs</div>
    <div class="grid_10" id="valesanuladoslista50"> </div>
    
    
</div>