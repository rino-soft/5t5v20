<?php// echo 'funcionaaaa entra';?>
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
    
           <div id="container" style="min-width: 310px; margin: 0 auto;"></div> 
     
        <?php
       echo count($listado_proyecto);
        $resultado="";
        for($i=0;$i<count($listado_proyecto);$i++)
        {
            $resultado.=$listado_proyecto[$i][0]."|".$listado_proyecto[$i][1]."|".$listado_proyecto[$i][2]."|".$listado_proyecto[$i][3].'*';
        }
       // echo $resultado;
        ?>
       
        <script>
            asignado_proyecto_pro_alq("container","<?php echo $resultado;?>");
        </script>
    </body>
</html>