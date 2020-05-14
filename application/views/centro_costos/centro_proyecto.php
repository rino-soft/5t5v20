<style type="text/css"> .highcharts-yaxis-grid .highcharts-grid-line {display: none;}</style>
<link href="<?php echo base_url(); ?>CSS/highcharts.css" type="text/css" rel="stylesheet" />  
<script src="<?php echo base_url(); ?>js/chart/highcharts.js"></script>
<script src="<?php echo base_url(); ?>js/chart/highcharts-more.js"></script>
<script src="<?php echo base_url(); ?>js/chart/solid-gauge.js"></script>



<div style="width: 25%;min-height:200px ;display: inline-block; float: left ; margin: 10px 10px 10px 10px;" class="fondo_azul_transparente"> 
    <div style="width: 95%; padding: 10px 0 10px 0; margin: 10px 2.5% 20px 2.5% "class="f20 negrilla fondo_plomo_claro_areas alin_cen"> 

        <select style="font-size: 18; color: #606060;width: 300px; border:none; background: none;" onchange="rescatar_informacion_centro_costos('menupanel','dashboard','proyecto_seleccionado')" id='proyecto_seleccionado'>
            <option value='0'> Todos mis Proyectos</option>
            <?php
            foreach ($mis_proyectos->result() as $proyecto) {

                echo "<option value='$proyecto->id_proy'> $proyecto->nombre </option>";
            }
            ?>
            <?php echo $mis_proyectos->row()->nombre; ?>
        </select>
    </div>


    <div class="" id="menupanel"> 
        <div class="fondo_boton_blanco_cc milink"> 
            <div style="width: 50px; display: inline-block ;float: left" class="boton_usuarios"></div> <div style="display: inline-block;float: left">35 Trabajadores Dedicados<br>3 Trabajadores Compartido</div>
        </div>

        <div class="fondo_boton_blanco_cc milink"> 
            <div style="width: 50px; display: inline-block ;float: left" class="boton_vehiculos"></div> <div style="display: inline-block;float: left">15 Vehiculos Propios<br>3 vehiculos Alquilados   </div>
        </div>

        <div class="fondo_boton_blanco_cc milink"> 
            <div style="width: 50px; display: inline-block ;float: left" class="boton_compras"></div> <div style="display: inline-block;float: left"> 1,542,154.00</div>
        </div>

        <div class="fondo_boton_blanco_cc milink"> 
            <div style="width: 50px; display: inline-block ;float: left" class="boton_pagos"></div> <div style="display: inline-block;float: left">1,542,154.00 pagado <br> 3,545,440.44 saldo</div>
        </div>
        <div class="fondo_boton_blanco_cc milink"> 
            <div style="width: 50px; display: inline-block ;float: left" class="boton_contratos"></div> <div style="display: inline-block;float: left">5 Contratos <br> 1,542,166.84</div>
        </div>
        <div class="fondo_boton_blanco_cc milink"> 
            <div style="width: 50px; display: inline-block ;float: left" class="boton_lineas"></div> <div style="display: inline-block;float: left">35 lineas ENTEL 1.422.00 Julio<br>5 lineas TIGO 422.00 Julio</div>
        </div>

        <div class="fondo_boton_blanco_cc milink"> 
            <div style="width: 50px; display: inline-block ;float: left" class="boton_inventario"></div> <div style="display: inline-block;float: left">45 computadoras<br>5 Equipos A<br>6 Equipos B<br>8 Equipos C<br>16 Equipos D</div>
        </div>
    </div>



</div>
<div id="dashboard" style="width: 70%;display: inline-block; float: left;  margin: 5px 10px 5px 10px; color:#606060;" class=""> 
    <div style="width: 100%; display: inline-block ;margin:5px 0 5px 0;min-height:70px" class="fondo_azul_transparente">
        <div style="width: 30%; margin: 10px 1.5% 10px 1.5%; float: left;"><div style="background-color: rgba(254,162,161,0.75); border-radius: 5px;" class="alin_cen f20 negrilla"> 15,451,541.00 <br><span style="color:#66809A " class="f16">15,451,541.00</span> </div></div>
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



</div>