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
        <div>
           <div id="container" style="min-width: 310px; margin: 0 auto;"></div> 
        </div>
        <?php
      
       
        //$resultado="";
        //for($i=0;$i<count($listado_proyecto);$i++)
        //{
          //  $resultado.=$listado_proyecto[$i][0]."|".$listado_proyecto[$i][1]."|".$listado_proyecto[$i][2]."|".$listado_proyecto[$i][3].'*';
       // }
        //echo $resultado;
	echo $deptos."<br>";       

	echo $totales."<br>";       
	echo $proyectos."<br>";       
	echo $porcentajes_proy."<br>";  
	?>
       
        <script>
            asignacion_depar_proyecto("container","<?php echo $deptos;?>","<?php echo $totales;?>","<?php echo $proyectos;?>","<?php echo $porcentajes_proy;?>");
        </script>
    </body>
</html>