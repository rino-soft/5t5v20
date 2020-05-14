


<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Highcharts Example</title>
        <script src="<?php echo base_url() . "JS/jquery.min.js"; ?>"></script>
        <style type="text/css">

        </style>
        <link href="<?php echo base_url(); ?>CSS/erp_sg_v1_0.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>CSS/1000_20_0_0.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>CSS/style.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>CSS/jquery-ui.css" type="text/css" rel="stylesheet" />
        <script src="<?php echo base_url(); ?>JS/jquery-ui.js"></script>
     
        <script src="<?php echo base_url() . "JS/highcharts.js"; ?>"></script>
        <script src="<?php echo base_url() . "JS/exporting.js"; ?>"></script>
         <script src="<?php echo base_url(); ?>JS/estadisticas.js"></script>
        <script src="<?php echo base_url() . "JS/drilldown.js"; ?>"></script>
           

    </head>
   <body>
        <!---cantidad de alquilados propios por tiempos fechas--->
        
        <div class="esparriba10" style="height: 70px;">
               <div style="width: 1150px ">
                    <div class=" " style="margin-top:30px ;width: 300px;float: right">
                       <div class=" " style="width: 100px; float: left">
                           <input  type="text" title="" class="input_redond_100 margin_cero" id="fecha_inicial" value="<?php echo $fec1;?>"  >
                       </div>
                       <div class="" style="width: 100px;float: left">
                           <input type="text" title=""  class="input_redond_100 margin_cero" id="fecha_final" value="<?php echo $fec2;?>" >
                       </div>
                       <div class=" boton2 milink" style="width: 50px;float: left" onclick="recargar_grafica('fecha_inicial','fecha_final','<?php echo base_url()."vehiculo/index/54"; //cambiar 54 por dato dinamico?>');">
                        graficar
                       </div>
                    </div>
               </div>
           <div class="clear"></div>

               <script>
                   $(function () {
                       $("#fecha_inicial").datepicker({
                           onClose: function (selectedDate) {
                               $("#fecha_final").datepicker({minDate:selectedDate},{dateFormat:"yy-mm-dd"});
                           }
                       });
                       $("#fecha_final").datepicker({
                           onClose: function (selectedDate) {
                               $("#fecha_inicial").datepicker({maxDate: selectedDate},{dateFormat:"yy-mm-dd"});
                           }
                       });
                   });
               </script>
             
           </div>
        <div id="container_3" style="width: 1150px; margin-left: 15px"></div>
           <script>
               graf_cantidad_alq_prop_empresa("container_3","<?php echo $fechasG;?>","<?php echo $canPropG;?>","<?php echo $canAlqG;?>");
           </script>
      
         <div class=" f12"style="width: 1150px; margin-left: 15px;">
            <!---Asignacion por departamento- asignaion por proyecto--->

                <div class=""  style="display: table-cell;width: 575px">
                       <div id="container" style="min-width: 310px; margin: 0 auto;"></div> 
                    <script>
                        asignacion_depar_proyecto("container","<?php echo $deptos;?>","<?php echo $totales;?>","<?php echo $proyectos;?>","<?php echo $porcentajes_proy;?>");
                    </script>
                </div>

            <!---alquilados propios--->

            <div class=""  style="display: table-cell;width: 575px">
                
                    <div id="container_5" class="" ></div>
                    <?php //echo $can_a.'<br>';echo $can_p;?>
                       <script>
                           alquilado_propio("container_5",<?php echo $can_a;?>,<?php echo $can_p;?>);
                       </script>
             
            </div>
        </div>
        
        
        <!---- view alquilado propio--->

        
	  <!---<style type="text/css">
		a, a:link, a:visited {
			color: #444;
			text-decoration: none;
		}
		a:hover {
			color: #000;
		}
		.left {
			float: left;
		}
		#menu {
			width: 20%;
		}
		#g_render {
			width: 60%;
		}
		li {
			margin-bottom: 1em;
		}

        </style>
	
      <div class=" f12"style="width: 1150px; margin-left: 15px;">
         

            <!--- asignacion proyecto--->
           <!--- <div class=""  style="display: table-cell;width: 575px">
                <div>
                    <div id="g_render"  class="" style="min-width: 310px; margin: 0 auto;">
                             <?php //if (isset($charts_dos)) echo $charts_dos; ?>
                             <?php //if (isset($json)): ?>

                                     <pre><?php //echo print_r($json); ?></pre>
                             <?php //endif; if (isset($array)): ?>

                                     <pre><?php //echo print_r($array); ?></pre>
                             <?php //endif; ?>
                     </div>
                </div>
            </div>
        </div>--->
        
        
      <div class=" f12 "style="width: 1150px; margin-left: 15px;">
        
        
           <!---Asignacion por Proyecto- alquilados propios--->
           
         <div id="container_2" style="min-width: 310px; margin: 0 auto;"></div> 
                    <?php
                    $resultado="";
                    for($i=0;$i<count($listado_proyecto);$i++)
                    {
                        $resultado.=$listado_proyecto[$i][0]."|".$listado_proyecto[$i][1]."|".$listado_proyecto[$i][2]."|".$listado_proyecto[$i][3].'*';
                    }
                    ?>
                    <script>
                        asignado_proyecto_pro_alq("container_2","<?php echo $resultado;?>");
                    </script>   
           
        
      </div>
        </body>
   
</html>
