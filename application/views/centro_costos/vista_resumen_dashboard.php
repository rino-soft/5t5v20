<div style="width: 100%; display: inline-block ;margin:5px 0 5px 0;min-height:70px" class="fondo_azul_transparente">
        <div style="width: 30%; margin: 10px 1.5% 10px 1.5%; float: left;">
            <div style="background-color: rgba(254,162,161,0.75); border-radius: 5px;" class="alin_cen f20 negrilla">
                <?php $compras=  explode("|", $resumen_compras); 
                 echo $compras[0] .'<br><span style="color:#66809A " class="f16">'.$compras[2].'</span>'; 
                 ?>
            </div>
        </div>
        <div style="width: 30%; margin: 10px 1.5% 10px 1.5%;float: left; "><div style="background-color: rgba(246,253,92,0.75); border-radius: 5px;" class="alin_cen f20 negrilla"> 15,451,541.00  <br><span style="color:#66809A " class="f16">15,451,541.00</span></div></div>
        <div style="width: 30%; margin: 10px 1.5% 10px 1.5%;float: left; "><div style="background-color: rgba(92,190,253,0.75); border-radius: 5px;" class="alin_cen f20 negrilla"> 15,451,541.00  <br><span style="color:#66809A " class="f16">15,451,541.00</span></div></div>

    </div>


    <div style="width: 100%;display: inline-block;margin:5px 0 5px 0;min-height:170px" class="fondo_azul_transparente">
        <div style="width: 95%; margin: 5px 2.5% 5px 2.5%; background: blue;"> 
            <div style="width: 25%; margin: 10px 0 10px 0;float: left; min-height: 150px;background: white;border-radius: 2px;" id="pres_gasto"></div>

            <div style="width: 25%; margin: 10px 0 10px 0;float: left; min-height: 150px;background: white;border-radius: 2px; "id="pres_fact">ajsdkl ashdjkldja djhlask asjkldhashdl kjas dlkjs</div>
            <div style="width: 25%; margin: 10px 0 10px 0;float: left; min-height: 150px;background: white;border-radius: 2px; "id="pres_cobro">ajsdkl ashdjkldja djhlask asjkldhashdl kjas dlkjs</div>
            <div style="width: 25%; margin: 10px 0 10px 0;float: left; min-height: 150px;background: white;border-radius: 2px; "id="pres_ganancia">ajsdkl ashdjkldja djhlask asjkldhashdl kjas dlkjs</div>
            <script>informacion_presupuestos('pres_gasto', 'tipo', 'proyecto');</script>  
            <script>informacion_presupuestos('pres_fact', 'tipo', 'proyecto');</script>  
            <script>informacion_presupuestos('pres_cobro', 'tipo', 'proyecto');</script>  
            <script>informacion_presupuestos('pres_ganancia', 'tipo', 'proyecto');</script>  
        </div>
    </div>

    <div style="width: 100%;display: inline-block;margin:5px 0 5px 0;min-height:250px" class="fondo_azul_transparente">
        <div style="width: 95%; margin: 10px 2.5% 10px 2.5%;" id="historico"> 

        </div>
        <script>informacion_historicos_economicos('historico', 'tipo', 'proyecto');</script>  
    </div>