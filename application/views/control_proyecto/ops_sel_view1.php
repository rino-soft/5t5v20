<div class="fondo_azul colorBlanco negrilla f12" style="width: 95%; display: block; padding: 5px; ">
    <div style="display: inline-block">

       

    </div>

    
      

    </div>
</div>
<div style="clear:both;height: 10px;"></div>

<!-- aqui se muestra los registros con un foreach -->
<div>
    <?php foreach ($registros->result() as $reg) { ?>
        <div class='div1150 fondo_plomo'>
            <div class="f12" style="display: block-inline;width: 150px;float: left ">
                <div style="display: block; ">
                    <span class="negrilla f16 colorRojo"><?php echo "nombre : " . $reg->nom_comp. "(" . $reg->cargo . ")"; ?></span>
                </div>               
                            
                 <div id="area_cargo_selecctivo" style="display: block;"></div>            
                
                
            </div>
           
           
           




        </div> 
    <?php } ?>
</div>

